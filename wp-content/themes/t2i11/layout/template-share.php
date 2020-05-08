<?php 
    $lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
        $Share ="Share";
        $Clone ="Clone";
        $Reminder ="Reminder";
        $UnFavorite="Un-Favorite";
        $Addtofavorite ="Add to favorite";
        $Favorite ="Favorite";
        $Report ="Report";
    }
    else
    {
       $Share ="Aktie";
       $Clone ="Klon";
       $Reminder ="Erinnerung";
       $UnFavorite ="Favorit nicht";
       $Addtofavorite ="Zu den Favoriten hinzufügen";
       $Report ="Bericht";
       $Favorite ="Liebling";
    }

    if (is_user_logged_in() ) {
    global $post;
    $category_detail=get_the_category( get_the_ID() );
    $template_name = wp_get_post_terms(get_the_ID(), 'asset-detail');
    $template_id = $template_name[0]->term_id;

    if($template_name[0]->term_id==12){
       $templateID = 87;
    }
    else if($template_name[0]->term_id==7){
      $templateID = 91; 
    }
    else if($template_name[0]->term_id==6){
      $templateID = 89; 
    }

    $cloning_blocked = get_field('block_cloning', 'asset-detail'.'_'.$template_name[0]->term_id);
    $asset_categoriy_id = wp_get_post_categories($post->ID);


?>
  <div class="container">
                <div class="activity-list" id="target">
                    <ul class="list-unstyled list-inline text-center favorite_like">
                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#share_product">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_1.png" alt="">
                                <p><?php echo $Share; ?></p>
                            </a>
                        </li>
                        <li>
                        <?php if($cloning_blocked==1){?>
                        <a href="javascript:void();" onclick="cloning();">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_2.png" alt="">
                                <p><?php echo $Clone; ?></p>
                            </a>
                          <?php  } else { ?>
                        <a href="<?php echo get_permalink($templateID); ?>?astid=<?php echo get_the_ID();  ?>&cartId=<?php echo $category_detail[0]->term_id; ?>&cloning=done">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_2.png" alt="">
                                <p><?php echo $Clone; ?></p>
                            </a>
                        <?php } ?>
                        </li>
                       <li>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#reminder_popup">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_3.png" alt="">
                                <p><?php echo $Reminder; ?></p>
                            </a>
                        </li>
                        <li class="favorite_unfavorite">
                        <?php $chek_favorite = check_favoriteAsset(get_the_ID()); 
                        if($chek_favorite==1){  ?>
                        <a href="javascript:void(0);" onclick="unfavorite_like('<?php echo get_the_ID(); ?>');">
                           <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">
                          <p class='favorite'><?php echo $UnFavorite; ?></p>
                            </a>
                            </span>
                        <?php }

                        else { ?>
                         <a  href="javascript:void(0);" onclick="favorite_like('<?php echo get_the_ID(); ?>','<?php echo $template_id; ?>','<?php echo $asset_categoriy_id[0]; ?>');">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">

                                <p class='favorite'><?php echo $Addtofavorite; ?></p>
                            </a>

                       <?php } 
                        ?>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="report_click('<?php echo get_the_ID(); ?>','<?php echo $template_id; ?>','<?php echo $asset_categoriy_id[0]; ?>');">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_5.png" alt="">
                                <p><?php echo $Report; ?></p>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="javascript:void(0);">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_6.png" alt="">
                                <p>Message</p>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
           <?php } else { ?>
         <div class="container">
                <div class="activity-list" id="target">
                    <ul class="list-unstyled list-inline text-center">
                        <!-- <li>
                            <a href="<?php echo get_permalink(32); ?>">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_1.png" alt="">
                                <p>Share</p>
                            </a>
                        </li> -->
                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#share_product">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_1.png" alt="">
                                <p><?php echo $Share; ?></p>
                            </a>
                        </li>
                        <li>
                        <a href="<?php echo get_permalink(32); ?>">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_2.png" alt="">
                                <p><?php echo $Clone; ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_permalink(32); ?>">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_3.png" alt="">
                                <p><?php echo $Reminder; ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_permalink(32); ?>">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">
                                <p><?php echo $Favorite; ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_permalink(32); ?>">
                                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_5.png" alt="">
                                <p><?php echo $Report; ?></p>
                            </a>
                        </li>

                </div>
            </div>
           <?php } ?>
