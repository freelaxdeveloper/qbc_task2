<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Manual;

class ManualType extends Model
{
  protected $with = ['manuals'];

  public function manuals()
  {
    return $this->hasMany(Manual::class);
  }
}