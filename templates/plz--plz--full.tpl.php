<?php
 if(isset($elements['#entity']->field_plz_sperre_bis['und'][0]['value'])){
   $bis = date("d.m.Y", strtotime($elements['#entity']->field_plz_sperre_bis['und'][0]['value']));
 }
 else {
    $bis = '<i>Keine zeitliche Einschränkung</i>'; 
 }

?>



<div class="bs-callout bs-callout-danger">
<h4>Plz-Sperre bis: <small><?php print $bis; ?></small></h4>
<?php


$plz_array = array();
// PLZ Anzeige
if(isset($elements['#entity']->field_plz_sperre['und'])){
  foreach($elements['#entity']->field_plz_sperre['und'] as $plz){
      $plz_array[] = $plz['taxonomy_term']->name;
  }
  print '<hr />';
  print '<h5>Postleitzahlen</h5>';
  print implode($plz_array, ', ');
}

$user = array();
if(isset($elements['#entity']->field_plz_sperre_verlag['und'])){
  foreach($elements['#entity']->field_plz_sperre_verlag['und'] as $u){
     $user[] = _lk_show_userinfo($u["user"]);  
  } 
  
  print '<hr />';
  print '<h5>Verlag/Mitarbeiter</h5>';
  print implode($user, ', ');  
}


?>


</div>