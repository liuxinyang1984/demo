<?php

namespace Modules\Article\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Article\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable=['name','pid'];


    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }
    static public function getAll(){
        $tree = self::getTree();
        //dump($tree);
        $result = self::renameTree($tree);
        // echo "<pre>";
        // foreach($result as $name){
            // echo $name['name']."\n";
        // }
        // die;
        return $result;
    }
    static protected function getTree($pid=0){
        $categories = self::all();
        $data = [];
        foreach($categories as  $cate){
            if($cate->pid == $pid){
                $temp['id'] = $cate->id;
                $temp['pid']=$cate->pid;
                $temp['name']=$cate->name;
                $temp['children']=self::getTree($cate->id);
                $data[] = $temp;
            }
        }
        return $data;
    }
    static protected function renameTree($data,$cursor=0,$str='├'){
            $strLong = mb_strlen($str,'utf-8');
        //dump($cursor);
        foreach($data as $key => $child){
            if(count($data) == $key+1){
                $str = mb_substr($str,0,$strLong-1,'utf-8');
                $childStr=$str.'　'.'└';
                $str=$str.'└';
            }else{
                $str = mb_substr($str,0,$strLong-1,'utf-8');
                $childStr=$str.'│'.'├';
                $str=$str.'├';
            }
                        // if($child['name'] == 'BBB22'){
                            // dump($str,$first,$end,$childStr);
                        // }
            $temp['name']=$str.$child['name'];
            $temp['pid']=$child['pid'];
            $temp['depty']=$cursor;
            $result[$child['id']] = $temp;
            if(count($child['children'])> 0){
                $result = $result + self::renameTree($child['children'],$cursor+1,$childStr);
            }
        }

        return $result;
    }
    public function hasChild(){
        $categories = $this->all();
        //dd($this->id);
        foreach($categories as $category){
            if($category->pid == $this->id) return true;
        }
        return false;
    }
}
