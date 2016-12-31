<?php

@todo 

?>


<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>">

<?php
 if($block->subject == 'Thema'){
 
 ?>
 <h4 style="margin-top:0">Filteroptionen</h4>
 <?php
 global $user;
 
 
  if(lk_is_telefonmitarbeiter($user)){
    $params = $_GET;
    unset($params["q"]);
    
    $account = _lk_user($user);
    $ausgaben = array();
    if(isset($account->profile['mitarbeiter']->field_ausgabe['und'])){
        
        if(count($account->profile['mitarbeiter']->field_ausgabe['und']) > 2){
            //$ausgaben[] = '<span style="font-size: 0.95em;"><span class="glyphicon glyphicon-globe"></span> ' . count($account->profile['mitarbeiter']->field_ausgabe['und']) . ' Ausgaben ausgewählt</span>';
           foreach($account->profile['mitarbeiter']->field_ausgabe['und'] as $a){
            $ausgaben[] = format_ausgabe_kurz($a["target_id"]) ;
           }
           
           $ausgaben = array(implode(" ", $ausgaben));
           
        }
        else {
        
          foreach($account->profile['mitarbeiter']->field_ausgabe['und'] as $a){
            $ausgaben[] = '<span style="font-size: 0.95em;"><span class="glyphicon glyphicon-globe"></span> ' . lk_get_ausgaben_title($a["target_id"]) . '</span>';
          }
        }
        
     }
  
      if(!$ausgaben) $ausgaben[] = '<em>Keine</em>';    
  
    ?>
   
    <div class="row clearfix">
<div class="col-xs-2">
<div style="margin-left: 10px;"><span class="glyphicon glyphicon-info-sign" style="font-size: 1.5em;"></span></div>
</div>
<div class="col-xs-10">

<p style="font-size:0.95em">Die Suchergebnisse werden für folgende Ausgaben angezeigt: <?php print implode(", &nbsp;&nbsp;", $ausgaben);?></p>
<p style="font-size:0.95em"><a href="<?php print url("user/" . $account -> uid . "/setplz", array("query" => $params)); ?>"><span class="glyphicon glyphicon-wrench"></span> Anpassen</a></p>

</div>
</div>
   <hr />
    <?php
  }
 
?>


 
<?php 
  

 }
?>


<?php if ($block->subject): ?>
  <h4<?php print $title_attributes; ?>><?php print $block->subject ?></h4>
<?php endif;?>

  <div class="list-group content clearfix"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>   
  
</div>
