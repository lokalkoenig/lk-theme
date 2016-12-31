<?php

/**
 * @file
 * Default theme implementation for entities.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */

//dpm($elements);

$align = $elements['#entity']->field_pres_bildausrichtung['und'][0]['value'];
$size = $elements['#entity']->field_pres_bild_size['und'][0]['value'];
$id = $elements['#entity'] -> id;

//dpm($elements['#entity']);

?>



<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?> id="entity_<?php print $id; ?>">
  <div class="content"<?php print $content_attributes; ?>>
   <div class="clearfix entity-toolbar">
    <div class="pull-right"><button class="btn btn-default btn-danger" data-toggle="modal" data-target="#delete_item_<?php print $id; ?>"><span class="glyphicon glyphicon-trash"></span> Löschen</button> <a class="btn btn-default btn-info btn-move" data-toggle="tooltip" data-original-title="Halten Sie die Maus gedrückt um den Abschnitt zu sortieren."><span class="glyphicon glyphicon-move"></span> Verschieben</a></div>   
   
       <div class="modal fade bs-modal-sm" id="delete_item_<?php print $id; ?>" role="dialog">
        <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Abschnitt löschen</h4>
      </div>
      <div class="modal-body">
        <p>Wollen Sie den Inhalt unwiederuflich löschen?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal"><span class="glyphicon glyphicon-cancel"> Abbrechen</button>
        <button type="button" class="btn btn-danger delete_layer" data-loading-text="Löschen..." data-complete-text="Gelöscht!" data-id="<?php print $id; ?>" data-nid="<?php print $id; ?>"><span class="glyphicon glyphicon-trash"> Löschen</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
        
    
   
    
   </div> 
    <h3><?php print render($content["field_medium_ueberschrift_1"]); ?></h3>
    <div class="pull-<?php print $align; ?> size-<?php print $size; ?> thumbnail">
      <?php print render($content["field_pres_bild"]); ?>
       <?php print render($content["image_extras"]); ?>
      
      
    </div>
   
    <p><?php print render($content["field_medium_text_1"]); ?></p>
    
    <h4><?php print render($content["field_medium_ueberschrift_2"]); ?></h4>
    <p><?php print render($content["field_medium_text_2"]); ?></p>
    <?php
      
    
      //print render($content);
    ?>
  </div>
</div>
