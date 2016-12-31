<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
 
 $plz = array();
 
foreach($row->field_field_plz_sperre as $plzout){
    $plz[] = '<span class="label label-default">' . $plzout['rendered']['#markup']  .'</span>';
}
                 
 if(count($plz) > 3){
   $copy = $plz;
   $plz = array($copy[0], $copy[1], $copy[2], '<span class="label label-info">+'. (count($copy) - 3) .'</span>');
 }
?>
<?php print implode($plz, " "); ?>