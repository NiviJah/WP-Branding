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

$plugin_dir_path = dirname(__FILE__);

function agenti_my_login_stylesheet() {

   wp_enqueue_style( 'custom-login', plugins_url('css/login-styles.css', __FILE__) );

}
add_action( 'login_enqueue_scripts', 'agenti_my_login_stylesheet' );

function agenti_my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo plugins_url('img/logo.png', __FILE__); ?>);

            background-size: 320px 115px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'agenti_my_login_logo' );

function agenti_my_login_logo_url() {
return 'http://agent.co.il';
}
add_filter( 'login_headerurl', 'agenti_my_login_logo_url' );

function agenti_my_login_logo_url_title() {
return 'A Site By Agent Interactive';
}
add_filter( 'login_headertitle', 'agenti_my_login_logo_url_title' );


function agenti_customAdmin() {
  wp_enqueue_style( 'custom-login', plugins_url('css/agent-admin-style.css', __FILE__) );

}
add_action('admin_head', 'agenti_customAdmin');

//change the footer text
function agenti__admin_footer_text () {
    echo 'Another Website Made with Love in <a href="http://agent.co.il">Agent</a>.';
}
add_filter( 'admin_footer_text', 'agenti__admin_footer_text' );


// remove unwanted dashboard widgets for relevant users
function agenti_remove_dashboard_widgets() {


        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'icl_dashboard_widget', 'dashboard', 'normal');//since 3.8
    
}
add_action( 'wp_dashboard_setup', 'agenti_remove_dashboard_widgets' );



// add new dashboard widgets
function agenti_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'agenti_dashboard_welcome', 'Welcome', 'agenti_add_welcome_widget' );

}
function agenti_add_welcome_widget(){ ?>


 <img src="<?php echo plugins_url('img/dash.png', __FILE__); ?>" class="dash-logo" alt=""><br />
    <h2>Welcome To Your Website ! </h2><br />
    <h2>Please Don't hesitate to call us if you need support.</h2>
 
    <ul>
        <li><a href="mailto:niv.agent@gmail.com">Send us an Email</a></li>
        <li>Call Us: 052-4699933</li>
        <li><a href="http://www.agent.co.il">Our Website</a></li>
    </ul>
 
<?php }
 

add_action( 'wp_dashboard_setup', 'agenti_add_dashboard_widgets' );


function agent_footer() {
    echo '<p>Made with love by <a href="http://www.agent.co.il/" target="_blank">@gent</a></p>';
}
add_action('wp_footer', 'agent_footer');
