<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\User
 *
 * @property int $id 自动编号
 * @property string $username
 * @property string $password
 * @property string $gender
 * @property string|null $email
 * @property string $price
 * @property string $details
 * @property int|null $uid
 * @property int $status 状态
 * @property mixed|null $list
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 修改时间
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @property-read \App\Http\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Http\Models\Book> $book
 * @property-read int|null $book_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Http\Models\Role> $role
 * @property-read int|null $role_count
 * @mixin \Eloquent
 */
class User extends Model
{
    use HasFactory;
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function book(){
        return $this->hasMany(Book::class);
    }
    public function role(){
        return $this->belongsToMany(Role::class)->withPivot('details','id');
    }
}
