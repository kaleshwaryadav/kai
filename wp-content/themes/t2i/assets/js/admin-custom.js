function get_post_order(order){
jQuery("#pageNumber").val(2);
jQuery("#ppp").val(4);
jQuery('#loading_img').show();
if(order=='a'){
jQuery('.leftOne').addClass('active');
jQuery('.rightOne').removeClass('active');
}
else{
jQuery('.leftOne').removeClass('active');
jQuery('.rightOne').addClass('active');
}
jQuery.ajax({
type: "post",
url: theme_ajax.url,
data: {action:'fetch_post_sapienum', order:order},
success: function (data) {
jQuery('#post_list_data').html(data);
jQuery('#loading_img').hide();

}
});

}