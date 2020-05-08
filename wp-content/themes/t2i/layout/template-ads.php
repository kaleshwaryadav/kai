<?php 
$category_ids = get_the_terms( $post->ID, 'category');
if(!empty($category_ids))
foreach ($category_ids as $ids ) {
    $cateID[] = $ids->term_id;
}
$categoryIDs = $cateID[0];
$terms = get_the_terms( $post->ID, 'asset-detail');
if(!empty($terms))
foreach ( $terms as $term ) {
    $termID[] = $term->term_id;
}
$temlate_id = $termID[0];

$ads = array('post_type' => 'adds',
                   'post_status' => 'publish',
                   'suppress_filters' => false,
                   'posts_per_page'=>4, 
                   'order' => 'DESC',
                   'tax_query' => array(
                     'relation' => 'AND',
                     array(
                          'taxonomy' => 'category',
                          'field'    => 'term_id',
                          'terms'    => $categoryIDs,
                        ),
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => $temlate_id,
                        )
                 )
               ); 
                $ads_list =  get_posts($ads);
                $placehoder_image = get_field('placehoder_image', 'option'); 
                ?>
                <?php if($ads_list){
                foreach($ads_list as $item){
                $adslink = get_field('adds_url',$item->ID);
                $banner_image_url = get_field('banner_image_url',$item->ID);
                $ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID ), 'full');
                if(!empty($adslink)){
                    $links = $adslink;
                     $imageUrl = $banner_image_url ? $banner_image_url : $placehoder_image;
                }
                else {
                    $links = '#';
                    $imageUrl = $placehoder_image; 
                }
    
                $categoriy_id = wp_get_post_categories($post->ID);
                ?>
            
                <div class="col-sm-3 col-xs-6 text-center">
                 <a href="<?php echo $adslink; ?>" target="_blank" onclick="add_click('<?php echo $item->ID; ?>','<?php echo $temlate_id; ?>','<?php echo $categoriy_id[0]; ?>');" title="<?php echo get_the_title($item->ID); ?>"  >
                 <img class="img-responsive" src="<?php echo $imageUrl; ?>" alt="">
                </a>
                </div>
   <?php } } ?>
    

