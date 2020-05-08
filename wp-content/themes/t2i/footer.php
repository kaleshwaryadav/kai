<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 * @version 1.2
 */
$lanCode = ICL_LANGUAGE_CODE;
     if($lanCode=='en'){
        $create_asset ="Create Asset";
        $Login = "Login";
        $signup ="Sign Up";
        $MyAssets ="My Assets";
        $AllAssets = "All Assets";
        $PrivacyPolicy ="Privacy Policy";
        $Terms ="Terms &amp; Condition";
        $allurl = site_url().'/assets/';
      }
     else
     {
        $create_asset ="Asset erstellen";
        $Login = "Anmeldung";
        $signup ="Anmelden";
        $MyAssets ="Meine Assets";
        $AllAssets = "Alle Assets";
        $PrivacyPolicy ="Datenschutz-Bestimmungen";
        $Terms ="Begriffe & amp; Bedingung";
        $allurl = site_url().'/de/assets/';
        
     }
     if ( is_user_logged_in() ) {
         $creatLogin = get_permalink(77);
     }
     else
     {
       $creatLogin = get_permalink(32);
     }
?>



<!-- footer starts here -->
<footer>
	<div class="container">
		<div class="row footer-main">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<h4><?php the_field('quick_link_heading', 'option') ?></h4>
                <div class="menu-quick-links-container">
                <ul id="quick-menu" class="list-unstyled">
                <?php if (!is_user_logged_in() ) {?>
                <li id="menu-item-40" class="">
                <a href="<?php echo get_permalink(32); ?>/login/"><?php echo $Login; ?></a>
                </li>
                <li id="menu-item-39">
                <a href="<?php echo get_permalink(35); ?>/sign-up/"><?php echo $signup; ?></a>
                </li>
                <?php } ?>
                <li id="menu-item-49">
                <a href="<?php echo get_permalink(41); ?>/my-assets/"><?php echo $MyAssets; ?></a>
                </li>
                <li id="menu-item-1192">
                <a href="<?php echo $allurl; ?>"><?php echo $AllAssets; ?></a>
                </li>
                 <li id="menu-item-47"><a href="<?php echo $creatLogin; ?>"><?php echo $create_asset; ?>
                 </a>
                 </li>
                <li id="menu-item-48">
                <a href="<?php echo get_permalink(43); ?>/privacy-policy/"><?php echo $PrivacyPolicy; ?></a>
                </li>
                <li id="menu-item-47">
                <a href="<?php echo get_permalink(45); ?>/terms-condition/"><?php echo $Terms; ?></a>
                </li>
                </ul>
                </div>
                 </ul>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4">
					<h4><?php the_field('category_heading', 'option') ?></h4>
					<ul id="quick-menu" class="list-unstyled">
                        <?php 
                        /*$terms = get_terms( array(
                        'taxonomy' => 'category',
                        'hide_empty' => true,
                         ) );
                        foreach($terms as $category){?>
                        <li>
                            <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
                          </li>
                       <?php
                        }*/
                        ?>
                       <?php
                        $categories = get_categories( array(
                                    'hide_empty'   => 0,
                                    'orderby' => 'name',
                                    'order'   => 'ASC',
                                    'category__not_in' => array( '1' ),
                                ) );
                       if($categories){
                          foreach($categories as $item){?>
                             <li>
                            <a href="<?php echo get_category_link( $item->term_id ); ?>"><?php echo $item->name; ?></a>
                          </li>
                        <?php }
                       }
                        ?>
                    </ul>

                     
					</div>
					<div class="clearfix visible-xs"></div>
					<div class="col-md-4 col-sm-4 col-xs-4">

						<h4><?php the_field('social_network_heading', 'option') ?></h4>
                        
						<?php wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_id'        => 'social-menu',
							'menu_class' => 'list-unstyled list-inline social-list',
							) ); ?>

							<div class="feeback-box">
								<a href="<?php echo get_permalink(83); ?>"><span class="fa fa-comments-o"></span>  <?php the_field('submit_feedback','option'); ?></a>
							</div>
						</div>
					</div>
				</div>	
				<div class="copyright-sec text-center">
					<p><?php the_field('copyright', 'option') ?></p>
				</div>
			</footer>
            <!-- Modal -->
            <div id="alertBox" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Message</h4>
                  </div>
                  <div class="modal-body alerMsg">
                    <p>Some text in the modal.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
			
		

			<script type="text/javascript">
              if(getLangCode=='de'){
                var registerMsg ="Please register first to access it";
                var sorry = "Sorry,You can't cloning this assert";
              }
              else {
                var registerMsg ="Bitte registrieren Sie sich zuerst, um darauf zuzugreifen";
                var sorry = "Entschuldigung, Sie können diese Behauptung nicht klonen";
              }
               jQuery(function () {
                    $('.accessMSG').click(function(e){
                         alert(registerMsg);
                    });
                   
                });
             function cloning(){
                alert(sorry);
                return false;
             }
			</script>
			<?php wp_footer(); ?>

		</body>
		</html>
