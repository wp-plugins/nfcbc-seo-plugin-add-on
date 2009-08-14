<?php

// NFCBC SEO Plugin Add-on (Nofollow Comment Author Management)
//
// made by fob marketing (Oliver bockelmann) 
// http://www.fob-marketing.de/ 
// 
// THIS PLUGIN DOES NOT WORK WITHOUT NOFOLLOW CASE BY CASE !
//
// based on Delink Comment Author plugin from Alex King
// http://alexking.org/projects/wordpress
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// *****************************************************************

/*
Plugin Name: NFCBC SEO Plugin Add-on
Plugin URI: http://www.fob-marketing.de/marketing-seo-blog-kategorie/internet/wordpress/my-wordpress-plugins/
Description: This is an addon for Nofollow Case by Case plugins. It adds a link to comment e-mails to make follow urls nofollow plus online management features.
Author: Oliver Bockelmann
Author URI: http://www.fob-marketing.de/ 
Version: 1.1
*/ 

if (!function_exists('is_admin_page')) {
	function is_admin_page() {
		if (function_exists('is_admin')) {
			return is_admin();
		}
		if (function_exists('check_admin_referer')) {
			return true;
		}
		else {
			return false;
		}
	}
}

function fobnfcbc_admin_head() {
	global $wp_version;
	if (isset($wp_version) && version_compare($wp_version, '2.7', '>=')) {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list tr[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).find('div.row-actions').append(' | <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?nfcbc_action=nofollow_comment_author&comment_id=' + id + '\">Nofollow Comment</a>');
	});
});
</script>
		");
	}
	else if (isset($wp_version) && version_compare($wp_version, '2.5', '>=')) {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list tr[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).children('td.action-links').append(' | <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?nfcbc_action=nofollow_comment_author&comment_id=' + id + '\">Nofollow Comment Author</a>');
	});
});
</script>
		");
	}
	else {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list li[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).children('p').eq(0).append('&nbsp;| <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?nfcbc_action=nofollow_comment_author&comment_id=' + id + '\">Nofollow Comment Author</a>');
	});
});
</script>
		");
	}
}

if (is_admin_page()) {
	wp_enqueue_script('jquery');
}
add_action('admin_head', 'fobnfcbc_admin_head');

function fobnfcbc_request_handler() {
	if (!empty($_GET['nfcbc_action'])) {
		switch($_GET['nfcbc_action']) {
			case 'nofollow_comment_author':
				if (!empty($_GET['comment_id'])) {
					global $wpdb;
					$comment_id = intval($_GET['comment_id']);
					$comment_post_id = $wpdb->get_var("
						SELECT comment_post_ID
						FROM $wpdb->comments
						WHERE comment_ID = '$comment_id'
					");
					$comment_author_url = $wpdb->get_var("
						SELECT comment_author_url
						FROM $wpdb->comments
						WHERE comment_ID = '$comment_id'
					"); 
					$nofollow_author_url = rtrim($comment_author_url, '/').'/dontfollow';
					if (current_user_can('edit_post', $comment_post_id)) {
						if (!strpos($nofollow_author_url, 'dontfollow/dontfollow')) {
							$wpdb->query("
								UPDATE $wpdb->comments
								SET comment_author_url = '$nofollow_author_url'
								WHERE comment_ID = '$comment_id'
							");
						}
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/edit-comments.php');
						die();
					}
				}
				break;
		}
	}
}
add_action('init', 'fobnfcbc_request_handler');

function fobnfcbc_email($text, $comment_id) {
	return $text .= "\r\n".'Nofollow Comment Author: '.get_bloginfo('wpurl').'/wp-admin/index.php?nfcbc_action=nofollow_comment_author&comment_id='.$comment_id."\r\n";
}
add_filter('comment_notification_text', 'fobnfcbc_email', 10, 2);



/**  ***************************************************************************** 
 **  AND NOW WE START AGAIN TO INCLUDE A FOLLOW LINK FOR EARLIER REPLACED LINKS ** 
******************************************************************************* **/ 

function fobfcbc_admin_head() {
	global $wp_version;
	if (isset($wp_version) && version_compare($wp_version, '2.7', '>=')) {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list tr[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).find('div.row-actions').append(' | <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?fcbc_action=refollow_comment_author&comment_id=' + id + '\">(Now) Follow</a>');
	});
});
</script>
		");
	}
	else if (isset($wp_version) && version_compare($wp_version, '2.5', '>=')) {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list tr[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).children('td.action-links').append(' | <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?fcbc_action=refollow_comment_author&comment_id=' + id + '\">(Now) Follow</a>');
	});
});
</script>
		");
	}
	else {
		print("
<script type=\"text/javascript\">
jQuery(function($) {
	$('#the-comment-list li[id^=comment]').each(function() {
		var id = $(this).attr('id').replace('comment-', '');
		$(this).children('p').eq(0).append('&nbsp;| <a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php?fcbc_action=refollow_comment_author&comment_id=' + id + '\">(Now) Follow</a>');
	});
});
</script>
		");
	}
}

// if (is_admin_page()) {
	// wp_enqueue_script('jquery');
// }
add_action('admin_head', 'fobfcbc_admin_head');

function fobfcbc_request_handler() {
	if (!empty($_GET['fcbc_action'])) {
		switch($_GET['fcbc_action']) {
			case 'refollow_comment_author':
				if (!empty($_GET['comment_id'])) {
					global $wpdb;
					$comment_id = intval($_GET['comment_id']);
					$comment_post_id = $wpdb->get_var("
						SELECT comment_post_ID
						FROM $wpdb->comments
						WHERE comment_ID = '$comment_id'
					");
					$comment_author_url = $wpdb->get_var("
						SELECT comment_author_url
						FROM $wpdb->comments
						WHERE comment_ID = '$comment_id'
					"); 
					$refollow_author_url = trim($comment_author_url);
					if (current_user_can('edit_post', $comment_post_id)) {
						if (strpos($refollow_author_url, '/dontfollow')) {
							$follow_author_url = preg_replace("/\/dontfollow/", "", $refollow_author_url);
							$wpdb->query("
								UPDATE $wpdb->comments
								SET comment_author_url = '$follow_author_url'
								WHERE comment_ID = '$comment_id'
							");
						}
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/edit-comments.php');
						die();
					}
				}
				break;
		}
	}
}
add_action('init', 'fobfcbc_request_handler');

// function fobfcbc_email($text, $comment_id) {
	// return $text .= "\r\n".'Follow Comment Author: '.get_bloginfo('wpurl').'/wp-admin/index.php?fcbc_action=refollow_comment_author&comment_id='.$comment_id."\r\n";
// }
// add_filter('comment_notification_text', 'fobfcbc_email', 10, 2);

?>