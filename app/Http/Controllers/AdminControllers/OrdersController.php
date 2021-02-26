<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\AdminControllers\ProductController;
use App\Http\Controllers\Controller;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Models\Core\Order;
use App\Models\Core\User;
use App\Models\Core\Products;
use App\Models\Core\Coupon;
use App\Models\Core\Tax_class;
use DataTables;

class OrdersController extends Controller
{
    //
    public function __construct( Setting $setting, Order $order )
    {
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
        $this->Order = $order;
    }

    //add listingOrders
    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingOrders"));        

        $message = array();
        $errorMessage = array();        
        
		if ($request->ajax()) {
			$data = $this->Order->orders_datatable();
			//print_r($data);
			return Datatables::of($data)
					->addIndexColumn()
					->addColumn('action', function($row){
						$actionBtn = '<a data-toggle="tooltip" data-placement="bottom" title="" href="vieworder/'.$row->orders_id.'" class="badge bg-light-blue" data-original-title="View Order"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id="'.$row->orders_id.'" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>';
						return $actionBtn;
					})
					->rawColumns(['action'])
					->make(true);
		}else {
			$ordersData['orders'] = $this->Order->paginator();
			$ordersData['message'] = $message;
			$ordersData['errorMessage'] = $errorMessage;
			$ordersData['currency'] = $this->myVarsetting->getSetting();
			$ordersData['savedViews'] = User::find(1)->savedOrderViews;
			//print_r($ordersData['savedViews']);
			$result['commonContent'] = $this->Setting->commonContent();
			return view("admin.Orders.index", $title)->with('listingOrders', $ordersData)->with('result', $result);
		}
        
    }

    //view order detail
    public function vieworder(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ViewOrder"));
        $message = array();
        $errorMessage = array();

        //orders data
        $ordersData = $this->Order->detail($request);        

        // current order status
        $orders_status_history = $this->Order->currentOrderStatus($request);  

        //all statuses 
        $orders_status = $this->Order->orderStatuses();  
        
        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;

        //get function from other controller
        $ordersData['currency'] = $this->myVarsetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();

        //dd($ordersData);

        return view("admin.Orders.vieworder", $title)->with('data', $ordersData)->with('result', $result);
    }

    //update order
    public function updateOrder(Request $request)
    {

        $orders_status = $request->orders_status;
        $old_orders_status = $request->old_orders_status;

        $comments = $request->comments;
        $orders_id = $request->orders_id;

        //get function from other controller
        $setting = $this->myVarsetting->getSetting();       

        if ($old_orders_status == $orders_status) {
            return redirect()->back()->with('error', Lang::get("labels.StatusChangeError"));
        } else {
            //update order
            $orders_status = $this->Order->updateRecord($request);  
            return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
        }

    }

    //deleteorders
    public function deleteOrder(Request $request)
    {       
        //reverse stock
        $this->Order->reverseStock($request);     
        $this->Order->deleteRecord($request);
        
        return redirect()->back()->withErrors([Lang::get("labels.OrderDeletedMessage")]);
    }

    //view order detail
    public function invoiceprint(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ViewOrder"));
        $language_id = '1';
        $orders_id = $request->id;

        $message = array();
        $errorMessage = array();

        DB::table('orders')->where('orders_id', '=', $orders_id)
            ->where('customers_id', '!=', '')->update(['is_seen' => 1]);

        $order = DB::table('orders')
            ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

        foreach ($order as $data) {
            $orders_id = $data->orders_id;

            $orders_products = DB::table('orders_products')
                ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                ->select('orders_products.*', 'products.products_image as image')
                ->where('orders_products.orders_id', '=', $orders_id)->get();
            $i = 0;
            $total_price = 0;
            $total_tax = 0;
            $product = array();
            $subtotal = 0;
            foreach ($orders_products as $orders_products_data) {

                //categories
                $categories = DB::table('products_to_categories')
                    ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                    ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                    ->where('products_id', '=', $orders_products_data->orders_products_id)
                    ->where('categories_description.language_id', '=', $language_id)->get();

                $orders_products_data->categories = $categories;

                $product_attribute = DB::table('orders_products_attributes')
                    ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                    ])
                    ->get();

                $orders_products_data->attribute = $product_attribute;
                $product[$i] = $orders_products_data;
                $total_price = $total_price + $orders_products[$i]->final_price;

                $subtotal += $orders_products[$i]->final_price;

                $i++;
            }
            $data->data = $product;
            $orders_data[] = $data;
        }

        $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->orderBy('orders_status_history.date_added', 'desc')
            ->where('orders_id', '=', $orders_id)->get();

        $orders_status = DB::table('orders_status')->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)->get();

        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;
        $ordersData['subtotal'] = $subtotal;

        //get function from other controller

        $ordersData['currency'] = $this->myVarsetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.Orders.invoiceprint", $title)->with('data', $ordersData)->with('result', $result);

    }

    public function assignOrders(Request $request)
    {
        $orders = $this->Order->assignOrders($request);
        return redirect()->back()->with('message', Lang::get("labels.Orders successfully assigned to the delivery boy"));
    }

	public function addOrder(Request $request)
    {
		$title = array('pageTitle' => Lang::get("labels.NewOrder"));
		$customers = User::getCustomers();
		$products = Products::find(1)->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('manufacturers', function ($join) {
                $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
            })

            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
            })
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })->get(); //where('products_status', 1);
		//print_r($products);
		//exit;
		
		$result['commonContent'] = $this->Setting->commonContent();
        return view("admin.Orders.addorder", $title)->with('result', $result)->with("customers", $customers)->with("products", $products);
    }
}
