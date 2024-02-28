<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        //$user = User::find(2);
        //\Mail::to($user)->send(new TestMail());
        return view('home');
    }
}
