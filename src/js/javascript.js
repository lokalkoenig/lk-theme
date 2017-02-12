///
/// LK - Theme JS
///
$ = jQuery;

function lk_add_js_notfication(msg, scrollto){
  var msg_html = '<div class="width alert js-alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>' + msg +'</div>';
  $('.js-alert').remove();
  $(msg_html).insertBefore("#block-system-main>div:first");

  //
  if(!scrollto) {
    $.scrollTo('.alert', 500);
  }
  else {
    $.scrollTo(scrollto, 500);
  }
}

function lk_add_js_modal_optin(title, content, link, link_title){
  $('#dynamicmodal').remove();
  $('.modal-backdrop').remove();
  var modal = '<div class="modal fade" id="dynamicmodal" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title">Modal title</h4></div><div class="modal-body clearfix"><p>One fine body&hellip;</p></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal -->';

  $(modal).insertAfter("#wrap");
  if(link_title !== ''){
    content += '<p style="padding-top: 10px;"><a href="'+ link +'" class="btn btn-danger">' + link_title + '</a></p>';
  }
  $('#dynamicmodal .modal-title').html(title);
  $('#dynamicmodal .modal-body p').html(content);
  $('#dynamicmodal').modal('show');
}

function sendRecomondation(){
  var mas = $( "#recomendform .selectpicker" ).val();

  if(mas === null){
    $('.alert-email').html("Bitte wählen Sie einen Mitarbeiter aus.").toggle('slow');
    return false;
  }

  $('recomendform .selectpicker').selectpicker('refresh');
  var values = $( "#recomendform :input" ).serialize();

  $.ajax({
    type: "POST",
    url: "/msg/send",
    data: values
  })
  .done(function( msg ) {
    if(msg.error === 1){
       $('.alert-email').html(msg.msg).show();
    }
    else {
       $('#recomendform').html('<div class="alert alert-success">' + msg.msg + '</div>');

       setTimeout(function() {
          $('#dynamicmodal button.close').click();
        }, 2000);
    }
  });

return false;
}

function activetePreview(id, fileid){

  var here = $(window).height() - 20;
  $('.preview_container').css('height', here);
  $('.tab-inner').css('height', here - 98);
  $('.previews').hide();
  $('.preview_item .more').hide();
  $('.previews#pres_medium_' + id).show();
  $('.preview_link>.preview_item').removeClass('active');
  $('#pres_medium_item_' + id).addClass('active');

  $('#pres_medium_item_' + id + ' .more').show(400, function(){
    if(fileid){
       $('#tabs_'+ id +' a[href="#file_'+ fileid +'"]').tab('show')
    }
  });
}

(function($) {
  
  $(document).ready(function(){
    // @todo - if this still available
    if($('#edit-field-team-verkaufsleiter-und').length){
      $('#edit-field-team-verkaufsleiter-und').selectpicker();
    }

    // recomend node
    $('a.recomendnode').click(function(){
      lk_add_js_modal_optin('Kampagne versenden', '...Laden', '', '');

      var form = '<div class="alert alert-warning alert-email" style="display: none;"></div><form type="post" id="recomendform">';
      form += '<input type="hidden" name="nid" value="'+ $(this).attr('nid') +'" />';
      form += sendto_kampas;

      form += '<label for="recomendbody">Nachricht (optional)</label><textarea class="form-control form-textarea" name="msg" id="recomendbody"></textarea>';
      form += '<p><br /><button value="Abschicken" class="btn btn-success" onclick="return sendRecomondation()">Abschicken</button></p>';
      form += '</form>';

      $('.modal-body').html(form);
      $('.selectpicker').selectpicker();

      return false;
    });

    // @todo - if this still available
    // Telefonmitarbeiter
    $('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').click(function(){
      if($(this).attr('checked')){
        $('.field-name-field-plz-sperre').hide();
      }
      else {
        $('.field-name-field-plz-sperre').show();
      }
    });

    // @todo - if this still available
    if($('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').length){
      if($('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').attr('checked')){
        $('.field-name-field-plz-sperre').hide();
      }
      else {
        $('.field-name-field-plz-sperre').show();
      }
    }

    if($('.view-id-suchev2').length){
      if($('.page-user-dashboard').length == 1) return ;

       var height = jQuery('.sidebars').height() - 75;
       var height2 = jQuery('#main').height();

       if(height > height2){
          $('.block-system').css('height', height);
       }
    }

    // Fast delect confirmation
    $('a.optindelete').click(function(){
      var title = $(this).attr('optintitle');
      var text = $(this).attr('optin');
      var link = $(this).attr('href');

      var label = $(this).attr('optin_label');
      if(!label){
        label = 'Löschen';
      }

      lk_add_js_modal_optin(title, text, link, label);
      return false;
    });

    // Get campaign-infos
    $('.alert-icon').click(function(){
      $.get(jQuery(this).attr('href'), function(result){
        lk_add_js_modal_optin('Kampagnen Informationen', result, '', '');
      });
      return false;
    });

    $('.sidebars ul.extended ul.extended a').each(function(){
      $(this).html('<span class="glyphicon glyphicon-trash"></span> ' + $(this).html());
    });


    
    $('body').on('click', '.showindicator', function(){
      var el = this;
     
      $(this).parent('.tgrid').children('.contenthover2').slideToggle(400,
        function(){
          if($(el).hasClass('active')){
            $(el).children('span').removeClass('glyphicon-remove');
            $(el).children('span').addClass('glyphicon-chevron-up');
            $(el).removeClass('active');
          }
          else {
            $(el).children('span').removeClass('glyphicon-chevron-up');
            $(el).children('span').addClass('glyphicon-remove');
            $(el).addClass('active');

            $('.showindicator.active').each(function(){
                if(this != el){
                   $(this).children('span').removeClass('glyphicon-remove');
                   $(this).children('span').addClass('glyphicon-chevron-up');
                   $(this).removeClass('active');
                   $(this).parent('.tgrid').children('.contenthover2').hide();
                }
            });
          }
        }
      );
    });
  });
})( jQuery );
