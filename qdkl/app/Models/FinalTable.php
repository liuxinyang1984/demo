<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalTable extends Model
{
    use HasFactory;
    protected $table = 'final_table';

    protected $primaryKey = 'user_id';
    protected $fillable=['id','name','phone','inviter_phone','level','user_id'];
    public function children(){
        return $this->hasMany(get_class($this),'inviter_phone','phone');
    }
}
