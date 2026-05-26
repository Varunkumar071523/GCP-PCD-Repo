<?php
/**
 * Plugin Name: AS400 Decoded - Post 74 IBM i TCP/IP Configuration and Troubleshooting
 * Description: Publishes Post 74 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post74_exists');
function as400_ensure_post74_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post74',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-tcpip-configuration-troubleshooting-cfgtcp-addtcpifc-netstat-ping-traceroute-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post74', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i TCP/IP configuration',
        'IBM i CFGTCP',
        'IBM i ADDTCPIFC',
        'IBM i NETSTAT',
        'IBM i PING command',
        'IBM i TRACEROUTE',
        'IBM i DNS configuration',
        'IBM i CHGTCPDMN',
        'IBM i virtual Ethernet',
        'IBM i line description Ethernet',
        'IBM i TCP/IP troubleshooting 2026',
        'IBM i STRTCP ENDTCP',
        'IBM i CFGTCP menu',
        'IBM i network configuration 2026',
        'IBM i TCP/IP routes static',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post74-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i TCP/IP Configuration and Troubleshooting: CFGTCP, ADDTCPIFC, NETSTAT, PING, TRACEROUTE, DNS, Virtual Ethernet, and Line Descriptions in 2026',
        'post_name'     => 'ibm-i-tcpip-configuration-troubleshooting-cfgtcp-addtcpifc-netstat-ping-traceroute-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Configure and troubleshoot IBM i TCP/IP networking in 2026: use CFGTCP to manage interfaces and routes, add IP addresses with ADDTCPIFC, configure DNS with CHGTCPDMN, diagnose connectivity with NETSTAT, PING, and TRACEROUTE, set up virtual Ethernet between LPARs, and manage Ethernet line descriptions on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-17 08:00:00',
        'post_date_gmt' => '2026-07-17 02:30:00',
        'meta_input'    => array(
            '_as400_post74'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP ADDTCPIFC NETSTAT PING',
            '_yoast_wpseo_metadesc'              => 'Configure and troubleshoot IBM i TCP/IP in 2026: CFGTCP, ADDTCPIFC, CHGTCPDMN DNS, NETSTAT, PING, TRACEROUTE, virtual Ethernet between LPARs, and Ethernet line descriptions.',
            '_yoast_wpseo_focuskw'               => 'IBM i TCP/IP configuration troubleshooting CFGTCP ADDTCPIFC NETSTAT PING TRACEROUTE 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-tcpip-configuration-troubleshooting-cfgtcp-addtcpifc-netstat-ping-traceroute-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP, ADDTCPIFC, NETSTAT, PING',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i TCP/IP networking in 2026: CFGTCP menu, ADDTCPIFC, RMVTCPIFC, DNS with CHGTCPDMN, NETSTAT *IFC/*CNN, PING, TRACEROUTE, virtual Ethernet for LPAR communication, and Ethernet line descriptions.',
            '_yoast_wpseo_twitter-title'         => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP, NETSTAT, PING',
            '_yoast_wpseo_twitter-description'   => 'IBM i TCP/IP networking in 2026: CFGTCP, ADDTCPIFC, DNS, NETSTAT, PING, TRACEROUTE, virtual Ethernet between LPARs, and line descriptions.',
            '_aioseo_title'                      => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP ADDTCPIFC NETSTAT PING',
            '_aioseo_description'                => 'Configure and troubleshoot IBM i TCP/IP in 2026: CFGTCP, ADDTCPIFC, CHGTCPDMN DNS, NETSTAT, PING, TRACEROUTE, virtual Ethernet between LPARs, and Ethernet line descriptions.',
            '_aioseo_keywords'                   => 'IBM i TCP/IP configuration, IBM i CFGTCP, IBM i ADDTCPIFC, IBM i NETSTAT, IBM i PING TRACEROUTE, IBM i virtual Ethernet 2026',
            '_aioseo_og_title'                   => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP, ADDTCPIFC, NETSTAT, PING',
            '_aioseo_og_description'             => 'Complete guide to IBM i TCP/IP networking in 2026: CFGTCP menu, ADDTCPIFC, RMVTCPIFC, DNS with CHGTCPDMN, NETSTAT *IFC/*CNN, PING, TRACEROUTE, virtual Ethernet for LPAR communication, and Ethernet line descriptions.',
            '_aioseo_twitter_title'              => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP, NETSTAT, PING',
            '_aioseo_twitter_description'        => 'IBM i TCP/IP networking in 2026: CFGTCP, ADDTCPIFC, DNS, NETSTAT, PING, TRACEROUTE, virtual Ethernet between LPARs, and line descriptions.',
            'rank_math_focus_keyword'            => 'IBM i TCP/IP configuration troubleshooting CFGTCP ADDTCPIFC NETSTAT PING TRACEROUTE 2026',
            'rank_math_description'              => 'Configure and troubleshoot IBM i TCP/IP in 2026: CFGTCP, ADDTCPIFC, CHGTCPDMN DNS, NETSTAT, PING, TRACEROUTE, virtual Ethernet between LPARs, and Ethernet line descriptions.',
            'rank_math_title'                    => 'IBM i TCP/IP Configuration & Troubleshooting 2026: CFGTCP ADDTCPIFC NETSTAT PING',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post74_use_classic', 10, 2);
function as400_post74_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post74', true) === '1') return false;
    return $use_block_editor;
}
