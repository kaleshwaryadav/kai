/*
* Site Script
*/
( function(){
	var ajaxUrl = siteObj.ajaxUrl;
	var textdomain = siteObj.textdomain
	// alert(ajaxUrl);
	var T2i_Site_Script={		
		init: function(){
/*
			jQuery('#email, #alternateemail').on('keypress, blur', function() {

				if( jQuery(this).val() != '' ){
				    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
				    if(!re) {
				        jQuery('#error').fadeIn();
				        jQuery('#profile').attr("disabled","disabled");
				        setTimeout(function(){
				        	jQuery('#error').fadeOut();
				        },3000)
				    } else {
				        jQuery('#error').fadeOut();
				        jQuery('#profile').removeAttr("disabled");
				    }
				}
			});*/

			// slider on assets single page
			if ( document.getElementById("form_phone") !== null ) {
				document.getElementById("form_phone").addEventListener("blur", this.validatePhoneNumberFunc);
			}

			if ( document.getElementById("image-gallery") !== null ) {
				this.singleAssetsLightSliderFunc();
			}

			// Restrict input to digits and '.' by using a regular expression filter.
			/*if ( document.getElementById("temp_price") !== null ) {
				this.setInputFilterFunc(document.getElementById("temp_price"), function(value) {
				  return /^\d*\,?\d*$/.test(value);
				});
			}*/
			
			// assets change status
			if ( document.querySelectorAll(".publish-assert-js") !== null ) {
				var highlightedItems = document.querySelectorAll(".publish-assert-js");
				for (var i = 0; i < highlightedItems.length; i++) {
				  // console.log('highlightedItems[i]: ', highlightedItems[i]);
				  highlightedItems[i].addEventListener("click", this.changePublishStatusFunc);
				}
			}


			// slider on assets single page
			// if ( document.getElementById("UserAccessLevel") !== null ) {
			// 	document.getElementById("UserAccessLevel").addEventListener("submit", this.singleAssetsUserMoreDetails);
			// }
		},

		/*
		* Function assets change status
		*/
		validatePhoneNumberFunc: function(){
			var mobNum = jQuery(this).val();
			var filter = /^\d*(?:\.\d{1,2})?$/;

		    if (!filter.test(mobNum)) {
		    	 // alert('Not a valid number');
              jQuery(".btn-submitmessage .profile-update-button").attr("disabled",  "disabled");
              jQuery(this).parent().addClass("has-error has-danger");
              jQuery(this).next().attr("data-error","Not a valid number");
              jQuery(this).next().next().html('<ul class="list-unstyled"><li>Not a valid number.</li></ul>');
              return false;
		    /*if (filter.test(mobNum)) {
	            if(mobNum.length==10){
	              jQuery(".btn-submitmessage .profile-update-button").removeAttr("disabled");
	              jQuery(this).parent().removeClass("has-error has-danger");
	              jQuery(this).next().attr("data-error","");
	              jQuery(this).next().next().html('');
	            } else {
	                // alert('Please put 10  digit mobile number');
	              jQuery(".btn-submitmessage .profile-update-button").attr("disabled",  "disabled");
	              jQuery(this).parent().addClass("has-error has-danger");
	              jQuery(this).next().attr("data-error","Please put 10  digit mobile number");
	              jQuery(this).next().next().html('<ul class="list-unstyled"><li>Please put 10  digit mobile number.</li></ul>');
	                return false;
	            }
            }else {
              // alert('Not a valid number');
              jQuery(".btn-submitmessage .profile-update-button").attr("disabled",  "disabled");
              jQuery(this).parent().addClass("has-error has-danger");
              jQuery(this).next().attr("data-error","Not a valid number");
              jQuery(this).next().next().html('<ul class="list-unstyled"><li>Not a valid number.</li></ul>');
              return false;
           	}*/
           }
		},

		/*
		* Function assets change status
		*/
		changePublishStatusFunc: function(){
			var postid = jQuery(this).attr("data-postid");
			var eleID = jQuery(this).attr("data-id");
			// alert( jQuery(this).addClass("kushal") );
			jQuery.ajax({            
		        type: 'POST',
		        dataType: 'json',
		        url: ajaxUrl,
		        data: { 
		        'action':'publish_assert', 
		        'postID': postid, 
		         },
		        success: function (response) {
					jQuery('#asset_id_'+eleID).attr("data-status",response.data.current_status);
		        	jQuery('#alertBox .alerMsg').html(response.data.message);
		        	jQuery('#alertBox').modal("show");
		        	jQuery('#alertBox button').click(function(){
		        		location.reload();
		        	})
		        }
		    });
		    return false; 
		},	

		/*
		* Function restrict input to digits and '.' by using a regular expression filter.
		*/
		/*setInputFilterFunc: function(textbox, inputFilter) {
		  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
		    textbox.addEventListener(event, function() {
		      if (inputFilter(this.value)) {
		        this.oldValue = this.value;
		        this.oldSelectionStart = this.selectionStart;
		        this.oldSelectionEnd = this.selectionEnd;
		      } else if (this.hasOwnProperty("oldValue")) {
		        this.value = this.oldValue;
		        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
		      }
		    });
		  });
		},*/

		/*
		* Function restrict input to digits and '.' by using a regular expression filter.
		*/
		singleAssetsLightSliderFunc: function() {
		 	jQuery('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:4,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    jQuery('#image-gallery').removeClass('cS-hidden');
                }  
            });
		},

		/*
		* Function single asset more detail form submit
		*/
		singleAssetsUserMoreDetails: function(e) {
			e.preventDefault();
			// alert(jQuery('#owner_priv').val());
		 	jQuery('.private_acesslevel').text('Processing..');
		 	if( jQuery('#user_owner').val() == '' ){
		 		jQuery('.status').html('<p style="color:red;">Please enter "User Owner" message</p>');
		 		 jQuery('.status').show();
		        jQuery('.private_acesslevel').text('Save');
		 		// e.preventDefault();
		 	}
		 	/*if( jQuery('#owner_priv').val() == '' ){
		 		jQuery('.status').show();
		 		jQuery('.status').html('<p style="color:red;">Please enter "Owner Private" message</p>');
		 		e.preventDefault();
		 	}*/
		 	else{
				jQuery.ajax({          
			        type: 'POST',
			        dataType: 'json',
			        url: theme_ajax.url,
			        data: jQuery(this).serialize(),
			        success: function (response) {
				        jQuery('.private_acesslevel').text('Save');
				        if (response.status == "Success"){
				        	jQuery('.status').show();
					        jQuery('.status').html(response.message);
				        }
			        }
				});
		 	}
			setTimeout(function(){// wait for 5 secs(2)
	        jQuery('.status').hide();
	        jQuery('.private_acesslevel').text('Save');
	        }, 2000);
		},

	};
T2i_Site_Script.init();
})(jQuery);