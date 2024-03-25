<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $table = 'qimall_addons_agent';
    protected $fillable= ['level','user_id','mall_id'];
    public $timestamps = false;
}
