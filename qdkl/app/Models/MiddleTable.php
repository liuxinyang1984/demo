<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleTable extends Model
{
    use HasFactory;
    protected $table = 'middle_table';
    protected $fillable=['id','name','phone','inviter_id','inviter_name','inviter_phone','level'];
}