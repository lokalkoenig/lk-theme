<?php
  $vku = new VKUCreator($row -> vku_id);
  $kampagnen = $vku -> getKampagnen();
  
?>




<div class="well">
<div class="row clearfix">
<div class="col-xs-7" >
   <h4 style="margin-top: 0;"><label class="label label-primary">Verkaufsunterlage:</label></h4>       
   
   <ul>
      <li><b><?php print $row -> lk_vku_vku_title; ?></b></li>
      <?php if($row -> lk_vku_vku_untertitel): ?>
        <li><u>Untertitel:</u> <?php print ($row -> lk_vku_vku_untertitel); ?></li>
     <?php endif; ?>
     
      
     <?php if($row -> lk_vku_vku_company): ?>
        <li><u>Unternehmen:</u> <?php print ($row -> lk_vku_vku_company); ?></li>
     <?php endif; ?>
     
     <li><u>Erstellt am:</u> <?php print format_date($row -> lk_vku_vku_created); ?></li>
    
      <?php if($row -> lk_vku_vku_purchased_date) : ?>
        <li><u>Lizenziert am:</u> <?php print format_date($row -> lk_vku_vku_purchased_date); ?></li> 
      <?php endif; ?>
    
   
   </ul>
</div>
<div class="col-xs-5">


<?php
  if($row -> lk_vku_vku_status == 'active'){
      ?>
        <a class="btn btn-success pull-right" href="<?php print url('vku/'. $row -> vku_id); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Verkaufsunterlage jetzt fertigstellen</a>
        
        <br /><br />
        <a class="btn btn-danger btn-sm optindelete pull-right" href="<?php print url('vku/'. $row -> vku_id . '/delete'); ?>" optintitle="Verkaufsunterlagen wirklich löschen" optin="Sind Sie sicher, dass Sie die Verkaufsunterlagen löschen möchten?"><span class="glyphicon glyphicon-trash"></span> Löschen</a>
            
      <?php  
  }
  else {
  
  
  $link = "user/" . $row -> users_lk_vku_uid . "/vku/" . $row -> vku_id;;

  $label_class = 'success';
  $label_icon = 'plus';
  $label_title = 'No ('. $row -> lk_vku_vku_status .')';
  
  $links = array();
  $links[] = array("icon" => "chevron-right", "link" => url($link . "/details"), "title" => "Details anzeigen");
   
  switch($row -> lk_vku_vku_status) {
      
      case 'created':
        $label_icon = 'plus';
        $label_title = 'Zu generieren';
        $label_class = 'success';
      break;
      
      
      case 'ready':
      case 'downloaded':
          $label_title = 'Aktive Verkaufsunterlage';
          $links[] = array("icon" => "download", "link" => url($link . "/download"), "title" => "PDF herunterladen (". format_size($row -> lk_vku_vku_ready_filesize) .")");
       
       break;
       
       case 'deleted':
        $label_icon = 'trash';
        $label_title = 'Papierkorb';
        $label_class = '';
        break;
        
        
        case 'purchased':
          $label_icon = 'euro';
          $label_title = 'Aktive Lizenz';
          $links = array();
          $links[] = array("icon" => "download-alt", "link" => url($link . "/details"), "title" => "Lizenzen herunterladen");
 
          $label_class = 'success';
          break; 
          
        case 'purchased_done':
          $label_icon = 'check';
          $label_title = 'Lizenz';
          $label_class = '';
          
           $links = array();
           $links[] = array("icon" => "chevron-right", "link" => url($link . "/details"), "title" => "Details anzeigen<br /><small>Die Lizenz-Dateien können <br />nicht mehr heruntergeladen werden</small>");
 
          
          break;   
    }
    
    if(!in_array($row -> lk_vku_vku_status, array("purchased", "purchased_done"))){
        if($row -> lk_vku_vku_status == 'deleted'){
            $links[] = array("icon" => "refresh", "link" => url($link . "/renew"), "title" => "Verkaufsunterlage wiederherstellen<br /><small>Die Verkaufsunterlage wird wiederhergestellt<br /> und steht Ihnen neu zur Verfügung</small>");
            $links[] = array("icon" => "trash", "link" => url($link . "/delete"), "title" => "Permanent löschen<br /><small>Die Verkaufsunterlage wird unwiderruflich gelöscht.</small>", 'options' => 'class="optindelete" optintitle="Verkaufsunterlagen wirklich löschen" optin="Sind Sie sicher, dass Sie die Verkaufsunterlagen löschen möchten?"');
        }
        else {
            $links[] = array("icon" => "refresh", "link" => url($link . "/renew"), "title" => "Verkaufsunterlage duplizieren<br /><small>Die Verkaufsunterlage wird kopiert<br /> und steht Ihnen neu zur Verfügung</small>");
        }
        
        
        if($row -> lk_vku_vku_status != 'deleted'){
          $links[] = array("icon" => "trash", "link" => url($link . "/delete"), "title" => "Verwerfen<br /><small>Die Verkaufsunterlage wird in den<br /> Papierkorb verschoben</small>", 'options' => 'class="optindelete" optintitle="Verkaufsunterlagen wirklich löschen" optin="Sind Sie sicher, dass Sie die Verkaufsunterlagen löschen möchten?"');
        }
    }
    
  ?>
  <div class="pull-right">
   <div class="btn-group">
          <button type="button" class="btn btn-<?php print $label_class; ?> dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-<?php print $label_icon; ?>"></span> <?php print $label_title; ?> <span class="caret"></span> </button>
         <ul class="dropdown-menu" role="menu"> 
              <?php foreach($links as $link) :?>
                 <li><a href="<?php print $link["link"]; ?>" <?php if(isset($link["options"])) print ' ' .$link["options"]; ?>><span class="glyphicon glyphicon-<?php print $link["icon"]; ?>"></span> <?php print $link["title"]; ?></a></li>
              <?php endforeach; ?>
          </ul>
        </div>
    </div>    
    <?php } ?>
 </div>
 </div>
 </div>
  
 <div class="row">
 <div class="col-xs-12" style="display: block; float: none; margin-left: 20px;">
  
  <?php
      
      if($kampagnen){
        foreach($kampagnen as $nid){
            $node = node_load($nid);
            $view = node_view($node, 'grid');
             print render($view);
        }
      }
      else {
        print '<p class="text-center"><em>- Ohne Kampagnen - </em></p><p>&nbsp;</p>'; 
      }
    ?>
 
 </div>
 </div>

 <hr />
 <div>&nbsp;</div>