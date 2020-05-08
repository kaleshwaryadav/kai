<style>
.postboxheight{
 height: 376px;
}
.wp-admin #dashboard_right_now li{width: 100%;}
.wp-admin #dashboard_right_now li a{float: right;width: 75px;}
.aDviewAll{width: 100%;float: left;text-align: center;margin-top:5px;text-transform: uppercase;padding: 5px;box-sizing: border-box;-webkit-box-sizing: border-box;}
</style>
<?php $obj= new UserReports(); ?>
<div class="container" style="width:1350px; margin:auto;">
    <div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
    <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>T2I intern- Overall Usage Report</span></h2>
             <div class="inside">
                <div class="main">
                <ul>
                  <li>1) Amount of users Active <a href="javascript:void(0);"><?php echo count($obj->ActiveUsers()); ?></a></li>
                  <li>2) Amount of new user per month <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=userpermonth">View</a></li>
                </ul>
    
                </div>
             </div>
          </div>
       </div>
    </div>
    <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>T2I intern-Template report</span></h2>
             <div class="inside">
                <div class="main">
                 <?php $TemplateList = get_terms( 'asset-detail', array(
                    'hide_empty' => false,
                    ) );
                   ?>
                   <ul>
                     <li>1) Amount of Template <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=totalamt_tmp"><?php echo count($TemplateList); ?> View</a></li>
                      <li>2) Amount of existing asset per template <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=amtexitpertmp">View</a></li>
                      <li>3) Amount of called asset per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=amtofcalledast">View</a></li>
                      <li>4) Amount of real used asset per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=realcalledast">View</a></li>
                      <li>5) Amount of shares per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=sharedtmp">View</a></li>
                      <li>6) Amount of clones per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=clonestempl">View</a></li>
                      <li>7) Amount of favorite per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=favoriteItem">View</a></li>
                      <li>8) Amount of reminders per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=reminderstemp">View</a></li>
                      <li>9) Amount of URL call per template  <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=calltemplate">View</a></li>
                      <!-- <li>10) Amount of reports per template/report  <a href="javascript:void(0);">Pending</a></li> -->
                      <li>10) Amount of Downloads per template   <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=downloadtemp">View</a></li>
                   </ul>

                </div>
             </div>
          </div>
       </div>
    </div>
    <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>T2I intern-Advertising</span></h2>
             <div class="inside">
                <div class="main">
                   <ul>
                      <li>1) Amount of ads calls per template Active <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&action=adspertemp">View</a></li>
                   </ul>

                </div>
             </div>
          </div>
       </div>
    </div>
    <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>T2I intern-Overall Price Report</span></h2>
             <div class="inside">
                <div class="main">
                   <ul>
                    <li>1) Open asset - Costs per template subscription model</li>
                      <li>2) URL Call - Costs per template subscription model </li>
                      <li>3) Share - Costs per template subscription model </li>
                      <li>4) Download - Costs per template subscription model </li>
                      <li>5) Favorites - Costs per template subscription model </li>
                      <li>6) Message - Costs per template subscription model </li>
                      <li>7) Cloning - Costs per template subscription model </li>
                      <li>8) Reminder - Costs per template subscription model </li>
                      <li>9) Monthly - Costs per template subscription model </li>
                      <li>10) Reports - Costs per template subscription model </li>
                      <div class="aDviewAll">
                      <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&price_action=openasset">All View</a>
                      </div>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>Payment Provider-User Invoice Report</span></h2>
             <div class="inside">
                <div class="main">
                   <ul>
                      <li>1) Start date / time of report date </li>
                      <li>2) Start date / time of report date </li>
                      <li>3) User name and needed data for invoice </li>
                      <li>4) Amount of assets </li>
                      <li>5) Name of assets / template </li>
                      <li>6) Total costs per assets (with name) </li>
                      <li>7) Total costs per user </li>
                      <div class="aDviewAll">
                      <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&payment_report=payment">All View</a>
                      </div>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
        <div id="postbox-container-1" class="postbox-container">
       <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">

             <h2 class="hndle ui-sortable-handle"><span>User asset-User Data Report</span></h2>
             <div class="inside">
                <div class="main">
                   <ul>
                      <li>1) User Name and Data </li>
                      <li>2) Amount of assets </li>
                      <li>3) Name of asset / per asset </li>
                      <li>4) Subscription Model / per asset </li>
                      <li>5) Amount of calls on this asset </li>
                      <li>6) Amount of shares </li>
                      <li>7) Amount of favorites </li>
                      <li>8) Amount of reminder </li>
                      <li>9) Amount of download </li>
                      <li>10) Amount of reports called /per report / asset </li>
                      <div class="aDviewAll" style="margin-top:-8px;">
                      <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&report_action=invoicereport">All View</a>
                      </div>
                      
                   </ul>
                 
                </div>
             </div>
          </div>
       </div>
    </div>
    </div>
    </div>
    </div>
   