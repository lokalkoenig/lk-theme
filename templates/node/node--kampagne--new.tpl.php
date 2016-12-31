<?php
// Check for Errors

$medien =  @count($node -> medien);
$errors = array();

if(!$medien) $errors[] = 'Sie haben bisher keine Medien hochgeladen. '  . l(">> hochladen", "node/" . $nid . "/addmedia");
 
foreach($errors as $error){
  ?>
  <p class="alert alert-danger"><?php print $error; ?></p>
  <?php
  
  $node -> errormsg = $errors;
  return ; 
}


if(lk_is_moderator()){
  if($node -> lkstatus == 'deleted') {
    ?>
    <div class="well">
      Die Kampagne wurde als gelöscht markiert und verworfen.
    </div>
    
    <?php
    
    return ;
  }
}


?>




<?php if(!$errors) { ?>
<?php if(isset($node -> submitform)) print '<div class="well" style="height: 303px;">' . $node -> submitform . '</div>'; ?>

<?php
  if(lk_is_moderator()){
    ?>
    <div class="well">Die Kampagne ist noch nicht freigeschalten. Bitte überprüfen Sie diese und schalten Sie diese danach Online (<?php print l('Moderation', 'node/' . $node -> nid . '/admin'); ?>).</div>
  
    <?php
  }
?>

<?php if($node -> lkstatus != 'deleted' AND lk_is_moderator()) { ?>
<h3 class="list-group-item-heading">Vorschau Übersicht</h3>
<hr />
<?php 


$node_copy = clone $node;
$node_copy -> vmode = 'teaser';
$view_node = node_view($node_copy, "teaser");
        
print drupal_render($view_node); ?>

<h3 class="list-group-item-heading">PDF Kontroll-Ansicht</h3>
<p>Kann einige Sekunden dauern, bis die PDF angezeigt wird.</p>
<hr />

<iframe style="width: 100%; height: 400px; border: 1px Black solid; background: #EEE;" src="<?php print url('node/' . $node -> nid . '/pdf'); ?>">PDF wird erstellt...</iframe>


<?php } ?>







<?php } ?>