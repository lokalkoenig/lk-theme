 function closeSearchHelp(){
    jQuery("#searchbegin").removeClass('open');
    jQuery('.showtext').hide(500, 'swing');
    jQuery( "#searchbegin" ).animate({ width: "150px"}, 300);
    
  }

 jQuery(document).ready(function(){
    
    jQuery("#searchbegin").focus(function(){
        if(jQuery('#searchbegin').hasClass('open')) return ;
        jQuery('#searchbegin').addClass('open');
        jQuery( "#searchbegin" ).animate({
            width: "+=150"
           
  }, 300, function() {
    jQuery('.showtext').show(500, 'swing');
  });
  });  
 });


function lk_add_js_notfication(msg, scrollto){
  msg_html = '<div class="width alert js-alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>' + msg +'</div>';
  jQuery('.js-alert').remove();
  jQuery(msg_html).insertBefore("#block-system-main>div:first");
  
  if(!scrollto) jQuery.scrollTo('.alert', 500);
  else jQuery.scrollTo(scrollto, 500);  
}


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


function lk_add_js_modal_optin(title, content, link, link_title){
  jQuery('#dynamicmodal').remove();
  jQuery('.modal-backdrop').remove();
  var modal = '<div class="modal fade" id="dynamicmodal" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title">Modal title</h4></div><div class="modal-body clearfix"><p>One fine body&hellip;</p></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal -->';
  
  jQuery(modal).insertAfter("#wrap");
  if(link_title != ''){
    content += '<p style="padding-top: 10px;"><a href="'+ link +'" class="btn btn-danger">' + link_title + '</a></p>';
  }
  jQuery('#dynamicmodal .modal-title').html(title);
  jQuery('#dynamicmodal .modal-body p').html(content);
  jQuery('#dynamicmodal').modal('show');
  console.log(title);
}


function sendRecomondation(){
  
  
  mas = jQuery( "#recomendform .selectpicker" ).val() 
  if(mas == null){
      jQuery('.alert-email').html("Bitte wählen Sie einen Mitarbeiter aus.").toggle('slow');
      return false;
  
  }
  
  jQuery('recomendform .selectpicker').selectpicker('refresh');
  values = jQuery( "#recomendform :input" ).serialize();
  
  jQuery.ajax({
    type: "POST",
    url: "/msg/send",
    data: values
  })
  .done(function( msg ) {
      if(msg.error == 1){
         jQuery('.alert-email').html(msg.msg).show();
      }
      else {
         jQuery('#recomendform').html('<div class="alert alert-success">' + msg.msg + '</div>');
         
         setTimeout(function() {
            jQuery('#dynamicmodal button.close').click();
          }, 2000);
      }
  });
  
  return false;
}

jQuery(document).ready(function(){
  
    if(jQuery('#edit-field-team-verkaufsleiter-und').length){
        jQuery('#edit-field-team-verkaufsleiter-und').selectpicker();
    }
  
  jQuery('a.recomendnode').click(function(){
      lk_add_js_modal_optin('Kampagne versenden', '...Laden', '', '');
      
      form = '<div class="alert alert-warning alert-email" style="display: none;"></div><form type="post" id="recomendform">';
      form += '<input type="hidden" name="nid" value="'+ jQuery(this).attr('nid') +'" />';
      form += sendto_kampas;
      
      form += '<label for="recomendbody">Nachricht (optional)</label><textarea class="form-control form-textarea" name="msg" id="recomendbody"></textarea>';
      form += '<p><br /><button value="Abschicken" class="btn btn-success" onclick="return sendRecomondation()">Abschicken</button></p>';
      form += '</form>';
      
      jQuery('.modal-body').html(form);
      jQuery('.selectpicker').selectpicker();
          
      
      
      
      return false;   
  });
  
  // Telefonmitarbeiter
  jQuery('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').click(function(){
      if(jQuery(this).attr('checked')){
             jQuery('.field-name-field-plz-sperre').hide();
      }
      else {
        jQuery('.field-name-field-plz-sperre').show();
      
      }
  });
  
  
  if(jQuery('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').length){
      if(jQuery('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').attr('checked')){
             jQuery('.field-name-field-plz-sperre').hide();
      }
      else {
        jQuery('.field-name-field-plz-sperre').show();
      }
  }
  
  
  
  jQuery('#edit-profile-mitarbeiter-field-telefonmitarbeiter-und').each(function(){
     if(jQuery(this).attr('checked')){
             jQuery('.field-name-field-plz-sperre').hide();
      }
      else {
        jQuery('.field-name-field-plz-sperre').show();
      
      }
  });
  

  jQuery('.showindicator').click(function(){
      
      el = this;
    
      jQuery(this).parent('.tgrid').children('.contenthover2').slideToggle(400,
        function(){
              
            
            if(jQuery(el).hasClass('active')){
                jQuery(el).children('span').removeClass('glyphicon-remove');
                jQuery(el).children('span').addClass('glyphicon-chevron-up');
                
                jQuery(el).removeClass('active');
            }
            else {
                jQuery(el).children('span').removeClass('glyphicon-chevron-up');
                jQuery(el).children('span').addClass('glyphicon-remove');
                jQuery(el).addClass('active');
                
                
                jQuery('.showindicator.active').each(function(){
                    if(this != el){
                       jQuery(this).children('span').removeClass('glyphicon-remove');
                       jQuery(this).children('span').addClass('glyphicon-chevron-up'); 
                       jQuery(this).removeClass('active');   
                       jQuery(this).parent('.tgrid').children('.contenthover2').hide();
                    }
                });
                
            }
        
        }
      );
  });
  
  if(jQuery('.view-id-suchev2').length){
       if(jQuery('.page-user-dashboard').length == 1) return ;
     
     
     height = jQuery('.sidebars').height() - 75;
     height2 = jQuery('#main').height();
     
     if(height > height2){
        jQuery('.block-system').css('height', height);
     }
  }
  
  
  jQuery('a.optindelete').click(function(){
      title = jQuery(this).attr('optintitle');
      text = jQuery(this).attr('optin');  
      link = jQuery(this).attr('href');  

      label = jQuery(this).attr('optin_label');
      if(!label){
        label = 'Löschen';
      }

      lk_add_js_modal_optin(title, text, link, label);
      return false;
  });
  
  
  jQuery('.alert-icon').click(function(){
      //lk_add_js_modal_optin('Kampagnen Informationen', 'Wird geladen...', '', '');
      
      jQuery.get(jQuery(this).attr('href'), function(result){
          //$("div").html(result);
         lk_add_js_modal_optin('Kampagnen Informationen', result, '', '');
      });
      
      return false;
  });
  
  jQuery('.sidebars ul.extended ul.extended a').each(function(){
    jQuery(this).html('<span class="glyphicon glyphicon-trash"></span> ' + jQuery(this).html());  
  });
});


function activetePreview(id, fileid){
     here = jQuery(window).height() - 20;
     
     //if(here > 500) here = 500;
     
     //alert(here);
     jQuery('.preview_container').css('height', here);
     
     
     
     jQuery('.tab-inner').css('height', here - 98);
        
     jQuery('.previews').hide(); 
     jQuery('.preview_item .more').hide();
     
     
     jQuery('.previews#pres_medium_' + id).show();
     
     jQuery('.preview_link>.preview_item').removeClass('active');
     jQuery('#pres_medium_item_' + id).addClass('active');
     jQuery('#pres_medium_item_' + id + ' .more').show(400, function(){
        if(fileid){
          jQuery('#tabs_'+ id +' a[href="#file_'+ fileid +'"]').tab('show')
        }
     });
  }


/**
 * Copyright (c) 2007-2014 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 1.4.12
 */
;(function(a){if(typeof define==='function'&&define.amd){define(['jquery'],a)}else{a(jQuery)}}(function($){var j=$.scrollTo=function(a,b,c){return $(window).scrollTo(a,b,c)};j.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};j.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(f,g,h){if(typeof g=='object'){h=g;g=0}if(typeof h=='function')h={onAfter:h};if(f=='max')f=9e9;h=$.extend({},j.defaults,h);g=g||h.duration;h.queue=h.queue&&h.axis.length>1;if(h.queue)g/=2;h.offset=both(h.offset);h.over=both(h.over);return this._scrollable().each(function(){if(f==null)return;var d=this,$elem=$(d),targ=f,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=win?$(targ):$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}var e=$.isFunction(h.offset)&&h.offset(d,targ)||h.offset;$.each(h.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=j.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(h.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=e[pos]||0;if(h.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*h.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(h.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&h.queue){if(old!=attr[key])animate(h.onAfterFirst);delete attr[key]}});animate(h.onAfter);function animate(a){$elem.animate(attr,g,h.easing,a&&function(){a.call(this,targ,h)})}}).end()};j.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return $.isFunction(a)||typeof a=='object'?a:{top:a,left:a}};return j}));

