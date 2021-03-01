
function serchfunction()
{

   $('.search-filter').hide();
    $('.serachproductlist').show();

     var searchresult = [
      {
        id: 1,
        name: 'product 1',
        image: 'https://s.cdpn.io/3/dingo-dog-bones.jpg',
        stock: 50,
        price: 100
      },
      {
       id: 2,
        name: 'product 2',
        image: 'https://s.cdpn.io/3/dingo-dog-bones.jpg',
        stock: 50,
        price: 75
      },
      {
       id: 3,
        name: 'product 3',
        image: 'https://s.cdpn.io/3/dingo-dog-bones.jpg',
        stock: 20,
        price: 80
      },
      {
       id: 4,
        name: 'product 4',
        image: 'https://s.cdpn.io/3/dingo-dog-bones.jpg',
        stock: 10,
        price: 30
      }
     ];
     var htmllist = '';
	 console.log($('.products_json'));
	 searchresult = $(".products_json").val();
	 console.log(searchresult);
	 searchresult = JSON.parse(searchresult);
     $.each(searchresult, function(i,e){
        console.log(e);
        htmllist += '<input type="checkbox" name="CheckBoxInputName" value="'+e.pid+'" id="CheckBox'+e.pid+'" />\n\
              <label class="list-group-item" for="CheckBox'+e.pid+'">\n\
					<input type="hidden" name="product_data'+e.pid+'" value=\''+JSON.stringify(e)+'\' id="product_data'+e.pid+'" class="product_data"/>\n\
                  <div class="pdlistMain">\n\
                      <div class="pdtitlMain">\n\
                          <span class="pd_img">\n\
                              <img src="/'+e.path+'">\n\
                          </span>\n\
                          <span class="pd_title">'+e.products_name+'</span>\n\
                      </div>\n\
                      <div class="pdpricMain">\n\
                          <span class="pd_stock">in Stock '+e.products_quantity+'</span>\n\
                          <span class="pd_price pull-right">$'+e.products_price+'</span>\n\
                      </div>\n\
                  </div>\n\
              </label>';
     });

     $('.serachproductlist .list-group').html(htmllist);
}

$(document ).ready(function(){
  $('.search-filter > li').click(function(e){
	  e.preventDefault();
      serchfunction();
  });

	$(document).on('click','.serachproductlist label.list-group-item', function(){
			
			product = $(this).find("input.product_data").val();
			product = JSON.parse(product);
			console.log(product);
			htmllist = '<div class="product">\n\
                                    <div class="product-image">\n\
                                      <img src="/'+product.path+'">\n\
                                    </div>\n\
                                    <div class="product-details">\n\
                                      <div class="product-title"><a href="#">'+product.products_name+'</a></div>\n\
                                    </div>\n\
                                    <div class="product-price">'+product.products_price+'</div>\n\
                                    <div class="product-quantity">\n\
                                      <input type="number" value="1" min="1">\n\
                                    </div>\n\
                                    <div class="product-removal">\n\
                                      <button class="remove-product">\n\
                                        X\n\
                                      </button>\n\
                                    </div>\n\
                                    <div class="product-line-price">'+product.products_price+'</div>\n\
                                </div>';
			$('.cart-products').html(htmllist);
			product = $('.cart-products .product input[type="number"]');
			console.log(product[0]);
			updateQuantity(product[0]);
			
	});
								  
  $('.detailsbox').click(function(){
      $('.customerlist').fadeOut();
      $('.orderdetailMain > .sc_Main h3').hide();
      $('.orderdetailMain > .sc_Main .customesearch').hide();
	  //Fill in customer data
	  customer = $(this).data("customer");
	  console.log(customer);
	  $('.ct_viewmain .ct_info .customer_id').val(customer.id);
	  console.log(JSON.stringify(customer));
	  $('.ct_viewmain .ct_info .customer_data').val(JSON.stringify(customer));
	  $('.ct_viewmain .ct_info .ct_name').text(customer.first_name +' '+customer.last_name);
	  $('.ct_viewmain .ct_info .ct_email').text(customer.email);
	  if(customer.avatar) //set profile image
		  $('.ct_viewmain .image_and_orders img').attr("src", customer.avatar);
		  
	if(customer.entry_firstname || customer.entry_lastname || customer.entry_street_address )
		customer_address = '<p>'+customer.entry_firstname+' '+customer.entry_lastname+'</p>'
						+'<p>'+customer.entry_street_address+'</p>'
						+'<p>'+customer.entry_suburb+', '+customer.entry_city+'</p>';
	else customer_address = "Address Not Found!";
	$('.ct_viewmain .ct_shipping div').html(customer_address);
	
      $('.ct_viewmain').fadeIn();
  });

    $('.ct_header i.fa-times').click(function(){
		$('.ct_viewmain .ct_info .customer_id').val("");
		$('.ct_viewmain .ct_info .customer_data').val('');
      $('.ct_viewmain').hide();
      $('.customerlist').removeAttr("style");
      $('.orderdetailMain > .sc_Main h3').fadeIn();
      $('.orderdetailMain > .sc_Main .customesearch').fadeIn();
  });

	$(document).on('click','.ct_viewmain .edituser', function(){
		//Fill User data in Edit user form
		customer = $('.ct_viewmain .ct_info .customer_data').val();
		customer = JSON.parse(customer);
	  console.log(customer.first_name);
	  
	  $('#edituser input[name=cid]').val(customer.id);
	  $('#edituser input[name=first_name]').val(customer.first_name);
	  $('#edituser input[name=last_name]').val(customer.last_name);
	  $('#edituser input[name=email]').val(customer.email);
	  $('#edituser input[name=phone]').val(customer.phone);
	  $('#edituser input[name=entry_company]').val(customer.entry_company);
	  $('#edituser input[name=entry_street_address]').val(customer.entry_street_address);
	  $('#edituser input[name=entry_suburb]').val(customer.entry_suburb);
	  $('#edituser input[name=entry_city]').val(customer.entry_city);
	  $('#edituser input[name=entry_country_id]').val(customer.entry_country_id);
	  $('#edituser input[name=entry_state]').val(customer.entry_state);
	  $('#edituser input[name=entry_postcode]').val(customer.entry_postcode);
	});


var taxRate = 0.05;
var shippingRate = 0.00; 
var fadeTime = 300;

/* Assign actions */
$(document).on('change', '.shopping-cart .product .product-quantity input', function(){
  console.log('nabeel');
  updateQuantity(this);
});

$(document).on('click', '.shopping-cart .product .product-removal button', function() {
  removeItem(this);
});




/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.shopping-cart .product').each(function () {
    subtotal += parseFloat($(this).children('.shopping-cart .product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.shopping-cart .totals-value').fadeOut(fadeTime, function() {
    $('.shopping-cart #cart-subtotal').html(subtotal.toFixed(2));
    $('.shopping-cart #cart-tax').html(tax.toFixed(2));
    $('.shopping-cart #cart-shipping').html(shipping.toFixed(2));
    $('.shopping-cart #cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.shopping-cart .checkout').fadeOut(fadeTime);
    }else{
      $('.shopping-cart .checkout').fadeIn(fadeTime);
    }
    $('.shopping-cart .totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.shopping-cart .product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  console.log(linePrice);
  /* Update line price display and recalc cart totals */
  productRow.children('.shopping-cart .product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });  
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}

//Save Draft 
$(document).on('click', '.save_draft', function() {
	$(".messages span.message").text("Order Saved as Draft!");
	setTimeout(function(){ $(".messages").show(); $(".delete_draft").removeAttr("disabled"); }, 1500);
});

$(document).on('click', '.apply_coupon', function() {
	$(".coupon_messages span.message").text("Coupon is expired or doesn't exist!");
	setTimeout(function(){ $(".coupon_messages").show(); }, 1500);
});

});
