<?php
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = $this->apsc_settings;
if (isset($atts['theme'])) {
    $apsc_settings['social_profile_theme'] = $atts['theme'];
}
if (isset($atts['profiles'])) {
    $apsc_settings['profile_order'] = explode(',', $atts['profiles']);
}
$cache_period = ($apsc_settings['cache_period'] != '') ? $apsc_settings['cache_period'] * 60 * 60 : 24 * 60 * 60;
?>
<div class="apsc-icons-wrapper <?php echo (isset($atts['custom_class']))?$atts['custom_class']:'';?> apsc-<?php echo $apsc_settings['social_profile_theme']; ?>" >
<?php
foreach ($apsc_settings['profile_order'] as $social_profile) {
    if (isset($apsc_settings['social_profile'][$social_profile]['active']) && $apsc_settings['social_profile'][$social_profile]['active'] == 1) {
        ?>
            <div class="apsc-each-profile">
            <?php
            switch ($social_profile) {
                case 'facebook':
                    $facebook_page_id = $apsc_settings['social_profile']['facebook']['page_id'];
                    ?>
                        <a  class="apsc-facebook-icon clearfix" href="<?php echo "http://facebook.com/" . $facebook_page_id; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="fa fa-facebook apsc-facebook"></i><span class="media-name">Facebook</span></span>
                        <?php
                        $facebook_count = get_transient('apsc_facebook');
                        if (false === $facebook_count) {

                            $api_url = 'http://graph.facebook.com/' . $facebook_page_id;
                            $params = array(
                                'sslverify' => false,
                                'timeout' => 60
                            );
                            $connection = wp_remote_get($api_url, $params);
                            if (is_wp_error($connection)) {
                                $count = 0;
                            } else {
                                $body = json_decode($connection['body']);
                                $count = $body->likes;
                                set_transient('apsc_facebook', $count, $cache_period);
                            }
                        } else {
                            $count = $facebook_count;
                        }
                        ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Fan</span></div></a>
                                <?php
                                        break;
                                    case 'twitter':
                                        ?>
                        <a  class="apsc-twitter-icon clearfix"  href="<?php echo 'http://twitter.com/' . $apsc_settings['social_profile']['twitter']['username']; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="fa fa-twitter apsc-twitter"></i><span class="media-name">Twitter</span></span>
                                        <?php
                                        $twitter_count = get_transient('apsc_twitter');
                                        if (false === $twitter_count) {
                                            $count = $this->get_twitter_count();
                                            set_transient('apsc_twitter', $count, $cache_period);
                                        } else {
                                            $count = $twitter_count;
                                        }
                                        ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span></div></a><?php
                                break;
                            case 'googlePlus':
                                $social_profile_url = 'https://plus.google.com/' . $apsc_settings['social_profile']['googlePlus']['page_id'];
                                ?>
                        <a  class="apsc-google-plus-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-googlePlus fa fa-google-plus"></i><span class="media-name">google+</span></span>
                                        <?php
                                        $googlePlus_count = get_transient('apsc_googlePlus');
                                        if (false === $googlePlus_count) {
                                            $api_url = 'https://www.googleapis.com/plus/v1/people/' . $apsc_settings['social_profile']['googlePlus']['page_id'] . '?key=' . $apsc_settings['social_profile']['googlePlus']['api_key'];
                                            $params = array(
                                                'sslverify' => false,
                                                'timeout' => 60
                                            );
                                            $connection = wp_remote_get($api_url, $params);

                                            if (is_wp_error($connection)) {
                                                $count = 0;
                                            } else {
                                                $_data = json_decode($connection['body'], true);

                                                if (isset($_data['circledByCount'])) {
                                                    $count = intval($_data['circledByCount']);
                                                    set_transient('apsc_googlePlus', $count, $cache_period);
                                                } else {
                                                    $count = 0;
                                                }
                                            }
                                        } else {
                                            $count = $googlePlus_count;
                                        }
                                        ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span></div></a><?php
                                break;
                            case 'instagram':
                                $username = $apsc_settings['social_profile']['instagram']['username'];
                                $user_id = $apsc_settings['social_profile']['instagram']['user_id'];
                                $social_profile_url = 'https://instagram.com/' . $username;
                                ?>
                        <a  class="apsc-instagram-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-instagram fa fa-instagram"></i><span class="media-name">Instagram</span></span>
                                        <?php
                                        $instagram_count = get_transient('apsc_instagram');
                                        if (false === $instagram_count) {
                                            $access_token = $apsc_settings['social_profile']['instagram']['access_token'];

                                            $api_url = 'https://api.instagram.com/v1/users/' . $user_id . '?access_token=' . $access_token;
                                            $params = array(
                                                'sslverify' => false,
                                                'timeout' => 60
                                            );
                                            $connection = wp_remote_get($api_url, $params);
                                            if (is_wp_error($connection)) {
                                                $count = 0;
                                            } else {
                                                $response = json_decode($connection['body'], true);
                                                if (
                                                        isset($response['meta']['code']) && 200 == $response['meta']['code'] && isset($response['data']['counts']['followed_by'])
                                                ) {
                                                    $count = intval($response['data']['counts']['followed_by']);
                                                    set_transient('apsc_instagram', $count, $cache_period);
                                                } else {
                                                    $count = 0;
                                                }
                                            }
                                        } else {
                                            $count = $instagram_count;
                                        }
                                        ?>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span></div></a>
                                <?php
                                break;
                            case 'youtube':
                                $social_profile_url = esc_url($apsc_settings['social_profile']['youtube']['channel_url']);
                                ?>
                        <a class="apsc-youtube-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-youtube fa fa-youtube"></i><span class="media-name">Youtube</span></span>
                        <?php
                        $youtube_count = get_transient('apsc_youtube');
                        if (false === $youtube_count) {
                            $api_url = 'https://gdata.youtube.com/feeds/api/users/' . $apsc_settings['social_profile']['youtube']['username'];
                            $params = array(
                                'sslverify' => false,
                                'timeout' => 60
                            );
                            $connection = wp_remote_get($api_url, $params);
                            if (is_wp_error($connection)) {
                                $count = 0;
                            } else {
                                try {
                                    $body = str_replace('yt:', '', $connection['body']);
                                    $xml = @new SimpleXmlElement($body, LIBXML_NOCDATA);
                                    $count = intval($xml->statistics['subscriberCount']);
                                    set_transient('apsc_youtube', $count, $cache_period);
                                } catch (Exception $e) {
                                    $count = 0;
                                }
                            }
                        } else {
                            $count = $youtube_count;
                        }
                        ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Subscriber</span></div></a><?php
                                break;
                            case 'soundcloud':
                                $username = $apsc_settings['social_profile']['soundcloud']['username'];
                                $social_profile_url = 'https://soundcloud.com/' . $username;
                                ?>
                        <a class="apsc-soundcloud-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-soundcloud fa fa-soundcloud"></i><span class="media-name">Soundcloud</span></span>
                                        <?php
                                        $soundcloud_count = get_transient('apsc_soundcloud');
                                        if (false === $soundcloud_count) {
                                            $api_url = 'https://api.soundcloud.com/users/' . $username . '.json?client_id=' . $apsc_settings['social_profile']['soundcloud']['client_id'];
                                            $params = array(
                                                'sslverify' => false,
                                                'timeout' => 60
                                            );

                                            $connection = wp_remote_get($api_url, $params);
                                            if (is_wp_error($connection)) {
                                                $count = 0;
                                            } else {
                                                $response = json_decode($connection['body'], true);

                                                if (isset($response['followers_count'])) {
                                                    $count = intval($response['followers_count']);
                                                    set_transient('apsc_soundcloud', $count, $cache_period);
                                                } else {
                                                    $count = 0;
                                                }
                                            }
                                        } else {
                                            $count = $soundcloud_count;
                                        }
                                        ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span></div></a><?php
                                break;
                            case 'dribbble':
                                $social_profile_url = 'http://dribbble.com/' . $apsc_settings['social_profile']['dribbble']['username'];

                                $dribbble_count = get_transient('apsc_dribbble');
                                if (false === $dribbble_count) {
                                    $username = $apsc_settings['social_profile']['dribbble']['username'];
                                    $api_url = 'http://api.dribbble.com/' . $username;
                                    $params = array(
                                        'sslverify' => false,
                                        'timeout' => 60
                                    );
                                    $connection = wp_remote_get($api_url, $params);
                                    if (is_wp_error($connection)) {
                                        $count = 0;
                                    } else {
                                        $response = json_decode($connection['body'], true);
                                        if (isset($response['followers_count'])) {
                                            $count = intval($response['followers_count']);
                                            set_transient('apsc_dribbble', $count, $cache_period);
                                        } else {
                                            $count = 0;
                                        }
                                    }
                                } else {
                                    $count = $dribbble_count;
                                }
                                ?>
                        <a class="apsc-dribble-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><i class="apsc-dribbble fa fa-dribbble"></i><span class="media-name">dribble</span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                            </div>
                        </a><?php
                        break;
                    case 'steam':
                        $steam_count = get_transient('apsc_steam');

                        if (false === $steam_count) {
                            $stream_group_name = $apsc_settings['social_profile']['steam']['group_name'];
                            $api_url = 'http://steamcommunity.com/groups/' . $stream_group_name . '/memberslistxml/?xml=1';
                            $params = array(
                                'sslverify' => false,
                                'timeout' => 60
                            );
                            $connection = wp_remote_get($api_url, $params);
                            if (is_wp_error($connection) || '400' <= $connection['response']['code']) {
                                $count = 0;
                            } else {
                                try {
                                    $xml = @new SimpleXmlElement($connection['body'], LIBXML_NOCDATA);
                                    $count = intval($xml->groupDetails->memberCount);
                                    //set_transient('apsc_steam', $count,$cache_period);
                                } catch (Exception $e) {
                                    $count = 0;
                                }
                            }
                        } else {
                            $count = $steam_count;
                        }
                                ?>
                        <a class="apsc-edit-icon clearfix" href="javascript:void(0);" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><i class="apsc-steam fa fa-steam"></i><span class="media-name">Steam</span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a><?php
                break;
            case 'vimeo':
                $username = $apsc_settings['social_profile']['vimeo']['username'];
                $social_profile_url = 'https://vimeo.com/' . $username;
                $vimeo_count = get_transient('apsc_vimeo');
                if (false === $vimeo_count) {
                    $api_url = 'http://vimeo.com/api/v2/' . $username . '/info.json';
                    $params = array(
                        'sslverify' => false,
                        'timeout' => 60
                    );

                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $response = json_decode($connection['body'], true);

                        if (isset($response->total_contacts)) {
                            $count = intval($response->total_contacts);
                            set_transient('apsc_vimeo', $count, $cache_period);
                        } else {
                            $count = 0;
                        }
                    }
                } else {
                    $count = $vimeo_count;
                }
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
                $pinterest_count = get_transient('apsc_pinterest');
                if (false === $pinterest_count) {
                    $metas = get_meta_tags($profile_url);
                    $count = isset($metas['pinterestapp:followers']) ? $metas['pinterestapp:followers'] : 0;
                    set_transient('apsc_pinterest', $count, $cache_period);
                } else {
                    $count = $pinterest_count;
                }
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
                $forrst_count = get_transient('apsc_forrst');
                if (false === $forrst_count) {
                    $api_url = 'https://forrst.com/api/v2/users/info?username=' . $forrst_username;
                    $params = array('sslverify' => false, 'timeout' => 60);
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $detals = json_decode($connection['body']);
                        if (isset($details->resp->followers)) {
                            $count = $details->resp->followers;
                            set_transient('apsc_forrst', $count, $cache_period);
                        }
                    }
                } else {
                    $count = $forrst_count;
                }
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
                $vk_count = get_transient('apsc_vk');
                if (false === $vk_count) {
                    $api_url = 'https://api.vk.com/method/groups.getMembers?group_id=' . $group_id;
                    $params = array(
                        'sslverify' => false,
                        'timeout' => 60
                    );
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $details = json_decode($connection['body']);
                        $count = isset($details->response->count) ? $details->response->count : 0;
                        if (count != 0) {
                            set_transient('apsc_vk', $count, $cache_period);
                        }
                    }
                } else {
                    $count = $vk_count;
                }
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
                $flickr_count = get_transient('apsc_flickr');
                if (false === $flickr_count) {
                    $flickr_api_key = $apsc_settings['social_profile']['flickr']['api_key'];
                    $api_url = 'https://api.flickr.com/services/rest/?&method=flickr.groups.getInfo&api_key=' . $flickr_api_key . '&group_id=' . $flickr_group_id;
                    $params = array(
                        'sslverify' => false,
                        'timeout' => 60
                    );
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $details = simplexml_load_string($connection['body']);
                        $count = isset($details->group->members) ? intval($details->group->members) : 0;
                        set_transient('apsc_flickr', $count, $cache_period);
                    }
                } else {
                    $count = $flickr_count;
                }
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
                $behance_api_key = $apsc_settings['social_profile']['behance']['api_key'];
                $behance_url = 'https://www.behance.net/' . $behance_username;
                $behance_count = get_transient('apsc_behance');
                if (false === $behance_count) {
                    $api_url = 'https://www.behance.net/v2/users/' . $behance_username . '?api_key=' . $behance_api_key;
                    $params = array(
                        'sslverify' => false,
                        'timeout' => 60
                    );
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $details = json_decode($connection['body']);
                        $count = $details->user->stats->followers;
                        set_transient('apsc_behance', $count, $cache_period);
                    }
                } else {
                    $count = $behance_count;
                }
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
                $git_count = get_transient('apsc_github');
                if (false === $git_count) {
                    $api_url = 'https://api.github.com/users/' . $git_username;
                    $params = array(
                        'sslverify' => false,
                        'timeout');
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $detail = json_decode($connection['body']);
                        $count = isset($detail->followers) ? intval($detail->followers) : 0;
                        set_transient('apsc_github', $count, $cache_period);
                    }
                } else {
                    $count = $git_count;
                }
                ?>
                        <a href="<?php echo $git_url ?>" class="apsc-behance-icon clearfix" target="_blank">
                            <div class="apsc-inner-block">
                                <span class="social-icon"><i class="apsc-github fa fa-github"></i><span class="media-name">Github</span></span>
                                <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Members</span>
                            </div>
                        </a>
                <?php
                break;
            case 'envato':

                $envato_profile_url = $apsc_settings['social_profile']['envato']['profile_url'];
                 $envato_count = get_transient('apsc_envato');
                if (false === $envato_count) {
                    $envato_username = $apsc_settings['social_profile']['envato']['username'];
                    $api_url = 'http://marketplace.envato.com/api/edge/user:' . $envato_username . '.json';
                    $params = array(
                        'sslverify' => false,
                        'timeout' => 60
                    );
                    $connection = wp_remote_get($api_url, $params);
                    if (is_wp_error($connection)) {
                        $count = 0;
                    } else {
                        $details = json_decode($connection['body']);
                        $count = isset($details->user->followers) ? $details->user->followers : 0;
                        set_transient( 'apsc_envato', $count,$cache_period );
                    }
                } else {
                    $count = $envato_count;
                    
                }
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
                        <a class="apsc-edit-icon clearfix" href="javascript:void(0);" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-posts fa fa-edit"></i><span class="media-name">Post</span></span>
                <?php
                $posts_count = get_transient('apsc_posts');
                if (false === $posts_count) {
                    $posts_count = wp_count_posts();
                    $count = $posts_count->publish;
                    set_transient('apsc_posts', $count, $cache_period);
                } else {
                    $count = $posts_count;
                }
                ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Post</span></div></a><?php
                                break;
                            case 'comments':
                                ?>
                        <a class="apsc-comment-icon clearfix" href="javascript:void(0);" target="_blank"><div class="apsc-inner-block"><span class="social-icon"><i class="apsc-comments fa fa-comments"></i><span class="media-name">Comment</span></span>
                                <?php
                                $comments_count = get_transient('apsc_comments');
                                if (false === $comments_count) {
                                    $data = wp_count_comments();
                                    $count = $data->approved;
                                    set_transient('apsc_comments', $count, $cache_period);
                                } else {
                                    $count = $comments_count;
                                }
                                ?><span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Comments</span></div></a><?php
                                break;
                            default:
                                break;
                        }
                        ?>
            </div><?php
                    }
                }
                ?>
</div>
<style>.fa:before{background:black;}.apsc-each-profile{background:#bbb;}</style>

