<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

use App\Services\DirectoryTypes;
use App\Models\User;
use App\Models\ManualType;
use App\Models\ManualValue;
use App\Models\Manual;

$users = User::get();
$manualTypes = ManualType::get();

if (isset($_POST['send']) && !empty($_POST['dictionary'])) {
  $postData = $_POST['dictionary'];
  $manualValues = [];

  foreach ($postData as $manual_id => $value) {
    if (empty($value)) {
      continue;
    }
    $manualValues[] = [
      'user_id' => USER_ID,
      'manual_id' => $manual_id,
      'value' => $value,
    ];
  }
  ManualValue::whereUserId(USER_ID)->delete();

  ManualValue::insert($manualValues);
  header('Location: ?');
  exit;
}

echo view('manualType', ['manualTypes' => $manualTypes]);