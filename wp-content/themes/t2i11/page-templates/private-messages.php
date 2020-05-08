<?php
/*
 * Template Name: Private Message
 */
get_header(); 

$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $sn = 'S. No.';
      $PrivateMessager ="Private Messager";
      $AssetDetails ="Asset Details";
      $SenderInfo = "Sender Info";
      $Message ="Message";
      $NameofAsset ="Name of Asset";
      $AssetUrl ="Asset Url";
      $SenderName ="Sender Name";
      $SenderEmail ="Sender Email";
      $SenderMobileNo ="Sender Mobile No";
      $SenderAddress ="Sender Address";
      $CreatedDateTime ="Created Date Time";
    }
    else
    {
      $sn = 'S. No.';
      $PrivateMessager ="Private Nachricht";
      $AssetDetails ="Asset-Details";
      $SenderInfo = "Absender-Info";
      $Message ="Botschaft";
      $NameofAsset ="Name des Vermögenswerts";
      $AssetUrl ="Asset-URL";
      $SenderName ="Absender";
      $SenderEmail ="Absender E-Mail";
      $SenderMobileNo ="Absender Mobil Nr";
      $SenderAddress ="Absenderadresse";
      $CreatedDateTime ="Erstellungsdatum Uhrzeit";
    }
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style type="text/css">
  table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px; 
    border-collapse: 
    collapse; border-spacing: 0; 
}

td, th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}

td {  
    background: #cb2720;
    vertical-align: middle !important;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #cb2720; color: #FFF; }  
div#private_message_inbox_length select {
    width: 250px;
    background: #fff;
    margin: 0 15px;
    padding: 10px 10px 10px 10px;
    border: 1px solid #ccc;
}
.dataTables_filter input {
    border: 1px solid #cdcdcd;
    margin-left: 5px;
    border-radius: 3px;
    padding: 10px 10px;
    width: 250px;
}
div#private_message_inbox_info {
    background: #fefefe;
    padding: 10px;
}
div#private_message_inbox_paginate {
    background: #fefefe;
    padding: 10px;
}
/* Hover cell effect! */
</style>
<div class="template-wrapper">
	<div>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>
        <?php 
        global  $current_user, $wpdb;
        $table_name = $wpdb->prefix . "asset_message";
        $user_id = get_current_user_id();
        // $sql = "SELECT * FROM $table_name where asset_ownerid='$user_id' ORDER BY id DESC";
        $sql = "SELECT * FROM `$table_name` WHERE asset_ownerid='$user_id' ORDER BY `id` DESC";
        //echo $sql;
        $messageList = $wpdb->get_results($sql);
       // echo "<pre>";
       // print_r($messageList);       
        ?>
			<div class="success-sec dashboard">
        <h3><?php echo $PrivateMessager; ?></h3>
        <table class="table table-hover" style="background-color: #fff; border: 1px solid #dadada;" id="private_message_inbox" class="display" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th style="padding: 5px;"><?php echo $sn; ?></th>
          <th style="padding: 5px;"><?php echo $AssetDetails; ?></th>
          <th style="padding: 5px;"><?php echo $SenderInfo; ?></th>                
          <th style="padding: 5px;"><?php echo $Message; ?></th>                
      </tr>
  </thead>
   <tbody>
          <?php $sn = 1; foreach($messageList as $messagekey) {
            $asset_title = get_the_title($messagekey->post_id);
            $asset_url = get_the_permalink($messagekey->post_id);
            ?>
            <tr>
                <td style="width: 5%; padding: 5px;"><?php echo '#'.$sn; ?><br> 
                <td style="width: 30%; padding: 5px;"><span style="font-weight:600; line-height: 35px;"><?php echo $NameofAsset; ?>:</span> <?php echo $asset_title; ?>(<?php echo $messagekey->post_id; ?>)<br> 
                    <span style="font-weight:600; line-height: 35px;"> <?php echo $AssetUrl; ?> : </span><?php echo $asset_url; ?><br> 
                </td>
                <td style="width: 30%; padding: 5px;">
                  <span style="font-weight:600; line-height: 35px;"><?php echo $SenderName; ?>:</span> <?php echo $messagekey->message_name; ?><br>
                    <!-- <span style="font-weight:600; line-height: 35px;"> <?php echo $SenderEmail; ?>:</span> <b><?php echo $messagekey->message_email; ?></b><br> -->
                    <span style="font-weight:600; line-height: 35px;"><?php echo $SenderEmail; ?>:</span> <?php echo $messagekey->Email; ?><br>
                    <span style="font-weight:600; line-height: 35px;"><?php echo $SenderMobileNo; ?>:</span> <?php echo $messagekey->message_mobile_no; ?><br>
                    <span style="font-weight:600; line-height: 35px;"><?php echo $SenderAddress; ?>:</span> <?php echo $messagekey->message_address; ?><br>
                    <span style="font-weight:600; line-height: 35px;"><?php echo $CreatedDateTime; ?>:</span> <?php echo $messagekey->date; ?>
                </td>                            
                <td style="width: 35%; padding: 5px;"><?php echo nl2br($messagekey->message); ?></td>         
            </tr>
          <?php $sn++; } ?>
      </tbody>


</table>
    <?php /* ?>
				<h3><?php echo $PrivateMessager; ?></h3>
        <table id="private_message_inbox" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo $AssetDetails; ?></th>
                <th><?php echo $SenderInfo; ?></th>                
                <th><?php echo $Message; ?></th>                
            </tr>
        </thead>
        <tbody>
          <?php  foreach($messageList as $messagekey) {
            $asset_title = get_the_title($messagekey->post_id);
            $asset_url = get_the_permalink($messagekey->post_id);
            ?>
            <tr>
                <td><?php echo $NameofAsset; ?>: <b><?php echo $asset_title; ?>(<?php echo $messagekey->post_id; ?>)</b><br> 
                    <?php echo $AssetUrl; ?> : <b><?php echo $asset_url; ?></b><br> 
                </td>
                <td><?php echo $SenderName; ?>: <b><?php echo $messagekey->message_name; ?></b><br>
                    <!-- <?php echo $SenderEmail; ?>: <b><?php echo $messagekey->message_email; ?></b><br> -->
                    <?php echo $SenderEmail; ?>: <b><?php echo $messagekey->Email; ?></b><br>
                    <?php echo $SenderMobileNo; ?> : <b><?php echo $messagekey->message_mobile_no; ?></b><br>
                    <?php echo $SenderAddress; ?> : <b><?php echo $messagekey->message_address; ?></b><br>
                    <?php echo $CreatedDateTime; ?> : <b><?php echo $messagekey->date; ?></b>
                </td>                            
                <td><?php echo $messagekey->message; ?></td>         
            </tr>
          <?php } ?>
      </tbody>
    </table> 
    <?php */ ?>
	   </div>
</div>	
</div>
</div>	<!-- template wrapper ends here -->

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#private_message_inbox').dataTable();
});
</script>
<?php get_footer();?>
