<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOld extends Model
{
    use HasFactory;
    protected $table = 'user_old';

    public function children(){
        return $this->hasMany(get_class($this),'inviter_id',$this->getKeyName());
    }
    public function inviter(){
        return $this->hasOne(get_class($this),$this->getKeyName(),'inviter_id');
    }
}
