<?php
/**
 * @file
 * Returns HTML for a sidebar region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728118
 */
 $bg_class = 'bg_' . rand(1, 8);
 
?>
<?php if ($content): ?>
  <section class="<?php print $classes . " " . $bg_class; ?> ">
    <div class="inner_section">
      <?php print $content; ?>
    </div>
  </section>
<?php endif; ?>
