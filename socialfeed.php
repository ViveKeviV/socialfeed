<?php
/**
 * @package Socialfeed
 */
/*
Plugin Name: Socialfeed
Plugin URI: http://www.gyanmatrix.com/
Description: Shows social media activity from different sites such as(Facebook, Twitter & Stack Overflow).
Version: 1.0.1
Author: GyanMatrix
Author URI: http://www.gyanmatrix.com/
Requires at least: wordpress 4.0.0
Tested up to: WordPress 4.6.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2016 Gyanmatrix Ltd.
*/


class Socialfeed {

	public function __construct() {
		$this->addmenus();
		$this->addshortcode();
		$this->load_dependencies();
	}

	private function load_dependencies() {
		require_once WP_CONTENT_DIR . '/plugins/socialfeed/shortcode.php';
	} 

	protected function addmenus() {
		add_action( 'admin_menu', 'feed_settings' );
		add_action( 'admin_init', 'register_feed_settings' );
	}

	protected function addshortcode() {
		add_shortcode( 'embed-facebook', 'facebook_shortcode' );
		add_shortcode( 'embed-twitter', 'twitter_shortcode' );
		add_shortcode( 'embed-stack', 'stackoverflow_shortcode' );
	}
}

$socialfeed = new Socialfeed();

function register_feed_settings() {
	register_setting( 'feed_options-group', 'feed_options_fbjs' ); //facebook
	register_setting( 'feed_options-group', 'feed_options_fbcode' ); //...
	register_setting( 'feed_options-group', 'feed_options_tweetcode' ); //twitter
	register_setting( 'feed_options-group', 'feed_options_stackcode' ); //stackoverflow
}

function feed_settings() {
    add_options_page( 'Social Feed', 'Social Feed', 'manage_options', 'feed-settings', 'feed_options' );
}

function feed_options() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have sufficient permissions to access this page!.' );
	} ?>
	
	<div class="wrap">
		<h1>General Settings</h1>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'feed_options-group' );
			do_settings_fields( 'feed_options-group', '' );
			?>
			<table class="form-table">
				<tbody>
					<!--facebook-->
					<tr>
						<th scope="row"><label for="feed_options_fbjs">Facebook JavaScript SDK</label></th>
						<td>
							<p>Get code from <a href='https://developers.facebook.com/docs/plugins/page-plugin/'>Facebook Developers Page(Social Plugin) </a><br />
							<textarea id="feed_options_fbjs" name="feed_options_fbjs" placeholder="Javascript SDK" rows="5" cols="45"><?php echo get_option( 'feed_options_fbjs' ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="feed_options_fbcode">Facebook ShortCode HTML</label></th>
						<td>
							<textarea id="feed_options_fbcode" name="feed_options_fbcode" placeholder="Paste HTML code here" rows="5" cols="45"><?php echo get_option( 'feed_options_fbcode' ); ?></textarea><br />
						<i>Use this code </i><code>[embed-facebook]</code><i> anywhere in your<br />pages or posts</i>
						</td>
					</tr>

					<!--twitter-->
					<tr>
						<th scope="row"><label for="feed_options_tweetcode">Twitter Embed Code</label></th>
						<td><p>Get code from <a href="https://twitter.com/settings/widgets/new/user">Publish Twitter</a> to your website.</p>
							<textarea id="feed_options_tweetcode" name="feed_options_tweetcode" placeholder="Embed code" rows="5" cols="45"><?php echo get_option( 'feed_options_tweetcode' ); ?></textarea><br />
						<i>Use this code </i><code>[embed-twitter]</code> <i>to display in any pages<br />or posts</i>
						</td>
					</tr>

					<!--stackoverflow-->
					<tr>
						<th scope="row"><label for="feed_options_stackcode">Stack Overflow Embed code</label></th>
						<td><p>Get code from <a href="http://stackoverflow.com/users/flair">User Flair</a> to your website.</p>
							<textarea id="feed_options_stackcode" name="feed_options_stackcode" placeholder="Embed code" rows="5" cols="45"><?php echo get_option( 'feed_options_stackcode' ); ?></textarea><br />
						<i>Use this code </i><code>[embed-stack]</code> <i>to display in any pages<br />or posts</i>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>

	<?php
}

add_action( 'wp_head', function () {
	echo get_option( 'feed_options_fbjs' );
});