<?php
/*
 * Template Name: Payment Report
 */

get_header(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } 
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $Filter ="Filter By (Month and Year)";
      $Search ="Search";
      $Month ="Month";
      $Ownerinfo ="Owner info";
      $AssetDetails ="Asset Details";
      $InvoiceDetails ="Invoice Details";
      $OutstandingBalance ="Outstanding Balance";
      $Pricereduction ="Price reduction";
      $InvoiceValueBrutto = "Invoice Value Brutto";
      $ThereofVAT ="Thereof VAT 19%";
      $InvoiceValueNetto ="Invoice Value Netto";
      $PaymentStatus ="Payment Status";
      $CreatedDate ="Created Date";
      $TotalAssets = "Total Assets";
      $TotalViews = "Total Views";
      $TotalClones = "Total Clones";
      $TotalShare ="Total Share";
      $TotalFavourites ="Total Favourites";
      $TotalReminder ="Total Reminder";
      $TotalURLCalls ="Total URL Calls";
      $TotalDownloads ="Total Downloads";
      $TotalReportCalls ="Total Report Calls";
      $TotalMessageSent ="Total Message Sent";
      $ViewDetails  = "View Details";
      $PayNow = "Pay Now";
      $TransactionDetails ="Transaction Details";
    }
    else
    {
      $Filter ="Filtern nach (Monat und Jahr)";
      $Search ="Suche";
      $Month ="Monat";
      $Ownerinfo ="Eigentümerinformation";
      $AssetDetails ="Asset-Details";
      $InvoiceDetails ="Rechnungs-Details";
      $OutstandingBalance ="Offener Betrag";
      $Pricereduction ="Preissenkung";
      $InvoiceValueBrutto = "Rechnungswert Brutto";
      $ThereofVAT ="Davon 19% Mehrwertsteuer";
      $InvoiceValueNetto ="Rechnungswert Netto";
      $PaymentStatus ="Zahlungsstatus";
      $CreatedDate ="Erstellungsdatum";
      $TotalAssets = "Gesamtvermögen";
      $TotalViews = "Gesamtansichten";
      $TotalClones = "Gesamtklone";
      $TotalShare ="Gesamtanteil";
      $TotalFavourites ="Favoriten insgesamt";
      $TotalReminder ="Gesamterinnerung";
      $TotalURLCalls ="URL-Aufrufe insgesamt";
      $TotalDownloads ="Downloads insgesamt";
      $TotalReportCalls ="Gesamtzahl der Berichte";
      $TotalMessageSent ="Gesendete Nachricht insgesamt";
      $ViewDetails  = "Details anzeigen";
      $PayNow = "Zahl jetzt";
      $TransactionDetails ="Transaktionsdetails";
    }

?>
<!-- main-body section starts here -->
<div class="template-wrapper extended">
	<section>
		<div class="container" style="width:1350px; margin:auto;">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
               
			</div>
          <?php $obj= new UserReports();
         $UserList = $obj->invoice_report_user();         
         $asset_user = get_userdata($user_id);
         $address =  get_user_meta($user_id,'address',true);
         $payment_mode = get_field('gateway_mode', 'option');
         if($payment_mode=="Test"){
            $paypal_url = get_field('test_url', 'option');
            $business_id = get_field('test_account_business_id', 'option');
         }
         else{
            $paypal_url = get_field('live_url', 'option');
            $business_id = get_field('business_id', 'option');
         }
         $successful_url = get_field('successful_payment_url', 'option');
         $failure_url = get_field('failure_payment_url', 'option');
       ?>

          <div id="dashboard-widgets-wrap">
            <div id="dashboard-widgets" class="metabox-holder">
            <div class="tableSec report-t2iwp">
            <?php
              $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $d = $datefilter[2];
              if(!empty($filterByDate)){              
              $fullm = date('M Y', strtotime($filterByDate));
              }
              else {
              $fullm = date('M Y');
              }
              $filter = array();
              $newdate = date("Y-m", strtotime("-1 months"));
              $filter_custom = date("Y-m", strtotime($y."-".$m));
              // echo "newdate~~~~~".$newdate;
              // echo "<br>";
              // echo "filter_custom~~~~~".$filter_custom;
              if($newdate>=$filter_custom)
              {
              if(!empty($filterByDate)){
               $filterData = UserReports::filter_by_month_year($y,$m,$user_id);
              }
              else {
                 $filterData = UserReports::frontend_report_of_user($user_id);
              }
              }
              ?>            
              <?php echo $Filter; ?>:
              <form action="" method="get" >
             <input type="month" id="month" name="filter" value="<?php echo $filterByDate; ?>">
             <input type="submit" value="<?php echo $Search; ?>">
            </form>
       <div class="month_filter" style="margin-bottom:10px; "><strong><?php echo $Month; ?>:</strong> <?php echo $fullm; ?> </div>
       <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">
         <thead>
           <tr>
             <!-- <th>Owner ID#</th> -->
             <th><?php echo $Ownerinfo; ?></th>
             <th><?php echo $AssetDetails; ?></th>
             <th><?php echo $InvoiceDetails; ?></th>             
             <th><?php echo $OutstandingBalance; ?></th>
             <th><?php echo $Pricereduction; ?></th>
             <th><?php echo $InvoiceValueBrutto; ?></th>
             <th><?php echo $ThereofVAT; ?></th>
             <th><?php echo $InvoiceValueNetto; ?></th>
             <th><?php echo $PaymentStatus; ?></th>
             <!-- <th>Generate Invoice / Requrest Payment</th> -->
             </tr>
         </thead>
        
             <tbody>
         <?php
              global  $current_user, $wpdb;
              $table_name = $wpdb->prefix . "montly_payment_report";
              //echo $fullm;
              if(!empty($filterByDate)){
               $sql = "SELECT * FROM $table_name where UserID='$user_id' and Month='$m' and Year='$y' order by YearMonth desc";
              }
              else{                
                $sql = "SELECT * FROM $table_name where UserID='$user_id' order by YearMonth desc";
              }
              //echo $sql;
              $result = $wpdb->get_results($sql);
              foreach( $result as $results ) {
                $owner_id = $results->UserID;
                $asset_user = get_userdata($owner_id);
                $user_displayname = $asset_user->user_firstname;
                $address =  get_user_meta($owner_id,'address',true);
                $total_asset = $results->TotalNoAssets;
                $invoiceID = $results->ID;
                $invoiceMonth = $results->Year."-".$results->Month;
                $invc_month = strtotime($invoiceMonth);
                //echo $invc_month;
                $convert_date = date('M Y', strtotime($invoiceMonth));
                $total_earning = $results->Total_Earning;
                $start_date = date('01-m-Y', strtotime($invoiceMonth));
                $end_date = date('t-m-Y', strtotime($invoiceMonth));
                $total_assets = $results->TotalNoAssets;
                $total_views = $results->Total_Views;
                $total_clone = $results->Total_Clones;
                $total_share = $results->Total_Shares;
                $total_favorits = $results->Total_Favorits;
                $total_reminder = $results->Total_Reminder;
                $total_url_calls = $results->Total_Url_Calls;
                $total_downloads = $results->Total_Downloads;
                $total_report_calls = $results->Total_Report_Calls;
                $total_message_sent = $results->Total_Message_Sent;
                $created_date = $results->Last_Fetch_Report_DateTime;
                $item_name = 'Invoice_#'.$invoiceID."_".$user_displayname."_".date('F Y', strtotime($invoiceMonth));
                //echo $item_name;
                ?>
                <tr>
                     <!-- <td><?php echo $owner_id; ?></td> -->
                     <td><?php echo $user_displayname; ?><br><?php echo $address; ?><br/>
                     <?php echo $CreatedDate; ?>: <?php echo $created_date; ?> 
                   </td>
                     <td>
                      <table>
                        <tr>
                          <td><?php echo $TotalAssets; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_assets; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalViews; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_views; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalClones; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_clone; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalShare; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_share; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalFavourites; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_favorits; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalReminder; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_reminder; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalURLCalls; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_url_calls; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalDownloads; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_downloads; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalReportCalls; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_report_calls; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $TotalMessageSent; ?></td>
                          <td>:</td>
                          <td style="text-align: right;"><?php echo $total_message_sent; ?></td>
                        </tr>
                        <tr>
                                                 
                          <td colspan="2" style="text-align: center;"><a class="payment_view_more" href="<?php echo site_url(); ?>/report/?filter=<?php echo $invoiceMonth;  ?>"><?php echo $ViewDetails ; ?></a></td>
                        </tr>
                      </table>                      
                     </td>                     
                     
                     <td><b>Invoice ID : #<?php echo $invoiceID; ?></b><br/>
                      <?php
                      $monthname = date('F Y', strtotime($invoiceMonth)); 
                      echo $monthname;?><br/>
                      <?php echo $start_date." to ".$end_date; ?></td>
                     <td style="text-align: center;"><?php echo round($total_earning,2); ?> €</td>
                     <td style="text-align: center;"><?php echo get_price_reduction_by_month($results->Month, $owner_id);?></td>
                     <td style="text-align: center;">
                      <?php                     
                      

                      $price_reduction = get_price_reduction_by_month($results->Month, $owner_id);
                      $price_reduction_type = substr($price_reduction, -1);
                      if($price_reduction_type=='%'){
                          $invoice_brutto = ($total_earning*$price_reduction)/100;
                          $final_brutto = $total_earning - $invoice_brutto;
                        }
                        else{
                          $final_brutto = $total_earning-$price_reduction;                          
                        }
                      echo round($final_brutto,2);
                      ?>
                     €</td>
                     <td style="text-align: center;">
                      <?php
                      //$after_vat = ($final_brutto*19)/100;
                      $after_vat = 19/119*$final_brutto;
                      echo round($after_vat,2);
                      ?>

                     €</td>
                     <td style="text-align: center;"><?php
                      $final_payment_amount = $final_brutto - $after_vat;                      
                      $f_amount = round($final_payment_amount,2);
                      echo $f_amount;
                      ?> €</td>
                     <!-- <td><?php echo $results->Payment_Status ?></td> -->
                     <td style="text-align: center;"><?php if($results->Payment_Status==NULL){
                        $f_amount = round($final_payment_amount,0);
                          ?>                      
                          <form action="<?php echo $paypal_url; ?>" method="post" target="_blank">
                          <!-- Identify your business so that you can collect the payments. -->
                          <input type="hidden" name="business" value="<?php echo $business_id; ?>">        
                          <!-- Specify a Buy Now button. -->
                          <input type="hidden" name="cmd" value="_xclick">        
                          <!-- Specify details about the item that buyers will purchase. -->
                          <input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
                          <input type="hidden" name="item_number" value="<?php echo $invoiceID; ?>">
                          <input type="hidden" name="amount" value="<?php echo $f_amount; ?>">
                          <input type="hidden" name="currency_code" value="EUR">        
                          <input type="hidden" name="rm" value="2" />      
                          <!-- Specify URLs -->
                          <input type='hidden' name='cancel_return' value='<?php echo $failure_url; ?>'>
                          <input type='hidden' name='return' value='<?php echo $successful_url; ?>'>   
                          <input name="tax" type="hidden" value="<?php echo round($after_vat,2); ?>">        
                          <!-- Display the payment button. -->
                          <input class="paypal_paynow_btn" type="submit" name="submit" value="<?php echo $PayNow; ?>">
                          </form>

                      


                      <?php } else if( $results->Payment_Status != NULL ){
                          if( $results->Payment_Status == "Completed"){
                            $style = 'background: #8bc34a;';
                          }
                          if( $results->Payment_Status == "Pending"){
                            $style = 'background: #e39435;';
                          }
                          if( $results->Payment_Status == "Processing"){
                            $style = 'background: #e39435;';
                          }
                          if( $results->Payment_Status == "Declined"){
                            $style = 'background: #de3636;';
                          }
                      ?>
                        <span class="status-complete" style="<?php echo $style; ?>"><?php echo $results->Payment_Status; ?></span>                        
                        <a href="<?php echo site_url()."/transaction-details/?invoice_id=$invoiceID&userid=$owner_id" ?>" class="paypal_transaction_btn"><?php echo $TransactionDetails; ?></a>
                      <?php }?>                        
                    </td>
                  </tr>
                  <?php 
              }
              ?>
       
        <?php if(count($filterData)==0){ ?>
        <div style='color:red; text-align:center; margin-top:20px;'>Sorry no records found!</div>
        <?php } ?>
         </tbody>
            </table>
     </div>

   </div>
 </div>
  </div>	
  </section>
  </div>	<!-- template wrapper ends here -->
<?php get_footer(); ?>
