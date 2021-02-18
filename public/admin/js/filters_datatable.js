jQuery(function ($) {
    
	//Define & Setup Data Table
    var dTable = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
		"dom": '<"length col-md-1"l><"filters col-md-11"f>tp<"clear">',
        ajax: "/admin/orders/display",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'customers_name', name: 'customers_name'},
            {data: 'ordered_source_label', name: 'ordered_source_label'},
			{data: 'order_price', name: 'order_price'},
            {data: 'date_purchased', name: 'date_purchased'},
            {data: 'orders_status', name: 'orders_status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
		initComplete: function () {
            //Drop Down Filters
			this.api().columns().indexes().flatten().each( function ( idx ) {

				var column = this;
				var column = this.column( idx );
				console.log(idx);
				label = ['ID', 'Customers', 'Sources', 'Total Price', 'Dated', 'Statuses'];
				if(idx != 0 && idx != 3 && idx != 4 && idx != 6){ //Skip ID, Date, Price & Action column
					console.log(column);
					var select = $('<div class="dropdown filterDropdown-'+label[idx]+'">'
								  +'<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu-f'+idx+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
									+label[idx]
									+'<span class="caret"></span>'
								  +'</button>'
								  +'<ul class="dropdown-menu sort-menu" aria-labelledby="dropdownMenu2">'
									+'<li class="dropdown-header">'+label[idx]+'</li>'
								  +'</ul>'
								+'</div>')
					//var select = $('<label><select id="filter-'+label[idx]+'" class="form-control form-control-sm"><option value="">'+label[idx]+'</option></select></label>')
						.appendTo( $("#example1_filter") )
						.on( 'change', 'input', function () {
							var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
							if(this.checked) {
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
								//Show the current selection pill:
								$("#example1_wrapper .filters").append('<span class="badge" data-value="'+val+'">'+val+'</span>');
								$(".saveViewDropDown .selected_filters").append('<span class="badge" data-value="'+val+'">'+val+'</span>');
							}else {
								column
									.search( '', true, false )
									.draw();
								$("#example1_wrapper .filters").find('span[data-value="'+val+'"]').remove();
								$(".saveViewDropDown .selected_filters").find('span[data-value="'+val+'"]').remove();
							}
						} );
	 
					column.data().unique().sort().each( function ( d, j ) {
						select.find('ul').append( '<li value="'+d+'"><label class="radio-inline"><input type="checkbox" name="optradio" data-column="3" data-direction="desc" value="'+d+'">'+d+'</label></li>' )
					} );

					//Status Buttons Tabs & Saved Views
					if(idx == 5){
						var btnGroup = $('<div class="btn-group" role="group" aria-label="..."><button type="button" class="btn btn-default active" data-value="">All</button></div>')
							.appendTo($("#filter-btn-row"))
							.on( 'click', 'button', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).data('value')
								);
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
									
								$("#filter-btn-row .btn").removeClass("active");
								$(this).addClass("active");
								$(this).blur();
							});
							
						column.data().unique().sort().each( function ( d, j ) {
							btnGroup.append( '<button type="button" class="btn btn-default" data-value="'+d+'">'+d+'</button>' );
						} );
						
						var savedViews = $('.yajra-datatable').data("savedviews");
						//console.log(savedViews);
						$.each( savedViews, function(i, v){
							btnGroup.append( '<button type="button" class="btn btn-default" data-value="'+v.selected_filters+'">'+v.view_name+'</button>' );
						});
					}
				}
            } );
			
			//More Filters
			var moreFilters = $('<label class="more-filters"><button class="btn btn-default" type="button" id="more-filters" >More filters</button></label>')
							//+'<aside id="morefilter-aside">'
							//+'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
							//+'<ul class="asideList"><li><a href="" class="asideAnchor">Link</a></li></ul></aside>')
							.appendTo($("#example1_filter"))
							.on( 'click', 'button', function () {
								console.log("More btn clicked");
								console.log($("#morefilter-aside"));
								$("#morefilter-aside").toggleClass('active');
							});
							
			$("#example1_filter").on( 'click', '.close', function () {
								$("#morefilter-aside").toggleClass('active');
							});
			
			//Save View Drop Down
			var saveViewDropDown = $('<div class="dropdown saveViewDropDown">'
								  +'<button class="btn btn-default dropdown-toggle" type="button" id="dropdownSaveView" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
									+'Save View'
									+'<span class="caret"></span>'
								  +'</button>'
								  +'<div class="dropdown-menu saveViewDropDownBody p-4" aria-labelledby="dropdownSaveView">'
								  +'<div class="card"> \
									<div class="card-header" id="orderDate"> \
									  <h5 class="mb-0"> \
										Save Current View\
									  </h5> \
									</div> \
									<div id="collapseOrderDate" class="" aria-labelledby="orderDate" data-parent="#accordionMoreFilters"> \
									  <div class="card-body"> \
										<div class="form-group selected_filters" data-filters=""> \
										</div> \
									    <div class="form-group"> \
										<label>View Name </label><input type="text" name="view_name" class="viewName"/> \
										<div class="viewMessage" ></div> \
										</div> \
										 <div class="dropdown-divider"></div> \
										 <button type="button" class="btn btn-default cancelSaveView">Cancel</button> \
										 <button type="button" class="btn btn-primary saveViewButton">Save</button> \
									  </div> \
									</div> \
								</div> '
								  +'</div>'
								  +'</div>')
							.appendTo($("#example1_filter"));
			console.log(saveViewDropDown);
			
			//Sort Drop Down
			var sortDropdown = $('<div class="dropdown sortDropdown">'
								  +'<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
									+'Sort'
									+'<span class="caret"></span>'
								  +'</button>'
								  +'<ul class="dropdown-menu sort-menu" aria-labelledby="dropdownMenu2">'
									+'<li class="dropdown-header">Sort By</li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="4" data-direction="asc"  value="1">Date (oldest first)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="4" data-direction="desc" value="1">Date (newest first)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="1" data-direction="asc" value="1">Customer name (A-Z)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="1" data-direction="desc" value="1">Customer name (Z-A)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="5" data-direction="asc" value="1">Order status (A-Z)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="5" data-direction="desc" value="1">Order status (Z-A)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="3" data-direction="asc" value="1">Total price (low to high)</label></li>'
									+'<li><label class="radio-inline"><input type="radio" name="optradio" data-column="3" data-direction="desc" value="1">Total price (high to low)</label></li>'
								  +'</ul>'
								+'</div>')
							//<div class="btn-group" role="group" aria-label="..."><button type="button" class="btn btn-default" data-value="">All</button></div>')
							.appendTo($("#example1_filter"));
							
							$("#example1_filter").on( 'change', 'input[name="optradio"]', function () {
								console.log("Sort change ...");
								var column = $(this).data('column');
								var direction = $(this).data('direction');
								console.log(column);
								dTable
								.column( column )
								.order( direction )
								.draw();
								
								//dTable.fnSort([ [3,'asc']] );
							});
							
			
								  
        }
    }); 
	
	$(document).on("click", ".saveViewButton", function(e){
		e.preventDefault();
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			/* the route pointing to the post function */
			url: '/admin/orders/savedorderviews/store',
			type: 'PUT',
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}, 
			/* send the csrf-token and the input to the controller */
			data: {
					_token: CSRF_TOKEN, 
					view_name:$('.viewName').val(), 
					selected_filters:$('.selected_filters').data('filters'), 
					user:1, 
				},
			dataType: 'JSON',
			/* remind that 'data' is the response of the AjaxController */
			success: function (data) { 
				$(".viewMessage").append(data.msg); 
			}
		}); 
	});
	
	$.fn.DataTable.ext.order['dom-radio'] = function ( settings, col ) {
		return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
			return $('input[type=radio]:checked', td).val();
		} );
	};
});