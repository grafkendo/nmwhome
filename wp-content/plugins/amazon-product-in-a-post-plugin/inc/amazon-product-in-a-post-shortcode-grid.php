<?php
// if someone has the shortcode plugin add-on installed, let it be - otherwise:
if ( !class_exists( 'amazonAPPIP_ShortcodeGrid_plugin' ) ) {
	class AmazonProduct_Shortcode_Grid extends AmazonProduct_ShortcodeClass {

		function _setup() {
			add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ), 100 );
			add_filter( 'amazon-grid-fields', array( $this, 'add_fields' ) );
			add_filter( 'amazon-grid-columns', array( $this, 'grid_columns' ) );
			add_filter( 'amazon_product_shortcode_help_content', array( $this, 'do_added_shortcode_help_content' ), 100, 2 );
			add_filter( 'amazon_product_shortcode_help_tabs', array( $this, 'do_added_shortcode_help_tab' ), 100, 2 );
			add_filter( 'amazon_product_in_a_post_plugin_shortcode_list', array($this,'shortcode_list') );
		}
		
		public function shortcode_list($text = array()){
			$text[] = '<li><a href="?page=apipp_plugin-shortcode&tab=amazon-product-grid" class="amazon-product-grid"><strong>amazon-grid</strong></a><br/>' . __( 'A Shortcode for displaying Amazon Prodcts in a Grid.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			return $text;
		}
		
		public function do_shortcode( $atts, $content = '' ) {
			global $post;
			global $apippopennewwindow;
			global $apippnewwindowhtml;

			$lgimg_txt = apply_filters( 'amazon-grid-seelgimg-text', __( 'see larger image', 'amazon-product-in-a-post-plugin' ) );
			$defaults = array(
				'asin' => '',
				'locale' => APIAP_LOCALE,
				'partner_id' => APIAP_ASSOC_ID,
				'private_key' => APIAP_SECRET_KEY,
				'public_key' => APIAP_PUB_KEY,
				'fields' => apply_filters( 'amazon-grid-fields', 'image,title,new-button', $post ),
				'target' => apply_filters( 'amazon-grid-target', '_blank', $post ),
				'button_url' => apply_filters( 'amazon-grid-button-img-url', '', $post ),
				'use_carturl' => ( bool )apply_filters( 'amazon-grid-carturl', false, $post ),
				'columns' => ( int )apply_filters( 'amazon-grid-columns', 3, $post ),
				'newWindow' => '',
				'button' => '',
				'container' => apply_filters('amazon-grid-container','div'),
				'container_class' => apply_filters('amazon-grid-container-class','amazon-grid-wrapper'),
			);
			extract( shortcode_atts( $defaults, $atts ) );
			if($target == '' && $newWindow == 'true' )
				$target = '_blank';
			if($target != '' && $newWindow == '' )
				$target = '';
			$wrap 		= str_replace(array('<','>'), array('',''),$container);
			$prodLinkField = apply_filters( 'amazon-grid-link', 'DetailPageURL', $post ); //CartURL
			$target = $target != '' ? ' target="' . $target . '" ': '';
			$target = $target === '' && (bool) $apippopennewwindow ?  $apippnewwindowhtml : $target;
			$new_button_arr = amazon_product_get_new_button_array($locale);
			
			if ( $asin != '' ) {
				$aws_id = $partner_id;
				$ASIN = ( is_array( $asin ) && !empty( $asin ) ) ? implode( ',', $asin ) : $asin;
				$asinR = explode( ",", trim( str_replace( ', ', ',', $ASIN ) ) );
				/* New Button functionality */
				if($button != ''){
					$buttonstemp = explode(',', $button );
					unset($button);
					if( count($buttonstemp) === 1 && count($asinR) > 1){
						foreach($asinR as $kba => $kbv ){
							$button[] = $buttonstemp[0];
						}
					}else{
						foreach($buttonstemp as $buttona){
							if(!empty($buttona)){
								$button[] = $buttona;
							}
						}
					}
				}else{
					$button = array();
				}
				/* END New Button functionality */
				$errors = '';
				$pxmlNew = amazon_plugin_aws_signed_request( $locale, array( "Operation" => "ItemLookup", "ItemId" => $ASIN, "ResponseGroup" => "Large", "IdType" => "ASIN", "AssociateTag" => $aws_id ), $public_key, $private_key );
				$totalResult1 = array();
				$totalResult2 = array();
				$errorsArr = array();
				$buyamzonbutton = apply_filters( 'appip_amazon_button_url', $button_url, '', $locale );
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
				$resultarr = array();
				if ( !empty( $pxmle ) ) {
					return false;
				} else {
					$resultarr1 = isset( $totalResult1 ) && !empty( $totalResult1 ) ? $totalResult1 : array();
					$resultarr2 = isset( $totalResult2 ) && !empty( $totalResult2 ) ? $totalResult2 : array();
					if ( is_array( $resultarr1 ) && !empty( $resultarr1 ) ) {
						foreach ( $resultarr1 as $key1 => $result1 ):
							$mainAArr = ( array )$result1;
						$otherArr = ( array )$resultarr2[ $key1 ];
						$resultarr[ $key1 ] = ( array )array_merge( $mainAArr, $otherArr );
						ksort( $resultarr[ $key1 ] );
						endforeach;
					}
					$arr_position = 0;
					if ( is_array( $resultarr ) ):
						$retarr = array();
						$newErr = '';
						$thenewret = array();
						foreach ( $resultarr as $key => $result ):
							$currasin = $result[ 'ASIN' ];
							if ( isset( $result[ 'NoData' ] ) && $result[ 'NoData' ] == '1' ):
								echo '<'.$wrap.' style="display:none;" class="appip-errors">APPIP ERROR:nodata[' . str_replace( ']-->', ']->', $result[ 'Error' ] ) . '</'.$wrap.'>';
							elseif ( empty( $result[ 'ASIN' ] ) || $result[ 'ASIN' ] == 'Array' ):
								echo '<'.$wrap.' style="display:none;" class="appip-errors">APPIP ERROR:nodata[ (' . $key . ') NO DATA </'.$wrap.'>';
							else :
								$img2 = '';
								$linkURL = ( $prodLinkField == 'CartURL' ) ? str_replace( array( '##REGION##', '##AFFID##', '##SUBSCRIBEID##' ), array( $locale, $aws_id, $public ), $result[ 'CartURL' ] ) : $result[ $prodLinkField ];
								if ( $result[ 'Errors' ] != '' )
									$newErr = '<'.$wrap.' style="display:none;" class="appip-errors">HIDDEN APIP ERROR(S): ' . $result[ 'Errors' ] . '</'.$wrap.'>';
								$fielda = is_array( $fields ) ? $fields : explode( ',', str_replace( ' ', '', $fields ) );
								if( (bool) $apippopennewwindow )
									$nofollow = ' rel="nofollow noopener"';
								else
									$nofollow = ' rel="nofollow"';
								$nofollow = apply_filters( 'appip_template_add_nofollow', $nofollow, $result );
								foreach ( $fielda as $fieldarr ) {
									switch ( strtolower( $fieldarr ) ) {
										case 'title':
											$NewTitle = $result[ "Title" ];
											$retarr[ $currasin ][ $fieldarr ] = '<h3 class="amazon-grid-title-h3"><a href="' . $linkURL . '" ' . $target . $nofollow . '>' . $NewTitle . '</h3></a>';
											break;
										case 'image':
										case 'lg-image':
											$img1 = isset( $result[ "LargeImage" ] ) && $result[ "LargeImage" ] != '' ? '<a href="' . $linkURL . '" ' . $target . $nofollow . '><img src="' . $result[ "LargeImage" ] . '" alt="'.(apply_filters('appip_alt_text_main_img',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" ></a>': '';
											$img2 = $img1 == '' && isset( $result[ "LargeImage" ] ) ? '<a href="' . $linkURL . '" ' . $target . $nofollow . '><img src="' . $result[ "LargeImage" ] . '" alt="'.(apply_filters('appip_alt_text_main_img',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" ></a>': $img1;
											$retarr[ $currasin ][ $fieldarr ] = $img2;
											break;
										case 'sm-image':
											$img1 = isset( $result[ "SmallImage" ] ) && $result[ "SmallImage" ] != '' ? '<a href="' . $linkURL . '" ' . $target . $nofollow . '><img src="' . $result[ "SmallImage" ] . '" alt="'.(apply_filters('appip_alt_text_main_img',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" ></a>': '';
											$img2 = $img1 == '' && isset( $result[ "SmallImage" ] ) ? '<a href="' . $linkURL . '" ' . $target. $nofollow . '><img src="' . $result[ "SmallImage" ] . '" alt="'.(apply_filters('appip_alt_text_main_img',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" ></a>': $img1;
											$retarr[ $currasin ][ $fieldarr ] = $img2;
											break;
										case 'author':
											$retarr[ $currasin ][ $fieldarr ] = isset( $result[ "ItemAttributes_Author" ] ) && !empty( $result[ "ItemAttributes_Author" ] ) ? '<span class="label">Author:</span> ' . $result[ "ItemAttributes_Author" ] : '';
											break;
										case 'new-price':
										case 'new_price':
										case 'price':
											$newPrice = isset($result["NewAmazonPricing"]['New']['Price'] ) ? $result[ "NewAmazonPricing" ]['New']['Price'] : '' ;
											if ( isset( $result["Binding"] ) && "Kindle Edition" === $result["Binding"] ) {
												//$newPrice = $result["Offers_Offer_OfferListing_Price_FormattedPrice"];
											} elseif ( isset( $result['NewAmazonPricing']['New']['Price'] ) ) {
												$newPrice = $result["NewAmazonPricing"]["New"]["Price"];
											}
											$subscription = $result['SubscriptionLength'] != '' ? $result['SubscriptionLength'] : '' ;
											if( $subscription !== '' ){
												if($result['SubscriptionLengthUnits'] === 'days' && $subscription === '36599999' )
													$subscription = '365';
												if($subscription === '1')
													$result['SubscriptionLengthUnits'] = str_replace(array('days','months','years','weeks'),array('day','month','year','week'),$result['SubscriptionLengthUnits']);
												$retarr[$currasin][$fieldarr] = '<span class="label">'.__('Subscription: ','amazon-product-in-a-post-plugin').'</span> ' . $newPrice . ' for '. $subscription . ' ' . $result['SubscriptionLengthUnits'];
											}elseif($newPrice !== ''){
												$retarr[$currasin][$fieldarr] = '<span class="label">'.__('New:','amazon-product-in-a-post-plugin').'</span> ' . $newPrice;
											}else{
												$retarr[$currasin][$fieldarr] = __('Check Amazon for Pricing','amazon-product-in-a-post-plugin');
											}
											break;
										case 'used':
											$usedPrice = isset( $result[ "OfferSummary_LowestUsedPrice_FormattedPrice" ] ) ? $result[ "OfferSummary_LowestUsedPrice_FormattedPrice" ] : '';
											if ( isset( $result[ "NewAmazonPricing" ][ "Used" ][ "Price" ] ) ) {
												$usedPrice = $result[ "NewAmazonPricing" ][ "Used" ][ "Price" ];
											}
											if ( $usedPrice != '' ){
												$retarr[ $currasin ][ $fieldarr ] = '<span class="label">'.__('Used:','amazon-product-in-a-post-plugin').'</span> ' . $newPrice;
											}
											break;
										case 'new-button':
											$button_class = ' class="btn btn-primary"';
											$button_txt = __('Read More','amazon-product-in-a-post-plugin');
											$retarr[ $currasin ][ $fieldarr ] = '<a ' . $target . $nofollow . $button_class . ' href="' . $linkURL . '">' . $button_txt . '</a>';
											break;
										case 'button':
											if ( isset( $button_url[ $arr_position ] ) ) {
												$retarr[ $currasin ][ $fieldarr ] = '<a ' . $target . $nofollow . ' href="' . $linkURL . '"><img src="' . $button_url[ $arr_position ] . '" alt="'.(apply_filters('appip_amazon_button_alt_text',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" border="0" /></a>';
											} else {
												if(isset($button[$arr_position])){
													$bname 		= $button[$arr_position];
													$brounded 	= strpos($bname,'rounded') !== false ? true : false;
													$bclass 	= isset($new_button_arr[$bname]['color']) ? 'amazon__btn'.$new_button_arr[$bname]['color'].' amazon__price--button--style'.( $brounded ? ' button-rounded' : '') : 'amazon__btn amazon__price--button--style';
													$btext 		= isset($new_button_arr[$bname]['text']) ? esc_attr($new_button_arr[$bname]['text']) : _x('Buy Now', 'button text', 'amazon-product-in-a-post-plugin' );
													$retarr[$currasin][$fieldarr] = '<a ' . $target . $nofollow . ' href="' . $linkURL . '" class="' . $bclass . '">' . $btext . '</a>';
												}else{
													$retarr[ $currasin ][ $fieldarr ] = '<a ' . $target . $nofollow . ' href="' . $linkURL . '"><img src="' . $buyamzonbutton . '" border="0" alt="'.(apply_filters('appip_amazon_button_alt_text',__('Buy Now','amazon-product-in-a-post-plugin'),$currasin)).'" /></a>';
												}
											}
											break;
										case 'large-image-link':
											$appip_text_lgimage = apply_filters('appip_text_lgimage', __( "See larger image", 'amazon-product-in-a-post-plugin' ));
											if(isset($result['LargeImage']) && $result['LargeImage'] !== '' ){
												$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-link-wrapper"><a rel="appiplightbox-'.$result['ASIN'].'" href="#" data-appiplg="'. checkSSLImages_url($result['LargeImage']) .'"><span class="amazon-element-large-img-link">'.$appip_text_lgimage.'</span></a></'.$wrap.'>';
											}
											break;
										default:
											if ( preg_match( '/\_clean$/', $fieldarr ) ) {
												$tempfieldarr = str_replace( '_clean', '', $fieldarr );
												$retarr[ $currasin ][ $fieldarr ] = isset( $result[ $tempfieldarr ] ) && $result[ $tempfieldarr ] != '' ? $result[ $tempfieldarr ] : '';
											} else {
												if ( isset( $result[ $fieldarr ] ) && $result[ $fieldarr ] != '' && $result[ $fieldarr ] != '0' ) {
													$retarr[ $currasin ][ $fieldarr ] = $result[ $fieldarr ];
												} else {
													$retarr[ $currasin ][ $fieldarr ] = '';
												}
											}
											break;
									}
								}
							endif;
					
							/* 
							NEW Filter Version - only applies filter to current ASIN
							while not breaking the filter.
							*/
							$temparr 	= array('temp' => $retarr[ $currasin ] );
							$temparr	= apply_filters( 'amazon-grid-elements-filter', $temparr );
							$retarr[ $currasin ] = $temparr['temp'];
							/* 
							OLD Filter version - applied the filter to the entire array
							everytime instead of just the current ASIN. BAD!!
							$retarr	= apply_filters( 'amazon-grid-elements-filter', $retarr );
							*/
					
							if ( is_array( $retarr[ $currasin ] ) && !empty( $retarr[ $currasin ] ) ) {
								$thenewret[] = '<'.$wrap.' class="amazon-grid-element amz-grid-' . $columns . '">';
								foreach ( $retarr[ $currasin ] as $key => $val ) {
									if ( $key != '' ) {
										if ( preg_match( '/\_clean$/', $key ) )
											$thenewret[] = $val;
										else
											$thenewret[] = '<'.$wrap.' class="amazon-grid-' . $key . '">' . $val . '</'.$wrap.'>';
									}
								}
								$thenewret[] = '</'.$wrap.'>';

							}
							$arr_position++;
						endforeach;

						if ( $newErr != '' )
							echo $newErr;
						if ( is_array( $thenewret ) ) {
							$final = '<'.$wrap.' class="'.$container_class.'">' . implode( "\n", $thenewret ) . '</'.$wrap.'>';
							return $final;
						}
						return false;
					endif;
				}
			} else {
				return false;
			}
		}

		public function do_added_shortcode_help_content( $content = array(), $current_tab = '' ) {
			$pageTxtArr = array();
			$pageTxtArr[] = '		<div id="amazon-product-grid-content" class="nav-tab-content' . ( $current_tab == 'amazon-product-grid' ? ' active' : '' ) . '" style="' . ( $current_tab == 'amazon-product-grid' ? 'display:block;' : 'display:none;' ) . '">';
			$pageTxtArr[] = '			<h2>[amazon-grid] ' . __( 'Shortcode', 'amazon-product-in-a-post-plugin' ) . '</h2>';
			$pageTxtArr[] = '			<p>' . __( 'Shortcode implementation for a grid style layout &mdash; for when you may only want rows of products in set columns.', 'amazon-product-in-a-post-plugin' ) . '</p>';
			$pageTxtArr[] = '			<p>' . __( 'Available Shortcode Parameters:', 'amazon-product-in-a-post-plugin' ) . '</p>';
			$pageTxtArr[] = '			<ul>';
			$pageTxtArr[] = '				<li><code>asin</code> &mdash; ' . __( '<span style="color:#ff0000;">Required</span>. The Amazon ASIN or ASINs (add multiple by separating with a comma).', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>target</code> &mdash; ' . __( '(optional) Default is &quot;_blank&quot;. Applies to all ASINs in list.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>fields</code> &mdash; ' . __( '(optional) Fields you want to return. Any valid return field from Amazon API (see API for list) - default fields: image, title, author, price, button. Applies to all ASINs in "asin" field. (optional)', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>labels</code> &mdash; ' . __( '(optional) Labels that correspond to the fields, if you want custom labels (optional). See amazon-elements shortcode tab for more info on labels as they will function the same.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>columns</code> &mdash; ' . __( '(optional) Number of columns in your grid. (optional) Default is 3.', 'amazon-product-in-a-post-plugin' ) . '</li>';;
			$pageTxtArr[] = '				<li><code>button_url</code> &mdash; ' . __( '(optional) URL for a different button image if you desired. See amazon-elements shortcode tab for more info on button URLs.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>locale</code> &mdash; ' . __( '(optional) The amazon locale, i.e., co.uk, es. This is handy of you need a product from a different locale than your default one. Applies to all ASINs in list.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>partner_id</code> &mdash; ' . __( '(optional) Your amazon partner id. default is the one in the options. You can set a different one here if you have a different one for another locale or just want to split them up between multiple ids. Applies to all ASINs in list.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>private_key</code> &mdash; ' . __( '(optional) Amazon private key. Default is one set in options. You can set a different one if needed for another locale. Applies to all ASINs in list.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '				<li><code>public_key</code> &mdash; ' . __( '(optional) Amazon public key. Default is one set in options. You can set a different one if needed for another locale. Applies to all ASINs in list.', 'amazon-product-in-a-post-plugin' ) . '</li>';
			$pageTxtArr[] = '			</ul>';
			$pageTxtArr[] = '			<p>' . __( 'Example of the amazon-grid shortcode usage:', 'amazon-product-in-a-post-plugin' ) . '</p>';
			$pageTxtArr[] = '			<ul>';
			$pageTxtArr[] = '				<li>' . __( 'if you want to have a product with only a large image, the title and button, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
			$pageTxtArr[] = '					<code>[amazon-grid asin=&quot;0753515032,0753515055,0753515837,&quot; fields=&quot;title,lg-image,button&quot;]</code></li>';
			$pageTxtArr[] = '				<li>' . __( 'If you want that same product to have the list price and the new price, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
			$pageTxtArr[] = '					<code>[amazon-grid asin=&quot;0753515032,0753515055,0753515837&quot; fields=&quot;title,lg-image,<span style="color:#FF0000;">ListPrice,new-price,button&quot;</span>]</code></li>';
			$pageTxtArr[] = '				<li>' . __( 'If you want 5 columns and default fields, you would use:', 'amazon-product-in-a-post-plugin' ) . '<br>';
			$pageTxtArr[] = '					<code>[amazon-grid asin=&quot;0753515032,0753515055,0753515837&quot; <span style="color:#FF0000;">columns=&quot;5&quot;</span>]</code></li>';
			$pageTxtArr[] = '			</ul>';
			$pageTxtArr[] = '		</div>';
			$content[] = implode( "\n", $pageTxtArr );
			return $content;
		}

		public function do_added_shortcode_help_tab($tab = array(), $current_tab = '' ) {
			$tab[] = '<a id="amazon-product-grid" class="appiptabs nav-tab ' . ( $current_tab == 'amazon-product-grid' ? 'nav-tab-active' : '' ) . '" href="?page=apipp_plugin-shortcode&tab=amazon-product-grid">' . __( 'Product Grid', 'amazon-product-in-a-post-plugin' ) . '</a>'; 
			return $tab; 
		}

		public function front_enqueue() {
			if ( file_exists( get_stylesheet_directory() . '/appip-styles.css' ) || file_exists( get_stylesheet_directory() . '/css/appip-styles.css' ) ) {
				wp_enqueue_style( 'amazon-grid-shortcode', dirname( plugin_dir_url( __FILE__ ) ) . '/css/amazon-grid.css', array('appip-theme-styles'), filemtime( dirname( plugin_dir_path( __FILE__ ) ) . '/css/amazon-grid.css') );
			} else {
				wp_enqueue_style( 'amazon-grid-shortcode', dirname( plugin_dir_url( __FILE__ ) ) . '/css/amazon-grid.css', array('amazon-default-styles'), filemtime( dirname( plugin_dir_path( __FILE__ ) ) . '/css/amazon-grid.css') );
			}
		}

		public function grid_columns( $count = 3 ) {
			if ( $count == 0 )
				$count = 3;
			return ( int )$count;
		}

		public function add_fields( $fields = '' ) {
			$tempfields = is_array( $fields ) && !empty( $fields ) ? explode( ',', $fields ) : array();
			if ( is_array( $tempfields ) && !empty( $tempfields ) )
				return $tempfields; //this is an oevrride for shortcode if nothing present
			$tempfields[] = 'image';
			$tempfields[] = 'title';
			$tempfields[] = 'author';
			$tempfields[] = 'price';
			$tempfields[] = 'button';
			return implode( ",", $tempfields );
		}

	}
	new AmazonProduct_Shortcode_Grid( 'amazon-grid' );
	function appip_grid_php_block_init() {
		if( function_exists('register_block_type') ){
			wp_register_script(
				'amazon-grid',
				plugins_url( '/blocks/php-block-grid.js', __FILE__ ),
				array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' )
			);
			wp_register_style(
				'amazon-grid-styles',
				plugins_url( '/blocks/css/php-block-grid.css', __FILE__ ),
				array( 'wp-edit-blocks' ),
				filemtime( plugin_dir_path( __FILE__ ) . 'blocks/css/php-block-grid.css' )
			);

			register_block_type( 'amazon-pip/amazon-grid', array(
				'attributes'      => array(
					'fields' => array(
						'type' => 'string',
					),
					'asin' => array(
						'type' => 'string',
					),
					'columns' => array(
						'type' => 'int',
					),
					'newWindow' => array(
						'type' => 'string',
					),
				),
				'editor_style'   => 'amazon-grid-styles',
				'editor_script'   => 'amazon-grid', // The script name we gave in the wp_register_script() call.
				'render_callback' => array('AmazonProduct_Shortcode_Grid', 'do_shortcode'),
			) );
		}
	}
	//add_action( 'init', 'appip_grid_php_block_init');
	
}
