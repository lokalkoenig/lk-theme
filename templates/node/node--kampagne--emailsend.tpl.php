

<table width="40%" align="left"  border="0" cellpadding="0" cellspacing="0" class="deviceWidth">
      <tr>
       <td valign="top">
        <?php print render($content["field_kamp_teaserbild"]); ?>
       </td>
      </tr>
</table> <!--End left box-->


<table width="60%" align="left" border="0" cellpadding="0" cellspacing="0"  class="deviceWidth">
    <tr>
       <td  style="font-size: 16px; color: #303030; font-weight: bold; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle;">
          <?php print $title; ?><br />
          <?php print render($content["field_kamp_untertitel"]); ?>                 
       </td>
     </tr>
      <tr>
       <td  style="font-size: 12px; color: #303030; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle;">
         <?php print render($content["field_kamp_teasertext"]); ?>   <br />
       <table>
                                <tbody><tr>
                                    <td valign="top" style="padding: 7px 15px;  background-color: #bdc3c7; " class="center">
                                        <a style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;" href="<?php print url('node/' . $nid); ?>">Auf Lokalkönig.de anschauen</a>
                                    </td>                                   
                                 </tr>
                            </tbody></table>  
                                      
       </td>
     </tr>
</table><!--End right box-->

