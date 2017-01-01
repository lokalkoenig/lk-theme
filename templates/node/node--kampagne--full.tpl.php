

<?php
  // Modal-Ansicht
  include("sites/all/modules/lokalkoenig/modules/lokalkoenig_node/presentation/modal.php");
 
 
  
  include("sites/all/modules/lokalkoenig/modules/lokalkoenig_node/presentation/header.php");
  
?>
<div style="clear:both; height: 20px;"></div>
<?php  
  
  include("sites/all/modules/lokalkoenig/modules/lokalkoenig_node/presentation/content.php");
  
?>
<div style="clear:both; height: 20px;"></div>
<?php  
  
  
  
 include("sites/all/modules/lokalkoenig/modules/lokalkoenig_node/presentation/table.php"); 
 
?> 
<div style="clear:both; height: 20px;"></div>
<?php 
  if(!lk_is_agentur()){
    include("sites/all/modules/lokalkoenig/modules/lokalkoenig_node/presentation/related.php"); 
  }
?>