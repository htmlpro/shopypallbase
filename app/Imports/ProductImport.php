<?php

namespace App\Imports;

use App\Exports\ProductExports;
use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\ProductExport;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $data) {

            $row = [];
            foreach($data as $key => $value) {
                $row[$this->filterHeader($key)] =  $value;
            }

            $language_id      =   '1';
            $date_added	= date('Y-m-d h:i:s');
            // dd($request);
            $setting = new Setting();
            $myVarsetting = new SiteSettingController($setting);
            $myVaralter = new AlertController($setting);
            $languages = $myVarsetting->getLanguages();
        
            // $expiryDate = str_replace('/', '-', $row['expires_date);
            // $expiryDateFormate = strtotime($expiryDate);
        
            if($row['image_id'] != null){
              $uploadImage = $row['image_id'];
            }else{
                $uploadImage = '';
            }

            if($row['is_feature'] != null){
              $is_feature = $row['is_feature'];
            }else{
                $is_feature = '';
            }

            if ($row['products_type'] !== null) {
                $prod_type = $row['products_type'];
            } else {
                $prod_type = 0;
            }
            
            
            $products_id = DB::table('products')->insertGetId([
                'products_image' => $uploadImage,
                'manufacturers_id' => null,
                'products_quantity' => 0,
                'products_model' => $row['products_model'],
                'products_price' => $row['products_price'],
                'created_at' => now(),
                'products_weight' => $row['products_weight'],
                'products_status' => $row['products_status'],
                'products_tax_class_id' => 0,
                'products_weight_unit' =>  $row['products_weight_unit'],
                'low_limit' => 0,
                'products_slug' => Str::slug($row['products_name_1']),
                'products_type' => $prod_type,
                'is_feature' => $is_feature,
                'products_min_order'=> $row['products_min_order'],
			    'products_max_stock'=> $row['products_max_stock'],
                'products_video_link' => $row['products_video_link'],
                'is_current'         => 1
            ]);

            $i = 1;
            foreach($languages as $languages_data){
                $req_products_name = $row['products_name_'.$i] ;
                $req_products_url =  $row['products_url_'.$i];
                $req_products_description = $row['products_description_'.$i];
                DB::table('products_description')->insert([
                    'products_name' => $req_products_name,
                    'language_id' => $languages_data->languages_id,
                    'products_id' => $products_id,
                    'products_url' => $req_products_url,
                    'products_description' => addslashes($req_products_description)

                ]);
                $i++;
            }

            //flash sale product
            if($row['isflash'] == 'yes'){
                $startdate =$row['flash_start_date'];
                $starttime = $row['flash_start_time'];
                $start_date = str_replace('/','-',$startdate.' '.$starttime);
                $flash_start_date = strtotime($start_date);
                $expiredate = $row['flash_expires_date'];
                $expiretime = $row['flash_end_time'];
                $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
                $flash_expires_date = strtotime($expire_date);
                DB::table('flash_sale')->insert([
                    'products_id' => $products_id,
                    'flash_sale_products_price' => $row['flash_sale_products_price'],
                    'created_at' => $row['created_at'],
                    'flash_start_date' => $flash_start_date,
                    'flash_expires_date' => $flash_expires_date,
                    'flash_status' => $row['flash_status']
                ]);
            }

            //special product
            if($row['isspecial'] == 'yes'){
              DB::table('specials')
              ->where('products_id', '=', $products_id)
              ->update([
                  'specials_last_modified' => $date_added,
                  'date_status_change' => $date_added,
                  'status' => 0,
              ]);
              DB::table('specials')
              ->insert([
                  'products_id' => $products_id,
                  'specials_new_products_price' => $row['specials_new_products_price'],
                  'specials_date_added' => time(),
                  'expires_date' => $row['flash_expires_date'],
                  'status' => $row['status'],
              ]);

            }

            DB::table('products_to_categories')
                ->insert([
                'products_id' => $products_id,
                'categories_id' => $row['product_category_id']
            ]);

            
            // if ( $row['products_type'] == null) {
            //     $row['products_type'] = 0;
            // }

            // if ( $row['tax_class_id'] == null) {
            //     $row['tax_class_id'] = 0;
            // }

            // if ( $row['flash_created_at'] == null) {
            //     $row['flash_created_at'] = $row['created_at'];
            // }

            // if ( $row['flash_expires_date'] == null) {
            //     $row['flash_expires_date'] = $flash_start_date;
            // }

            // if ( $row['expires_date'] == null) {
            //     $row['expires_date'] = 0;
            // }

            // if ( $row['status'] == null) {
            //     $row['status'] = 0;
            // }
            

            // ProductExport::create([
            //     'products_type' => $row['products_type'],
            //     'products_id' => $row['products_id'],
            //     'product_category_id' => 0,
            //     'is_feature' => $row['is_feature'],
            //     'products_status' => $row['products_status'],
            //     'products_price' => $row['products_price'],
            //     'tax_class_id' => $row['tax_class_id'],
            //     'products_min_order' => $row['products_min_order'],
            //     'products_max_stock' => $row['products_max_stock'],
            //     'products_weight' => $row['products_weight'],
            //     'products_weight_unit' => $row['products_weight_unit'],
            //     'products_model' => $row['products_model'],
    
            //     'isFlash' => $row['isflash'],
            //     'flash_sale_products_price' => $row['flash_sale_products_price'],
            //     'flash_created_at' => $row['flash_created_at'],
            //     'flash_start_date' => $row['flash_start_date'],
            //     'flash_start_time' => $row['flash_start_time'],
            //     'flash_expires_date' => $row['flash_expires_date'],
            //     'flash_end_time' => $row['flash_end_time'],
            //     'flash_status' => $row['flash_status'],
            //     'isSpecial' => $row['isspecial'],
            //     'specials_new_products_price' => $row['specials_new_products_price'],
            //     'expires_date' => $row['expires_date'],
            //     'date_status_change' => $row['date_status_change'],
            //     'specials_last_modified' => $row['specials_last_modified'],
            //     'status' => $row['status'],
    
            //     'image_id' => $row['image_id'],
            //     'products_video_link' => $row['products_video_link'],
            //     'products_name_1' => $row['products_name_1'],
            //     'products_url_1' => $row['products_url_1'],
            //     'products_description_1' => $row['products_description_1'],
            //     'products_name_2' => $row['products_name_2'],
            //     'products_url_2' => $row['products_url_2'],
            //     'products_description_2' => $row['products_description_2'],
            // ]);
            
        }
    }

    public function filterHeader($header)
    {
        $setHeader = preg_replace('/[^a-zA-Z0-9_]/', '',str_replace(' ', '_', strtolower($header)));
        return $setHeader;
    }
}
