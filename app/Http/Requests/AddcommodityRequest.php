<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddcommodityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'commodity_name'=>'required|string',
            'commodity_price'=>'required|numeric',
            'commodity_amount'=>'required|numeric',
            'commodityPhotoA'=>'required|string'
        ];
    }

    public function messages()
    {
        return [
            'commodity_name.required' =>'請輸入商品名稱',
            'commodity_price.required'=>'請輸入商品價錢',
            'commodity_price.numeric'=>'商品價錢必須為數字',
            'commodity_amount.required'=>'請輸入商品數量',
            'commodity_amount.numeric'=>'商品數量必須為數字',
            'commodityPhotoA.required'=>'請選擇上傳的圖片',
            'commodityPhotoA.image'=>'上傳的圖片必須為圖檔'
        ];

    }
}
