<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManualValue extends Model
{
  protected $fillable = ['user_id', 'manual_id', 'value'];

  public static function boot()
  {
    parent::boot();

    static::creating(function($model){
      $model->value = 55555;
    });
  }
}