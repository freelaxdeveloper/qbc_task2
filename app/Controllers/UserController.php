<?php namespace App\Controllers;

use App\Models\User;
use App\Models\ManualType;
use App\Models\ManualValue;

class UserController {

  public function show($user_id)
  {
    $manualtypes = ManualType::valueByUser($user_id)->get();
    $user = User::find($user_id);

    return view('people.view', compact('user', 'manualtypes'));
  }

  public function edit($user_id)
  {
    $manualTypes = ManualType::onlyPeople()->valueByUser($user_id)->get();
    $user = User::find($user_id);

    return view('people.edit', ['manualTypes' => $manualTypes, 'user' => $user]);
  }

  public function update($user_id)
  {
    $manualTypes = ManualType::onlyPeople()->valueByUser($user_id)->get();
    $user = User::find($user_id);

    if (!empty($_FILES)){
      foreach ($_FILES as $key => $file) {
        if ($file['error'] || !$file['size'] || strpos($key, 'dictionary_file_') === false) {
          continue;
        }
        $manual_id = str_replace('dictionary_file_', '', $key);
        $pathinfo = pathinfo($file['name']);
        $tmp_name = $file['tmp_name'];
        $path = storage_path('/files/' . $user_id . '/');
        if(!is_dir($path)) {
          mkdir($path, 0777);
        }
        $filePath = slug($pathinfo['filename']) . '.' . $pathinfo['extension'];
        
        if ($value = ManualValue::whereuserId($user->id)->whereManualId($manual_id)->first()) {
          $value->deleteFile();
        }

        if (move_uploaded_file($tmp_name, $path . $filePath)) {
          ManualValue::updateOrCreate([
            'manual_id' => $manual_id,
            'user_id' => $user_id,
          ],
          ['value' => $filePath]);
        }
      }
    }
  
    if (isset($_POST['send']) && !empty($_POST['dictionary'])) {
        $postData = $_POST['dictionary'];
        $manualValues = [];
    
        foreach ($postData as $manual_id => $value) {
            if (empty($value)) {
                continue;
            }
            $manualValues[] = [
                'user_id' => $user->id,
                'manual_id' => $manual_id,
                'value' => $value,
            ];
        }
        ManualValue::whereHas('manual', function($query) {
            return $query->where('type_field', '!=', 'file')->whereHas('manualType', function($query) {
                return $query->onlyPeople();
            });
        })->whereUserId($user->id)->delete();
    
        ManualValue::insert($manualValues);
    }
    return header("Location: /pages/people/{$user->id}/edit");
  }
}