<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ManualOption;
use App\Models\ManualValue;

class Manual extends Model
{
  protected $with = ['options', 'value'];

    public function options()
    {
        return $this->hasMany(ManualOption::class);
    }

    public function value()
    {
        return $this->hasOne(ManualValue::class);
    }
}