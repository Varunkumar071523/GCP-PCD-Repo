<?php
/**
 * Plugin Name: AS400 Decoded - Post 44 IBM i System Startup and Shutdown Procedures
 * Description: Publishes Post 44 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post44_exists');
function as400_ensure_post44_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post44',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-startup-shutdown-procedures-qstrup-strsbs-pwrdwnsys-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post44', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i startup',
        'IBM i shutdown',
        'QSTRUP IBM i',
        'IBM i STRSBS',
        'IBM i ENDSBS',
        'IBM i PWRDWNSYS',
        'IBM i IPL',
        'IBM i INZTCP',
        'IBM i STRTCP',
        'IBM i subsystem startup',
        'IBM i controlled shutdown',
        'IBM i IPL modes',
        'IBM i system startup CL',
        'IBM i autostart jobs',
        'IBM i CHGIPLA',
        'IBM i startup program',
        'IBM i 2026 operations',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post44-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i System Startup and Shutdown Procedures in 2026: QSTRUP, STRTCP, STRSBS, ENDSBS, PWRDWNSYS, and IPL Modes',
        'post_name'     => 'ibm-i-startup-shutdown-procedures-qstrup-strsbs-pwrdwnsys-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A complete guide to IBM i system startup and shutdown procedures in 2026: understanding the IPL sequence, configuring QSTRUP, starting TCP/IP and subsystems with STRTCP and STRSBS, performing controlled shutdowns with ENDSBS and PWRDWNSYS, scheduling maintenance IPLs, and diagnosing common startup failures.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-17 08:00:00',
        'post_date_gmt' => '2026-06-17 02:30:00',
        'meta_input'    => array(
            '_as400_post44'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS, IPL Modes',
            '_yoast_wpseo_metadesc'              => 'Master IBM i startup and shutdown in 2026. Covers the full IPL sequence, QSTRUP customisation, STRTCP, STRSBS, ENDSBS, PWRDWNSYS controlled shutdown, IPL modes, and diagnosing startup failures.',
            '_yoast_wpseo_focuskw'               => 'IBM i startup shutdown QSTRUP STRSBS ENDSBS PWRDWNSYS IPL procedures',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-startup-shutdown-procedures-qstrup-strsbs-pwrdwnsys-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS',
            '_yoast_wpseo_opengraph-description' => 'Complete IBM i startup and shutdown guide: IPL sequence, custom QSTRUP programme, STRTCP, STRSBS, ENDSBS, PWRDWNSYS, scheduled IPLs, and startup failure diagnosis.',
            '_yoast_wpseo_twitter-title'         => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS',
            '_yoast_wpseo_twitter-description'   => 'Complete IBM i startup and shutdown guide: IPL sequence, QSTRUP, STRTCP, STRSBS, ENDSBS, PWRDWNSYS, scheduled IPLs, and failure diagnosis.',
            '_aioseo_title'                      => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS, IPL Modes',
            '_aioseo_description'                => 'Master IBM i startup and shutdown in 2026. Covers the full IPL sequence, QSTRUP customisation, STRTCP, STRSBS, ENDSBS, PWRDWNSYS controlled shutdown, IPL modes, and diagnosing startup failures.',
            '_aioseo_keywords'                   => 'IBM i startup shutdown, QSTRUP IBM i, STRSBS IBM i, ENDSBS IBM i, PWRDWNSYS IBM i, IBM i IPL procedures, IBM i system startup CL',
            '_aioseo_og_title'                   => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS',
            '_aioseo_og_description'             => 'Complete IBM i startup and shutdown guide: IPL sequence, custom QSTRUP programme, STRTCP, STRSBS, ENDSBS, PWRDWNSYS, scheduled IPLs, and startup failure diagnosis.',
            '_aioseo_twitter_title'              => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS',
            '_aioseo_twitter_description'        => 'Complete IBM i startup and shutdown guide: IPL sequence, QSTRUP, STRTCP, STRSBS, ENDSBS, PWRDWNSYS, scheduled IPLs, and failure diagnosis.',
            'rank_math_focus_keyword'            => 'IBM i startup shutdown QSTRUP STRSBS ENDSBS PWRDWNSYS IPL procedures',
            'rank_math_description'              => 'Master IBM i startup and shutdown in 2026. Covers the full IPL sequence, QSTRUP customisation, STRTCP, STRSBS, ENDSBS, PWRDWNSYS controlled shutdown, IPL modes, and diagnosing startup failures.',
            'rank_math_title'                    => 'IBM i System Startup and Shutdown Procedures 2026: QSTRUP, STRSBS, PWRDWNSYS, IPL Modes',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post44_use_classic', 10, 2);
function as400_post44_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post44', true) === '1') return false;
    return $use_block_editor;
}
