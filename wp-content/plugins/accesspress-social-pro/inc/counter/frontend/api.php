<?php

$apsc_settings = $this->apsc_settings;
$cache_period = ($apsc_settings['cache_period'] != '') ? $apsc_settings['cache_period'] * 60 * 60 : 24 * 60 * 60;
switch ($profile) {
    case 'facebook':
        $facebook_page_id = $apsc_settings['social_profile']['facebook']['page_id'];
        $default_count = ($apsc_settings['social_profile']['facebook']['default_count'] != '') ? $apsc_settings['social_profile']['facebook']['default_count'] : 0;
        $facebook_count = get_transient('apsc_facebook');
        if (false === $facebook_count) {

            $api_url = 'http://graph.facebook.com/' . $facebook_page_id;
            $params = array(
                'sslverify' => false,
                'timeout' => 60
            );
            $connection = wp_remote_get($api_url, $params);
            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                $body = json_decode($connection['body']);
                $count = isset($body->likes) ? $body->likes : $default_count;
                set_transient('apsc_facebook', $count, $cache_period);
            }
        } else {
            $count = $facebook_count;
        }
        break;
    case 'twitter':
        $twitter_count = get_transient('apsc_twitter');
        $default_count = ($apsc_settings['social_profile']['twitter']['default_count'] != '') ? $apsc_settings['social_profile']['twitter']['default_count'] : 0;
        if (false === $twitter_count) {
            $count = $this->get_twitter_count();
            set_transient('apsc_twitter', $count, $cache_period);
        } else {
            $count = $twitter_count;
        }
        break;
    case 'googlePlus':
        $googlePlus_count = get_transient('apsc_googlePlus');
        $default_count = ($apsc_settings['social_profile']['googlePlus']['default_count'] != '') ? $apsc_settings['social_profile']['googlePlus']['default_count'] : 0;
        if (false === $googlePlus_count) {
            $api_url = 'https://www.googleapis.com/plus/v1/people/' . $apsc_settings['social_profile']['googlePlus']['page_id'] . '?key=' . $apsc_settings['social_profile']['googlePlus']['api_key'];
            $params = array(
                'sslverify' => false,
                'timeout' => 60
            );
            $connection = wp_remote_get($api_url, $params);

            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                $_data = json_decode($connection['body'], true);

                if (isset($_data['circledByCount'])) {
                    $count = intval($_data['circledByCount']);
                    set_transient('apsc_googlePlus', $count, $cache_period);
                } else {
                    $count = $default_count;
                }
            }
        } else {
            $count = $googlePlus_count;
        }
        break;
    case 'instagram':
        $username = $apsc_settings['social_profile']['instagram']['username'];
        $user_id = $apsc_settings['social_profile']['instagram']['user_id'];
        $default_count = ($apsc_settings['social_profile']['googlePlus']['default_count'] != '') ? $apsc_settings['social_profile']['googlePlus']['default_count'] : 0;
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
        break;
    case 'youtube':
        $default_count = ($apsc_settings['social_profile']['youtube']['default_count'] != '') ? $apsc_settings['social_profile']['youtube']['default_count'] : 0;
        $youtube_count = get_transient('apsc_youtube');
        if (false === $youtube_count) {
            $api_url = 'https://gdata.youtube.com/feeds/api/users/' . $apsc_settings['social_profile']['youtube']['username'];
            $params = array(
                'sslverify' => false,
                'timeout' => 60
            );
            $connection = wp_remote_get($api_url, $params);
            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                try {
                    $body = str_replace('yt:', '', $connection['body']);
                    $xml = @new SimpleXmlElement($body, LIBXML_NOCDATA);
                    $count = intval($xml->statistics['subscriberCount']);
                    set_transient('apsc_youtube', $count, $cache_period);
                } catch (Exception $e) {
                    $count = $default_count;
                }
            }
        } else {
            $count = $youtube_count;
        }
        break;
    case 'soundcloud':
        $default_count = ($apsc_settings['social_profile']['soundcloud']['default_count'] != '') ? $apsc_settings['social_profile']['soundcloud']['default_count'] : 0;
        $username = $apsc_settings['social_profile']['soundcloud']['username'];
        $soundcloud_count = get_transient('apsc_soundcloud');
        if (false === $soundcloud_count) {
            $api_url = 'https://api.soundcloud.com/users/' . $username . '.json?client_id=' . $apsc_settings['social_profile']['soundcloud']['client_id'];
            $params = array(
                'sslverify' => false,
                'timeout' => 60
            );

            $connection = wp_remote_get($api_url, $params);
            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                $response = json_decode($connection['body'], true);

                if (isset($response['followers_count'])) {
                    $count = intval($response['followers_count']);
                    set_transient('apsc_soundcloud', $count, $cache_period);
                } else {
                    $count = $default_count;
                }
            }
        } else {
            $count = $soundcloud_count;
        }
        break;
    case 'dribbble':
        $default_count = ($apsc_settings['social_profile']['dribbble']['default_count'] != '') ? $apsc_settings['social_profile']['dribbble']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $response = json_decode($connection['body'], true);
                if (isset($response['followers_count'])) {
                    $count = intval($response['followers_count']);
                    set_transient('apsc_dribbble', $count, $cache_period);
                } else {
                    $count = $default_count;
                }
            }
        } else {
            $count = $dribbble_count;
        }
        break;
    case 'steam':
        $default_count = ($apsc_settings['social_profile']['steam']['default_count'] != '') ? $apsc_settings['social_profile']['steam']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                try {
                    $xml = @new SimpleXmlElement($connection['body'], LIBXML_NOCDATA);
                    $count = intval($xml->groupDetails->memberCount);
                    //set_transient('apsc_steam', $count,$cache_period);
                } catch (Exception $e) {
                    $count = $default_count;
                }
            }
        } else {
            $count = $steam_count;
        }
        break;
    case 'vimeo':
        $default_count = ($apsc_settings['social_profile']['vimeo']['default_count'] != '') ? $apsc_settings['social_profile']['vimeo']['default_count'] : 0;
        $username = $apsc_settings['social_profile']['vimeo']['username'];
        $social_profile_url = 'https://vimeo.com/' . $username;
        $vimeo_count = get_transient('apsc_vimeo');
        if (false === $vimeo_count) {
            $api_url = 'http://vimeo.com/api/v2/channel/' . $username . '/info.json';
            $params = array(
                'sslverify' => false,
                'timeout' => 60
            );

            $connection = wp_remote_get($api_url, $params);
            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                $response = json_decode($connection['body'], true);
                if (isset($response['total_subscribers'])) {
                    $count = intval($response['total_subscribers']);
                    set_transient('apsc_vimeo', $count, $cache_period);
                } else {
                    $count = $default_count;
                }
            }
        } else {
            $count = $vimeo_count;
        }
        break;
    case 'pinterest':
        $default_count = ($apsc_settings['social_profile']['pinterest']['default_count'] != '') ? $apsc_settings['social_profile']['pinterest']['default_count'] : 0;
        $profile_url = $apsc_settings['social_profile']['pinterest']['profile_url'];
        $pinterest_count = get_transient('apsc_pinterest');
        if (false === $pinterest_count) {
            $metas = get_meta_tags($profile_url);
            $count = isset($metas['pinterestapp:followers']) ? $metas['pinterestapp:followers'] : 0;
            set_transient('apsc_pinterest', $count, $cache_period);
        } else {
            $count = $pinterest_count;
        }
        break;
    case 'forrst':
        $default_count = ($apsc_settings['social_profile']['forrst']['default_count'] != '') ? $apsc_settings['social_profile']['forrst']['default_count'] : 0;
        $forrst_username = $apsc_settings['social_profile']['forrst']['username'];
        $forrst_url = 'https://forrst.com/people/' . $forrst_username;
        $forrst_count = get_transient('apsc_forrst');
        if (false === $forrst_count || '' == $forrst_count) {
            $api_url = 'https://forrst.com/api/v2/users/info?username=' . $forrst_username;
            $params = array('sslverify' => false, 'timeout' => 60);
            $connection = wp_remote_get($api_url, $params);
            if (is_wp_error($connection)) {
                $count = $default_count;
            } else {
                $details = json_decode($connection['body']);
                if (isset($details->resp->followers)) {
                    $count = $details->resp->followers;
                    set_transient('apsc_forrst', $count, $cache_period);
                }
                else{
                    $count = $default_count;
                }
            }
        } else {
            $count = $forrst_count;
        }
        break;
    case 'vk':
        $default_count = ($apsc_settings['social_profile']['vk']['default_count'] != '') ? $apsc_settings['social_profile']['vk']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $details = json_decode($connection['body']);
                $count = isset($details->response->count) ? $details->response->count : $default_count;
                if ($count != 0) {
                    set_transient('apsc_vk', $count, $cache_period);
                }
            }
        } else {
            $count = $vk_count;
        }
        break;
    case 'flickr':
        $default_count = ($apsc_settings['social_profile']['flickr']['default_count'] != '') ? $apsc_settings['social_profile']['flickr']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $details = simplexml_load_string($connection['body']);
                $count = isset($details->group->members) ? intval($details->group->members) : $default_count;
                set_transient('apsc_flickr', $count, $cache_period);
            }
        } else {
            $count = $flickr_count;
        }
        break;
    case 'behance':
        $default_count = ($apsc_settings['social_profile']['behance']['default_count'] != '') ? $apsc_settings['social_profile']['behance']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $details = json_decode($connection['body']);
                $count = $details->user->stats->followers;
                set_transient('apsc_behance', $count, $cache_period);
            }
        } else {
            $count = $behance_count;
        }
        break;
    case 'github':
        $default_count = ($apsc_settings['social_profile']['github']['default_count'] != '') ? $apsc_settings['social_profile']['github']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $detail = json_decode($connection['body']);
                $count = isset($detail->followers) ? intval($detail->followers) : $default_count;
                set_transient('apsc_github', $count, $cache_period);
            }
        } else {
            $count = $git_count;
        }
        break;
    case 'envato':
        $default_count = ($apsc_settings['social_profile']['envato']['default_count'] != '') ? $apsc_settings['social_profile']['envato']['default_count'] : 0;
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
                $count = $default_count;
            } else {
                $details = json_decode($connection['body']);
                $count = isset($details->user->followers) ? $details->user->followers : $default_count;
                set_transient('apsc_envato', $count, $cache_period);
            }
        } else {
            $count = $envato_count;
        }
        break;
    case 'posts':
        $posts_count = get_transient('apsc_posts');
        if (false === $posts_count) {
            $posts_count = wp_count_posts();
            $count = $posts_count->publish;
            set_transient('apsc_posts', $count, $cache_period);
        } else {
            $count = $posts_count;
        }

        break;
    case 'comments':
        $comments_count = get_transient('apsc_comments');
        if (false === $comments_count) {
            $data = wp_count_comments();
            $count = $data->approved;
            set_transient('apsc_comments', $count, $cache_period);
        } else {
            $count = $comments_count;
        }
        break;
}

