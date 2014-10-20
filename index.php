<?php
/**
 * Plugin Name: Agent
 * Plugin URI: Agent.co.il
 * Description: Agent Branding.
 * Version: 1.0
 * Author: NiviJah
 * Author URI: NiviJah.com
 * License: GPL2
 */

$plugin_path = ABSPATH. 'wp-content/plugins/agent_plugin/';

//Debug
add_action('activated_plugin','save_error');
function save_error(){
  file_put_contents($plugin_path . '/error.html', ob_get_contents());
}

//--------------------------------------------------------

/**
 * Include Vafpress Framework
 */
require_once $plugin_path . 'vafpress-framework/bootstrap.php';


// options
$tmpl_opt  = $plugin_path . '/admin/option/option.php';

/**
 * Create instance of Options
 */
$theme_options = new VP_Option(array(
    'is_dev_mode'           => false,                                  // dev mode, default to false
    'option_key'            => 'agnet_branding',                           // options key in db, required
    'page_slug'             => 'agnet_branding',                           // options page slug, required
    'template'              => $tmpl_opt,                              // template file path or array, required
    'menu_page'             => 'options-general.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
    'use_auto_group_naming' => true,                                   // default to true
    'use_util_menu'         => true,                                   // default to true, shows utility menu
    'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'
    'layout'                => 'fixed',                                // fluid or fixed, default to fixed
    'page_title'            => __( 'Agent Branding', 'vp_textdomain' ), // page title
    'menu_label'            => __( 'Agent Branding', 'vp_textdomain' ), // menu label
    ));


//-------------------------------------------------------

// ADD STYLESHEET TO LOGIN PAGE
function agenti_my_login_stylesheet() {

    wp_enqueue_style( 'custom-login', plugins_url('css/login-styles.css', __FILE__) );

}
add_action( 'login_enqueue_scripts', 'agenti_my_login_stylesheet' );


// ADD CUSTOM STYLESHEET TO ADMIN AREA
function agenti_customAdmin() {
    ?>
    <!-- wp_enqueue_style( 'custom-login', plugins_url('css/agent-admin-style.css', __FILE__) ); -->
    <?php

    $menu_bg = vp_option('agnet_branding.menu_bg');
    $text_color = vp_option('agnet_branding.text_color');

    ?>

    <style type="text/css">
    
    #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow, #adminmenu .wp-menu-arrow div, #adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, .folded #adminmenu li.wp-has-current-submenu {
        background: <?php echo $menu_bg; ?>;
        color: #fff;
    }

    #adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover, #adminmenu li.menu-top>a:focus{
        color: <?php echo $text_color; ?> ;
    }
    #adminmenu li:hover div.wp-menu-image:before {
        color: <?php echo $text_color; ?> ;
    }
    #wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar .ab-top-menu>li:hover>.ab-item, #wpadminbar .ab-top-menu>li>.ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus{
        background: #333;
        color: <?php echo $text_color; ?>;

    }
    #wpadminbar>#wp-toolbar a:focus span.ab-label, #wpadminbar>#wp-toolbar li.hover span.ab-label, #wpadminbar>#wp-toolbar li:hover span.ab-label {
        color: <?php echo $text_color; ?>;
    }
    #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop ul li a:focus strong, #wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:hover strong, #wpadminbar .quicklinks .menupop.hover ul li a:focus, #wpadminbar .quicklinks .menupop.hover ul li a:hover, #wpadminbar li .ab-item:focus:before, #wpadminbar li a:focus .ab-icon:before, #wpadminbar li.hover .ab-icon:before, #wpadminbar li.hover .ab-item:before, #wpadminbar li:hover #adminbarsearch:before, #wpadminbar li:hover .ab-icon:before, #wpadminbar li:hover .ab-item:before, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
        color: <?php echo $text_color; ?>;
    }
    .dash-logo{
        display: block;
        width: 90%;
    }
    </style>

    <?php }
    add_action('admin_head', 'agenti_customAdmin');

// CHANGE THE LOGO
    function agenti_my_login_logo() { 
        $image = vp_option('agnet_branding.logo_upload');

        ?>

        <style type="text/css">
        body.login div#login h1 a {
            background-image: url( <?php echo $image; ?> );
            background-size: 320px 115px;
        }
        </style>
        <?php }
        add_action( 'login_enqueue_scripts', 'agenti_my_login_logo' );

// Background Image
        function agenti_bg_login() { 
            $bg = vp_option('agnet_branding.bg_login');
            ?>
            <style type="text/css">
            body.login {
                background-image: url(<?php echo $bg; ?>);
            }
            </style>
            <?php }
            add_action( 'login_enqueue_scripts', 'agenti_bg_login' );

// CHANGE URL OF LOGO
            function agenti_my_login_logo_url() {
                $logo_url = vp_option('agnet_branding.logo_url');
                return $logo_url;
            }
            add_filter( 'login_headerurl', 'agenti_my_login_logo_url' );

// CHANGE LOGO IMG ALT
            function agenti_my_login_logo_url_title() {
                $logo_alt = vp_option('agnet_branding.logo_url_alt');
                return $logo_alt;
            }
            add_filter( 'login_headertitle', 'agenti_my_login_logo_url_title' );



//CHANGE THE DEFAULT FOOTER TEXT IN ADMIN
            function agenti__admin_footer_text () {
                $admin_footer_text = vp_option('agnet_branding.admin_footer_text');
        // echo 'Another Website Made with Love in <a href="http://agent.co.il">Agent</a>.';
                echo $admin_footer_text;
            }
            add_filter( 'admin_footer_text', 'agenti__admin_footer_text' );


            $remove_metaboxes = vp_option('agnet_branding.remove_meta');
            if ($remove_metaboxes == true) {

                function tidy_dashboard()  
                {
                  global $wp_meta_boxes, $current_user;

  // remove incoming links info for authors or editors
                  if(in_array('author', $current_user->roles) || in_array('editor', $current_user->roles))
                  {
                    unset($wp_meta_boxes['dashboard']['normal ']['core']['dashboard_incoming_links']);
                }

//Right Now - Comments, Posts, Pages at a glance
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);  
//Recent Comments
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);  
//Incoming Links
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  
//Plugins - Popular, New and Recently updated Wordpress Plugins
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
                unset($wp_meta_boxes['dashboard']['normal']['core']['icl_dashboard_widget']);
//Wordpress Development Blog Feed
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);  
//Other Wordpress News Feed
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);  
//Quick Press Form
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);  
//Recent Drafts List
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);  

            }
        }
//add our function to the dashboard setup hook
        add_action('wp_dashboard_setup', 'tidy_dashboard'); 


// add new dashboard widgets
        function agenti_add_dashboard_widgets() {
            $custom_title = vp_option('agnet_branding.meta_box_title');
            wp_add_dashboard_widget( 'agenti_dashboard_welcome', $custom_title, 'agenti_add_welcome_widget' );

        }

// ADD CONTENT TO THE NEW DASHBOAD WIDGET
        function agenti_add_welcome_widget(){ 

            $custom_meta_box = vp_option('agnet_branding.custom_meta_box');

            echo $custom_meta_box; 
        }


        add_action( 'wp_dashboard_setup', 'agenti_add_dashboard_widgets' );




