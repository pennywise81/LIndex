(function($) {

  wp.customize('sidebar_side', function(value) {
    value.bind(function(newval) {
      $('aside.sidebar').removeClass('left right').addClass(newval);
    });
  });

  wp.customize('display_sidebar', function(value) {

    value.bind(function(newval) {
      if (newval == 0) {
        $('aside.sidebar').css('display', 'none');
      }
      else {
        $('aside.sidebar').css('display', 'flex');
      }
    });
  });

})(jQuery);