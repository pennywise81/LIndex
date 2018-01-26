jQuery(document).ready( function() {

  jQuery(".select-hersteller, .select-fahrzeug").change(function(e) {
  // jQuery(".select-hersteller").change(function(e) {
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
        // Fahrzeuge zurücksetzen ...
        jQuery(".select-fahrzeug").children().slice(1).remove();

        // ... und neu befüllen
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
      success: function(items) {
        window.console && console.log(items);

        if (items.length == 1) {
          window.console && console.log(items[0].id);
        } else {
          window.console && console.log('mehrere ergebnisse');
        }
      }
    });
    */

  });

});