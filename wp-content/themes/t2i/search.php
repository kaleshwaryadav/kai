<?php
/**
* The template for displaying search results pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package WordPress
* @subpackage T2i
* @since 1.0
* @version 1.0
*/
global $current_user;
$user_id = get_current_user_id();
get_header(); ?>

<div class="template-wrapper">
  <div class="container ">
    <header class="page-header header-title-search">
      <?php if ( have_posts() ) : ?>
        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 't2i' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php else : ?>
          <h1 class="page-title"><?php _e( 'Search Results', 't2i' ); ?></h1>
        <?php endif; ?>
      </header><!-- .page-header -->


      <section>

        <?php

        $search_term = $_GET['s'];
        $args = array(
          'post_type' => 'assets',
          's' => $_GET['s'],
          'post_status' => 'publish',
          'orderby'     => 'title', 
          'order'       => 'ASC',
        );
        $searchval = get_posts($args);
        if(count($searchval)>0){
          query_posts($args);

        }
        else {
          $search_term = $_GET['s'];
          $args = array(
            'post_type' => 'assets',
            'post_status' => 'publish',
            'orderby'     => 'title', 
            'order'       => 'ASC',
             'suppress_filters' => false,
            'meta_query' => array(
              'relation' => 'OR',
              array(
                'key' => 'name',
                'value' => $search_term,
                'compare' => 'LIKE'
              ),
              array(
                'key' => 'short_description',
                'value' => $search_term,
                'compare' => 'LIKE'
              ),
              array(
                'key' => 'description_business',
                'value' => $search_term,
                'compare' => 'LIKE'
              )
            )

          ); 
          query_posts($args);
        }
        ?>

        <ul class="row list-unstyled ">
          <?php
          $placehoder_image = get_field('placehoder_image', 'option'); 
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


          if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();

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
                $p = __('&euro;');
              }
              else {
                $p = '';
              }
              $url = get_permalink(get_the_ID());
              ?>
              <li class="col-md-3 col-sm-4 col-xs-6">
                <div class="list-box-image">
                  <!-- <a href="http://localhost/kaipro/assets/kaleshwar/" class="btn"> -->
                    <img class="img-responsive" src="<?php echo $assert_image[0];  ?>" alt="">
                    <div class="image-text assert">

                      <p><?php echo get_field('business_name',get_the_ID()); ?></p>
                    </div>
                    <!--  </a> -->
                  </div>
                  <div class="list-box-description">
                    <ul class="list-unstyled ">
                      <li>
                        <strong><?php 
                        $name = get_post_meta(get_the_ID(),'name', true);
                        echo char_limit_asset_title($name);
                        ?></strong>
                      </li>
                      <li>                                                
                        <strong><small><?php the_title(); ?></small></strong>
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
                          <?php if(!empty($user_id)){ ?>
                            <?php if($user_id==get_the_author_ID()){ ?>
                              <span><?php echo $Publish; ?>:</span><input class='toggle' type="checkbox" <?php if($poststatus->post_status=='publish'){ echo'checked="checked"'; }?>   name='check1'  onclick="publish_assert('<?php echo get_the_ID(); ?>');" />
                            <?php } ?>
                          <?php } ?>
                          <div>
                            <?php echo do_shortcode('[dqr_code url='.$url.' size="80" color="#000000" bgcolor="#ffffff"]');?>
                          </div>
                        </li>
                      </ul>
                      <div class="btn_set newDivstyle">
                        <div class="btn_group custom-btn-group">
                           <?php if(!empty($user_id)){ ?>
                            <?php if($user_id==get_the_author_ID()){ ?>
                            <a class="btn btn_bdr edit" href="<?php echo get_permalink(102); ?>?astid=<?php echo base64_encode(get_the_ID()); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $edit; ?></a>
                           <?php } ?>
                          <?php } ?>
                          <a href="<?php the_permalink(); ?>" class="btn"><i class="fa fa-eye"></i><?php echo $view; ?></a>
                        </div>

                      </div>
                    </div>
                  </li>
                  <?php

/**
* Run the loop for the search to output the results.
* If you want to overload this in a child theme then include a file
* called content-search.php and that will be used instead.
*/
//get_template_part( 'template-parts/post/content', 'content' );

endwhile; // End of the loop.


else : ?>

  <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 't2i' ); ?></p>
  <?php
//get_search_form();

endif;
?>

</ul>
<!-- <div class="view-more-btn">
<a href="">View More</a>
</div> -->


</div>

</section>
</div><!-- .wrap -->
<script>
  function publish_assert(postid){
    $.ajax({            
      type: 'POST',
      dataType: 'html',
      url: theme_ajax.url,
      data: { 
        'action':'publish_assert', 
        'postID': postid, 
      },
      success: function (response) {
      }
    });
    return false; 
  }

</script>
<?php get_footer();
