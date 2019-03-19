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

$test = ManualValue::whereUserId($user->id)->get();
dd2($test->toArray());


//$manualTypes = ManualType::valueByUser($user_id)->whereHas('comments', function ($query) {
//    $query->where('content', 'like', 'foo%');
//})->get();

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
    ManualValue::whereUserId($user->id)->delete();

    ManualValue::insert($manualValues);
    header('Location: ?id=' . $user->id);
    exit;
}

echo view('people.edit', ['manualTypes' => $manualTypes, 'user' => $user]);