jQuery(document).ready(function($) {
    /*Login user screen*/
    if(getLangCode == 'en')
    {
        var user_mess = 'Please enter a userName';
        var pass_mess = 'Please enter a password';
        var name_mess = 'Please Enter Your Name';
        var email_mess = 'Please enter a email address';
        var email_valid = 'Please enter a valid email address';
        var password = 'Please enter a password';
        var conf_pass = 'Please enter a confirm password';
        var pass_min_len = 'Your password must be at least 8 characters long';
        var not_match = 'Password and confirm password are not same';
        var result = 'Thanks for registration check your inbox!';
        conf_mess = 'Do you really want to remove this asset from your favorits?';
        var temlate_field_msg ="This field is required.";

    }
    else
    {
        var user_mess = 'Bitte geben Sie einen Benutzernamen ein';
        var pass_mess = 'Bitte Passwort eingeben';
        var name_mess = 'Bitte geben Sie Ihren Namen ein';
        var email_mess = 'Bitte geben Sie eine E-Mail-Adresse ein';
        var email_valid = 'Bitte geben Sie eine gültige E-Mail-Adresse ein';
        var password = 'Bitte Passwort eingeben';
        var conf_pass = 'Bitte geben Sie ein Bestätigungs-Passwort ein';
        var pass_min_len = 'Ihr Passwort muss mindestens 8 Zeichen lang sein';
        var not_match = 'Passwort und Passwort bestätigen sind nicht gleich';
        var result = 'Vielen Dank für die Registrierung, überprüfen Sie Ihren Posteingang!';
        conf_mess = 'Möchten Sie dieses Asset wirklich aus Ihren Favoriten entfernen?';
        var temlate_field_msg ="Dieses Feld wird benötigt";
    }

 $('#rsUserLoginform').validate({ // initialize the plugin
      
        rules: {         
            username: {
                required: true,                
            },            
              password: {
        required: true,
      }
        },
        messages: {     
        username: {
        required: user_mess,
      },      
      password: {
        required:pass_mess
      }
    },
        submitHandler: function (form) {
            $('#submit').val('Loading..');
            var redirect_page_url= $('#redirect_page_url').val(); 
            $.ajax({            
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('#username').val(), 
                'password': $('#password').val(), 
                'captcha_code':$('#captcha_code').val(),
                 },
                success: function (data) {
                console.log(data);
                $('.status').addClass(data.class);
                $('#submit').val('Log In'); 
                $('.status').text(data.message);
                $('html, body').animate({scrollTop: '0px'}, 900);
                if (data.loggedin == true){
                 document.location.href = redirect_page_url;
                }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

       /*user registration user screen*/
       $('#rsUserRegistration').validate({ // initialize the plugin
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true,
                email:true,
            },
              user_password: {
        required: true,      
      },
      user_confrm_password: {
        required: true,
        minlength: 8,
        equalTo: "#user_password",
      },
      iagree:{
        required: true,
      },
      
        },
        messages: {
      username: name_mess,
      email: {
        required: email_mess,
        minlength: email_valid
      },
      user_password: {
        required: password,
        minlength: pass_min_len
      },
      user_confrm_password: {
        required: conf_pass,
        minlength:pass_min_len,
        equalTo:not_match
      }
    },
        submitHandler: function (form) {
         if(document.getElementById('iagree').checked==false){
             document.getElementById('erro_validation').style.display='block';
            return false
          }
            $('#signup').val('Loading..');
            $.ajax({            
                type: "POST", 
                action : "user_registration",
                url: theme_ajax.url,
                data: $(form).serialize(), 
                success: function (responseData) {
                  $('#signup').val('Sign up');
                  $('html, body').animate({scrollTop: '0px'}, 800);
  
                  if(responseData==1){
                    $('#username,#email,#user_password,#user_confrm_password,#captcha_code').val('');
                    $('#iagree').val('');
                     // window.setTimeout(function(){location.reload()},2000);
                     //document.getElementById("#rsUserRegistration").reset();
                     $('.status').html("<p class='sucess'>Thanks for registration check your inbox!</p>");
                  }
                  else {
                   $('.status').html(responseData); 
                  }
                   
                  
                },
                error: function (responseData) {
                    console.log('Ajax request not recieved!');
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

/*create assert image template assert*/
 $('#template-submit-form').validate({ // initialize the plugin
      
        rules: {         
            temp_title: {
                required: true,                
            },
            asset_name: {
                required: true,                
            },
            short_desc: {
                required: true,                
            }, 
          temp_price: {
        required: true,
      }

        },
        messages: {   
        temp_title :temlate_field_msg,
        asset_name :temlate_field_msg,
        short_desc :temlate_field_msg,
        temp_price :temlate_field_msg,
    },
        submitHandler: function (form) {   
            var redirect_page_url= $('#redirect_page_url').val();
            var assertID = $('#category_name').val();
            $('#loading-image').show();  
            $.ajax({            
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (data) {
                if (data.status == "Success" && data.post_status == "Publish"){
                    $('#temp_price').val("");
                    $('.post_status').html(data.message);
                    $('#loading-image').hide(); 
                }
                else {
                    $('#temp_price').val("");
                    $('.post_status').html(data.message);
                    $('#loading-image').hide(); 
                }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

 /*create assert image template assert*/
 $('#tectnical-template').validate({ // initialize the plugin
      
        rules: {         
            temp_title: {
                required: true,                
            },
            asset_name: {
                required: true,                
            },
            short_desc: {
                required: true,                
            },  
        },
        messages: { 
        temp_title :temlate_field_msg,
        asset_name :temlate_field_msg, 
        short_desc :temlate_field_msg,
        },
        submitHandler: function (form) {   
            var redirect_page_url= $('#redirect_page_url').val();
            var assertID = $('#category_name').val();
            $('#loading-image').show();  
            $.ajax({            
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (data) {
                    console.log(data);
                if (data.status == "Success"){
                    $('#temp_price').val("");
                    $('.post_status').html(data.message);
                    //document.getElementById("tectnical-template").reset();
                    $('#loading-image').hide(); 
                }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

 /*create assert image template assert*/
 $('#small-template111').validate({ // initialize the plugin
      
        rules: {         
            temp_title: {
                required: true,                
            },
            asset_name: {
                required: true,                
            },
            short_desc: {
                required: true,                
            },  
        },
        messages: {   
        temp_title :temlate_field_msg,
        asset_name :temlate_field_msg,
        short_desc :temlate_field_msg,
    },
        submitHandler: function (form) {   

            var redirect_page_url= $('#redirect_page_url').val();
            var assertID = $('#category_name').val();
            $('#loading-image').show();  
            $.ajax({            
                type: 'POST',
                dataType: 'html',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (data) {
                if (data.status == "Success"){
                    $('#loading-image').hide();
                    $('.post_status').html(data.message);
                    
                    }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

 /* Send message to super admin */
 $('#admin_msg').validate({ // initialize the plugin
        rules: {         
            email: {
                required: true,                
            },
            subject: {
                required: true,                
            },
            message: {
                required: true,                
            },  
        },
        messages: {   
        
    },
        submitHandler: function (form){ 
            $('.contact_query').text('Sending..'); 
            $.ajax({          
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (response) {
                  $('.msg_status').addClass(response.class);
                  if (response.status == "Success"){
                  $('.msg_status').html(response.message);
                  $('.contact_query').text('send');
                 }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });


// var googleResponse = jQuery('#g-recaptcha-response').val();
// if (!googleResponse) {
//     $('<p style="color:red !important" class=error-captcha"><span class="glyphicon glyphicon-remove " ></span> Please fill up the captcha.</p>" ').insertAfter("#html_element");
//     return false;
// } else {            
//     return true;
// }
/* Send message to assert owner */
 $('#sendMSG').validate({ // initialize the plugin
        rules: {         
            u_name: {
                required: true,                
            },
            m_number: {
                required: true,                
            },
            email: {
                required: true,                
            },  
            address: {
                required: true,                
            },
            message: {
                required: true,                
            },
        },
        messages: {   
        
    },
        submitHandler: function (form){ 
            $('.msgassert').text('Sending..');
            $('.msg_status').show();
            $.ajax({          
                type: "POST",
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (response) {
                document.getElementById("sendMSG").reset();
                $('.msg_status').addClass(response.class);
                $('.msg_status').attr('style="position:relative; top:-10px;"');
                if (response.status == "Success"){
                $('.msg_status').html(response.message);
                $('.msgassert').text('send');
                setTimeout(function(){// wait for 5 secs(2)
                $('.msg_status').hide();   
                     }, 4000);
                }
               }
            });
            return false; // blocks redirect after submission via ajax
        }
    });


 /* Send reminder */
 $('#set_remainder').validate({ // initialize the plugin
        rules: {         
            message: {
                required: true,                
            },
            remainder_date: {
                required: true,                
            },
            rmdays: {
                required: true,                
            },  
        },
        messages: {   
        
    },
        submitHandler: function (form){ 
          $('.reminder').text('Proccessing..');
           $.ajax({          
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (response) {
                console.log(response);
                document.getElementById("set_remainder").reset();
                setTimeout(function(){// wait for 5 secs(2)
                  $('.status, error').hide();
                  }, 5000);  
                  $('.reminder').text('Save');
                  $('.reminderMsg').show();
                  $('.reminderMsg').addClass(response.class);
                  if (response.status == "Success"){
                  $('.reminderMsg').html(response.message);
                 }
                 else{
                  $('.reminderMsg').html(response.message);
                 }

                 
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

 /* Send reminder */
 $('#update_remainder').validate({ // initialize the plugin
        rules: {         
            message: {
                required: true,                
            },
            remainder_date: {
                required: true,                
            },
            
        },
        messages: {   
        
    },
        submitHandler: function (form){ 
           $.ajax({          
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (data) {
                $('.reminderMsg').html(data.message);
                $('.reminderMsg').show();
                $('.reminderMsg').addClass(data.class);
                if (data.status == "Success"){
                 $('.reminderMsg').html(data.message);
                  setTimeout(function(){// wait for 5 secs(2)
                  location.reload();
                  }, 5000);

                }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

 /* share with social api */
 $('#shareemail').validate({ // initialize the plugin
        rules: {         
            email_assert: {
                required: true,                
            },
            msg_assert: {
                required: true,                
            },
        },
        messages: {   
        
     },
        submitHandler: function (form){ 
     
          $('.shareassert').text('Sending..');
           $.ajax({          
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (response) {
                $('.shareassert').text('submit');
                document.getElementById("shareemail").reset();
                if(response==1){
                $('.status').html("You have done successfully");
                }
               console.log(response);
                 
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

   $('.track_link').click(function(){
      $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'track_clickedLink', //calls wp_ajax_nopriv_ajaxlogin
        'post_id': $(this).attr('data-postid'),
        'userid' : $(this).attr('data-userid'), 
        'template_id':$(this).attr('data-tempid'),
        'category_id':$(this).attr('data-catid'),
         },
         success: function (res) {
          }
        });
      });

   $('.download_asset').click(function(){
      $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'download_asset', //calls wp_ajax_nopriv_ajaxlogin
        'post_id': $(this).attr('data-postid'),
        'userid' : $(this).attr('data-userid'), 
        'template_id':$(this).attr('data-tempid'),
        'category_id':$(this).attr('data-catid'),
         },
         success: function (res) {
          }
        });
      });

});


function plan_subscription(e){
    $('.btn_black', e).val('Processing...');  
            $.ajax({            
                type: 'POST',
                dataType: 'json',
                url: theme_ajax.url,
                data: $(e).serialize(),
                success: function (data) {
                if (data.status == "Success"){
                    console.log(data);
                 $('.plan_status').html(data.message);
                 $('.plan_status').show();
                 $('html, body').animate({scrollTop: '1000px'}, 200);
                 $('.btn_black').val('Select this model'); 
                 $('.btn_black', e).val('Plan Purchaged'); 
                 $('.btn_black').removeAttr("disabled","disabled");
                 $('.btn_black', e).attr('disabled','disabled');
                 $('.btn_black', e).attr('disabled','disabled');
                 $('#is_active').val(0);
                 $('.custom-bt').show();
                 $('.not_plan_purchaged').hide();
                 $('.plan_error').hide();
                 
                   // location.reload();
                 $('.plan_status').hide(); // then reload the page.(3)
                  
                 }
               }
            });          
     return false;

}


function favorite_like(postid,template_id,category_id){
    console.log("postid~~~~~ "+postid);
    console.log("template_id~~~~~ "+template_id);
    console.log("category_id~~~~~ "+category_id);

    // return false;
    $('.favorite').text("Adding...");
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'add_favorite', //calls wp_ajax_nopriv_ajaxlogin
        'favorit_id': postid, 
        'template_id': template_id,
        'category_id': category_id, 
         },
         success: function (res) {
         $('.favorite').text("Un-favorite");
         $('.favorite_unfavorite').html(res);
         }
        });
        return false; // blocks redirect after submission via ajax
}

function unfavorite_like(postid){
    $('.favorite').text("Adding...");
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'unfavorite_like', //calls wp_ajax_nopriv_ajaxlogin
        'favorit_id': postid, 
         },
         success: function (res) {
         $('.favorite').text("Add to favorite");
          $('.favorite_unfavorite').html(res);
         }
        });
        return false; // blocks redirect after submission via ajax
}

function asset_favorite(e,postid){
   $(e).text("Adding...");
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'asset_favorite', //calls wp_ajax_nopriv_ajaxlogin
        'favorit_id': postid, 
         },
         success: function (res) {
         console.log(res);
         $(e).text("Un-favorite");
         $('.feedbackfavorite'+postid).html(res);
         }
        });
        return false; // blocks redirect after submission via ajax
}

function asset_unfavorite(e,postid){
       // $(e).text("Deleting...");
       if(confirm("Do you realy want to remove this asset frmo your favorits?")){
       $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'asset_unfavorite', //calls wp_ajax_nopriv_ajaxlogin
        'favorit_id': postid, 
         },
         success: function (res) {
          location.reload();
         }
        });
        return false; // blocks redirect after submission via ajax
    }
}

function delete_favorite(postid){
     $('#bol').show();
     $('#loaderjob').show();
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'delete_favorite', //calls wp_ajax_nopriv_ajaxlogin
        'favorit_id': postid, 
         },
         success: function (res) {
         $('#bol').hide();
         $('#loaderjob').hide();
         location.reload();
         }
         });
        return false; // blocks redirect after submission via ajax
}

function delete_reminder(e,postid){
    $(e).text('Processing..');
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'delete_reminder', //calls wp_ajax_nopriv_ajaxlogin
        'reminder_id': postid, 
         },
         success: function (res) {
         location.reload();
         }
         });
        return false; // blocks redirect after submission via ajax
}

function add_click(postid,template_id,category_id){
     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'ads_per_template', //calls wp_ajax_nopriv_ajaxlogin
        'post_id': postid,
        'template_id': template_id,
        'category_id': category_id, 
         },
         success: function (res) {
          // alert(res);
         // location.reload();
         }
         });
    return false; 
   }

function report_click(postid,template_id,category_id){

     $.ajax({            
        type: 'POST',
        dataType: 'html',
        url: theme_ajax.url,
        data: { 
        'action': 'report_per_template', //calls wp_ajax_nopriv_ajaxlogin
        'post_id': postid,
        'template_id': template_id,
        'category_id': category_id, 
         },
         success: function (res) {
         // alert(res);
         // location.reload();
         }
         });
    return false;
}

