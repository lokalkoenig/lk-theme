 <span class="glyphicon glyphicon-ok"></span>
<div class="clearfix node_<?php print $node -> nid; ?>">
  <div class="pull-left" style="width: 227px; margin-right: 20px;">
  <div class="thumbnail-noborder">
    
   <?php print render($content["field_kamp_teaserbild"]); ?>
  
  </div>
  </div>
  <div class="pull-left vku_puchase_text">
    
    <h3 style="margin-top: 0;"><?php print $title; ?></h3>
    <h4 style="font-weight: normal; margin-top: 0;"><?php print render($content["field_kamp_untertitel"]); ?></h4>

    <ul class="list-inline">
      <li><img src="/sites/all/themes/bootstrap_lk/design/icon-printanzeige.png" width="20" /></li>
      <li><img src="/sites/all/themes/bootstrap_lk/design/icon-webanzeige.png" width="20"/></li>
      <li><span class="prodid"><?php print _lk_get_kampa_sid($node); ?></span></li>
    </ul>
    
    <p><?php print render($content["field_kamp_teasertext"]); ?></p>
  </div>
</div>


