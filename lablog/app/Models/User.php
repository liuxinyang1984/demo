<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'mobile',
        'nickname',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    // 查看当前用户的粉丝
    public function follower(){
        return $this->belongsToMany(User::class,'follows','follower','user_id');
    }
    // 查看当前用户关注的用户
    public function following(){
        return $this->belongsToMany(User::class,'follows','user_id','follower');
    }

    // 当前用户是否关注该用户(id)
    public function isFollow($uid){
        //echo "<pre>";
        //echo "isFollow()\n";
        //echo "uid:".$uid."\n";

        //echo "当前用户:".$this->id;
        //$res = $this->following()->get();
        //dd($res);

        return $this->following()->wherePivot('follower',$uid)->first();
    }

    // 关注或者取关
    public function followToggle($ids){
        $ids = is_array($ids)?:[$ids];
        $this->following()->withTimestamps()->toggle($ids);
    }
}
