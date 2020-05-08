<?php 
  $business_template = $post->post_title;
  $planID = get_field('choose_template_here',$post->ID);
  $template_id = get_field('choose_template_here',get_the_ID());

            $sub_plan = array(
               'post_type' => 'subscription',
               'posts_per_page'=>-1,
               'post_status' => 'publish',
               'suppress_filters' => false,
               'tax_query' => array(
                 'relation' => 'AND',
                array(
                    'taxonomy' => 'asset-detail',
                    'field' => 'term_id',
                    'terms' => $planID
                ),
              ) 
            );

               $plan_detail =  get_posts($sub_plan);
               if($plan_detail){
                foreach($plan_detail as $item){ $plan_des = get_field('plan_description',$item->ID); 
                $price =  get_field('plan_price',$item->ID);
                $plan_name = get_the_title($item->ID);
                $plan_subscribedfor = get_field('choose_subscription_plan',$item->ID);
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                 $Purchagedplan ="Purchaged plan";
                 $Selectthismodel = "Select this model";
                }
                else
                {
                 $Purchagedplan ="Kaufplan";
                 $Selectthismodel = "Wählen Sie dieses Modell aus";
                }
               ?>
                <div class="col-sm-4">
                            <div class="bg_white text-center">
                               <form class="plan_form"  method="post" onSubmit="plan_subscription(this); return false;">
                               <input type="hidden" class="price" name="price" value="<?php echo $price; ?>">
                               <input type="hidden" name="template_id" value="<?php echo $template_id; ?>">
                               <input type="hidden" class="plan_name" name="plan_name" value="<?php echo $plan_name; ?>">
                               <input type="hidden" class="plan_id"  name="plan_id" value="<?php echo $item->ID; ?>">
                               <input type="hidden" name="business_template" value="<?php echo $business_template; ?>">
                               <input type="hidden" name="choosen_plan" value="<?php echo $plan_subscribedfor; ?>">
                                <input type="hidden" name="action" value="plan_subscription">
                               
                                <span><?php echo  get_the_title($item->ID); ?></span>
                                <h4><?php echo get_field('plan_title',$item->ID); ?></h4>
                                <ul>
                               <?php if(!empty($plan_des)){ 
                                        foreach($plan_des as $p){
                                    ?>
                                    <li><?php echo $p['plan_detail']; ?></li>
                                    <?php } } ?>
                                </ul>
                               <?php $is_active = check_subscription_plan($template_id);
                                 $plan_id = UserPurchaged_Plan($item->ID);
                                if($item->ID==$plan_id){ ?>
                                <button type="submit" class="btn btn_black" disabled><?php echo $Purchagedplan; ?></button>
                                <?php } else { ?>
                                <input type="submit" class="btn btn_black" value="<?php echo $Selectthismodel; ?>" >
                                  <?php  } ?>
                                </form>
                            </div>
                        </div>

               <?php   }
              } ?>
