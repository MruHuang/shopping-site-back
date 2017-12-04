<?php
namespace App\AutoUnshelveGroupbuy;

use Log;
use App\Model\groupbuy_commodity;
use App\CommodityManagement\Commodity as CD;
use App\OrderManagement\Order as OD;
use DateTime;
class AutoUnshelveGroupbuy
{

	// public static function test(){
	// 	$test = 'test123';
 	//Log::info($test);
	// }

	public static function unshelveGroupbuy(){
		$groupbuyCommodityData = groupbuy_commodity::CheckOnShelves()->get();
        $nowTime = date('Y-m-d');
        $message_text = null;
        for ($i=0; $i <count($groupbuyCommodityData) ; $i++) {
        	if($groupbuyCommodityData[$i]['offTime']!=null){
        		if($groupbuyCommodityData[$i]['offTime'] < $nowTime){
	                //Log::info(strtotime($groupbuyCommodityData[$i]['offTime']).'-----'.strtotime($nowTime));
	                //Log::info('下架');
	                Log::info($groupbuyCommodityData[$i]['groupbuyID']);
	                try{
	                    $groupbuyID = $groupbuyCommodityData[$i]['groupbuyID'];
	                    $action = 'unShelves';
	                    $isShelves = 0;
	                    OD::Static_SetGroupbuyRemind($groupbuyID);
	                    $message_text = OD::Static_updateIsOrder($groupbuyID);
	                    CD::Static_ActionGroupbuy(
	                        $action,
	                        null,
	                        null,
	                        $isShelves,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        null,
	                        $groupbuyID
	                    );
	                    //$message_text = "更改成功";
	                }catch(\Exception $e){
	                    $message_text = "更改失敗";
	                    Log::info($e);
	                }finally{
	                    Log::info($message_text);
	                }
	            }
	            Log::info('檢查團購下架');
        	}else{
        		Log::info('未設定下架時間');
        	}
        }
        Log::info('檢查完畢');
	}
}