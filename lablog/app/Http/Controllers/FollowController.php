<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follower(User $user){
        $users = $user->follower()->paginate(10);
        $title = "粉丝列表";
        return view('user.follow',compact('user','users','title'));
    }
    public function following(User $user){
        $users = $user->following()->paginate(10);
        $title = "关注列表";
        return view('user.follow',compact('user','users','title'));

    }
}
