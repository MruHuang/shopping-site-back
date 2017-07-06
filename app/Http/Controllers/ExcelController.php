<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintReport\PrintReport;
use Excel;

class ExcelController extends Controller
{
    //Excel文件导出功能 By Laravel学院
    private $pr;

    public function __construct(PrintReport $pr){
        $this->pr = $pr;
    }

    public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    public function PostPrintReport(Request $Request){
        //return $Request->All();
        $report_type = $Request->input('report_type');
        $date_start = $Request->input('date_start');
        $date_end = $Request->input('date_end');
        if($report_type == 'sales_Details'){
            $data = $this->pr->SalesDetails();
            $excel_title = '銷售明細';
        }else if($report_type == 'daily_Shipments_Person'){
            //一個日期
            $data = $this->pr->DailyShipmentsPerson($date_start);
            $excel_title = '每日出貨明細(人)';
        }else if($report_type == 'daily_Shipments_Commodity'){
            //一個日期
            $data = $this->pr->DailyShipmentsCommodity($date_start);
            $excel_title = '每日出貨明細(物)';
        }else if($report_type == 'daily_Pay'){
            //一個日期
            $data = $this->pr->DailyPay($date_start);
            $excel_title = '每日貨款收入統計';
        }else if($report_type == 'single_Sales_Details'){
            //兩個日期
            $data = $this->pr->SingleSalesDetails($date_start,$date_end);
            $excel_title = '單項商品銷售明細';
        }else if($report_type == 'VIP'){
            //兩個日期
            $data = $this->pr->VIP($date_start,$date_end);
            $excel_title = 'VIP客戶';
        }else{
            $data = $this->pr->MemberIntegral($date_start);
            $excel_title = '會員紅利';
        }
        //return $data;
        $this->ExcelExport($data,$excel_title);
    }

    public function ExcelExport($data,$excel_title){
        Excel::create('藍星報表',function($excel) use ($data,$excel_title){
            $excel->sheet($excel_title, function($sheet) use ($data){
                $sheet->rows($data);
            });
        })->export('xls');
    }
}
