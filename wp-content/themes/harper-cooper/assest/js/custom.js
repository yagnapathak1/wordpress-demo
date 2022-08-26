$(document).ready(function() {

  $('#navbarSideButton').on('click', function() {
    $('#menu-main-menu').addClass('reveal');
    $('.overlay').show();
  });

  $('.overlay').on('click', function(){
    $('#menu-main-menu').removeClass('reveal');
    $('.overlay').hide();
  });

});
