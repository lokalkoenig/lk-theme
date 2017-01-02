<div class="panel panel-default">

  <?php print $anchors; ?>
  
<div <?php if ( !empty($message_classes)) { ?>class="<?php echo implode(' ', $message_classes); ?>" <?php } ?> id="privatemsg-mid-<?php print $mid; ?>">
 
  <div class="privatemsg-message-column clearfix">
    <div class="panel-heading">
      <div class="panel-title">
       <div class="privatemsg-author-avatar thumbnail pull-left" style="margin-right: 2em;">
        <?php print $author_picture; ?>
      </div>
  
  
    <?php if (isset($new)): ?>
      <span class="new privatemsg-message-new"><?php print $new ?></span>
    <?php endif ?>
      
    <div class="privatemsg-message-information">
        <span class="privatemsg-message-date pull-right"><?php print format_date($message -> timestamp, 'short'); ?></span>
        Von <?php print \LK\u($message -> author -> uid); ?>
      </div>
      </div>
    </div>  
      <div class="panel-body">  
    <div class="pull-left">
      <?php print $message_body; ?>
    </div>
    
     <div class="pull-right"><?php if (isset($message_actions)): ?>
         <a class="btn btn-danger btn-sm" href="<?php print url('messages/delete/'. $message -> thread_id .'/'. $message -> mid); ?>">Löschen</a>
       <?php endif ?></div>    
  </div>
</div>
</div></div>

<?php

  if(isset($search)){
      print render($search);
  }
  
  if(isset($news)){
      print render($news);
  }

  if(isset($kampagnen)){
      print render($kampagnen);
  }
  