@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <small>{{ trans('labels.title_dashboard') }} {{$result['commonContent']['setting']['admin_version']}}</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="box box-danger border-top-none card transition total-price">

          <!-- /.box-header -->
          <div class="box-body padding-0 p-zeero">
            <div>
              <div class="icon1"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
            </div>
            <div class="">
              <h3>
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
              </h3>
              <h4>Total Revenue</h4>
            </div>
            
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->

        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="box box-danger border-top-none card transition total-price">
          <div class="box-body padding-0 p-zeero">
            <div>
              <div class="icon2"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
            </div>
            <div>
              <h3>
                {{count($result['completed_orders'])}}
              </h3>
              <h4>Total Sales</h4>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="box box-danger border-top-none card transition total-price">
          <div class="box-body padding-0 p-zeero">
            <div>
            <div class="icon3"><i class="fa fa-bar-chart" aria-hidden="true"></i></div>
            </div>
            <div>
              <h3>
                0.00%
              </h3>
              <h4>Conversion</h4>
            </div>            
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="box box-danger border-top-none card transition total-price">
          <div class="box-body padding-0 p-zeero">
            <div class="">
            <div class="icon4"><i class="fa fa-eye" aria-hidden="true"></i></div>
            </div>
            <div>
              <h3>
                0
              </h3>
              <h4>Today's Visits</h4>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-sm-4" style="display: none;">
        <div class="box box-danger border-top-none card transition revenue-box">
          <div class="box-body padding-0">
            <div class="col-md-12">
              <h2>Total Revenue</h2>
              <h3>Total sales made today</h3>
              <h4>
              $178
              </h4>
              <p>Traditional heading elements are designed to work best in the meat of your page content.</p>
              <div class="row">
                <div class="col-md-4">
                    <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                    <h4><i class="fa fa-long-arrow-up" aria-hidden="true"></i>$7.8</h4>
                </div>
                <div class="col-md-4">
                    <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                    <h4><i class="fa fa-long-arrow-up green" aria-hidden="true"></i>$1.4</h4>
                </div>
                <div class="col-md-4">
                    <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                    <h4><i class="fa fa-long-arrow-up" aria-hidden="true"></i>$15</h4>
                </div>
            </div>
            </div>            
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="nav-tabs-custom">
          <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('labels.addedSaleReport') }}</h3>
            <div class="box-tools pull-right">
              <p class="notify-colors"><span class="sold-content" data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.totalsales') }}"></span> {{ trans('labels.totalsales') }}  <span class="purchased-content" data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.totalcustomers') }}"></span>{{ trans('labels.totalcustomers') }} </p>
            </div>
          </div>
          {!! Form::hidden('reportBase',  $result['reportBase'] , array('id'=>'reportBase')) !!}
          <ul class="nav nav-tabs">
            <li class="{{ Request::is('admin/dashboard/last_year') ? 'active' : '' }}"><a href="{{ url('admin/dashboard/last_year')}}">{{ trans('labels.lastYear') }}</a></li>
            <li class="{{ Request::is('admin/dashboard/last_month') ? 'active' : '' }}"><a href="{{ url('admin/dashboard/last_month')}}">{{ trans('labels.LastMonth') }}</a></li>
            <li class="{{ Request::is('admin/dashboard/this_month') ? 'active' : '' }}"><a href="{{ url('admin/dashboard/this_month')}}">{{ trans('labels.thisMonth') }}</a></li>
            <li style="width: 33%"><a href="#" data-toggle="tab">
              <div class="input-group ">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default" aria-label="Help">{{ trans('labels.custom') }}</button>
                </div>
                <input class="form-control reservation dateRange" readonly value="" name="dateRange" aria-label="Text input with multiple buttons ">
                <div class="input-group-btn"><button type="button" class="btn btn-primary getRange" >{{ trans('labels.go') }}</button> </div>
              </div>
            </a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="salesChart" style="height: 400px;"></canvas>
              </div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <div class="col-md-8" style="display: none">
        <div class="box">
          <div class="box-header with-border">
            <!--<h3 class="box-title pull-left">Monthly Report</h3>-->

            <div class="col-xs-12 col-lg-4">
              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default" aria-label="Help">{{ trans('labels.customDate') }}</button>
                </div>
                <input class="form-control" aria-label="Text input with multiple buttons">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary">{{ trans('labels.go') }}</button>
                </div>
              </div>
            </div>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>

              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  <strong>{{ trans('labels.sales') }}: 1 Jan, 2014 - 30 Jul, 2014</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" style="height: 400px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->
          <div class="box-footer" style="display: none">
            <div class="row">
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">{{ trans('labels.total_revenue') }}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">{{ trans('labels.total_cost') }}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">{{ trans('labels.total_profit') }}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block">
                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">{{ trans('labels.goal_completions') }}</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    
    
    @if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->dashboard_view == 1)

    
    

    
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- MAP & BOX PANE -->


        <!-- /.row -->

        <!-- TABLE: LATEST ORDERS -->
        
        <!-- /.box -->
      </div>
      <!-- /.col -->


        <!-- /.col -->
      </div>
      @endif
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script src="{!! asset('admin/dist/js/pages/dashboard2.js') !!}"></script>
  @endsection
