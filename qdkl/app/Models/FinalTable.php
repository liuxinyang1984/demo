<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalTable extends Model
{
    use HasFactory;
    protected $table = 'final_table';
    protected $fillable=['id','name','phone','inviter_phone','level'];
}
