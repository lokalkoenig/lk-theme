<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
 
 
if(arg(0) == "jquery_ajax_load") {

?>



  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Häufig gestellte Fragen</h4>
      </div>
      <div class="modal-body">
      
      
     
  
<?php
}
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix">

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page && $title): ?>
    <header>
    
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
      <?php endif; ?>
     

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    print render($content);
  ?>

  <?php 

  
  $content["links"]['#attributes']['class'][0] = 'btn btn-default'; 
  print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>

<?php
 if(arg(0) == "jquery_ajax_load") {
?> 
 
 </div>
 
 
 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


<?php
 }
?> 