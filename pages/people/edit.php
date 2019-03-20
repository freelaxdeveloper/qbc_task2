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
        return $query->whereHas('manualType', function($query) {
            return $query->onlyPeople();
        });
    })->whereUserId($user->id)->delete();

    ManualValue::insert($manualValues);
    header('Location: ?id=' . $user->id);
    exit;
}

echo view('people.edit', ['manualTypes' => $manualTypes, 'user' => $user]);