<?php
namespace app\controller;

use app\model\Users;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController{
    public function make(){
        ini_set ('memory_limit',  '512M');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet_header = ['用户编号','昵称','用户名','提货币','注册币余额','手机号','登陆时间'];
        //写入表头
        foreach($sheet_header as $key => $val){
            $key=$key+1;
            $cell = $sheet->getCellByColumnAndRow($key,1);
            $cell->setValue($val);
        }

        //写入数据
        echo "<h1>MakeExcelFile</h1>";
        echo "<pre>";
        echo "开始写入数据>";
        $cell_cursor = 2;
        foreach(Users::where('id','>','83850')->limit(2)->cursor() as $user_key =>$user_val){
            echo "<h2>".$user_key."</h2>";

            $row = [$user_val->usercode,$user_val->nickname,$user_val->username,$user_val->money,$user_val->register_money,$user_val->phone,$user_val->updated_at];
            foreach($row as $row_key => $row_val){
                $cell = $sheet->getCellByColumnAndRow($row_key+1,$cell_cursor);
                $cell->setValue($row_val);
            }
            $cell_cursor ++;
        }
        //var_dump($rows);


        //写入文件

        $filepath = public_path()."User.xlsx";
        $excel =  new Xlsx($spreadsheet);
        $excel->save($filepath);
        echo $filepath;
        
    }
}
