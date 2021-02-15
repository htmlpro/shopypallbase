@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.EditProduct') }} <small>{{ trans('labels.EditProduct') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
                    {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/products/display')}}"><i class="fa fa-database"></i>
                    {{ trans('labels.ListingAllProducts') }}</a></li>
            <li class="active">{{ trans('labels.EditProduct') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- <====================Edit page Update==================> -->

        <div class="row">
            <div class="col-md-6 col-6 mx-auto">
                <h3 class="box-title">
                   <a href="{{ URL::to('admin/products/display')}}">
                        <i class="fa fa-arrow-left back__arrow" style="position:relative;right:2%;" aria-hidden="true"></i>    
                    </a>
                    <span class="sapan_cls"></span> {{$result['description'][1]['products_name']}} <span
                        style="background-color:rgba(164,232,242,1);padding:4px 12px;border-radius:18px;font-size:15px;">Draft</span>
                </h3>
            </div>
            <div class="col-md-6 col-6 mx-auto">
                <div class="edit__button_1">
                    <button class="Dublicate___buton" data-toggle="modal"
                        data-target="#dublicatebuttonModal">Dublicate</button>
                    <button class="Dublicate___buton">preview</button>
                    <div class="btn-group grop___btn_first" role="group">
                        <div class="btn-group" role="group">
                            <button type="button " disabled>
                                <i class="fa fa-chevron-left " aria-hidden="true"></i>

                            </button>

                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" disabled>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>

                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
            @if( count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                {{ $error }}
            </div>
            @endforeach
            @endif

            {!! Form::open(array('url' =>'admin/products/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
            {!! Form::hidden('id', $result['product'][0]->products_id, array('class'=>'form-control', 'id'=>'id')) !!}
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto edit_page__main">
                    @foreach($result['description'] as $key=>$description_data)
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"><span style="font-weight: normal;">{{ trans('labels.ProductName') }} ({{ $description_data['language_name'] }})</span> </label>
                        <input type="text" name="products_name_<?=$description_data['languages_id']?>" class="form-control" value="{{$description_data['products_name']}}" id="exampleFormControlInput1" placeholder="title..">
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.EnterProductNameIn') }} {{ $description_data['language_name'] }} </span><span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                    </div><br />
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"><span
                            style="font-weight: normal;">{{ trans('labels.Description') }} ({{ $description_data['language_name'] }})</span></label>
                            <textarea id="editor<?=$description_data['languages_id']?>" name="products_description_<?=$description_data['languages_id']?>" class="form-control" rows="2">
                                {{stripslashes($description_data['products_description'])}}
                            </textarea>
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                {{ trans('labels.EnterProductDetailIn') }} {{ $description_data['language_name'] }}
                            </span>
                    </div><br />
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-12 mx-auto edit_page__main1" style="margin-bottom: 20px;">
                    <h5>{{ trans('labels.Status') }}</h5>
                    <select class="form-select draft___prod" name="products_status" aria-label="Default select example">
                        <option value="1" @if($result['product'][0]->products_status==1) selected @endif >{{ trans('labels.Active') }}</option>
                        <option value="0" @if($result['product'][0]->products_status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
                        {{-- <option selected>Draft</option>
                        <option value="1">active</option>
                        <option value="2">draft</option> --}}
    
                    </select>
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.Product Type Text') }}.</span>
                    <br>
    
                    <h5>{{ trans('labels.IsFeature') }}</h5>
                    <select class="form-select draft___prod" name="is_feature" aria-label="Default select example">
                        <option value="0" @if($result['product'][0]->is_feature==0) selected @endif>{{ trans('labels.No') }}</option>
                        <option value="1" @if($result['product'][0]->is_feature==1) selected @endif>{{ trans('labels.Yes') }}</option>
                    </select>
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.IsFeatureProuctsText') }}</span>
                    <br>                    
    
    
                    <h5>{{ trans('labels.slug') }}</h5>
                    
                        <input type="hidden" name="old_slug" value="{{$result['product'][0]->products_slug}}">
                        <input type="text" name="slug" class="form-control" value="{{$result['product'][0]->products_slug}}">
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.slugText') }}</span>
                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                    <br>
    
                    <h5>{{ trans('labels.ProductsModel') }}</h5>
                    {!! Form::text('products_model', $result['product'][0]->products_model, array('class'=>'form-control', 'id'=>'products_model')) !!}
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.ProductsModelText') }}
                    </span>
                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
    
                    <br>
    
    
                    <span style="display:flex;">
                        <p>SALES CHANNELS AND APPS</p> <a style="margin-left:80px;" href="">Manage</a>
                    </span>
                    <br>
                    <span style="display:flex;">
                        <p>Online Store</p> <a style="margin-left:170px;" href="">Selected</a>
                    </span>
                    <a href="">Schulde availability</a>
                </div>
                
                <div class="col-lg-4 col-md-4 col-12 mx-auto edit_page__main1" style="margin-bottom: 20px;">
                    <h4>Organization</h4>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"><span style="font-weight:normal;">{{ trans('labels.Product Type') }}</span>
                        </label>
                        <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                            <option value="">{{ trans('labels.Choose Type') }}</option>
                            <option value="0" @if($result['product'][0]->products_type==0) selected @endif>{{ trans('labels.Simple') }}</option>
                            <option value="1" @if($result['product'][0]->products_type==1) selected @endif>{{ trans('labels.Variable') }}</option>
                            <option value="2" @if($result['product'][0]->products_type==2) selected @endif>{{ trans('labels.External') }}</option>
                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('labels.Product Type Text') }}.</span>
                        {{-- <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="types..."> --}}
                    </div>
    
                    {{-- <br>
                    
                    <h5>{{ trans('labels.Manufacturers') }}</h5>
                    <select class="form-select draft___prod" name="manufacturers_id" aria-label="Default select example">
                        <option value="">{{ trans('labels.Choose Manufacturer') }}</option>
                            @foreach ($result['manufacturer'] as $manufacturer)
                            <option @if($result['product'][0]->manufacturers_id == $manufacturer->id )
                                selected
                                @endif
                                value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                    </select>
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.ChooseManufacturerText') }}.</span> --}}
                    <br>
    
                    <h5>{{ trans('labels.TaxClass') }}</h5>
                    <select class="form-select draft___prod" name="tax_class_id" aria-label="Default select example">
                        <option selected> {{ trans('labels.SelectTaxClass') }}</option>
                        @foreach ($result['taxClass'] as $taxClass)
                        <option @if($result['product'][0]->products_tax_class_id == $taxClass->tax_class_id )
                            selected
                            @endif
                            value="{{ $taxClass->tax_class_id }}">{{ $taxClass->tax_class_title }}</option>
                        @endforeach
                    </select>
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.ChooseTaxClassForProductText') }}
                    </span>
                    <span class="help-block hidden">{{ trans('labels.SelectProductTaxClass') }}</span>
                    <br>
                    <br />
                    
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"><span style="font-weight:normal;">
                                Vendor
                            </span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ifull">
                    </div>
                </div>
                
            </div>
            <br />
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto edit_page__main">
                    <span style="display:flex;">
                        <p>Media</p>
                        <select id="media-switch" class="form-select draft___prod1" aria-label="Default select example">
                            <option value="0">Add media from URL</option>
                            <option value="1">Embed youtube video</option>
                            {{-- <option value="2">Embed youtube video</option> --}}
                        </select>
                    </span>
                    <br />
                    <div id="first">
                        <div class="col-lg-12 col-12 col-md-12">
    
                            <!-- Modal -->
                            <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
                                        </div>
        
                                        <div class="modal-body manufacturer-image-embed">
                                            @if(isset($allimage))
                                            <select class="image-picker show-html " name="image_id" id="select_img">
                                                <option value=""></option>
                                                @foreach($allimage as $key=>$image)
                                                <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left">{{ trans('labels.Add Image') }}</a>
                                            <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                            <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                                <div id="imageselected" class="col-lg-6 col-md-6 col-12">
                                    {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UploadProductImageText') }}</span>
                                    <br>
                                    <div id="selectedthumbnail" class="selectedthumbnail"> </div>
                                    <div class="closimage">
                                        <button type="button" class="close pull-left image-close " id="image-close"
                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 text-center" style="margin-top: 60px;">
                                    <h5>Default Image</h5>
                                    {!! Form::hidden('oldImage', $result['product'][0]->products_image , array('id'=>'oldImage', 'class'=>'field-validate ')) !!}
                                    <img src="{{asset($result['product'][0]->path)}}" alt="" width=" 100px">
                                </div>
                            
                            
                        </div>
                    </div>
                    <div class="" id="second">
                        <h5>{{ trans('labels.VideoEmbedCodeLink') }}</h5>
                            {!! Form::textarea('products_video_link', $result['product'][0]->products_video_link, array('class'=>'form-control', 'id'=>'products_video_link', 'rows'=>4)) !!}
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                {{ trans('labels.VideoEmbedCodeLinkText') }}
                            </span>
                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                    </div>
    
                </div>
                <div class="col-lg-4 col-md-4 col-12 mx-auto edit_page__main1">
                    <h4>COLLECTIONS</h4>
                    <div class="searc_______option mb-3" style="width:97%;padding-left: 14px;padding-right: 9px;">
                        <div class="form-group">
                            <div class="icon-addon addon-md">
                                <input type="text" placeholder="search for collections" class="form-control" id="email">
                                <label for="search" class="glyphicon glyphicon-search" rel="tooltip"
                                    title="email"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"><span style="font-weight:normal;">
                                Tages
                            </span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="vintage,cotton,summer">
                    </div>
                    
                </div>
                
            </div>
                
        
            <div class="row ">
                {{-- <div class="col-lg-7 col-md-7 col-12 mx-auto edit_page_main_2" style="margin-left: 0% !important;width: 58%;">
                    <span style="display:flex;">
                        <p>Varients</p>
                        <a href="" class="add_varient-cs">Add varients</a>
                        <select class="form-select draft___prod122" aria-label="Default select example">
                            <option selected>More options</option>
                            <option value="1">edit option</option>
                            <option value="2">reorder varient</option>
    
                        </select>
                    </span>
                    <br />
                    <span style="display:flex;">
                        <p>Select</p>
                        <a href="#" style="margin-left:11px;">All</a>
                        <a href="#" style="margin-left:11px;">None</a>
                        <a href="#" style="margin-left:11px;">red</a>
                    </span>
    
                    <div style="overflow-x:auto;">
                        <table style="border-collapse: collapse; border-spacing: 0;width: 113%;" class="table-hover">
                            <tr>
                                <th style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    
                                    </div>
                                </th>
                                <th style="text-align: left;padding: 8px;"></th>
                                <th style="text-align: left;padding: 8px;">Color</th>
                                <th style="text-align: left;padding: 8px;">Price</th>
                                <th style="text-align: left;padding: 8px;">Quantity</th>
                                <th style="text-align: left;padding: 8px;margin-left:12px;">SKU</th>
    
                            </tr>
    
                            <tr>
                                <hr />
                                <td style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <button class="images___button">
                                        <img src="https://images.unsplash.com/photo-1611223178400-a1e2b0f8bcab?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=375&q=80"
                                            alt="" class="edit__product____img" />
                                    </button>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="text" class="form-control " id="exampleFormControlInput1"
                                            placeholder="colors">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:100%">
    
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="PKR.0.00">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="number" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left; padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="btn-grouppp" style="width:100%">
                                        <button style="width:100%">Edit</button>
                                        <button style="width:100%" data-toggle="modal" data-target="#deleteModaltable">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <button class="images___button">
                                        <img src="https://images.unsplash.com/photo-1611223178400-a1e2b0f8bcab?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=375&q=80"
                                            alt="" class="edit__product____img" />
                                    </button>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="colors">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:100%">
    
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="PKR.0.00">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="number" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">
    
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="btn-grouppp" style="width:100%">
                                        <button style="width:100%">Edit</button>
                                        <button style="width:100%" data-toggle="modal" data-target="#deleteModaltable">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> --}}
                <div class="col-lg-7 col-md-7 col-12 mx-auto edit_page_main_2" style="margin-left: 0% !important;width: 58%;">
                    <h5>{{ trans('labels.Category') }}</h5>
                    {{-- <div class="col-sm-10 col-md-9"> --}}
                    <?php print_r($result['categories']); ?>
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('labels.ChooseCatgoryText') }}.</span>
                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                    {{-- </div> --}}
                    
                </div>
                <div class="col-lg-4 col-md-4 col-12 mx-auto edit_page__main1" style="margin-top: 2%;">
                    <h5>{{ trans('labels.ProductsPrice') }}</h5>
                        {!! Form::text('products_price', $result['product'][0]->products_price, array('class'=>'form-control number-validate', 'id'=>'products_price')) !!}
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('labels.ProductPriceText') }}
                        </span>
                        <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
    
                    <h5>{{ trans('labels.Min Order Limit') }}</h5>
                    {!! Form::text('products_min_order', $result['product'][0]->products_min_order, array('class'=>'form-control field-validate number-validate', 'id'=>'products_min_order')) !!}
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('labels.Min Order Limit Text') }}
                        </span>
                        <span class="help-block hidden">{{ trans('labels.Min Order Limit Text') }}</span>
    
                    <h5>{{ trans('labels.Max Order Limit') }}</h5> 
                    {!! Form::text('products_max_stock', $result['product'][0]->products_max_stock, array('class'=>'form-control field-validate number-validate', 'id'=>'products_max_stock')) !!}
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.Max Order Limit Text') }}
                    </span>
                    <span class="help-block hidden">{{ trans('labels.Max Order Limit Text') }}</span>
    
                    <h5>{{ trans('labels.ProductsWeight') }}</h5>
                    {!! Form::text('products_weight', $result['product'][0]->products_weight, array('class'=>'form-control field-validate number-validate', 'id'=>'products_weight')) !!}
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                        {{ trans('labels.RequiredTextForWeight') }}
                    </span>
                    <select class="form-control" name="products_weight_unit">
                            
                        <option value="gm" @if($result['product'][0]->products_weight_unit=='gm') selected @endif>Gm</option>
                        
                    </select>
                </div>
            </div>

            <div class="row ">
                <div class="col-lg-12 col-md-12 col-12 mx-auto edit_page_main_2">
                    <span style="display:flex;">
                        <p>Varients</p>
                        <a href="" class="add_varient-cs">Add varients</a>
                        <select class="form-select draft___prod122" aria-label="Default select example">
                            <option selected>More options</option>
                            <option value="1">edit option</option>
                            <option value="2">reorder varient</option>

                        </select>
                    </span>
                    <br />
                    <span style="display:flex;">
                        <p>Select</p>
                        <a href="#" style="margin-left:11px;">All</a>
                        <a href="#" style="margin-left:11px;">None</a>
                        <a href="#" style="margin-left:11px;">red</a>
                    </span>

                    <div style="overflow-x:auto;">
                        <table style="border-collapse: collapse; border-spacing: 0;width: 113%;" class="table-hover">
                            <tr>
                                <th style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                    </div>
                                </th>
                                <th style="text-align: left;padding: 8px;"></th>
                                <th style="text-align: left;padding: 8px;">Color</th>
                                <th style="text-align: left;padding: 8px;">Price</th>
                                <th style="text-align: left;padding: 8px;">Quantity</th>
                                <th style="text-align: left;padding: 8px;margin-left:12px;">SKU</th>

                            </tr>

                            <tr>
                                <hr />
                                <td style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <button class="images___button">
                                        <img src="https://images.unsplash.com/photo-1611223178400-a1e2b0f8bcab?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=375&q=80"
                                            alt="" class="edit__product____img" />
                                    </button>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="text" class="form-control " id="exampleFormControlInput1"
                                            placeholder="colors">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:100%">

                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="PKR.0.00">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="number" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left; padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="btn-grouppp" style="width:100%">
                                        <button style="width:100%">Edit</button>
                                        <button style="width:100%" data-toggle="modal" data-target="#deleteModaltable">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <button class="images___button">
                                        <img src="https://images.unsplash.com/photo-1611223178400-a1e2b0f8bcab?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=375&q=80"
                                            alt="" class="edit__product____img" />
                                    </button>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="colors">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:100%">

                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="PKR.0.00">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="number" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="mb-3" style="width:102%">

                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="">
                                    </div>
                                </td>
                                <td style="text-align: left;padding: 8px;">
                                    <div class="btn-grouppp" style="width:100%">
                                        <button style="width:100%">Edit</button>
                                        <button style="width:100%" data-toggle="modal" data-target="#deleteModaltable">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="row ">
                <div class="col-lg-7 col-md-7 col-12 mx-auto edit_page_main_2" style="margin-left: 0% !important;width: 58%;">
                    <div class="col-xs-12 col-lg-3 col-md-3" style="width: 49% !important;">
                        <h5>{{ trans('labels.FlashSale') }}<h5>
                        <select class="form-control" onChange="showFlash()" name="isFlash" id="isFlash">
                            <option value="no" @if($result['flashProduct'][0]->flash_status == 0)
                                selected
                                @endif>{{ trans('labels.No') }}</option>
                            <option value="yes" @if($result['flashProduct'][0]->flash_status == 1)
                                selected
                                @endif>{{ trans('labels.Yes') }}</option>
                        </select>
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('labels.FlashSaleText') }}</span>
                            
                        <div class="flash-container" style="display: none;">
                
                            <h5>{{ trans('labels.FlashSalePrice') }}</h5>
                            <input class="form-control" type="text" name="flash_sale_products_price" id="flash_sale_products_price" value="{{$result['flashProduct'][0]->flash_sale_products_price}}">
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                {{ trans('labels.FlashSalePriceText') }}</span>
                            <span class="help-block hidden">{{ trans('labels.FlashSalePriceText') }}</span>
                                
                            
        
                            
                            <h5>{{ trans('labels.FlashSaleDate') }}</h5>
                            @if($result['flashProduct'][0]->flash_status == 1)
                            
                                <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" value="{{date('d/m/Y', $result['flashProduct'][0]->flash_start_date) }}">
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.FlashSaleDateText') }}</span>
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
                                <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time"
                                    value="{{date('h:i:sA',  $result['flashProduct'][0]->flash_start_date ) }}">
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            @else
                                <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" value="">
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.FlashSaleDateText') }}</span>
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
                                <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time" value="">
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            @endif
        
        
                        
                            <h5>{{ trans('labels.FlashExpireDate') }}</h5>
                            @if($result['flashProduct'][0]->flash_status == 1)
                            
                                <input class="form-control datepicker" readonly type="text" name="flash_expires_date" id="flash_expires_date"
                                    value="{{ date('d/m/Y', $result['flashProduct'][0]->flash_expires_date )}}">
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.FlashExpireDateText') }}</span>
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
                            
                                <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="{{ date('h:i:sA', $result['flashProduct'][0]->flash_expires_date ) }}">
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
                            @else
                            
                                <input class="form-control datepicker" readonly type="text" name="flash_expires_date" id="flash_expires_date" value="">
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.FlashExpireDateText') }}</span>
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
                            
                                <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="">
                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                        
                            @endif
                        
        
                        
                            <h5>{{ trans('labels.Status') }}</h5>
                            
                            <select class="form-control" name="flash_status">
                                <option value="1">{{ trans('labels.Active') }}</option>
                                <option value="0">{{ trans('labels.Inactive') }}</option>
                            </select>
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                {{ trans('labels.ActiveFlashSaleProductText') }}</span>
                                
                        </div>
                    </div>
    
                    <div class="col-xs-12 col-md-3 col-lg-3" style="width: 49% !important;">
                        <h5>{{ trans('labels.Special') }} </h5>
                        <select class="form-control" onChange="showSpecial()" name="isSpecial" id="isSpecial">
                            <option @if($result['product'][0]->products_id != $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 0)
                                selected
                                @endif
                                value="no">{{ trans('labels.No') }}</option>
                            <option @if($result['product'][0]->products_id == $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 1)
                                selected
                                @endif
                                value="yes">{{ trans('labels.Yes') }}</option>
                        </select>
                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> {{ trans('labels.SpecialProductText') }}</span>
    
                        <div class="special-container" style="display: none;">
                            <div>
                                <h5>{{ trans('labels.SpecialPrice') }}</h5>
                            
                                    {!! Form::text('specials_new_products_price', $result['specialProduct'][0]->specials_new_products_price, array('class'=>'form-control', 'id'=>'special-price')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialPriceTxt') }}.</span>
                                    <span class="help-block hidden">{{ trans('labels.SpecialPriceNote') }}.</span>
                                
                                <h5>{{ trans('labels.ExpiryDate') }}</h5>
                                
                                    @if(!empty($result['specialProduct'][0]->status) and $result['specialProduct'][0]->status == 1)
                                    {!! Form::text('expires_date', date('d/m/Y', $result['specialProduct'][0]->expires_date), array('class'=>'form-control datepicker', 'id'=>'expiry-date', 'readonly'=>'readonly'))
                                    !!}
                                    @else
                                    {!! Form::text('expires_date', '', array('class'=>'form-control datepicker', 'id'=>'expiry-date', 'readonly'=>'readonly')) !!}
                                    @endif
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.SpecialExpiryDateTxt') }}
                                    </span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                            
    
                            
                                <h5>{{ trans('labels.Status') }}</h5>
                                
                                    <select class="form-control" name="status">
                                    <option
                                        @if($result['specialProduct'][0]->status == 1 )
                                        selected
                                        @endif
                                        value="1">{{ trans('labels.Active') }}
                                        </option>
                                    <option
                                        @if($result['specialProduct'][0]->status == 0 )
                                        selected
                                        @endif
                                        value="0">{{ trans('labels.Inactive') }}</option>
                                    </select>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        {{ trans('labels.ActiveSpecialProductText') }}.</span>
                            </div>
                        </div>
                    </div>
                </div>
            
                
            </div>

            <hr class="edit_hr">
            <span>
                <button class="archive__button" data-toggle="modal" data-target="#archiveModal">Archive product</button>
                <button class="delete__button" id="delete-btn" onclick="prevent" data-toggle="modal" data-target="#deleteModal">Delete product</button>
            </span>
            <button class="btn btn-success" type="submit" style="float: right;">{{ trans('labels.Save_And_Continue') }}</button>
        {!! Form::close() !!}

            <!-- <=====================Dublicate button modal===============> -->

            <div class="modal fade" id="dublicatebuttonModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Duplicate product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"
                                        style="font-size:27px;font-weight:normal;" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="modal-body" style=" overflow-y: scroll;">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Title..">
                                <hr />
                                <p>Select details to copy. All other details except 3D models and videos will<br /> be
                                    copied
                                    from the original product and any variants.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span style="font-weight:normal; margin-left:9px;"> Images</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span style="font-weight:normal; margin-left:9px;"> SKUs</span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled"
                                        disabled>
                                    <label class="form-check-label" for="flexCheckDisabled">
                                        <span style="font-weight:normal; margin-left:9px;"> Barcodes</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span style="font-weight:normal; margin-left:9px;"> Inventory quantities</span>

                                    </label>
                                </div>
                                <hr />
                                <p>Product status</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <span style="font-weight:normal; margin-left:9px;">Set as draft</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <span style="font-weight:normal; margin-left:9px;">Set as active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" style="font-weight: bold;"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" style="font-weight: bold;">Dublicate
                                product</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <=====================Archive button modal===============> -->

            <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Archive product?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"
                                        style="font-size:27px;font-weight:normal;" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Archiving this product will hide it from your sales channels and Shopify admin.
                                You'll find it using the status filter in your product list.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="font-weight: bold;"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" style="font-weight: bold;">Archive
                                product</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <=====================Delete button modal===============> -->

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Delete {{$description_data['products_name']}}?
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"
                                        style="font-size:27px;font-weight:normal;" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        {!! Form::open(array('url' =>'admin/products/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        <input type="hidden" name="products_id" value="<?=$result['product'][0]->products_id ?>">
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {{-- {!! Form::hidden('id', $result['product'][0]->products_id, array('class'=>'form-control', 'id'=>'id')) !!} --}}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteThisProductDiloge') }}?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="font-weight: bold;"
                                data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit"  class="btn btn-danger" style="font-weight: bold;">{{ trans('labels.DeleteProduct') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- <=====================Table Delete button modal===============> -->

            <div class="modal fade" id="deleteModaltable" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Delete product?
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"
                                        style="font-size:27px;font-weight:normal;" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the variant product? This action cannot be reversed..</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="font-weight: bold;"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" style="font-weight: bold;">Delete
                                product</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <=====================Add to cart modal===============> -->

            <div class="modal fade " id="addtocart" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal_for_right" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="margin-top:1%" id="exampleModalLongTitle">JUST ADDED TO YOUR
                                CART
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"
                                        style="font-size:27px;font-weight:normal;" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="display:flex;">
                                <figure>
                                    <img src="https://cdn.shopify.com/s/files/1/0516/5160/8762/products/w_200x.png?v=1611565673"
                                        alt="" style="width:50px;height:57px;" />
                                </figure>
                                <h4 style="margin-left:12px;">Short Sleeve Tshit</h4>

                            </div>
                            <p class="modal___color_text">Color:blue</p>
                            <p class="modal_quantity_text">Qty:1</p>
                            <br />
                            <button class="modal__view_button">VIEW CART<span>(3)</span></button>
                            <div style="display:flex;justify-content:center;">
                                <a href="" style="margin-top:2%;">Continue shopping</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <=================Add to cart page start=======> -->
        {{-- <br />
        <div class="container" style="margin-top: 3%;">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 mx-auto">
                    <img src="https://cdn.shopify.com/s/files/1/0516/5160/8762/products/w_1024x1024@2x.png?v=1611565673"
                        alt="" class="add_to_cart_image_product" />
                </div>
                <div class="col-lg-7 col-md-7 col-12 mx-auto">
                    <h1 style="font-weight:bold;">Short Sleeve Tshit</h1>
                    <h3>Rs.1,000.00</h3>
                    <p>Color</p>
                    <select class="select__color">
                        <option value="">blue</option>
                        <option value="">blue</option>
                    </select>
                    <br />
                    <button class="add__to__cartBtn" data-toggle="modal" data-target="#addtocart">ADD TO
                        CART</button>
                    <br />
                    <button class="buy__it_buton">BUY IT NOW</button>
                    <br />
                    <p style="margin-top:10%;">Test Product</p>
                    <br />
                    <button class="share__buttonsss"><i class="fa fa-facebook-official" aria-hidden="true"
                            style="color:#3b5998;"></i>
                        SHARE</button>
                    <button class="share__buttonsss"><i class="fa fa-twitter" aria-hidden="true"
                            style="color:#00aced;"></i> TWEET</button>
                    <button class="share__buttonsss"><i class="fa fa-pinterest" aria-hidden="true"
                            style="color:#d5494f"></i>
                        PINIT</button>
                </div>
            </div>
        </div>
        <br /> --}}
        {{-- <div class="container-fluid" style="margin-top: 5%;">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 mx-auto">
                    <h4>Quick links</h4>
                    <p>Search</p>
                </div>
                <div class="col-lg-7 col-md-7 col-12 mx-auto">
                    <h4>Newsletter</h4>
                    <div class="input-group" style="width:77%">
                        <input type="email" class="form-control" placeholder="email address">
                        <button type="" class="subcribe___btn">SUBCRIBE</button>
                    </div>
                </div>
            </div>
            <hr />
            <hr class="footer_hr">
            <p style="float:right; margin-right:15%;">© 2021, IfuFull Powered by Shopify</p>
        </div>
        <br />

        <div class="container">
            <h1 class="text-center my-2">Your cart</h1>
            <p class="text-center">Continue shopping</p>
            <div style="overflow-x:auto;">
                <table class="table tabel___width__cs">
                    <thead>
                        <tr>
                            <th>
                            </th>
                            <th>
                                PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="https://cdn.shopify.com/s/files/1/0516/5160/8762/products/w_x190.png?v=1611565673"
                                    alt="" style="width=70px;height:70px;" />
                            </td>
                            <td>
                                <div style="margin-right:3%;">
                                    <h5>Short Sleeve Tshit</h5>
                                    <p>Color:blue</p>
                                    <a href="">Remove</a>
                                </div>
                            </td>
                            <td>
                                <h5>Rs:1000.00</h5>
                            </td>
                            <td>
                                <input type="number" class="product___price-num" />
                            </td>
                            <td>
                                <h4 style="margin-right:15px;">Rs.4,000.00
                                </h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr class="footer_hr">
            <div class="col-4" style="float:right;margin-right:21%;">
                <div class="row">
                    <div class="col-md-4 col-6">
                        <h4>Subtotal </h4>
                    </div>
                    <div class="col-md-8 col-6">
                        <h5 class="mt-2" style="margin-left:15px;">Rs.7,000.00 PKR</h5>

                    </div>
                </div>
                <p>Taxes and shipping calculated at checkout</p>
                <button class="btn__checkouttt">CHECK OUT</button>
            </div>
        </div>
        <br />
        <div class="container-fluid" style="margin-top: 5%;">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 mx-auto">
                    <h4>Quick links</h4>
                    <p>Search</p>
                </div>
                <div class="col-lg-7 col-md-7 col-12 mx-auto">
                    <h4>Newsletter</h4>
                    <div class="input-group" style="width:77%">
                        <input type="email" class="form-control" placeholder="email address">

                        <button type="" class="subcribe___btn">SUBCRIBE</button>
                    </div>
                </div>
            </div>
            <hr />
            <hr class="footer_hr">
            <p style="float:right; margin-right:15%;">© 2021, IfuFull Powered by Shopify</p>
        </div>
        <br /> --}}
    </section>
    <!-- /.content -->
</div>
<script src=" {!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>

<script type="text/javascript">
$(function() {
    document.getElementById("delete-btn").addEventListener("click", function(event){
    event.preventDefault()
    });
    //for multiple languages
    @foreach($result['languages'] as $languages)
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor{{$languages->languages_id}}');
    @endforeach
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

});
</script>
<script>
    $(document).ready(function() {
       document.getElementById("second").style.display = 'none'
       document.getElementById("third").style.display = 'none'
    });

    $('#media-switch').on('change', function() {
        var id =  this.value;

        if (id == 1) {
            document.getElementById("second").style.display = 'block';
            document.getElementById("first").style.display = 'none';
            document.getElementById("third").style.display = 'none';
        } else {
            document.getElementById("second").style.display = 'none';
            document.getElementById("first").style.display = 'block';
            document.getElementById("third").style.display = 'none';
        }
	
    });
 </script>
@endsection