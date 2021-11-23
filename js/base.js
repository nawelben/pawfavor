$('body').on('click', '.upper-show-menu', function(){
  if($('.profile-position-absolute').hasClass('d-none')){
    $('.profile-position-absolute').removeClass('d-none')
    $('.upper-show-menu .transition_03s').removeClass('rotate-z-180')
  }else{
    $('.profile-position-absolute').addClass('d-none')
    $('.upper-show-menu .transition_03s').addClass('rotate-z-180')
  }


});

function parseDate(str) {
  var mdy = str.split('-');
  return new Date(mdy[0], mdy[1]-1, mdy[2]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return (Math.round((second-first)/(1000*60*60*24)))+1;
}


$('body').on('change', 'select[name="_service"]', function(){
  var nbDays = datediff(parseDate($('input[name="_start"]').val()), parseDate($('input[name="_end"]').val()));
  var serviceName = $(this).find('option:selected').text();
  var servicePrice = $(this).find('option:selected').attr('data-price');
  $('.__booking_service_name').text(serviceName);
  $('.__booking_service_price').text(servicePrice);
  var totalPrice = nbDays*servicePrice;
  $('.__total_price').text(totalPrice);
  $('.__total_price_hidden').val(totalPrice);
});

$('body').on('change', 'input[name="_start"]', function(){
  var nbDays = datediff(parseDate($('input[name="_start"]').val()), parseDate($('input[name="_end"]').val()));
  var serviceName = $('select[name="_service"]').find('option:selected').text();
  var servicePrice = $('select[name="_service"]').find('option:selected').attr('data-price');
  $('.__booking_service_name').text(serviceName);
  $('.__booking_service_price').text(servicePrice);
  var totalPrice = nbDays*servicePrice;
  $('.__total_price').text(totalPrice);
  $('.__total_price_hidden').val(totalPrice);
});

$('body').on('change', 'input[name="_end"]', function(){
  var nbDays = datediff(parseDate($('input[name="_start"]').val()), parseDate($('input[name="_end"]').val()));
  var serviceName = $('select[name="_service"]').find('option:selected').text();
  var servicePrice = $('select[name="_service"]').find('option:selected').attr('data-price');
  $('.__booking_service_name').text(serviceName);
  $('.__booking_service_price').text(servicePrice);
  var totalPrice = nbDays*servicePrice;
  $('.__total_price').text(totalPrice);
  $('.__total_price_hidden').val(totalPrice);
});


$('body').on('click', '.conversation-header', function(){
  $(this).parent().submit();
});
