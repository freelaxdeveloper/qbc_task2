<?php namespace App\Controllers;

use App\Models\ManualValue;

class ManualValueController {

  public function delete($user_id, $value_id)
  {
    $value = ManualValue::whereuserId($user_id)->find($value_id);
    $value->deleteFile();
    $value->delete();

    return header("Location: /pages/people/{$user_id}/edit");
  }
}