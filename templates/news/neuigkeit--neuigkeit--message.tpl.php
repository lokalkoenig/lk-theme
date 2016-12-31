<?php
  global $user;

   $image = $elements['#entity']->field_bild_predefined['und'][0]['value'];
   if($image == 'own'){
       $image_url = strip_tags(trim(render($content["field_bild_own"])));
       $explode = explode("?", $image_url);
       $image_url = $explode[0];
   }
   
   //dpm($elements['#entity']);
   
   $account =  user_load($elements['#entity'] -> uid);
   $picture = theme('user_picture', array('account' => $account));
   
   $url = 'neuigkeiten/' . $elements['#entity']  -> id;
   
    
?>

<div class="well well-white well-neuigkeit-teaser well-neuigkeit clearfix" >
   <table width="100%">
    <tr><td valign="top" width="260">  
 
  <?php if($image == 'own') : ?>
    
    <div class="thumbnail newspicture pull-right">
      <img src="<?php print $image_url; ?>"  width="250" height="250" />
    </div>  
 
  <?php else: ?>
    <div class="thumbnail newspicture pull-right"><img width="250" height="250" src="<?php print 'http://www.lokalkoenig.de/sites/all/themes/bootstrap_lk/content/news/' . $image; ?>.jpg" /></div>
  
  <?php endif; ?>
  </td>
  <td valign="top">
    <div style="padding-left: 20px;">
      <h3><a href="<?php print url($url); ?>"><?php print $title; ?></a></h3>
  
      <div class="nachrichten-text">
        <?php print render($content["field_text"]); ?>
      </div>
      
       <p>&nbsp;</p>  
  <p><a href="<?php print url($url, array("absolute" => true)); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Weiterlesen</a></p>

  </div>
   </td>
  </tr>
  </table>
</div>