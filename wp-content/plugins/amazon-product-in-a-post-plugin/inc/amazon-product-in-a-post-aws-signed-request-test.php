<?php
class amazonAPPIP_NewRequest{
	var $type;
	function __construct($type ='ajax'){
		$this->type = $type;
		if($type == 'ajax'){
			add_action( 'wp_ajax_action_appip_do_test', array($this,'appip_do_settings_test_ajax') );// register ajax test
		}elseif($type ='parent'){
			add_action( 'wp_ajax_action_appip_do_test', array($this,'appip_do_settings_test_parent') );// register ajax test
		}
	}
	function appip_do_product_ajax(){
		check_ajax_referer( 'appip_ajax_do_product', 'security', true );
		if( current_user_can( 'manage_options' ) ){
			$test = $this->test_API();
			global $wp_scripts;
			global $wp_styles;
			if (is_a($wp_scripts, 'WP_Scripts'))
			  $wp_scripts->queue = array();
			if (is_a($wp_styles, 'WP_Styles'))
			  $wp_styles->queue = array();
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_style( 'wp-admin' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'plugin-install' );
			add_thickbox();
			?>
			<!DOCTYPE html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Test</title>
			<?php wp_print_scripts();wp_print_styles();?>
			<style>
			<?php echo get_option("apipp_product_styles", '');?>  
				.amazon-price-button > a img.amazon-price-button-img:hover {opacity: .75;}
				#plugin-information .appip-multi-divider{border-bottom: 1px solid #EAEAEA;margin: 4% 0 !important;}
				#plugin-information a img.amazon-image.amazon-image {max-width: 100%;border: 1px solid #ccc;box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.24); }
				#plugin-information h2.amazon-asin-title { border-bottom: 1px solid #ccc !important; padding-bottom: 2%; margin-bottom: 3% !important; }
				#plugin-information hr { display: none; }
			</style>
			</head>
			<body id="plugin-information" class="wp-admin wp-core-ui no-js iframe plugin-install-php locale-en-us">
			<div id="plugin-information-scrollable">
				<div id='plugin-information-title'>
					<div class="vignette"></div>
					<h2>Add an Amazon Product</h2>
				</div>
				<div id="plugin-information-tabs" class="without-banner">
					<a name="test" href="<?php echo admin_url('admin.php?page=apipp_plugin_admin&amp;tab=plugin-information&amp;plugin=amazon-product-in-a-post-plugin&amp;section=tab1');?>" class="current">Tab1</a>
					<a name="debug" href="<?php echo admin_url('admin.php?page=apipp_plugin_admin&amp;tab=plugin-information&amp;plugin=amazon-product-in-a-post-plugin&amp;section=tab2');?>">Tab2</a>
				</div>
				<div id="plugin-information-content" class="with-banner">
					<div id="section-holder" class="wrap">
						<div id="section-tab1" class="section" style="display: block;"></div>
						<div id="section-tab2" class="section" style="display: none;"></div>
					</div>
				</div>
			</div>
			</body>
			</html>
			<?php		
		}else{
			echo 'no permission';	
		}
		exit;
	}
	function test_API(){
		$error 			= '';
		$region 		= APIAP_LOCALE; 
		$publickey 		= APIAP_PUB_KEY;
		$privatekey 	= APIAP_SECRET_KEY;
		if( APIAP_ASSOC_ID == '' || $region == '' || $publickey == '' || $privatekey == '' )
			$error .= '<span style="color:red;">Error: Some Required Data is missing.</span><br/>';
		if( strlen($publickey) != 20 )
			$error .= '<span style="color:red;">Error: <strong>Amazon Access Key ID</strong> is not the correct length (should be 20 characters, not '.strlen($publickey).').</span><br/>';
		if( strlen($privatekey) != 40 )
			$error .= '<span style="color:red;">Error: <strong>Amazon Secret Access Key</strong> is not the correct length (should be 40 characters, not '.strlen($privatekey).').</span><br/>';
		if( $publickey == '' && $privatekey == '' )
			$error = '<span style="color:red;">Error: Please SAVE your settings BEFORE testing.</span><br/>';
		if( $error != '' )
			return $error;
		$keyword						= array('puppy poster','kitten poster','disney movies','Game of Thrones','kids','funsparks','TV shows on DVD','mickey mouse','donald duck');
		shuffle($keyword);
		$pages 							= array('1','2','3');
		shuffle($pages);
		$params 						= array();
		$params["AWSAccessKeyId"] 		= $publickey;
		$params['AssociateTag'] 		= APIAP_ASSOC_ID;
		$params['Condition']			= 'All';
		$params['IdType']				= 'ASIN';
		$params['IncludeReviewsSummary']= 'False';
		$params['ItemPage']				= $pages[0];
		$params['Keywords']				= $keyword[0];
		$params['Operation']			= 'ItemSearch';//'ItemLookup',
		$params['ResponseGroup']		= 'Medium';
		$params['SearchIndex']			= 'All'; 
		$params["Service"] 				= "AWSECommerceService";
		$params["Timestamp"] 			= gmdate("Y-m-d\TH:i:s\Z");
		$params["Version"] 				= "2013-08-01";//"2011-08-01"; //"2009-03-31";
		$params["TruncateReviewsAt"]	= '1';
		$canonicalized_query 			= array();
		ksort($params);
		foreach ($params as $param => $value){
		    $param = str_replace("%7E", "~", rawurlencode($param));
		    $value = str_replace("%7E", "~", rawurlencode($value));
		    $canonicalized_query[] = $param."=".$value;
		}
		$canonicalized_query 			= implode("&", $canonicalized_query);
		$result 						= $this->get_Result( $canonicalized_query , true, $keyword[0] );
		return $result;
	}
	
	function appip_do_settings_test_debug(){
		$test = $this->test_API();
		global $wp_scripts,$wp_styles;
		if (is_a($wp_scripts, 'WP_Scripts'))
		  $wp_scripts->queue = array();
		if (is_a($wp_styles, 'WP_Styles'))
		  $wp_styles->queue = array();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'common' );
		?>
<?php wp_print_scripts();wp_print_styles();?>
<style>
<?php echo get_option("apipp_product_styles", '');?>  
	.amazon-product-table{width:auto !important;}
	.amazon-price-button > a img.amazon-price-button-img:hover {opacity: .75;}
	#plugin-information-debug .appip-multi-divider{border-bottom: 1px solid #EAEAEA;margin: 4% 0 !important;}
	#plugin-information-debug a img.amazon-image.amazon-image {max-width: 100%;border: 1px solid #ccc;box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.24); }
	#plugin-information-debug h2.amazon-asin-title { border-bottom: 1px solid #ccc !important; padding-bottom: 2%; margin-bottom: 3% !important; }
	#plugin-information-debug hr { display: none; }
</style>
<div id="plugin-information-debug" class="wp-admin wp-core-ui plugin-install-php locale-en-us">
<div id="plugin-information-scrollable">
	<div id="plugin-information-content" class="with-banner">
		<div id="section-holder" class="wrap">
			<div id="section-test" class="section" style="display: block;">
				<h3>Amazon Product API Settings Test</h3>
				<p>If you can see products listed below, then the test was successful.</p>
				<?php echo $test;?>
			</div>
			<div id="section-debug" class="section" style="display: block;">
				<h3>Amazon Product Debug Info</h3>
				<div style="background:#EAEAEA;margin-bottom: 10px;padding: 4px 10px;">
					<p>This plugin uses <code>wp_remote_request</code> to make Amazon API calls.</p>
                    <?php $none = true; ?>
					<?php if(wp_http_supports( array(), 'https://www.example.com/' )){ $none = false; ?>
						<p>Your host allows SSL requests.</p>
					<?php }?>
					<?php if(wp_http_supports( array(), 'http://www.example.com/' )){ $none = false;?>
						<p>Your host allows HTTP requests.</p>
					<?php } ?>
					<?php if($none){ ?>
						<p>You cannot use this plugin until either CURL or fopen are installed and working. Contact your host for help.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php		
	}
	function appip_do_settings_test_ajax(){
		check_ajax_referer( 'appip_ajax_do_settings_test', 'security', true );
		if( current_user_can( 'manage_options' ) ){
			$test = $this->test_API();
			global $wp_scripts;
			global $wp_styles;
			if (is_a($wp_scripts, 'WP_Scripts')) {
			  $wp_scripts->queue = array();
			}	
			if (is_a($wp_styles, 'WP_Styles')) {
			  $wp_styles->queue = array();
			}			
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_style( 'wp-admin' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'plugin-install' );
			add_thickbox();
			?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Test</title>
<?php wp_print_scripts();wp_print_styles();?>
<style>
<?php echo get_option("apipp_product_styles", '');?>  
	.amazon-price-button > a img.amazon-price-button-img:hover {opacity: .75;}
	#plugin-information .appip-multi-divider{border-bottom: 1px solid #EAEAEA;margin: 4% 0 !important;}
	#plugin-information a img.amazon-image.amazon-image {max-width: 100%;border: 1px solid #ccc;box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.24); }
	#plugin-information h2.amazon-asin-title { border-bottom: 1px solid #ccc !important; padding-bottom: 2%; margin-bottom: 3% !important; }
	#plugin-information hr { display: none; }
</style>
</head>
<body id="plugin-information" class="wp-admin wp-core-ui no-js iframe plugin-install-php locale-en-us">
<div id="plugin-information-scrollable">
	<div id='plugin-information-title'>
		<div class="vignette"></div>
		<h2>Amazon Product API Settings Test</h2>
	</div>
	<div id="plugin-information-tabs" class="without-banner">
		<a name="test" href="<?php echo admin_url('admin.php?page=apipp_plugin_admin&amp;tab=plugin-information&amp;plugin=amazon-product-in-a-post-plugin&amp;section=test');?>" class="current">Test Results</a>
		<a name="debug" href="<?php echo admin_url('admin.php?page=apipp_plugin_admin&amp;tab=plugin-information&amp;plugin=amazon-product-in-a-post-plugin&amp;section=debug');?>">Debug</a>
	</div>
	<div id="plugin-information-content" class="with-banner">
		<div id="section-holder" class="wrap">
			<div id="section-test" class="section" style="display: block;">
				<h3>Amazon Product API Settings Test</h3>
				<p>If you can see products listed below, then the test was successful.</p>
				<?php echo $test;?>
			</div>
			<div id="section-debug" class="section" style="display: none;">
				<div style="background:#EAEAEA;margin-bottom: 10px;padding: 4px 10px;">
					<p>This plugin uses <code>wp_remote_request</code> to make Amazon API calls.</p>
                    <?php 
					$none = true; 
					$none2 = true;
					?>
					<?php if(is_callable( 'wp_remote_request' )){ $none = false; ?>
					<p><span class="dashicons dashicons-yes" style="color:rgba(51,153,0,1);"></span><code>wp_remote_request</code> is callable.</p>
					<?php }else{ ?>
					<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span><code>wp_remote_request</code> is NOT callable.</p>
					<?php } ?>
					
					<?php if(wp_http_supports( array(), 'http://www.example.com/' )){ $none = false; ?>
						<p><span class="dashicons dashicons-yes" style="color:rgba(51,153,0,1);"></span>Your host allows HTTP requests.</p>
					<?php }else{ ?>
						<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span>Your host does NOT allow HTTP requests.</p>
					<?php } ?>
					
					<?php if(wp_http_supports( array(), 'https://www.example.com/' )){ $none = false;  ?>
						<p><span class="dashicons dashicons-yes" style="color:rgba(51,153,0,1);"></span>Your host allows SSL requests.</p>
					<?php }else{ ?>
						<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span>Your host doe NOT allow SSL requests.</p>
					<?php } ?>
					
					<?php if(is_callable( 'xml_parser_create' )){ $none2 = false; ?>
					<p><span class="dashicons dashicons-yes" style="color:rgba(51,153,0,1);"></span><code>xml_parser_create</code> is callable.</p>
					<?php }else{ ?>
					<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span><code>xml_parser_create</code> is NOT callable.</p>
					<?php } ?>
					
					<?php if(extension_loaded( 'SimpleXML' )){ $none2 = false; ?>
					<p><span class="dashicons dashicons-yes" style="color:rgba(51,153,0,1);"></span><code>SimpleXML</code> Installed.</p>
					<?php }else{ ?>
					<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span><code>SimpleXML</code> is NOT installed.</p>
					<?php } ?>
					
					<?php if($none){ ?>
						<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span>You cannot use this plugin until either CURL or fopen are installed and working. Contact your host for help.</p>
					<?php } ?>
					
					<?php if($none2){ ?>
					<p><span class="dashicons dashicons-no" style="color:rgba(153,51,0,1);"></span>You need to have <code>xml_parser_create</code> and <code>SimpleXML</code> installed for the plugin to function correctly. Contact your host for help.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html><?php		
		}else{
			echo 'no permission';	
		}
		exit;
	}
	function get_Result( $canonicalized_query = array(), $test = false, $keyword = ''){
		$region 				= APIAP_LOCALE; 
		$privatekey 			= APIAP_SECRET_KEY;
		$method 				= "GET";
		$host 					= "webservices.amazon.".$region; //new API 12-2011
		$uri 					= "/onca/xml";
		$string_to_sign 		= $method."\n".$host."\n".$uri."\n".$canonicalized_query;
		$signature 				= base64_encode( appip_plugin_aws_hash_hmac( "sha256", $string_to_sign, $privatekey, true ) );
		$signature 				= str_replace("%7E", "~", rawurlencode($signature));
		$request 				= "https://".$host.$uri."?".$canonicalized_query."&Signature=".$signature;
		if($this->type == 'debug')
			echo '<!--span style="font-weight:bold;font-family:courier;display:inline-block;width:225px;">Sample Request:</span-->'.$request;
		//New Transport (use WordPress Remote Request).
		$response 	= wp_remote_request($request);
		
		if (!is_wp_error($response)) {
			$xbody 		= trim(addslashes($response['body']));
			if($xbody =='' || strpos($xbody, 'Error:') !== false ){
				if($xbody ==''){
					return '<span style="color:red;">Error: Empty Result.<br/>Something when wrong with the request. If you continue to have this problem, check your API keys for accuracy. If you still have the issue, send your Debug key and site URL to plugins@fischercreativemedia.com for help.</span>';
				}else{
					return stripslashes($xbody);
				}
			}
		}elseif(!isset($response['body'])){
			return '<span style="color:red;">Error:<br/>Something when wrong with the request (No Body).<br>Status:'.$status.'</span><pre>'.print_r($response, true).'</pre>';
		}else{
			$status = '';
			if (isset($response->status)) {
				$status = $response->status;
			}
			return '<span style="color:red;">Error:<br/>Something when wrong with the request (other).<br>Status:'.$status.'</span><pre>'.print_r($response, true).'</pre>';
		}
		
		$pxml = appip_get_XML_structure_new( $response['body'], 0 );
		if(!is_array($pxml)){
			return 'Error:'. $pxml2;
		}else{
			$asins = array();
			if((bool)$test === true){
				if(isset($pxml['Items']['Item']) && is_array($pxml['Items']['Item']) && !empty($pxml['Items']['Item'])){
					$multi = isset($pxml['Items']['Item'][0]) ? true : false;
					if($multi){
						$items = $pxml['Items']['Item'];
						foreach($items as $k => $v ){
							$asins[$v['ASIN']] = $v['ASIN'];
						}
					}else{
						$items = $pxml['Items']['Item'];
						$asins[$items['ASIN']] = $items['ASIN'];
					}
				}
			}
			$resultarr1	= appip_plugin_FormatASINResult($pxml, 0, $asins);
			$resultarr2 = appip_plugin_FormatASINResult($pxml, 1, $asins);
			foreach($resultarr1 as $key1 => $result1):
				$mainAArr 			= (array)$result1;
				$otherArr 			= (array)$resultarr2[$key1];
				$resultarr[$key1] 	= (array)$mainAArr + $otherArr;
			endforeach;
			$apippnewwindowhtml = $template = '';
			$returnval 	= '<span style="color:#390;font-size:20px;font-weight:bold;">' . __( 'Test Successful', 'amazon-product-in-a-post-plugin' ) . '!</span><br/>';
			$resultarr 	= has_filter('appip_product_array_processed') ? apply_filters('appip_product_array_processed',$resultarr,$apippnewwindowhtml,$resultarr1,$resultarr2,$template) : $resultarr;
			$resultarr 	= !is_array($resultarr) ? (array) $resultarr : $resultarr;
			$thedivider = '';
			$totaldisp  = 4;
			$i  		= 0;
			$returnval 	.= '
			<style type="text/css">
				table.amazon-product-table td { width: 25%; padding: 0; text-align: center; border: 1px solid #ccc; vertical-align: middle; }
				table.amazon-product-table td:hover { border-bottom: 1px solid #ccc; }
				table.amazon-product-table { margin-top: 20px; }
				table.amazon-product-table td:hover div { border: 2px solid #9C27B0; }
				table.amazon-product-table td div { line-height: 0; background-color: #fff; box-sizing: border-box; display: block; padding: 5px; height: 134px; }
				table.amazon-product-table td div img { max-height: 100%; width: auto; max-width: 100%; vertical-align: middle; }
				table.amazon-product-table { padding: 0; }
				amazon-product-table-search{margin-top:20px;}
			</style>
			';
			if($keyword != '')
				$returnval .= '	<div class="amazon-product-table-search"><strong>Search Keyword:</strong> '. $keyword .'</div>'."\n";
			$returnval .= '	<table cellpadding="0" class="amazon-product-table">'."\n";
			$returnval .= '		<tr>'."\n";
			shuffle($resultarr);
			foreach($resultarr as $key => $result):
				if($i >= $totaldisp)
					break;
				if(isset($result['NoData']) && $result['NoData'] == '1'):
					$returnval .=  $result['Error'];
					if($extratext != ''):
						$returnval .= $extratext;
					endif;
				else:
					$returnval .= '			<td valign="top">'."\n";
					$returnval .= '				<div class="amazon-image-wrapper-test">'.awsImageGrabber($result['MediumImage'],'amazon-image') . '</div>'."\n";
					$returnval .= '			</td>'."\n";
				endif;
				$i++;
			endforeach;
			$returnval .= '		</tr>'."\n";
			$returnval .= '	</table>'."\n";
			return $returnval;
		}
		return 'Nothing';
	}
}

new amazonAPPIP_NewRequest();