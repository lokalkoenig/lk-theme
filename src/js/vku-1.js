
function generateCurrentVKU(update){

  // Wenn Updaten, dann auf jeden Fall updaten
  if(update){

  }
  else {
    if(jQuery('#vkuload').length == 1){
      jQuery('#vkuload .well').hide();
      jQuery('#vkuload').slideToggle();

     return false;
    }
  }

  jQuery('#vkuload').remove();

  offset1 = jQuery('.block-lokalkoenig-merkliste').offset();

  jQuery('#vku_cart').show();
  offset2 = jQuery('#vku_cart').offset();
  left = offset2.left;
  preview = '<div id="vkuload"></div>';
  jQuery(preview).insertBefore("#page");
  jQuery('#vkuload').css('left', left);

   jQuery.ajax({
      url : '/vku/get',
      success: function(data, textStatus, jqXHR){
          jQuery('#vkuload').html(data.content);
          jQuery('#vkuload').css('height', 'auto');
          jQuery('#vkuload').css('width', 'auto');

          if(update){
             jQuery('#vkuload .well').html(update);
             jQuery('#vkuload .well').show();
             //jQuery.scrollTo('#header', 500);
          }

      },
      error: function (jqXHR, textStatus, errorThrown){
         alert('Ein Fehler ist aufgetreten');
      }
    });


  return false;
}