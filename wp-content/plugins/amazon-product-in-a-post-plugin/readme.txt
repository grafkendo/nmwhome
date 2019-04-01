=== Amazon Product in a Post Plugin ===

Plugin Name: Amazon Product in a Post
Contributors: prophecy2040
Tags: Amazon, Affiliate, Product, Products, Post, Page, Custom Post Type, Quick Post, Amazon Associate, Monetize, ASIN, Amazon.com, Shortcode, FAQs, Store, eCommerce, Kindle
Donate link: https://www.fischercreativemedia.com/donations/
Requires at least: 4.5
Tested up to: 4.9.8
Requires PHP: 5.4.0
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add formatted Amazon Products to any page or post by using Amazon ASIN. Great for monetizing your site. Uses Amazon Product Advertising Keys (FREE)

== Description ==
The Amazon Product In a Post plugin can be used to quickly add formatted Amazon Products/Items to any page or post by using just the Amazon product ASIN.

## How it Works: ##
The plugin uses the Amazon Product Advertising API to get product information from Amazon to display on your site. To use the plugin, you must have:
1. An Amazon Affiliate Account
2. Amazon Product Advertising API keys (Root Keys Only). 

## NOTICE May 1, 2018 ##
**As of May 1st 2018, Amazon requires you have your affiliate account fully approved before they will grant you access to the Amazon Product Advertising API. This means that you many not be able to use the plugin immediately until you receive access to the API.**

If you do not have an Amazon Affiliate Account or Amazon Product Advertising API Keys already, it is free and not too extremely difficult to set up (takes about 15 min. total for both). Once you have an account, install the plugin, enter your Amazon Associate ID and API keys in the Plugin Settings page and you are ready to start adding products to your website!

**Amazon's Product Advertising API Terms of Use requires you have an AWS Access Key ID and Secret Access Key of your own to use.** See **Plugin FAQs** or **Getting Started** page for links to sign up.

## With this plugin you can: ##
* Add any Amazon product or item to an existing Post (or Page) or custom Post Type.
* Monetize your blog posts with custom Amazon Product and add your own Reviews, descriptions or any other thing you would normally want to add to a post – and still have the Amazon product there.
* Easily add only the items that are right for your site.
* Add the product to the TOP of the post content, the BOTTOM of the post content, or make the post content become part of the product layout (see screenshots for examples)
* You can add as many products as you want to any existing page/post content using Shortcodes – see Installation or FAQ page for details.

## Features: ##
* Preformmated display of Amazon Products for easy integration (with various settings)
* Shortcodes for Adding Products, Product Elements, Product Grids, etc.
* Add new Page/Post  at the same time with "New Amazon Post" feature
* You can add Product Grid Layouts, Single Product Layouts or Individual Product Elements to Pages/Posts
* Option to create multiple Pages/Posts from ASINs with Amazon product data auto populated (no need to add separate products)
* Products can use the Standard product page URL or "Add to Cart" URL (i.e., 90 day Cookie Conversions)
* Links can be set to open in a new window/tab
* Custom styling options (via CSS in the settings)
* Lightbox functionality for larger image popups and additional images (can be disabled).
* Adjustable Caching of product data to limit API Calls
* Test feature for verifying Amazon settings are properly set up
* Debugging Information for troubleshooting issues

## Known Issues: ##
* The more products you add, the more overhead there is for API requests. The caching system tries to optimize the number of requests by grouping the them, instead of doing them individually.
* **Amazon OneLink** scripts may cause some links not to work correctly by over-riding the standard prduct link. If you use OneLink scripts on your site and still want tp add products, try to limit the Amazon OneLink scripts to pages where you will not include poducts.
* **Amazon Ads** may also cause some links not to works correctly. This is the same as for Amazon OneLink.
* **Some Products or Product data is not available via the Amazon Product Advertising API.** A perfect case in point, is Amazon Kindle pricing. When this happens, the product will not be displayed, or the requested element will not be displayed in the product output.
* You must have at least one referral sale every 90 days or you will lose your Amazon Product Advertising Account. If this happens, Amazon will deactivate your Amazon Product Advertising Account and the plugin will no longer display products. You can simply re-sign up for access and change your Amazon Keys in the settings and they will return (products shortcodes and settings are not deleted, they just cannot be displayed).


== Frequently Asked Questions ==
See the Installation Page for details on setting up the Products. There is a dynamic FAQs feed in the plugin that will allow for adding new FAQs as they come up. More detailed FAQs will come as questions and solutions arise.
= Will you support Blocks for New Guttenberg Editor? =
* Yes! We are finalizing them now and hope to roll them out prior to WordPress 5.0 Rollout.
* Our goal is to have blocks for all shortcodes (amazon-grid, amazon-elements, amazon-search and amazonproduct) and the main product (non-shortcode, currently the 'meta-box' default option) with the ability to make easy customizations to the product layout/elements. Our early tests are looking/working great!
* Anyone still wanting to use the Classic Editor will be able to still use shortcodes like they currently do, and you can use shortcodes in Gutenberg by using the core 'shortcode' block that is included with the editor.

= What do I need to do to get started? =
* You need to have an Amazon Affiliate Account and you have to register for the Amazon Product Advertising API to get a set of access Keys to put in the pluign. That allows the plugin to make calls to Amazon to get Product Data and pricing.
* Version 3.5.1+ has a Getting Started page that helps you through the Amazon Signup for your Amazon Access Keys. Install the plugin and go to the Getting Started Page in the plugin menu for more information.

= Great Plugin! How do I donate to the cause? = 
* Excellent question! The plugin is provided free to the public - you can use it however you like - where ever you like - you can even change it however you like. Should you decide that the plugin has been a great help and want to donate to our plugin development fund, you may do so [here](https://www.fischercreativemedia.com/donations/ "here").

== Installation ==
After you install the plugin, you need to set up your Amazon Affiliate/Associate ID in the Options panel located in the AMAZON PRODUCT menu under PLUGIN SETTING. 

An AWS Access Key ID and Secret Access Key REQUIRED. You MUST use the ROOT keys and not the User or Group Keys that Amazon recommends. See the plugin **Getting Started** page for additional setup instructions.

No additional adjustments are needed unless you want to configure your own CSS styles. Styles can be adjusted or removed in the Options Panel as well.

== Screenshots ==
1. Amazon Products displayed on a page with the Post Content as part of the product (option 3 when setting up product)
2. Custom Product Layout. Using amazon-elements shortcode for custom look. (with adjusted default plugin styles)
3. Sample Basic Shortcode Usage Layout. Note Kindle Products Message. (Amazon does not add Kindle prices in the API)
4. Amazon Quick Product Post option. Adds basic information needed for a product. Automatically creates corresponding Post/Page/Post Type for product
5. Plugin Menu (updated and renamed in 3.5.1). (Previously called Amazon PIP)
6. Shortcodes to allow multiple products in content - also can be used to add any product data if you want to layout your own page.
7. Plugin Options Panel part 1.
8. Plugin Options Panel part 2.
9. Admin post/page edit box used for adding a product.
10. Shortcode Usage Page. Outlines how to use the shortcodes for different setups.
11. Getting Started Page. Walks you through how to get and set up the Amazon Product API keys for the plugin.
12. FAQs and Help Page. FAQs are on a feed to make it easy for us to add new FAQs if there are common problems.
13. Amazon Cache Page. Allows you to see and delete cached product data.

== Changelog ==
= 4.0.3.3 =
* This is more of a 'clean-up' update to fix little things, removed unused items and add helper items in anticipation of Gutenberg update.
* **Removed:** Removed old styles that were no longer in use. (9/5/2018)
* **Removed:** Removed old scripts in amazon-admin.js that were no longer in use. (9/5/2018)
* **Removed:** Removed Default styles option from database - no longer needed. (9/5/2018)
* **Added:** Added new styles for HTML buttons and grid items. (9/7/2018)
* **Added:** Added default button style to amazon-grid.css. (9/7/2018)
* **Added:** Added HiResImage to result array for access to hires images if available. (9/8/2018)
* **Added:** Added Filters to result array images: 'amazon-product-main-image-sm', 'amazon-product-main-image-md', 'amazon-product-main-image-lg', 'amazon-product-main-image-hi'. (9/8/2018)
* **Added:** Added libxml_use_internal_errors(true) to xml parsing for better error handeling. (9/8/2018)
* **Added:** Added new HTML button replacement to all shortcodes. See Button Settings in plugin settings for usage. (9/10/2018)
* **Added:** Added some missing options to remove on uninstall when 'remove all traces' is checked. (9/10/2018)
* **Update:** Updated Test API call with defined constants instead of option calls. (9/7/2018)
* **Update:** Updated Test API call keywords and call to random product and page for different results. (9/7/2018)
* **Update:** Updated Test API call Response Group because Large was not needed. (9/7/2018)
* **Update:** Updated Test API call Debug checks and Error notice outputs on falure. (9/7/2018)
* **Update:** Updated script enqueue order so custom styles load after other plugin styles. (9/9/2018)
* **Bug Fix:** Fixed internal use filters for adding shortcode tabs and content to Shortcode Usage Page. (9/10/2018)
* **Bug Fix:** Fixed shortcode product filters - were filtering entire result array each time instead of just current product.  (9/10/2018)

= 4.0.3.2 =
* **Bug Fix:** Fixed some translations that were not correctly set up. (9/2/2018)
* **Bug Fix:** Fixed double filter application on some product label elements. (9/2/2018)
* **Bug Fix:** Fixed admin style/js enqueue on translation loading. (9/2/2018)
* **Bug Fix:** Fixed translations loading issue that was preventing languages from loading. (9/2/2018)
* **Removed:** Removed some JavaScript debug console logging that was still present but not needed. (9/2/2018)
* **Admin Style Change:** Fixed CSS layout on shorcode help pages. (9/2/2018)

= 4.0.3.1 =
* **Update:** Removed debug code that made it into production version. (8/29/2018)

= 4.0.3 =
* **Bug Fix:** Fixed many Undefined Variables and Undefined Index Warnings/Notices. (8/29/2018)
* **Bug Fix:** Traslation file was not being loaded correctly. Made adjustment to hopefully fix issues. (8/22/2018)
* **Bug Fix:** Fix "Empty Needle" Warning in amazon-product-in-a-post-aws-signed-request.php when string check was blank. (08/20/2018)
* **Bug Fix:** Fix to Cache Ahead functionality. Was calling additional requests in some cases when it should have always used available cache. (08/20/2018)
* **Bug Fix:** Fix to shortcode locale parameter usage. Was not changing when a different locale was added via shortcode. (08/20/2018)
* **Update:** Translation files Updated. (08/30/2018)
* **Update:** Change to add alt text parameter to Main Image. Also includes new 'appip_alt_text_main_img' filter to change it if you do not want the default of 'Buy Now'. (08/22/2018)
* **Update:** Change to add alt text parameter to Additional Images. Also includes new 'appip_alt_text_gallery_img' filter to change it if you do not want the default of 'Img - [ASIN]'. (08/22/2018)
* **Update:** Change to add alt text parameter to button image and Additional Images. Also includes new 'appip_amazon_button_alt_text' filter to change it if you do not want the default of 'buy now'. (08/22/2018)
* **Addition:** Added Subscription Price/length for amazon-grid shortcode when item is a Magazine or other subscription (i.e., Kindle Subscriptions, etc.). Todo - add to other shortcodes. (08/30/2018)
* **Addition:** Added some new elements for Gutenberg (not yet active) in prep from WP 5.0 release. (08/23/2018)
* **Addition:** Added new filters - 'appip_metabox_context', 'appip_metabox_priority', 'appip_meta_posttypes_support' in prep for Gutenberg. See filters-and-hooks.txt for more info. (08/26/2018)

= 4.0.2 =
* **Bug Fix:** Fix to undefined variable '$appip_running_excerpt'. (07/25/2018)
* **Bug Fix:** Fix to uppercase shortcodes 'AMAZONPRODUCT' and 'AMAZONPRODUCTS' not being rendered correctly. (07/25/2018)
* **Bug Fix:** Fix to WP Error, fatal error response in request when transport fails and returns WP_Error object. (08/01/2018)

= 4.0.1 =
* **Bug Fix:** Fix Open in a New Window functionality - not working for amazonproducts shortcode. (07/18/2018)
* **Bug Fix:** Fix to 'nofollow' property in amazon-grid shortcode links. (07/18/2018)
* **Update:** Change to AMP styles - TODO: Add option to remove if desired. (07/19/2018)
* **Update:** WordPress 4.9.7 Compatibility (07/19/2018)

= 4.0.0 =
* **RELEASE:** This is the first Official Release Update since version 3.6.4. (06/01/2018)
* **Removed:** Tempoarily Removed Shortcode Editor Button - preparing for blocks with Gutenberg Editor and new Classic Editor button. (05/30/2018)
* **Feature Additon:** Added Setting for Future Addition of Amazon Mobile Popover. Will be fleshed out in upcoming version. (05/29/2018)
* **Feature Additon:** Amazon Featured Image Integration. This is for creating Amazon Products using the quick create method. Documentation to come.
* **Feature Additon:** Added SSL image Support. Should detect https automatically, but to force SSL images, use the option in the advanced settings.
* **Update:** Updated options to allow Amazon Featured Image to be turned on or off. (05/28/2018)
* **Update:** Re-wrote the Debugging features to include more info about user install of WordPres and to allow sending debug info via email directly from settings page. (05/28/2018)
* **Update:** Renamed "Amazon PIP Options" to "Plugin Settings" in menu. (05/31/2018)
* **Update:** Fixed Instances of Developer URL to be https. (05/29/2018)
* **Update:** PHP7 Compatibility Update (04/30/2018)
* **Update:** Changed API Call to use `wp_remote_request` - works more consitantly than other methods.
* **Update:** Changed caching mechanism to better make use of 'cache ahead' functions. Reads all ASINs on the page load object prior to trying to load any individual calls so items are cached prior to load in blocks.
* **Update:** WordPress 4.9.4 Compatibility
* **Bug Fix:** Fix issue with Debugging System. (05/28/2018)
* **Bug Fix:** Fix issue with wp_remote call. (04/22/2018)
* **Bug Fix/Update:** Fixed image calls. No longer need old method to get images - does not work well with SSL images anyway.
* **Bug Fix:** Fix Content and Title creation on Amazon Post creation. Should work better and more consistantly.
* **Bug Fix:** Fixed CLEAN shortcode field parameter calls (i.e., 'title_clean') so they are more consistant.
* **Bug Fix:** Fix call to CURL function in some cases CURL lib has an SSL bug and needs additional settings.
* **Translations:** Updated English Translations and added a few settings related translations to French and Spanish. (05/29/2018)

== Upgrade Notice ==
= 4.0.3.3 =
* 4.0.3.3 - A 'clean-up' update to fix little things, removed unused items and add helper items in anticipation of Gutenberg update.

= 4.0.3.2 =
* 4.0.3.2 - Bug Fixes for Translations and other minor fixes.

= 4.0.3.1 =
* 4.0.3.1 - Removed debug code that made it into production version.

= 4.0.3 =
*  4.0.3 - 5 Bug Fixes including "Undefined Variable" Notices, 4 Updates including Alt text for images, 3 Additions including Gutenberg pre-rollout blocks code (Block should be available in version 4.0.4).