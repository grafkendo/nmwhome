<?php
// Tools
global $appipBulidBox;
//ACTIONS
add_action( 'init', 'apipp_parse_new', 1 );
//add_action( 'admin_menu', create_function("$appipBulidBox","if( function_exists( 'add_meta_box' ))add_meta_box( 'amazonProductInAPostBox1', __( 'Amazon Product In a Post Settings', 'amazon-product-in-a-post-plugin' ), 'amazonProductInAPostBox1', 'post', 'normal', 'high' );"));
//add_action( 'admin_menu', create_function("$appipBulidBox","if( function_exists( 'add_meta_box' ))add_meta_box( 'amazonProductInAPostBox1', __( 'Amazon Product In a Post Settings', 'amazon-product-in-a-post-plugin' ), 'amazonProductInAPostBox1', 'page', 'normal', 'high' );"));
add_action( 'admin_menu', 'apipp_plugin_menu' );
add_action( 'network_admin_notices', 'appip_warning_notice' );
add_action( 'admin_notices', 'appip_warning_notice' );
add_filter( 'contextual_help', 'appip_plugin_help', 10, 3 );

//FUNCTIONS
function add_appip_meta_posttype_support( $posttypes = array() ) {
	if ( function_exists( 'add_meta_box' ) && function_exists( 'amazonProductInAPostBox1' ) ) {
		if ( is_array( $posttypes ) && !empty( $posttypes ) ) {
			$context = apply_filters('appip_metabox_context',( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) ? 'side' : 'normal');
			$priority = apply_filters('appip_metabox_priority',( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) ? 'default' : 'high');
			foreach ( $posttypes as $key => $type ) {
				add_meta_box( 'amazonProductInAPostBox_' . $type, __( 'Amazon Product In a Post Settings', 'amazon-product-in-a-post-plugin' ), 'amazonProductInAPostBox1', $type, $context, $priority );
			}
		}
	}
}

function appip_post_type_support() {
	$types = apply_filters( 'appip_meta_posttypes_support', array( 'page', 'post' ) );
	add_appip_meta_posttype_support( $types );
}
add_filter( 'admin_enqueue_scripts', 'appip_post_type_support', 20 );
function appip_add_product_meta_support($types =array()){
	$types[] = 'product';
	return $types;
}
add_filter( 'appip_meta_posttypes_support', 'appip_add_product_meta_support',10);


function appip_plugin_help( $contextual_help, $screen_id, $screen ) {
	$plugin_donate = 0;
	switch ( $screen_id ) {
		case 'toplevel_page_apipp-main-menu':
			$contextual_help = __( 'Plugin Settings Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp-add-new':
			$contextual_help = __( 'New Product Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp-main-menu':
			$contextual_help = __( 'Plugin Settings Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp_plugin_admin':
			$contextual_help = __( 'Plugin Settings Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp_plugin-shortcode':
			$contextual_help = __( 'Shortcode Usage Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp_plugin-faqs':
			$contextual_help = __( 'FAQs/Help Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
		case 'amazon-product_page_apipp-cache-page':
			$contextual_help = __( 'Product Cache Contextual Help Coming Soon.', 'amazon-product-in-a-post-plugin' );
			$plugin_donate = 1;
			break;
	}
	if ( $plugin_donate == 1 ) {
		$screen->add_help_tab( array( 'id' => 'appip_aboutus', 'title' => __( 'About Us', 'amazon-product-in-a-post-plugin' ), 'content' => '<p>' . __( 'Fischer Creative Media, LLC develops custom WordPress Themes and Plugins for clients who need a more individualized look, but still want the simplicity of a WordPress website.', 'amazon-product-in-a-post-plugin' ) ) );
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'amazon-product-in-a-post-plugin' ) . '</strong></p>' .
			'<p><a href="https://www.fischercreativemedia.com/donations/" target="_blank">' . __( 'Donate to this Plugin', 'amazon-product-in-a-post-plugin' ) . '</a></p>' .
			'<p><a href="https://www.fischercreativemedia.com/wordpress-plugins/" target="_blank">' . __( 'See Our Other WordPress Plugins', 'amazon-product-in-a-post-plugin' ) . '</a></p>'
		);
	}
	return $contextual_help;
}

function appip_warning_notice() {
	if ( isset( $_REQUEST[ 'dismissmsg' ] ) && $_REQUEST[ 'dismissmsg' ] == '1' ) {
		update_option( 'appip_dismiss_msg', 1 );
	}
	$appip_publickey = APIAP_PUB_KEY;
	$appip_privatekey = APIAP_SECRET_KEY;
	$appip_partner_id = APIAP_ASSOC_ID;
	$appip_dismiss = get_option( 'appip_dismiss_msg', 0 );
	if ( $appip_dismiss == 0 ) {
		if ( $appip_publickey == '' || $appip_privatekey == '' ) {
			echo '<div class="error" style="position:relative;"><h2><strong>' . __( 'Amazon Product in a Post Important Message!', 'amazon-product-in-a-post-plugin' ) . '</strong></h2><p>' . __( 'Please note: You need to add your Access Key ID and Secrect Access Key to the <a href="admin.php?page=apipp_plugin_admin">options page</a> before the plugin will display any Amazon Products!<a href="admin.php?page=apipp_plugin_admin&dismissmsg=1" style="position:absolute;top:0;right:0;padding:3px 10px;display:block;">dismiss</a>', 'amazon-product-in-a-post-plugin' ) . '</p></div>';
		} elseif ( $appip_partner_id == '' ) {
			echo '<div class="error" style="position:relative;"><h2><strong>' . __( 'Amazon Product in a Post Important Message!', 'amazon-product-in-a-post-plugin' ) . '</strong></h2><p>' . __( 'You need to enter your Amazon Partner ID in order to get credit for any products sold. <a href="admin.php?page=apipp_plugin_admin">enter your partner id here</a><a href="admin.php?page=apipp_plugin_admin&dismissmsg=1" style="position:absolute;top:0;right:0;padding:3px 10px;display:block;">dismiss</a>', 'amazon-product-in-a-post-plugin' ) . '</p></div>';
		}
	}
}

function apipp_parse_new() { //Custom Save Post items for Quick Add
	if ( isset( $_POST[ 'createpost' ] ) || isset( $_POST[ 'createpost_edit' ] ) ) { //form saved
		global $post;
		$teampappcats = array();
		$totalcategories = isset( $_POST[ 'post_category_count' ] ) ? absint( $_POST[ 'post_category_count' ] ) : 0;
		$post_stat = isset( $_POST[ 'post_status' ] ) ? sanitize_text_field( $_POST[ 'post_status' ] ) : 'draft';
		$post_type = isset( $_POST[ 'post_type' ] ) ? sanitize_text_field( $_POST[ 'post_type' ] ) : 'post';
		$splitASINs = isset( $_POST[ 'split_asins' ] ) && ( int )$_POST[ 'split_asins' ] == 1 ? true : false;
		$allowed_tags = wp_kses_allowed_html( $post_type );
		$ASIN = isset( $_POST[ 'amazon-product-single-asin' ] ) ? str_replace( ', ', ',', sanitize_text_field( $_POST[ 'amazon-product-single-asin' ] ) ) : '';
		$amzArr = array();
		$amzreq = '';

		if ( $ASIN != '' ) {
			$inCache = amazon_product_check_in_cache( $asin );
			$ASIN = ( is_array( $ASIN ) && !empty( $ASIN ) ) ? implode( ',', $ASIN ) : $ASIN; //valid ASIN or ASINs 
			$asinR = explode( ",", $ASIN );
			$asinArr = $asinR;
			$errors = '';
			if ( $inCache )
				$pxmlNew = amazon_plugin_aws_signed_request( APIAP_LOCALE, array( "Operation" => "ItemLookup", "ItemId" => $ASIN, "ResponseGroup" => "Large,Reviews,VariationSummary", "IdType" => "ASIN", "AssociateTag" => APIAP_ASSOC_ID, "RequestBy" => 'amazon-elements' ), APIAP_PUB_KEY, APIAP_SECRET_KEY, true );
			else
				$pxmlNew = amazon_plugin_aws_signed_request( APIAP_LOCALE, array( "Operation" => "ItemLookup", "ItemId" => $ASIN, "ResponseGroup" => "Large,Reviews,VariationSummary", "IdType" => "ASIN", "AssociateTag" => APIAP_ASSOC_ID, "RequestBy" => 'amazon-elements' ), APIAP_PUB_KEY, APIAP_SECRET_KEY );
			$totalResult1 = array();
			$totalResult2 = array();
			$errorsArr = array();
			$doedit = isset( $_REQUEST[ 'createpost_edit' ] ) && $_REQUEST[ 'createpost_edit' ] != '' ? true : false;
			$red_location = '';
			if ( is_array( $pxmlNew ) && !empty( $pxmlNew ) ) {
				$pxmle = array();
				foreach ( $pxmlNew as $pxmlkey => $pxml ) {
					if ( !is_array( $pxml ) ) {
						$pxmle = $pxml;
					} else {
						$r1 = appip_plugin_FormatASINResult( $pxml, 0, $asinR );
						if ( is_array( $r1 ) && !empty( $r1 ) ) {
							foreach ( $r1 as $ritem ) {
								$totalResult1[] = $ritem;
							}
						}
						$r2 = appip_plugin_FormatASINResult( $pxml, 1, $asinR );
						if ( is_array( $r2 ) && !empty( $r2 ) ) {
							foreach ( $r2 as $ritem2 ) {
								$totalResult2[] = $ritem2;
							}
						}
					}
				}
			}
		}
		if ( !empty( $pxmle ) ) {
			$pxml = $pxmle;
			return false;
		} else {
			$resultarr = array();
			$resultarr1 = isset( $totalResult1 ) && !empty( $totalResult1 ) ? $totalResult1 : array(); //appip_plugin_FormatASINResult( $pxml );
			$resultarr2 = isset( $totalResult2 ) && !empty( $totalResult2 ) ? $totalResult2 : array(); //appip_plugin_FormatASINResult( $pxml, 1 );
			if ( is_array( $resultarr1 ) && !empty( $resultarr1 ) ) {
				foreach ( $resultarr1 as $key1 => $result1 ):
					$mainAArr = ( array )$result1;
				$otherArr = ( array )$resultarr2[ $key1 ];
				$resultarr[ $key1 ] = ( array )array_merge( $mainAArr, $otherArr );
				ksort( $resultarr[ $key1 ] );
				endforeach;
			}
		}
		if ( is_array( $asinArr ) && !empty( $asinArr ) ) {
			foreach ( $asinArr as $checkASIN ) {
				foreach ( $resultarr as $resV ) {
					if ( isset( $resV[ 'ASIN' ] ) ) {
						//uses Amazon Title & Content if Title & Content is empty.
						$tasin = $resV[ 'ASIN' ];
						$tempCS = isset( $resV[ 'ItemDesc' ][ 0 ][ 'Source' ] ) ? $resV[ 'ItemDesc' ][ 0 ][ 'Source' ] : '';
						$tempCS = $tempCS == '' && isset( $resV[ 'ItemDesc' ][ 'Source' ] ) ? $resV[ 'ItemDesc' ][ 'Source' ] : $tempCS;
						$tempCT = isset( $resV[ 'ItemDesc' ][ 0 ][ 'Content' ] ) && $tempCS == 'Product Description' ? str_replace( array( '<![CDATA[', ']]>' ), array( '', '' ), $resV[ 'ItemDesc' ][ 0 ][ 'Content' ] ) : '';
						$tempCT = $tempCT == '' && isset( $resV[ 'ItemDesc' ][ 'Content' ] ) && $tempCS == 'Product Description' ? str_replace( array( '<![CDATA[', ']]>' ), array( '', '' ), $resV[ 'ItemDesc' ][ 'Content' ] ) : $tempCT;
						$temptitle = isset( $resV[ 'Title' ] ) ? $resV[ 'Title' ] : 'Product ' . $tasin;
						if ( $splitASINs && count( $asinArr ) > 1 ) {
							$postTitle = isset( $_POST[ 'post_title' ] ) && $_POST[ 'post_title' ] != '' ? sanitize_text_field( $_POST[ 'post_title' ] ) . ' (' . $tasin . ')': $temptitle;
							$asinContent = $tempCT != '' ? wp_kses( $tempCT, $allowed_tags ) : '';
							$manualContent = isset( $_POST[ 'post_content' ] ) && $_POST[ 'post_content' ] != '' ? wp_kses( $_POST[ 'post_content' ], $allowed_tags ) : '';
							$postContent = $manualContent != '' ? $manualContent : '';
							$postContent = $asinContent != '' ? $postContent . "\n" . $asinContent: $postContent;
							$postContent = $postContent == '' ? 'Content ' . $tasin : $postContent;
						} else {
							$postTitle = isset( $_POST[ 'post_title' ] ) && $_POST[ 'post_title' ] != '' ? sanitize_text_field( $_POST[ 'post_title' ] ) : $temptitle;
							$asinContent = $tempCT != '' ? wp_kses( $tempCT, $allowed_tags ) : '';
							$manualContent = isset( $_POST[ 'post_content' ] ) && $_POST[ 'post_content' ] != '' ? wp_kses( $_POST[ 'post_content' ], $allowed_tags ) : '';
							$postContent = $manualContent != '' ? $manualContent : '';
							$postContent = $asinContent != '' ? $postContent . "\n" . $asinContent: $postContent;
							$postContent = $postContent == '' ? 'Content ' . $tasin : $postContent;
						}
						$newProds[ $resV[ 'ASIN' ] ][ 'Title' ] = $postTitle;
						$newProds[ $resV[ 'ASIN' ] ][ 'Content' ] = $postContent;
						$postImage = isset( $resV[ 'LargeImage_URL' ] ) ? $resV[ 'LargeImage_URL' ] : '';
						$postImageH = $postImage != '' && isset( $resV[ 'LargeImage_Height_value' ] ) ? $resV[ 'LargeImage_Height_value' ] . 'px': '';
						$postImageH = $postImageH == '' && $postImage != '' && isset( $resV[ 'LargeImage_Height' ] ) ? $resV[ 'LargeImage_Height' ] . 'px': '';
						$postImageW = $postImage != '' && isset( $resV[ 'LargeImage_Width_value' ] ) ? $resV[ 'LargeImage_Width_value' ] . 'px': '';
						$postImageW = $postImageW == '' && $postImage != '' && isset( $resV[ 'LargeImage_Width' ] ) ? $resV[ 'LargeImage_Width' ] . 'px': '';
						$newProds[ $resV[ 'ASIN' ] ][ 'LargeImage_URL' ] = $postImage;
						$newProds[ $resV[ 'ASIN' ] ][ 'LargeImage_Height_value' ] = $postImageH;
						$newProds[ $resV[ 'ASIN' ] ][ 'LargeImage_Width_value' ] = $postImageW;
					}
				}
			}
		} else {
			$tasin = $ASIN;
			$tempCS = isset( $resultarr[ 'ItemDesc' ][ 0 ][ 'Source' ] ) ? $resultarr[ 'ItemDesc' ][ 0 ][ 'Source' ] : '';
			$tempCS = $tempCS == '' && isset( $resultarr[ 'ItemDesc' ][ 'Source' ] ) ? $resultarr[ 'ItemDesc' ][ 'Source' ] : '';
			$tempCT = isset( $resultarr[ 'ItemDesc' ][ 0 ][ 'Content' ] ) && $tempCS == 'Product Description' ? str_replace( array( '<![CDATA[', ']]>' ), array( '', '' ), $resultarr[ 'ItemDesc' ][ 0 ][ 'Content' ] ) : '';
			$tempCT = $tempCT == '' && isset( $resultarr[ 'ItemDesc' ][ 'Content' ] ) && $tempCS == 'Product Description' ? str_replace( array( '<![CDATA[', ']]>' ), array( '', '' ), $resultarr[ 'ItemDesc' ][ 'Content' ] ) : '';
			$temptitle = isset( $resultarr[ 'Title' ] ) ? $resultarr[ 'Title' ] : 'Product ' . $tasin;
			$postTitle = isset( $_POST[ 'post_title' ] ) && $_POST[ 'post_title' ] != '' ? sanitize_text_field( $_POST[ 'post_title' ] ) : $temptitle;
			$asinContent = $tempCT != '' ? wp_kses( $tempCT, $allowed_tags ) : '';
			$manualContent = isset( $_POST[ 'post_content' ] ) && $_POST[ 'post_content' ] != '' ? wp_kses( $_POST[ 'post_content' ], $allowed_tags ) : '';
			$postContent = $manualContent != '' ? $manualContent : '';
			$postContent = $asinContent != '' ? $postContent . "\n" . $asinContent: $postContent;
			$postContent = $postContent == '' ? 'Content ' . $tasin : $postContent;
			$newProds[ $resultarr[ 'ASIN' ] ][ 'Title' ] = $postTitle;
			$newProds[ $resultarr[ 'ASIN' ] ][ 'Content' ] = $postContent;
			//$postImage 		= isset($resultarr['LargeImage_URL']) ? $resultarr['LargeImage_URL'] : '';
			$postImage = isset( $resV[ 'LargeImage_URL' ] ) ? $resV[ 'LargeImage_URL' ] : '';
			$postImageH = $postImage != '' && isset( $resV[ 'LargeImage_Height_value' ] ) ? $resV[ 'LargeImage_Height_value' ] . 'px': '';
			$postImageH = $postImageH == '' && $postImage != '' && isset( $resV[ 'LargeImage_Height' ] ) ? $resV[ 'LargeImage_Height' ] . 'px': '';
			$postImageW = $postImage != '' && isset( $resV[ 'LargeImage_Width_value' ] ) ? $resV[ 'LargeImage_Width_value' ] . 'px': '';
			$postImageW = $postImageW == '' && $postImage != '' && isset( $resV[ 'LargeImage_Width' ] ) ? $resV[ 'LargeImage_Width' ] . 'px': '';
			$newProds[ $resultarr[ 'ASIN' ] ][ 'LargeImage_URL' ] = $postImage;
			$newProds[ $resultarr[ 'ASIN' ] ][ 'LargeImage_Height_value' ] = $postImageH;
			$newProds[ $resultarr[ 'ASIN' ] ][ 'LargeImage_Width_value' ] = $postImageW;
		}

		if ( $splitASINs && count( $asinArr ) > 1 ) {
			$createdpostid = array();
			foreach ( $asinArr as $checkASIN ) {
				$postTitle = isset( $newProds[ $checkASIN ][ 'Title' ] ) ? $newProds[ $checkASIN ][ 'Title' ] : 'Product ' . $checkASIN;
				$postContent = isset( $newProds[ $checkASIN ][ 'Content' ] ) ? '<!-- Amazon Product Description-->[amazon-element asin="' . $checkASIN . '" field="desc"]' /*$newProds[$checkASIN]['Content'] */: '<!-- Amazon Description could not be added for: ' . $checkASIN . '-->'; /*'Content '. $checkASIN;*/
				$postImage = isset( $newProds[ $checkASIN ][ 'LargeImage_URL' ] ) ? $newProds[ $checkASIN ][ 'LargeImage_URL' ] : '';
				$postImageH = $postImage != '' && isset( $newProds[ $checkASIN ][ 'LargeImage_Height_value' ] ) ? $newProds[ $checkASIN ][ 'LargeImage_Height_value' ] . 'px': '';
				$postImageW = $postImage != '' && isset( $newProds[ $checkASIN ][ 'LargeImage_Width_value' ] ) ? $newProds[ $checkASIN ][ 'LargeImage_Width_value' ] . 'px': '';
				if ( isset( $_POST[ 'post_category' ][ $post_type ] ) && is_array( $_POST[ 'post_category' ][ $post_type ] ) && !empty( $_POST[ 'post_category' ][ $post_type ] ) ) {
					foreach ( $_POST[ 'post_category' ][ $post_type ] as $key => $val ) {
						$post_array = array(
							'post_author' => ( isset( $_POST[ 'post_author' ] ) ? absint( $_POST[ 'post_author' ] ) : '' ),
							'post_title' => $postTitle,
							'post_status' => $post_stat,
							'post_type' => $post_type,
							'post_content' => $postContent,
						);
						$createdpostid[ $checkASIN ] = wp_insert_post( $post_array );
						$val = array_unique( array_map( 'intval', $val ) );
						if ( $postImage != '' ) {
							$featured_key = apply_filters( 'amazon_featured_post_meta_key', '_amazon_featured_url' );
							$featured_h_key = '_amazon_featured_height';
							$featured_w_key = '_amazon_featured_width';
							$alt_key = '_amazon_featured_alt';
							$postid = $createdpostid[ $checkASIN ];
							delete_post_meta( $postid, $featured_key );
							delete_post_meta( $postid, $featured_h_key );
							delete_post_meta( $postid, $featured_w_key );
							delete_post_meta( $postid, $alt_key );
							update_post_meta( $postid, $featured_key, $postImage, true );
							if ( $postImageH != '' )
								update_post_meta( $postid, $featured_h_key, $postImageH, true );
							if ( $postImageW != '' )
								update_post_meta( $postid, $featured_w_key, $postImageW, true );
							if ( $postTitle != 'Product ' . $checkASIN )
								update_post_meta( $postid, $alt_key, $postTitle, true );
						}
						$tesrr = wp_set_post_terms( $createdpostid, $val, $key, false );
					}
				} else {
					$post_array = array(
						'post_author' => sanitize_text_field( $_POST[ 'post_author' ] ),
						'post_title' => $postTitle,
						'post_status' => $post_stat,
						'post_type' => $post_type,
						'post_content' => $postContent,
						'post_parent' => 0,
						'post_category' => ''
					);
					$createdpostid[ $checkASIN ] = wp_insert_post( $post_array, 'false' );
					if ( $postImage != '' ) {
						$featured_key = apply_filters( 'amazon_featured_post_meta_key', '_amazon_featured_url' );
						$featured_h_key = '_amazon_featured_height';
						$featured_w_key = '_amazon_featured_width';
						$alt_key = '_amazon_featured_alt';
						$postid = $createdpostid[ $checkASIN ];
						delete_post_meta( $postid, $featured_key );
						delete_post_meta( $postid, $featured_h_key );
						delete_post_meta( $postid, $featured_w_key );
						delete_post_meta( $postid, $alt_key );
						update_post_meta( $postid, $featured_key, $postImage, true );
						if ( $postImageH != '' )
							update_post_meta( $postid, $featured_h_key, $postImageH, true );
						if ( $postImageW != '' )
							update_post_meta( $postid, $featured_w_key, $postImageW, true );
						if ( $postTitle != 'Product ' . $checkASIN )
							update_post_meta( $postid, $alt_key, $postTitle, true );
					}
				}
			}
			if ( is_array( $createdpostid ) && !empty( $createdpostid ) ) {
				foreach ( $createdpostid as $key => $pid ) {
					$newpost = get_post( $pid );
					ini_set( 'display_errors', 0 );
					amazonProductInAPostSavePostdata( $pid, $newpost, $key );
				}
				$red_location = "Location: admin.php?page=apipp-add-new&appmsg=1&qty=" . count( $createdpostid );
				$red_pid = $createdpostid;

				//header( "Location: admin.php?page=apipp-add-new&appmsg=1&qty=".count($createdpostid) );
				//exit();
			} else {
				$red_location = "Location: admin.php?page=apipp-add-new&appmsg=2";
				$red_pid = 0;
				//header( "Location: admin.php?page=apipp-add-new&appmsg=2" );
				//exit();
			}

		} else {
			$postTitle = isset( $newProds[ $asinArr[ 0 ] ][ 'Title' ] ) ? $newProds[ $asinArr[ 0 ] ][ 'Title' ] : '';
			$postContent = isset( $newProds[ $asinArr[ 0 ] ][ 'Content' ] ) ? '<!-- Amazon Product Description-->[amazon-element asin="' . $asinArr[ 0 ] . '" field="desc"]' /*$newProds[$checkASIN]['Content'] */: '<!-- Amazon Description could not be added for: ' . $asinArr[ 0 ] . '-->'; /*'Content '. $checkASIN;*/
			//$postContent 	= isset($newProds[$asinArr[0]]['Content']) ? $newProds[$asinArr[0]]['Content'] : 'Content '. $asinArr[0];
			$postImage = isset( $newProds[ $asinArr[ 0 ] ][ 'LargeImage_URL' ] ) ? $newProds[ $asinArr[ 0 ] ][ 'LargeImage_URL' ] : '';
			$postImageH = $postImage != '' && isset( $newProds[ $asinArr[ 0 ] ][ 'LargeImage_Height_value' ] ) ? $newProds[ $asinArr[ 0 ] ][ 'LargeImage_Height_value' ] . 'px': '';
			$postImageW = $postImage != '' && isset( $newProds[ $asinArr[ 0 ] ][ 'LargeImage_Width_value' ] ) ? $newProds[ $asinArr[ 0 ] ][ 'LargeImage_Width_value' ] . 'px': '';
			if ( isset( $_POST[ 'post_category' ][ $post_type ] ) ) {
				foreach ( $_POST[ 'post_category' ][ $post_type ] as $key => $val ) {
					$post_array = array(
						'post_author' => ( isset( $_POST[ 'post_author' ] ) ? absint( $_POST[ 'post_author' ] ) : '' ),
						'post_title' => $postTitle,
						'post_status' => $post_stat,
						'post_type' => $post_type,
						'post_content' => $postContent,
					);
					$createdpostid = wp_insert_post( $post_array );
					$val = array_unique( array_map( 'intval', $val ) );
					if ( $postImage != '' ) {
						$featured_key = apply_filters( 'amazon_featured_post_meta_key', '_amazon_featured_url' );
						$featured_h_key = '_amazon_featured_height';
						$featured_w_key = '_amazon_featured_width';
						$alt_key = '_amazon_featured_alt';
						$postid = $createdpostid;
						delete_post_meta( $postid, $featured_key );
						delete_post_meta( $postid, $featured_h_key );
						delete_post_meta( $postid, $featured_w_key );
						delete_post_meta( $postid, $alt_key );
						update_post_meta( $postid, $featured_key, $postImage, true );
						if ( $postImageH != '' )
							update_post_meta( $postid, $featured_h_key, $postImageH, true );
						if ( $postImageW != '' )
							update_post_meta( $postid, $featured_w_key, $postImageW, true );
						if ( $postTitle != 'Product ' . $asinArr[ 0 ] )
							update_post_meta( $postid, $alt_key, $postTitle, true );
					}
					$tesrr = wp_set_post_terms( $createdpostid, $val, $key, false );
				}
			} else {
				$post_array = array(
					'post_author' => sanitize_text_field( $_POST[ 'post_author' ] ),
					'post_title' => $postTitle,
					'post_status' => $post_stat,
					'post_type' => $post_type,
					'post_content' => $postContent,
					'post_parent' => 0,
					'post_category' => ''
				);
				$createdpostid = wp_insert_post( $post_array, 'false' );
				if ( $postImage != '' ) {
					$featured_key = apply_filters( 'amazon_featured_post_meta_key', '_amazon_featured_url' );
					$featured_h_key = '_amazon_featured_height';
					$featured_w_key = '_amazon_featured_width';
					$alt_key = '_amazon_featured_alt';
					$postid = $createdpostid;
					delete_post_meta( $postid, $featured_key );
					delete_post_meta( $postid, $featured_h_key );
					delete_post_meta( $postid, $featured_w_key );
					delete_post_meta( $postid, $alt_key );
					update_post_meta( $postid, $featured_key, $postImage, true );
					if ( $postImageH != '' )
						update_post_meta( $postid, $featured_h_key, $postImageH, true );
					if ( $postImageW != '' )
						update_post_meta( $postid, $featured_w_key, $postImageW, true );
					if ( $postTitle != 'Product ' . $asinArr[ 0 ] )
						update_post_meta( $postid, $alt_key, $postTitle, true );
				}
			}
			if ( $createdpostid != '' ) {
				$newpost = get_post( $createdpostid );
				ini_set( 'display_errors', 0 );
				amazonProductInAPostSavePostdata( $createdpostid, $newpost, $asinArr[ 0 ] );
				$red_location = "Location: admin.php?page=apipp-add-new&appmsg=1&asins=" . implode( ",", $asinArr );
				$red_pid = $createdpostid;
				//header("Location: admin.php?page=apipp-add-new&appmsg=1&asins=".implode(",",$asinArr));
				//exit();
			} else {
				$red_location = "Location: admin.php?page=apipp-add-new&appmsg=2";
				$red_pid = 0;
				//header("Location: admin.php?page=apipp-add-new&appmsg=2");
				//exit();
			}
		}

		if ( is_array( $red_pid ) && $red_location != '' ) {
			header( $red_location );
			exit();
		} elseif ( $red_pid != 0 ) {
			if ( $doedit ) {
				$red_location = "Location: post.php?post={$red_pid}&action=edit";
				header( $red_location );
				exit();
			} else {
				header( $red_location );
				exit();
			}
		} else {

		}


	} else {
		add_action( 'save_post', 'amazonProductInAPostSavePostdata', 1, 2 ); // save the custom fields
	}
}

/* When the post is saved, saves our custom data */
function amazonProductInAPostSavePostdata( $post_id, $post, $asin = '' ) {
	if ( !isset( $_POST[ 'post_save_type_apipp' ] ) )
		return;
	$post_id = $post_id == '' ? $post->ID : $post_id;
	$mydata = array();
	$mydata[ 'amazon-product-isactive' ] = isset( $_POST[ 'amazon-product-isactive' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-isactive' ] ) : '0';
	$mydata[ 'amazon-product-content-location' ] = isset( $_POST[ 'amazon-product-content-location' ][ 1 ][ 0 ] ) ? sanitize_text_field( $_POST[ 'amazon-product-content-location' ][ 1 ][ 0 ] ) : '1';
	$mydata[ 'amazon-product-single-asin' ] = $asin != '' ? $asin : ( isset( $_POST[ 'amazon-product-single-asin' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-single-asin' ] ) : '' );
	$mydata[ 'amazon-product-excerpt-hook-override' ] = isset( $_POST[ 'amazon-product-excerpt-hook-override' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-excerpt-hook-override' ] ) : '3';
	$mydata[ 'amazon-product-content-hook-override' ] = isset( $_POST[ 'amazon-product-content-hook-override' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-content-hook-override' ] ) : '3';
	$mydata[ 'amazon-product-newwindow' ] = isset( $_POST[ 'amazon-product-newwindow' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-newwindow' ] ) : '3';
	$mydata[ 'amazon-product-singular-only' ] = isset( $_POST[ 'amazon-product-singular-only' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-singular-only' ] ) : '0';
	$mydata[ 'amazon-product-amazon-desc' ] = isset( $_POST[ 'amazon-product-amazon-desc' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-amazon-desc' ] ) : '0';
	$mydata[ 'amazon-product-show-gallery' ] = isset( $_POST[ 'amazon-product-show-gallery' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-show-gallery' ] ) : '0';
	$mydata[ 'amazon-product-show-features' ] = isset( $_POST[ 'amazon-product-show-features' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-show-features' ] ) : '0';
	$mydata[ 'amazon-product-show-list-price' ] = isset( $_POST[ 'amazon-product-show-list-price' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-show-list-price' ] ) : '0';
	$mydata[ 'amazon-product-show-used-price' ] = isset( $_POST[ 'amazon-product-show-used-price' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-show-used-price' ] ) : '0';
	//$mydata['amazon-product-show-saved-amt'] 			= isset($_POST['amazon-product-show-saved-amt']) ? sanitize_text_field($_POST['amazon-product-show-saved-amt']) : '0';
	//$mydata['amazon-product-timestamp'] 				= isset($_POST['amazon-product-timestamp']) ? sanitize_text_field($_POST['amazon-product-timestamp']) : '0';
	$mydata[ 'amazon-product-new-title' ] = isset( $_POST[ 'amazon-product-new-title' ] ) ? sanitize_text_field( $_POST[ 'amazon-product-new-title' ] ) : '';
	$mydata[ 'amazon-product-use-cartURL' ] = isset( $_POST[ 'amazon-product-use-cartURL' ] ) && ( int )$_POST[ 'amazon-product-use-cartURL' ] == 1 ? '1' : '';

	if ( $mydata[ 'amazon-product-isactive' ] == '' && $mydata[ 'amazon-product-single-asin' ] == "" ) {
		$mydata[ 'amazon-product-content-location' ] = '';
	}
	if ( $mydata[ 'amazon-product-excerpt-hook-override' ] == '' ) {
		$mydata[ 'amazon-product-excerpt-hook-override' ] = '3';
	}
	if ( $mydata[ 'amazon-product-content-hook-override' ] == '' ) {
		$mydata[ 'amazon-product-content-hook-override' ] = '3';
	}
	if ( $mydata[ 'amazon-product-newwindow' ] == '' ) {
		$mydata[ 'amazon-product-newwindow' ] = '3';
	}
	$mydata = apply_filters( 'amazon_product_in_a_post_plugin_meta_presave', $mydata );

	foreach ( $mydata as $key => $value ) {
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return;
		}
		$value = implode( ',', ( array )$value );
		if ( get_post_meta( $post_id, $key, FALSE ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value );
		}
		if ( !$value )delete_post_meta( $post_id, $key ); //delete if blank
	}
}

/* Prints the inner fields for the custom post/page section */
function amazonProductInAPostBox1() {
	global $post;
	$appASIN = get_post_meta( $post->ID, 'amazon-product-single-asin', true );
	$appnewwin = get_post_meta( $post->ID, 'amazon-product-newwindow', true );
	$appsingle = get_post_meta( $post->ID, 'amazon-product-singular-only', true );
	$appnewinO = get_option( 'apipp_open_new_window' ) == true ? 1 : 0;
	$apphookO = get_option( 'apipp_hook_excerpt' ) == true ? 1 : 0;
	$apphook = get_post_meta( $post->ID, 'amazon-product-excerpt-hook-override', true );
	$appcont = get_post_meta( $post->ID, 'amazon-product-content-hook-override', true );
	$appcontO = get_option( 'apipp_hook_content' ) == true ? 1 : 0;
	$appactive = get_post_meta( $post->ID, 'amazon-product-isactive', true );
	$appaffidO = APIAP_ASSOC_ID;
	$appnoonce = wp_create_nonce( plugin_basename( __FILE__ ) ); // Use nonce for verification ... ONLY USE ONCE!
	$appconloc = get_post_meta( $post->ID, 'amazon-product-content-location', true );
	$amazondesc = get_post_meta( $post->ID, 'amazon-product-amazon-desc', true );
	$amazongallery = get_post_meta( $post->ID, 'amazon-product-show-gallery', true );
	$amazonfeatures = get_post_meta( $post->ID, 'amazon-product-show-features', true );
	$amazontstamp = get_post_meta( $post->ID, 'amazon-product-timestamp', true );
	$appipnewtitle = get_post_meta( $post->ID, 'amazon-product-new-title', true );
	$amazonused = get_post_meta( $post->ID, 'amazon-product-show-used-price', true );
	$amazonlist = get_post_meta( $post->ID, 'amazon-product-show-list-price', true );
	$amazonsaved = get_post_meta( $post->ID, 'amazon-product-show-saved-amt', true );
	$useCartURL = get_post_meta( $post->ID, 'amazon-product-use-cartURL', true );

	$menuhide = ( $appactive != '' ) ? ' checked="checked"' : '';
	$hookcontent = ( $appcont == '2' || ( $appcont == '' && $appcontO ) ) ? ' checked="checked"' : "";
	$hookexcerpt = ( $apphook == '2' || ( $apphook == '' && $apphookO ) ) ? ' checked="checked"' : "";
	$singleonly = ( $appsingle == '1' ) ? ' checked="checked"' : "";
	$newwin = ( $appnewwin == '2' || ( $appnewwin == '' && $appnewinO ) ) ? ' checked="checked"' : "";
	$amazontstamp = $amazontstamp != '' ? ' checked="checked"' : '';
	$amazondesc = $amazondesc != '' ? ' checked="checked"' : '';
	$amazongallery = $amazongallery != '' ? ' checked="checked"' : '';
	$amazonfeatures = $amazonfeatures != '' ? ' checked="checked"' : '';
	$amazonused = $amazonused != '' ? ' checked="checked"' : '';
	$amazonlist = $amazonlist != '' ? ' checked="checked"' : '';
	$amazonsaved = $amazonsaved != '' ? ' checked="checked"' : '';
	$useCartURL = $useCartURL != '' ? ' checked="checked"' : '';

	if ( $appconloc === '3' ) {
		$appeampleimg = 'example-layout-3.png';
	} elseif ( $appconloc === '2' ) {
		$appeampleimg = 'example-layout-2.png';
	} else {
		$appeampleimg = 'example-layout-1.png';
	}

	$noaffidmsg = '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade below-h2"><p><strong>' . __( 'WARNING:', 'amazon-product-in-a-post-plugin', 'amazon-product-in-a-post-plugin' ) . '</strong> ' . __( 'You will not get credit for Amazon purchases until you add your Amazon Affiliate ID on the <a href="admin.php?page=apipp_plugin_admin">options</a> page.', 'amazon-product-in-a-post-plugin' ) . '</p></div>';
	if ( $appaffidO == '' ) {
		echo $noaffidmsg;
	}
	echo '<p><input type="checkbox" name="amazon-product-isactive" value="1" ' . $menuhide . ' /> <label for="amazon-product-isactive"><strong>' . __( "Product is Active?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if checked the product will be live', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><label for="amazon-product-single-asin"><strong>' . __( "Amazon Product ASIN(s)", 'amazon-product-in-a-post-plugin' ) . '</strong></label><br /><input type="text" name="amazon-product-single-asin" id="amazon-product-single-asin" size="25" value="' . $appASIN . '" /><em>' . __( 'For multiple, separate with a comma. You will need to get ASINs from <a href="http://amazon.com/">Amazon</a>', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><label for="amazon-product-new-title"><strong>' . __( "Replace Amazon Title With Below Title:", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'Optional. To hide title all together, type "null". No HTML, plain text only. Use this if you want your own title to show instead of Amazon\'s title.', 'amazon-product-in-a-post-plugin' ) . '</em><input type="text" class="amazon-product-new-title" name="amazon-product-new-title" id="amazon-product-new-title" size="35" value="' . $appipnewtitle . '" /></p>';
	echo '<input type="hidden" name="amazonpipp_noncename" id="amazonpipp_noncename" value="' . $appnoonce . '" /><input type="hidden" name="post_save_type_apipp" id="post_save_type_apipp" value="1" />';
	echo '<p><input type="checkbox" name="amazon-product-content-hook-override" value="2" ' . $hookcontent . ' /> <label for="amazon-product-content-hook-override"><strong>' . __( "Hook into Content?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'Product will show when full content is used (when <code>the_content()</code> template tag). On by default.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-excerpt-hook-override" value="2" ' . $hookexcerpt . ' /> <label for="amazon-product-excerpt-hook-override"><strong>' . __( "Hook into Excerpt?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'Product will show when partial excerpt content is used(when <code>the_excerpt()</code> is used. Off by default.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-singular-only" value="1" ' . $singleonly . ' /> <label for="amazon-product-singular-only"><strong>' . __( "Show Only on Single Page?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if checked the product will only show when on single page. Off by default.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-newwindow" value="2" ' . $newwin . ' /> <label for="amazon-product-newwindow"><strong>' . __( "Open Product Link in New Window?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if checked the product will open a new browser window. Off by default unless set in options.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<div class="appip-example-image"><img data="' . plugins_url( '/images/', dirname( __FILE__ ) ) . '" src="' . plugins_url( '/images/' . $appeampleimg, dirname( __FILE__ ) ) . '" class="appipexampleimg" alt=""/></div>';
	echo '<p><label for="amazon-product-content-location"><strong>' . __( "Where would you like your product to show within the post?", 'amazon-product-in-a-post-plugin' ) . '</strong></label></p>';
	echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;<input class="appip-content-type" type="checkbox" name="amazon-product-content-location[1][]" value="1" ' . ( ( $appconloc === '1' ) || ( $appconloc == '' ) ? ' checked="checked"' : '' ) . ' /> ' . __( '<strong>Above Post Content</strong> - <em>Default - Product will be first then post text</em>', 'amazon-product-in-a-post-plugin' ) . '<br/>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<input class="appip-content-type" type="checkbox" name="amazon-product-content-location[1][]" value="3" ' . ( ( $appconloc === '3' ) ? ' checked="checked"' : '' ) . ' /> ' . __( '<strong>Below Post Content</strong> - <em>Post text will be first then the Product</em>', 'amazon-product-in-a-post-plugin' ) . '<br/>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<input class="appip-content-type" type="checkbox" name="amazon-product-content-location[1][]" value="2" ' . ( ( $appconloc === '2' ) ? ' checked="checked"' : '' ) . ' /> ' . __( '<strong>Post Text becomes Description</strong> - <em>Post text will become part of the Product layout</em>', 'amazon-product-in-a-post-plugin' ) . '</p>';
	echo '<h2>Additional Features:</h2>';
	echo '<p><input type="checkbox" name="amazon-product-use-cartURL" value="1" ' . $useCartURL . ' /> <label for="amazon-product-use-cartURL"><strong>' . __( "Use Add to Cart URL?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'Uses Add to Cart URL instead of product page link. helps with 90 day conversion cookie.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-amazon-desc" value="1" ' . $amazondesc . ' /> <label for="amazon-product-amazon-desc"><strong>' . __( "Show Amazon Description?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. This will be IN ADDITION TO your own content.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-show-gallery" value="1" ' . $amazongallery . ' /> <label for="amazon-product-show-gallery"><strong>' . __( "Show Image Gallery?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available (Consists of Amazon Approved images only). Not all products have an Amazon Image Gallery.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-show-features" value="1" ' . $amazonfeatures . ' /> <label for="amazon-product-show-features"><strong>' . __( "Show Amazon Features?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-show-used-price" value="1" ' . $amazonused . ' /> <label for="amazon-product-show-used-price"><strong>' . __( "Show Amazon Used Price?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	echo '<p><input type="checkbox" name="amazon-product-show-list-price" value="1" ' . $amazonlist . ' /> <label for="amazon-product-show-list-price"><strong>' . __( "Show Amazon List Price?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
/* Possibly Remove */
//echo '<p><input type="checkbox" name="amazon-product-show-saved-amt" value="1" '.$amazonsaved.' /> <label for="amazon-product-show-saved-amt"><strong>' . __("Show Saved Amount?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>'.__('if available. Not all items have this feature.','amazon-product-in-a-post-plugin').'</em></p>';
//echo '<p><input type="checkbox" name="amazon-product-timestamp" value="1" '.$amazontstamp.' /> <label for="amazon-product-show-timestamp"><strong>' . __("Show Price Timestamp?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>'.__('for example:','amazon-product-in-a-post-plugin').'</em>'.__('<div class="appip-em-sample">&nbsp;&nbsp;Amazon.com Price: $32.77 (as of 01/07/2008 14:11 PST - <span class="appip-tos-price-cache-notice-tooltip" title="">Details</span>)<br/>&nbsp;&nbsp;Amazon.com Price: $32.77 (as of 14:11 PST - <span class="appip-tos-price-cache-notice-tooltip" title="">More info</span>)</div>','amazon-product-in-a-post-plugin').'</p>';
//echo '<span style="display:none;" class="appip-tos-price-cache-notice">' . __( 'Product prices and availability are accurate as of the date/time indicated and are subject to change. Any price and availability information displayed on amazon.' . APIAP_LOCALE . ' at the time of purchase will apply to the purchase of this product.', 'amazon-product-in-a-post-plugin' ) . '</span>';
	echo '<div style="clear:both;"></div>';
}


/* When the post is saved, saves our custom data */
function amazonProductInAPostSavePostdataForm( $post_id, $post ) {
	if ( $post_id == '' ) {
		$post_id = $post->ID;
	}
	if ( !isset( $post[ 'post_save_type_apipp' ] ) ) {
		return;
	}
	$mydata = array();
	$mydata[ 'amazon-product-isactive' ] = sanitize_text_field( $post[ 'amazon-product-isactive' ] );
	$mydata[ 'amazon-product-content-location' ] = sanitize_text_field( $post[ 'amazon-product-content-location' ] );
	$mydata[ 'amazon-product-single-asin' ] = sanitize_text_field( $post[ 'amazon-product-single-asin' ] );
	$mydata[ 'amazon-product-excerpt-hook-override' ] = sanitize_text_field( $post[ 'amazon-product-excerpt-hook-override' ] );
	$mydata[ 'amazon-product-content-hook-override' ] = sanitize_text_field( $post[ 'amazon-product-content-hook-override' ] );
	$mydata[ 'amazon-product-newwindow' ] = sanitize_text_field( $post[ 'amazon-product-newwindow' ] );
	$mydata[ 'amazon-product-singular-only' ] = sanitize_text_field( $post[ 'amazon-product-singular-only' ] );
	$mydata[ 'amazon-product-amazon-desc' ] = sanitize_text_field( $post[ 'amazon-product-amazon-desc' ] );
	$mydata[ 'amazon-product-show-gallery' ] = sanitize_text_field( $post[ 'amazon-product-show-gallery' ] );
	$mydata[ 'amazon-product-show-features' ] = sanitize_text_field( $post[ 'amazon-product-show-features' ] );
	$mydata[ 'amazon-product-show-list-price' ] = sanitize_text_field( $post[ 'amazon-product-show-list-price' ] );
	$mydata[ 'amazon-product-show-used-price' ] = sanitize_text_field( $post[ 'amazon-product-show-used-price' ] );
	//$mydata['amazon-product-show-saved-amt']		= sanitize_text_field($post['amazon-product-show-saved-amt']);
	//$mydata['amazon-product-timestamp'] 			= sanitize_text_field($post['amazon-product-timestamp']);
	$mydata[ 'amazon-product-new-title' ] = sanitize_text_field( $post[ 'amazon-product-new-title' ] );
	$mydata[ 'amazon-product-use-cartURL' ] = sanitize_text_field( $post[ 'amazon-product-use-cartURL' ] );

	if ( $mydata[ 'amazon-product-isactive' ] == '' && $mydata[ 'amazon-product-single-asin' ] == "" ) {
		$mydata[ 'amazon-product-content-location' ] = '';
	}
	if ( $mydata[ 'amazon-product-excerpt-hook-override' ] == '' ) {
		$mydata[ 'amazon-product-excerpt-hook-override' ] = '3';
	}
	if ( $mydata[ 'amazon-product-content-hook-override' ] == '' ) {
		$mydata[ 'amazon-product-content-hook-override' ] = '3';
	}
	if ( $mydata[ 'amazon-product-newwindow' ] == '' ) {
		$mydata[ 'amazon-product-newwindow' ] = '3';
	}
	$mydata = apply_filters( 'amazon_product_in_a_post_plugin_meta_presave', $mydata );

	foreach ( $mydata as $key => $value ) {
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return;
		}
		$value = implode( ',', ( array )$value );
		if ( get_post_meta( $post_id, $key, FALSE ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value );
		}
		if ( !$value )delete_post_meta( $post_id, $key ); //delete if blank
	}
}

function apipp_plugin_menu() {
	global $fullname_apipp, $shortname_apipp, $options_apipp;
	apipp_options_add_admin_page( $fullname_apipp, $shortname_apipp, $options_apipp );
	add_menu_page( __( 'Amazon Product In a Post Plugin', 'amazon-product-in-a-post-plugin' ), _x('Amazon Product', 'Main Menu Title', 'amazon-product-in-a-post-plugin'), 'edit_posts', 'apipp-main-menu', 'apipp_main_page', 'dashicons-amazon' ); //toplevel_page_apipp-main-menu
	add_submenu_page( 'apipp-main-menu', _x( "Getting Started", 'Page Title','amazon-product-in-a-post-plugin' ), _x( "Getting Started", 'Menu Title', 'amazon-product-in-a-post-plugin' ), 'edit_posts', 'apipp-main-menu', 'apipp_main_page' );
	add_submenu_page( 'apipp-main-menu', _x( "New Amazon Post", 'Page Title', 'amazon-product-in-a-post-plugin' ), _x( "New Amazon Post", 'Menu Title', 'amazon-product-in-a-post-plugin' ), 'edit_posts', "apipp-add-new", 'apipp_add_new_post' ); //amazon-product_page_apipp-add-new
	add_submenu_page( 'apipp-main-menu', _x( "Amazon Product in a Post Options", 'Page Title', 'amazon-product-in-a-post-plugin' ), _x( "Plugin Settings",'Menu Title', 'amazon-product-in-a-post-plugin' ), 'manage_options', "apipp_plugin_admin", 'apipp_options_add_subpage' );
	add_submenu_page( 'apipp-main-menu', _x( "Product Cache",'Page Title', 'amazon-product-in-a-post-plugin' ), _x( "Product Cache", 'Menu Title', 'amazon-product-in-a-post-plugin' ), 'edit_posts', "apipp-cache-page", 'apipp_cache_page' );
	add_submenu_page( 'apipp-main-menu', _x( "Shortcode Usage", 'Page Title', 'amazon-product-in-a-post-plugin' ), _x( 'Shortcode Usage', 'Menu Title', 'amazon-product-in-a-post-plugin' ), 'manage_options', 'apipp_plugin-shortcode', 'apipp_shortcode_help_page' );
	add_submenu_page( 'apipp-main-menu', _x( "FAQs/Help",'Page Title', 'amazon-product-in-a-post-plugin' ), _x( 'FAQs/Help', 'Menu Title', 'amazon-product-in-a-post-plugin' ), 'manage_options', 'apipp_plugin-faqs', 'apipp_options_faq_page' );
	//add_submenu_page( 'apipp-main-menu', __('Layout Styles', 'amazon-product-in-a-post-plugin'), __('Layout Styles', 'amazon-product-in-a-post-plugin'), 'manage_options', 'appip-layout-styles', 'apipp_templates');
}

function apipp_cache_page() {
	global $current_user, $wpdb;
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'amazon-product-in-a-post-plugin' ) );
	}
	echo '<div class="wrap">';
	echo '<h2>' . __( 'Amazon Product In A Post CACHE', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	if ( isset( $_GET[ 'appmsg' ] ) && ( int )$_GET[ 'appmsg' ] == 1 ) {
		if ( isset( $_GET[ 'qty' ] ) && ( int )$_GET[ 'qty' ] > 0 ) {
			echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade below-h2"><p><b>' . esc_attr( ( int )$_GET[ 'qty' ] ) . ' ' . __( 'Product post(s) have been saved. To edit, use the standard Post Edit options.', 'amazon-product-in-a-post-plugin' ) . '</b></p></div>';
		} else {
			echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade below-h2"><p><b>' . __( 'Product post has been saved. To edit, use the standard Post Edit options.', 'amazon-product-in-a-post-plugin' ) . '</b></p></div>';
		}
	}
	echo '	<div class="wrapper">';
	$paged = isset( $_GET[ 'paged' ] ) && ( int )$_GET[ 'paged' ] != 0 ? ( int )$_GET[ 'paged' ] : 1;
	$limit = 50;
	$offset = ( $paged - 1 ) * $limit;
	$ccountsql = "SELECT count(Cache_id) FROM " . $wpdb->prefix . "amazoncache;";
	$max_pages = $wpdb->get_var( $ccountsql );
	$num_pages = round( ( int )$max_pages / $limit, 0 );
	$checksql = "SELECT body,Cache_id,URL,updated,( NOW() - Updated )as Age FROM " . $wpdb->prefix . "amazoncache ORDER BY Updated DESC LIMIT {$offset},{$limit};";
	$result = $wpdb->get_results( $checksql );
	$cacheSec = ( int )apply_filters( 'amazon_product_post_cache', get_option( 'apipp_amazon_cache_sec', 3600 ) ) / 60;
	$foundPage = count( $result );
	echo '<p>' . __( 'The product cache is stored for ' . $cacheSec . ' minutes and then deleted automatically. To refetch a product, delete the cache and it will be updated on the next product load.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	echo '<br/>';
	echo '<div style="text-align:right;margin:15px"><a href="#" class="button appip-cache-del button-primary" id="appip-cache-0">' . __( 'Delete Cache For ALL Products', 'amazon-product-in-a-post-plugin' ) . '</a></div>';
	$page_links = paginate_links( array(
		'base' => add_query_arg( 'paged', '%#%' ),
		'format' => '',
		'prev_text' => _x( '&laquo;', 'Previous Page Character', 'amazon-product-in-a-post-plugin' ),
		'next_text' => _x( '&raquo;', 'Next Page Character', 'amazon-product-in-a-post-plugin' ),
		'total' => $num_pages,
		'current' => $paged
	) );
	echo '<style>span.page-numbers.current {display: inline-block;min-width: 17px;border: 1px solid rgb(177, 177, 177);padding: 3px 5px 7px;background: #ffffff;font-size: 16px;line-height: 1;font-weight: 400;text-align: center;}</style><div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0;"><span style="text-align:right;font-style:italic;font-size:14px;color:#666;padding-right: 10px;">Total Results: ' . $max_pages . '</span> ' . $page_links . '</div></div>';
	echo '<table class="wp-list-table widefat fixed" cellspacing="0">';
	echo '<thead><tr><th class="manage-column manage-cache-id" style="width:75px;">' . __( 'Cache ID', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-call-ui">' . __( 'Unique Call UI', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-updated" style="width:150px;">' . __( 'Last Updated', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-last-col" style="width:100px;"></th></tr></thead>';
	echo '<tfoot><tr><th class="manage-column manage-cache-id" style="width:75px;">' . __( 'Cache ID', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-call-ui">' . __( 'Unique Call UI', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-updated" style="width:150px;">' . __( 'Last Updated', 'amazon-product-in-a-post-plugin' ) . '</th><th class="manage-column manage-last-col" style="width:100px;"></th></tr></tfoot>';
	if ( !empty( $result ) && is_array( $result ) ) {
		echo '<tbody id="the-list">';
		$appct = 0;
		foreach ( $result as $psxml ) {
			if ( $appct & 1 ) {
				echo '<tr class="alternate iedit appip-cache-' . $psxml->Cache_id . '-row">';
			} else {
				echo '<tr class="iedit appip-cache-' . $psxml->Cache_id . '-row">';
			}
			echo '<td class="manage-column manage-cache-id">' . $psxml->Cache_id . '</td>';
			echo '<td class="manage-column manage-call-ui">' . $psxml->URL . ' ( <a href="#" class="xml-show">show xml cache data</a> )<textarea style="display:none;width:100%;height:150px;">' . htmlspecialchars( $psxml->body ) . '</textarea></td>';
			echo '<td class="manage-column manage-updated">' . $psxml->updated . '</td>';
			echo '<td class="manage-column manage-last-col"><a href="#" class="button appip-cache-del" id="appip-cache-' . $psxml->Cache_id . '">' . __( 'delete cache', 'amazon-product-in-a-post-plugin' ) . '</a></td>';
			echo '</tr>';
			$appct++;
		}
	} else {
		echo '<tbody id="the-list"><tr class="alternate iedit appip-cache-0-row"><td colspan="4">' . __( 'no cached products at this time.', 'amazon-product-in-a-post-plugin' ) . '</td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '		<div style="text-align:right;margin:15px"><a href="#" class="button appip-cache-del button-primary" id="appip-cache-0">' . __( 'Delete Cache For ALL Products', 'amazon-product-in-a-post-plugin' ) . '</a></div>';
	echo '	</div>';
	echo '</div>';
}

function apipp_shortcode_help_page() {
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'amazon-product-in-a-post-plugin' ) );
	}
	$current_tab = isset( $_GET[ 'tab' ] ) ? esc_attr( $_GET[ 'tab' ] ) : 'basics';
	$pageTxtArr = array();
	$pageTxtArr[] = '<div class="wrap">';
	$pageTxtArr[] = '	<h2>' . __( 'Amazon Product In a Post Shortcode Usage', 'amazon-product-in-a-post-plugin' ) . '</h2>';

	$pageTxtArr[] = '<h2 class="nav-tab-wrapper">';
	$pageTxtArr[] = '	<a id="basics" class="appiptabs nav-tab ' . ( $current_tab == 'basics' ? 'nav-tab-active' : '' ) . '" href="?page=apipp_plugin-shortcode&tab=basics">' . __( 'Basics', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="amazonproducts" class="appiptabs nav-tab ' . ( $current_tab == 'amazonproducts' ? 'nav-tab-active' : '' ) . '" href="?page=apipp_plugin-shortcode&tab=amazonproducts">' . __( 'Product Shortcode', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="amazonelements" class="appiptabs nav-tab ' . ( $current_tab == 'amazonelements' ? 'nav-tab-active' : '' ) . '" href="?page=apipp_plugin-shortcode&tab=amazonelements">' . __( 'Elements Shortcode', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="amazon-product-search" class="appiptabs nav-tab ' . ( $current_tab == 'amazon-product-search' ? 'nav-tab-active' : '' ) . '" href="?page=apipp_plugin-shortcode&tab=amazon-product-search">' . __( 'Search Shortcode', 'amazon-product-in-a-post-plugin' ) . '</a>';
	if ( has_filter( 'amazon_product_shortcode_help_tabs' ) ){
		$newtabs = apply_filters( 'amazon_product_shortcode_help_tabs', array(), $current_tab );
		if(is_array($newtabs) && !empty($newtabs))
			$pageTxtArr[] = implode("\n",$newtabs);
	}
	$pageTxtArr[] = '</h2>';

	$pageTxtArr[] = '	<div class="tab-content wrapper appip_shortcode_help">';
	$pageTxtArr[] = '		<div id="basics-content" class="nav-tab-content' . ( $current_tab == 'basics' ? ' active' : '' ) . '" style="' . ( $current_tab == 'basics' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<h2>' . __( 'Shortcode Basics', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'WordPress shortcodes were introduced in WordPress version 2.5. A shortcode is basically a placeholder for content that you want to put in a specific spot in a page or post. The content is usually generated when the page/post is loaded on the front end by the viewer. Shortcodes make it very easy to add all sorts of advanced content without the need to know any programming and without needing to modify any theme or template code.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<h3>' . __( 'Anatomy of a Shortcode', 'amazon-product-in-a-post-plugin' ) . '</h3>';
	$pageTxtArr[] = '			<p>' . __( 'A Shortcode is comprised of a few simple elements. The main thing you will notice is that a shortcode is placed in square brackets', 'amazon-product-in-a-post-plugin' ) . ' ([]). ' . __( 'Inside the brackets you add the <strong>shortcode name</strong> and any <strong>attributes</strong> and values needed to produce the desired effect. The outcome depends on how the shortcode was programmed and the number of attributes can be zero (none) up to an unlimited number - again, depending on how it was programmed.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<p>' . __( 'In its simplest form, a shortcode is just a name or word inside the brackets and nothing else, like so:', 'amazon-product-in-a-post-plugin' ) . '<br/>';
	$pageTxtArr[] = '			<code>[shortcode]</code></p>';
	$pageTxtArr[] = '			<p>' . __( 'A shortcode can also contain a closing "tag" is you want to include text with the shortcode, like:', 'amazon-product-in-a-post-plugin' ) . '<br/>';
	$pageTxtArr[] = '			<code>[shortcode]' . __( 'Put your content here', 'amazon-product-in-a-post-plugin' ) . '[/shortcode]</code><br/>';
	$pageTxtArr[] = '			' . __( 'Not all shortcodes use closing tags and not all of them allow content text, so check with the documentation when you use one for a specific plugin or theme.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<p>Most shortcodes have multiple attributes that you can set if you want to have different outcomes when the content is generated. Attributes (also called "Parameters") and their Value are entered in a "keyed pair" type manner, which is <code>attribute="value"</code>. The attributes allowed and their allowed value are all determined by the shortcode creator.<br/>';
	$pageTxtArr[] = '			' . __( 'Examples:', 'amazon-product-in-a-post-plugin' ) . ' <code>[shortcode title="shortcode title" text_color="red"]' . __( 'Your Content Here', 'amazon-product-in-a-post-plugin' ) . '[/shortcode]</code> ' . __( 'or', 'amazon-product-in-a-post-plugin' ) . ' <code>[shortcode title="shortcode title" text_color="green"]</code></p>';
	$pageTxtArr[] = '			<p>' . __( 'Once you know what attributes you can use and the acceptable values, you can add them to do whatever you want - again, depending on what they are for and how they are programmed.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<p>' . __( 'The Amazon Product In a Post Plugin comes with several shortcodes for you to use. They each have their own set of allowed Attributes/Parameters.', 'amazon-product-in-a-post-plugin' ) . ' <em>' . __( 'Click the name to see how to use each one:', 'amazon-product-in-a-post-plugin' ) . '</em></p>';
	$pageTxtArr[] = '			<ul>';
	$pageTxtArr[] = '				<li><a href="?page=apipp_plugin-shortcode&tab=amazonproducts" class="amazonproducts"><strong>AMAZONPRODUCTS</strong></a><br/>' . __( 'The main Shortcode. You can also use', 'amazon-product-in-a-post-plugin' ) . ' "amazonproducts" ' . __( 'all lowercase. This will output an entirely formatted Amazon product (the same as if you do not use a shortcode for your products).', 'amazon-product-in-a-post-plugin' ) . '</li> ';
	$pageTxtArr[] = '				<li><a href="?page=apipp_plugin-shortcode&tab=amazonelements" class="amazonelements"><strong>amazon-elements</strong></a><br/>' . __( 'A Shortcode specifically designed to make adding individual elements of an Amazon product. Can also use the singular', 'amazon-product-in-a-post-plugin' ) . ' "amazon-element".</li>';
	$pageTxtArr[] = '				<li><a href="?page=apipp_plugin-shortcode&tab=amazon-product-search" class="amazon-product-search"><strong>amazon-product-search</strong></a><br/>' . __( 'A Shortcode for displaying Amazon search results.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$addl_lists = apply_filters( 'amazon_product_in_a_post_plugin_shortcode_list', array() );
		if( is_array($addl_lists) && !empty($addl_lists) )
		$pageTxtArr[] = implode("\n",$addl_lists);
	$pageTxtArr[] = '			<ul>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '		</div>';

	$pageTxtArr[] = '		<div id="amazonproducts-content" class="nav-tab-content' . ( $current_tab == 'amazonproducts' ? ' active' : '' ) . '" style="' . ( $current_tab == 'amazonproducts' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '		<h2><a name="amazonproducts"></a>[AMAZONPRODUCTS] ' . __( 'Shortcode', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '		<p>' . __( 'The shortcode should be used as follows:', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '		<p>' . __( 'Usage in the most basic form is simply the Shortcode and the ASIN written as (where the XXXXXXXXX is the Amazon ASIN):', 'amazon-product-in-a-post-plugin' ) . '<br>';
	$pageTxtArr[] = '			<code>[AMAZONPRODUCTS asin="XXXXXXXXXX"]</code>';
	$pageTxtArr[] = '			<p>' . __( 'There are additional parameters that can be added if you need them. The parameters are', 'amazon-product-in-a-post-plugin' ) . '<br><code>locale</code>, <code>desc</code>, <code>features</code>, <code>listprice</code>, <code>partner_id</code>, <code>private_key</code>, and <code>public_key</code></p>';
	$pageTxtArr[] = '			<p>' . __( 'A description of each parameter:', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '		<ul>';
	$pageTxtArr[] = '			<li><code>asin</code> &mdash; ' . __( 'this is the ASIN or ASINs up to 10 comma separated.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>locale</code> &mdash; ' . __( 'this is the Amazon locale you want to get the product from, i.e., com, co.uk, fr, etc. default is your plugin setting.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>desc</code> &mdash; ' . __( 'using 1 shows Amazon description (if available) and 0 hides it &mdash; default is 0.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>features</code> &mdash; ' . __( 'using 1 shows Amazon Features (if available) and 0 hides it - default is 0.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>listprice</code> &mdash; ' . __( 'using 1 shows the list price and 0 hides it &mdash; default is 1.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>partner_id</code> &mdash; ' . __( 'allows you to add a different parent ID if different for other locale &mdash; default is ID in settings.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>private_key</code> &mdash; ' . __( 'allows you to add different private key for locale if different &mdash; default is private key in settings.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			<li><code>public_key</code> &mdash; ' . __( 'allows you to add a different private key for locale if different &mdash; default is public key in settings.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '		</ul>';
	$pageTxtArr[] = '			<p>' . __( 'Examples of it&rsquo;s usage:', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '		<ul>';
	$pageTxtArr[] = '			<li>' . __( 'If you want to add a .com item and you have the same partner id, public key, private key and want the features showing:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<code>[AMAZONPRODUCTS asin="B0084IG8TM" features="1" locale="com"]</code></li>';
	$pageTxtArr[] = '			<li>' . __( 'If you want to add a .com item and you have a different partner id, public key, private key and want the description showing but features not showing:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<code>[AMAZONPRODUCTS asin="B0084IG8TM,B005LAIHPE" locale="com" public_key="AKIAJDRNJ6O997HKGXW" private_key="Nzg499eVysc5yjcZwrIV3bhDti/OGyRHEYOWO005" partner_id="mynewid-20"]</code></li>';
	$pageTxtArr[] = '			<li>' . __( 'If you just want to use your same locale but want 2 items with no list price and features showing:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<code>[AMAZONPRODUCTS asin="B0084IG8TM,B005LAIHPE" features="1" listprice="0"]</code></li>';
	$pageTxtArr[] = '			<li>' . __( 'If you just want 2 products with regular settings:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<code>[AMAZONPRODUCTS asin="B0084IG8TM,B005LAIHPE"]</code></li>';
	$pageTxtArr[] = '			<li>' . __( 'If you want to add text to a product:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<code>[AMAZONPRODUCTS asin="B0084IG8TM"]your text can go here![/AMAZONPRODUCTS]</code></li>';
	$pageTxtArr[] = '		</ul>';
	$pageTxtArr[] = '		<hr/>';
	$pageTxtArr[] = '		</div>';

	$pageTxtArr[] = '		<div id="amazonelements-content" class="nav-tab-content' . ( $current_tab == 'amazonelements' ? ' active' : '' ) . '" style="' . ( $current_tab == 'amazonelements' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '		<div class="appip_elements_code"><a name="amazonelements"></a>';
	$pageTxtArr[] = '			<h2>[amazon-elements] ' . __( 'Shortcode', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'shortcode implementation for elements only &mdash; for when you may only want specific element(s) like the title, price and image or image and description, or the title and the buy now button, etc.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<ul>';
	$pageTxtArr[] = '				<li><code>asin</code> &mdash; ' . __( 'the Amazon ASIN (up to 10 comma sep).<span style="color:#ff0000;"> Required </span>', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>locale</code> &mdash; ' . __( 'the amazon locale, i.e., co.uk, es. This is handy of you need a product from a different locale than your default one. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>gallery</code> &mdash; ' . __( 'use a value of 1 to show extra photos if a product has them. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>partner_id</code> &mdash; ' . __( 'your amazon partner id. default is the one in the options. You can set a different one here if you have a different one for another locale or just want to split them up between multiple ids. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>private_key</code> &mdash; ' . __( 'amazon private key. Default is one set in options. You can set a different one if needed for another locale. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>public_key</code> &mdash; ' . __( 'amazon public key. Default is one set in options. You can set a different one if needed for another locale. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	//$pageTxtArr[] = '				<li><code>showformat</code> &mdash; '.__('show or hide the format in the title i.e., &quot;Some Title (DVD)&quot; or &quot;Some Title (BOOK)&quot;. 1 to show 0 to hide. Applies to all ASINs. Default is 1. (optional)', 'amazon-product-in-a-post-plugin').'</li>';
	$pageTxtArr[] = '				<li><code>msg_instock</code> &mdash; ' . __( 'message to display when an image is in stock. Applies to all ASINs. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>msg_outofstock</code> &mdash; ' . __( 'message to display when an image is out of stock. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>target</code> &mdash; ' . __( 'default is &quot;_blank&quot;. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>fields</code> &mdash; ' . __( 'Fields you want to return. And valid return field form Amazon API (you could see API for list) or common fields of: title, lg-image,md-image,sm-image, large-image-link,description (or desc),ListPrice, new-price,LowestUsedPrice, button. You should have at least one field when using this shortcode, as no field will return a blank result. Applies to all ASINs in list. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>labels</code> &mdash; ' . __( 'Labels that correspond to the fields (if you want custom labels). They should match the fields and be comma separated and :: separated for the field name and value i.e., field name::label text,field-two::value 2, etc. These can be ASIN specific. If you have 2 ASINs, the first label field will correspond to the first ASIN, the second to the second one, and so on. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><code>button_url</code> &mdash; ' . __( 'URL for a button image, if you want to use a different image than the default one. ASIN Specific - separate the list of URLs with a comma to correspond with the ASIN. i.e., if you had 3 ASINs and wanted the first and third to have custom buttons, but the second to have the default button, use <code>button_url="http://first.com/image1.jpg,,http://first.com/image1.jpg"</code> (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<p>' . __( 'Example of the new elements shortcode usage:', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<ul>';
	$pageTxtArr[] = '				<li>' . __( 'if you want to have a product with only a large image, the title and button, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
	$pageTxtArr[] = '					<code>[amazon-element asin=&quot;0753515032&quot; fields=&quot;title,lg-image,large-image-link,button&quot;]</code></li>';
	$pageTxtArr[] = '				<li>' . __( 'If you want that same product to have the description, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
	$pageTxtArr[] = '					<code>[amazon-element asin=&quot;0753515032&quot; fields=&quot;title,lg-image,large-image-link,<span style="color:#FF0000;">desc</span>,button&quot;]</code></li>';
	$pageTxtArr[] = '				<li>' . __( 'If you want that same product to have the list price and the new price, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
	$pageTxtArr[] = '					<code>[amazon-element asin=&quot;0753515032&quot; fields=&quot;title,lg-image,large-image-link,desc,<span style="color:#FF0000;">ListPrice,new-price,button&quot; msg_instock=&quot;in Stock&quot; msg_outofstock=&quot;no more left!&quot;</span>]</code><br>';
	$pageTxtArr[] = '			      '.__('The msg_instock and msg_outofstock are optional fields.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'If you want to add som of your own text to a product, and makeit part of the post, you could do something like this:<br>', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '					<code>[amazon-element asin=&quot;0753515032&quot; fields=&quot;title,lg-image,large-image-link&quot; labels=&quot;large-image-link::click for larger image:,title-wrap::h2,title::Richard Branson: Business Stripped Bare&quot;]Some normal content text here.[amazon-element asin=&quot;0753515032&quot; fields=&quot;desc,gallery,ListPrice,new-price,LowestUsedPrice,button&quot; labels=&quot;desc::Book Description:,ListPrice::SRP:,new-price::New From:,LowestUsedPrice::Used From:&quot; msg_instock=&quot;Available&quot;]</code></li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<h4>' . __( 'Available Fields for the shortcode:', 'amazon-product-in-a-post-plugin' ) . '</h4>';
	$pageTxtArr[] = '			<h3>' . __( 'Common Items', 'amazon-product-in-a-post-plugin' ) . '</h3>';
	$pageTxtArr[] = '			'.__( 'These are generally common in all products (if available)', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '			<ul class="as_code">';
	$pageTxtArr[] = '				<li>' .'ASIN - <span class="small-text">'. __( 'Product Identification Number.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'URL - <span class="small-text">'. __( 'Product page URL on Amazon.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'Title - <span class="small-text">'. __( 'Product Title.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'SmallImage - <span class="small-text">'. __( 'Product Small Image URL.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'MediumImage - <span class="small-text">' .__( 'Product Medium Image URL.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'LargeImage - <span class="small-text">'. __( 'Product Large Image URL.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'AddlImages - <span class="small-text">'. __( 'Product Additional Images.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'Feature - <span class="small-text">'. __( 'Product Featured Items Text.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'Format - <span class="small-text">'.__( 'Product Format. I.e., DVD, Blu-ray, etc.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'PartNumber - <span class="small-text">'. __( 'Product Part Number.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'ProductGroup - <span class="small-text">'. __( 'Product Category. I.e., Books, Sproting Goods, etc.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'ProductTypeName - <span class="small-text">' .__( 'Product Category Name. I.e., CAMERA_DIGITAL', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'ISBN - <span class="small-text">'. __( 'Product ISBN number.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'ItemDesc - <span class="small-text">'. __( 'Product Description.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'ListPrice - <span class="small-text">'. __( 'Product Manufacturer\'s Suggested Retail Price (SRP).', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'SKU - <span class="small-text">'. __( 'Product\'s Unique Stock Keeping Unit (SKU).', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'UPC - <span class="small-text">' .__( 'Universal Product Code, which is a 12 digit number, 6 of which represents an item\'s manufacturer. These numbers are translated into a bar code that is printed on an item or its packaging.', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '				<li>' .'CustomerReviews - <span class="small-text">'. __( 'Product Customer Reviews (shown in an iframe only).', 'amazon-product-in-a-post-plugin' ) . '</span></li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<h3>' . __( 'Offer/Pricing Elements', 'amazon-product-in-a-post-plugin' ) . '</h3>';
	$pageTxtArr[] = __( '			These are generally returned for most products.', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '			<ul class="as_code">';
	$pageTxtArr[] = '				<li>' . __( 'LowestNewPrice', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'LowestUsedPrice', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'LowestRefurbishedPrice', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'LowestCollectiblePrice', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'MoreOffersUrl', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NewAmazonPricing', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TotalCollectible', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TotalNew', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TotalOffers', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TotalRefurbished', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TotalUsed', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<h3>' . __( 'Items Attributes', 'amazon-product-in-a-post-plugin' ) . '</h3>';
	$pageTxtArr[] = __( '			Available only to their select product groups and not available in all locales. Try it first to see if it returns a value. For example, the Actor field is not going to be returned if the product is a computer or some form of electronics, but would be returned if the product was a DVD or Blu-ray Movie.', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '			<ul class="as_code">';
	$pageTxtArr[] = '				<li>' . __( 'Actor', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Artist', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'AspectRatio', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'AudienceRating', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'AudioFormat', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Author', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Binding', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Brand', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'CatalogNumberList', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Category', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'CEROAgeRating', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ClothingSize', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Color', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Creator', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Department', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Director', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'EAN', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'EANList', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Edition', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'EISBN', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'EpisodeSequence', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ESRBAgeRating', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Genre', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'HardwarePlatform', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'HazardousMaterialType', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'IsAdultProduct', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'IsAutographed', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'IsEligibleForTradeIn', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'IsMemorabilia', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'IssuesPerYear', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ItemDimensions', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ItemPartNumber', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Label', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Languages', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'LegalDisclaimer', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'MagazineType', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Manufacturer', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ManufacturerMaximumAge', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ManufacturerMinimumAge', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ManufacturerPartsWarrantyDescription', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'MediaType', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Model', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ModelYear', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'MPN', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NumberOfDiscs', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NumberOfIssues', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NumberOfItems', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NumberOfPages', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'NumberOfTracks', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'OperatingSystem', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageDimensions', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageDimensionsWidth', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageDimensionsHeight', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageDimensionsLength', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageDimensionsWeight', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PackageQuantity', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PictureFormat', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Platform', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ProductTypeSubcategory', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'PublicationDate', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Publisher', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'RegionCode', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ReleaseDate', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'RunningTime', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'SeikodoProductCode', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'ShoeSize', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Size', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Studio', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'SubscriptionLength', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TrackSequence', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'TradeInValue', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'UPCList', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'Warranty', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li>' . __( 'WEEETaxValue ', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '		</div>';

	$pageTxtArr[] = '		</div>';
	$pageTxtArr[] = '		<div id="amazon-product-search-content" class="nav-tab-content' . ( $current_tab == 'amazon-product-search' ? ' active' : '' ) . '" style="' . ( $current_tab == 'amazon-product-search' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<p>amazon-product-search shortcode help coming soon.</p>';
	$pageTxtArr[] = '		</div>';
	if ( has_filter( 'amazon_product_shortcode_help_content' ) ){
		$newcontent = apply_filters( 'amazon_product_shortcode_help_content', array(), $current_tab );
		if(is_array($newcontent) && ! empty($newcontent)){
			$pageTxtArr[] = implode("\n",$newcontent);
		}
	}

	$pageTxtArr[] = '	</div>';
	$pageTxtArr[] = '</div>';
	echo implode( "\n", $pageTxtArr );
	unset( $pageTxtArr );
}

function apipp_main_page() {
	global $current_user, $wpdb;
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'amazon-product-in-a-post-plugin' ) );
	}
	$current_tab = isset( $_GET[ 'tab' ] ) ? esc_attr( $_GET[ 'tab' ] ) : 'getting-started-one';
	$pageTxtArr = array();
	$pageTxtArr[] = '<div class="wrap">';
	$pageTxtArr[] = '	
	<style type="text/css">
	small{font-size:13px;color:#777;line-height: 19px;}
	.nav-tab-content > div{margin-left:15px;}
	.nav-tab-content > div p{margin-left:25px;}
	.nav-tab-content > div img{margin:20px 10px 20px 10px;}
	.nav-tab-content ul{list-style-type: none;margin: 25px 0 25px 28px;border-left: 10px solid #eaeaea;padding-left: 16px;}
	.nav-tab-content blockquote{font-style: italic;margin-top: 20px; margin-bottom: 20px;border: 1px solid #ccc;padding: 20px;border-width: 1px 0;}
	</style>';
	$pageTxtArr[] = '	<h2>' . __( 'Amazon Product In A Post - GETTING STARTED', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	
	//echo '	<div class="wrapper">';
	
	$pageTxtArr[] = '<h2 class="nav-tab-wrapper">';
	$pageTxtArr[] = '	<a id="getting-started-one" class="appiptabs nav-tab ' 		. ( $current_tab === 'getting-started-one' ? 'nav-tab-active' : '' ) . '" href="?page=apipp-main-menu&tab=getting-started-one">' . __( 'Amazon Affiliate Account', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="getting-started-two" class="appiptabs nav-tab ' 		. ( $current_tab === 'getting-started-two' ? 'nav-tab-active' : '' ) . '" href="?page=apipp-main-menu&tab=getting-started-two">' . __( 'Amazon Product Advertising API Sign-up', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="getting-started-three" class="appiptabs nav-tab ' 	. ( $current_tab === 'getting-started-three' ? 'nav-tab-active' : '' ) . '" href="?page=apipp-main-menu&tab=getting-started-three">' . __( 'Next Steps', 'amazon-product-in-a-post-plugin' ) . '</a>';
	$pageTxtArr[] = '	<a id="getting-started-four" class="appiptabs nav-tab ' 	. ( $current_tab === 'getting-started-four' ? 'nav-tab-active' : '' ) . '" href="?page=apipp-main-menu&tab=getting-started-four">' . __( 'Need Help?', 'amazon-product-in-a-post-plugin' ) . '</a>';
	if ( has_filter( 'amazon_product_getting_started_help_tabs' ) )
		$pageTxtArr[] = apply_filters( 'amazon_product_getting_started_help_tabs', $current_tab );
	$pageTxtArr[] = '</h2>';

	$pageTxtArr[] = '	<div class="tab-content wrapper appip_getting_started_help">';

	$pageTxtArr[] = '		<div id="getting-started-one-content" class="nav-tab-content' . ( $current_tab == 'getting-started-one' ? ' active' : '' ) . '" style="' . ( $current_tab == 'getting-started-one' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<h2>' . __( 'Setting Up an Amazon Affiliate Account', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'There are 2 steps to using this plug-in to make additional income as an Amazon Affiliate. The first is to sign up for an Amazon Affiliate Account. The second is to get a set of Product Advertising API keys so the plug-in can access the product API and return the correct products. Both of these steps are a little intense, but if you have about 15-20 minutes, you can set up everything you need to start making money.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<div>';
	$pageTxtArr[] = '				<h3>' . __( 'Step 1 - Getting Your Amazon Affiliate/Partner ID', 'amazon-product-in-a-post-plugin' ) . '</h3>';
	$pageTxtArr[] = '				<p>' . __( 'Sign up for your Amazon Affiliate/Partner account at one of the following URLs (choose the correct link based on your Amazon location):', 'amazon-product-in-a-post-plugin' );
	$pageTxtArr[] = '				<ul>';
	$pageTxtArr[] = '					<li>' . __( 'Australia (com.au):', 'amazon-product-in-a-post-plugin' ) . ' <a href="https://affiliate-program.amazon.com.au/">https://affiliate-program.amazon.com.au/</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Brazil (com.br):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://associados.amazon.com.br/gp/associates/apply/main.html">http://associados.amazon.com.br/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Canada (ca):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://associates.amazon.ca/gp/associates/apply/main.html">http://associates.amazon.ca/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'China (cn):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://associates.amazon.ca/gp/associates/apply/main.html">http://associates.amazon.cn/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'France (fr):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://partenaires.amazon.fr/gp/associates/apply/main.html">http://partenaires.amazon.fr/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Germany (de):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://partnernet.amazon.de/gp/associates/apply/main.html">http://partnernet.amazon.de/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'India (in):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://affiliate-program.amazon.in/gp/associates/apply/main.html">http://affiliate-program.amazon.in/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Italy (it):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://programma-affiliazione.amazon.it/gp/associates/apply/main.html">http://programma-affiliazione.amazon.it/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Japan (co.jp):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://affiliate.amazon.co.jp/gp/associates/apply/main.html">http://affiliate.amazon.co.jp/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'Spain (es):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://afiliados.amazon.es/gp/associates/apply/main.html">http://afiliados.amazon.es/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'United Kingdom (co.uk):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://affiliate-program.amazon.co.uk/gp/associates/apply/main.html">http://affiliate-program.amazon.co.uk/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '					<li>' . __( 'United States (com):', 'amazon-product-in-a-post-plugin' ) . ' <a href="http://affiliate-program.amazon.com/gp/associates/apply/main.html">http://affiliate-program.amazon.com/gp/associates/apply/main.html</a> </li>';
	$pageTxtArr[] = '				</ul>';
	$pageTxtArr[] = '				<p>' . __( 'Amazon requires that you have a different affiliate ID for each country (aka, locale).', 'amazon-product-in-a-post-plugin' ).'</p>';
	$pageTxtArr[] = '				<p>' . __( 'Since the Affiliate signup has not changed much over the years, and it is not too difficult, I will not go into it in any more detail. Follow the steps until you are issued your affiliate partner ID. Paste that into the plug-in options page.', 'amazon-product-in-a-post-plugin' ).'</p>';
	$pageTxtArr[] = '			</div>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '			<a class="button button-primary" href="?page=apipp-main-menu&tab=getting-started-two">Next Step &raquo;</a>';
	$pageTxtArr[] = '		</div>';

	$pageTxtArr[] = '		<div id="getting-started-two-content" class="nav-tab-content' . ( $current_tab == 'getting-started-two' ? ' active' : '' ) . '" style="' . ( $current_tab == 'getting-started-two' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<h2>' . __( 'Step 2 - Signing Up for the Amazon Product Advertising API', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'This next step can be a little frustrating and one of the most time consuming. Not for the amount of actual time it takes to sign up, but for the time you may have to wait to get your API approval.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<p>' . __( 'After you have created your Amazon Affiliate Account, sign in. Then go to "TOOLS" and "Product Advertising API". If your account was approved previously (if you already had an account), then you can move right on to signing up for the Product Advertising API.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<p><b>' . __( 'If your account is not yet approved, there are some things you need to be aware of:', 'amazon-product-in-a-post-plugin' ) . '</b></p>';
	$pageTxtArr[] = '			<ul style="list-style-type: disc;border-left: 0 none;"><li>' . __( 'As of May 1, 2018, Amazon now requires complete approval of your affiliate account before you can use the Product Advertising API. This makes it difficult to use this plugin immediately for most people. If you already have an approved Affiliate account from prior to May 1, 2018, then it should be much easer for you.' ) . '</li>';
	$pageTxtArr[] = '			<li>' . __( 'If your account requires approval (most will unless you already have one from prior), you will see an information message like this on the Advertising API page. This means they are still reviewing your site/application for the Amazon Affiliate program and you will have to wait until that process is completed before you can use this plugin fully.' ) ;
	$pageTxtArr[] = '			<br><img border="0" alt="Amazon API Notice" src="'.plugins_url('/images/api-notice.jpg',dirname(__FILE__)).'" style="width:100%;max-width:1094px;height:auto;"></li>';
	$pageTxtArr[] = '			<li><b>' . __( 'The approval process takes time!', 'amazon-product-in-a-post-plugin' ) .'</b> ' . __( 'Amazon will not fully approve the affiliate account until after you make a few sales. They require 3 sales in the first 180 days after signup, before they will review your site for complete approval.' ) . '</li>';
	$pageTxtArr[] = '			<li>' . __( 'Using Amazon\'s other link building methods (located on the affiliate site), you will need to create a few links to start generating traffic and get a few sales. You can start setting up your site (if you have not done so already) and add the links into products or sidebars.', 'amazon-product-in-a-post-plugin' ).'</li>' ;
	$pageTxtArr[] = '			<li>' . __( 'After you generate a few sales, you will then be able to use the plugin to create actual product layouts on your site.', 'amazon-product-in-a-post-plugin' ).'</li>' ;	
	$pageTxtArr[] = '			<li>' . __( 'See the "Next Steps" tab for some helpful tips on getting approved by Amazon.', 'amazon-product-in-a-post-plugin' ).'</li>' ;	
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<p><span class="updated">'. __( 'IMPORTANT! Once you get access to the Amazon Product Advertisig API and receive your API Keys, DO NOT give then outto just anyone. Intentionally disclosing your Secret Key to other parties is against Amazon\'s terms of use and is considered grounds for account suspension or deletion (without payment of any due earnings). They take the key security very seriously and you can be held accountable for any misuse of your keys, should you give them out to anyone. So keep them secret. If you request help from us to solve an issue, we may ask you to change your keys after we are done helping you - just so you can feel safe and secure about the secrecy of your keys.','amazon-product-in-a-post-plugin').'</span></p>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '			<a class="button button-primary" href="?page=apipp-main-menu&tab=getting-started-three">Next Steps &raquo;</a>';
	$pageTxtArr[] = '			<div style="margin-top: 40px;margin-left: 0;">';
	$pageTxtArr[] = '				<h2>'. __( 'MISC Information','amazon-product-in-a-post-plugin').'</h2>';
	$pageTxtArr[] = '				<p>'. __( 'If already have an approved Amazon Affiliate Account and you are using the Amazon IAM Management Console, your Access Key ID will be located under the "Your Security Credentials" page. They will NOT show you your Secret Access Key here. If you loose it, you MUST generate a new Root Key.','amazon-product-in-a-post-plugin').'</p>';
	$pageTxtArr[] = '				<p>'. __( 'After you generate the Root Key, it will serve the browser with a csv file that has both the Access Key ID and the Secret Access Key inside.','amazon-product-in-a-post-plugin').'<br><img border="0" src="'.plugins_url('/images/signup-step-misc1.png',dirname(__FILE__)).'" width="545" height="360"> <img border="0" src="'.plugins_url('/images/signup-step-misc2.png',dirname(__FILE__)).'" width="545" height="358"></p>';
	$pageTxtArr[] = '			</div>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '			<a class="button button-primary" href="?page=apipp-main-menu&tab=getting-started-three">Next Steps &raquo;</a>';
	$pageTxtArr[] = '		</div>';
	
	$pageTxtArr[] = '		<div id="getting-started-three-content" class="nav-tab-content' . ( $current_tab == 'getting-started-three' ? ' active' : '' ) . '" style="' . ( $current_tab == 'getting-started-three' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<h2>' . __( 'Next Steps', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'To ensure that your Amazon Affiliate application is accepted, you will need to follow some trusted guidelines:', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<ul style="list-style-type: disc;border-left: 0 none;">';
	$pageTxtArr[] = '				<li><strong>' . __( 'Your website needs to be LIVE.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'If your website is not live, or you have an "under construction page" or a Maintenance page displayed, you will not be approved.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Add the required Disclaimer to your site.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'See below for information on the disclaimer. Amazon WILL NOT approve your site without one', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Set up a few products links.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'If you are a new affiliate, your site needs to have some links or buttons to Amazon products. Amazon wants to see that you are linking correctly according to their terms of service agreement.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Have some unique content.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'You need to have some other content besides just Amazon Links or Products. If all you have is a site with links to Amazon, you will not be approved. Add some content to your pages like your own review or even some helpful information about the product you are trying to sell. The most successful Amazon affiliates use products to enhance their unique content.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Limit Banners/Ads on the site.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'If your site uses an lot of advertising but does not have a lot of content, then Amazon will not approve you. They do not like sites that are Ad heavy. You should have more content than you do advertisements. Ad heavy sites look like revenue traps to the visitor and Amazon does not want to be associated with that.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Make your products relevant to your site\'s focus/market', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'Try to use relevant products whenever possible. For example, if you blob about Home Gardening, use products related to Home Gardening - not TVs or Electronics. Amazon will see you are serious about your affiliate account if you have relative products with a good proportion of unique content to products.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'Be Patient.', 'amazon-product-in-a-post-plugin' ) . '</strong><br>' . __( 'It can take several weeks or longer for Amazon to review everything and they will not fully approve the application until after you refer 3 sales in within the first 180 days after you sign up.', 'amazon-product-in-a-post-plugin' ) . '</li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<p>' . __( 'After your affiliate account is approved, you can make some "tweaks" if needed - mainly you can start adding products via the plugin to make things easier. Don\'t immediately throw in tons of products or stop adding content and only products. If Amazon gets a complaint or they think you are abusing the terms of use, they can review the site again and decide to revoke your affiliate account. Once they do that, you have very little chance of getting it back.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '			<h2>' . __( 'An Amazon Disclaimer for your site', 'Amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'All Amazon Affiliates that sell products on their websites are required to have a disclaimer on their site in a visible location that states that they are earning money from Amazon sales. We recommend that you add something like the following statement to your site footer or in a sidebar widget near the bottom of your site (change <strong>[Website Name]</strong> to your website name):', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<blockquote>' . __( '[Website Name] is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for website owners to earn advertising fees by advertising and linking to amazon.com, audible.com, and any other website that may be affiliated with Amazon Service LLC Associates Program. As an Amazon Associate [I or we] earn from qualifying purchases.</span>', 'amazon-product-in-a-post-plugin' ) . '</blockquote>';	
	$pageTxtArr[] = '			<p>' . __( 'If you want to use a shorter disclaimer, you must, at the very least, use something like this:', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<blockquote>' . __( 'As an Amazon Associate [I or we] earn from qualifying purchases.</span>', 'amazon-product-in-a-post-plugin' ) . '</blockquote>';	
	$pageTxtArr[] = '			<p>' . __( 'The above disclaimer is the correct minimum according to Amazon\'s Terms of Service/Use as of May 1, 2018. This may change so be sure to check the terms of use regularly.', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '		</div>';
	
	$pageTxtArr[] = '		<div id="getting-started-four-content" class="nav-tab-content' . ( $current_tab == 'getting-started-four' ? ' active' : '' ) . '" style="' . ( $current_tab == 'getting-started-four' ? 'display:block;' : 'display:none;' ) . '">';
	$pageTxtArr[] = '			<h2>' . __( 'Need Help?', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	$pageTxtArr[] = '			<p>' . __( 'If you need help trying to figure out what you need to do to be approved, or you want us to help you set up your site so you will be approved, please let us know.', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<p>' . __( 'We do charge a very modest fee for this service. Costs generally range from about $50 to $250 depending on how much help you need setting everything up.', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<p>' . __( 'Please email us at', 'amazon-product-in-a-post-plugin' ) . '<strong> <a href="mailto:help@fischercreativemedia.com">help@fischercreativemedia.com</a></strong>. ' . __( 'Or call us at', 'amazon-product-in-a-post-plugin' ) . ' (408) 239-4119 ' . __( 'M-F 9:00am - 4:00pm Pacific.', 'amazon-product-in-a-post-plugin' ) . '</p>';	
	$pageTxtArr[] = '			<p><strong>' . __( 'What we CAN help with:', 'amazon-product-in-a-post-plugin' ) . '</strong></p>';	
	$pageTxtArr[] = '			<ul style="list-style-type: disc;border-left: 0 none;">';
	$pageTxtArr[] = '				<li><strong>' . __( 'Give you guidance on what you need to do on your site to increase your chances of being approved by Amazon.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We can add disclaimers to your site that comply with Amazon\'s terms of service.' , 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We can add Amazon Banners or Promotions.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We can give suggestions on the type of links or products that are a right fit for your site.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We can help fix general WordPress errors and issues.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<p><strong>' . __( 'What we CAN\'T help with:', 'amazon-product-in-a-post-plugin' ) . '</strong></p>';	
	$pageTxtArr[] = '			<ul style="list-style-type: disc;border-left: 0 none;">';
	$pageTxtArr[] = '				<li><strong>' . __( 'We cannot sign up for your Affiliate Account or Product Advertising API account for you.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We cannot set up all of your products for you (well, <em>we can</em>, but the costs will be much greater than $250).' , 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We cannot generate Amazon sales/traffic for you.', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '				<li><strong>' . __( 'We cannot create your website for you (again, <em>we can</em>, but the costs will be much greater than $250).', 'amazon-product-in-a-post-plugin' ) . '</strong></li>';
	$pageTxtArr[] = '			</ul>';
	$pageTxtArr[] = '			<p>' . __( 'If you need help with anything other than plugin related items, please contact us for a quote on our services - i.e., General WordPress consulting, Theme Programming/Modifications, Plugin creation/modification - or just about any WordPress related item.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$pageTxtArr[] = '			<hr/>';
	$pageTxtArr[] = '		</div>';

	if ( has_filter( 'amazon_product_getting_started_help_content' ) )
		$pageTxtArr[] = apply_filters( 'amazon_product_getting_started_help_content', $current_tab );

	$pageTxtArr[] = '	</div>';
	$pageTxtArr[] = '</div>';
	echo implode( "\n", $pageTxtArr );
	unset( $pageTxtArr );
	//echo '	</div>';
	//echo '</div>';
}

function apipp_options_faq_page() {
	include_once( ABSPATH . WPINC . '/feed.php' );
	echo '
		<div class="wrap">
			<style type="text/css">
				.faq-item{border-bottom:1px solid #CCC;padding-bottom:10px;margin-bottom:10px;}
				.faq-item span.qa{color: #21759B;display: block;float: left;font-family: serif;font-size: 17px;font-weight: bold;margin-left: 0;margin-right: 5px;}
				 h3.qa{color: #21759B;margin:0px 0px 10px 0;font-family: serif;font-size: 17px;font-weight: bold;}
				.faq-item .qa-content p:first-child{margin-top:0;}
				.apipp-faq-links {border-bottom: 1px solid #CCCCCC;list-style-position: inside;margin:10px 0 15px 35px;}
				.apipp-faq-answers{list-style-position: inside;margin:10px 0 15px 35px;}
				.toplink{text-align:left;}
				.qa-content div > code{background: none repeat scroll 0 0 #EFEFEF;border: 1px solid #CCCCCC;display: block;margin-left: 35px;overflow-y: auto;padding: 10px 20px;white-space: nowrap;width: 90%;}
			</style>
			<div class="icon32" style="background: url(' . plugins_url( "/", dirname( __FILE__ ) ) . 'images/aicon.png) no-repeat transparent;"><br/></div>
		 	<h2>' . __( 'Amazon Product in a Post FAQs/Help', 'amazon-product-in-a-post-plugin' ) . '</h2>
			<div align="left"><p>' . sprintf( __( 'The FAQS are now on a feed that can be updated on the fly. If you have a question and don\'t see an answer, please send an email to %1$s and ask your question. If it is relevant to the plugin, it will be added to the FAQs feed so it will show up here. Please be sure to include the plugin you are asking a question about (Amazon Product in a Post Plugin), the Debugging Key (located on the options page) and any other information like your WordPress version and examples if the plugin is not working correctly for you. THANKS!', 'amazon-product-in-a-post-plugin' ), '<a href="mailto:plugins@fischercreativemedia.com">plugins@fischercreativemedia.com</a>' ) . '</p>
			<hr noshade color="#C0C0C0" size="1" />
		';
	$rss = fetch_feed( 'http://www.fischercreativemedia.com/?feed=apipp_faqs' );
	$linkfaq = array();
	$linkcontent = array();
	if ( !is_wp_error( $rss ) ):
		$maxitems = $rss->get_item_quantity( 100 );
	$rss_items = $rss->get_items( 0, $maxitems );
	endif;
	$aqr = 0;
	if ( $maxitems != 0 ) {
		foreach ( $rss_items as $item ):
			$aqr++;
		$linkfaq[] = '<li class="faq-top-item"><a href="#faq-' . $aqr . '">' . esc_html( $item->get_title() ) . '</a></li>';
		$linkcontent[] = '<li class="faq-item"><a name="faq-' . $aqr . '"></a><h3 class="qa"><span class="qa">Q. </span>' . esc_html( $item->get_title() ) . '</h3><div class="qa-content"><span class="qa answer">A. </span>' . $item->get_content() . '</div><div class="toplink"><a href="#faq-top">top &uarr;</a></li>';
		endforeach;
	}
	echo '<a name="faq-top"></a><h2>' . __( 'Table of Contents', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	echo '<ol class="apipp-faq-links">';
	echo implode( "\n", $linkfaq );
	echo '</ol>';
	echo '<h2>' . __( 'Questions/Answers', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	echo '<ul class="apipp-faq-answers">';
	echo implode( "\n", $linkcontent );
	echo '</ul>';
	echo '
			</div>
		</div>';
}

function apipp_templates() {
	echo '<div class="wrap">';
	echo '<h2>' . __( 'Amazon Styling Options', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	echo '<div id="wpcontent-inner">';
	echo 'This is a future feature.';
	echo '</div>';
	echo '</div>';
}

function apipp_add_new_post() {
	global $user_ID;
	global $current_user;
	//get_currentuserinfo();
	//wp_get_current_user();
	$myuserpost = wp_get_current_user()->ID;
	echo '<div class="wrap"><h2>' . __( 'Add New Amazon Product Post', 'amazon-product-in-a-post-plugin' ) . '</h2>';
	if ( isset( $_GET[ 'appmsg' ] ) && $_GET[ 'appmsg' ] == '1' ) {
		echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade below-h2"><p><b>' . __( 'Product post has been saved. To edit, use the standard Post Edit options.', 'amazon-product-in-a-post-plugin' ) . '</b></p></div>';
	}
	echo '<p>' . __( 'This function will allow you to add a new post for an Amazon Product - no need to create a post then add the ASIN. Once you add a Product Post, you can edit the information with the normal Post Edit options.', 'amazon-product-in-a-post-plugin' ) . '</p>';
	$ptypes = get_post_types( array( 'public' => true ) );
	$ptypeHTML = '<div class="apip-posttypes">';
	$taxonomies = get_taxonomies( array(), 'objects' );
	$section = '';
	$section .= '<tr class="apip-extra-pad-bot taxonomy_blocks taxonomy_block_page"><td align="left" valign="top">' . __( 'Category/Taxonomy for Pages', 'amazon-product-in-a-post-plugin' ) . ':</td><td align="left">';
	$section .= '<div>' . __( 'No Categories/Taxonomy Available for Pages.', 'amazon-product-in-a-post-plugin' ) . '</div>';
	$section .= '</td></tr>';

	if ( !empty( $taxonomies ) ) {
		foreach ( $taxonomies as $key => $taxCat ) {
			if ( isset( $taxCat->object_type ) && is_array( $taxCat->object_type ) ) {
				foreach ( $taxCat->object_type as $tcpost ) {
					if ( in_array( $tcpost, $ptypes ) && ( $tcpost != 'nav_menu_item' && $tcpost != 'attachment' && $tcpost != 'revision' ) ) {
						$argsapp = array( 'taxonomy' => $key, 'orderby' => 'name', 'hide_empty' => 0 );
						$termsapp = get_terms( $key, $argsapp );
						$countapp = count( $termsapp );
						if ( 'post_format' == $key || 'post_tag' == $key ) {} else {
							$section .= '<tr class="apip-extra-pad-bot taxonomy_blocks taxonomy_block_' . $tcpost . '"><td align="left" valign="top">' . __( 'Category/Taxonomy for ', 'amazon-product-in-a-post-plugin' ) . $tcpost . ':</td><td align="left">';
							if ( $countapp > 0 ) {
								foreach ( $termsapp as $term ) {
									$section .= '<div class="appip-new-post-cat"><input type="checkbox" name="post_category[' . $tcpost . '][' . $key . '][]" value="' . $term->term_id . '" /> ' . $term->name . '</div>';
								}
							} else {
								$section .= '<div>' . __( 'No Categories/Taxonomy Available for this Post type.', 'amazon-product-in-a-post-plugin' ) . '</div>';
							}
							$section .= '</td></tr>';
						}
					}
				}
			}
		}
	}
	if ( !empty( $ptypes ) ) {
		foreach ( $ptypes as $ptype ) {
			if ( $ptype != 'nav_menu_item' && $ptype != 'attachment' && $ptype != 'revision' ) {
				if ( $ptype == 'post' ) {
					$addlpaaiptxt = ' checked="checked"';
				} else {
					$addlpaaiptxt = '';
				}
				$ptypeHTML .= '<div class="apip-ptype"><label><input class="apip-ptypecb" group="appiptypes" type="radio" name="post_type" value="' . $ptype . '"' . $addlpaaiptxt . ' /> ' . $ptype . '</label></div>';
			}
		}
	}
	$ptypeHTML .= '</div>';
	$extrasec = array();
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-use-cartURL" value="1" /> <label for="amazon-product-use-cartURL"><strong>' . __( "Use Add to Cart URL?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'Uses Add to Cart URL instead of product page URL. Heps with 90 day conversion cookie.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-amazon-desc" value="1" /> <label for="amazon-product-amazon-desc"><strong>' . __( "Show Amazon Description?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. This will be IN ADDITION TO your own content.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-show-gallery" value="1" /> <label for="amazon-product-show-gallery"><strong>' . __( "Show Image Gallery?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available (Consists of Amazon Approved images only). Not all products have an Amazon Image Gallery.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-show-features" value="1" /> <label for="amazon-product-show-features"><strong>' . __( "Show Amazon Features?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-show-used-price" value="1" /> <label for="amazon-product-show-used-price"><strong>' . __( "Show Amazon Used Price?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
	$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-show-list-price" value="1" /> <label for="amazon-product-show-list-price"><strong>' . __( "Show Amazon List Price?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>' . __( 'if available. Not all items have this feature.', 'amazon-product-in-a-post-plugin' ) . '</em><br />';
/* possible remove */
//$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-show-saved-amt" value="1" /> <label for="amazon-product-show-saved-amt"><strong>' . __("Show Saved Amount?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>'.__('if available. Not all items have this feature.','amazon-product-in-a-post-plugin').'</em><br />';
//$extrasec[] = '&nbsp;&nbsp;<input type="checkbox" name="amazon-product-timestamp" value="1" /> <label for="amazon-product-show-timestamp"><strong>' . __("Show Price Timestamp?", 'amazon-product-in-a-post-plugin' ) . '</strong></label> <em>'.__('for example:','amazon-product-in-a-post-plugin').'</em><div class="appip-em-sample">&nbsp;&nbsp;'.__('Amazon.com Price: $32.77 (as of 01/07/2018 14:11 PST').' - <span class="appip-tos-price-cache-notice-tooltip" title="">'.__('Details').'</span>)</div>'.'<br />';
//$extrasec[] = '<span style="display:none;" class="appip-tos-price-cache-notice">' . __( 'Product prices and availability are accurate as of the date/time indicated and are subject to change. Any price and availability information displayed on amazon.' . APIAP_LOCALE . ' at the time of purchase will apply to the purchase of this product.', 'amazon-product-in-a-post-plugin' ) . '</span>';
	
	echo '<form method="post" id="appap-add-new-form" action="' . add_query_arg( array( 'page' => 'apipp-add-new' ), admin_url( 'admin.php' ) ) . '">
		<input type="hidden" name="amazon-product-isactive" id="amazon-product-isactive" value="1" />
		<input type="hidden" name="post_save_type_apipp" id="post_save_type_apipp" value="1" />
		<input type="hidden" name="post_author" id="post_author" value="' . $myuserpost . '" />
		<input type="hidden" name="amazon-product-content-hook-override" id="amazon-product-content-hook-override" value="2" />
		<div align="left">
			<table border="0" cellpadding="2" cellspacing="0" class="apip-new-pppy">
				<tr>
					<td align="left" valign="top">' . __( 'Title', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left"><input type="text" name="post_title" size="65" /><br/><em>If you want the post title to be the title of the product, you can leave this blank and the plugin will try to set the product title as the Post title.</em></td>
				</tr>
				<tr>
					<td align="left" valign="top">' . __( 'Post Status', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left"><select size="1" name="post_status" >
					<option selected>draft</option>
					<option>publish</option>
					<option>private</option>
					</select></td>
				</tr>
				<tr>
					<td align="left" valign="top">' . __( 'Post Type', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left">' . $ptypeHTML . '</td>
				</tr>
				<tr>
					<td align="left" valign="top">' . __( 'Amazon ASIN Number', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left"><input type="text" name="amazon-product-single-asin" size="29" />&nbsp;<em>' . __( 'You can use up to 10 comma separated ASINs.', 'amazon-product-in-a-post-plugin' ) . '</em></td>
				</tr>
				<tr>
					<td align="left" valign="top">' . __( 'Split ASINs?', 'amazon-product-in-a-post-plugin' ) . '</td>
					<td align="left"><input type="checkbox" id="split_asins" name="split_asins" value="1"><em>&nbsp;&nbsp;' . __( 'Check to make all ASINs individual posts/pages', 'amazon-product-in-a-post-plugin' ) . '</em></td>
				</tr>
				<tr class="apip-extra-pad-bot">
					<td align="left" valign="top">' . __( 'Post Content', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left">
					<textarea rows="11" name="post_content" id="post_content_app" cols="56"></textarea></td>
				</tr>
				<tr class="apip-extra-pad-bot">
					<td align="left" valign="top">' . __( 'Product Location', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left">
						&nbsp;&nbsp;<input type="radio" name="amazon-product-content-location[1][]" value="1"  checked /> ' . __( '<strong>Above Post Content </strong><em>- Default - Product will be first then post text</em>', 'amazon-product-in-a-post-plugin' ) . '<br />
						&nbsp;&nbsp;<input type="radio" name="amazon-product-content-location[1][]" value="3" /> ' . __( '<strong>Below Post Content</strong><em> - Post text will be first then the Product</em>', 'amazon-product-in-a-post-plugin' ) . '<br />
						&nbsp;&nbsp;<input type="radio" name="amazon-product-content-location[1][]" value="2" /> ' . __( '<strong>Post Text becomes Description</strong><em> - Post text will become part of the Product layout</em>', 'amazon-product-in-a-post-plugin' ) . '<br />
					</td>
				</tr>
				<tr class="apip-extra-pad-bot">
					<td align="left" valign="top">' . __( 'Additional Items', 'amazon-product-in-a-post-plugin' ) . ':</td>
					<td align="left">' . implode( "\n", $extrasec ) . '</td>
				</tr>
				' . $section . '
			</table>
			<br/>
			<div class="createpost-wrapper"><input type="submit" value="' . __( 'Create Product & Return Here', 'amazon-product-in-a-post-plugin' ) . '" name="createpost" class="button-primary create-appip-product" /> <input type="submit" value="' . __( 'Create Product & Edit NOW', 'amazon-product-in-a-post-plugin' ) . '" name="createpost_edit" class="button-primary" /></div>
			<!--div class="createpost-wrapper"><a href="' . add_query_arg( array( 'action' => 'action_appip_do_product', 'security' => wp_create_nonce( 'appip_ajax_do_product' ), 'tab' => 'changelog', 'width' => 600, 'height' => 500, 'plugin' => 'plugin-name', 'section' => 'changelog', 'TB_iframe' => true ), admin_url( 'admin-ajax.php' ) ) . '" name="createpost" class="button-primary create-appip-product">' . __( 'Create Product & Return Here', 'amazon-product-in-a-post-plugin' ) . '</a> <input type="submit" value="' . __( 'Create Amazon Product Post & Edit NOW', 'amazon-product-in-a-post-plugin' ) . '" name="createpost" class="button-primary" /></div-->
		</div>
	</form>
	</div>';
}