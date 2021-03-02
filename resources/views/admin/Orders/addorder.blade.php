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
			<div class="row messages" style="display: none;">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<span class="message"></span>
				</div>
			</div>
            <div class="row">
                <div class="col-md-8">
                    <!-- <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.AddOrderStatus') }}</h3>
                    </div> -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 bg-style">
                                <h3>Order details<!-- <span class="pull-right"><a href="#" data-toggle="modal" data-target="#customItem">Add custom item</a></span> --></h3>
                                <div class="search_productMain customesearch">
                                     <div class="form-group has-feedback has-search">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        <input type="text" class="form-control" placeholder="Search" data-toggle="modal" data-target="#ordermodel">
                                         <button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ordermodel">Browse products</button>
										 <input type="hidden" name="products_json" class="products_json" value="{{ $products }}" />
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
                                                    <input type="text" class="form-control" onkeyup="serchfunction()" style="max-width: 100%;" placeholder="Search" >
                                                </div>
                                                <ul class="list-group search-filter">
                                                    <li class="list-group-item">
                                                        <a href="list-group-item list-group-item-action"> All products
                                                        <i class="fa fa-angle-right pull-right"></i></a>
                                                    </li>
                                                </ul>

                                                <div class="serachproductlist">
                                                    <div class="list-group">
													
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
								<div class="cart-products" >
                                  <div class="product">
									Search or Browser Products and Add here!
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="notes">Notes</label>
                                      <input type="text" class="form-control" placeholder="" id="notes">
                                    </div>
                                  </div>
                                  <div class="totals col-md-6">
                                    <div class="totals-item">
                                      <label><a href="#" data-toggle="modal" data-target="#addDiscount"> Add discount</a></label>
                                      <div class="totals-value" id="cart-discount">0.00</div>
                                    </div>
                                    <div class="totals-item">
                                      <label>Subtotal</label>
                                      <div class="totals-value" id="cart-subtotal">0.00</div>
                                    </div>
                                     <div class="totals-item">
                                      <label><a href="#" data-toggle="modal" data-target="#addShipping"> Add shipping</a></label>
                                      <div class="totals-value" id="cart-shipping">00.00</div>
                                    </div>
                                    <div class="totals-item">
                                      <label><a href="#" data-toggle="modal" data-target="#addtaxes"> Taxes</a></label>
                                      <div class="totals-value" id="cart-tax">0.00</div>
                                    </div>
                                   
                                    <div class="totals-item totals-item-total">
                                      <label>Total</label>
                                      <div class="totals-value" id="cart-total">00.00</div>
                                    </div>
                                  </div>

                                <div class="invoiceMian">
                                  <div class="col-md-6">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>SEND INVOICE</span>
                                  </div>
                                  <div class="col-md-6">
                                    <button class="pull-right btn btn-default">Send invoice</button>
                                  </div>
                                </div>
                                 <div class="makepaymentMian">
                                  <div class="col-md-6">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i> <span>ACCEPT PAYMENT</span>
                                  </div>
                                  <div class="col-md-6">
                                    <button class="pull-right btn btn-default" data-toggle="modal" data-target="#paidorders">Mark as paid</button>
                                    <button class="pull-right btn btn-default" data-toggle="modal" data-target="#pendingorders">Mark as pending</button>
                                  </div>
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
                                    <div class="sc_Main">
                                        <h3>Find or create a customer</h3>
                                       <div class="search_customerMain customesearch">
                                             <div class="form-group has-feedback has-search">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                <input type="text" class="form-control dropdown-toggle" placeholder="Search" data-toggle="dropdown" aria-haspopup="true">
                                                <div class="dropdown-menu customerlist  bg-style">
                                                    <a class="dropdown-item addnewcustomer" data-toggle="modal" data-target="#createuser" href="#"><i class="fa fa-plus" aria-hidden="true"></i> Create a new customer</a>
                                                    <div class="dropdown-divider"></div>
													@foreach($customers as $customer)
                                                    <a class="dropdown-item detailsbox" href="#" data-customer='{{ $customer }}'>
                                                        <p>{{ $customer->first_name }} {{ $customer->last_name }}</p>
                                                        <p class="ct_email">{{ $customer->email }}</p>
                                                    </a>
													@endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ct_viewmain">
                                        <div class="ct_header">
                                            <h3>Customer<i class="fa fa-times pull-right" aria-hidden="true"></i></h3>
                                            <div class="image_and_orders">
                                                <div class="pull-left">
                                                    <img width="75" src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png">
                                                </div>
                                                <div class="ordercount pull-right">
                                                    <i class="fa fa-pie-chart" aria-hidden="true"></i> No orders
                                                </div>
                                            </div>
                                            <div class="ct_info">
                                                    <p class="ct_name">Test Account</p>
                                                    <p class="ct_email"><span>test@test.com</span> <a href="#" class="pull-right edituser" data-toggle="modal" data-target="#edituser">Edit</a></p>
													<input type="hidden" name="customer" value="" class="customer_id" data-customer=''/>
													<input type="hidden" name="customer" value="" class="customer_data" data-customer=''/>
                                            </div>
                                            <div class="ct_shipping">
                                                <h3>SHIPPING ADDRESS <a href="#" class="pull-right edituser" data-toggle="modal" data-target="#edituser">Edit</a></h3>
												<div>
                                                <p>Test Account</p>
                                                <p>139 Hunza</p>
                                                <p>LHr Pakistan</p>
												</div>
                                            </div>

                                             <div class="ct_billing">
                                                <h3>BILLING ADDRESS <a href="#" class="pull-right edituser" data-toggle="modal" data-target="#edituser">Edit</a> </h3>
                                                <p>Same as shipping address</p>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                    </div>
                </div>
				
				<div class="col-md-12 submit-btnmain">
                  <button class="pull-left btn btn-default delete_draft" disabled>Delete draft order</button>
                  <button class="pull-right btn btn-primary save_draft">Save draft order</button>
                </div>
				
            </div>


            <div class="modal fade" id="createuser" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create a new customer</h4>
                  </div>
                  <div class="modal-body">

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="first">First Name</label>
                          <input type="text" class="form-control" placeholder="" id="first">
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="last">Last Name</label>
                            <input type="text" class="form-control" placeholder="" id="last">
                          </div>
                        </div>
                       </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="email">
                          </div>
                        </div>
                      </div>



    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">Company</label>
          <input type="text" class="form-control" placeholder="" id="company">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" id="phone" placeholder="phone">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">Address</label>
          <input type="text" class="form-control" placeholder="" id="company">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="phone">Apartment, suite, etc. (optional)</label>
          <input type="tel" class="form-control" id="phone" placeholder="phone">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">City</label>
          <input type="text" class="form-control" placeholder="" id="company">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="phone">Country/Region</label>
          <input type="tel" class="form-control" id="phone" placeholder="phone">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">State/territory</label>
                <select class="form-control custom-select" id="exampleSt">
                      <option class="text-white bg-warning">
                        Pick a state
                      </option>
                      <option value="AL">
                        Alabama
                      </option>
                      <option value="AK">
                        Alaska
                      </option>
                      <option value="AZ">
                        Arizona
                      </option>
                      <option value="AR">
                        Arkansas
                      </option>
                      <option value="CA">
                        California
                      </option>
                      <option value="CO">
                        Colorado
                      </option>
                      <option value="CT">
                        Connecticut
                      </option>
                      <option value="DE">
                        Delaware
                      </option>
                      <option value="DC">
                        District Of Columbia
                      </option>
                      <option value="FL">
                        Florida
                      </option>
                      <option value="GA">
                        Georgia
                      </option>
                      <option value="HI">
                        Hawaii
                      </option>
                      <option value="ID">
                        Idaho
                      </option>
                      <option value="IL">
                        Illinois
                      </option>
                      <option value="IN">
                        Indiana
                      </option>
                      <option value="IA">
                        Iowa
                      </option>
                      <option value="KS">
                        Kansas
                      </option>
                      <option value="KY">
                        Kentucky
                      </option>
                      <option value="LA">
                        Louisiana
                      </option>
                      <option value="ME">
                        Maine
                      </option>
                      <option value="MD">
                        Maryland
                      </option>
                      <option value="MA">
                        Massachusetts
                      </option>
                      <option value="MI">
                        Michigan
                      </option>
                      <option value="MN">
                        Minnesota
                      </option>
                      <option value="MS">
                        Mississippi
                      </option>
                      <option value="MO">
                        Missouri
                      </option>
                      <option value="MT">
                        Montana
                      </option>
                      <option value="NE">
                        Nebraska
                      </option>
                      <option value="NV">
                        Nevada
                      </option>
                      <option value="NH">
                        New Hampshire
                      </option>
                      <option value="NJ">
                        New Jersey
                      </option>
                      <option value="NM">
                        New Mexico
                      </option>
                      <option value="NY">
                        New York
                      </option>
                      <option value="NC">
                        North Carolina
                      </option>
                      <option value="ND">
                        North Dakota
                      </option>
                      <option value="OH">
                        Ohio
                      </option>
                      <option value="OK">
                        Oklahoma
                      </option>
                      <option value="OR">
                        Oregon
                      </option>
                      <option value="PA">
                        Pennsylvania
                      </option>
                      <option value="RI">
                        Rhode Island
                      </option>
                      <option value="SC">
                        South Carolina
                      </option>
                      <option value="SD">
                        South Dakota
                      </option>
                      <option value="TN">
                        Tennessee
                      </option>
                      <option value="TX">
                        Texas
                      </option>
                      <option value="UT">
                        Utah
                      </option>
                      <option value="VT">
                        Vermont
                      </option>
                      <option value="VA">
                        Virginia
                      </option>
                      <option value="WA">
                        Washington
                      </option>
                      <option value="WV">
                        West Virginia
                      </option>
                      <option value="WI">
                        Wisconsin
                      </option>
                      <option value="WY">
                        Wyoming
                      </option>
                    </select>
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="phone">ZIP/Postal code</label>
          <input type="tel" class="form-control" id="phone" placeholder="phone">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Save customer</button>
                  </div>
                </div>
              </div>
            </div>



            <div class="modal fade" id="edituser" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Customer</h4>
					<input type="hidden" class="form-control" id="cid" name="cid">
                  </div>
                  <div class="modal-body">

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="first_name">First Name</label>
                          <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name">
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name">
                          </div>
                        </div>
                       </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                          </div>
                        </div>
                      </div>



    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="entry_company">Company</label>
          <input type="text" class="form-control" placeholder="Company" id="entry_company" name="entry_company">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" id="phone" placeholder="Phone" name="phone">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="entry_street_address">Address</label>
          <input type="text" class="form-control" placeholder="Address" id="entry_street_address" name="entry_street_address">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="entry_suburb">Suburb (optional)</label>
          <input type="tel" class="form-control" id="phone" placeholder="Suburb" name="entry_suburb">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="entry_city">City</label>
          <input type="text" class="form-control" placeholder="City" id="entry_city" id="entry_city">
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="entry_country_id">Country/Region</label>
          <input type="tel" class="form-control" id="entry_country_id" placeholder="entry_country_id" name="entry_country_id">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="entry_state">State/territory</label>
                <select class="form-control custom-select" id="entry_state" name="entry_state">
                      <option class="text-white bg-warning">
                        Pick a state
                      </option>
                      <option value="AL">
                        Alabama
                      </option>
                      <option value="AK">
                        Alaska
                      </option>
                      <option value="AZ">
                        Arizona
                      </option>
                      <option value="AR">
                        Arkansas
                      </option>
                      <option value="CA">
                        California
                      </option>
                      <option value="CO">
                        Colorado
                      </option>
                      <option value="CT">
                        Connecticut
                      </option>
                      <option value="DE">
                        Delaware
                      </option>
                      <option value="DC">
                        District Of Columbia
                      </option>
                      <option value="FL">
                        Florida
                      </option>
                      <option value="GA">
                        Georgia
                      </option>
                      <option value="HI">
                        Hawaii
                      </option>
                      <option value="ID">
                        Idaho
                      </option>
                      <option value="IL">
                        Illinois
                      </option>
                      <option value="IN">
                        Indiana
                      </option>
                      <option value="IA">
                        Iowa
                      </option>
                      <option value="KS">
                        Kansas
                      </option>
                      <option value="KY">
                        Kentucky
                      </option>
                      <option value="LA">
                        Louisiana
                      </option>
                      <option value="ME">
                        Maine
                      </option>
                      <option value="MD">
                        Maryland
                      </option>
                      <option value="MA">
                        Massachusetts
                      </option>
                      <option value="MI">
                        Michigan
                      </option>
                      <option value="MN">
                        Minnesota
                      </option>
                      <option value="MS">
                        Mississippi
                      </option>
                      <option value="MO">
                        Missouri
                      </option>
                      <option value="MT">
                        Montana
                      </option>
                      <option value="NE">
                        Nebraska
                      </option>
                      <option value="NV">
                        Nevada
                      </option>
                      <option value="NH">
                        New Hampshire
                      </option>
                      <option value="NJ">
                        New Jersey
                      </option>
                      <option value="NM">
                        New Mexico
                      </option>
                      <option value="NY">
                        New York
                      </option>
                      <option value="NC">
                        North Carolina
                      </option>
                      <option value="ND">
                        North Dakota
                      </option>
                      <option value="OH">
                        Ohio
                      </option>
                      <option value="OK">
                        Oklahoma
                      </option>
                      <option value="OR">
                        Oregon
                      </option>
                      <option value="PA">
                        Pennsylvania
                      </option>
                      <option value="RI">
                        Rhode Island
                      </option>
                      <option value="SC">
                        South Carolina
                      </option>
                      <option value="SD">
                        South Dakota
                      </option>
                      <option value="TN">
                        Tennessee
                      </option>
                      <option value="TX">
                        Texas
                      </option>
                      <option value="UT">
                        Utah
                      </option>
                      <option value="VT">
                        Vermont
                      </option>
                      <option value="VA">
                        Virginia
                      </option>
                      <option value="WA">
                        Washington
                      </option>
                      <option value="WV">
                        West Virginia
                      </option>
                      <option value="WI">
                        Wisconsin
                      </option>
                      <option value="WY">
                        Wyoming
                      </option>
                    </select>
        </div>

      </div>
      <!--  col-md-6   -->

      <div class="col-md-6">

        <div class="form-group">
          <label for="entry_postcode">ZIP/Postal code</label>
          <input type="tel" class="form-control" id="entry_postcode" placeholder="phone"  name="entry_postcode">
        </div>
      </div>
      <!--  col-md-6   -->
    </div>
    <!--  row   -->

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-default save_customer" data-dismiss="modal">Save customer</button>
                  </div>
                </div>
              </div>
            </div>


            <div class="modal fade" id="customItem" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add custom item</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="company">Line item name</label>
                            <input type="text" class="form-control" placeholder="" id="company">
                          </div>
                      </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="priceitem">Price per item</label>
                      <input type="tel" class="form-control" id="priceitem" placeholder="Price">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="qty">Quantity</label>
                      <input type="number" class="form-control" id="qty" value="1">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="checkbox-inline">
                      <input type="checkbox" value="">Item is taxable
                    </label>
                  </div>
                </div>
                 <div class="row">
                  <div class="col-md-12">
                    <label class="checkbox-inline">
                      <input type="checkbox" value="">Item requires shipping
                    </label>
                  </div>
                </div>
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Save inline item</button>
                  </div>
                </div>
              </div>
            </div>



            <div class="modal fade" id="addDiscount" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Discount</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="company">Coupon Code</label>
                            <input type="text" class="form-control" placeholder="" id="adDiscount">
                          </div>
                      </div>
					</div>
					<div class="row coupon_messages" style="display: none;">
						<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<span class="message"></span>
						</div>
					</div>
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-default apply_coupon" >Apply</button>
                  </div>
                </div>
              </div>
            </div>



             <div class="modal fade" id="addtaxes" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Taxes are automatically calculated.</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                          <label class="checkbox-inline">
                            <input type="checkbox" value="">Charge taxes
                          </label>
                        </div>
                      </div>
               
               
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Apply</button>
                  </div>
                </div>
              </div>
            </div>


            <div class="modal fade" id="pendingorders" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mark payment as pending.</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                          <p>This will create an order without payment. You will be able to collect payment of RM1.06 MYR later.</p>
                         <div class="form-group">
                            <label for="sel1">Expected payment method</label>
                            <select class="form-control" id="sel1">
                              <option>Others</option>
                              <option>Cash on Delivery (COD)</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>
               
               
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn btn-primary" data-dismiss="modal">Create Order</button>
                  </div>
                </div>
              </div>
            </div>


            <div class="modal fade" id="paidorders" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mark as paid?</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                          <p>This will create an order. Mark this order as paid.</p>
                         <div class="form-group">
                            <label for="sel1">Type of payment received</label>
                            <select class="form-control" id="sel1">
                              <option>Others</option>
                              <option>Cash on Delivery (COD)</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>
               
               
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn btn-primary" data-dismiss="modal">Create Order</button>
                  </div>
                </div>
              </div>
            </div>


             <div class="modal fade" id="addShipping" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                 
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="alert alert-warning" role="alert">
                      <strong>SELECT A SHIPPING OPTION BELOW</strong> </br>
                      
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="radio">
                              <label><input type="radio" name="optradio" checked>Free shipping</label>
                            </div>
                          </div>
                      </div>
                </div>
               
               
                  </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Apply</button>
                  </div>
                </div>
              </div>
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