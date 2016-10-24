<?php
/**
 * Socialfeed
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
function facebook_shortcode() {
	echo get_option('feed_options_fbcode');
}

function twitter_shortcode() {
	?>
	<div style="
		max-width: 340px;
		max-height: 500px;
		overflow-y: auto;
	">
		<?php echo get_option('feed_options_tweetcode'); ?>
	</div>
	<?php
}

function stackoverflow_shortcode() {
	echo get_option('feed_options_stackcode');
}