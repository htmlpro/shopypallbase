/* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 15.00; 
var fadeTime = 300;


/* Assign actions */
$('.orderdetailMain .product-quantity input').change( function() {
  updateQuantity(this);
});

$('.orderdetailMain .product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.orderdetailMain .product').each(function () {
    subtotal += parseFloat($(this).children('.orderdetailMain .product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.orderdetailMain .totals-value').fadeOut(fadeTime, function() {
    $('.orderdetailMain #cart-subtotal').html(subtotal.toFixed(2));
    $('.orderdetailMain #cart-tax').html(tax.toFixed(2));
    $('.orderdetailMain #cart-shipping').html(shipping.toFixed(2));
    $('.orderdetailMain #cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.orderdetailMain .checkout').fadeOut(fadeTime);
    }else{
      $('.orderdetailMain .checkout').fadeIn(fadeTime);
    }
    $('.orderdetailMain .totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.orderdetailMain .product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.orderdetailMain .product-line-price').each(function () {
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





function serchfunction()
{

   $('.search-filter').hide();
    $('.serachproductlist').show();

     var serchresult = [
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
     $.each(serchresult, function(i,e){
        console.log(e.name);
        htmllist += ' <input type="checkbox" name="CheckBoxInputName" value="'+e.id+'" id="CheckBox'+e.id+'" />\n\
              <label class="list-group-item" for="CheckBox'+e.id+'">\n\
                  <div class="pdlistMain">\n\
                      <div class="pdtitlMain">\n\
                          <span class="pd_img">\n\
                              <img src="'+e.image+'">\n\
                          </span>\n\
                          <span class="pd_title">'+e.name+'</span>\n\
                      </div>\n\
                      <div class="pdpricMain">\n\
                          <span class="pd_stock">in Stock '+e.stock+'</span>\n\
                          <span class="pd_price pull-right">$'+e.price+'</span>\n\
                      </div>\n\
                  </div>\n\
              </label>';
     });

     $('.serachproductlist .list-group').html(htmllist);
}


$(document ).ready(function(){
  $('.search-filter > li').click(function(){
      serchfunction();
  });

  $('.detailsbox').click(function(){
      $('.customerlist').fadeOut();
      $('.ct_viewmain').fadeIn();
  });

});
