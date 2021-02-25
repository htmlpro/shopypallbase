@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <small>Analytics</small>
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Total Sales</h3>
                <h4>{{count($result['completed_orders'])}}</h4>
                <hr/>
                <p>Last 30 Days <a class="float-right" href="{{ URL::to('admin/orders/display')}}">View Report</a></p>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->

            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Sale Amount</h3>
                <h4>
                  @if(count($result['total_sales_currency_wise']) > 0)
                  @foreach($result['total_sales_currency_wise'] as $key => $sales)
                  $ {{ number_format($sales->sale,2) }} 

                  @if($key !== count($result['total_sales_currency_wise']))
                  <br />
                  @endif
                  @endforeach
                  @else
                  0
                  @endif
                </h4>
                <hr/>
                <p>Last 30 Days <a class="float-right" href="{{ URL::to('admin/orders/display')}}">View Report</a></p>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->

            </div>
          </div>
        </div>

        
        
      </div>
      <div class="col-md-5">
        <div class="box box-danger border-top-none card">

          <!-- /.box-header -->
          <div class="box-body padding-0">
            <h3 class="box-title"> {{ trans('labels.RecentlyAddedProducts') }}</h3>
            <br/>
            <div class="row">
              <div class="col-md-12">
                <ul class="products-list product-list-in-box">
                @foreach($result['recentProducts'] as $recentProducts)
                <li class="item">
                  <div class="product-img">
                    <img src="{{asset('').$recentProducts->products_image}}" alt="" width=" 100px" height="100px">
                  </div>
                  <div class="product-info">
                    <a href="{{ URL::to('admin/products/edit') }}/{{ $recentProducts->products_id }}" class="product-title">{{ $recentProducts->products_name }}
                      <span class="label label-warning label-succes pull-right">
                        @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ floatval($recentProducts->products_price) }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                      </span></a>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="box-footer text-center">
                <a href="{{ URL::to('admin/products/display') }}" class="uppercase" data-toggle="tooltip" data-placement="bottom" title="View All Products">{{ trans('labels.viewAllProducts') }}</a>
              </div>
              
            </div>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->

        </div>



      </div>
    </div>
    
    <div class="row">
      
      <div class="col-md-6">
        <div class="box box-danger border-top-none card">

          <!-- /.box-header -->
          <div class="box-body padding-0">
            <h3>Recent Order(s)</h3>
            <hr/>
            <table class="table table-hover dt-responsive" cellspacing="0" width="100%">

                <thead>
                  <tr class="first">

                    <th>{{ trans('labels.OrderID') }}</th>
                    <th>{{ trans('labels.CustomerName') }}</th>
                    <th>{{ trans('labels.TotalPrice') }}</th>
                    <th>{{ trans('labels.Status') }} </th>

                  </tr>
                  @if(count($result['orders'])>0)
                  @foreach($result['orders'] as $total_orders)
                  @foreach($total_orders as $key=>$orders)
                  @if($key<=10)
                  <tr>
                    <td><a href="{{ URL::to('admin/orders/vieworder/') }}/{{ $orders->orders_id }}" data-toggle="tooltip" data-placement="bottom" title="Go to detail">{{ $orders->orders_id }}</a></td>
                    <td>{{ $orders->customers_name }}</td>
                    <td>
                      @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ floatval($orders->total_price) }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                    </td>
                    <td>
                      @if($orders->orders_status_id==1)
                      <span class="label label-warning"></span>
                      @elseif($orders->orders_status_id==2)
                      <span class="label label-success">
                        @elseif($orders->orders_status_id==3)
                      </span>  <span class="label label-danger"></span>
                      @else
                      <span class="label label-primary">
                        @endif
                        {{ $orders->orders_status }}
                      </span>


                    </td>
                  </tr>
                  @endif
                  @endforeach
                  @endforeach

                  @else
                  <tr>
                    <td colspan="4">{{ trans('labels.noOrderPlaced') }}</td>

                  </tr>
                  @endif

                  
                   

                  
                </thead>

              </table>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->

        </div>
        
      </div>
    </div>
    
    @if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->dashboard_view == 1)

    
    

    
      @endif
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script src="{!! asset('admin/dist/js/pages/dashboard2.js') !!}"></script>
  @endsection
