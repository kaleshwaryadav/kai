 $('document').ready(function(){ 	

  $("ul.headerUL li a").click(function(){ 					 /*To change nav images on active state*/
   $("ul.headerUL li a").removeClass("toggleClass");
   $(this).addClass("toggleClass");
 });


  /* jQuery(function($){
    var fileDiv = document.getElementById("upload");
    var fileInput = document.getElementById("upload-image");
    console.log(fileInput);
    fileInput.addEventListener("change",function(e){
      var files = this.files
      showThumbnail(files)
    },false)

    fileDiv.addEventListener("click",function(e){
      $(fileInput).show().focus().click().hide();
      e.preventDefault();
    },false)

    fileDiv.addEventListener("dragenter",function(e){
      e.stopPropagation();
      e.preventDefault();
    },false);

    fileDiv.addEventListener("dragover",function(e){
      e.stopPropagation();
      e.preventDefault();
    },false);

    fileDiv.addEventListener("drop",function(e){
      e.stopPropagation();
      e.preventDefault();

      var dt = e.dataTransfer;
      var files = dt.files;

      showThumbnail(files)
    },false);

    function showThumbnail(files){
      for(var i=0;i<files.length;i++){
        var file = files[i]
        var imageType = /image.* /
        if(!file.type.match(imageType)){
          console.log("Not an Image");
          continue;
        }

        var image = document.createElement("img");
    // image.classList.add("")
    var thumbnail = document.getElementById("thumbnail");
    image.file = file;
    thumbnail.appendChild(image)

    var reader = new FileReader()
    reader.onload = (function(aImg){
      return function(e){
        aImg.src = e.target.result;
      };
    }(image))
    var ret = reader.readAsDataURL(file);
    var canvas = document.createElement("canvas");
    ctx = canvas.getContext("2d");
    image.onload= function(){
      ctx.drawImage(image,100,100)
    }
  }
}
});
  */
});

 $(document).ready(function() {

  $('.menu-hauptmenue-container').addClass('menu-top-menu-container');

  $('.group .form-control').blur(function() {

    // check if the input has any value (if we've typed into it)
    if ($(this).val())
      $(this).addClass('used');
    else
      $(this).removeClass('used');
  });

});


$(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    $('#message-form').validator();

    $('#message-form').on('submit', function (e) {

        //console.log($("#message-form").serialize());

         // var letters =  /^[0-9 \s\.!\?\"\/ -""\-"]+$/
         //  var inputtxt = $('#form_phone').val();
         //  if(inputtxt==""){
         //   return false; 
         //  }
         //  else if(inputtxt.match(letters))
         //  {
         //  return true;
         //  }
         //  else {
         //   alert('Phone number will be number only!');
         //   return false;
         //  }
      
        if (!e.isDefaultPrevented()) {   
          $('.profile-update-button').val('Processing..');
                  
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: theme_ajax.url,
                data: $("#message-form").serialize(),
                success: function (data) {
                     var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#message-form').find('.messages').html(alertBox);
                        $('#message-form')[0].reset();
                        grecaptcha.reset();
                    }
                    $('.profile-update-button').val('Send message');
                }                

            });
            return false;
        }
    });

    $("input#temp_price").on({
        keyup: function() {
          formatCurrency($(this));
        },
        blur: function() { 
          formatCurrency($(this), "blur");
        }
    });
});


function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "")
}


function formatCurrency(input, blur) {  
    // get input value
    var input_val = input.val();
      
    // don't validate empty input
    if (input_val === "") { return; }
      
    // original length
    var original_len = input_val.length;
    
    // initial caret position 
    var caret_pos = input.prop("selectionStart");
        
    // check for decimal
    if (input_val.indexOf(",") >= 0) {
    
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");
    
        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
    
        // add commas to left side of number
        left_side = formatNumber(left_side);
    
        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
        right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);
    
        // join number by .
        // input_val = "$" + left_side + "." + right_side;
        input_val = left_side + "," + right_side;
    
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        // input_val = "$" + input_val;
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
        input_val += ",00";
        }
    }
      
    // send updated string to input
    input.val(input_val);
    
    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}