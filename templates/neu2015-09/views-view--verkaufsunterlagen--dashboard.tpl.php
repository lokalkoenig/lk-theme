<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */

?>

<style>
  .view-filters-no-style .panel-body, .view-filters-no-style .panel-default {
     padding:0; 
     border: 0;
  }
  
  .view-filters-no-style  label {
    display: none;
  }
  .view-filters-no-style .views-exposed-form .views-exposed-widget .form-submit {
    margin-top: 0;
  }

</style>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <div class="well well-white">
     <h4 style="margin-top:0;">Letzten 5 Verkaufsunterlagen</h4>
     <p>Hier sehen Sie alle Verkaufsunterlagen und Lizenzen auf einen Blick.</p>
     
     <ul class="list-inline">
        <li><a class="btn btn-sm btn-success" href="<?php print url("vku/create"); ?>"><span class="glyphicon glyphicon-plus"></span> Leere Verkaufsunterlage erstellen</span></a></li> 
        <li><a class="btn btn-sm btn-success" href="<?php print url("user/". arg(1) . '/vku'); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Zu den Verkaufsunterlagen</span></a></li> 
     </ul>
  </div>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>


  <?php if ($rows): ?>
      <?php print $rows; ?>
  <?php else :?>  
    <div class="well well-white">
      <p>Sie haben bisher keine Verkaufsunterlagen erstellt. Klicken Sie auf "Neue Verkaufsunterlage erstellen".</p>
    </div>
  <?php endif; ?>
  
  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>