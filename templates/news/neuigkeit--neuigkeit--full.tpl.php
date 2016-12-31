<?php
   $image = $elements['#entity']->field_bild_predefined['und'][0]['value'];
   //dpm($elements['#entity']);
   
   $account =  user_load($elements['#entity'] -> uid);
   $picture = theme('user_picture', array('account' => $account));
   
   //kpr($elements['#entity']);
   $id = $elements['#entity'] -> id;
   $option = $elements['#entity']->field_message_status['und'][0]['value'];
   
   $an = render($content["an"]);
   
   global $user;
?>

<div class="well well-white clearfix well-neuigkeit" >
  
  <div class="clearfix">
    <div class="pull-left news-profile-picture"><?php print $picture; ?></div>
    <p><p>Von: <?php print \LK\u($account -> uid); ?></p>
    <p>Am: <?php print format_date($elements['#entity'] -> created); ?><br />
    
    <?php if($an): ?>
       An: <?php print $an; ?>
    <?php endif; ?>    
     </p>
  </div>
  <hr />
   
  <?php if($image == 'own') : ?>
    
    <div class="thumbnail newspicture pull-right">
      <?php print render($content["field_bild_own"]); ?>
    </div>  
    
  <?php else: ?>
    <div class="thumbnail newspicture pull-right"><img src="<?php print '/sites/all/themes/bootstrap_lk/content/news/' . $image; ?>.jpg" /></div>
  
  <?php endif; ?>
  <h4 style="margin-top: 0;"><?php print $title; ?></h4>
  
  <div class="nachrichten-text">
    <?php 
        print render($content["field_text"]); 
        
        print '<hr />';
        
        print render($content['kampagnen_search']);
        print render($content["field_dateien"]); 
    ?>
  </div>
</div>

<?php if($option != 'draft') :?>
   <div class="well well-white text-right">
      <?php if(lk_is_moderator() AND !lk_is_moderator($elements['#entity'] -> uid)) : ?>
          <a href="<?php print url('messages/new', array("query" => array('neuigkeit' => $id))); ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-envelope"></span> Neuigkeit versenden</a>
       <?php endif; ?>
        
      <a href="<?php print url("user/" . $user -> uid . "/dashboard"); ?>" class="btn btn-sm btn-primary">Zurück zu allen Neuigkeiten <span class="glyphicon glyphicon-chevron-right"></span></a>
   </div>
<?php endif; ?>