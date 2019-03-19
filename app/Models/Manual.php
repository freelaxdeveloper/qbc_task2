<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ManualOption;
use App\Models\ManualValue;
use App\Models\ManualType;

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

    public function manualType()
    {
        return $this->belongsTo(ManualType::class);
    }
}