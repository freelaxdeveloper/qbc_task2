<?php
require_once '../../vendor/autoload.php';
require_once '../../sys/start.php';

use App\Models\User;
use App\Models\ManualType;
use App\Models\ManualValue;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Пользователь не найден!!!!';
    // header('Location: /');
    exit;
}
$user_id = (int) $_GET['id'];
if (!$user = User::find($user_id)) {
    echo 'Пользователь не найден!!!!';
    // header('Location: /');
    exit;
}

$manualTypes = ManualType::onlyPeople()->valueByUser($user_id)->get();

if (isset($_GET['delete_manual']) && is_numeric($_GET['delete_manual'])) {
    $manual_id = (int) $_GET['delete_manual'];
    if (!$value = ManualValue::whereuserId($user->id)->find($manual_id)) {
        echo 'Доступ запрещён!!!!';
        // header('Location: /');
        exit;
    }
    $value->deleteFile();
    $value->delete();
    echo 'Удалили!';
    header('Refresh: 1; ?id=' . $user_id);
    exit;
}

if (!empty($_FILES)){
    foreach ($_FILES as $key => $file) {
        if (strpos($key, 'dictionary_file_') !== false){
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
}

if (isset($_POST['send']) && !empty($_POST['dictionary'])) {
//    dd2($_POST);
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
    header('Location: ?id=' . $user->id);
    exit;
}

echo view('people.edit', ['manualTypes' => $manualTypes, 'user' => $user]);