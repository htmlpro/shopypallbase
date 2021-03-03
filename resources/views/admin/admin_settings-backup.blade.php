@extends('admin.layout')
@section('content')

<div class="content-wrapper">

	<section class="content">
		<div class="row">
			<div class="col-md-1">

			</div>
			<div class="col-md-10 settings-box">
				<h1 style="margin-top: 0">
					<small>Settings</small>
				</h1>
				<div class="box box-danger border-top-none card">
					<div class="row">
						<a href="{{url('admin/websettings')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-gear" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									General
								</h4>
								<p>
									View and update your store details
								</p>
							</div>
						</a>
						<a href="{{url('admin/countries/display')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Locations
								</h4>
								<p>
									Manage places for inventory, orders, and sell products
								</p>
							</div>
						</a>
						<a href="{{url('admin/manageroles')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Permissions
								</h4>
								<p>
									manage what staff can see or do in your store
								</p>
							</div>
						</a>
						<a href="{{url('admin/paymentmethods/index')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Payments
								</h4>
								<p>
									Enable and manage your store's payment providers
								</p>
							</div>
						</a>
						<a href="{{url('admin/pushnotification')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-bell" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Notifications
								</h4>
								<p>
									Manage notifications sent to you and your customers
								</p>
							</div>
						</a>
						<a href="{{url('admin/languages/display')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-language" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Store languages
								</h4>
								<p>
									Manage the languages your customers can view on your store
								</p>
							</div>
						</a>
						
						<a href="{{url('admin/shippingmethods/display')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-truck" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Shipping and delivery
								</h4>
								<p>
									Manage how you ship orders to customers
								</p>
							</div>
						</a>
						<a href="{{url('admin/media/add')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-files-o" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Files
								</h4>
								<p>
									Upload images, videos, and documents
								</p>
							</div>
						</a>
					
						<a href="{{url('admin/tax/taxclass/display')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-percent" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Taxes
								</h4>
								<p>
									Manage how your store charges taxes
								</p>
							</div>
						</a>


					


						<a href="{{url('admin/setting')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-percent" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Domain Settings
								</h4>
								<p>
									Manage the your website domain, email and address information.
								</p>
							</div>
						</a>

						<a href="{{url('admin/currencies/display')}}" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-gift" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Currency Settings
								</h4>
								<p>
									Manage the currencies for your store.
								</p>
							</div>
						</a>



						<!-- 	<a href="" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-percent" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Sales channels
								</h4>
								<p>
									Manage the channels you use to sell your products and services
								</p>
							</div>
						</a> -->

							<!-- <a href="" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-gavel" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Legal
								</h4>
								<p>
									Manage your store's legal pages
								</p>
							</div>
						</a> -->

						<!-- <a href="" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Checkout
								</h4>
								<p>
									Customize your online checkout process
								</p>
							</div>
						</a> -->
						<!-- <a href="" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-gift" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Gift cards
								</h4>
								<p>
									Enable Apple Wallet passes and set gift card expiry dates
								</p>
							</div>
						</a> -->
						<!-- <a href="" class="col-md-4">
							<div class="col-md-2 box-icon">
								<i class="fa fa-usd" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4>
									Billing
								</h4>
								<p>
									Manage your billing information and view your invoices
								</p>
							</div>
						</a> -->

					</div>
				</div>
			</div>

			<div class="col-md-1">

			</div>
		</div>

	</section>
</div>

@endsection