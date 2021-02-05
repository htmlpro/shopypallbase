<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductExport extends Model
{
    protected $fillable = [
        'products_type','products_id', 'product_category_id','is_feature','products_status','products_price','tax_class_id','products_min_order','products_max_stock','products_weight','products_weight_unit','products_model','image_id','products_video_link','products_name_1','products_url_1' ,'products_description_1','products_name_2' ,'products_url_2' ,'products_description_2' ];
    
    public function insert($request,$product_id){
      
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

    public function deleteProd($id){
        $find = ProductExport::where('products_id',$id)->first();

        if ($find) {
            $find->delete();
        }
    }

}
