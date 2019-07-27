=== Embla ===
Contributors: poena
Requires at least: 4.7
Tested up to: 5.2
Requires PHP: 5.2
Sable tag: 1.4
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Copyright: Carolina Nymark 2017-2019.

In norse mythology Embla was the first woman, created by the gods.

== Description ==
Embla is a responsive theme with a grid layout that focuses on your latest posts. 
It has a footer widget area with room for all your widgets and two custom widgets for recent posts and comments. 
The theme also has support for full width content, a video header and logo. 
Embla will always be free for you to use and customize. 
You can ask for support or request new features in the support forum.


== License ==
Embla WordPress Theme, Copyright Carolina Nymark 2017-2019.

Embla is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Installation ==
	
1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Options ==
All options are in the Customizer.

Fonts
Select fonts for body text and titles.

Colors
Header Text Color. Changes the color of the site title and tagline.
The theme has a custom option to change the accent color. This color is mainly used for links.

Custom theme options
Hide the next and previous post navigation for single posts.
Hide the footer credit links. 
Display meta information (author, category, date) in archives. This information is hidden by default.

Site icon
Select an icon, it's color and where to display it. The icon is site wide. The footer icon also includes a link back to the top of the page.

Homepage sections
When the homepage is displaying a static page, you can select or create up to 3 pages to combine them on the homepage.

Full width posts or pages
The theme supports full width content. When you use one of the full width settings in the new editor, the border around the post content is hidden.

Menus
The theme has two menus. The main menu supports 3 levels, while the social menu only supports one level.
You can disable the priority menu and change menu icons in the customizer.
To show social icons in the footer, create a menu with your social links, then add it to the "Social Menu (Footer)" menu location. The icons will display automatically.

Custom template
The theme includes a blank custom page template. You can use this template if you only want to show your editor blocks or if you want to use a page builder. 
Does not show the header, footer, footer widget area or post navigation.

Custom widgets
The theme has two custom widgets.
The Embla: Recent Comments widget shows excerpts of your most recent comments.
The Embla: Recent Posts With Featured Images widget shows your most recent posts with featured images.

== Changelog ==

= 1.4- July 27 2019 =
Minor changes to the width of the column block, to work better on tablets.
Simplified CSS to remove duplicate styles.
Added more spacing around the Jetpack breadcrumbs.
Increased the font size.
Fixed a CSS problem with page titles and with css transitions for the menu.
Made sure that the svg icons are only loaded when they are actually used.
Removed google plus since this has been discontinued.

= 1.3- June 8 2019 =
Added support for wp_body_open.
Added missing role="main" to the main sections of the template files.

= 1.2- March 9 2019 =
Added font options.
Arranged the customizer options in new sections.
Added GPL license file.
New text added to the screenshot to follow the review requirements.


= 1.1- February 24 2019 =
Added an option to disable to priority menu and show the menu button instead.
Added an option where you can choose between two menu icons or displaying the default button with the text "Menu".


= 1.0- January 3 2019 =
Updated some broken links in the readme.
Updated version numbers for styles and scripts to make sure that the correct files, and not the cached files, are loaded.
Only include the styles for WooCommerce and BBPress if the plugins are active.
Moved WooCommerce, BBPress and print styles to separate files.
Minor style changes for WooCommerce. Increased color contrast. Added underlines to some links, and made input fields larger.
Moved the script for the skip link, to reduce the number of render blocking scripts.

= 0.9- December 2 2018 =
Fixed two problem with the social menu, including adding a missing icon for email.
Fixed a problem with image block widths.
Added rtl style sheet.
Added support for responsive embeds.
Removed styles for the subheading block since this has been removed from the block editor.
Increased text color contrast for some of the blocks, and made sure that the links in the button block are underlined.
Code style changes to better comply with WordPress coding standards. Updated readme.txt file.
Added support and rating links to the customizer.

= 0.8- October 12 2018 =
Made more functions pluggable to make it easier to create child themes.
Style improvements to match the theme with the new and the classic editor, and for BBPress and Jetpack.
Made sure that longer post titles does not overflow the post area, 
but displays over multiple rows instead.
Changed the post pagination style to wrap over 3 lines on mobile/handheld devices 
to make the clickable areas larger and since the longer line sometimes created a scroll.
Removed blocks.css, the styles are now part of style.css
Housekeeping: Validated html, updated links.

= 0.7- July 8 2018 =
Added theme support for Gutenberg wp-block-styles to better match the editor. 
Updated the editor color palette theme support to match the current version of Gutenberg.
See https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
Minor CSS changes to image captions, to make them responsive.
Updated content width from 700px to 720px.
Added a link to the privacy policy page to the footer. See https://developer.wordpress.org/themes/theme-privacy/

= 0.6- July 7 2018 =
Wrapped the customizer icon functions in if function_exists so that child themes may add their own icon sets.

= 0.5- June 6 2018 =
Fixed a problem with a link in the recent comments widget.
Wrapped the footer credit in a function and moved it to functions.php

= 0.4- February 17 2018 =
Improved escaping.
Fixed issues with excerpts in the admin.
Added the accessibility-ready tag.
Fixed two issues with the menu. Sub menu items are now hidden on smaller screens unless the menu button is used.
Added additional social icons.

= 0.3- February 13 2018 =
Fixed two issues with the menu.

= 0.2- February 7 2018 =
The header and footer icon is no longer displayed by default.
Added add_theme_support( 'align-wide' ) 
Added add_theme_support( 'editor-color-palette' )
Css improvements for full width contents and for the responsive version.
Improved support for Jetpack.
Updated readme and fixed typos.

= 0.1- December 9 2017 =
* Initial release

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2018 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Based on Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Based on Twenty Nineteen WordPress Theme, Copyright 2018 WordPress.org, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2015 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* Checkbox sanitization Copyright (c) 2015, WordPress Theme Review Team, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
* Keyboard Accessible Dropdown Menus Copyright 2013 Amy Hendrix, Graham Armfield [MIT](https://opensource.org/licenses/MIT) 
  https://github.com/sabreuse/accessible-menus
* Font Awesome icons, Copyright Dave Gandy License: SIL Open Font License, version 1.1. Source: https://fontawesome.io/
* Dashicons, Copyright 2015 WordPress.org. Dashicons is licensed under GPLv2, or any later version with font exception. https://github.com/WordPress/dashicons
* Customizer pro button, licensed under the GNU GPL, version 2 or later. Copyright Justin Tadlock 2016. https://github.com/justintadlock/trt-customizer-pro

Thank you:
https://aristath.github.io/blog/modifying-wordpress-customizer


https://www.flickr.com/photos/internetarchivebookimages/17949767841/
in/photolist-w9hvzp-tmafBT-of1RJt-outH2N