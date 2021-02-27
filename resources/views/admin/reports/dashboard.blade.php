@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <small>Overview dashboard</small>
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Total Sales <small><a href="{{ URL::to('admin/salesreport')}}" style="float: right;">View Report</a></small></h3>
                <h2>{{count($result['completed_orders'])}}</h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->

            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Online store sessions <small><a href="" style="float: right;">View Report</a></small></h3> 
                <h2>
                  0
                </h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->

            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Returning customer rate</h3>
                <h2>
                  0%
                </h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Online store conversion rate <small><a href="" style="float: right;">View Report</a></small></h3> 
                <h2>
                  0 %
                </h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Average order value <small><a href="" style="float: right;">View Report</a></small></h3> 
                <h2>
                  
                  $ 0.00
                </h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="box box-danger border-top-none card transition">

              <!-- /.box-header -->
              <div class="box-body padding-0">
                <h3>Total orders <small><a href="" style="float: right;">View Report</a></small></h3> 
                <h2>
                  0
                </h2>
                <hr/>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
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
