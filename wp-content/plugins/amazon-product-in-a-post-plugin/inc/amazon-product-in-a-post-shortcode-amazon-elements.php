<?php

class AmazonProduct_Shortcode_AmazonElements extends AmazonProduct_ShortcodeClass{
	public function _setup( ){	}

	public function appip_do_charlen( $text ='', $charlen = 0 ){
		if( $text == '' || $charlen == 0 )
			return $text;
		return $this->amazon_appip_truncate( $text, $charlen );
	}

	public function do_shortcode($atts, $content = ''){
		global $amazonhiddenmsg,$amazonerrormsg,$apippopennewwindow,$apippnewwindowhtml,$post;
		$thenewret = array();		
		$defaults = array(
			'asin'			=> '',
			'locale' 		=> APIAP_LOCALE,
			'partner_id' 	=> APIAP_ASSOC_ID,
			'private_key' 	=> APIAP_SECRET_KEY,
			'public_key' 	=> APIAP_PUB_KEY, 
			'fields'		=> '',
			'field'			=> '',
			'listprice' 	=> 1, 
			'used_price' 	=> 1,
			'replace_title' => '', 
			'template' 		=> 'default',
			'msg_instock' 	=> 'In Stock',
			'msg_outofstock'=> 'Out of Stock',
			'target' 		=> '_blank',
			'button_url' 	=> '',
			'button' 		=> '',
			'container' 	=> apply_filters('amazon-elements-container','div'),
			'container_class' => apply_filters('amazon-elements-container-class','amazon-element-wrapper'),
			'labels' 		=> '',
			'use_carturl' 	=> false,		
			'list_price' 	=> null, 		//added only as a secondary use of $listprice
			'show_list' 	=> null,		//added only as a secondary use of $listprice 
			'show_used'		=> null,		//added only as a secondary use of $used_price
			'usedprice' 	=> null,		//added only as a secondary use of $used_price
			'charlen'		=> 0	,		// if greater than 0 will concat text fileds
			'button_use_carturl' => false,
		);
		extract( shortcode_atts( $defaults, $atts ) );
		$listprice 		= (isset($list_price) && $list_price != null ) ? $list_price : $listprice;
		$listprice 		= (isset($show_list)  && $show_list != null ) ? $show_list : $listprice;
		$used_price		= (isset($usedprice)  && $usedprice != null ) ? $usedprice : $used_price; 
		$used_price		= (isset($show_used)  && $show_used != null ) ? $show_used : $used_price;
		$use_carturl	= (isset($use_carturl) && ( (int) $use_carturl == 1 || $use_carturl == true ) ) ? true : false;
		$button_use_carturl	= (isset($button_use_carturl) && ( (int) $button_use_carturl == 1 || $button_use_carturl == true ) ) ? true : false;
		$wrap 			= str_replace(array('<','>'), array('',''),$container);
		$charlen 		= isset($atts['charlen']) && (int)$atts['charlen'] > 0 ? (int)$atts['charlen'] : 0;
		$new_button_arr = amazon_product_get_new_button_array($locale);
		if($labels != ''){
			$labelstemp = explode(',',$labels);
			unset($labels);
			foreach($labelstemp as $lab){
				$keytemp = explode('::',$lab);
				if(isset($keytemp[0]) && isset($keytemp[1])){
					$labels[$keytemp[0]][] = apply_filters('appip_label_text_'.str_replace(' ','-',strtolower($keytemp[1])), $keytemp[1] /*value*/, $keytemp[0] /*field*/, 'amazon-element' );
				}
			}
		}else{
			$labels = array();
		}
		if($button_url != ''){
			$buttonstemp = explode(',',$button_url);
			unset($button_url);
			foreach($buttonstemp as $buttona){
				if(!empty($buttona)){
					$button_url[] = $buttona;
				}
			}
		}else{
			$button_url = array();
		}
	
		if( $field == '' && $fields != '' ){$field = $fields;}
		if( $target != '' ){$target = ' target="'.$target.'" ';}
		$appip_text_lgimage = apply_filters('appip_text_lgimage', __( "See larger image", 'amazon-product-in-a-post-plugin' ));
		if ( $asin != ''){
			$inCache 		= amazon_product_check_in_cache($asin);
			$ASIN 			= ( is_array( $asin ) && !empty( $asin ) )? implode(',',$asin) : $asin; //valid ASIN or ASINs 
			$asinR 			= explode(",",$ASIN);
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

			$errors 		= '';
			if($inCache)
				$pxmlNew	= amazon_plugin_aws_signed_request($locale, array("Operation" => "ItemLookup","ItemId" => $ASIN,"ResponseGroup" => "Large","IdType" => "ASIN","AssociateTag" => $partner_id,"RequestBy" => 'amazon-elements' ), APIAP_PUB_KEY, APIAP_SECRET_KEY, true);
			else
				$pxmlNew	= amazon_plugin_aws_signed_request($locale, array("Operation" => "ItemLookup","ItemId" => $ASIN,"ResponseGroup" => "Large","IdType" => "ASIN","AssociateTag" => $partner_id,"RequestBy" => 'amazon-elements' ), APIAP_PUB_KEY, APIAP_SECRET_KEY);
			$totalResult1 	= array();
			$totalResult2 	= array();
			$errorsArr		= array();
			
			if( is_array( $pxmlNew ) && !empty( $pxmlNew ) ){
				$pxmle = array();
				foreach($pxmlNew as $pxmlkey => $pxml ){
					if(!is_array($pxml)){
						$pxmle = $pxml;
					}else{
						$r1 = appip_plugin_FormatASINResult( $pxml , 0, $asinR);
						if(is_array($r1) && !empty($r1)){
							foreach($r1 as $ritem){
								$totalResult1[] = $ritem;
							}
						}
						$r2 = appip_plugin_FormatASINResult( $pxml, 1, $asinR );
						if(is_array($r2) && !empty($r2)){
							foreach($r2 as $ritem2){
								$totalResult2[] = $ritem2;
							}
						}
					}
				}
			}
			$resultarr = array();
			if(!empty($pxmle)){
				$pxml = $pxmle;
				echo '<div style="display:none;" class="appip-errors">APPIP ERROR:pxml['.str_replace(array('<![CDATA[',']]>',']]&gt;'),array('','',''),$pxml).'</div>';
				return false;
			}else{
				$resultarr1	= isset($totalResult1) && !empty($totalResult1) ? $totalResult1 : array(); //appip_plugin_FormatASINResult( $pxml );
				$resultarr2 = isset($totalResult2) && !empty($totalResult2) ? $totalResult2 : array(); //appip_plugin_FormatASINResult( $pxml, 1 );
				if(is_array($resultarr1) && !empty($resultarr1)){
					foreach($resultarr1 as $key1 => $result1):
						$mainAArr 			= (array) $result1;
						$otherArr 			= (array) $resultarr2[$key1];
						$resultarr[$key1] 	= (array) array_merge($mainAArr,$otherArr);
						ksort($resultarr[$key1]);
					endforeach;
				}
				$arr_position = 0;
				if(is_array($resultarr)):
					$retarr = array();
					$newErr = '';
					$usSSL  = amazon_check_SSL_on();
					$region = APIAP_LOCALE; 
					foreach($resultarr as $key => $result):
						$currasin = isset($result['ASIN']) ? $result['ASIN'] : '';
						if(isset($result['NoData']) && $result['NoData'] == '1' ):
							echo '<'.$wrap.' style="display:none;" class="appip-errors">APPIP ERROR:nodata['.str_replace(']-->',']->',implode("\n",$result['Error'])).'</'.$wrap.'>';
						elseif( !isset($result['ASIN']) || empty( $result['ASIN'] ) || $result['ASIN'] == 'Array' ):
							echo '<'.$wrap.' style="display:none;" class="appip-errors">APPIP ERROR:nodata[ ('.$key.') NO DATA </'.$wrap.'>';
						else:
							$linkURL 	= ($use_carturl) ? str_replace(array('##REGION##','##AFFID##','##SUBSCRIBEID##'),array($locale,$partner_id,APIAP_PUB_KEY),$result['CartURL'] ) : $result['URL'];
						$btnlinkURL = ($button_use_carturl) ? str_replace(array('##REGION##','##AFFID##','##SUBSCRIBEID##'),array($locale,$partner_id,APIAP_PUB_KEY),$result['CartURL'] ) : $result['URL'];
						$nofollow 	= ' rel="nofollow"';
						$nofollow 	= apply_filters('appip_template_add_nofollow',$nofollow,$result);
						$buttonURL  = apply_filters('appip_amazon_button_url',plugins_url('/images/generic-buy-button.png',dirname(__FILE__)),'generic-buy-button.png',$region);
	
							if($result['Errors'] != '' )
								$newErr = '<'.$wrap.' style="display:none;" class="appip-errors">HIDDEN APIP ERROR(S): '.$result['Errors'].'</'.$wrap.'>';
							$fielda 	= is_array($field) ? $field :  explode(',',str_replace(' ','',$field));
							foreach($fielda as $fieldarr){
								switch(strtolower($fieldarr)){
									case 'title_clean':
										$retarr[$currasin][$fieldarr] = $this->appip_do_charlen(maybe_convert_encoding($result["Title"]), $charlen);
										break;
									case 'author_clean':
										$retarr[$currasin][$fieldarr] = $this->appip_do_charlen(maybe_convert_encoding($result["Author"]), $charlen);
										break;
									case 'desc_clean':
									case 'description_clean':
										if(is_array($result["ItemDesc"])){
											$desc 	= preg_replace('/^\s*\/\/<!\[CDATA\[([\s\S]*)\/\/\]\]>\s*\z/','$1', $result["ItemDesc"][0] );
											$retarr[$currasin][$fieldarr] = $this->appip_do_charlen(maybe_convert_encoding($desc['Content']), $charlen);
										}
										break;
									case 'price_clean':
									case 'new-price_clean':
									case 'new price_clean':
										if("Kindle Edition" == $result["Binding"]){
											$retarr[$currasin][$fieldarr] = 'Check Amazon for Pricing [Digital Only - Kindle]';
										}else{
											if( $result["LowestNewPrice"] == 'Too low to display' ){
												$newPrice = 'Check Amazon For Pricing';
											}else{
												$newPrice = $result["LowestNewPrice"];
											}
											if($result["TotalNew"]>0){
												$retarr[$currasin][$fieldarr] = maybe_convert_encoding($newPrice).' - '.$msg_instock;
											}else{
												$retarr[$currasin][$fieldarr] = maybe_convert_encoding($newPrice).' - '.$msg_instock;
											}
										}
										break;
									case 'image_clean':
									case 'med-image_clean':
										//$retarr[$currasin][$fieldarr] = awsImageGrabberURL($currasin,"M");
										if(isset($result['MediumImage']))
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['MediumImage']);
										else // need an image and small is always present if Medium is not
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['SmallImage']);
										break;
									case 'sm-image_clean':
										//$retarr[$currasin][$fieldarr] =  $usSSL ? plugin_aws_prodinpost_filter_text($result['SmallImage']) : $result['SmallImage'];
										$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['SmallImage']);
										break;
									case 'lg-image_clean':
										$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['LargeImage']);
										break;
									case 'full-image_clean':
										//$retarr[$currasin][$fieldarr] = $usSSL ? plugin_aws_prodinpost_filter_text($result['LargeImage']) :$result['LargeImage'] ;
										if( isset($result['HiResImage']) ) // if there is a hires image by chance, give that
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['HiResImage']);
										else // otherwise return largest we have
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['LargeImage']);
										break;
									case 'large-image-link_clean':
										//if( awsImageGrabberURL($currasin,"P") != '')
											//$retarr[$currasin][$fieldarr] = awsImageURLModify($result['LargeImage'],"P");
										if( isset($result['HiResImage']) ) // if there is a hires image by chance, give that
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['HiResImage']);
										else // otherwise return largest we have
											$retarr[$currasin][$fieldarr] =  checkSSLImages_url($result['LargeImage']);
										break;
									case 'features_clean':
										$retarr[$currasin][$fieldarr] = maybe_convert_encoding($result["Feature"]);
										break;
									case 'link_clean':
										$retarr[$currasin][$fieldarr] = $linkURL;
										break;
									case 'button_clean':
										if(isset($button_url[$arr_position]))
											$retarr[$currasin][$fieldarr] = $button_url[$arr_position];
										else
											$buttonURL  = apply_filters('appip_amazon_button_url',plugins_url('/images/generic-buy-button.png',dirname(__FILE__)),'generic-buy-button.png',$region);
											$retarr[$currasin][$fieldarr] =$buttonURL;
										break;
									case 'customerreviews_clean':
										$retarr[$currasin][$fieldarr] = $result['CustomerReviews'];
										break;
									case 'author':
										$retarr[$currasin][$fieldarr] = $this->appip_do_charlen($result['Author'], $charlen);
										break;
									case 'title':
										$result["Title"] = $this->appip_do_charlen($result["Title"], $charlen);
										if(!isset($labels['title-wrap'][$arr_position]) && !isset($labels['title'][$arr_position])){
											$labels['title'][$arr_position] = '<'.$wrap.' class="appip-title"><a href="'.$linkURL.'"'.$target.$nofollow.'>'. maybe_convert_encoding($result["Title"]).'</a></'.$wrap.'>';
										}elseif(!isset($labels['title-wrap'][$arr_position]) && isset($labels['title'][$arr_position])){
											$labels['title'][$arr_position] = '<'.$wrap.' class="appip-title"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.$labels['title'][$arr_position].'</a></'.$wrap.'>';
										}elseif(isset($labels['title-wrap'][$arr_position]) && isset($labels['title'][$arr_position])){
											$labels['title'][$arr_position] = "<{$labels['title-wrap'][$arr_position]} class='appip-title'>{$labels['title'][$arr_position]}</{$labels['title-wrap'][$arr_position]}>";
										}elseif(isset($labels['title-wrap'][$arr_position]) && !isset($labels['title'][$arr_position])){
											$labels['title'][$arr_position] = '<'.$labels['title-wrap'][$arr_position].' class="appip-title">'. maybe_convert_encoding($result["Title"]).'</'.$labels['title-wrap'][$arr_position].'>';
										}else{
											$labels['title'][$arr_position] = '<'.$wrap.' class="appip-title"><a href="'.$linkURL.'"'.$target.$nofollow.'>'. maybe_convert_encoding($result["Title"]).'</a></'.$wrap.'>';
										}
										$retarr[$currasin][$fieldarr] = $labels['title'][$arr_position];
										break;
									case 'desc':
									case 'description':
										$labels['desc'][$arr_position] = isset($labels['desc'][$arr_position]) ? $labels['desc'][$arr_position] : '';
										if(isset($labels['desc'])){
											$labels['desc'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['desc'][$arr_position].' </span>';
										}elseif(isset($labels['description'][$arr_position])){
											$labels['desc'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['description'][$arr_position].' </span>';
										}else{
											$labels['desc'][$arr_position] = '';
										}
										if(is_array($result["ItemDesc"])){
											//$desc 	= $this->appip_do_charlen(preg_replace('/^\s*\/\/<!\[CDATA\[([\s\S]*)\/\/\]\]>\s*\z/','$1', $result["ItemDesc"][0] ), $charlen);
											$desc 	= preg_replace('/^\s*\/\/<!\[CDATA\[([\s\S]*)\/\/\]\]>\s*\z/','$1', $result["ItemDesc"][0] );
											$retarr[$currasin][$fieldarr] = maybe_convert_encoding($labels['desc'][$arr_position].$desc['Content']);
										}
										break;
									case 'gallery':
										if(!isset($labels['gallery'][$arr_position])){$labels['gallery'][$arr_position] = "Additional Images:";}else{$labels['gallery'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr][$arr_position].' </'.$wrap.'>';}
										if($result['AddlImages']!=''){
											$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><span class="amazon-additional-images-text">'.$labels['gallery'][$arr_position].'</span><br/>'.$result['AddlImages'].'</'.$wrap.'>';
										}	
										break;
									case 'imagesets':
										if(!isset($labels['imagesets'][$arr_position])){$labels['imagesets'][$arr_position] = "Additional Images: ";}else{$labels['imagesets'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr][$arr_position].' </'.$wrap.'>';}
										if($result['AddlImages']!=''){
											$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><span class="amazon-additional-images-text">'.$labels['imagesets'][$arr_position].'</span><br/>'.$result['AddlImages'].'</'.$wrap.'>';
										}	
										break;
									case 'list':
									case 'list-price':
										//$labels['list'] = str_replace(':','',$labels['list']);
										$listLabel = '';
										$listPrice = '';
										if(isset($result["Binding"]) && "Kindle Edition" == $result["Binding"]){
											$listLabel = '';
											$listPrice = '';//'N/A';
										}elseif(isset($result["NewAmazonPricing"]["New"]["List"])){
											$listPrice = $result["NewAmazonPricing"]["New"]["List"];
										}
										$listLabel = $listLabel == '' && isset($labels['list'][$arr_position]) ? $labels['list'][$arr_position]: $listLabel;
										if($listPrice != ''){
											if($listLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="appip-label label-list">'.$listLabel.'</span> '.$listPrice;
											else
												$retarr[$currasin][$fieldarr] = $listPrice;
										}
										break;
									case 'price+list':
										$listLabel = '';
										$newLabel = '';
										$newPrice = '';
										if(isset($result["Binding"]) && "Kindle Edition" == $result["Binding"]){
											$newLabel = $result["Binding"].':';
											$listLabel = '';
											$listPrice	= '';//'N/A';
											$newPrice 	= ' Check Amazon for Pricing <span class="instock">Digital Only</span>';
										}elseif(isset($result["NewAmazonPricing"]["New"]["Price"])){
											$newPrice = $result["NewAmazonPricing"]["New"]["Price"];
											$listPrice = $result["NewAmazonPricing"]["New"]["List"];
										}
										$listLabel = $listLabel == '' && isset($labels['list'][$arr_position]) ? $labels['list'][$arr_position]: $listLabel;
										if($listPrice != ''){
											if($listLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="appip-label label-list">'.$listLabel.'</span> '.$listPrice;
											else
												$retarr[$currasin][$fieldarr] = $listPrice;
										}
										$newLabel = $newLabel == '' && isset($labels['price'][$arr_position]) ? $labels['price'][$arr_position]: $newLabel;
										$stockIn = ($result["TotalNew"] > 0 && $msg_instock != '' && !(isset($result["HideStockMsg"]) && (bool) $result["HideStockMsg"] == 1)) ? ' <span class="instock">'.$msg_instock.'</span>' : '';
										$stockIn = ($result["TotalNew"] == 0 && $msg_outofstock != '' && !( isset($result["HideStockMsg"]) && (bool) $result["HideStockMsg"] == 1)) ? ' <span class="outofstock">'.$msg_outofstock.'</span>' : $stockIn;
										if($newPrice != ''){
											if($newLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="appip-label label-price">'.$newLabel.'</span> '.$newPrice.$stockIn;
											else
												$retarr[$currasin][$fieldarr] = $newPrice;
										}
										break;
									case 'new-price':
									case 'new price':
									case 'price':
										$newLabel = '';
										$newPrice = '';
										if(isset($labels['price'][$arr_position]))
											$tempLabel = esc_attr($labels['price'][$arr_position]);
										elseif(isset($labels['price'][$arr_position]))
											$tempLabel = esc_attr($labels['new-price'][$arr_position]);
										elseif(isset($labels['price'][$arr_position]))
											$tempLabel = esc_attr($labels['new price'][$arr_position]);
										else
											$tempLabel = '';
										if(isset($result["Binding"]) && "Kindle Edition" == $result["Binding"]){
											$newLabel = $result["Binding"].':';
											$newPrice = ' Check Amazon for Pricing <span class="instock">Digital Only</span>';
										//}elseif(isset($result["Offers_Offer_OfferListing_Price_FormattedPrice"])){
											//$newPrice = $result["Offers_Offer_OfferListing_Price_FormattedPrice"];
										}elseif(isset($result["NewAmazonPricing"]["New"]["Price"])){
											$newPrice = $result["NewAmazonPricing"]["New"]["Price"];
										}
										$newLabel = $newLabel == '' && $tempLabel != '' ? $tempLabel : $newLabel;
										if($newPrice != ''){
											if($newLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="appip-label label-price">'.$newLabel.'</span> '.$newPrice;
											else
												$retarr[$currasin][$fieldarr] = $newPrice;
										}
										break;

									case 'old-new-price':
									case 'old-new price':
									//case 'listprice':
										if("Kindle Edition" == $result["Binding"]){
											if(isset($labels['price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['price'][$arr_position].' </span>';
											}elseif(isset($labels['new-price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new-price'][$arr_position].' </span>';
											}elseif(isset($labels['new price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new price'][$arr_position].' </span>';
											}else{
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.'Kindle Edition:'.' </span>';
											}
											$retarr[$currasin][$fieldarr] = $labels['price-new'][$arr_position].' Check Amazon for Pricing <span class="instock">Digital Only</span>';
										}else{
											if(isset($labels['price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['price'][$arr_position].' </span>';
											}elseif(isset($labels['new-price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new-price'][$arr_position].' </span>';
											}elseif(isset($labels['new price'][$arr_position])){
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new price'][$arr_position].' </span>';
											}else{
												$labels['price-new'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.'New From:'.' </span>';
											}
											$correctedPrice = isset($result["Offers_Offer_OfferListing_Price_FormattedPrice"]) ? $result["Offers_Offer_OfferListing_Price_FormattedPrice"] : $result["LowestNewPrice"];
											if($correctedPrice=='Too low to display'){
												$newPrice = 'Check Amazon For Pricing';
											}else{
												$newPrice = $correctedPrice;
											}
											if((int) $newPrice != 0){
												if($result["TotalNew"] > 0){
													$retarr[$currasin][$fieldarr] = $labels['price-new'][$arr_position].maybe_convert_encoding($newPrice).' <span class="instock">'.$msg_instock.'</span>';
												}else{
													$retarr[$currasin][$fieldarr] = $labels['price-new'][$arr_position].maybe_convert_encoding($newPrice).' <span class="outofstock">'.$msg_instock.'</span>';
												}
											}
										}
										break;
									case 'image':
									case 'med-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.awsImageGrabber(awsImageGrabberURL($currasin,"M"),'amazon-image').'</a></div>';
										$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.checkSSLImages_tag($result['MediumImage'],'amazon-image amazon-image-medium',$currasin).'</a></'.$wrap.'>';
										break;
									case 'sm-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.awsImageGrabber($result['SmallImage'],'amazon-image').'</a></div>';
										$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.checkSSLImages_tag($result['SmallImage'],'amazon-image amazon-image-small',$currasin).'</a></'.$wrap.'>';
										break;
									case 'lg-image':
										$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.checkSSLImages_tag($result['LargeImage'],'amazon-image amazon-image-large',$currasin).'</a></'.$wrap.'>';
										break;
									case 'full-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.awsImageGrabber($result['LargeImage'],'amazon-image').'</a></div>';
										if( isset($result['HiResImage']) ) // if there is a hires image by chance, give that
											$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.checkSSLImages_tag($result['HiResImage'],'amazon-image amazon-image-hires',$currasin).'</a></'.$wrap.'>';
										else
											$retarr[$currasin][$fieldarr] = '<'.$wrap.' class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.'>'.checkSSLImages_tag($result['LargeImage'],'amazon-image amazon-image-large',$currasin).'</a></'.$wrap.'>';
										break;
									case 'large-image-link':
										if(!isset($labels['large-image-link'][$arr_position])){
											$labels['large-image-link'][$arr_position] = $appip_text_lgimage;
										}else{
											$labels['large-image-link'][$arr_position] = $labels[$fieldarr][$arr_position].' ';
										}
										/*
										if(awsImageGrabberURL($currasin,"P")!=''){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-link-wrapper"><a rel="appiplightbox-'.$result['ASIN'].'" href="'.awsImageURLModify($result['LargeImage'],"P").'"><span class="amazon-element-large-img-link">'.$labels['large-image-link'][$arr_position].'</span></a></div>';
										}
										*/
										if(isset($result['LargeImage']) && $result['LargeImage'] != '' ){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-link-wrapper"><a rel="appiplightbox-'.$result['ASIN'].'" href="#" data-appiplg="'. checkSSLImages_url($result['LargeImage']) .'"><span class="amazon-element-large-img-link">'.$labels['large-image-link'][$arr_position].'</span></a></div>';
										}
										break;
									case 'features':
										if(!isset($labels['features'][$arr_position])){
											$labels['features'][$arr_position] = '';
										}else{
											$labels['features'][$arr_position] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr][$arr_position].' </span>';
										}
										$retarr[$currasin][$fieldarr] = $labels['features'][$arr_position].maybe_convert_encoding($result["Feature"]);
										break;
									case 'link':
										$retarr[$currasin][$fieldarr] = '<a href="'.$linkURL.'"'.$target.'>'.$linkURL.'</a>';
										break;
									case 'new-button':
										$button_class = ' class="btn btn-primary"';
										$button_txt = __('Read More','amazon-product-in-a-post-plugin');
										$retarr[ $currasin ][ $fieldarr ] = '<a ' . $target . $nofollow . $button_class . ' href="' . $btnlinkURL . '">' . $button_txt . '</a>';
										break;
									case 'button':
										if(isset($button_url[$arr_position])){
											$retarr[$currasin][$fieldarr] = '<a '.$target.' href="'.$btnlinkURL.'"'.$nofollow.'><img src="'.$button_url[$arr_position].'" border="0" /></a>';
										}else{
											if(isset($button[$arr_position])){
												$bname 		= $button[$arr_position];
												$brounded 	= strpos($bname,'rounded') !== false ? true : false;
												$bclass 	= isset($new_button_arr[$bname]['color']) ? 'amazon__btn'.$new_button_arr[$bname]['color'].' amazon__price--button--style'.( $brounded ? ' button-rounded' : '') : 'amazon__btn amazon__price--button--style';
												$btext 		= isset($new_button_arr[$bname]['text']) ? esc_attr($new_button_arr[$bname]['text']) : _x('Buy Now', 'button text', 'amazon-product-in-a-post-plugin' );
												$retarr[$currasin][$fieldarr] = '<a '.$target.' href="'.$btnlinkURL.'"'.$nofollow.' class="'.$bclass.'">'.$btext.'</a>';
											}else{
												$buttonURL  = apply_filters('appip_amazon_button_url',plugins_url('/images/generic-buy-button.png',dirname(__FILE__)),'generic-buy-button.png',$region);
												$retarr[$currasin][$fieldarr] = '<a '.$target.' href="'.$btnlinkURL.'"'.$nofollow.'><img class="amazon-price-button-img" src="'.$buttonURL.'" alt="'.apply_filters('appip_amazon_button_alt_text', __('buy now','amazon-product-in-a-post-plugin'),$currasin).'" border="0" /></a>';
											}
										}
										break;
									case 'customerreviews':
										$retarr[$currasin][$fieldarr] = '<iframe src="'.$result['CustomerReviews'].'" class="amazon-customer-reviews" width="100%" seamless="seamless" scrolling="no"></iframe>';
										break;
									default:
										if( preg_match( '/\_clean$/', $fieldarr ) ){
											$tempfieldarr = str_replace('_clean','',$fieldarr);
											$retarr[$currasin][$fieldarr] = isset($result[$tempfieldarr]) && $result[$tempfieldarr]!='' ? $result[$tempfieldarr]: '';
										}else{
											if(isset($result[$fieldarr]) && $result[$fieldarr]!='' && $result[$fieldarr]!= '0'){
												if(!isset($labels[$fieldarr][$arr_position])){
													$labels[$fieldarr][$arr_position] = '';
												}else{
													$labels[$fieldarr][$arr_position] = '<span class="appip-label label-'.str_replace(' ','-',$fieldarr).'">'.$labels[$fieldarr][$arr_position].' </span>';
												}
												$retarr[$currasin][$fieldarr] = $labels[$fieldarr][$arr_position].$result[$fieldarr];
											}else{
												$retarr[$currasin][$fieldarr] = '';
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
							$temparr	= apply_filters( 'amazon_product_in_a_post_plugin_elements_filter', $temparr );
							$retarr[ $currasin ] = $temparr['temp'];
							/* 
							OLD Filter version - applied the filter to the entire array
							everytime instead of just the current ASIN. BAD!!
							$retarr	= apply_filters( 'amazon_product_in_a_post_plugin_elements_filter', $retarr );
							*/
						
						if($wrap != ''){
							$thenewret[] = "<{$wrap} class='{$container_class}'>";
						}
						if(isset($retarr[$currasin]) && is_array($retarr[$currasin]) && !empty($retarr[$currasin])){
							foreach( $retarr[$currasin] as $key => $val ){
								if($key != '' ){
									if( preg_match( '/\_clean$/', $key ))
										$thenewret[] =  $val;
									else
										$thenewret[] =  '<'.$wrap.' class="amazon-element-'.$key.'">'.$val.'</'.$wrap.'>';
								}
							}
						}
						if($wrap != ''){
							$thenewret[] = "</{$wrap}>";
						}
						$arr_position++;
					endforeach;
					if($newErr != '' )
						echo $newErr;
					if(is_array($thenewret)){
						return implode("\n",$thenewret);
					}
					return false;
				endif;
			}
		}else{
			return false;
		}		
	}
}
$AppipShortcodeElements = new AmazonProduct_Shortcode_AmazonElements(array('amazon-element','amazon-elements' ));
function appip_elements_php_block_init() {
	if( function_exists('register_block_type') ){
		wp_register_script( 'amazon-elements', plugins_url( '/blocks/php-block-elements.js', __FILE__ ), array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ));
		register_block_type( 'amazon-pip/amazon-elements', array(
			'attributes'      => array(
				'fields' => array(
					'type' => 'string',
				),
				'asin' => array(
					'type' => 'string',
				),
				'partner_id' => array(
					'type' => 'string',
				),
			),
			'editor_script'   => 'amazon-elements', // The script name we gave in the wp_register_script() call.
			'render_callback' => array('AmazonProduct_Shortcode_AmazonElements', 'do_shortcode'),
		) );
	}
}
//add_action( 'init','appip_elements_php_block_init');
