<?php

function load_files() {
	wp_enqueue_style('google-fonts-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700,200');
	wp_enqueue_style('fontawesone-css', '//use.fontawesome.com/releases/v5.7.1/css/all.css');
	wp_enqueue_style('google-fonts-roboto', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700');
	wp_enqueue_style('nucleo-icons-css', get_theme_file_uri('/css/nucleo-icons.css'));
	wp_enqueue_style('nucleo-svg-css', get_theme_file_uri('/css/nucleo-svg.css'));

	wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons+Round');
	wp_enqueue_style('bootstrap-css', get_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style('material-kit-css', get_theme_file_uri('/css/material-kit.css'));
	wp_enqueue_style('particle-css', get_theme_file_uri('/css/particle.css'));

	wp_enqueue_script('fontawesome-kit-js', '//kit.fontawesome.com/42d5adcbca.js');
	wp_enqueue_script('particle-js', get_theme_file_uri('/js/particle.js'));
	wp_enqueue_script('jquery-js', get_theme_file_uri('/js/core/jquery.min.js'));
	wp_enqueue_script('popper-js', get_theme_file_uri('/js/core/popper.min.js'));
	wp_enqueue_script('bootstrap-js', get_theme_file_uri('/js/core/bootstrap.min.js'));
	wp_enqueue_script('material-kit-js', get_theme_file_uri('/js/material-kit.js'));

	wp_enqueue_script('core-js', get_theme_file_uri('/js/core.js'));

	wp_localize_script('core-js', 'ajax_var', array(
         'url' => admin_url('admin-ajax.php'),
         'nonce' => wp_create_nonce('ajax-nonce')
     ));

	wp_enqueue_style('main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts','load_files');

add_action('wp_ajax_nopriv_core', 'core_function');    
add_action('wp_ajax_core', 'core_function');

function core_function() {
     // Check for nonce security      
     if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
         die ( 'Busted!');
     } else {
     	if (!empty($_POST)) {
	        global $wpdb;
	        $wpdb->show_errors();

	        $table = community_contact_details;
	        $data = array(
	            'contact_name' => $_POST['name'],
	            'contact_email' => $_POST['email'],
	            'contact_company' => $_POST['company'],
	            'contact_designation' => $_POST['designation']
	        );
	        $format = array(
	            '%s',
	            '%s',
	            '%s',
	            '%s'
	        );
	        $success=$wpdb->insert( $table, $data, $format );

	        if($success){
	        	//Notification Email
	        	$emailTo = get_option('admin_email');
	      
				$subject = 'Community request from '.$_POST['name'];
				$body = "Name:".$_POST['name']."\n\nEmail: ".$_POST['email']."\n\nCompany:".$_POST['company']."\n\nDesignation: ".$_POST['designation'];
				$headers = 'From: IdeaStreet'.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['email'];

				wp_mail($emailTo, $subject, $body, $headers);    

				//Confirmation Email
				$emailTo = get_option('admin_email');
	      
				$subject = 'Confirmation Email';
				$body = '<div style="width: auto; height: auto; background-color: #FFFFFF; padding: 4%;">
						  <div style="width:100%; margin-right: auto; margin-left:auto;">
						    <div style="border-style: solid; border-radius: 12px; background-color: #191919; border-left-color: #42424a;
						    border-right-color: #42424a;border-top-color: #42424a;border-bottom-color: #42424a;">
						      <div style="padding-top: 10px; padding-bottom: 10px; background-color: #dee2e5; border-radius: 12px;">
						        <div style="text-align: center; font-weight: bold;">
						            <span style="overflow:hidden;color: #061F55;font-size:2.5rem;">idea</span><span style="overflow:hidden;color:#4995C9;font-size:2.5rem;">Street</span><br/>
						            <span style="white-space:nowrap;overflow:hidden;color: #061F55; font-size: 1.5rem;">Community</span> 
						        </div>
						      </div>
						      <div style="padding: 24px;">
						        <p style="color: #FFFFFF; font-size: 1rem;">Hello '.$_POST['name'].',</p>
						        <p style="color: #FFFFFF; font-size: 1rem;">Thank you for your interest in IdeaStreet. Our team will review the information and if it fits the community purpose, we will send you a link to join the community within next 48 hours.</p><br/>
						        <p style="color: #FFFFFF; font-size: 1rem;"> IdeaStreet Team</p>
						      </div>
						    </div>
						  </div>
						</div>';
				$headers = 'From: IdeaStreet'.' <'.$emailTo.'>' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';

				wp_mail($_POST['email'], $subject, $body, $headers); 	
	        	
	        }
    	}
     }

 }
?>