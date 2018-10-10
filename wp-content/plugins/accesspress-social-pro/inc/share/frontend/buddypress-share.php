<?php
			$activity_type = bp_get_activity_type();
	        $url=$activity_link = bp_get_activity_thread_permalink();
	        $title=$activity_title = bp_get_activity_feed_item_title();
			$options = $this->apss_settings;
			$apss_link_open_option=($options['dialog_box_options']=='1') ? "_blank": "";
			$twitter_user=$options['twitter_username'];
			$counter_enable_options=$options['counter_enable_options'];
			$counter_type_options = $options['counter_type_options'];
			$icon_set_value=$options['social_icon_set'];
			$title = $text = get_the_title();
			$cache_period = ($options['cache_period'] != '') ? $options['cache_period']*60*60 : 24 * 60 * 60 ;
			global $post;
			$excerpt=substr(strip_tags(get_the_content()), 0, 30);

			foreach( $options['social_networks'] as $key=>$value ){
				if( intval($value)=='1' ){
					switch($key){
						//counter available for facebook
							case 'facebook':
							$link = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
							?>
							<div class='apss-facebook apss-single-icon'>
									<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
											<div class='apss-icon-block clearfix'>
													<i class='fa fa-facebook'></i>
													<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
													<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
							                    </div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
				                    <div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
				                    <?php } ?>
									</a>
							</div>
							<?php 
							break;

							//counter available for twitter
							case 'twitter':
							$url_twitter = $url;
							$url_twitter=urlencode($url_twitter);
							if(isset( $twitter_user) && $twitter_user !='' ){
								$twitter_user = 'via='.$twitter_user;
							}
							$link ="https://twitter.com/intent/tweet?text=$title&amp;url=$url_twitter&amp;$twitter_user";
							?>
							<div class='apss-twitter apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['twitter-long-text']) && $options['share_texts']['twitter-long-text'] !='' ){ echo $options['share_texts']['twitter-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
										<i class='fa fa-twitter'></i>
										<span class='apss-social-text'><?php if(isset($options['share_texts']['twitter-long-text']) && $options['share_texts']['twitter-long-text'] !='' ){ echo $options['share_texts']['twitter-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
										<span class='apss-share'><?php if(isset($options['share_texts']['twitter-short-text']) && $options['share_texts']['twitter-short-text'] !='' ){ echo $options['share_texts']['twitter-short-text']; }else{ echo "Tweet"; } ?></span>
									</div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
									<?php } ?>
								</a>
							</div>
							<?php
							break;

							//counter available for google plus
							case 'google-plus':
							$link = 'https://plus.google.com/share?url='.$url;
							?>
							<div class='apss-google-plus apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block clearfix'>
									<i class='fa fa-google-plus'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['twitter-long-text']) && $options['share_texts']['twitter-long-text'] !='' ){ echo $options['share_texts']['twitter-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['twitter-short-text']) && $options['share_texts']['twitter-short-text'] !='' ){ echo $options['share_texts']['twitter-short-text']; }else{ echo "Tweet"; } ?></span>
								</div>
										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>
								</a>
							</div>
							<?php
							break;

							//counter available for pinterest
							case 'pinterest':
							// if(has_post_thumbnail()){
							// $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							// $link = 'http://pinterest.com/pin/create/bookmarklet/?media='.$image[0].'&amp;url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt;
							?>

							<div class='apss-pinterest apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-pinterest'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>

										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>

								</a>
							</div>
							<?php
							// }
							break;
							
							//couter available for linkedin
							case 'linkedin':
							$link = "http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=JuizSocialPostSharer&amp;title=".$title."&amp;url=".$url;
							?>
							<div class='apss-linkedin apss-single-icon'>
							<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block clearfix'><i class='fa fa-linkedin'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
								</div>

								<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
								<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
								<?php } ?>

							</a>
							</div>
							<?php
							break;

							//there is no counter available for digg
							case 'digg':
							$link = "http://digg.com/submit?phase=2%20&amp;url=".$url."&amp;title=".$title;
							?>
							<div class='apss-digg apss-single-icon'>
							<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block clearfix'>
									<i class='fa fa-digg'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
								</div>
							</a>
							</div>

							<?php
							break;

							//counter available for delicious
							case 'delicious':
							$link = "https://delicious.com/save?url=$url&title=".$title;
							?>

							<div class='apss-delicious apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
										<i class='fa fa-delicious'></i>
										<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
										<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>
								</a>
							</div>

							<?php
							break;

							//counter available for reddit 
							case 'reddit':
							$link ="http://www.reddit.com/submit?url=$url&title=".$title;
							?>

							<div class='apss-reddit apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-reddit'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>
								</a>
							</div>
							<?php
							break;

							//counter available for stumbleupon
							case 'stumbleupon':
							$link = "http://www.stumbleupon.com/badge/?url=".$url;
							?>

							<div class='apss-stumbleupon apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-stumbleupon'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>
								</a>
							</div>
							<?php break;

							//counter not available for tumblr
							case 'tumblr':
							$link = "http://www.tumblr.com/share/link?url=$url&name=".$title."&description=".$excerpt." title='".$title."'";
							?>
							<div class='apss-tumblr apss-single-icon'>
							<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block clearfix'>
									<i class='fa fa-tumblr'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
								</div>
							</a>
							</div>
							<?php
							break;


							//counter available for vkontakte
							case 'vkontakte':
							$link = "http://vkontakte.ru/share.php?url=".$url;
							?>

							<div class='apss-vk apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-vk'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
										<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
										<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>">Loading...</div>
										<?php } ?>
								</a>
							</div>
							<?php
							break;


							//there is no counter available for xing
							case 'xing':
							$link = "https://www.xing.com/spi/shares/new?url=".$url;
							?>
							<div class='apss-xing apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-xing'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
								</a>
							</div>
							<?php 
							break;

							//counter not available for weibo
							case 'weibo':
							$image[0]='';
							if(has_post_thumbnail()){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							}
							$link = "http://service.weibo.com/share/share.php?url=$url&appkey=&title=".$title."&pic=".$image[0];
							?>
							<div class='apss-weibo apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-weibo'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
								</a>
							</div>
							<?php 
							break;

							//counter available for buffer
							case "buffer":
							$link = "https://bufferapp.com/add?url=$url&text=".$title."&via=&picture=&count=horizontal&source=button";
							?>

							<div class='apss-buffer apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
									<i class='fa fa-buffer'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ echo "Share on"; } ?> <?php echo ucfirst($key); ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Share"; } ?></span>
									</div>
								</a>
							</div>
							<?php
							break;

							case 'email':
									if ( strpos( $options['apss_email_body'], '%%' ) || strpos( $options['apss_email_subject'], '%%' ) ) {
										$link = 'mailto:?subject='.$options['apss_email_subject'].'&amp;body='.$options['apss_email_body'];
										$link = preg_replace( array( '#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#', '#%%url%%#' ), array( get_the_title(), get_site_url(), get_permalink(), $url ), $link );
									}
									else {
										$link = 'mailto:?subject='.$options['apss_email_subject'].'&amp;body='.$options['apss_email_body'].": ".$url;
									}
									?>
							<div class='apss-email apss-single-icon'>
								<a class='share-email-popup' title='<?php if(isset($options['share_texts']['email-long-text']) && $options['share_texts']['email-long-text'] !='' ){ echo $options['share_texts']['email-long-text']; }else{ echo "Send email"; } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
									<div class='apss-icon-block clearfix'>
										<i class='fa  fa-envelope'></i>
										<span class='apss-social-text'><?php if(isset($options['share_texts']['email-long-text']) && $options['share_texts']['email-long-text'] !='' ){ echo $options['share_texts']['email-long-text']; }else{ echo "Send email"; } ?></span>
										<span class='apss-share'><?php if(isset($options['share_texts']['email-short-text']) && $options['share_texts']['email-short-text'] !='' ){ echo $options['share_texts']['email-short-text']; }else{ echo "Mail"; } ?></span>
									</div>
								</a>
							</div>

							<?php
							break;

							case 'print':
							?>
							<div class='apss-print apss-single-icon'>
								<a title='<?php if(isset($options['share_texts']['print-long-text']) && $options['share_texts']['print-long-text'] !='' ){ echo $options['share_texts']['print-long-text']; }else{ echo "Print this"; } ?>' href='javascript:void(0);' onclick='window.print();return false;'>
									<div class='apss-icon-block clearfix'><i class='fa fa-print'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['print-long-text']) && $options['share_texts']['print-long-text'] !='' ){ echo $options['share_texts']['print-long-text']; }else{ echo "Print this"; } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ echo "Print"; } ?></span>
									</div>
								</a>
							</div>
							<?php 
							break;

						}
				}

			}
?>