<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
 
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix">

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page && $title): ?>
    <header>
    
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <div class="background_white">
     <div class="width">
        <?php print render($content['body']); ?>
     </div>
  </div>

  <div class="background_grey">
     <div class="width">
  <?php
    // We hide the comments and links now so that we can render them later.
    print render($content);
  ?>
  </div></div>
  
</article>
