<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Manual;

class ManualValue extends Model
{
  protected $fillable = ['user_id', 'manual_id', 'value'];

  public function manual()
  {
    return $this->belongsTo(Manual::class);
  }
}