<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $classes; ?>">
<div id="wrap" style="min-height: 550px;">
  
  <header class="header clearfix" id="header" role="banner">
    <div class="header_inner text-center">
      <?php if ($logo): ?>
      <a style="display: inline-block; float: none;" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
      <?php endif; ?>
       </div>
  </header>

  <div id="page" class="clearfix" style="width: 750px;">
    <?php if($messages) print $messages; ?>
    
  <div id="main" >
    <div id="content" class="column well well-white" role="main">
      <h1 style="margin-top: 0;"><?php print $title; ?></h1> 
       <?php print render($content); ?>
      <?php print render($page['content']); ?>
    </div>
  </div>
</div>

<?php print render($page['content_bottom']); ?>
</div>
  
</body>
</html>
