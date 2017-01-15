<?php

include_once __DIR__ . '/functions/user.php';
include_once __DIR__ . '/functions/pmsg.php';

function bootstrap_lk_preprocess_page(&$vars) { 
  //dpm($vars);
  if(isset($vars["tabs"]) AND (lk_is_moderator() OR arg(0) == 'messages')){
    $vars['page']['header']['lokalkoenig_admin_lokalkoenig_title']['#markup'] .= render($vars["tabs"]);
    unset($vars["tabs"]);
  }
}

function bootstrap_lk_preprocess_html(&$vars) { 
  if(arg(0) == 'node' AND !arg(2) AND $node = node_load(arg(1))){
    if($node -> type == 'page' OR $node -> type == "webform"){
        $vars["classes_array"][] = 'node-type-full';
    }
  }
}

function bootstrap_lk_link($variables){
   
    if($variables["path"] == "node/99" AND !user_is_logged_in()){
      $variables['options']['attributes']["class"][] = 'hidden';
    
    }
   
    if(in_array($variables['text'], array("Nachricht senden", 'Abschicken'))){
       $variables['text'] = '<span class="glyphicon glyphicon-envelope" title="'. $variables['text'] .'"></span>';
       $variables['options']['html'] = true; 
    }
    
    if(in_array($variables['text'], array("Bearbeiten"))){
       $variables['options']['attributes']["class"][] = 'btn btn-sm btn-primary';
    }

   return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</a>';
}


function bootstrap_lk_file_widget($variables){
  $element = $variables['element'];
  $output = '';
  $hidden_elements = array();
  foreach (element_children($element) as $child) {
    if (isset($element[$child]['#type']) && $element[$child]['#type'] === 'hidden') {
      $hidden_elements[$child] = $element[$child];
      unset($element[$child]);
    }
  }
  
  $output .= '<div class="file-widget form-managed-file clearfix">';
  if (!empty($element['fid']['#value'])) {
    // Add the file size after the file name.
    $element['filename']['#markup'] = truncate_utf8(strip_tags($element['filename']['#markup']), 20, false, '...') . ' <span class="file-size">(' . format_size($element['#file']->filesize) . ')</span> ';
  }
  $output .= render($hidden_elements);
  $output .= drupal_render_children($element);
  $output .= '</div>';
  return  $output;

}

function bootstrap_lk_image_widget($variables){
  $element = $variables['element'];
  $output = '';
  $output .= '<div class="image-widget form-managed-file clearfix">';

  if (isset($element['preview'])) {
    $output .= '<div class="image-preview">';
    $output .= drupal_render($element['preview']);
    $output .= '</div>';
  }

  $output .= '<div class="image-widget-data">';
  if ($element['fid']['#value'] != 0) {
    $element['filename']['#markup'] = truncate_utf8(strip_tags($element['filename']['#markup']), 20, false, '...') . ' <span class="file-size">(' . format_size($element['#file']->filesize) . ')</span> ';
  }
  $output .= drupal_render_children($element);
  $output .= '</div>';
  $output .= '</div>';

  return $output;

}

function  bootstrap_lk_file_icon($variables) {
  
  $file = $variables['file'];
  $file_name = $file -> filename;
  $ext = pathinfo($file_name, PATHINFO_EXTENSION);
  
  switch($ext){
    case 'psd':
    case 'indd':
    case 'pdf':  
    case 'ai':  
      $icon_url = url("sites/all/themes/bootstrap_lk/file-types/type-". $ext .".png");  
      break;
    
    case 'zip': 
     $icon_url = url("sites/all/themes/bootstrap_lk/file-types/type-". $ext .".png");  
     break;
  
    default:
      $icon_url = url("sites/all/themes/bootstrap_lk/file-types/type-jpg.png");  
      break;
  }
  
  
  return '<img class="file-icon" width="30" alt="" title="' . $ext . '" src="' . $icon_url . '" />';
}



function bootstrap_lk_button($element) {

  // Add some extra conditions to make sure we're only adding
  // the classto the right submit button
  if(in_array($element["element"]["#value"], array('Upload', 'Suchen', 'Anmelden', 'Abschicken'))){
     $element["element"]['#attributes']['class'][] = 'btn-success'; 
  }
  
   if($element["element"]["#value"] == "Löschen"){
     $element["element"]['#attributes']['class'][] = 'btn-sm'; 
   
   }
  
  if($element["element"]["#value"] == "Login"){
    $element["element"]['#attributes']['class'][] = 'btn-primary'; 
  }
  
  return theme_button($element);
}


function bootstrap_lk_form($variables){

  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }
 
  if($element["#id"] == "user-login-form" 
      OR $element['#id'] == 'views-exposed-form-suchev2-page' 
      OR  $element['#id'] == 'views-exposed-form-suchev2-page-2' 
      ){
     return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>'; 
  }
  
  $element['#attributes']["class"][] = 'panel panel-default'; 
  // Anonymous DIV to satisfy XHTML compliance.
  return '<form' . drupal_attributes($element['#attributes']) . '><div class="panel-body">' . $element['#children'] . '</div></form>';
}


function bootstrap_lk_field__field_medium_ueberschrift_1__medium($variables){
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output; 
}


function bootstrap_lk_preprocess_node(&$variables){
  $variables['node'] = $variables['elements']['#node'];
  $node = $variables['node'];
  _lk_check_node_kampagne($variables, $node);
}


/**
 * @file
 * menu-local-action.func.php
 */

/**
 * Overrides theme_menu_local_action().
 */
function bootstrap_lk_menu_local_action($variables) {
  $link = $variables['element']['#link'];

  $options = isset($link['localized_options']) ? $link['localized_options'] : array();

  // If the title is not HTML, sanitize it.
  if (empty($options['html'])) {
    $link['title'] = check_plain($link['title']);
  }

  $icon = _bootstrap_iconize_button($link['title']);

  // Format the action link.
  $output = '<li>';
  if (isset($link['href'])) {
    // Turn link into a mini-button and colorize based on title.
      if (!isset($options['attributes']['class'])) {
        $options['attributes']['class'] = array();
      }
      
      $options['attributes']['class'][] = 'btn';
      $options['attributes']['class'][] = 'btn btn-success';
    
    
    if ($class = _bootstrap_colorize_button($link['title'])) {
    
      $string = is_string($options['attributes']['class']);
      if ($string) {
        $options['attributes']['class'] = explode(' ', $options['attributes']['class']);
      }
      
      $options['attributes']['class'][] = $class;
      if ($string) {
        $options['attributes']['class'] = implode(' ', $options['attributes']['class']);
      }
    }
    // Force HTML so we can add the icon rendering element.
    $options['html'] = TRUE;
    $output .= l($icon . $link['title'], $link['href'], $options);
  }
  else {
    $output .= $icon . $link['title'];
  }
  $output .= "</li>\n";

  return $output;
}


function bootstrap_lk_username($variables) {
  if (isset($variables['link_path'])) {
    // We have a link path, so we should generate a link using l().
    // Additional classes may be added as array elements like
    // $variables['link_options']['attributes']['class'][] = 'myclass';
    $output = l($variables['name'] . $variables['extra'], $variables['link_path'], $variables['link_options']);
  }
  else {
    // Modules may have added important attributes so they must be included
    // in the output. Additional classes may be added as array elements like
    // $variables['attributes_array']['class'][] = 'myclass';
    $output = '<span' . drupal_attributes($variables['attributes_array']) . '>' . $variables['name'] . $variables['extra'] . '</span>';
  }
  return $output;
}

function bootstrap_lk_facetapi_count($variables){
   return '<span class="badge pull-right">'. (int)$variables['count'] .'</span>';
}

function bootstrap_lk_facetapi_link_inactive($variables) {
  // Builds accessible markup.
  // @see http://drupal.org/node/1316580
  $accessible_vars = array(
    'text' => $variables['text'], 
    'active' => FALSE,
  );
  $accessible_markup = theme('facetapi_accessible_markup', $accessible_vars);

  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $variables['text'] = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  // Adds count to link if one was passed.
  if (isset($variables['count'])) {
    $variables['text'] = theme('facetapi_count', $variables) . $variables['text'];
  }

  // Resets link text, sets to options to HTML since we already sanitized the
  // link text and are providing additional markup for accessibility.
  $variables['text'] .= $accessible_markup;
  $variables['options']['html'] = TRUE;
  $variables['options']['attributes']['class'][] = 'btn';
  
  return theme_link($variables);
}


function bootstrap_lk_facetapi_link_active($variables) {
  // Builds accessible markup.
  // @see http://drupal.org/node/1316580
  $accessible_vars = array(
    'text' => $variables['text'], 
    'active' => FALSE,
  );
  $accessible_markup = theme('facetapi_accessible_markup', $accessible_vars);

  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $variables['text'] = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  // Adds count to link if one was passed.
  if (isset($variables['count'])) {
    $variables['text'] = theme('facetapi_count', $variables) . $variables['text'];
  }
  
  switch($variables['text']){
    case 'S':
    case 'M':
    case 'L':
      $variables['text'] = 'Paketgröße ' . $variables['text'];
      break;
  }

  // Resets link text, sets to options to HTML since we already sanitized the
  // link text and are providing additional markup for accessibility.
  $variables['text'] .= $accessible_markup;
  $variables['options']['html'] = TRUE;
  $variables['options']['attributes']['class'][] = 'btn btn-default';
  //dpm($variables);         
  return theme_link($variables);
}
