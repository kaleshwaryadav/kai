<?php
/*
 * Template Name: Create Assets
 */

get_header(); 

if(!is_user_logged_in()) {
$url = esc_url( home_url( '/login' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } ?>
<?php 
    $lanCode = ICL_LANGUAGE_CODE;
     if($lanCode=='en'){
        $CreateNewAssest ="Create New Assest";
        $ChooseCategory = "Choose Category";
        $select_Category ="Please select category";
        $ChooseCategory ="Please Choose Category";
        $ImageTemplate  = "Image Template";
        $ElectronicTemplate ="Electronic Template";
        $SmallBusinessTemplate ="Small Business Template";
     }
     else
     {
        $CreateNewAssest = "Neues Asset erstellen";
        $ChooseCategory = "Kategorie auswählen";
        $select_Category = "Bitte wählen Sie eine Kategorie aus";
        $ChooseCategory = "Bitte Kategorie wählen";
        $ImageTemplate  = "Bildvorlage";
        $ElectronicTemplate ="Elektronische Vorlage";
        $SmallBusinessTemplate ="Small Business-Vorlage";
     }
   ?>


<!-- main-body section starts here -->

<div class="template-wrapper extended">
	<section>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>
			<div class="head_ttl">
				<h2><?php echo $CreateNewAssest; ?></h2>
				<!--  <a href="#" class="print"></a> -->
			</div>
			<div class="templates">
				<div class="row">
					<div class="col-sm-12">
						<div class="bg_white category_list">
						<span class="tag"><?php echo $ChooseCategory;?> :</span>
                        <span class="select_cat form-group">
                         <select name="category" id="category">
                          <option value="" selected="selected"><?php echo $select_Category; ?></option>
                        <?php
                        $categories = get_categories( array(
                        	        'hide_empty'   => 0,
                                    'orderby' => 'name',
                                    'order'   => 'ASC',
                                    'category__not_in' => array( '1' ),
                                ) );
                       if($categories){
                          foreach($categories as $item){?>
                                 <option value="<?php echo $item->term_id; ?>"><?php echo $item->name; ?></option>
                        <?php }
                       }
                        ?>
                        </select>
							 <i class="fa ddw"></i>
                             <span id="Msg" style="color:red; display:none;"><?php echo $ChooseCategory; ?></span>
							</span>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4">
						<div class="box">
							<div class="temp_box">
								<a href="javascript:void(0);" data-url="<?php echo get_permalink(87); ?>">
									<img class="onLoad" src="<?php bloginfo('template_url') ?>/assets/images/img_temp2.jpg" alt="img_template">
									<img class="onHover" src="<?php bloginfo('template_url') ?>/assets/images/img_temp1.jpg" alt="img_template">
								</a>
							</div>
							<h4><?php echo $ImageTemplate ; ?></h4>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box">
							<div class="temp_box">
								<a  href="javascript:void(0);" data-url="<?php echo get_permalink(91); ?>">
									<img class="onLoad" src="<?php bloginfo('template_url') ?>/assets/images/electro_tem2.jpg" alt="electronic_template">
									<img class="onHover" src="<?php bloginfo('template_url') ?>/assets/images/electro_tem1.jpg" alt="electronic_template">
								</a>
							</div>
							<h4><?php echo $ElectronicTemplate; ?></h4>
						</div>

					</div>
					<div class="col-md-4">
						<div class="box">
							<div class="temp_box">
								<a href="javascript:void(0);" data-url="<?php echo get_permalink(89); ?>">
									<img class="onLoad" src="<?php bloginfo('template_url') ?>/assets/images/small_temp2.jpg" alt="small_template">
									<img class="onHover" src="<?php bloginfo('template_url') ?>/assets/images/small_temp1.jpg" alt="small_template">
								</a>
							</div>
							<h4><?php echo $SmallBusinessTemplate; ?></h4>
						</div>
					</div>
				</div>
			</div>

		</div>	
	</section>



</div>	<!-- template wrapper ends here -->
<script>
$(document).ready(function(){
$('.temp_box a').click(function(){
if($('#category').val()==""){
$('#Msg').show();
return false;
}
else
{
$('#Msg').hide();
var url = $(this).attr('data-url'); 
var cartid = $('#category').val();
window.location.href = url+'?cartId='+cartid;
return false;
}

});
});

</script>
<?php get_footer();
