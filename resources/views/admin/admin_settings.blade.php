@extends('admin.layout')
@section('content')
<style type="text/css">
	.p-zeero{
		justify-content: flex-start !important;
	}
</style>
<div class="content-wrapper container">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Settings</h1>
		<ol class="breadcrumb">
			<li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
			{{ trans('labels.breadcrumb_dashboard') }}</a></li>
			<li class="active"> {{ trans('labels.Setting') }}</li>
		</ol>
	</section>
	<section class="content" style="max-width: 106rem; margin-left: 0;">
		<div class="row">
			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/websettings')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon1"><i class="fa fa-gear" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									General
								</b>
							</h4>
							<h4>View and update your store details</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/countries/display')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon2"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Locations
								</b>
							</h4>
							<h4>Manage places for inventory, orders, and sell products</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/manageroles')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon4"><i class="fa fa-user" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Permissions
								</b>
							</h4>
							<h4>Manage what staff can see or do in your store</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/paymentmethods/index')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon3"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Payments
								</b>
							</h4>
							<h4>Enable and manage your store's payment providers</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>
			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/pushnotification')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon1"><i class="fa fa-bell" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Notifications
								</b>
							</h4>
							<h4>Manage notifications sent to you and your customers</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/languages/display')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon2"><i class="fa fa-language" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Store languages
								</b>
							</h4>
							<h4>Manage the languages your customers can view on your store</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/shippingmethods/display')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon4"><i class="fa fa-truck" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Shipping and delivery
								</b>
							</h4>
							<h4>Manage how you ship orders to customers</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/media/add')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon3"><i class="fa fa-files-o" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Files
								</b>
							</h4>
							<h4>Upload images, videos, and documents</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/tax/taxclass/display')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon1"><i class="fa fa-percent" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Taxes
								</b>
							</h4>
							<h4>Manage how your store charges taxes</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/setting')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon2"><i class="fa fa-gear" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Domain Settings
								</b>
							</h4>
							<h4>Manage the your website domain, email and address information.</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

			<a class="col-sm-6 col-md-6 col-lg-4" href="{{url('admin/currencies/display')}}">
				<div class="box box-danger border-top-none card transition total-price">
					<!-- /.box-header -->
					<div class="box-body padding-0 p-zeero">
						<div style="margin-right: 10px">
							<div class="icon4"><i class="fa fa-gift" aria-hidden="true"></i></div>
						</div>
						<div class="">
							<h4>
								<b>
									Currency Settings
								</b>
							</h4>
							<h4>Manage the currencies for your store.</h4>
						</div>
						<!-- /.users-list -->
					</div>
					<!-- /.box-body -->
				</div>
			</a>

		</div>


	</section>
</div>

@endsection