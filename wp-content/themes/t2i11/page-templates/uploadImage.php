<?php
/*
 * Template Name: upload image
 */

get_header(); ?>
<form method="POST" id="upload">
<input type="hidden" name="action" value="upload_image">
<input type="file" name="image" value="">
<input type="submit" value="upload">
</form>
<script type="text/javascript">
// $('#upload').validate({ // initialize the plugin
      
//         rules: {         
              
//         },
//         messages: {   
        
//     },
//         submitHandler: function (form) {   
//            alert("kkkks");
//             $.ajax({            
//             type: "POST", 
//             action : "upload_image",
//             url: theme_ajax.url,
//             data: new FormData(this),
//             contentType: false,
//             cache: false,
//             processData:false, 
//             success: function (response) {
//             alert(response);
//             },
//             error: function (responseData) {
//                 console.log('Ajax request not recieved!');
//             }
//         });
//         return false;
//         }
//     });
$('#upload').submit(function() {
     $.ajax({            
            type: "POST", 
            action : "upload_image",
            url: theme_ajax.url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false, 
            success: function (response) {
            alert(response);
            },
            error: function (responseData) {
                console.log('Ajax request not recieved!');
            }
        });
     return false;

});
</script>
<?php get_footer();
