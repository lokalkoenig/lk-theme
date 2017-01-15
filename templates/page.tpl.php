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
      <a href="<?php if($user -> uid == 0) print $front_page; else print url('user/' . $user -> uid . "/dashboard"); ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
      <?php print render($page['top']); ?>  
     </div>
  </header>
  <?php print render($page['header']); ?>
  <?php print render($page['highlighted']); ?>

  <div id="page" class="clearfix">
    <?php if($messages) print '<div class="width">' . $messages . '</div>'; ?>
      <?php
        // Render the sidebars to see if there's anything in them.
        $sidebar_first  = render($page['sidebar_first']);
        $sidebar_second = render($page['sidebar_second']);
      ?>

      <?php if ($sidebar_first || $sidebar_second): ?>
        <aside class="sidebars">
          <?php print $sidebar_first; ?>
          <?php print $sidebar_second; ?>
        </aside>
      <?php endif; ?>


    <div id="main" >
      <div id="content" class="column" role="main">
        <a id="main-content"></a>
         <?php print render($page['search_top']); ?>
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

