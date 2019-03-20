<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Manual;

class ManualValue extends Model
{
  protected $fillable = ['user_id', 'manual_id', 'value'];
  protected $appends = ['file_path'];

  public function getFilePathAttribute()
  {
    $filePath = "/files/{$this->user_id}/{$this->value}";
    if (file_exists(storage_path($filePath))) {
      return "/storage{$filePath}";
    }
  }

  public function manual()
  {
    return $this->belongsTo(Manual::class);
  }
}