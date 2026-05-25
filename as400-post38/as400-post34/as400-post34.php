<?php
/**
 * Plugin Name: AS400 Decoded - Post 34 IBM i PTF Management and OS Upgrades
 * Description: Publishes Post 34 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post34_exists');
function as400_ensure_post34_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post34',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ptf-management-os-upgrades-cumulative-sf-groups-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post34', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i PTF',
        'IBM i PTF management',
        'cumulative PTF IBM i',
        'SF99xxx IBM i',
        'IBM i group PTF',
        'SNDPTFORD IBM i',
        'WRKPTF IBM i',
        'APYPTF IBM i',
        'DSPPTF IBM i',
        'IBM i OS upgrade',
        'IBM i TR upgrade',
        'IBM i IMGCLG',
        'IBM i virtual optical',
        'IBM i fix pack',
        'IBM i 7.5 upgrade',
        'IBM i security PTF',
        'IBM i 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post34-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i PTF Management and OS Upgrades in 2026: Ordering Cumulative PTFs, Managing SF99xxx Groups, and Planning an OS Upgrade',
        'post_name'     => 'ibm-i-ptf-management-os-upgrades-cumulative-sf-groups-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'IBM i PTF management in 2026 spans four distinct fix types — individual PTFs, cumulative PTF packages, SF99xxx group PTFs, and Technology Refreshes — each with its own ordering, application, and scheduling discipline. This post explains how to check what is currently installed with DSPPTF and WRKPTF, which SF99xxx groups matter most (DB2, Java, open source, security, HTTP, and TCP/IP), how to order fixes via SNDPTFORD and IBM Fix Central, and how to apply them safely using APYPTF and APYGRPPF with an understanding of IPL-required PTFs and hold/release mechanics. The post also covers using IMGCLG image catalogues to load cumulative packages without physical media, and walks through the order of operations for planning a full IBM i OS version upgrade — from CHKPRDOPT and licence checks through GO LICPGM and the upgrade IPL itself.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-07 08:00:00',
        'post_date_gmt' => '2026-06-07 02:30:00',
        'meta_input'    => array(
            '_as400_post34'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i PTF Management & OS Upgrades 2026: Cumulative PTFs, SF99xxx Groups, IMGCLG Explained',
            '_yoast_wpseo_metadesc'              => 'Master IBM i PTF management in 2026: PTF types, DSPPTF, WRKPTF, SF99xxx groups, SNDPTFORD, APYPTF, IMGCLG virtual optical, and OS upgrade planning with practical CL examples.',
            '_yoast_wpseo_focuskw'               => 'IBM i PTF management OS upgrades cumulative SF99xxx group PTF',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ptf-management-os-upgrades-cumulative-sf-groups-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i PTF Management & OS Upgrades 2026: Cumulative PTFs, SF99xxx Groups, IMGCLG Explained',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i PTF management in 2026 — PTF types, key SF99xxx groups, ordering via Fix Central, applying with APYPTF and APYGRPPF, using IMGCLG, and planning an OS upgrade.',
            '_yoast_wpseo_twitter-title'         => 'IBM i PTF Management & OS Upgrades 2026: SF99xxx Groups, IMGCLG, and Upgrade Planning',
            '_yoast_wpseo_twitter-description'   => 'From DSPPTF to IMGCLG to GO LICPGM — a practical walkthrough of IBM i PTF management and OS upgrade planning in 2026.',
            '_aioseo_title'                      => 'IBM i PTF Management & OS Upgrades 2026: Cumulative PTFs, SF99xxx Groups, IMGCLG Explained',
            '_aioseo_description'                => 'Master IBM i PTF management in 2026: PTF types, DSPPTF, WRKPTF, SF99xxx groups, SNDPTFORD, APYPTF, IMGCLG virtual optical, and OS upgrade planning with practical CL examples.',
            '_aioseo_keywords'                   => 'IBM i PTF management, cumulative PTF IBM i, SF99xxx IBM i, IBM i group PTF, SNDPTFORD, APYPTF IBM i, IBM i OS upgrade, IBM i IMGCLG, IBM i 7.5 upgrade',
            '_aioseo_og_title'                   => 'IBM i PTF Management & OS Upgrades 2026: Cumulative PTFs, SF99xxx Groups, IMGCLG Explained',
            '_aioseo_og_description'             => 'Complete guide to IBM i PTF management in 2026 — PTF types, key SF99xxx groups, ordering via Fix Central, applying with APYPTF and APYGRPPF, using IMGCLG, and planning an OS upgrade.',
            '_aioseo_twitter_title'              => 'IBM i PTF Management & OS Upgrades 2026: SF99xxx Groups, IMGCLG, and Upgrade Planning',
            '_aioseo_twitter_description'        => 'From DSPPTF to IMGCLG to GO LICPGM — a practical walkthrough of IBM i PTF management and OS upgrade planning in 2026.',
            'rank_math_focus_keyword'            => 'IBM i PTF management OS upgrades cumulative SF99xxx group PTF',
            'rank_math_description'              => 'Master IBM i PTF management in 2026: PTF types, DSPPTF, WRKPTF, SF99xxx groups, SNDPTFORD, APYPTF, IMGCLG virtual optical, and OS upgrade planning with practical CL examples.',
            'rank_math_title'                    => 'IBM i PTF Management & OS Upgrades 2026: Cumulative PTFs, SF99xxx Groups, IMGCLG Explained',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post34_use_classic', 10, 2);
function as400_post34_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post34', true) === '1') return false;
    return $use_block_editor;
}
