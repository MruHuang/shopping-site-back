<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommodityManagement\Commodity as CD;
use App\Model\species as SqeciesSQL;
use App\OrderManagement\Order as OD;
use App\Http\Requests\AddcommodityRequest;

use App\Model\groupbuy_commodity;
use Log;
use View;

class CommodityManagementController extends Controller
{
    //
    private $od;
    private $cd;
    private $SqeciesSQL;
    public function __construct(CD $cd,SqeciesSQL $SqeciesSQL,OD $od){
        $this->od = $od;
    	$this->cd = $cd;
        $this->SqeciesSQL  = $SqeciesSQL;
    }

    public function GetCommoditySpecies(
        $this_page = 1,
        $message_text = null
    ){
        $page_number = 20;
        $start_number = ($this_page-1)*$page_number+1;
        $end_number = $this_page*$page_number;

        $SqeciesData = $this->SqeciesSQL->GetAllSpecies()->get();
        $count_page = (int)(count($SqeciesData)/20)+1;

        $result = $this->SqeciesSQL->GetSpecies(
            $start_number,
            $end_number
        )->get();
        //return $result;
        return view('CommodityManagement',[
                'type'=>'Commodityspecies',
                'AllInformation'=>$result,
                'message_text'=>$message_text,
                'this_page'=>$this_page,
                'count_page'=>$count_page
                ]);
    }

    public function EditCommoditySpecies(Request $Request){
        $specise_name = $Request->input('specise_name');
        $specise_id = $Request->input('specise_id');
        $this_page = $Request->input('this_page');
        try{
            $this->SqeciesSQL::where('speciseID',$specise_id)
            ->update(['speciseName'=>$specise_name]);
            $message_text="修改成功";
        }catch(\Exception $e){
            $message_text="修改失敗，請try again。";
        }finally{
            return $this->GetCommoditySpecies($this_page,$message_text);
        }
    }

    public function AddCommoditySpecies(Request $Request){
        $specise_name = $Request->input('specise_name');

        $SqeciesData = $this->SqeciesSQL->GetAllSpecies()->get();
        $this_page = (int)(count($SqeciesData)/20)+1;

        try{
            $Species = new SqeciesSQL();
            $Species->speciseName = $specise_name;
            $Species->save();
            $message_text="新增成功";
        }catch(\Exception $e){
            $message_text="新增失敗，請try again。";
        }finally{
            return $this->GetCommoditySpecies($this_page,$message_text);
        }
    }

    public function AddCommodity($message_text = null,$delCookie = null){
        $result = $this->SqeciesSQL->GetShowSpecies()->get();
        //return $result;
        return view('CommodityManagement',[
                'message_text'=>null,
                'type'=>'Addcommodity',
                'AllInformation'=>$result,
                'message_text'=>$message_text,
                'delCookie'=>$delCookie
                ]);
    }

    public function GetCommodity(
        $page_type,
    	$type,
        $message_text = null,
        $message_data = null
	){
    	$result = $this->cd->CommodityData($type);
        //return $result;
        return View::make('CommodityManagement',['type'=>$page_type,'Area'=>$type,'AllInformation'=>$result,'message_text'=>$message_text,'message_data'=>$message_data]);
    }

    public function GetCountCommodity(
        $page_type,
        $type,
        $message_text = null,
        $message_data = null
    ){
    	$message_data = $this->cd->CountCommodity();
        $result = $this->cd->GetNotSoldCommodity();
    	//return $result;//view
        return View::make('CommodityManagement',['type'=>$page_type,'Area'=>$type,'AllInformation'=>$result,'message_text'=>$message_text,'message_data'=>$message_data]);
    }

    public function UpdateInventory(Request $Request){
        $commodityID = $Request->input('commodityID');
        $amount = $Request->input('Amount');
        $nowAmount = $Request->input('nowAmount');
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $message_text ='';
        if($nowAmount >= $amount){
            $message_text = '輸入的數量必須大於目前未售出量';
            return $this->GetCountCommodity($page_type,$type,$message_text);
        }else{
            $addAmount = $amount - $nowAmount;
            try{
                $this->cd->UpdateCommodityAmount($commodityID,$addAmount,'addition');
                $message_text = '更改成功';
            }catch(\Exception $e){
                $message_text = '更改失敗';
            }finally{
                return $this->GetCountCommodity($page_type,$type,$message_text);
            }
        }
        
    }

    public function AddingCommodity(
        AddcommodityRequest $Request
    ){
        //return $Request->all();
        //return $Request->file('commodityPhotoA');
        $action = $Request->input('action');
        $commodityName = $Request->input('commodity_name');
        $commodityPrice = $Request->input('commodity_price');
        $originalPrice = $Request->input('original_price');
        $speciseID = $Request->input('commodity_speciesID');
        $commodityAmount = $Request->input('commodity_amount');
        $commodityIntroduction = $Request->input('commodity_introduction');
        $commodityPhotoA = $Request->input('commodityPhotoA');
        $commodityPhotoB = $Request->input('commodityPhotoB');
        $commodityPhotoC = $Request->input('commodityPhotoC');
        $commodityPhotoD = $Request->input('commodityPhotoD');
        $commodityPhotoE = $Request->input('commodityPhotoE');
         //return asset("temp/".$commodityPhotoA);
        $delCookie = null;

        $File = fopen("temp/".$commodityPhotoA,"r")or die("Unable to open file!");
        $this->saveImage($commodityPhotoA,$File);
        $commodityPhotoA = 'img\\'.$commodityPhotoA;
        if($commodityPhotoB!=null){
            $File = fopen("temp/".$commodityPhotoB,"r")or die("Unable to open file!");
            $this->saveImage($commodityPhotoB,$File);
            $commodityPhotoB = 'img\\'.$commodityPhotoB;
        }
        if($commodityPhotoC!=null){
            $File = fopen("temp/".$commodityPhotoC,"r")or die("Unable to open file!");
            $this->saveImage($commodityPhotoC,$File);
            $commodityPhotoC = 'img\\'.$commodityPhotoC;
        }
        if($commodityPhotoD!=null){
            $File = fopen("temp/".$commodityPhotoD,"r")or die("Unable to open file!");
            $this->saveImage($commodityPhotoD,$File);
            $commodityPhotoD = 'img\\'.$commodityPhotoD;
        }
        if($commodityPhotoE!=null){
            $File = fopen("temp/".$commodityPhotoE,"r")or die("Unable to open file!");
            $this->saveImage($commodityPhotoE,$File);
            $commodityPhotoE = 'img\\'.$commodityPhotoE;
        }

        if($Request->input('commodity_video')!=null){
            // $youtuber = $Request->input('commodity_video');
            // $youtube_array = preg_split("/watch\?v=/",$youtuber);
            // if(count($youtube_array)!=2){
            //     $delCookie = 0;
            //     $message_text='影片格式錯誤';
            //     return $this->AddCommodity($message_text,$delCookie);
            // }
            // $commodityVideo = $youtube_array[0].'embed/'.$youtube_array[1];
            $youtuber = $Request->input('commodity_video');
            $youtube_array = preg_split("/watch\?v=/",$youtuber);
            if(count($youtube_array)!=2){
                $delCookie = 0;
                $message_text='影片格式錯誤';
                return $this->AddCommodity($message_text,$delCookie);
            }
            $text = substr($youtube_array[1],0,11);
            $commodityVideo = $youtube_array[0].'embed/'.$text;
        }else{
            $commodityVideo = null;
        }

        try{
            $this->cd->ActionCommodity(
                $action,
                $commodityName,
                $originalPrice,
                $commodityPrice,
                $speciseID,
                $commodityAmount,
                $commodityIntroduction,
                $commodityPhotoA,
                $commodityPhotoB,
                $commodityPhotoC,
                $commodityPhotoD,
                $commodityPhotoE,
                $commodityVideo
                );
            $message_text = "成功加入商品";
            $delCookie = 1;
        }catch(\Exception $e){
            $message_text = "加入商品失敗";
            $message_text= $e;
        }finally{
            return $this->AddCommodity($message_text,$delCookie);
        }
        
    }

    public function saveImage(
        $file_name,
        $file
    ){
        // $ftp = ftp_connect("163.13.127.89");
        // ftp_login($ftp, "imagefile", "postimage");
         $ftp = ftp_connect(env('FTP_HOST', null));
        ftp_login($ftp, env('FTP_USERNAME', null), env('FTP_PASSWORD', null));
        ftp_fput($ftp,$file_name, $file, FTP_BINARY); 
        ftp_close($ftp);
    }

    public function ShelvesCommodity(Request $Request)
    {
        //return $Request->All();
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $commodityID = $Request->input('ID');
        $IsShelves = $Request->input('ShelvesState');
        $message_text =null;
        try{
            $action = 'Shelves';
            $this->cd->ActionCommodity(
                $action,
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
                null,
                null,
                $IsShelves,
                null,
                null,
                $commodityID
            );
            $message_text = "更改成功";
        }catch(\Exception $e){
            $message_text = "更改失敗";
        }finally{
            return $this->GetCommodity($page_type,$type,$message_text);
        }
    }

    public function GetCommodityDetail(
        $page_type,
        $type,
        $commodity_type,
        $ID
    ){
        //return $page_type.$type.$ID;
        $message_data = null;
        $message_text = null;
        try{
            $message_data = $this->cd->GetCommodityDetail(
                $commodity_type,
                $ID
            );
            $message_data['species'] = $this->SqeciesSQL->GetShowSpecies()->get();
        }catch(\Exception $e){
            $message_text = "失敗";
        }finally{
            return $this->GetCommodity($page_type,$type,$message_text,$message_data);
        }

    }

    public function UpdateCommodity(Request $Request){
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $commodity_id = $Request->input('commodity_id');
        $commodity_name =  $Request->input('commodity_name');
        $commodity_speciesID =  $Request->input('commodity_speciesID');
        $original_price = $Request->input('original_price');
        $commodity_price =  $Request->input('commodity_price');
        $commodity_amount =  $Request->input('commodity_amount');
        $commodity_introduction =  $Request->input('commodity_introduction');

        $youtuber = $Request->input('commodity_video');
        if($youtuber==""){
            $commodity_video = null;
        }else{
            $youtube_array = preg_split("/watch\?v=/",$youtuber);
            if(count($youtube_array)==2){
                $text = substr($youtube_array[1],0,11);
                $commodity_video = $youtube_array[0].'embed/'.$text;
            }else{
                if(count(preg_split("/embed/",$youtuber))==2){
                    $commodity_video = $youtuber;
                }else{
                    $delCookie = 0;
                    $message_text='影片格式錯誤';
                    return $this->GetCommodity($page_type,$type,$message_text);
                }
            }
        }
        try{
            $action = 'update';
            $this->cd->ActionCommodity(
                $action,
                $commodity_name,
                $original_price,
                $commodity_price,
                $commodity_speciesID,
                $commodity_amount,
                $commodity_introduction,
                null,
                null,
                null,
                null,
                null,
                $commodity_video,
                null,
                null,
                null,
                $commodity_id
            );
            $message_text = "更改成功";
        }catch(\Exception $e){
            $message_text = "更改失敗";
            $message_text =$e;
        }finally{            
            return $this->GetCommodity($page_type,$type,$message_text);
        }

    }

    public function unShelves(Request $Request){
        //return $Request->all();
        // $groupbuyID = $Request->input('ID');
        // return $this->od->updateIsOrder($groupbuyID);

        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $message_text = null;
        if($type=='groupbuy'){
            try{
                $groupbuyID = $Request->input('ID');
                $action = 'unShelves';
                $isShelves = 0;
                $this->od->SetGroupbuyRemind($groupbuyID);
                $this->od->updateIsOrder($groupbuyID);
                $this->cd->ActionGroupbuy(
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
                $message_text = "更改成功";
            }catch(\Exception $e){
                $message_text = "更改失敗";
            }finally{
                return $this->GetCommodity($page_type,$type,$message_text);
            }
        }else{
            try{
                $limitedID = $Request->input('ID');
                $action = 'unShelves';
                $isShelves = 0;
                $this->cd->ActionLimited(
                    $action,
                    null,
                    null,
                    null,
                    $isShelves,
                    null,
                    null,
                    $limitedID
                );
                $nowLimitedAmountArray = $this->cd->getLimitedAmount($limitedID);
                $nowLimitedAmount = $nowLimitedAmountArray[0]['limitedAmount'];
                $commodityID = $nowLimitedAmountArray[0]['commodityID'];
                $this->cd->UpdateCommodityAmount(
                    $commodityID,
                    $nowLimitedAmount,
                    'addition'
                );
                $message_text = "更改成功";
            }catch(\Exception $e){
                $message_text = "更改失敗";
            }finally{
                //return $message_text;
                return $this->GetCommodity($page_type,$type,$message_text);
            }
        }

    }

    public function Shelves_Edit(Request $Request){
        //$Request->all();
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $post_type = $Request->input('post_type');
        $message_data = null;
        $message_text = null;
        if($post_type =='Shelves' ){
            $message_data['commodityID'] = $Request->input('ID');
            $message_data['commodiyName'] = $Request->input('commodity_name');
            if($type == 'groupbuy'){
                $message_data['groupbuyID'] = null;
                $message_data['groupbuyPrice'] = null;
                $message_data['offTime'] = null;
                $message_data['groupbuyAmountA'] = null;
                $message_data['groupbuyPriceA'] = null;
                $message_data['groupbuyAmountB'] = null;
                $message_data['groupbuyPriceB'] = null;
                $message_data['groupbuyAmountC'] = null;
                $message_data['groupbuyPriceC'] = null;
                $message_data['groupbuyAmountD'] = null;
                $message_data['groupbuyPriceD'] = null;

            }else if($type == 'timelimit'){
                $message_data['limitedID'] = null;
                $message_data['limitedPrice'] = null;
                $message_data['limitedAmount'] = null;
                $message_data['offTime'] = null;
            }
            $message_data['post_type']=$post_type;

            return $this->GetCommodity($page_type,$type,$message_text,$message_data);
        }if($post_type =='Edit'){
            try{
                $ID = $Request->input('ID');
                $message_data = $this->cd->GetCommodityDetail(
                    $type,
                    $ID
                );
                $message_data = $message_data[0];
                $message_data['commodiyName'] = $Request->input('commodity_name');
                //$message_data['species'] = $this->SqeciesSQL->GetAllSpecies()->get();
            }catch(\Exception $e){
                $message_text = "失敗";
            }finally{
                $message_data['post_type']=$post_type;
                return $this->GetCommodity($page_type,$type,$message_text,$message_data);
            }
        }
    }

    public function updateIsOrder(){
    }

    public function UpdateGroupbuydata(Request $Request){
        //return $Request->all();
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $post_type = $Request->input('post_type');
        $commodityID = $Request->input('commodity_id');
        $groupbuy_price = $Request->input('groupbuy_price');
        $offTime = $Request->input('offTime');
        $groupbuy_amountA = $Request->input('groupbuy_amountA');
        $groupbuy_priceA = $Request->input('groupbuy_priceA');
        $groupbuy_amountB = $Request->input('groupbuy_amountB');
        $groupbuy_priceB = $Request->input('groupbuy_priceB');
        $groupbuy_amountC = $Request->input('groupbuy_amountC');
        $groupbuy_priceC = $Request->input('groupbuy_priceC');
        $groupbuy_amountD = $Request->input('groupbuy_amountD');
        $groupbuy_priceD = $Request->input('groupbuy_priceD');
        $isShelves = 1;
        $addTime = date("Y-m-d");
        $message_data = null;
        $message_text = null;
        if($post_type == 'Shelves'){
            $action = 'insert';
            try{
                $this->cd->ActionGroupbuy(
                    $action,
                    $commodityID,
                    $groupbuy_price,
                    $isShelves,
                    $addTime,
                    $offTime,
                    $groupbuy_amountA,
                    $groupbuy_priceA,
                    $groupbuy_amountB,
                    $groupbuy_priceB,
                    $groupbuy_amountC,
                    $groupbuy_priceC,
                    $groupbuy_amountD,
                    $groupbuy_priceD,
                    null
                );
                $message_text = "新增成功";
            }catch(\Exception $e){
                $message_text = "失敗";
                //$message_text = $e;
            }finally{
                //return $message_text;
                return $this->GetCommodity($page_type,$type,$message_text,$message_data);
            }
        }else{
            if($post_type == 'Edit'){
                $action = 'update';
                $groupbuyID = $Request->input('groupbuy_id');
                try{
                    $this->cd->ActionGroupbuy(
                        $action,
                        $commodityID,
                        $groupbuy_price,
                        $isShelves,
                        $addTime,
                        $offTime,
                        $groupbuy_amountA,
                        $groupbuy_priceA,
                        $groupbuy_amountB,
                        $groupbuy_priceB,
                        $groupbuy_amountC,
                        $groupbuy_priceC,
                        $groupbuy_amountD,
                        $groupbuy_priceD,
                        $groupbuyID
                    );
                    $message_text = "修改成功";
                }catch(\Exception $e){
                    $message_text = "失敗";
                    //$message_text = $e;
                }finally{
                    //return $message_text;
                    return $this->GetCommodity($page_type,$type,$message_text,$message_data);
                }
            }
        }
    }
    
    public function UpdateLimiteddata(Request $Request){
        $page_type = $Request->input('page_type');
        $type = $Request->input('type');
        $post_type = $Request->input('post_type');
        $commodityID = $Request->input('commodity_id');
        $limitedPrice = $Request->input('limited_price');
        $limitedAmount = $Request->input('limited_amount');
        $isShelves = 1;
        $addTime = date("Y-m-d");
        $offTime = $Request->input('offTime');
        $message_data = null;
        $message_text = null;
        
        if($offTime==null){
            $message_text = "下架日期不可為空";
            return $this->GetCommodity($page_type,$type,$message_text,$message_data);
        }

        if($post_type == 'Shelves'){
            $action = 'insert';
            try{
                $is_update = $this->cd->UpdateCommodityAmount(
                    $commodityID,
                    $limitedAmount,
                    'reduce'
                );

                if($is_update){
                    $this->cd->ActionLimited(
                        $action,
                        $commodityID,
                        $limitedPrice,
                        $limitedAmount,
                        $isShelves,
                        $addTime,
                        $offTime,
                        null
                    );
                    $message_text = "新增成功";
                }else{
                    $message_text = "新增失敗";
                }
                
            }catch(\Exception $e){
                $message_text = "新增失敗";
                //$message_text = $e;
            }finally{
                //return $message_text;
                return $this->GetCommodity($page_type,$type,$message_text,$message_data);
            }
        }else{
            if($post_type == 'Edit'){
                $action = 'update';
                $limitedID = $Request->input('limited_id');
                try{
                    $nowLimitedAmountArray = $this->cd->getLimitedAmount($limitedID);
                    $nowLimitedAmount = $nowLimitedAmountArray[0]['limitedAmount'];
                    if($nowLimitedAmount>$limitedAmount){
                        $nowLimitedAmount = $nowLimitedAmount-$limitedAmount;
                        $is_update = $this->cd->UpdateCommodityAmount(
                            $commodityID,
                            $nowLimitedAmount,
                            'addition'
                        );
                    }else{
                        $nowLimitedAmount = $limitedAmount-$nowLimitedAmount;
                        $is_update = $this->cd->UpdateCommodityAmount(
                            $commodityID,
                            $nowLimitedAmount,
                            'reduce'
                        );
                    }
                    if($is_update){
                        $this->cd->ActionLimited(
                            $action,
                            $commodityID,
                            $limitedPrice,
                            $limitedAmount,
                            $isShelves,
                            $addTime,
                            $offTime,
                            $limitedID
                        );
                        $message_text = "修改成功";
                    }else{
                        $message_text = "修正資料不正確";
                    }
                }catch(\Exception $e){
                    $message_text = "修正資料不正確";
                    //$message_text = $e;
                }finally{
                    //return $message_text;
                    return $this->GetCommodity($page_type,$type,$message_text,$message_data);
                }
            }
        }
    }

    // public function test(){
    //     $groupbuyCommodityData = groupbuy_commodity::CheckOnShelves()->get();
    //     $nowTime = date('Y-m-d H:i:s');
    //     $message_text = null;
    //     for ($i=0; $i <count($groupbuyCommodityData) ; $i++) { 
    //         if(strtotime($groupbuyCommodityData[$i]['offTime'])<strtotime($nowTime)){
    //             //Log::info(strtotime($groupbuyCommodityData[$i]['offTime']).'-----'.strtotime($nowTime));
    //             //Log::info('下架');
    //             Log::info($groupbuyCommodityData[$i]['groupbuyID']);
    //             try{
    //                 $groupbuyID = $groupbuyCommodityData[$i]['groupbuyID'];
    //                 $action = 'unShelves';
    //                 $isShelves = 0;
    //                 $this->od->SetGroupbuyRemind($groupbuyID);
    //                 $this->od->updateIsOrder($groupbuyID);
    //                 $this->cd->ActionGroupbuy(
    //                     $action,
    //                     null,
    //                     null,
    //                     $isShelves,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     null,
    //                     $groupbuyID
    //                 );
    //                 $message_text = "更改成功";
    //             }catch(\Exception $e){
    //                 $message_text = "更改失敗";
    //             }finally{
    //                 Log::info($message_text);
    //             }
    //         }
    //         Log::info('檢查團購下架');
    //     }
    //     Log::info('檢查完畢');
    // }

    public function ActionGroupbuy(
    	$action = 'insert',
        
        $commodityID,
        $groupbuyPrice,
        $isShelves,
        $addTime,
        $offTime,
        $groupbuyAmountA,
        $groupbuyPriceA,
        $groupbuyAmountB,
        $groupbuyPriceB,
        $groupbuyAmountC,
        $groupbuyPriceC,
        $groupbuyAmountD,
        $groupbuyPriceD,

        $groupbuyID = null
    ){

    }

    public function ActionLimited(
    	$action = 'insert',
        
        $commodityID,
        $limitedPrice,
        $limitedAmount,
        $isShelves,
        $addTime,
        $offTime,

        $limitedID
    ){

    }

    public function DeleteCommodity($page_type,$type,$ID){
        //return $ID;
        $message_text = null;
        $result = $this->cd->DeleteCommodity($ID);
        if(!$result){
            $message_text = "請下架完商品後，再進行刪除的動作";
        }
        return $this->GetCommodity($page_type,$type,$message_text);
    }

}
