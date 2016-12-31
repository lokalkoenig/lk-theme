<?php
  global $user;

  $image = $elements['#entity']->field_bild_predefined['und'][0]['value'];
  $account =  user_load($elements['#entity'] -> uid);
  $picture = theme('user_picture', array('account' => $account));
  $url = 'user/' . $user -> uid . '/neuigkeiten/' . $elements['#entity']  -> id;
   
  $an = render($content["an"]);
  
?>

<div class="well well-white well-neuigkeit-teaser well-neuigkeit clearfix" >
  
  <div class="clearfix">
    <div class="pull-left news-profile-picture"><?php print $picture; ?></div>
    <p>Von: <?php print \LK\u($account -> uid); ?></p>
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
  <h4 style="margin-top: 0;"><a href="<?php print url($url); ?>"><?php print $title; ?></a></h4>
  
  <div class="nachrichten-text">
    <?php print render($content["field_text"]); ?>
  </div>
  
  <p>&nbsp;</p>  
  
  <p><a class="btn btn-success btn-sm" href="<?php print url($url); ?>"><span class="glyphicon glyphicon-plus"></span> Weiterlesen</a></p>

  <?php
    print render($content['kampagnen_search']);
  ?>
</div>