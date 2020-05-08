<?php
session_start();
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 * @version 1.0
 */

get_header();?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php 
$userID = get_current_user_id();

global $current_user;
$current_user->user_email;
$mobilenum = get_user_meta($current_user->ID,'mobilenum',true);
$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
$terms = get_the_terms( $post->ID, 'asset-detail');
if(!empty($terms))
foreach ( $terms as $term ) {
    $termID[] = $term->term_id;
}
$temlate_id = $termID[0];
$asset_categoriy_id = wp_get_post_categories($post->ID);
function wp_asset_set_post_views($temlate_id, $asset_categoriy_id){
  $post_id = get_the_ID();
  $ip_address = get_client_ip();
  $obj= new UserReports();
  $browser = $_SERVER['HTTP_USER_AGENT'];
  global  $current_user, $wpdb;
  $table_name = $wpdb->prefix . "asset_views";
  $user_id = 1;
  $currentdate = date('Y-m-d');
  $plan_id = CheckPlanAssetsViewPost($temlate_id);
  $open_asset_cost = $obj->get_current_subscription_data($plan_id, 'open_asset');
  $insertLogSQL = "INSERT INTO " . $table_name . " 
        SET       
        user_id = '$user_id',
        post_id = '$post_id',
        template_id = '$temlate_id',
        category_id = '$asset_categoriy_id[0]',
        user_ip = '$ip_address',
        user_agent = '$browser',
        per_cost = '$open_asset_cost',        
        date = '$currentdate'";
        $results1 = $wpdb->query($insertLogSQL);
}
 $lanCode = ICL_LANGUAGE_CODE;
 if($lanCode=='en'){
    $order = "Order";
    $AssetPrice ="Asset Price";
 }
 else {
  $order = "Auftrag";
  $AssetPrice ="Asset-Preis";
 }

?>

<div class="template-wrapper extended">
    <div>
        <div class="container">
            <div class="breadcrumb">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }
                echo wp_asset_set_post_views($temlate_id, $asset_categoriy_id);                
                // wpb_set_post_views(get_the_ID());                
                ?>
            </div>
            <div class="head_ttl">
                <h2><?php the_title(); ?></h2>

                <a href="#target" class="print"></a>
            </div>
                     
            <div class="product_details ">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="demo">
                            <div class="item">            
                                <div class="clearfix" >
                                <?php 
                                $galleryImage = get_field('select_image',get_the_ID());
                                $sliderImage = array();
                                   if(!empty($galleryImage)){
                                     foreach($galleryImage as $items){
                                     array_push($sliderImage,$items['url']);
                                   }
                                  }
                                  if(!empty($ImageUrl[0])){
                                      array_push($sliderImage,$ImageUrl[0]);
                                  } 
                                  if(empty($sliderImage)){
                                    echo"";
                                  }
                                 ?>
                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                        <?php 
                                         if(!empty($sliderImage)){
                                          foreach($sliderImage as $items){?>
                                           <li data-thumb="<?php echo $items; ?>" class="gallery-img"> 
                                            <img src="<?php echo $items; ?>"  alt="slider_img"  />
                                           </li>
                                         <?php } }
                                         else {?>
                                          <li> 
                                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2018/10/placeholder-image.jpg"  alt="slider_img" width="200" height="200"   />
                                            </li>
                                       
                                        <?php   
                                         }
                                       
                                          
                                          ?> 
                                    </ul>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <?php
                    if($lanCode=='en'){
                        $downloadpdf ="download pdf";
                    }
                    else {
                        $downloadpdf ="PDF Herunterladen";
                    } 
                    ?>
                    <div class="col-sm-6">
                         <div class="product_dtl">
                         <h4><?php the_field('name', get_the_ID()); ?></h4>
                            <?php echo $post->post_content; ?>
                           <hr />
                           <?php the_field('short_description',get_the_ID()); ?>
                           <?php //wp_editor( wpautop(get_option('content',get_field('short_description',get_the_ID()))), 'content', $settings ); ?>
                            <div class="features">
                            <?php  $asset_link = get_field('asset_link', get_the_ID(),true);
                             if(!empty($asset_link)){
                               if($asset_link=="http://"){
                                   $asset_link ="";
                               }
                            ?>
                             <span><a class="track_link" data-userid="<?php echo $userID; ?>" data-postid="<?php echo get_the_ID(); ?>" data-tempid="<?php echo $temlate_id;  ?>" data-catid="<?php echo $asset_categoriy_id[0];  ?>" href="<?php echo $asset_link; ?>" target="_blank"><?php echo $asset_link; ?></a></span>
                            <?php } ?>

                            <?php $price =  get_field('price', get_the_ID());
                              if(!empty($price)){?>
                                <span class="aset_price"><?php echo $AssetPrice; ?> : <span class="">&euro;<?php echo $price; ?></span></span>
                                <?php } ?> 
                                <span style="float:left;">
                                <?php  $downloadUrl = get_post_meta(get_the_ID(),'download_file',true); 
                                if(!empty($downloadUrl)){?>
                                <a class="download_asset btn" data-userid="<?php echo $userID; ?>" data-postid="<?php echo get_the_ID(); ?>" data-tempid="<?php echo $temlate_id;  ?>" data-catid="<?php echo $asset_categoriy_id[0];  ?>" taget="_blank" href="<?php echo $downloadUrl; ?>" download><?php echo $downloadpdf; ?></a>
                                <?php } ?>
                                <?php  $link =  get_field('link', get_the_ID());
                                if(!empty($link)){?>
                                <a href="<?php echo $link; ?>" target="_blank" class="btn btn_bdr "><?php echo $order; ?></a>
                                <?php } ?>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                $desc_second = get_field('description_business',get_the_ID());
               if(!empty($desc_second)){
                wp_editor(  $desc_second, 'second_description', array( 'theme_advanced_buttons1' => false, "media_buttons" => false,"textarea_rows" => 8, "tabindex" => 4 ) );
               }
               ?>
              </div>
             <?php 
             $owneruser  =  get_post($post->ID);
             $user_roles = $current_user->roles;
             $first_name =  get_user_meta($owneruser->post_author,'first_name',true);
             $UserPic    = get_user_meta($owneruser->post_author,'user_picImage',true); 
             $userlocation = get_user_meta($owneruser->post_author,'location',true);
            
             if($lanCode=='en'){
                $contact_name = "Contact Name";
                $location = "Location";
                $name_text = "Name";
                $mobile_placeholder = "Mobile Number";
                $address ="address";
                $message = "Message";
                $n_validate = "Enter Name";
                $num_validate = "Please fill in this field.";
                $email_validate = "Valid email is required.";
                $m_address ="Please, enter address.";
                $m_message ="Please, leave us a message.";
                $send_button = "Send message";
                $captch ="Please complete the Captcha";
                $more_detail = "More detail";
                $readonly = "Only for registered users";
                $detail = "Detail";
                $no_available = "There are no Notes available currently";
                $PersontoownerNotes ="Person to owner Notes";
                $location_text = "Location";
             }
             else {
               $contact_name = "Kontaktname";
               $location_text = "Ort"; 
               $name_text = "Name";
               $mobile_placeholder = "Handynummer";
               $address ="Adresse";
               $message = "Botschaft";
               $n_validate = "Name eingeben.";
               $num_validate = "Bitte füllen Sie dieses Feld aus.";
               $email_validate = "Eine gültige E-Mail-Adresse ist erforderlich.";
               $m_address ="Bitte geben Sie die Adresse ein.";
               $m_message ="Bitte hinterlassen Sie uns eine Nachricht.";
               $send_button = "Nachricht senden";
               $captch ="Bitte füllen Sie das Captcha aus";
               $more_detail = "Mehr Details";
               $readonly = "Nur für registrierte Benutzer";
               $detail = "Detail";
               $no_available = "Derzeit sind keine Notes verfügbar";
               $PersontoownerNotes ="Person an Inhaber Notizen";
             }
             ?>
              <div class="row no-margin">
                <h3><?php echo $detail; ?></h3>
                <div class="col-md-5 col-sm-5 col-xs-12 no-padding">
                    <div class="uploader-user">
                    <?php if(!empty($UserPic)){?>  
                         <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/user-icon.png" alt="" width="94" height="95">
                        <?php } else { ?>
                        <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/user-icon.png" alt="">
                        <?php } ?>
                        <div class="details_owner ">
    
                             <div class="media-body">

                                <ul class="first_not">
                                    <li>
                                        <ul>
                                            <li> <?php echo $contact_name; ?> :</li>
                                            <li> <?php echo $first_name; ?> </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><?php echo $location_text; ?> : </li>
                                            <li><?php echo $userlocation; ?></li>
                                        </ul>
                                    </li>
                                </ul>
                                <a href="#" class="btn" data-toggle="modal" data-target="#moredetail" ><?php echo $more_detail; ?></a>
           
                            </div>
                            
                        </div>
                           
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12 no-padding">
                     <div class="msg_status" style="position: relative; top: -10px;"></div>
                    <?php $assetInfo = get_post($post->ID);
                          $userInfo = get_user_by( 'id', $assetInfo->post_author);
                          $new_user = get_userdata($assetInfo->post_author);

                        if($assetInfo->post_author!=$userID){?>
                        <div class="message-form-owner fullwidth">
                      <form id="message-form"  method="post">

                    <div class="messages"></div>

                    <div class="controls">
                        
                            
                                   <input type="hidden" name="receive_id" value="<?php echo $new_user->id; ?>">
                                   <input type="hidden" name="sender" value="<?php echo $new_user->user_email; ?>">
                                     <input type="hidden" name="asset_ownername" value="<?php echo $new_user->user_firstname; ?>">                                      
                                      <input type="hidden" name="action" value="send_msg_to_owner">
                                      <input type="hidden" name="category_id" value="<?php echo $asset_categoriy_id[0]; ?>">
                                      <input type="hidden" name="template_id" value="<?php echo $temlate_id; ?>">
                                      <input type="hidden" name="postid" value="<?php echo get_the_ID(); ?>">
                                      <input type="hidden" name="gallery" id="thum_gallery" value="">
                                      <input type="hidden" name="usertoowner" id="usertoowner" value="<?php echo $new_user->ID ?>">    
                                      <input type="hidden" name="email_tpl_id" value="<?php echo $feedback_email_templ = icl_object_id(3353,'page',false,ICL_LANGUAGE_CODE); ?>">    
                                  
                               
                              <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">                                    
                                    <input id="form_name" type="text" name="u_name" class="form-control w-100" placeholder="Name *" required="required"
                                        data-error="<?php echo $n_validate; ?>" value="<?php echo (!empty($current_user->first_name) ) ? $current_user->first_name : ''; ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">                                    
                                    <input id="form_phone" type="text" name="m_number" class="form-control w-100" placeholder="<?php echo $mobile_placeholder; ?>  *" required="required"  value="<?php echo (!empty($mobilenum)) ? $mobilenum : ''; ?>">
                                       <input type="hidden" name="post_title" value="<?php echo $assetInfo->post_title; ?>" pattern="^[_A-z0-9]{1,}$" minlength="10" maxlength="10" data-error="<?php echo $num_validate; ?>">     
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">                                    
                                    <input id="form_email" type="email" name="email" class="form-control w-100" placeholder="E-mail id *" required="required"
                                        data-error="<?php echo $email_validate; ?>" value="<?php echo (!empty($current_user->email) ) ? $current_user->email : ''; ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                   
                                     <textarea id="form_message" name="address" class="form-control" placeholder="<?php echo $address; ?>" rows="4" 
                                data-error="<?php echo $m_address; ?>"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-group">
                              <textarea id="form_address" name="message" class="form-control" placeholder="<?php echo $message; ?>" rows="4" required="required"
                                data-error="<?php echo $m_message; ?>"></textarea>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>                        

                        <div class="col-lg-12">
                        <div class="form-group ">

                            <div class="g-recaptcha" data-sitekey="6LfjWXsUAAAAAOfxSwvmwbqa7fkMwMqG-OurXKUd" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="<?php echo $captch; ?>">
                            <div class="help-block with-errors captcha_error"></div>
                        </div>
                      </div>

                        <div class="col-lg-12 captcatdiv">
                        <div class="form-group btn-submitmessage ">
                          <input type="submit" class="btn profile-update-button" value="<?php echo $send_button; ?>">
                        </div>
                      </div>
                        

                    </div>

                </form>
                         
                        </div>
                        <?php } else {?>
                    <div class="contact-form fullwidth">
                       <h4><strong> <?php echo $PersontoownerNotes; ?>:</strong></h4>
                        <div class="col-xs-12 usernotes">
                        <?php $UserToOwnerData = GetUserNotes($post->ID);
                        if(!empty($UserToOwnerData)) { 
                          foreach($UserToOwnerData as $notes){ $user = get_user_by('id', $notes['user_id']); ?>
                          <div class="customLabel">
                          </div>
                          <div class="chat_inline">
                          <div class="user_dtls">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <img class="media-object" width="55" src="<?php bloginfo('template_url') ?>/assets/images/user-icon.png" alt="Media Object">
                                </div>
                                <div class="media-body media-middle">
                                    <span class="mem_name"><?php echo $user->data->user_login; ?></span>
                                    <span class="chat_time"><?php echo date('d-m-Y', strtotime($notes['date'])); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="user_text">
                            <div class="text_fld">
                                <p><?php echo $notes['user_to_owner_note']; ?></p>
                            </div>
                        </div>
                    </div>


                    <?php } } else  echo'<div style="color:red;">'.$no_available.'</div>'; } ?>
                    </div>
                    </div>      
                </div>
          
                
            </div> 
       
 
             
        </div>

        <div class="partner-list">
            <div class="container">

                <div class="row">
                   <?php get_template_part( 'layout/template', 'ads');?>
               </div>
            </div>  
        </div>

        <div>
        
          
        <?php get_template_part( 'layout/template', 'share');?>
        </div>
    </div>  <!-- template wrapper ends here -->
     <?php
     if($lanCode=='en'){
        $Sharethisassestvia = "Share this assest via";
     }
     else {
      $Sharethisassestvia = "Teilen Sie diesen Test über";
     } 
     ?>

    <!-- share product popup -->
    <!-- share product popup -->
    <div id="share_product" class="modal fade reminder_popup" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $Sharethisassestvia; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form_div feedback">
                    <div class="status" style="text-align:center;"></div>
                        <div class="row">
                            <div class="col-sm-12">
                            <?php 
                                 if($lanCode=='en'){
                                    $email_address = "Email Address";
                                    $message ="Message";
                                    $submit ="submit";
                                 }
                                 else {
                                  $email_address = "E-Mail-Addresse";
                                  $message ="Botschaft";
                                  $submit ="einreichen";
                                 } ?>
                                <form method="post" action="#" id="shareemail">
                                    <input type="hidden" name="assert_url" value="<?php echo get_permalink(get_the_ID()); ?>">
                                    <input type="hidden" name="action" value="share_assert_byemail">
                                    <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                                    <input type="hidden" name="gallery" id="thum_gallery" value="">
                                    <input type="hidden" name="template_id" value="<?php echo $temlate_id; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $asset_categoriy_id[0]; ?>">
                                   
                                    <div class="form-group group">
                                        <input type="email" name="email_assert" class="form-control" required="">
                                        <label><?php echo $email_address; ?></label>
                                        <span class="bar"></span>
                                    </div>
                                    <div class="form-group group">
                                        <textarea class="form-control" name="msg_assert" id="msg_assert"  required=""></textarea>
                                        <label>Message</label>
                                        <span class="bar"></span>
                                    
                                    </div>
                                    <div class=" slider_cont text-center">
                                        <button type="submit" class="btn shareassert"><?php echo $submit; ?>
                                        </button>

                                    </div>

                                    <div class="form-group">
                                    <?php 

                                          $assert_desc = get_post(get_the_ID());
                                          $title   = urlencode(get_the_title());
                                          $url     = urlencode(get_the_permalink(get_the_ID()));
                                          $summary = urlencode($assert_desc->post_content);
                                          $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');

                                          // echo $image[0];
                                          ?>

                                        <ul class="social_list">
                                            <!-- <li class="fb">
                                            <a onClick="window.open('http://www.facebook.com/sharer.php?s=100p[title]=<?php echo $title;?>p[summary]=<?php echo $summary;?>p[url]=<?php echo $url; ?>&p[images][0]=<?php echo $image[0];?>&redirect_uri=<?php echo $url; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_blank"><span><i class="fa fa-facebook" aria-hidden="true"></i></span>Facebook</a></li> -->
                                            <li class="fb">
                                            <a onClick="window.open('https://www.facebook.com/dialog/feed?app_id=630557327429595&redirect_uri=<?php echo $url; ?>&link=<?php echo $url; ?>&picture=<?php echo $image[0]; ?>&caption=<?php echo $title ?>&description=<?php echo $summary; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_blank"><span><i class="fa fa-facebook" aria-hidden="true"></i></span>Facebook</a>
                                          </li>
                                            <li class="twt"><a href="https://www.twitter.com/share?url=<?php echo urlencode(get_the_permalink(get_the_ID())); ?>" data-url="<?php echo urlencode('http://d3.iworklab.com/t2iwp1/assets/lorem-ipsumr/?tweet-response=true')?>" target="_blank" data-toggle="tooltip" ><span><i class="fa fa-twitter" aria-hidden="true"></i></span>twitter</a></li>
                                            <li class="gp"><a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink(get_the_ID())); ?>"  target="_blank"><span><i class="fa fa-google-plus" aria-hidden="true"></i></span>google +</a></li>
                                        </ul>

                                    </div>

                                    
                                </form>
                            </div><!--col-sm-6-->
                        </div><!--row-->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- share product popup -->
    <!-- share product popup -->


    <!-- reminder popup -->
    <!-- reminder popup -->
    <div id="reminder_popup" class="modal fade reminder_popup" role="dialog">
        <div class="modal-dialog">
        <?php 
         if($lanCode=='en'){
            $set_reminder = "Set Reminder";
            $reminder_m ="Message";
            $SelectDate ="Select Date & Time:";
            $DateTime = "Date & Time";
            $event = "Terminzeit";
            $event = "Event Start Time";
            $end_event = "Event End Time";
            // $please = "Please select an option";
            $please = "Once";
            $Daily ="Daily";
            $Weekly = "Weekly";
            $Monthly ="Monthly";
            $Quarterly ="Quarterly";
            $Yearly ="Yearly";
            $save ="save";
            $cancel ="Cancel";
         }
         else {
          $email_address = "E-Mail-Addresse";
          $reminder_m ="Botschaft";
          $SelectDate ="Datum und Uhrzeit auswählen:";
          $DateTime = "Terminzeit";
          $event = "Startzeit des Ereignisses";
          $end_event = "Endzeit des Ereignisses";
          // $please = "Bitte wählen Sie eine Option";
          $please = "Einmal";
          $Daily ="Täglich";
          $Weekly = "Wöchentlich";
          $Monthly ="Monatlich";
          $Quarterly ="Vierteljährlich";
          $Yearly ="Jährlich";
          $save ="sparen";
          $cancel ="stornieren"; 
          } 
         ?>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $set_reminder; ?></h4>
                    <div class="reminderMsg" style="text-align:center;"></div>
                </div>
                <div class="modal-body">
                    <div class="form_div feedback">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" id="set_remainder" >
                                 <input type="hidden" id="event-title" value="<?php echo get_the_title(get_the_ID()); ?>" autocomplete="off" />
                                  <input type="hidden" name="action" value="assert_remainder">
                                  <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                                  <input type="hidden" name="template_id" value="<?php echo $temlate_id; ?>
                                  ">
                                  <input type="hidden" name="category_id" value="<?php echo $asset_categoriy_id[0]; ?>
                                  ">
                                    <div class="form-group group">
                                        <textarea class="form-control" name="message"></textarea>
                                        <label ><?php echo $reminder_m; ?></label>
                                        <span class="bar"></span>
                                    </div>
                                    <span class="tag"><?php echo $SelectDate; ?></span>         
                                    <div class="row form-group">
                                        <div class='col-xs-6'>
                                            <div class="form-group ">
                                                <div class='input-group date'>
                                                    <input type="text" name="remainder_date" id="event-date" placeholder="<?php echo $DateTime; ?>" lass="form-control" autocomplete="off" /> 
                                                    <input type="hidden" id="event-start-time" placeholder="<?php echo $event; ?>" autocomplete="off" />
                                                    <input type="hidden" id="event-end-time" placeholder="<?php echo $end_event; ?>" autocomplete="off" />
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
                                                    <option value="once"><?php echo $please; ?></option>
                                                    <option value="daily"><?php echo $Daily; ?></option>
                                                    <option value="weekly"><?php echo $Weekly; ?></option>
                                                    <option value="monthly"><?php echo $Monthly; ?></option>
                                                    <option value="quarterly"><?php echo $Quarterly; ?></option>
                                                    <option value="yearly"><?php echo $Yearly; ?></option>
                                                </select>
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" slider_cont text-center">
                                        <button type="submit" class="btn reminder"><?php echo $save; ?></button>
                                        <button type="submit" class="btn btn_black" data-dismiss="modal"><?php echo $cancel; ?></button>
                                    </div>
                                </form>
                            </div><!--col-sm-6-->
                           
                        </div><!--row-->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- reminder popup -->
    <!-- reminder popup -->

    <!-- more detail popup -->

            
    <div id="moredetail" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <?php
              global  $current_user, $wpdb;
              $table_name = $wpdb->prefix . "user_asset_accesslevel";
              $user_id = get_current_user_id();
              $post_id = get_the_ID();
              $owneruser =  get_post($post->ID);
              $user_roles = $current_user->roles;
              if ($user_roles[0]=='administrator') {
              $visible = "administrator";
              }
              else if($owneruser->post_author==$userID){
              $visible ="owner";
              }
              else if($owneruser->post_author!=$userID){
              $visible ="notowner";
              }
              $UserAccess = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id' ORDER BY id DESC");
              $user_p    =  $UserAccess->user_private_note;
              $u_owner   =  $UserAccess->user_to_owner_note; 
              $o_private =  $UserAccess->owner_private_note; 

              if($lanCode=='en'){
                 $UserPrivate ="User Private";
                 $UserPrivate_p ="Type here";
                 $user_owner = "User to Owner";
                 $user_owner_p = "This message will be seen to user only";
                 $UsertoOwne = "User to Owner";
                 $UsertoOwner_m ="This message will be seen to asset owner";
                 $OwnerPrivate = "Owner Private";
                 $save ="Save";
               }
              else {
                 $UserPrivate ="Benutzer privat";
                 $user_owner = "Benutzer an Besitzer";
                 $user_owner_p = "Diese Nachricht wird nur dem Benutzer angezeigt";
                 $UserPrivate_p ="Geben Sie hier ein";
                 $UsertoOwne = "Benutzer an Besitzer";
                 $UsertoOwner_m ="Diese Nachricht wird dem Asset-Besitzer angezeigt";
                 $OwnerPrivate = "Eigentümer privat";
                 $save ="sparen";
              } 
         ?>
           
                <div class="modal-body">
                    <div class="form_div feedback">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="status" style="text-align:center;"></div>
                             <?php if(is_user_logged_in()){ ?>
                             <form method="post" id="UserAccessLevel">
                             <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                             <input type="hidden" name="action" value="accessLevel">
                            <?php  switch($visible): 
                                    case 'administrator': ?>
                                    <div class="form-group group">
                                    <textarea placeholder="<?php echo $UserPrivate_p; ?>" class="form-control" rows="2" name="user_priv" id="user_priv" required><?php if(!empty($user_p)){ echo $user_p; } ?></textarea>
                                    <label ><?php echo $UserPrivate; ?></label>
                                        <span class="bar"></span>
                                    </div>

                                    <div class="form-group group">
                                    <textarea placeholder="<?php echo $user_owner_p; ?>" class="form-control" rows="2" name="user_owner" id="user_owner" required><?php if(!empty($u_owner)){ echo $u_owner; } ?></textarea>
                                    <label ><?php echo $user_owner; ?></label>
                                    <span class="bar"></span>
                                    </div>
                                    <div class="form-group group">
                                     <textarea placeholder="Type here" class="form-control" rows="2" name="owner_priv" id="owner_priv" required><?php if(!empty($o_private)){ echo $o_private; } ?></textarea>
                                     <label ><?php echo $OwnerPrivate; ?></label>
                                     <span class="bar"></span>
                                    </div>
                                    <?php break;?>
                                    <?php case 'owner': ?>
                                    <div class="form-group group">
                                    <textarea placeholder="<?php echo $UsertoOwner_m; ?>" class="form-control" rows="2" name="user_owner" id="user_owner" readonly="true"><?php if(!empty($u_owner)){ echo $u_owner; } ?> </textarea>
                                    <label ><?php echo $UsertoOwne; ?></label>
                                    <span class="bar"></span>
                                    </div>
                                    <div class="form-group group">
                                     <textarea placeholder="<?php echo $user_owner_p; ?>" class="form-control" rows="2" name="owner_priv" id="owner_priv"><?php if(!empty($o_private)){ echo $o_private; } ?></textarea>
                                     <label ><?php echo $OwnerPrivate; ?></label>
                                     <span class="bar"></span>
                                    </div>
                                    <?php break;?>
                                    <?php case 'notowner': ?>
                                   <div class="form-group group">
                                    <textarea placeholder="<?php echo $user_owner_p; ?>" class="form-control" rows="2" name="user_priv" id="user_priv" ><?php if(!empty($user_p)){ echo $user_p; } ?></textarea>
                                    <label ><?php echo $UserPrivate; ?></label>
                                        <span class="bar"></span>
                                    </div>

                                    <div class="form-group group">
                                    <textarea placeholder="<?php echo $UsertoOwner_m; ?>" class="form-control" rows="2" name="user_owner" id="user_owner"><?php if(!empty($u_owner)){ echo $u_owner; } ?></textarea>
                                    <label ><?php echo $user_owner; ?></label>
                                    <span class="bar"></span>
                                    </div>
                                    <?php break;?>
                                    <?php endswitch;?>
                                    
                                    <div class=" slider_cont text-center">
                                    <button class="private_acesslevel" type="submit" class="btn" name="contact_query"><?php echo $save; ?><span></span>
                                    </button>

                                    </div>
                                </form>
                                <?php } else {
                                   echo $readonly;
                                } ?>
                            </div><!--col-sm-6-->

                        </div><!--row-->
                    </div>
                </div>

            </div>

        </div>
  
    </div>
  <?php 
    $postauthor = get_post(get_the_ID());
    $uid = get_current_user_id();
    if($postauthor->post_author==$uid){
       $css ='block'; 
        } else {
            $css ='none';  
        }
  ?>
    <style>

    .status {
        color: green;
    }
    .error {
        color:red;
    }
    .template-wrapper {
    background-color: #f6f6f6;
    padding-bottom: 0px !important; 
    }
     div#mceu_31:before {
        position: absolute;
        content: "";
        height: 100%;
        width: calc(100% - 15px);
        left: 0;
        top: 0;
        background: #ff000005;
    }

    i.mce-ico.mce-i-link {
        display: none !important;
    }
    div#mceu_27-body {
    display: <?php echo $css; ?>;
    }
    button#second_description-tmce {
    display: <?php echo $css; ?>;
   }
    button#second_description-html {
    display: <?php echo $css; ?>;
    }

   </style>
    <!-- more detail popup end -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" /> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/lightslider.js"></script> -->

    <script type="text/javascript">
        /*$(document).ready(function() {
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:4,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
        });*/
    </script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('area3');
        });
    </script>
    <script type="text/javascript">
    // jQuery(function () {
    //  jQuery('#datetimepicker1').datetimepicker();

    // });
</script>
<script type="text/javascript">

    

     $(document.body).ready(function(){

       $('.lSGallery').attr("id","homeGallaerySlider");
       // $(document.body).on('click', '#homeGallaerySlider', function() {
       //          // $(this).addClass("abhi");
       //  });

      var img_src = $('#image-gallery li.active img').attr('src');
           $("#thum_gallery").val(img_src);
     });

    $('.head_ttl .print').on('click', function(e) {
        e.preventDefault();
        $link = $(this).attr('href');

        $('html, body').animate({
            scrollTop: $($link).offset().top - 10
        }, 800 );
    });

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

/*$('#UserAccessLevel').submit(function(event){
$('.private_acesslevel').text('Processing..');
$.ajax({          
        type: 'POST',
        dataType: 'json',
        url: theme_ajax.url,
        data: $(this).serialize(),
        success: function (response) {
        $('.private_acesslevel').text('Save');
        if (response.status == "Success"){
        $('.status').html(response.message);
        setTimeout(function(){// wait for 5 secs(2)
        $('.status').hide();
        }, 2000);
        }
        }
    });
return false;
});*/

</script>
<script type="text/javascript">
$(document).ready(function(){

$('#second_description').attr("readonly","true");
$('#usertoowner').val($('#user_owner').val());
// $(document).on('click','#second_description',function(){
// alert("sdkfjs");
// });

});

</script>
<?php get_footer();
