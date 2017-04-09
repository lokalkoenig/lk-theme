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

$vorlagen = vkuconnection_get_user_templates(arg(1));
// vku_status_2=1
$uid = arg(1);

if(\LK\get_user($uid)->isLKTestverlag()) {
  $links = array(
     '1' =>  '<span class="glyphicon glyphicon-cloud-download"></span> Aktuelle Verkaufunterlagen',
     '4' => '<span class="glyphicon glyphicon-trash"></span> Papierkorb'
  );
}
else {
  $links = array(
     '1' =>  '<span class="glyphicon glyphicon-cloud-download"></span> Aktuelle Verkaufunterlagen',
     '2' => '<span class="glyphicon glyphicon-euro"></span> Lizenzen',
     '3' => '<span class="glyphicon glyphicon-list"></span> Lizenz-Archiv',
     '4' => '<span class="glyphicon glyphicon-trash"></span> Papierkorb'
  );
}


$active = 1;

if(isset($_GET["vku_status_2"])){
    $test = (int)$_GET["vku_status_2"];  
    if(isset($links[$test])){
        $active = $test;
    }
}

 lk_set_subtitle($links[$active]);
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <div class="well well-white">
     <h4 style="margin-top:0;">Ihre Verkaufsunterlagen</h4>
     <p>Hier sehen Sie alle Verkaufsunterlagen und Lizenzen auf einen Blick.</p>
    
     <ul class="list-inline">
        <li>
         <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-plus"></span> Neue Verkaufsunterlage erstellen <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="<?php print url("vku/create"); ?>">Basis Verkaufsunterlage erstellen</span></a></li>
              
              <?php if($vorlagen): ?>
              <li role="separator" class="divider"></li>
                <?php foreach($vorlagen as $vorlage): ?>
                    <li><a href="<?php print url($vorlage -> renew_url); ?>"><?php print $vorlage -> vku_template_title; ?></a></li>
                <?php endforeach; ?>
              <?php endif; ?>   
            </ul>
          </div>   
            </li> 
        <li><a class="btn btn-sm btn-success" href="<?php print url("user/" . arg(1) . "/vkusettings"); ?>"><span class="glyphicon glyphicon-cog"></span> Einstellungen</span></a></li> 
     </ul>
  </div>


 <ul class="nav nav-tabs" role="tablist">
  <?php 
  while(list($key, $val) = each($links)):
    $url = url("user/" . $uid . "/vku", array("query" => array("vku_status_2" => $key)));
  ?>  
    <li role="presentation" <?php if($key == $active): print 'class="active"'; endif; ?>><a href="<?php print $url; ?>" role="tab"><?php print $val; ?></a></li>
  <?php endwhile; ?>  
 </ul>
  
    
    
  <?php if ($rows): ?>
      <?php if($active == 4): ?>
    <div class="well well-white text-right">
        <a href="<?php print url("user/" . $uid . "/vku/flush"); ?>" class="btn btn-danger optindelete" optintitle="Alle Verkaufsunterlagen im Papierkorb löschen" optin="Sind Sie sicher, dass Sie alle Verkaufsunterlagen löschen möchten?"><span class="glyphicon glyphicon-trash"></span> Papierkorb leeren</a>
    </div>  
    
       <?php endif; ?>   

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