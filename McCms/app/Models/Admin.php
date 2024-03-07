<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Traits\HasRoles;

class Admin extends User
{
    use HasFactory,HasRoles;
}
