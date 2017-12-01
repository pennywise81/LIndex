addMenuButton = function() {
  return jQuery('<button/>', {
    class: 'hamburger hamburger--slider menu-toggle',
    type: 'button',
    html: '<span class="hamburger-box"><span class="hamburger-inner"></span></span>'
  }).appendTo('.menu-wrapper');
}

toggleMenu = function() {
  //
}

$(document).ready(function() {
  var menuButton = addMenuButton(),
    menuWrapper = $('.menu-wrapper');


  menuWrapper.on('touchend click', '.menu-toggle', function(e) {
    e.stopPropagation();
    e.preventDefault();

    menuButton.toggleClass('is-active');
    menuWrapper.toggleClass('open closed');
  });
});