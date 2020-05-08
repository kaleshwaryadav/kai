<?php
/*
 * Template Name: Reminder
 */

get_header(); ?>
<?php 
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
       $Reminder ="Reminder";
       $Title ="Title";
       $DateTime ="Date & Time";
       $Message ="Message";
       $delete ="delete";
       $sorry ="Sorry there is no assert in reminder List!.";
       $edit ="edit";
    }
    else
    {
    $Reminder ="Erinnerung";
    $Title ="Titel";
    $DateTime ="Terminzeit";
    $Message ="Botschaft";
    $delete ="löschen";
    $sorry ="Entschuldigung, es gibt keine Bestätigung in der Erinnerungsliste !.";
    $edit ="bearbeiten";
    }
    ?>


<!-- main-body div starts here -->

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
        $table_name = $wpdb->prefix . "remainder";
        $user_id = get_current_user_id();
        $reminderList = $wpdb->get_results("SELECT * FROM $table_name where user_id='$user_id'");
        ?>
			<div class="success-sec dashboard">
				<h3><?php echo $Reminder; ?></h3>
				<!-- <a class="btn" href="#">add more</a> -->
				<div class="success-story-main text-center">			
					<div class="row">
                     <?php if(count($reminderList)>0){
                              foreach($reminderList as $item){
                                $assertInfo = get_post($item->post_id);
                                $business_name = get_field('business_name',$item->post_id);
                                $ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $item->post_id ), 'full');
                                ?>
                         <div class="col-xs-6">
                            <div class="flex_box">
                                <div class="list_box">
                                    <div class="list-box-image">
                                        <img class="img-responsive" src="<?php echo $ImageUrl['0']; ?>" alt="">
                                        <div class="image-text">
                                            <p><?php echo $business_name; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-box-description">
                                    <ul class="list-unstyled ">
                                        <li>
                                            <span><?php echo $Reminder; ?> :</span>
                                            <p><?php echo ucwords($item->days); ?></p>
                                        </li>
                                         <li>
                                            <span><?php echo $Title; ?> :</span>
                                            <p><?php echo get_the_title($item->post_id); ?></p>
                                        </li>
                                        <li>
                                            <span><?php echo $DateTime; ?> :</span>
                                            <p><?php echo date('m/d/Y h:i:s', strtotime($item->stardate)); ?></p>
                                        </li>
                                        <li>
                                            <span><?php echo $Message; ?> :</span>
                                            <p><?php echo $item->Message; ?></p>
                                        </li>
                                    </ul>
                                    <div class="btn_set">
                                        <a class="btn btn_bdr edit" class="btn btn-info btn-lg" data-postid="<?php echo $item->post_id; ?>" data-toggle="modal" data-target="#myModal" data-message="<?php echo $item->Message; ?>" date-days="<?php echo $item->days; ?>" data-date="<?php echo $item->stardate; ?>" data-title="<?php echo get_the_title($item->post_id); ?>"><?php echo $edit; ?></a><a class="btn btn_bdr dlt" href="javascript:void(0);" onclick="delete_reminder(this,'<?php echo $item->id; ?>');"><?php echo $delete; ?></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                     <?php } } else {
                         echo'<div style="color:red;">'.$sorry.'</div>';
                        } ?>
					</div>
			<!-- <div class="view-more-btn">
				<a href="">View More</a>
			</div> -->
		</div>	
	</div>
</div>	
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit reminder</h4>
      </div>
      <div class="modal-body">

     <form  action="#" method="post" id="update_remainder">
       <input type="hidden" id="event-title" value="" autocomplete="off" /> 
         <input type="hidden" name="action" value="update_reminder">
          <input type="hidden" name="post_id" id="post_id" value=""> 
          <div class="form-group group">
            <input type="text" class="form-control" name="asset_title" id="asset_title">
                <label >Title</label>
                <span class="bar"></span>
            </div>
            <div class="form-group group">
                <textarea class="form-control" name="message" id="message"></textarea>
                <label >Message</label>
                <span class="bar"></span>
            </div>
            <span class="tag">Select Date & Time:</span>         
            <div class="row form-group">
                <div class='col-xs-6'>
                    <div class="form-group ">
                        <div class='input-group date'>
                            <input type="text" name="remainder_date" id="event-date" placeholder="Date & Time" lass="form-control" autocomplete="off" /> 
                            <input type="hidden" id="event-start-time" placeholder="Event Start Time" autocomplete="off" />
                            <input type="hidden" id="event-end-time" placeholder="Event End Time" autocomplete="off" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <span class="bar"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <select name="event-type" id="event-type">
                            <option value="">Please select an option</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class=" slider_cont text-center">
                <button type="submit" class="btn reminder reminderUpdate">Update</button>
                <button type="submit" class="btn btn_black" data-dismiss="modal">cancel</button>
            </div>
        </form>
        <div class="reminderMsg" style="text-align:center;"></div>
      </div>
    </div>

  </div>
</div>
</div>	<!-- template wrapper ends here -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/lightslider.js"></script>
<script type="text/javascript">
function AdjustMinTime(ct) {
    var dtob = new Date(),
        current_date = dtob.getDate(),
        current_month = dtob.getMonth() + 1,
        current_year = dtob.getFullYear();
            
    var full_date = current_year + '-' +
                    ( current_month < 10 ? '0' + current_month : current_month ) + '-' + 
                    ( current_date < 10 ? '0' + current_date : current_date );

    if(ct.dateFormat('Y-m-d') == full_date)
        this.setOptions({ minTime: 0 });
    else 
        this.setOptions({ minTime: false });
}

$("#event-start-time, #event-end-time,#event-date").datetimepicker({ format: 'Y-m-d H:i', minDate: 0, minTime: 0, step: 5, onShow: AdjustMinTime, onSelectDate: AdjustMinTime });

$(document).ready(function(){
  $('.edit').on('click',function(e){
   var message = $(this).attr('data-message');
   var date = $(this).attr('data-date');
   var days = $(this).attr('date-days');
   var id = $(this).attr('data-postid');
   var title = $(this).attr('data-title');
   $('#post_id').val(id);
   $('#message').val(message);
   $('#event-date').val(date);
   $('#asset_title').val(title);
   $("#event-type option[value=" + days + "]").prop("selected", true);
   e.preventDefault();
   });
})


</script>
<?php get_footer();?>
