<?php
/*
Plugin Name: Quick Subscribe
Plugin URI: http://pirex.com.br/wordpress-plugins/quick-subscribe
Description: Allows visitor to quickly register to your blog using only an email address
Author: Leo Germani
Version: 1.7.1
Author URI: http://pirex.com.br/wordpress-plugins

    Quick Subscribe is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    This is a WordPress plugin (http://wordpress.org) and widget
    (http://automattic.com/code/widgets/).
*/


//Load default options

if(!get_option("quicksubscribe_tks")){

	update_option("quicksubscribe_button", true);
	update_option("quicksubscribe_label", "ok");
	update_option("quicksubscribe_tks", "Thanks for subscribing");
	
}



function quick_subscribe_register($source){

	require_once( ABSPATH . WPINC . '/registration.php');

	
	$user_email = apply_filters( 'user_registration_email', $source );
	$user_login = sanitize_user( str_replace('@','', $source) );

	// Check the e-mail address
	if ($user_email == '') {
		$errors = __('<strong>ERROR</strong>: Please type your e-mail address.');
	} elseif ( !is_email( $user_email ) ) {
		$errors = __('<strong>ERROR</strong>: The email address isn&#8217;t correct.');
		$user_email = '';
	} elseif ( email_exists( $user_email ) )
		$errors = __('<strong>ERROR</strong>: This email is already registered, please choose another one.');

	//do_action('register_post');

	$errors = apply_filters( 'registration_errors', $errors );
	$message = $errors;

	if ( empty( $errors ) ) {
		$user_pass = substr( md5( uniqid( microtime() ) ), 0, 7);

		$user_id = wp_create_user( $user_login, $user_pass, $user_email );
		
		$user = new WP_User($user_id);
		$user->set_role('subscriber');
		
		
		$message = "ok";
		
		
		if ( !$user_id )
			$errors['registerfail'] = sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email'));
		
	}
	return $message;
}

function widget_quick_subscribe_init(){
	
	
	// Check to see required Widget API functions are defined...
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return; // ...and if not, exit gracefully from the script.
			
		function widget_quick_subscribe($args){
			
			extract($args);
			if ( $_POST['QS_user_email_widget'] ) {
				$message = quick_subscribe_register($_POST['QS_user_email_widget']);
			}
			
			$options = get_option('quick_subscribe_title');
			
			$message = ($message=="ok") ? $options['message'] : $message;
			
			$caixa = 'E-mail'; 
			
			echo $before_widget;
			
			echo $before_title . $options['title'] . $after_title;
			?>
			
			<div id='quick_subscribe_messages'>
			
			<?= $message ?>
			
			</div>
			
			<form name='quick_subscribe_form' id='quick_subscribe_form' method='POST' action='<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>'>
			
				<input type='text' name='QS_user_email_widget' id='QS_user_email_widget' value='<?= $caixa ?>' onFocus='if(this.value=="<?= $caixa ?>") this.value=""'>
				<? if ($options['button']==1){ ?>
					
					<input type='submit' value='<? if($options['label']=='') echo 'Ok'; else echo $options['label']; ?>'>
					
				<?} ?>
			
			</form>
			
			
			<?
			echo $after_widget;
		}
		
		function widget_quick_subscribe_control() {
		
			// Collect our widget's options.
			$optionName = 'quick_subscribe_title';
			$submitName = 'quick_subscribe_submit';
			$options = get_option($optionName);
			
			// This is for handing the control form submission.
			if ( $_POST[$submitName] ) {
				// Clean up control form submission options
				$buttonValue = ($_POST['quick_subscribe_button']==1) ? 1 : 0;
				$newoptions['title'] = $_POST['quick_subscribe_title'];
				$newoptions['message'] = $_POST['quick_subscribe_message'];
				$newoptions['label'] = $_POST['quick_subscribe_label'];
				$newoptions['button'] = $buttonValue;
				
				if ( $options != $newoptions ) {
					$options = $newoptions;
					update_option($optionName, $options);
				
				}
			
			}
			
			$title = $options['title'];
			$message = $options['message'];
			$label = $options['label'];
			$button = $options['button'];
			
			
			
			// The HTML below is the control form for editing options.
			?>
			<div>
			<label for="quick_subscribe_title" style="line-height:35px;display:block;">
			Title: <input type="text" id="quick_subscribe_title" name="quick_subscribe_title" value="<?php echo $title; ?>" /></label>
			
			<label for="quick_subscribe_message" style="line-height:35px;display:block;">
			Thanks Message: <input type="text" id="quick_subscribe_message" name="quick_subscribe_message" value="<?php echo $message; ?>" /></label>
			
			<label for="quick_subscribe_button" style="line-height:35px;display:block;">
			<input type="checkbox" id="quick_subscribe_button" name="quick_subscribe_button" value="1" <?php if ($button==1) echo "checked"; ?> /> Display Submit button</label>
			
			<label for="quick_subscribe_label" style="line-height:35px;display:block;">
			Button label: <input type="text" id="quick_subscribe_label" name="quick_subscribe_label" value="<?php echo $label; ?>" /></label>
			
			<input type="hidden" name="<? echo $submitName ?>" id="<? echo $submitName ?>" value="1" />
			</div>
			<?php
			// end of widget_mywidget_control()
		}
		
	    register_sidebar_widget('Quick Subscribe ', 'widget_quick_subscribe');
	    register_widget_control('Quick Subscribe ', 'widget_quick_subscribe_control');
	    
}


function quicksubscribe_admin() {
	if (function_exists('add_options_page')) {
		add_options_page('Quick Subscribe Options', 'Quick Subscribe', 8, basename(__FILE__), 'quicksubscribe_admin_page');
	}
}

function quicksubscribe_admin_page() {
	

	if (isset($_POST['submit_qs'])) {


		echo "<div class=\"updated\"><p><strong> Quick Subscribe Options Updated!";
		
		$button = ($_POST['button_qs'] == 1) ? true : false;
		
		update_option("quicksubscribe_button", $button);
		update_option("quicksubscribe_label", $_POST['label_qs']);
		update_option("quicksubscribe_tks", $_POST['tks_qs']);
			
		
		
		echo "</strong></p></div>";
	}
	
	$op_button = (get_option("quicksubscribe_button")) ? "checked" : "";
	$op_label = get_option("quicksubscribe_label");
	$op_tks = get_option("quicksubscribe_tks");
	?>



	<div class=wrap>
	  <form name="qsoptions" method="post">
	    <h2>Quick Subscribe Page/Post form options</h2>

		
			<input type="checkbox" name="button_qs" value="1" <?= $op_button ?>> Display submit button <BR /><BR />
			Button Label:<BR />
			<input type="text" name="label_qs" value="<?= $op_label ?>"> <BR /><BR />
			Thanks Message:<BR />
			<input type="text" name="tks_qs" value="<?= $op_tks ?>"> <BR /><BR />
			
			

	
	
	<div class="submit">
	<input type="submit" name="submit_qs" value="<?php _e('Update Settings', '') ?> &raquo;">
	
	
	
	  </form>
	</div>

	<?php

}



function quick_subscribe_get_form($message, $source){
	$caixa = 'E-mail'; 
	$op_button = (get_option("quicksubscribe_button")) ? "checked" : "";
	$op_label = get_option("quicksubscribe_label");
	$op_tks = get_option("quicksubscribe_tks");
	
	$message = ($message=="ok") ? $op_tks : $message;
	
	$output = "<div id='quick_subscribe_messages'>". $message ."</div>";
	
	$output .= "<form name='quick_subscribe_form' id='quick_subscribe_form' method='POST' action='http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ."'>";
	$output .= "<input type='text' name='". $source ."' id='". $source ."' value='$caixa' onFocus='if(this.value==\"$caixa\") this.value=\"\"'>";
	if ($op_button) $output .= "<input type='submit' value='$op_label'>";
	$output .= "</form>";
	return $output;
}



function quick_subscribe_post_form($content){
	
	
	//TODO Check if there is [quicksubscribe] tag and only do anything if it necessary
	if ( $_POST['QS_user_email_post'] ) {
		$message = quick_subscribe_register($_POST['QS_user_email_post']);
	}
	
	$output = quick_subscribe_get_form($message, "QS_user_email_post");
	
	
	$content = str_replace("[quicksubscribe]", $output, $content);
	return $content;
	

	
}

function quick_subscribe_form(){

	if ( $_POST['QS_user_email_tt'] ) {
		$message = quick_subscribe_register($_POST['QS_user_email_tt']);
	}
	
	echo quick_subscribe_get_form($message, "QS_user_email_tt");
	
}


// Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'widget_quick_subscribe_init');
add_filter('the_content', 'quick_subscribe_post_form');
add_action('admin_menu','quicksubscribe_admin');


?>
