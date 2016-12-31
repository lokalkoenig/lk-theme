
<?php $id = trim(strip_tags(render($content["field_youtube"]))); ?>

<div class="panel well well-white">
    <div class="panel-heading" style="padding: 0;" role="tab" id="heading<?php print $nid; ?>">
      <h2 style="font-size: 1.4em;">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $nid; ?>" aria-expanded="true" aria-controls="collapse<?php $nid; ?>">
         <?php print $title; ?>
        </a>
      </h2>
    </div>
    <div id="collapse<?php print $nid; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php print $nid; ?>">
      <div>
            <?php print render($content["field_text"]); ?>
            <hr />
            <iframe width="100%" height="386" src="https://www.youtube.com/embed/<?php print $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>  


