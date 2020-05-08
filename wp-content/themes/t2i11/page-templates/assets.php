<?php
/*
 * Template Name: My Assets
 */

get_header(); ?>
<?php
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/login' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } ?>
<!-- main-body section starts here -->
<style type="text/css">
.blackoverlay {
  background-color: #000;
  display: none;
  height: 100%;
  opacity: 0.7;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 99999;
}

.loaderjob {
  left: 88%;
  margin-left: -690px;
  margin-top: -12px;
  position: fixed;
  display: none;
  top: 50%;

  z-index: 999999;
}
.success-story-main > ul > li{
  min-height: 450px;
}
strong {
    float: left;
}
</style>
<div class="blackoverlay" id="bol" style="display: none;"> </div>
<img src="<?php echo get_template_directory_uri() ?>/assets/images/ajax-loader.gif" class="loaderjob" id="loaderjob">  
<div class="template-wrapper">
	<section>

		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();          
				}?>

                <?php
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                    $Price ="Price";
                    $Publish ="Publish";
                    $edit ="edit";
                    $view ="View";
                    $Sorry ="Sorry no asset created,please subscribe plan to create assert";
                    $my_asset ="My Assets";
                }
                else
                {
                   $Price ="Preis";
                   $Publish ="Veröffentlichen";
                   $edit ="bearbeiten";
                   $view ="Aussicht";
                   $Sorry ="Leider wurde kein Asset erstellt. Abonnieren Sie den Plan, um Assert zu erstellen";
                   $my_asset ="Meine Assets";
                }

                $placehoder_image = get_field('placehoder_image', 'option');                
                global $current_user;
                wp_get_current_user();    
                $args = array(
                    'author'        =>  $current_user->ID, // I could also use $user_ID, right?
                    'orderby'       =>  'post_date',
                    'order'         =>  'DESC',
                    'post_status'   => array('draft','publish'),
                    'post_type'     =>'assets',
                    'suppress_filters' => false,
                    'paged' => get_query_var('paged')
                    );
                   query_posts($args);
                ?>
			</div>
            
			<section class="success-sec dashboard">
				<h3><?php echo $my_asset;  ?></h3>
				<!-- <a class="btn" href="#">add more</a> -->
				<div class="success-story-main text-center">			
					<ul class="row list-unstyled ">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $assert_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()));
                    $galleryImage = get_field('select_image',get_the_ID());
                    if(empty($assert_image))
                    {
                      if(!empty($galleryImage)){
                        $assert_image[] = $galleryImage[0]['url'];
                      }
                      else{
                        $assert_image[] = $placehoder_image;
                      }
                    } 
                    $poststatus =  get_post(get_the_ID()); 
                    $price = get_field('price',get_the_ID()); 
                    if(!empty($price)){
                        $p = '€';
                    }
                    else {
                    $p = '';
                    }
                    $url = get_permalink(get_the_ID());
                    ?>
                                <li class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="list-box-image">
                                        <img class="img-responsive" src="<?php echo $assert_image[0]; ?>" alt="">
                                        <div class="image-text assert">
                                          <?php if(is_user_logged_in()){ ?>
                                            <a href="javascript:void(0);" onclick="delete_assert('<?php echo get_the_ID(); ?>');" post-data="<?php echo get_the_ID(); ?>"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                          <?php } ?>
                                           <p><?php echo get_the_title(get_the_ID()); ?></p>
                                        </div>
                                    </div>

                                    <div class="list-box-description">
                                        <ul class="list-unstyled ">
                                            <li>
                                                <strong> <?php 
                                                $name = get_post_meta(get_the_ID(),'name', true);
                                                echo char_limit_asset_title($name);
                                                ?></strong>
                                            </li>
                                            <li>                                                
                                             <p><?php echo wp_trim_words( get_the_content(),10); ?></p>
                                            </li>
                                            <?php
                                            $price = get_post_meta(get_the_ID(),'price', true);
                                            if($price){
                                            ?>
                                            <li>
                                              <span><?php echo $Price; ?>:</span><p><?php echo $p;?><?php echo $price; ?></p>
                                            </li>
                                            <?php } else{
                                            $small_temp = wp_get_post_terms(get_the_ID(), 'asset-detail');
                                            foreach($small_temp as $tem){
                                            $temp_id = $tem->term_id;
                                            }
                                            if($temp_id==12){
                                                ?>
                                              <li>
                                              <span><?php echo $Price; ?>:</span><p>0€</p>
                                            </li>
                                            <?php } }?>
                                            <li>
                                              <?php if(is_user_logged_in()){ ?>
                                             <span><?php _e('Publish:','t2i') ?></span>
                                             <input class='toggle publish-assert-js' id="asset_id_<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>" data-status="<?php echo $poststatus->post_status; ?>" data-postid="<?php echo get_the_ID(); ?>" type="checkbox" <?php echo ($poststatus->post_status === 'publish') ? 'checked="checked"' : '';  ?>   name='check1' />
                                             <!-- <input class='toggle publish-assert-js' data-postid="<?php echo get_the_ID(); ?>" type="checkbox" <?php if($poststatus->post_status=='publish'){ echo'checked="checked"'; }?>   name='check1'  onclick="publish_assert('<?php echo get_the_ID(); ?>');" /> -->
                                                 <?php } ?>
                                                <div>
                                   <?php echo do_shortcode('[dqr_code url='.$url.' size="80" color="#000000" bgcolor="#ffffff"]');?>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                        <div class="btn_set newDivstyle">
                                            <div class="btn_group custom-btn-group">
                                              <?php if(is_user_logged_in()){ ?>
                                                <a class="btn btn_bdr edit" href="<?php echo get_permalink(102); ?>?astid=<?php echo base64_encode(get_the_ID()); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $edit; ?></a>
                                              <?php } ?>
                                                <a href="<?php the_permalink(); ?>" class="btn"><i class="fa fa-eye"></i><?php echo $view; ?></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>

                               <?php endwhile; else: echo '<div style="color:red;">'.$Sorry.'</div>'; ?>
                        <?php endif;  ?>
                
                         
						
						
					</ul>
			<!-- <div class="view-more-btn">
				<a href="">View More</a>
			</div> -->
		</div>	
	</section>
</div>	
</section>
</div>	<!-- template wrapper ends here -->
<script>


function delete_assert(postid){
    if (confirm("Are you sure want to delete asset!")) {
    $('#bol').show();
    $('#loaderjob').show();
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action':'delete_assert', 
        'postID': postid, 
         },
        success: function (response) {
          $('#bol').hide();
         $('#loaderjob').hide();
        location.reload();
        }
    });
    return false; 

    } 
   
}
</script>
<?php get_footer();
