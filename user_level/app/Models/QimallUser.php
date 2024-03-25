<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QimallUser extends Model
{
    use HasFactory;
    protected $table = 'qimall_user';

    public function agent(){
        return $this->hasOne(Agent::class,'user_id','id');
    }
}
