<?php

class AmazonProduct_Shortcode_AmazonProducts extends AmazonProduct_ShortcodeClass{
	
	public function _setup( ){}
	
	public function do_shortcode($atts, $content = ''){
		$defaults = array(
			'asin'=> '',
			'locale' => APIAP_LOCALE,
			'gallery' => 0, 			//set to 1 to show extra photos
			'partner_id' => APIAP_ASSOC_ID,
			'private_key' => APIAP_SECRET_KEY,
			'public_key' => APIAP_PUB_KEY, 
			'desc' => 0, 				//set to 1 to show or 0 to hide description if avail
			'features' => 0, 			//set to 1 to show or 0 to hide features if avail
			'listprice' => 1, 			//set to 0 to hide list price
			'list_price' => null, 		//added only as a secondary use of $listprice
			'show_list' => null,		//added only as a secondary use of $listprice 
			'used_price' => 1, 			//set to 0 to hide used price
			'show_used' => null,		//added only as a secondary use of $used_price
			'usedprice' => null,		//added only as a secondary use of $used_price
			'replace_title' => '', 		//replace with your own title
			'use_carturl' => false, 	//set to 1 use Cart URL
			'template' => 'default', 	//future feature
			'button' => '',
			'align' => 'none'			//'alignleft', 'alignright', 'aligncenter', 'none' (default)
		);
		if(array_key_exists('0',$atts)){
			extract(shortcode_atts($defaults, $atts));
			$asin = str_replace('=','',$atts[0]);
		}else{
			extract(shortcode_atts($defaults, $atts));
		}
		if(strpos($asin,',')!== false)
			$asin = explode(',', str_replace(' ','',$asin));
		$listprice 		= (isset($list_price) && $list_price != null ) ? $list_price : $listprice;
		$listprice 		= (isset($show_list)  && $show_list != null ) ? $show_list : $listprice;
		$used_price		= (isset($usedprice)  && $usedprice != null ) ? $usedprice : $used_price; 
		$used_price		= (isset($show_used)  && $show_used != null ) ? $show_used : $used_price;
		$useCartURL		= (isset($use_carturl) && ((int)$use_carturl == 1 || $use_carturl == true) ) ? true : false;
		$product_array 	= $asin;	 //$product_array can be array, comma separated string or single ASIN
		$amazon_array 	= array(
			'locale' 		=> $locale,
			'partner_id' 	=> $partner_id,
			'private_key' 	=> $private_key,
			'public_key' 	=> $public_key, 
			'gallery'		=> $gallery,
			'features' 		=> $features,
			'listprice' 	=> $listprice,
			'used_price' 	=> $used_price,
			'desc' 			=> $desc,
			'replace_title' => $replace_title,
			'template' 		=> $template,
			'usecarturl'	=> $useCartURL,
			'align' 		=> $align,
			'button' 		=> $button,

		);
		
		$amazon_array = apply_filters( 'appip_shortcode_atts_array', $amazon_array );			
		return getSingleAmazonProduct( $product_array, $content, 0, $amazon_array, $desc );
	}
}
new AmazonProduct_Shortcode_AmazonProducts(array('amazonproduct','amazonproducts', 'AMAZONPRODUCT', 'AMAZONPRODUCTS') );

function appip_products_php_block_init() {
	if( function_exists('register_block_type') ){
		wp_register_script(
			'amazon-product',
			plugins_url( '/blocks/php-block-product.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' )
		);
		wp_register_style(
			'amazon-product-styles',
			plugins_url( '/blocks/css/php-block-product.css', __FILE__ ),
			array( 'wp-edit-blocks' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'blocks/css/php-block-product.css' )
		);

		register_block_type( 'amazon-pip/amazon-product', array(
			'attributes'      => array(
				'asin' => array(
					'type' => 'string',
				),
			),
			'editor_style'   => 'amazon-product-styles',
			'editor_script'   => 'amazon-product', // The script name we gave in the wp_register_script() call.
			'render_callback' => array('AmazonProduct_Shortcode_AmazonProducts', 'do_shortcode'),
		) );
	}
}
//add_action( 'init', 'appip_products_php_block_init');