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