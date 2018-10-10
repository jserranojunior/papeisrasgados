<?php
$apsc_settings = $this->apsc_settings;
$floating_sidebar = $apsc_settings['floating_sidebar'];
if (isset($floating_sidebar['show']) && $floating_sidebar['active'] == 1) {
    $counter_format = $apsc_settings['sidebar_counter_format'];
    if(isset($apsc_settings['floatbar_profiles']) && $apsc_settings['floatbar_profiles']!=''){
        $floatbar_profiles = strtolower($apsc_settings['floatbar_profiles']);
        $floatbar_profiles = str_replace(' ','',$floatbar_profiles);
        $floatbar_profiles = str_replace('googleplus','googlePlus',$floatbar_profiles);
        $apsc_settings['profile_order'] = explode(',',$floatbar_profiles);
    }
    ?>
    <div class="apsc-floating-sidebar apsc-sidebar-<?php echo $floating_sidebar['theme']; ?> apsc-sidebar-<?php echo $apsc_settings['floating_sidebar']['position'];?>">
        <?php
        foreach ($apsc_settings['profile_order'] as $social_profile) {
            if (isset($apsc_settings['social_profile'][$social_profile]['active']) && $apsc_settings['social_profile'][$social_profile]['active'] == 1) {
                $count = $this->get_formatted_count($this->get_count($social_profile),$counter_format);
                
                ?>
                <div class="apsc-each-profile">
                    <?php
                    switch ($social_profile) {
                        case 'facebook':
                            $facebook_page_id = $apsc_settings['social_profile']['facebook']['page_id'];
                            ?>
                            <a  class="apsc-facebook-icon clearfix" href="<?php echo "http://facebook.com/" . $facebook_page_id; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="fa fa-facebook apsc-facebook"></i><span class="media-name">Facebook</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Fans</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'twitter':
                            
                            ?>
                            <a  class="apsc-twitter-icon clearfix"  href="<?php echo 'http://twitter.com/' . $apsc_settings['social_profile']['twitter']['username']; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="fa fa-twitter apsc-twitter"></i><span class="media-name">Twitter</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a><?php
                            break;
                        case 'googlePlus':
                            $social_profile_url = 'https://plus.google.com/' . $apsc_settings['social_profile']['googlePlus']['page_id'];
                            
                            ?>
                            <a  class="apsc-google-plus-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block"><span class="social-icon">
                                        <i class="apsc-googlePlus fa fa-google-plus"></i><span class="media-name">google+</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a><?php
                            break;
                        case 'instagram':
                            $username = $apsc_settings['social_profile']['instagram']['username'];
                            $social_profile_url = 'https://instagram.com/' . $username;
                            ?>
                            <a  class="apsc-instagram-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block"><span class="social-icon"><i class="apsc-instagram fa fa-instagram"></i><span class="media-name">Instagram</span></span>                
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'youtube':
                            $social_profile_url = esc_url($apsc_settings['social_profile']['youtube']['channel_url']);
                            ?>
                            <a class="apsc-youtube-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-youtube fa fa-youtube"></i><span class="media-name">Youtube</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                                </div>
                            </a><?php
                            break;
                        case 'soundcloud':
                            $username = $apsc_settings['social_profile']['soundcloud']['username'];
                            $social_profile_url = 'https://soundcloud.com/' . $username;
                            ?>
                            <a class="apsc-soundcloud-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-soundcloud fa fa-soundcloud"></i><span class="media-name">Soundcloud</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a><?php
                            break;
                        case 'dribbble':
                            $social_profile_url = 'http://dribbble.com/' . $apsc_settings['social_profile']['dribbble']['username'];
                            ?>
                            <a class="apsc-dribble-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-dribbble fa fa-dribbble"></i><span class="media-name">dribble</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a><?php
                            break;
                        case 'steam':
                            $profile_url = 'http://steamcommunity.com/groups/' . $apsc_settings['social_profile']['steam']['group_name'];
                            ?>
                            <a class="apsc-edit-icon clearfix" href="<?php echo $profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-steam fa fa-steam"></i><span class="media-name">Steam</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                                </div>
                            </a><?php
                            break;
                        case 'vimeo':
                            $username = $apsc_settings['social_profile']['vimeo']['username'];
                            $social_profile_url = 'https://vimeo.com/' . $username;
                            ?>
                            <a class="apsc-vimeo-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-vimeo fa fa-vimeo-square"></i><span class="media-name">Vimeo</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                                </div>
                            </a><?php
                            break;
                        case 'pinterest':
                            $profile_url = $apsc_settings['social_profile']['pinterest']['profile_url'];
                            ?>
                            <a class="apsc-pinterest-icon clearfix" href="<?php echo $profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-pinterest fa fa-pinterest-square"></i><span class="media-name">Pinterest</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscribers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'forrst':
                            $forrst_username = $apsc_settings['social_profile']['forrst']['username'];
                            $forrst_url = 'https://forrst.com/people/' . $forrst_username;
                            ?>
                            <a href="<?php echo $forrst_url ?>" class="apsc-forrst-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-forrst fa fa-forrst"></i><span class="media-name">Forrst</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'vk':
                            $group_id = $apsc_settings['social_profile']['vk']['group_id'];
                            $vk_url = 'http://vk.com/' . $group_id;
                            ?>
                            <a href="<?php echo $vk_url ?>" class="apsc-vk-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-vk fa fa-vk"></i><span class="media-name">VK</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'flickr':
                            $flickr_group_id = $apsc_settings['social_profile']['flickr']['group_id'];
                            $flickr_group_url = 'https://www.flickr.com/groups/' . $flickr_group_id;
                            ?>
                            <a href="<?php echo $flickr_group_url ?>" class="apsc-flickr-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-flickr fa fa-flickr"></i><span class="media-name">Flickr</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'behance':
                            $behance_username = $apsc_settings['social_profile']['behance']['username'];
                            $behance_url = 'https://www.behance.net/' . $behance_username;
                            ?>
                            <a href="<?php echo $behance_url ?>" class="apsc-behance-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-behance fa fa-behance"></i><span class="media-name">Behance</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'github':
                            $git_username = $apsc_settings['social_profile']['github']['username'];
                            $git_url = 'https://github.com/' . $git_username;
                            ?>
                            <a href="<?php echo $git_url ?>" class="apsc-behance-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-github fa fa-github"></i><span class="media-name">Github</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'envato':
                            $envato_profile_url = $apsc_settings['social_profile']['envato']['profile_url'];
                            ?>
                            <a href="<?php echo $envato_profile_url ?>" class="apsc-envato-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-envato fa fa-envato"></i><span class="media-name">Envato</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'posts':
                            ?>
                            <a class="apsc-edit-icon clearfix" href="javascript:void(0);" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-posts fa fa-edit"></i><span class="media-name">Post</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Posts</span>
                                </div>
                            </a><?php
                            break;
                        case 'comments':
                            ?>
                    <a class="apsc-comment-icon clearfix" href="javascript:void(0);" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-comments fa fa-comments"></i><span class="media-name">Comment</span></span>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Comments</span>
                                </div>
                            </a><?php
                            break;
                        default:
                            break;
                    }
                    ?>
                </div><?php
            }
        }
        if(isset($apsc_settings['floating_sidebar']['hover_color']) && $apsc_settings['floating_sidebar']['hover_color']!=''){
            ?>
        <style>
            .apsc-floating-sidebar .apsc-each-profile a:hover{background:<?php echo $apsc_settings['floating_sidebar']['hover_color'];?> !important;}
        </style>
                <?php
        }
        ?>
    </div>
    <?php
}

