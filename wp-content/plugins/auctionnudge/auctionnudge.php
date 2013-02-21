<?php
/*
Plugin Name: Auction Nudge
Plugin URI: http://www.auctionnudge.com/wordpress-plugin
Description: A plugin to simplify using Auction Nudge on your WordPress site. To get started 1) Obtain your code snippet from <a href="http://www.auctionnudge.com">www.auctionnudge.com</a> 2) Paste the code into the <a href="options-general.php?page=an_options_page">Auction Nudge configuration page</a> 3) Place markers like <strong>[an_items]</strong> in pages or posts or call <strong>&lt;?php wp_items(); ?&gt;</strong> from your theme files to display your eBay data on your site.
Version: 0.1
Author: Joseph Hawes
Author URI: http://www.josephhawes.co.uk/
License: GPL2
*/

/*  
Copyright 2011 Joseph Hawes (email: joe@josephhawes.co.uk)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Thanks to Otto on WordPress for their Wordpress settings tutorial:
http://ottopress.com/2009/wordpress-settings-api-tutorial/
*/

// Add the admin options page
function an_admin_page() {
	add_options_page('Auction Nudge Plugin Page', 'Auction Nudge', 'manage_options', 'an_options_page', 'an_options_page');
}
add_action('admin_menu', 'an_admin_page');

//Display the admin options page
function an_options_page() {
	echo '<div>' . "\n";
	echo '	<h2>Auction Nudge Wordpress Plugin</h2>' . "\n";
	echo '	<p>This plugin enables you to embed your live eBay information (active items, profile information and feedback) on your website using <a href="http://www.auctionnudge.com/">Auction Nudge</a>.</p>' . "\n";
	echo '	<p>You can view more information and help at the plugin home page here: <a href="http://www.auctionnudge.com/wordpress-plugin">http://www.auctionnudge.com/wordpress-plugin</a>.</p>' . "\n";
	echo '	<form action="options.php" method="post">' . "\n";
	settings_fields('an_options');
	do_settings_sections('an');
	echo '	<input name="Submit" type="submit" value="Save Settings" />' . "\n";
	echo '	</form>' . "\n";
	echo '</div>' . "\n";
}

//Define settings
function an_admin_init(){
	register_setting('an_options', 'an_options', 'an_options_validate');
	add_settings_section('an_items', 'Your eBay Listings', 'an_items_text', 'an');
	add_settings_field('an_items_code_snippet', 'Insert code snippet', 'an_items_setting', 'an', 'an_items');
	add_settings_section('an_profile', 'Your eBay Profile', 'an_profile_text', 'an');
	add_settings_field('an_profile_code_snippet', 'Insert code snippet', 'an_profile_setting', 'an', 'an_profile');
	add_settings_section('an_feedback', 'Your eBay Feedback', 'an_feedback_text', 'an');
	add_settings_field('an_feedback_code_snippet', 'Insert code snippet', 'an_feedback_setting', 'an', 'an_feedback');
	add_settings_section('an_css', 'Auction Nudge CSS Rules', 'an_css_text', 'an');
	add_settings_field('an_css_rules', 'Insert CSS Rules', 'an_css_setting', 'an', 'an_css');
}
add_action('admin_init', 'an_admin_init');

//Items text
function an_items_text() {
	echo '<p>To begin <strong>you must obtain your code snippet from the Auction Nudge website</strong> here: <a target="_blank" href="http://www.auctionnudge.com/your-ebay-items">http://www.auctionnudge.com/your-ebay-items</a> (shown as "Copy the code snippet onto your site") and paste it into the box below.</p>' . "\n";
	echo '<p>You can then specify where to display Your eBay Items by placing the marker <strong>[an_items]</strong> in a post or page content through the editor. Alternatively you can call <strong>&lt;?php an_items(); ?&gt;</strong> from within your theme files.</p>' . "\n";
}

//Output items option
function an_items_setting() {
	$options = get_option('an_options');
	echo '<textarea id="an_items_code_snippet" name="an_options[an_items_code]" rows="6" columns="30" style="font-family:courier;width:400px">' . $options['an_items_code'] . '</textarea>' . "\n";
}

//Profile text
function an_profile_text() {
	echo '<p>To begin <strong>you must obtain your code snippet from the Auction Nudge website</strong> here: <a target="_blank" href="http://www.auctionnudge.com/your-ebay-profile">http://www.auctionnudge.com/your-ebay-profile</a> (shown as "Copy the code snippet onto your site") and paste it into the box below.</p>' . "\n";
	echo '<p>You can then specify where to display Your eBay Items by placing the marker <strong>[an_profile]</strong> in a post or page content through the editor. Alternatively you can call <strong>&lt;?php an_profile(); ?&gt;</strong> from within your theme files.</p>' . "\n";
}

//Output profile option
function an_profile_setting() {
	$options = get_option('an_options');
	echo '<textarea id="an_profile_code_snippet" name="an_options[an_profile_code]" rows="6" columns="30" style="font-family:courier;width:400px">' . $options['an_profile_code'] . '</textarea>' . "\n";
}

//Feedback text
function an_feedback_text() {
	echo '<p>To begin <strong>you must obtain your code snippet from the Auction Nudge website</strong> here: <a target="_blank" href="http://www.auctionnudge.com/your-ebay-feedback">http://www.auctionnudge.com/your-ebay-feedback</a> (shown as "Copy the code snippet onto your site") and paste it into the box below.</p>' . "\n";
	echo '<p>You can then specify where to display Your eBay Items by placing the marker <strong>[an_feedback]</strong> in a post or page content through the editor. Alternatively you can call <strong>&lt;?php an_feedback(); ?&gt;</strong> from within your theme files.</p>' . "\n";
}

//Output feedback option
function an_feedback_setting() {
	$options = get_option('an_options');
	echo '<textarea id="an_feedback_code_snippet" name="an_options[an_feedback_code]" rows="6" columns="30" style="font-family:courier;width:400px">' . $options['an_feedback_code'] . '</textarea>' . "\n";
}

//Feedback text
function an_css_text() {
	echo '<p>You can modify the appearance of Auction Nudge by pasting CSS rules into this box.</p>' . "\n";
	echo '<p>Ensure you target Auction Nudge content by starting your rules with <strong>div.auction-nudge</strong>. For example div.auction-nudge a { color: red } to make all Auction Nudge links red. You can find more information and demos on modifying the appearance of Auction Nudge here: <a target="_blank" href="http://www.auctionnudge.com/help#faq-css">http://www.auctionnudge.com/help#faq-css</a></p>' . "\n";
}

//Output css option
function an_css_setting() {
	$options = get_option('an_options');
	echo '<textarea id="an_css_rules" name="an_options[an_css_rules]" rows="6" columns="30" style="font-family:courier;width:400px">' . $options['an_css_rules'] . '</textarea>' . "\n";
}

//Validate our options
function an_options_validate($input) {
	$output['an_items_code'] = trim($input['an_items_code']);
	$output['an_profile_code'] = trim($input['an_profile_code']);
	$output['an_feedback_code'] = trim($input['an_feedback_code']);
	$output['an_css_rules'] = trim($input['an_css_rules']);
	return $output;
}

//Replace markers
function an_the_content($content) {
	$options = get_option('an_options');

	$old = array(
		'[an_items]',
		'[an_profile]',
		'[an_feedback]'
	);
	$new = array(
		$options['an_items_code'],
		$options['an_profile_code'],
		$options['an_feedback_code']
	);	
	return str_replace($old, $new, $content);
}
add_filter('the_content', 'an_the_content');

//Get option
function an_get_option($option_key) {
	$options = get_option('an_options');
	return $options[$option_key];
}

//Output items
function an_items() {
	echo an_get_option('an_items_code');
}

//Output profile
function an_profile() {
	echo an_get_option('an_profile_code');
}

//Output feedback
function an_feedback() {
	echo an_get_option('an_feedback_code');
}

//Load custom CSS
function an_load_css() {
	$options = get_option('an_options');
	echo '<style type="text/css">' . "\n";
	echo $options['an_css_rules'] . "\n";
	echo '</style>' . "\n";	
}
add_action('wp_head', 'an_load_css');