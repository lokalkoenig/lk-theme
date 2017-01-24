<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>">

  <?php if ($block->subject): ?>
    <h4<?php print $title_attributes; ?>><?php print $block->subject ?></h4>
  <?php endif;?>

  <div class="list-group content clearfix"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>   
  
</div>
