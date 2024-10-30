<?php
/*
    "WordPress Plugin Template" Copyright (C) 2014 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This following part of this file is part of WordPress Plugin Template for WordPress.

    WordPress Plugin Template is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    WordPress Plugin Template is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database Extension.
    If not, see http://www.gnu.org/licenses/gpl-3.0.html

	**********************************************************************************************************

	Plugin Name: iSnare Answers
	Plugin URI: https://www.isnare.org
	Version: 1.0
	Author: Glenn Prialde
	Description: Free question and answers website portal
	Text Domain: isnare-answers
	License: GPLv3
*/

$IsnareAnswers_minimalRequiredPhpVersion = '5.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function IsnareAnswers_noticePhpVersionWrong() {
    global $IsnareAnswers_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "iSnare Answers" requires a newer version of PHP to be running.',  'isnare-answers').
            '<br/>' . __('Minimal version of PHP required: ', 'isnare-answers') . '<strong>' . $IsnareAnswers_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'isnare-answers') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function IsnareAnswers_PhpVersionCheck() {
    global $IsnareAnswers_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $IsnareAnswers_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'IsnareAnswers_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function IsnareAnswers_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('isnare-answers', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// First initialize i18n
IsnareAnswers_i18n_init();


// Next, run the version check.
// If it is successful, continue with initialization for this plugin
if (IsnareAnswers_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('isnare-answers_init.php');
    IsnareAnswers_init(__FILE__);
}
