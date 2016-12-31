
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php foreach ($rows as $id => $row): ?>
        <?php print $row; ?>
    <?php endforeach; ?>
</div>

<script>
    //jQuery('#accordion .panel:first-child').children('.panel-collapse').addClass('in');
    //jQuery('#accordion .panel:first-child').children('a').addClass('collapsed');
    
    jQuery(function () {
      
        jQuery('#accordion').on('shown.bs.collapse', function (e) {
            var offset = jQuery('.panel > .panel-collapse.in').offset();
            if(offset) {
                jQuery('html,body').animate({
                    scrollTop: jQuery('.panel-collapse.in').siblings('.panel-heading').offset().top - 20
                }, 500); 
            }
        });

    });
    
    
</script>    