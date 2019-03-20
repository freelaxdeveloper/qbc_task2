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
dd2($manualTypes->toArray());

if (!empty($_FILES)){
    foreach ($_FILES as $key => $file) {
        if (strpos($key, 'dictionary_file_') !== false){
            $pathinfo = pathinfo($file['name']);
            $tmp_name = $file['tmp_name'];
            $path = storage_path('/files/' . $user_id . '/');
            if(!is_dir($path)) {
                mkdir($path, 0777);
            }
            $filePath = slug($pathinfo['filename']) . '.' . $pathinfo['extension'];
            // dd2($filePath);
            move_uploaded_file($tmp_name, $path . $filePath);
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
        return $query->whereHas('manualType', function($query) {
            return $query->onlyPeople();
        });
    })->whereUserId($user->id)->delete();

    ManualValue::insert($manualValues);
    header('Location: ?id=' . $user->id);
    exit;
}

echo view('people.edit', ['manualTypes' => $manualTypes, 'user' => $user]);