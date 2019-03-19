<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ManualOption;

class Manual extends Model
{
  protected $with = ['options'];

  public function options()
  {
    return $this->hasMany(ManualOption::class);
  }
}