<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
global $user;

?>

<div id="wrap2">
  <div id="wrap" style="min-height: 550px;">
    <header class="header clearfix" id="header" role="banner">
      <div class="header_inner">
        <a href="<?= url('user/' . $user -> uid . "/dashboard"); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
        <h1>Backoffice</h1>
       </div>

      
    </header>
    
    <?php print render($page['header']); ?>
    <?php print render($page['highlighted']); ?>

    <div id="page" class="clearfix">
      <aside class="sidebars">
        <?php print render($page['sidebar_first']); ?>
      </aside>
      <div id="main" >
        <div id="content" class="column" role="main">
          <a id="main-content"></a>
           <?php if($messages) print '<div class="width">' . $messages . '</div>'; ?>
           <?php print render($page['content']); ?>
        </div>
      </div>
    </div>

    <?php print render($page['content_bottom']); ?>
  </div>
  <div id="footer" class="clearfix">
    <?php print render($page['footer']); ?>
    <?php print render($page['bottom']); ?>
  </div>
</div>
