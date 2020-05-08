(function($) {
    // When the DOM is ready.
    $(function() {
        var file_frame; // variable for the wp.media file_frame

        // attach a click event (or whatever you want) to some element on your page
        $( '#frontend-button' ).on( 'click', function( event ) {
            event.preventDefault();
            // if the file_frame has already been created, just reuse it
            if ( file_frame ) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media({
                title: $( this ).data( 'uploader_title' ),
                button: {
                    text: $( this ).data( 'uploader_button_text' ),
                },
                multiple: false // set this to true for multiple file selection
            });

            file_frame.on( 'select', function() {
                attachment = file_frame.state().get('selection').first().toJSON();
                imgWidth = attachment.width;
                imgHeight = attachment.width;

                if( imgWidth < 1200 || imgHeight < 630 ){  // Restrict image upload size width & height minimum (1200x630) for sharing purpose
                    alert("Please upload minimum 1200x630 dimension");
                    // console.log(attachment.height);
                    // console.log(attachment.height);
                    return;
                }
                //console.log(attachment);
                $( '#featured_image_id' ).val(attachment.id);
                // do something with the file here
                $( '#placeholder-img' ).css('visibility','hidden');
                $( '#frontend-image' ).attr('src', attachment.url);
                $( '.uploader-main' ).css('background-image',"url("+ attachment.url +")");
            });

            file_frame.open();
        });
    });


        $(function() {
        var product_gallery_frame; // variable for the wp.media product_gallery_frame

        // attach a click event (or whatever you want) to some element on your page
        $( '.add-product-images' ).on( 'click', function( event ) {
            event.preventDefault();

            // if the product_gallery_frame has already been created, just reuse it
            if ( product_gallery_frame ) {
                product_gallery_frame.open();
                return;
            }

            product_gallery_frame = wp.media.frames.product_gallery_frame = wp.media({
                title: $( this ).data( 'uploader_title' ),
                button: {
                    text: "ADD TO GALLERY",
                },
                multiple: true // set this to true for multiple file selection
            });

            product_gallery_frame.on( 'select', function() {
                 selection = product_gallery_frame.state().get('selection');
                        selection.map( function( attachment ) {
                            attachment = attachment.toJSON();
                            if ( attachment.id ) {
                                attachment_ids = [];
                                $('<li class="image" data-attachment_id="' + attachment.id + '">\
                                        <img src="' + attachment.url + '" />\
                                        <span class="action-delete" onclick="testCall(this,'+attachment.id+')">&times;</span>\
                                    </li>').insertBefore('li.add-image');
                                $('#thumbnail-gallery ul li.image').css('cursor','default').each(function() {
                                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                                    attachment_ids.push( attachment_id );
                                });
                            }
                        } );
                        $('#thumbnail-gallery #product_image_gallery').val( attachment_ids.join(',') );
                    });

            product_gallery_frame.open();
        });
    });
})(jQuery);

function testCall(e, id) {
    attachment_ids = [];
    jQuery(e).parent('li.image').remove();
    //var attachment_id = jQuery('.image').attr( 'data-attachment_id' );
    jQuery('#thumbnail-gallery .image').each(function () {
        var attachment_id=$(this).attr("data-attachment_id");
        attachment_ids.push( attachment_id );
    });
    $('#thumbnail-gallery #product_image_gallery').val(attachment_ids);
}