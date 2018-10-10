<?php
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = $this->apsc_settings;
if (isset($atts['theme'])) {
    $apsc_settings['social_profile_theme'] = $atts['theme'];
}
if (isset($atts['profiles'])) {
    $profiles_atts = strtolower($atts['profiles']);
    $profiles_atts = str_replace('googleplus', 'googlePlus');
    $apsc_settings['profile_order'] = explode(',', $profiles_atts);
}
if (isset($atts['counter_format'])) {
    $apsc_settings['counter_format'] = $atts['counter_format'];
}
if (isset($atts['animation']) && $atts['animation']!='default') {
    $apsc_settings['icon_hover_animation'] = 'apsc-' . $atts['animation'];
}
$cache_period = ($apsc_settings['cache_period'] != '') ? $apsc_settings['cache_period'] * 60 * 60 : 24 * 60 * 60;
$animation_class = ($apsc_settings['icon_hover_animation'] != '') ? ' ' . $apsc_settings['icon_hover_animation'] : '';
?>
<div class="apsc-icons-wrapper <?php echo (isset($atts['custom_class'])) ? $atts['custom_class'] : ''; ?> apsc-<?php echo $apsc_settings['social_profile_theme'] . $animation_class; ?>" data-hover-color="<?php echo $apsc_settings['icon_hover_color']; ?>">
    <?php
    $total_count = 0;
    foreach ($apsc_settings['profile_order'] as $social_profile) {
        if (isset($apsc_settings['social_profile'][$social_profile]['active']) && $apsc_settings['social_profile'][$social_profile]['active'] == 1) {
            $profile_count = $this->get_count($social_profile);
            $total_count = $total_count + $profile_count;
            $count = $this->get_formatted_count($profile_count, $apsc_settings['counter_format']);
            ?>
            <div class="apsc-each-profile">
                <?php
                switch ($social_profile) {
                    case 'facebook':
                        $facebook_page_id = $apsc_settings['social_profile']['facebook']['page_id'];
                        ?>
                        <a  class="apsc-facebook-icon apsc-icon-soc clearfix" href="<?php echo "http://facebook.com/" . $facebook_page_id; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="fa fa-facebook apsc-facebook"></i></span><span class="media-name"><span class="apsc-social-name">Facebook</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Fans</span>
                            </div>
                        </a>
                        <a  class="apsc-bttn-bg" href="<?php echo "http://facebook.com/" . $facebook_page_id; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'twitter':
                        ?>
                        <a  class="apsc-twitter-icon apsc-icon-soc clearfix"  href="<?php echo 'http://twitter.com/' . $apsc_settings['social_profile']['twitter']['username']; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="fa fa-twitter apsc-twitter"></i></span><span class="media-name"><span class="apsc-social-name">Twitter</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a  class="apsc-bttn-bg"  href="<?php echo 'http://twitter.com/' . $apsc_settings['social_profile']['twitter']['username']; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'googlePlus':
                        $social_profile_url = 'https://plus.google.com/' . $apsc_settings['social_profile']['googlePlus']['page_id'];
                        ?>
                        <a  class="apsc-google-plus-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-googlePlus fa fa-google-plus"></i></span><span class="media-name"><span class="apsc-social-name">google+</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a  class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'instagram':
                        $username = $apsc_settings['social_profile']['instagram']['username'];
                        $user_id = $apsc_settings['social_profile']['instagram']['user_id'];
                        $social_profile_url = 'https://instagram.com/' . $username;
                        ?>
                        <a  class="apsc-instagram-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-instagram fa fa-instagram"></i></span><span class="media-name"><span class="apsc-social-name">Instagram</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a  class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'youtube':
                        $social_profile_url = esc_url($apsc_settings['social_profile']['youtube']['channel_url']);
                        ?>
                        <a class="apsc-youtube-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-youtube fa fa-youtube"></i></span><span class="media-name"><span class="apsc-social-name">Youtube</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                            </div>

                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'soundcloud':
                        $username = $apsc_settings['social_profile']['soundcloud']['username'];
                        $social_profile_url = 'https://soundcloud.com/' . $username;
                        ?>
                        <a class="apsc-soundcloud-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-soundcloud fa fa-soundcloud"></i></span><span class="media-name"><span class="apsc-social-name">Soundcloud</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'dribbble':
                        $social_profile_url = 'http://dribbble.com/' . $apsc_settings['social_profile']['dribbble']['username'];
                        ?>
                        <a class="apsc-dribble-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-dribbble fa fa-dribbble"></i></span><span class="media-name"><span class="apsc-social-name">dribble</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'steam':
                        ?>
                        <a class="apsc-steam-icon apsc-icon-soc clearfix" href="http://steamcommunity.com/groups/<?php echo $apsc_settings['social_profile']['steam']['group_name']; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-steam fa fa-steam"></i></span><span class="media-name"><span class="apsc-social-name">Steam</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="http://steamcommunity.com/groups/<?php echo $apsc_settings['social_profile']['steam']['group_name']; ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'vimeo':
                        $username = $apsc_settings['social_profile']['vimeo']['username'];
                        $social_profile_url = 'https://vimeo.com/' . $username;
                        ?>
                        <a class="apsc-vimeo-icon apsc-icon-soc clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-vimeo fa fa-vimeo-square"></i></span><span class="media-name"><span class="apsc-social-name">Vimeo</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'pinterest':
                        $profile_url = $apsc_settings['social_profile']['pinterest']['profile_url'];
                        ?>
                        <a class="apsc-pinterest-icon apsc-icon-soc clearfix" href="<?php echo $profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-pinterest fa fa-pinterest"></i></span><span class="media-name"><span class="apsc-social-name">Pinterest</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $profile_url; ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'forrst':
                        $forrst_username = $apsc_settings['social_profile']['forrst']['username'];
                        $forrst_url = 'https://forrst.com/people/' . $forrst_username;
                        ?>
                        <a href="<?php echo $forrst_url ?>" class="apsc-forrst-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-forrst fa fa-forrst"></i></span><span class="media-name"><span class="apsc-social-name">Forrst</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $forrst_url ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'vk':
                        $group_id = $apsc_settings['social_profile']['vk']['group_id'];
                        $vk_url = 'http://vk.com/' . $group_id;
                        ?>
                        <a href="<?php echo $vk_url ?>" class="apsc-vk-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-vk fa fa-vk"></i></span><span class="media-name"><span class="apsc-social-name">VK</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $vk_url ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'flickr':
                        $flickr_group_id = $apsc_settings['social_profile']['flickr']['group_id'];
                        $flickr_group_url = 'https://www.flickr.com/groups/' . $flickr_group_id;
                        ?>
                        <a href="<?php echo $flickr_group_url ?>" class="apsc-flickr-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-flickr fa fa-flickr"></i></span><span class="media-name"><span class="apsc-social-name">Flickr</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $flickr_group_url ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'behance':
                        $behance_username = $apsc_settings['social_profile']['behance']['username'];
                        $behance_url = 'https://www.behance.net/' . $behance_username;
                        ?>
                        <a href="<?php echo $behance_url ?>" class="apsc-behance-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-behance fa fa-behance"></i></span><span class="media-name"><span class="apsc-social-name">Behance</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $behance_url ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'github':
                        $git_username = $apsc_settings['social_profile']['github']['username'];
                        $git_url = 'https://github.com/' . $git_username;
                        ?>
                        <a href="<?php echo $git_url ?>" class="apsc-github-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-github fa fa-github"></i></span><span class="media-name"><span class="apsc-social-name">Github</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $git_url ?>" target="_blank"><div class="apsc_bttn">subscribe</div></a>
                        <?php
                        break;
                    case 'envato':
                        $envato_profile_url = $apsc_settings['social_profile']['envato']['profile_url'];
                        ?>
                        <a href="<?php echo $envato_profile_url ?>" class="apsc-envato-icon apsc-icon-soc clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-envato fa fa-envato"></i></span><span class="media-name"><span class="apsc-social-name">Envato</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="<?php echo $envato_profile_url ?>" target="_blank"><div class="apsc_bttn">follow</div></a>
                        <?php
                        break;
                    case 'posts':
                        ?>
                        <a class="apsc-edit-icon apsc-icon-soc clearfix" href="javascript:void(0);" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-posts fa fa-edit"></i></span><span class="media-name"><span class="apsc-social-name">Post</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Posts</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="javascript:void(0);" target="_blank"><div class="apsc_bttn">edit</div></a>
                        <?php
                        break;
                    case 'comments':
                        ?>
                        <a class="apsc-comment-icon apsc-icon-soc clearfix" href="javascript:void(0);" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-comments fa fa-comments"></i></span><span class="media-name"><span class="apsc-social-name">Comment</span></span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Comments</span>
                            </div>
                        </a>
                        <a class="apsc-bttn-bg" href="javascript:void(0);" target="_blank"><div class="apsc_bttn">comment</div></a>
                        <?php
                        break;
                    default:
                        break;
                }
                ?>
            </div><?php
        }
    }
    if (isset($apsc_settings['total_count']) && $apsc_settings['total_count'] == 1) {
        ?>
        <div class="apsc-each-profile">
        <a href="javascript:void(0)" class="apsc-total-icon apsc-icon-soc clearfix" target="_blank">
            <div class="apsc-inner-block">
                <span class="social-icon"><span class="apsc-fa-icon"><span class="apsc-total-text">Total</span></span><span class="media-name"><span class="apsc-social-name">Total</span></span></span>
                <span class="apsc-count"><?php echo $this->get_formatted_count($total_count, $apsc_settings['counter_format']); ?></span><span class="apsc-media-type"></span>
            </div>
        </a>
        <a class="apsc-bttn-bg" href="javascript:void(0);" target="_blank"><div class="apsc_bttn">total</div></a>
    </div>
        <?php
    }
    if(isset($apsc_settings['icon_hover_color']) && $apsc_settings['icon_hover_color']!='')
    {
        ?>
    
            <?php
    }
    ?>

</div>


