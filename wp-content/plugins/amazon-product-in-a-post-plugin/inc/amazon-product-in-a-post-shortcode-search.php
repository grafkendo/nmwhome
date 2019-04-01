<?php

class AmazonProduct_Shortcode_Search extends AmazonProduct_ShortcodeClass{

	public function _setup( ){}

	public function do_shortcode($atts, $content = ''){
		global $amazonhiddenmsg, $amazonerrormsg, $apippopennewwindow, $apippnewwindowhtml, $post;
		$defaults = array(
			'keywords'		=> '',
			'search_index'	=> 'All',
			'sort'			=> 'titlerank',
			'item_page'		=> '1',
			'locale' 		=> APIAP_LOCALE,
			'partner_id' 	=> APIAP_ASSOC_ID,
			'private_key' 	=> APIAP_SECRET_KEY,
			'public_key' 	=> APIAP_PUB_KEY, 
			'item_count'	=> 10,
			'fields'		=> apply_filters( 'amazon-search-fields', 'image,title,button', $post ),
			'field'			=> '',
			'button' 		=> '',
			'listprice' 	=> 1, 
			'used_price' 	=> 1,
			'browse_node' 	=> '',
			'condition' 	=> 'New',
			'availability' 	=> '',
			'replace_title' => '', 
			'template' 		=> 'default',
			'msg_instock' 	=> 'In Stock',
			'msg_outofstock'=> 'Out of Stock',
			'target' 		=> '_blank',
			'button_url' 	=> '',
			'container' 	=> apply_filters('amazon-elements-container','div'),
			'container_class' => apply_filters('amazon-elements-container-class','amazon-element-wrapper'),
			'labels' 		=> '',
			'use_cartURL' 	=> false,		
			'list_price' 	=> null, 		//added only as a secondary use of $listprice
			'show_list' 	=> null,		//added only as a secondary use of $listprice 
			'show_used'		=> null,		//added only as a secondary use of $used_price
			'usedprice' 	=> null,		//added only as a secondary use of $used_price
		);
		extract(shortcode_atts($defaults, $atts));
		$item_page		= (int) $item_page;
		//'All','Wine','Wireless','ArtsAndCrafts','Miscellaneous','Electronics','Jewelry','MobileApps','Photo','Shoes','KindleStore','Automotive','MusicalInstruments','DigitalMusic','GiftCards','FashionBaby','FashionGirls','GourmetFood','HomeGarden','MusicTracks','UnboxVideo','FashionWomen','VideoGames','FashionMen','Kitchen','Video','Software','Beauty','Grocery',,'FashionBoys','Industrial','PetSupplies','OfficeProducts','Magazines','Watches','Luggage','OutdoorLiving','Toys','SportingGoods','PCHardware','Movies','Books','Collectibles','VHS','MP3Downloads','Fashion','Tools','Baby','Apparel','Marketplace','DVD','Appliances','Music','LawnAndGarden','WirelessAccessories','Blended','HealthPersonalCare','Classical'	
		$listprice 		= (isset($list_price) && $list_price != null ) ? $list_price : $listprice;
		$listprice 		= (isset($show_list)  && $show_list != null ) ? $show_list : $listprice;
		$used_price		= (isset($usedprice)  && $usedprice != null ) ? $usedprice : $used_price; 
		$used_price		= (isset($show_used)  && $show_used != null ) ? $show_used : $used_price;
		$useCartURL		= (isset($use_cartURL) && ($use_cartURL == '1' || $use_cartURL == true) ) ? true : false;
		$charlen 		= isset($atts['charlen']) && (int)$atts['charlen'] > 0 ? (int)$atts['charlen'] : 0;
		$new_button_arr = amazon_product_get_new_button_array($locale);

		if($labels != ''){
			$labelstemp = explode(',',$labels);
			unset($labels);
			foreach($labelstemp as $lab){
				$keytemp = explode('::',$lab);
				if(isset($keytemp[0]) && isset($keytemp[1])){
					$labels[$keytemp[0]] = $keytemp[1];
				}
			}
		}else{
			$labels = array();
		}
		$keywords 	= str_replace(", ",",", $keywords);
		if($keywords != '')
			$keywords = explode(',',$keywords);
		if($field == '' && $fields !=''){$field = $fields;}
		if($target!=''){$target = ' target="'.$target.'" ';}
		$appip_text_lgimage = apply_filters('appip_text_lgimage', __( "See larger image", 'amazon-product-in-a-post-plugin' ));
		if ( (is_array( $keywords ) && !empty( $keywords )) ||($search_index !== 'All' && $browse_node !== '' )  ){
			$errors = '';
			//'salesrank','price','-price','titlerank','-video-release-date','relevancerank','-releasedate'
			$srchArr =  array(
				"Operation" 	=> 'ItemSearch',
				"Condition"		=> $condition, 
				"ResponseGroup" => apply_filters('amazon_product_response_group','Large','amazon-product-search'), 
				"SearchIndex"	=> $search_index, 
				'ItemPage'		=> '1',
				"AssociateTag" 	=> $partner_id ,
				"BrowseNode"	=> $browse_node,
				"RequestBy" 	=> 'amazon-product-search'
			);
			if(is_array( $keywords ) && !empty( $keywords ))
				$srchArr["Keywords"] = str_replace( " ", '+', implode( ",", str_replace( '`','"',$keywords ) ) );
			if($browse_node == '' || $search_index == 'All' || $search_index == "Blended")
				unset($srchArr["BrowseNode"]); //can't be blank, or used with All or Blended SearchIndex
			if(isset($availabilty) && (strtolower($availabilty) == 'Available' || (int) $availabilty == 1) && $condition != "New")
				$srchArr["Availability"] = 'Available';
			if( ( (int) $item_page >= 1 &&  (int)$item_page <= 10 ) || ( $search_index == 'All' && (int)$item_page >= 1 &&  (int)$item_page <= 5 ) )
				$srchArr['ItemPage'] = (int)$item_page;
			if( $search_index != 'All' )
				$srchArr['Sort'] = $sort;
			$pxmlNew 		= amazon_plugin_aws_signed_request( $locale, $srchArr, $public_key, $private_key);
			$totalResult1 	= array();
			$totalResult2 	= array();

			if( is_array( $pxmlNew ) && !empty( $pxmlNew ) ){
				$pxmle = array();

				foreach($pxmlNew as $pxmlkey => $pxml ){
					if(!is_array($pxml)){
						$pxmle["ItemSearchResponse"]["Errors"]["Code"] .= 'ERROR!';
						$pxmle["ItemSearchResponse"]["Errors"]["Message"] .= $pxml;
					}else{
						$asins = array();
						$temp 	= isset($pxml['Items']['Item']) && is_array($pxml['Items']['Item']) && !empty($pxml['Items']['Item']) ? $pxml['Items']['Item'] : array();
						if(!empty($temp)){
							$multi = !isset($items['ASIN']) ? true : false;
							if($multi){
								$items = $temp;
								foreach($items as $k => $v ){
									$asins[$v['ASIN']] = $v['ASIN'];
								}
							}else{
								$items = $temp;
								$asins[$items['ASIN']] = $items['ASIN'];
							}
						}
						$r1 = appip_plugin_FormatASINResult( $pxml, 0, $asins );
						if(is_array($r1) && !empty($r1)){
							foreach($r1 as $ritem){
								$totalResult1[] = $ritem;
							}
						}
						$r2 = appip_plugin_FormatASINResult( $pxml, 1, $asins );
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
				echo '<'.'!-- APPIP ERROR['.str_replace(array('<![CDATA[',']]>',']]&gt;','-->'),array('','','','->'),$pxml).']-->';
				return false;
			}else{
				$resultarr1	= isset($totalResult1) && !empty($totalResult1) ? $totalResult1 : array();//appip_plugin_FormatASINResult( $pxml );
				$resultarr2 = isset($totalResult2) && !empty($totalResult2) ? $totalResult2 : array();//appip_plugin_FormatASINResult( $pxml, 1 );
				if(is_array($resultarr1) && !empty($resultarr1)){
					foreach($resultarr1 as $key1 => $result1):
						$mainAArr 			= (array)$result1;
						$otherArr 			= (array)$resultarr2[$key1];
						$resultarr[$key1] 	= (array)$mainAArr + $otherArr;
					endforeach;
				}
				$arr_position = 0;
				if((int) $item_count < 10)
					$resultarr = array_slice($resultarr, 0, $item_count);
				if( is_array( $resultarr ) ):
					$retarr = array();
					$newErr = '';
			/* New Button functionality */
			if($button != ''){
				$buttonstemp = explode(',', $button );
				unset($button);
				if( count($buttonstemp) === 1 && count($resultarr) > 1){
					foreach($resultarr as $kba => $kbv ){
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

					foreach($resultarr as $result):
						$currasin = $result['ASIN'];
						if(isset($result['NoData']) && $result['NoData'] == '1'):
							echo '<!-- APPIP ERROR['."\n".str_replace('-->','->',$result['Error']).']-->';
						else:
							$linkURL = ($useCartURL) ? str_replace(array('##REGION##','##AFFID##','##SUBSCRIBEID##'),array($locale,$partner_id,$public_key),$result['CartURL'] ) : $result['URL'];
							$nofollow 	= ' rel="nofollow"';
							$nofollow 	= apply_filters('appip_template_add_nofollow',$nofollow,$result);
				
							if(is_array($field)){
								$fielda = $field;
							}else{
								$fielda = explode(',',str_replace(' ','',$field));
							}
							if($result['Errors'] != '' ){
								$newErr = "<!-- HIDDEN APIP ERROR(S): ".$result['Errors']." -->\n";
							}
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
										if(isset($button_url))
											$retarr[$currasin][$fieldarr] = $button_url;
										else
											$buttonURL  = apply_filters('appip_amazon_button_url',plugins_url('/images/generic-buy-button.png',dirname(__FILE__)),'generic-buy-button.png',$region);
											$retarr[$currasin][$fieldarr] =$buttonURL;
										break;
									case 'customerreviews_clean':
										$retarr[$currasin][$fieldarr] = $result['CustomerReviews'];
										break;
									case 'title':
										if(!isset($labels['title-wrap']) && !isset($labels['title'])){
											$temptitle = '<div class="appip-title first-spot"><a href="'.$linkURL.'"'.$target.$nofollow.'>'. maybe_convert_encoding($result["Title"]).'</a></div>';
										}elseif(!isset($labels['title-wrap']) && isset($labels['title'])){
											$temptitle= '<h2 class="appip-title second-spot"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.$result["Title"].'</a></h2>';
										}elseif(isset($labels['title-wrap']) && isset($labels['title'])){
											$temptitle= "<{$labels['title-wrap']} class='appip-title third-spot'>".$result["Title"]."</a></{$labels['title-wrap']}>";
										}elseif(isset($labels['title-wrap']) && !isset($labels['title'])){
											$temptitle = '<'.$labels['title-wrap'].' class="appip-title fourth-spot">'. maybe_convert_encoding($result["Title"]).'</'.$labels['title-wrap'].'>';
										}else{
											$temptitle = '<div class="appip-title default-spot"><a href="'.$linkURL.'"'.$target.$nofollow.'>'. maybe_convert_encoding($result["Title"]).'</a></div>';
										}
										$retarr[$currasin][$fieldarr] = $temptitle;
										break;
									case 'desc':
									case 'description':
										if(isset($labels['desc'])){
											$labels['desc'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['desc'].' </span>';
	
										}elseif(isset($labels['description'])){
											$labels['desc'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['description'].' </span>';
										}else{
											$labels['desc'] = '';
										}
										if(is_array($result["ItemDesc"])){
											$desc = $result["ItemDesc"][0];
											$retarr[$currasin][$fieldarr] = maybe_convert_encoding($labels['desc'].$desc['Content']);
										}
										break;
									case 'gallery':
										if(!isset($labels['gallery'])){$labels['gallery'] = "Additional Images:";}else{$labels['gallery'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr].' </span>';}
										if($result['AddlImages']!=''){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><span class="amazon-additional-images-text">'.$labels['gallery'].'</span><br/>'.$result['AddlImages'].'</div>';
										}	
										break;
									case 'imagesets':
										if(!isset($labels['imagesets'])){$labels['imagesets'] = "Additional Images: ";}else{$labels['imagesets'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr].' </span>';}
										if($result['AddlImages']!=''){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><span class="amazon-additional-images-text">'.$labels['imagesets'].'</span><br/>'.$result['AddlImages'].'</div>';
										}	
									case 'list':
										//$labels['list'] = str_replace(':','',$labels['list']);
										$listLabel = '';
										$listPrice = '';
										if(isset($result["Binding"]) && "Kindle Edition" == $result["Binding"]){
											$listLabel = '';
											$listPrice = '';//'N/A';
										}elseif(isset($result["NewAmazonPricing"]["New"]["List"])){
											$listPrice = $result["NewAmazonPricing"]["New"]["List"];
										}
										$listLabel = $listLabel == '' && isset($labels['list']) ? $labels['list']: $listLabel;
										if($listPrice != ''){
											if($listLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="label">'.$listLabel.'</span> '.$listPrice;
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
										$listLabel = $listLabel == '' && isset($labels['list']) ? $labels['list']: $listLabel;
										if($listPrice != ''){
											if($listLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="label">'.$listLabel.'</span> '.$listPrice;
											else
												$retarr[$currasin][$fieldarr] = $listPrice;
										}
										$newLabel = $newLabel == '' && isset($labels['price']) ? $labels['price']: $newLabel;

										if($newPrice != ''){
											if($newLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="label">'.$newLabel.'</span> '.$newPrice;
											else
												$retarr[$currasin][$fieldarr] = $newPrice;
										}
										break;
									case 'price':
										$newLabel = '';
										$newPrice = '';
										if(isset($result["Binding"]) && "Kindle Edition" == $result["Binding"]){
											$newLabel = $result["Binding"].':';
											$newPrice = ' Check Amazon for Pricing <span class="instock">Digital Only</span>';
										//}elseif(isset($result["Offers_Offer_OfferListing_Price_FormattedPrice"])){
											//$newPrice = $result["Offers_Offer_OfferListing_Price_FormattedPrice"];
										}elseif(isset($result["NewAmazonPricing"]["New"]["Price"])){
											$newPrice = $result["NewAmazonPricing"]["New"]["Price"];
										}
										$newLabel = $newLabel == '' && isset($labels['price']) ? $labels['price']: $newLabel;
										if($newPrice != ''){
											if($newLabel != '')
												$retarr[$currasin][$fieldarr] = '<span class="label">'.$newLabel.'</span> '.$newPrice;
											else
												$retarr[$currasin][$fieldarr] = $newPrice;
										}
										break;
									case 'new-price':
									case 'new price':
										if("Kindle Edition" == $result["Binding"]){
											if(isset($labels['price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['price'].' </span>';
											}elseif(isset($labels['new-price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new-price'].' </span>';
											}elseif(isset($labels['new price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new price'].' </span>';
											}else{
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.'Kindle Edition:'.' </span>';
											}
											$retarr[$currasin][$fieldarr] = $labels['price-new'].' Check Amazon for Pricing <span class="instock">Digital Only</span>';
										}else{
											if(isset($labels['price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['price'].' </span>';
											}elseif(isset($labels['new-price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new-price'].' </span>';
											}elseif(isset($labels['new price'])){
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels['new price'].' </span>';
											}else{
												$labels['price-new'] = '<span class="appip-label label-'.$fieldarr.'">'.'New From:'.' </span>';
											}
											$correctedPrice = isset($result["Offers_Offer_OfferListing_Price_FormattedPrice"]) ? $result["Offers_Offer_OfferListing_Price_FormattedPrice"] : $result["LowestNewPrice"];
											if($correctedPrice=='Too low to display'){
												$newPrice = 'Check Amazon For Pricing';
											}else{
												$newPrice = $correctedPrice;
											}
											if($result["TotalNew"]>0){
												$retarr[$currasin][$fieldarr] = $labels['price-new'].maybe_convert_encoding($newPrice).' <span class="instock">'.$msg_instock.'</span>';
											}else{
												$retarr[$currasin][$fieldarr] = $labels['price-new'].maybe_convert_encoding($newPrice).' <span class="outofstock">'.$msg_instock.'</span>';
											}
										}
										break;
									case 'image':
									case 'med-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.awsImageGrabber(awsImageGrabberURL($currasin,"M"),'amazon-image').'</a></div>';
										$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.checkSSLImages_tag($result['MediumImage'],'amazon-image amazon-image-medium',$currasin).'</a></div>';
										break;
									case 'sm-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.awsImageGrabber($result['SmallImage'],'amazon-image').'</a></div>';
										$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.checkSSLImages_tag($result['SmallImage'],'amazon-image amazon-image-small',$currasin).'</a></div>';
										break;
									case 'lg-image':
										$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.checkSSLImages_tag($result['LargeImage'],'amazon-image amazon-image-large',$currasin).'</a></div>';
										break;
									case 'full-image':
										//$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.awsImageGrabber($result['LargeImage'],'amazon-image').'</a></div>';
										if( isset($result['HiResImage']) ) // if there is a hires image by chance, give that
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.checkSSLImages_tag($result['HiResImage'],'amazon-image amazon-image-hires',$currasin).'</a></div>';
										else
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-wrapper"><a href="'.$linkURL.'"'.$target.$nofollow.'>'.checkSSLImages_tag($result['LargeImage'],'amazon-image amazon-image-large',$currasin).'</a></div>';
										break;
									case 'large-image-link':
										if(!isset($labels['large-image-link'])){
											$labels['large-image-link'] = $appip_text_lgimage;
										}else{
											$labels['large-image-link'] = $labels[$fieldarr].' ';
										}
										/*
										if(awsImageGrabberURL($currasin,"P")!=''){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-link-wrapper"><a rel="appiplightbox-'.$result['ASIN'].'" href="'.awsImageURLModify($result['LargeImage'],"P").'"><span class="amazon-element-large-img-link">'.$labels['large-image-link'].'</span></a></div>';
										}
										*/
										if(isset($result['LargeImage']) && $result['LargeImage'] != '' ){
											$retarr[$currasin][$fieldarr] = '<div class="amazon-image-link-wrapper"><a rel="appiplightbox-'.$result['ASIN'].'" href="#" data-appiplg="'. checkSSLImages_url($result['LargeImage']) .'"><span class="amazon-element-large-img-link">'.$labels['large-image-link'].'</span></a></div>';
										}
										break;
									case 'features':
										if(!isset($labels['features'])){
											$labels['features'] = '';
										}else{
											$labels['features'] = '<span class="appip-label label-'.$fieldarr.'">'.$labels[$fieldarr].' </span>';
										}
										$retarr[$currasin][$fieldarr] = $labels['features'].maybe_convert_encoding($result["Feature"]);
										break;
									case 'link':
										$retarr[$currasin][$fieldarr] = '<a href="'.$linkURL.'"'.$target.$nofollow.'>'.$linkURL.'</a>';
										break;
									case 'new-button':
										$button_class = ' class="btn btn-primary"';
										$button_txt = __('Read More','amazon-product-in-a-post-plugin');
										$retarr[ $currasin ][ $fieldarr ] = '<a ' . $target . $nofollow . $button_class . ' href="' . $button_url[$arr_position] . '">' . $button_txt . '</a>';
										break;
									case 'button':
										if(isset($button_url[$arr_position])){
											$retarr[$currasin][$fieldarr] = '<a '.$target.$nofollow.' href="'.$linkURL.'"><img src="'.$button_url[$arr_position].'" border="0" /></a>';
										}else{
											if(isset($button[$arr_position])){
												$bname 		= $button[$arr_position];
												$brounded 	= strpos($bname,'rounded') !== false ? true : false;
												$bclass 	= isset($new_button_arr[$bname]['color']) ? 'amazon__btn'.$new_button_arr[$bname]['color'].' amazon__price--button--style'.( $brounded ? ' button-rounded' : '') : 'amazon__btn amazon__price--button--style';
												$btext 		= isset($new_button_arr[$bname]['text']) ? esc_attr($new_button_arr[$bname]['text']) : _x('Buy Now', 'button text', 'amazon-product-in-a-post-plugin' );
												$retarr[$currasin][$fieldarr] = '<a '.$target.' href="'.$linkURL.'"'.$nofollow.' class="'.$bclass.'">'.$btext.'</a>';
											}else{
												$buttonURL  = apply_filters('appip_amazon_button_url',plugins_url('/images/generic-buy-button.png',dirname(__FILE__)),'generic-buy-button.png',$region);
												$retarr[$currasin][$fieldarr] = '<a '.$target . $nofollow.' href="'.$linkURL.'"><img class="amazon-price-button-img" src="'.$buttonURL.'" alt="'.apply_filters('appip_amazon_button_alt_text', __('buy now','amazon-product-in-a-post-plugin'),$currasin).'" border="0" /></a>';
											}
										}
										break;
									case 'customerreviews':
										$retarr[$currasin][$fieldarr] = '<iframe src="'.$result['CustomerReviews'].'" class="amazon-customer-reviews" width="100%" seamless="seamless"></iframe>';
										break;
									default:
										if(isset($result[$fieldarr]) && $result[$fieldarr]!=''){
											if(!isset($labels[$fieldarr])){
												$labels[$fieldarr] = '';
											}else{
												$labels[$fieldarr] = '<span class="appip-label label-'.str_replace(' ','-',$fieldarr).'">'.$labels[$fieldarr].' </span>';
											}
											$retarr[$currasin][$fieldarr] = $labels[$fieldarr].$result[$fieldarr];
										}else{
											$retarr[$currasin][$fieldarr] = '';
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
							$temparr	= apply_filters( 'amazon_product_in_a_post_plugin_search_filter', $temparr );
							$retarr[ $currasin ] = $temparr['temp'];
							/* 
							OLD Filter version - applied the filter to the entire array
							everytime instead of just the current ASIN. BAD!!
							$retarr	= apply_filters( 'amazon_product_in_a_post_plugin_search_filter', $retarr );
							*/
				
						$wrap = str_replace(array('<','>'), array('',''),$container);
						if($wrap != ''){
							$thenewret[] = "<{$wrap} class='{$container_class}'>";
						}
	
						if(is_array($retarr[$currasin]) && !empty($retarr[$currasin])){
							foreach( $retarr[$currasin] as $key => $val ){
								if($key != '' ){
									if( preg_match( '/\_clean$/', $key ))
										$thenewret[] =  $val;
									else
										$thenewret[] =  '<div class="amazon-element-'.$key.'">'.$val.'</div>';
								}
							}
						}
						if($wrap != ''){
							$thenewret[] = "</{$wrap}>";
						}
						$arr_position++;
					endforeach;
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
new AmazonProduct_Shortcode_Search('amazon-product-search');
