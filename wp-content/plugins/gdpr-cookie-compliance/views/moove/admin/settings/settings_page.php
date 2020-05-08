<?php ob_start(); ?>
    <div class="moove-gdpr-donation-box-wrapper">
        <div class="moove-donation-box">
            <h3>Donations</h3>

            <p>
                If you enjoy using this plugin and find it useful, feel free to donate a small amount to show appreciation and help us continue improving and supporting this plugin for free. It will make our development team very happy! :)
            </p>

            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="moove-gdpr-donate-form">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="LCYMMR4EQ2YVW">
                <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
            </form>

            <p>
                Click the 'Donate' button and you will be redirected to Paypal where you can make your donation. You don't need to have a Paypal account, you can make donation using your credit card.  <br/> Many thanks.
            </p>
        </div>
    </div>
<?php echo apply_filters( 'gdpr_cookie_compliance_donate_section', ob_get_clean() ); ?>

<div class="wrap" id="moove_form_checker_wrap">
    <h1><?php _e('GDPR Cookie Compliance Plugin Settings','gdpr-cookie-compliance'); ?></h1>
    <div id="moove-gdpr-setting-error-settings_updated" class="updated settings-error notice is-dismissible" style="display:none;">
        <p><strong><?php _e('Settings saved.','gdpr-cookie-compliance'); ?></strong></p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?php _e('Dismiss this notice.','gdpr-cookie-compliance'); ?></span>
        </button>
    </div>

    <div id="moove-gdpr-setting-error-settings_scripts_empty" class="error settings-error notice is-dismissible" style="display:none;">
        <p>
            <strong><?php _e('You need to insert the relevant script for the settings to be saved!','gdpr-cookie-compliance'); ?></strong>
        </p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?php _e('Dismiss this notice.','gdpr-cookie-compliance'); ?></span>
        </button>
    </div>

    <h4><?php _e('General Data Protection Regulation (GDPR) is a <a href="http://www.eugdpr.org/" target="_blank">European regulation</a> to strengthen and unify the data protection of EU citizens.','gdpr-cookie-compliance'); ?><br> </h4>

    <?php
        $gdpr_default_content = new Moove_GDPR_Content();
        $current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';
        if( isset( $current_tab ) &&  $current_tab !== '' ) :
            $active_tab = $current_tab;
        else :
            $active_tab = "general_settings";
        endif; // end if

        ob_start();
        $view_cnt = new GDPR_View();
        echo $view_cnt->load( 'moove.admin.settings.' . $active_tab , array() );
        $tab_data = ob_get_clean();

        $option_name    = $gdpr_default_content->moove_gdpr_get_option_name();
        $modal_options  = get_option( $option_name );
        $wpml_lang      = $gdpr_default_content->moove_gdpr_get_wpml_lang();
    ?>
    <br />
    <div class="gdpr-tab-section-cnt">
        <h2 class="nav-tab-wrapper">
            <a href="?page=moove-gdpr&amp;tab=general_settings" class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>">
                <?php _e('General Settings','gdpr-cookie-compliance'); ?>
            </a>

            <a href="?page=moove-gdpr&amp;tab=banner_settings" class="nav-tab <?php echo $active_tab == 'banner_settings' ? 'nav-tab-active' : ''; ?>">
                <?php _e('Banner Settings','gdpr-cookie-compliance'); ?>
            </a>

            <a href="?page=moove-gdpr&amp;tab=floating_button" class="nav-tab <?php echo $active_tab == 'floating_button' ? 'nav-tab-active' : ''; ?>">
                <?php _e('Floating Button','gdpr-cookie-compliance'); ?>
            </a>


        
            <?php
                $nav_label  = isset( $modal_options['moove_gdpr_privacy_overview_tab_title'.$wpml_lang] ) && $modal_options['moove_gdpr_privacy_overview_tab_title'.$wpml_lang] ? $modal_options['moove_gdpr_privacy_overview_tab_title'.$wpml_lang] : __('Privacy Overview','gdpr-cookie-compliance');
            ?>
            <a href="?page=moove-gdpr&amp;tab=privacy_overview" class="nav-tab <?php echo $active_tab == 'privacy_overview' ? 'nav-tab-active' : ''; ?>">
                <?php echo $nav_label; ?>
            </a>

            <?php
                $nav_label  = isset( $modal_options['moove_gdpr_strictly_necessary_cookies_tab_title'.$wpml_lang] ) && $modal_options['moove_gdpr_strictly_necessary_cookies_tab_title'.$wpml_lang] ? $modal_options['moove_gdpr_strictly_necessary_cookies_tab_title'.$wpml_lang] : __('Strictly Necessary Cookies','gdpr-cookie-compliance');
            ?>
            <a href="?page=moove-gdpr&amp;tab=strictly_necessary_cookies" class="nav-tab <?php echo $active_tab == 'strictly_necessary_cookies' ? 'nav-tab-active' : ''; ?>">
                <?php echo $nav_label; ?>
            </a>

            <?php
                $nav_label  = isset( $modal_options['moove_gdpr_performance_cookies_tab_title'.$wpml_lang] ) && $modal_options['moove_gdpr_performance_cookies_tab_title'.$wpml_lang] ? $modal_options['moove_gdpr_performance_cookies_tab_title'.$wpml_lang] : __('3rd Party Cookies','gdpr-cookie-compliance');
            ?>
            <a href="?page=moove-gdpr&amp;tab=third_party_cookies" class="nav-tab <?php echo $active_tab == 'third_party_cookies' ? 'nav-tab-active' : ''; ?>">
                <?php echo $nav_label; ?>
            </a>

            <?php
                $nav_label  = isset( $modal_options['moove_gdpr_advanced_cookies_tab_title'.$wpml_lang] ) && $modal_options['moove_gdpr_advanced_cookies_tab_title'.$wpml_lang] ? $modal_options['moove_gdpr_advanced_cookies_tab_title'.$wpml_lang] : __('Additional Cookies','gdpr-cookie-compliance');
            ?>
            <a href="?page=moove-gdpr&amp;tab=advanced_cookies" class="nav-tab <?php echo $active_tab == 'advanced_cookies' ? 'nav-tab-active' : ''; ?>">
                <?php echo $nav_label; ?>
            </a>
            <?php
                $nav_label  = isset( $modal_options['moove_gdpr_cookie_policy_tab_nav_label'.$wpml_lang] ) && $modal_options['moove_gdpr_cookie_policy_tab_nav_label'.$wpml_lang] ? $modal_options['moove_gdpr_cookie_policy_tab_nav_label'.$wpml_lang] : __('Cookie Policy','gdpr-cookie-compliance');
            ?>
            <a href="?page=moove-gdpr&amp;tab=cookie_policy" class="nav-tab <?php echo $active_tab == 'cookie_policy' ? 'nav-tab-active' : ''; ?>">
                <?php echo $nav_label; ?>
            </a>

            <?php do_action('gdpr_settings_tab_nav_extensions', $active_tab); ?>

        </h2>

        <div class="moove-gdpr-form-container <?php echo $active_tab; ?>">
            <?php echo apply_filters( 'gdpr_settings_tab_content', $tab_data, $active_tab ); ?>
        </div>
        <!-- moove-form-container -->
    </div>
    <!--  .gdpr-tab-section-cnt -->

    <div class="moove-gdpr-settings-branding">
        <hr />
       
    </div>
    <!--  .moove-gdpr-settings-branding -->
</div>
<!-- .wrap -->


