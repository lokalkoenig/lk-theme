<?php 
  //each file loads it's own styles because we cant predict which file will be loaded 
  drupal_add_css(drupal_get_path('module', 'privatemsg').'/styles/privatemsg-recipients.css');
?>
<div class="well">
  <div class="pull-right">
    <a href="<?php print url('messages'); ?>">Zurück zur Übersicht <span class="glyphicon glyphicon-chevron-right"></span></a>
  </div>
  <?php print $participants; ?>
</div>