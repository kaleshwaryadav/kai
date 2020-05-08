<?php
session_start();
/*
 * Template Name: subscription plan
 */
?>


<?php
$plan_name = $_POST['plan_name'];
$price = $_POST['price']; 
$_SESSION['business_name'] = $_POST['business_template']; 
$_SESSION['plan_id'] = $_POST['plan_id']; 
$expiry =$_POST['choosen_plan'];
$date = strtotime("+$expiry day");
$_SESSION['p_expiry'] = date('Y-m-d',$date);

echo"<div style='text-align:center;'> Please wait, your order is being processed...</div>"; ?>
<body onLoad="document.form_paypal.submit();">
<form name="form_paypal"  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type='hidden' name='business' value='vikram@infoicon.co.in'>
    <input type="hidden" name="cmd" value="_xclick">
    <input type='hidden' name='item_name' value="<?php echo $plan_name; ?>">
    <input type='hidden' name='amount' value="<?php echo $price; ?>">
    <input type="hidden" name="rm" value="2" />
    <input type='hidden' name='currency_code' value='USD'>
    <input type='hidden' name='notify_url' value='<?php echo get_permalink(303); ?>'>
    <input type='hidden' name='cancel_return' value='<?php echo get_permalink(305); ?>'>
    <input type='hidden' name='return' value='<?php echo get_permalink(300); ?>'>
</form>


</body>

