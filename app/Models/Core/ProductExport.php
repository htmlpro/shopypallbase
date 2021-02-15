<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductExport extends Model
{
    protected $fillable = [
        'products_type','products_id', 'product_category_id','is_feature','products_status','products_price','tax_class_id','products_min_order','products_max_stock','products_weight','products_weight_unit','products_model','image_id','products_video_link','products_name_1','products_url_1' ,'products_description_1','products_name_2' ,'products_url_2' ,'products_description_2','isFlash','flash_sale_products_price','flash_start_date','flash_start_time','flash_expires_date','flash_end_time','flash_status','isSpecial','specials_new_products_price','flash_created_at','expires_date','status'];
    
    public function insert($request,$product_id){
      
		$date_added	= date('Y-m-d h:i:s');
		$createdDate = strtotime($date_added);
		// dd($request);
		$expiryDate = str_replace('/', '-', $request->expires_date);
		$expiryDateFormate = strtotime($expiryDate);
	
		if($request->isFlash == 'yes'){
			$startdate = $request->flash_start_date;
			$starttime = $request->flash_start_time;
			$flashStartTime = strtotime($starttime);
			$start_date = str_replace('/','-',$startdate.' '.$starttime);
			$flash_start_date = strtotime($start_date);
			$expiredate = $request->flash_expires_date;
			$expiretime = $request->flash_end_time;
			$flashEndTime = strtotime($expiretime);
			$expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
			$flash_expires_date = strtotime($expire_date);
		}
		else
		{
			$flash_start_date = 0;
			$flash_expires_date = 0;
			$flashStartTime = 0;
			$flashEndTime =0;
		}

		if($request->isSpecial == 'no'){
			 $date_added = 0;
		}

        ProductExport::create([
            'products_type' => $request->products_type,
            'products_id' => $product_id,
			'product_category_id' => $request->categories[0],
			'is_feature' => $request->is_feature,
			'products_status' => $request->products_status,
			'products_price' => $request->products_price,
			'tax_class_id' => $request->tax_class_id,
			'products_min_order' => $request->products_min_order,
			'products_max_stock' => $request->products_max_stock,
			'products_weight' => $request->products_weight,
			'products_weight_unit' => $request->products_weight_unit,
			'products_model' => $request->products_model,

			'isFlash' => $request->isFlash,
			'flash_sale_products_price' => $request->flash_sale_products_price,
			'flash_created_at' => $createdDate,
			'flash_start_date' =>$flash_start_date,
			'flash_start_time' => $flashStartTime,
			'flash_expires_date' => $flash_expires_date,
			'flash_end_time' => $flashEndTime,
			'flash_status' => $request->flash_status,
			'isSpecial' => $request->isSpecial,
			'specials_new_products_price' => $request->specials_new_products_price,
			'expires_date' => $expiryDateFormate,
			'date_status_change' =>$createdDate,
			'specials_last_modified' => $createdDate,
			'status' => $request->status,

			'image_id' => $request->image_id,
			'products_video_link' => $request->products_video_link,
			'products_name_1' => $request->products_name_1,
			'products_url_1' => $request->products_url_1,
			'products_description_1' => $request->products_description_1,
			'products_name_2' => $request->products_name_2,
			'products_url_2' => $request->products_url_2,
			'products_description_2' => $request->products_description_2,
        ]);
        // dd($request);
    }

	public function updateProduct($request){
		// dd($request);
		$product_id = $request->id;
		$product = ProductExport::where('products_id',$product_id)->first();


		$date_added	= date('Y-m-d h:i:s');
		$createdDate = strtotime($date_added);
		// dd($request);
		$expiryDate = str_replace('/', '-', $request->expires_date);
		$expiryDateFormate = strtotime($expiryDate);
	
		if($request->isFlash == 'yes'){
			$startdate = $request->flash_start_date;
			$starttime = $request->flash_start_time;
			$flashStartTime = strtotime($starttime);
			$start_date = str_replace('/','-',$startdate.' '.$starttime);
			$flash_start_date = strtotime($start_date);
			$expiredate = $request->flash_expires_date;
			$expiretime = $request->flash_end_time;
			$flashEndTime = strtotime($expiretime);
			$expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
			$flash_expires_date = strtotime($expire_date);
		}
		else
		{
			$flash_start_date = 0;
			$flash_expires_date = 0;
			$starttime = 0;
			$expiretime =0;
		}

		if($request->isSpecial == 'no'){
			 $date_added = 0;
		}

		if($request->image_id !== null){
			$uploadImage = $request->image_id;
		}else{
			$uploadImage = $request->oldImage;
		}

		if ($product) {
			$product->update([
				'products_type' => $request->products_type,
				'products_id' => $product_id,
				'product_category_id' => $request->categories[0],
				'is_feature' => $request->is_feature,
				'products_status' => $request->products_status,
				'products_price' => $request->products_price,
				'tax_class_id' => $request->tax_class_id,
				'products_min_order' => $request->products_min_order,
				'products_max_stock' => $request->products_max_stock,
				'products_weight' => $request->products_weight,
				'products_weight_unit' => $request->products_weight_unit,
				'products_model' => $request->products_model,

				'isFlash' => $request->isFlash,
				'flash_sale_products_price' => $request->flash_sale_products_price,
				'flash_created_at' => $createdDate,
				'flash_start_date' =>$flash_start_date,
				'flash_start_time' => $flashStartTime,
				'flash_expires_date' => $flash_expires_date,
				'flash_end_time' => $flashEndTime,
				'flash_status' => $request->flash_status,
				'isSpecial' => $request->isSpecial,
				'specials_new_products_price' => $request->specials_new_products_price,
				'expires_date' => $expiryDateFormate,
				'date_status_change' =>$createdDate,
				'specials_last_modified' => $createdDate,
				'status' => $request->status,

				'image_id' => $uploadImage,
				'products_video_link' => $request->products_video_link,
				'products_name_1' => $request->products_name_1,
				'products_url_1' => $request->products_url_1,
				'products_description_1' => $request->products_description_1,
				'products_name_2' => $request->products_name_2,
				'products_url_2' => $request->products_url_2,
				'products_description_2' => $request->products_description_2,
			]);
		} 
    }

    public function deleteProd($id){
        $find = ProductExport::where('products_id',$id)->first();

        if ($find) {
            $find->delete();
        }
    }

}
