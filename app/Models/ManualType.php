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

  public function scopeValueByuser($query, $user_id)
  {
    return $query->with(['manuals' => function ($query) use ($user_id){
      return $query->with(['value' => function ($query) use ($user_id){
          return $query->whereUserId($user_id);
      }]);
  }]);
  }
}