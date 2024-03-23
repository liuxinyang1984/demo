<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelTable extends Model
{
    use HasFactory;
    protected $table = 'level_table';
    protected $fillable=['id','name','phone','inviter_id','inviter_name','inviter_phone','level'];
}
