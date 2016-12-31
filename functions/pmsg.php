<?php

function bootstrap_lk_privatemsg_list_header__last_updated(){
  
  return array(
    'data'    => ('Datum'),
    'field'   => 'last_updated',
    'sort'    => 'desc',
    'class'   => array('privatemsg-header-lastupdated'),
    '#weight' => -200,
  );

}


/**
 * Theme the subject of the thread.
 *
 * @see theme_privatemsg_list_field()
 */
function bootstrap_lk_privatemsg_list_field__subject($variables) {
  $thread = $variables['thread'];
  $field = array();
  $options = array();
  $is_new = '';
  if (!empty($thread['is_new'])) {
    $is_new = theme('mark', array('type' => MARK_NEW));
    $options['fragment'] = 'new';
  }
  $subject = $thread['subject'];
 
  $message = privatemsg_message_load($thread['thread_id']);
  
  
  
  $field['data'] = l($subject, 'messages/view/' . $thread['thread_id'], $options) . $is_new;
  $field['class'][] = 'privatemsg-list-subject';
  return $field;
}


function bootstrap_lk_privatemsg_list_field__last_updated($variables) {
  $thread = $variables['thread'];
  $field['data'] = format_date($thread['last_updated'], 'short');
  $field['class'][] = 'privatemsg-list-date';
  return $field;
}

/** Formatiert */
function bootstrap_lk_privatemsg_list_field__participants($variables) {
  $thread = $variables['thread'];
  $participants = _privatemsg_generate_user_array($thread['participants'], -4);
  $field = array();
  $field['data'] = __privatemsg_format_participants($participants);
  $field['class'][] = 'privatemsg-list-participants';
  return $field;
}

function __privatemsg_format_participants($participants){
  $return = array();
  
  while(list($key, $val) = each($participants)){
      if($val -> type == 'role'){
        $return[] = '<span class="label label-success" title="An Alle">'. $val -> name .'</span>';
      }
      else {
        
        $return[] = (\LK\u($val -> uid));
      }
  }

  return implode('<br />', $return); 
}

function bootstrap_lk_privatemsg_username($variables){
  $recipient = $variables['recipient'];
  $options = $variables['options'];
  if (!isset($recipient->uid)) {
    $recipient->uid = $recipient->recipient;
  }
  if (!empty($options['plain'])) {
    $name = strip_tags(format_username($recipient));
    if (!empty($options['unique'])) {
      //$name .= ' [user]';
    }
    return $name;
  }
  else {
    return theme('username', array('account' => $recipient));
  }
}


?>