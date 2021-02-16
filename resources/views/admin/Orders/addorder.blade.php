@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.AddOrder') }} <small>{{ trans('labels.AddOrder') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/orders/display')}}"><i class="fa fa-database"></i> {{ trans('labels.ListingAllOrders') }}</a></li>
            <li class="active">{{ trans('labels.AddProduct') }}</li>
        </ol>
    </section>

    <!-- Main content -->
   
    <section class="content">


            <div class="row">
                <div class="col-md-8">
                    <!-- <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.AddOrderStatus') }}</h3>
                    </div> -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 bg-style">
                                <h3>Order details</h3>
                                <div class="search_productMain customesearch">
                                     <div class="form-group has-feedback has-search">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        <input type="text" class="form-control" placeholder="Search" data-toggle="modal" data-target="#ordermodel">
                                         <button type="submit" class="btn btn-primary pull-right">Browse products</button>
                                    </div>
                                </div>

                                <!-- Modal -->
                                  <div class="modal fade" id="ordermodel" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Select products</h4>
                                        </div>
                                        <div class="modal-body">
                                             <div class="search_productMain customesearch">
                                                 <div class="form-group has-feedback has-search">
                                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                    <input type="text" class="form-control" style="max-width: 100%;" placeholder="Search" >
                                                </div>
                                                <ul class="list-group search-filter">
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> All products
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> Popular products
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> Collections
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> Product Type
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> Tags
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                </ul>

                                                <div class="serachproductlist">
                                                    <div class="list-group">
                                                      <input type="checkbox" name="CheckBoxInputName" value="Value1" id="CheckBox1" />
                                                      <label class="list-group-item" for="CheckBox1">
                                                          <div class="pdlistMain">
                                                              <div class="pdtitlMain">
                                                                  <span class="pd_img">
                                                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                                                  </span>
                                                                  <span class="pd_title">product title</span>
                                                              </div>
                                                              <div class="pdpricMain">
                                                                  <span class="pd_stock">in Stock 100</span>
                                                                  <span class="pd_price pull-right">$10</span>
                                                              </div>
                                                          </div>
                                                      </label>

                                                       <input type="checkbox" name="CheckBoxInputName" value="Value2" id="CheckBox2" />
                                                      <label class="list-group-item" for="CheckBox2">
                                                          <div class="pdlistMain">
                                                              <div class="pdtitlMain">
                                                                  <span class="pd_img">
                                                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                                                  </span>
                                                                  <span class="pd_title">product title</span>
                                                              </div>
                                                              <div class="pdpricMain">
                                                                  <span class="pd_stock">in Stock 100</span>
                                                                  <span class="pd_price pull-right">$10</span>
                                                              </div>
                                                          </div>
                                                      </label>

                                                       <input type="checkbox" name="CheckBoxInputName" value="Value3" id="CheckBox3" />
                                                      <label class="list-group-item" for="CheckBox3">
                                                          <div class="pdlistMain">
                                                              <div class="pdtitlMain">
                                                                  <span class="pd_img">
                                                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                                                  </span>
                                                                  <span class="pd_title">product title</span>
                                                              </div>
                                                              <div class="pdpricMain">
                                                                  <span class="pd_stock">in Stock 100</span>
                                                                  <span class="pd_price pull-right">$10</span>
                                                              </div>
                                                          </div>
                                                      </label>

                                                       <input type="checkbox" name="CheckBoxInputName" value="Value4" id="CheckBox4" />
                                                      <label class="list-group-item" for="CheckBox4">
                                                          <div class="pdlistMain">
                                                              <div class="pdtitlMain">
                                                                  <span class="pd_img">
                                                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                                                  </span>
                                                                  <span class="pd_title">product title</span>
                                                              </div>
                                                              <div class="pdpricMain">
                                                                  <span class="pd_stock">in Stock 100</span>
                                                                  <span class="pd_price pull-right">$10</span>
                                                              </div>
                                                          </div>
                                                      </label>

                                                       <input type="checkbox" name="CheckBoxInputName" value="Value5" id="CheckBox5" />
                                                      <label class="list-group-item" for="CheckBox5">
                                                          <div class="pdlistMain">
                                                              <div class="pdtitlMain">
                                                                  <span class="pd_img">
                                                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                                                  </span>
                                                                  <span class="pd_title">product title</span>
                                                              </div>
                                                              <div class="pdpricMain">
                                                                  <span class="pd_stock">in Stock 100</span>
                                                                  <span class="pd_price pull-right">$10</span>
                                                              </div>
                                                          </div>
                                                      </label>
                                                      
                                                    
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>


                                <div class="shopping-cart">
                                  <div class="product">
                                    <div class="product-image">
                                      <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
                                    </div>
                                    <div class="product-details">
                                      <div class="product-title"><a href="#">Dingo Dog Bones</a></div>
                                    </div>
                                    <div class="product-price">12.99</div>
                                    <div class="product-quantity">
                                      <input type="number" value="2" min="1">
                                    </div>
                                    <div class="product-removal">
                                      <button class="remove-product">
                                        X
                                      </button>
                                    </div>
                                    <div class="product-line-price">25.98</div>
                                  </div>
                                 



                                 

                                  <div class="totals">
                                    <div class="totals-item">
                                      <label>Add discount</label>
                                      <div class="totals-value" id="cart-discount">0.00</div>
                                    </div>
                                    <div class="totals-item">
                                      <label>Subtotal</label>
                                      <div class="totals-value" id="cart-subtotal">71.97</div>
                                    </div>
                                     <div class="totals-item">
                                      <label>Add shipping</label>
                                      <div class="totals-value" id="cart-shipping">15.00</div>
                                    </div>
                                    <div class="totals-item">
                                      <label>Taxes</label>
                                      <div class="totals-value" id="cart-tax">3.60</div>
                                    </div>
                                   
                                    <div class="totals-item totals-item-total">
                                      <label>Total</label>
                                      <div class="totals-value" id="cart-total">90.57</div>
                                    </div>
                                  </div>

                                </div>






                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 bg-style orderdetailMain">
                                    <h3>Find or create a customer</h3>
                                       <div class="search_customerMain customesearch">
                                             <div class="form-group has-feedback has-search">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                <input type="text" class="form-control" placeholder="Search">
                                            </div>
                                        </div>
                                   
                                </div>
                            </div>
                    </div>
                </div>
            </div>



        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-arrow-left back__arrow" aria-hidden="true"></i> {{ trans('labels.AddOrder') }} </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if(session()->has('message.level'))
                                    <div class="alert alert-{{ session('message.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {!! session('message.content') !!}
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        {!! Form::open(array('url' =>'admin/orders/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        <div class="row">
                                            <div class="col-xs-12 col-md-7">
												<div class="card">
													<div class="card-header" id="orderDate">
													  <h2 class="mb-0">
														  Order Details
													  </h2>
													</div>
													<div id="collapseOrderDate" class="collapse" aria-labelledby="orderDate" data-parent="#accordionMoreFilters">
													  <div class="card-body">
														<ul class="" >
															<li><label class="radio-inline"><input type="radio" name="optradio">Today</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 7 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 30 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 90 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 12 Months</label></li>
														</ul>
													  </div>
													</div>
												</div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Product Type') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                                            <option value="">{{ trans('labels.Choose Type') }}</option>
                                                            <option value="0">{{ trans('labels.Simple') }}</option>
                                                            <option value="1">{{ trans('labels.Variable') }}</option>
                                                            <option value="2">{{ trans('labels.External') }}</option>
                                                        </select>
														<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.Product Type Text') }}.
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-5">
												<div class="card">
													<div class="card-header" id="orderDate">
													  <h2 class="mb-0">
														  Find or create a customer
													  </h2>
													</div>
													<div id="collapseOrderDate" class="collapse" aria-labelledby="orderDate" data-parent="#accordionMoreFilters">
													  <div class="card-body">
														<ul class="" >
															<li><label class="radio-inline"><input type="radio" name="optradio">Today</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 7 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 30 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 90 Days</label></li>
															<li><label class="radio-inline"><input type="radio" name="optradio">Last 12 Months</label></li>
														</ul>
													  </div>
													</div>
												</div>
												
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Manufacturers') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="manufacturers_id">
                                                            <option value="">{{ trans('labels.ChooseManufacturers') }}</option>
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ChooseManufacturerText') }}.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <hr>
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <span>{{ trans('labels.Save_And_Continue') }}</span>
                                                <i class="fa fa-angle-right 2x"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-footer -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
   
                   
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">

</script>
@endsection