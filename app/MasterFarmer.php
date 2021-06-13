<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterFarmer extends Model
{
    public function profile()
    {
        return $this->morphOne(Profile::class, 'model');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

//    public function profile()
//    {
//        return $this->belongsTo(Profile::class, 'profile_id');
//    }
}
