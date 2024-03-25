<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelLiu extends Model
{
    use HasFactory;
    protected $table = 'level_liu';
    protected $appends = [
        'realLevel'
    ];

    public function getRealLevelAttribute(){
        switch($this->level){
        case "普通用户":
            return 0;
            break;
        case "VIP":
            return 1;
            break;
        case "V1":
            return 2;
            break;
        case "V2":
            return 3;
            break;
        case "V3":
            return 4;
            break;
        case "V4":
            return 5;
            break;
        case "V5":
            return 6;
            break;
        case "V6":
            return 7;
            break;
        case "V7":
            return 8;
            break;
        case "V8":
            return 9;
            break;
        default:
            dd($this->level);
        }
    }

}
