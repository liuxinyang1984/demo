<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Book
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUserId($value)
 * @property-read \App\Http\Models\User|null $user
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $guarded=[];
    public $timestamps = false;
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
