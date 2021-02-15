@extends('admin.layout')
@section('content')

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>{{ trans('labels.Sales Report') }} <small>{{ trans('labels.Sales Report') }}...</small> </h1>
		<ol class="breadcrumb">
			<li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
			<li class="active">{{ trans('labels.Sales Report') }}</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Info boxes -->

		<!-- /.row -->

		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Add Analytics</h3>
					</div>

					<form method="post" action="{{route('save-google-code')}}" class='form-horizontal form-validate'>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<div class="box box-info">
										<br>
										@if (session('update'))
										<div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong> {{ session('update') }} </strong>
										</div>
										@endif
										@csrf

										<div class="form-group">
											<label for="name" class="col-sm-2 col-md-3 control-label">
												Add Global site tag
											</label>
											<div class="col-sm-10 col-md-8">
												<textarea name="gtag" class="form-control form-validate" placeholder="Insert Global site tag here.." rows="6">{{$analytics->gtag}}</textarea>
											</div>
										</div>


										<div class="box-footer text-right">
											<button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
										</div>
									</div>

								</div>


							</div>

						</div>
					</form>
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
	@endsection
