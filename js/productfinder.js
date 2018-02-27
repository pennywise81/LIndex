jQuery(document).ready( function() {

  jQuery(".productfinder__searchform select").change(function(e) {
  // jQuery(".select-hersteller").change(function(e) {
    e.preventDefault();

    if ((target = jQuery(this)
      .children('option:selected')
      .data('url') || false) != false) {
      window.location.href = target;
    }

  });

  jQuery('.variant-filters').change(function(e) {
    e.preventDefault();

    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: productfinder.url,
      data: {
        action: "variant_changed",
        f_id: jQuery(".select-fahrzeug").val()
      },
      success: function(items) {
        window.console && console.log(items);
      }
    });
  });

});