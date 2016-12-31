<?php

define('LK_USER_STANDARD_PICTURE', '/sites/all/themes/bootstrap_lk/design/default-avatar.gif');


function bootstrap_lk_preprocess_user_picture(&$variables) {
  
  $account = $variables['account'];
  $prof = profile2_load_by_user($account);
  
  if(isset($prof['main']->field_profile_bild['und'][0]['uri'])){
      $variables['user_picture'] = theme('image_style', array('style_name' => 'avatar', 'path' => $prof['main']->field_profile_bild['und'][0]['uri']));
  }
  else {
      $variables['user_picture'] = '<img src="'. LK_USER_STANDARD_PICTURE .'" width="80" height="80" alt="Standard Avatar" />';
  }
}


?>