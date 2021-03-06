@extends('admin.layout')
@section('content')
<div class="content-wrapper container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.Products') }} <small>{{ trans('labels.ListingAllProducts') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
      {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active"> {{ trans('labels.Products') }}</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" style="max-width: 106rem; margin-left: 0;">
    <div class="container first-content margin-padding">

      <br />
      <div class="first__content_row">


        <div class="searc_______option1 col-md-4 col-sm-6 box-search">
          <div class="form-group">
            <div class="icon-addon addon-md">
              <form action="{{url('admin/products/display')}}" method="get">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="categories_id" value="null">

                <input type="text" placeholder="Filter products" class="form-control" name="product" id="parameter" @if(isset($product)) value="{{$product}}" @endif>

                <span><button id="submit" type="submit" class="btn btn-sm btn-default float right" style="height:34px;margin-left: -1px;">Search</button></span>

                @if(isset($product,$categories_id)) 
                <a class="btn btn-default " href="{{url('admin/products/display')}}"> x </a>
                @endif
                <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-6 padding-none" style="display: flex;">
          <div class="btn-group grop___btn_first" role="group">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle  btn____togle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Product vendor
            <span class="caret" style="margin-left:5px;"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault"
                id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Monroeoffical
                </label>
              </div>
            </a></li>
            <li><a href="#">Clear</a></li>
          </ul>
        </div>
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-default dropdown-toggle  btn____togle"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tangged with
          <span class="caret" style="margin-left:5px;"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="#">
            <input type="text" class="input___text__" />
          </a></li>
          <li><a href="#">Clear</a></li>
        </ul>
      </div>

      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle  btn____togle"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        More filters

      </button>

    </div>
  </div>
  <a href="#" class="btn btn-primary btn___disable disabled" tabindex="-1" aria-disabled="true" role="button" data-bs-toggle="button"><i class="fa fa-star" aria-hidden="true"></i> Saved</a>
  <form action="{{url('admin/products/display')}}" method="get">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{-- <input type="hidden" name="categories_id" value="null"> --}}
    <select class="sort____bn" name="sort_by" style="height: 34px; width: 177px;" onchange="this.form.submit()">
      <option value="0" class="option___cs"><i class="fa fa-arrow-down" aria-hidden="true"></i> sort
      </option>

      <option value="prod_title_asce">Product Title (A to Z)</option>
      <option value="prod_title_desc">Product Title (Z to A)</option>
      <option value="created_asce">Created (Oldest First)</option>
      <option value="created_desc">Created (Newest First)</option>
      <option value="updated_asce">Updated (Oldest First)</option>
      <option value="updated_desc">Updated (Newest First)</option>
      <option value="category_desc">Product Type (A to Z)</option>
      <option value="category_asce">Product Type (Z to A)</option>
    </select>
  </form>

        </div>
        
  <div class="col-md-4 col-sm-6 absolute-box">
      <a href="{{ URL::to('admin/products/add') }}">
        <button class="btn btn-success"
        style="float: right;font-weight:bold;">{{ trans('labels.AddNew') }}</button>
      </a>
      <button type="button" class="btn__imp" style="float: right" data-toggle="modal"
      data-target="#exportModal">Export</button>
      <button type="button" class="btn__imp" style="float: right" data-toggle="modal"
      data-target="#importModal">Import</button>

    </div>
</div>

<table class="table table-hover h5_heading">
  <thead>
    <tr>
      <th><div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">

        </label>
      </div>
      {{-- <span class="disply__non"></span></th> --}}
      <th>
        Product
      </th>
      <th>{{trans('labels.Category')}}</th>
      <th>{{trans('labels.Name') }}</th>
      <th>{{ trans('labels.Additional info') }}</th>
      <th>{{trans('labels.ModifiedDate')}}</th>

    </tr>
  </thead>
  <tbody>
    @if(count($results['products'])>0)
    @php  $resultsProduct = $results['products']->unique('products_id')->keyBy('products_id');  @endphp
    @foreach ($resultsProduct as  $key=>$product)
    <tr>
      <td>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            
          </label>
        </div>
      </td>
      <td>
        <div class="row">
          <a href="{{url('admin/products/edit')}}/{{ $product->products_id }}">
            <div class="col-lg-3 col-md-3 col-6">
              <img src="{{asset($product->path)}}"
              alt="" class="table___img">
            </div>
            <div class="col-lg-4 col-md-4 col-6 second___div">
              <h6 style="font-weight: bold;">{{ $product->products_name }}</h6>
            </div>
          </a>
        </div>
      </td>
      <td>{{ $product->categories_name }}</td>
      <td>{{ $product->products_name }} @if(!empty($product->products_model)) ( {{ $product->products_model }} ) @endif</td>
      <td>
        <strong>{{ trans('labels.Product Type') }}:</strong>
        @if($product->products_type==0)
        {{ trans('labels.Simple') }}
        @elseif($product->products_type==1)
        {{ trans('labels.Variable') }}
        @elseif($product->products_type==2)
        {{ trans('labels.External') }}
        @endif
        <br>
        @if(!empty($product->manufacturers_name))
        <strong>{{ trans('labels.Manufacturer') }}:</strong> {{ $product->manufacturers_name }}<br>
        @endif
        <strong>{{ trans('labels.Price') }}: </strong>   
        @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $product->products_price }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
        <br>
        <strong>{{ trans('labels.Weight') }}: </strong>  {{ $product->products_weight }}{{ $product->products_weight_unit }}<br>
        <strong>{{ trans('labels.Viewed') }}: </strong>  {{ $product->products_viewed }}<br>
        @if(!empty($product->specials_id))
        <strong class="badge bg-light-blue">{{ trans('labels.Special Product') }}</strong><br>
        <strong>{{ trans('labels.SpecialPrice') }}: </strong>  {{ $product->specials_products_price }}<br>

        @if(($product->specials_id) !== null)
        @php  $mytime = Carbon\Carbon::now()  @endphp
        <strong>{{ trans('labels.ExpiryDate') }}: </strong>

        {{-- @if($product->expires_date > $mytime->toDateTimeString()) --}}
        {{  date('d-m-Y', $product->expires_date) }}
        {{-- @else
          <strong class="badge bg-red">{{ trans('labels.Expired') }}</strong>
          @endif --}}
          <br>
          @endif
          @endif
        </td>
        <?php 
        $date = date_create($product->productupdate);
        $update_date = date_format($date,"d-M-Y");
        ?>
        <td>{{ $update_date }}</td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
      </tr>
      @endif
    </tbody>
  </table>

  <div class="w-100 last__result">
    @php
    if($results['products']->total()>0){
    $fromrecord = ($results['products']->currentpage()-1)*$results['products']->perpage()+1;
  }else{
  $fromrecord = 0;
}

if($results['products']->total() < $results['products']->currentpage()*$results['products']->perpage()){
$torecord = $results['products']->total();
}else{
$torecord = $results['products']->currentpage()*$results['products']->perpage();
}
@endphp

{{-- <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;"> --}}
  <div>Showing {{$fromrecord}} to {{$torecord}}
    of  {{$results['products']->total()}} entries
  </div>
{{-- </div> --}}
<div class="col-xs-12 col-md-6 text-right">
  {{$results['products']->links()}}
</div>
</div>
</div><br />
</div>
</div>

<!-- Import button  Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLongTitle">Import products by CSV</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa fa-times" style="font-size:27px;font-weight:normal;"
          aria-hidden="true"></i></span>
        </button>
      </div>

      <form action="{{url('admin/products/import')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <p>Download a <a href="">sample CSV template</a> to see an example of the format required.</p>
          <div class="Modal____sty text-center" >
            <i class="fa fa-arrow-circle-up" style="font-size:50px;padding-top:6%;" aria-hidden="true"></i>
            {{-- <button> --}}
              <input type="file" name="ProductImport" style="margin-left: 71px;">
            {{-- </button> --}}
            {{-- <p style="padding-bottom:5%;">or drop file to upload</p> --}}
          </div>
          {{-- <hr />
            <div class="form-check" style="">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                <p style="font-weight:normal; margin-left:8px;"> Overwrite any current products that have the
                  same handle. <a href="">learn more</a></p>
                </label>
              </div> --}}
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" style="font-weight: bold;"
              data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-secondary" style="font-weight: bold;">Upload and continue</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- <==========Export button modal======>                                       -->

    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLongTitle">Export products</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times" style="font-size:27px;font-weight:normal;"
              aria-hidden="true"></i></span>
            </button>
          </div>
          <div class="modal-body">

            <p>This CSV file can update all product information. To update just inventory <br />quantites use the <a
              href="">CSV file for inventory</a>. </p>
              <h4>Export</h4>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  <span style="font-size:14px;margin-left:8px;font-weight:normal">Current page</span>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  <span style="font-size:14px;margin-left:8px;font-weight:normal">All Products</span>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled"
                disabled>
                <label class="form-check-label" for="flexRadioDisabled">
                  <span style="font-size:14px;margin-left:8px;font-weight:normal"> Selected: 0 products</span>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled"
                disabled>
                <label class="form-check-label" for="flexRadioDisabled">

                  <span style="font-size:14px;margin-left:8px;font-weight:normal"> 1 product matching your
                  search</span>
                </label>
              </div>
              <h4>Export as</h4>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefaultt" id="flexRadioDefault2"
                checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  <span style="font-size:14px;margin-left:8px;font-weight:normal">CSV for Excel, Numbers, or other
                  spreadsheet programs</span>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefaultt" id="flexRadioDefault2"
                checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  <span style="font-size:14px;margin-left:8px;font-weight:normal">Plain CSV file</span>
                </label>
              </div>
              <hr />
              <p>Learn more about <a href=""> exporting products to CSV file </a>or the <a href="">Bulk editor</a></p>
            </div>
            <form action="{{url('admin/products/export')}}" method="GET">
              @csrf
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Export products</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>

    @endsection