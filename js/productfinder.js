jQuery(document).ready( function() {

  jQuery(".select-hersteller, .select-fahrzeug").change(function(e) {
    e.preventDefault();

    if ((target = jQuery(this)
      .children('option:selected')
      .data('url') || false) != false) {
      window.location.href = target;
    }


    /*
    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: productfinder.url,
      data: {
        action: "changedManufacturer",
        herstellerId: jQuery(".select-hersteller").val()
      },
      success: function(fahrzeuge) {
        jQuery(".select-fahrzeug").children().slice(1).remove();
        jQuery.each(fahrzeuge, function(index, fahrzeug) {
          jQuery(".select-fahrzeug").append(
            '<option value="' + fahrzeug.ID + '">' +
            fahrzeug.post_title +
            '</option>'
          );
        });
      }
    });
    */

  });

  jQuery(".select-fahrzeug").change(function(e) {
    e.preventDefault();

    /*
    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: productfinder.url,
      data: {
        action: "changedVehicle",
        fahrzeugId: jQuery(".select-fahrzeug").val()
      },
      success: function(response) {
        window.console && console.log(response);
      }
    });
  */

  });

});