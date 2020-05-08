<?php
/*
 * Template Name: Payment Cancel
 */

get_header();
?>
<style type="text/css">
	/*--thank you pop starts here--*/
.thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
	font-size: 25px;
    margin-bottom: 40px;
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
}
.thank-you-pop a{
	display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
	margin-right:5px;
	color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
/*--thank you pop ends here--*/
</style>

<div class="template-wrapper">
<section>
	<div class="container">
	    <div class="row">
	        <div class="" id="ignismyModal">
	            <div class="modal-dialog">
	                <div class="modal-content">                   
	                    <div class="modal-body">
	                       
							<div class="thank-you-pop">
								<!-- <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt=""> -->
								<h1>Sorry !</h1>
								<!-- <div style='text-align:center; color:red;'>Sorry ! Transaction failed , try once again </div> -->
								<h3 class="cupon-pop"><span style='text-align:center; color:red;'>Sorry ! Transaction failed , try once again</span></h3>
								
	 						</div>
	                         
	                    </div>
						
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
        <div class="container">
            <div class="breadcrumb">
              
            </div>
        
 </div>
 </section>
</div>
 <?php get_footer();?>



