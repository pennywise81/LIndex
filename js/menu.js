addMenuButton = function() {
  return jQuery('<button/>', {
    class: 'hamburger hamburger--slider page__menu__toggle',
    type: 'button',
    html: '<span class="hamburger-box"><span class="hamburger-inner"></span></span>'
  }).appendTo('.page__menu__wrapper');
}

$(document).ready(function() {
  var menuButton = addMenuButton(),
    menuWrapper = $('.page__menu__wrapper');

  menuWrapper.on('touchend click', '.page__menu__toggle', function(e) {
    e.stopPropagation();
    e.preventDefault();

    menuButton.toggleClass('is-active');
    menuWrapper.toggleClass('page__menu__wrapper--open page__menu__wrapper--closed');
  });
});