<?php

namespace App\Imports;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
        
            // $expiryDate = str_replace('/', '-', $request->expires_date);
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
                'products_slug' => 0,
                'products_type' => $prod_type,
                'is_feature' => $is_feature,
                'products_min_order'=> $row['products_min_order'],
			    'products_max_stock'=> $row['products_max_stock'],
                'products_video_link' => $row['products_video_link'],
                'is_current'         => 1
            ]);

            $slug_flag = false;
            $i = 1;
            foreach($languages as $languages_data){
                $products_name = 'products_name_'.$languages_data->languages_id;
                $products_url = 'products_url_'.$languages_data->languages_id;
                $products_description = 'products_description_'.$languages_data->languages_id;
                //left banner
                $products_left_banner = 'products_left_banner_'.$languages_data->languages_id;
                $products_left_banner_start_date = 'products_left_banner_start_date_'.$languages_data->languages_id;
                // if(!empty($request->$products_left_banner_start_date)){
                //     $leftStartDate = str_replace('/', '-', $request->$products_left_banner_start_date);
                //     $leftStartDateFormat = strtotime($leftStartDate);
                // }else{
                //     $leftStartDateFormat = null;
                // }
                //expire date
                // $products_left_banner_expire_date = 'products_left_banner_expire_date_'.$languages_data->languages_id;
                // if(!empty($request->$products_left_banner_expire_date)){
                //     $leftExpiretDate = str_replace('/', '-', $request->$products_left_banner_expire_date);
                //     $leftExpireDateFormat = strtotime($leftExpiretDate);
                // }else{
                //     $leftExpireDateFormat = null;
                // }
                //right banner
                // $products_right_banner = 'products_right_banner_'.$languages_data->languages_id;
                // $products_right_banner_start_date = 'products_right_banner_start_date_'.$languages_data->languages_id;
                // if(!empty($request->$products_right_banner_start_date)){
                //     $rightStartDate = str_replace('/', '-', $request->$products_right_banner_start_date);
                //     $rightStartDateFormat = strtotime($rightStartDate);
                // }else{
                //     $rightStartDateFormat = null;
                // }
                //expire date
                // $products_right_banner_expire_date = 'products_right_banner_expire_date_'.$languages_data->languages_id;
                // if(!empty($request->$products_right_banner_expire_date)){
                //     $rightExpiretDate = str_replace('/', '-', $request->$products_right_banner_expire_date);
                //     $rightExpireDateFormat = strtotime($rightExpiretDate);
                // }else{
                //     $rightExpireDateFormat = null;
                // }
                // //slug
                // if($slug_flag==false){
                //     $slug_flag=true;
                //     $slug = $request->$products_name;
                //     $old_slug = $request->$products_name;
                //     $slug_count = 0;
                //     do{
                //         if($slug_count==0){
                //             $currentSlug = $myVarsetting->slugify($slug);
                //         }else{
                //             $currentSlug = $myVarsetting->slugify($old_slug.'-'.$slug_count);
                //         }
                //         $slug = $currentSlug;
                //         $checkSlug = DB::table('products')->where('products_slug', $currentSlug)->get();
                //         $slug_count++;
                //     }
                //     while(count($checkSlug)>0);
                //     DB::table('products')
                //     ->where('products_id', $products_id)
                //     ->update([
                //         'products_slug' => $slug
                //     ]);
                // }

                // if($request->$products_left_banner !== null){
                //     $leftBanner = $request->$products_left_banner;
                // }else{
                //     $leftBanner = '';
                // }
                // if($request->$products_right_banner !== null){
                //     $rightBanner = $request->$products_right_banner;
                // }else{
                //     $rightBanner = '';
                // }
                $req_products_name = $row['products_name_'.$i] ;
                $req_products_url =  $row['products_url_'.$i];
                $req_products_description = $row['products_description_'.$i];
                DB::table('products_description')->insert([
                    'products_name' => $req_products_name,
                    'language_id' => $languages_data->languages_id,
                    'products_id' => $products_id,
                    'products_url' => $req_products_url,
                    // 'products_left_banner' => ,
                    // 'products_left_banner_start_date' => $leftStartDateFormat,
                    // 'products_left_banner_expire_date' => $leftExpireDateFormat,
                    // 'products_right_banner' => $rightBanner,
                    // 'products_right_banner_start_date' => $rightStartDateFormat,
                    // 'products_right_banner_expire_date' => $rightExpireDateFormat,
                    'products_description' => addslashes($req_products_description)

                ]);
                $i++;
            }

            //flash sale product
            // if($request->isFlash == 'yes'){
            //     $startdate = $request->flash_start_date;
            //     $starttime = $request->flash_start_time;
            //     $start_date = str_replace('/','-',$startdate.' '.$starttime);
            //     $flash_start_date = strtotime($start_date);
            //     $expiredate = $request->flash_expires_date;
            //     $expiretime = $request->flash_end_time;
            //     $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
            //     $flash_expires_date = strtotime($expire_date);
            //     DB::table('flash_sale')->insert([
            //         'products_id' => $products_id,
            //         'flash_sale_products_price' => $request->flash_sale_products_price,
            //         'created_at' => $date_added,
            //         'flash_start_date' => $flash_start_date,
            //         'flash_expires_date' => $flash_expires_date,
            //         'flash_status' => $request->flash_status
            //     ]);
            // }

            // //special product
            // if($request->isSpecial == 'yes'){
            //   DB::table('specials')
            //   ->where('products_id', '=', $products_id)
            //   ->update([
            //       'specials_last_modified' => $date_added,
            //       'date_status_change' => $date_added,
            //       'status' => 0,
            //   ]);
            //   DB::table('specials')
            //   ->insert([
            //       'products_id' => $products_id,
            //       'specials_new_products_price' => $request->specials_new_products_price,
            //       'specials_date_added' => time(),
            //       'expires_date' => $expiryDateFormate,
            //       'status' => $request->status,
            //   ]);

            // }
            // foreach($request->categories as $categories){
                    DB::table('products_to_categories')
                        ->insert([
                        'products_id' => $products_id,
                        'categories_id' => $row['product_category_id']
                    ]);
            // }
            //     $options = DB::table('products_options')
            //         ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
            //         ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
            //         ->where('products_options_descriptions.language_id', $language_id)
            //         ->get();

            //     if(!empty($options) and count($options)>0){
            //     $result['options'] = $options;
            //     }else{
            //         $result['options'] = '';
            //     }

            //     $options_value = DB::table('products_options_values')
            //     ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
            //     ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
            //     ->where('products_options_values_descriptions.language_id', '=', $language_id)
            //     ->get();
            //     if(!empty($options_value) and count($options_value)>0){
            //     $result['options_value'] = $options_value;
            // }else{
            //     $result['options_value'] = '';
            // }
        }
    }

    public function filterHeader($header)
    {
        $setHeader = preg_replace('/[^a-zA-Z0-9_]/', '',str_replace(' ', '_', strtolower($header)));
        return $setHeader;
    }
}
