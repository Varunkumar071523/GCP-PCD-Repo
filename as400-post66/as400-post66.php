<?php
/**
 * Plugin Name: AS400 Decoded - Post 66 IBM i Memory Pools and Pool Sizing
 * Description: Publishes Post 66 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post66_exists');
function as400_ensure_post66_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post66',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-memory-pools-pool-sizing-wrkshrpool-apa-performance-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post66', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i memory pools',
        'IBM i pool sizing',
        'IBM i WRKSHRPOOL',
        'IBM i *BASE pool',
        'IBM i *INTERACT pool',
        'IBM i automatic performance adjustment',
        'IBM i APA tuning',
        'IBM i CHGSHRPOOL',
        'IBM i activity level',
        'IBM i performance tuning memory',
        'IBM i shared memory pool',
        'IBM i WRKMEMPOOL',
        'IBM i paging faults',
        'IBM i memory 2026',
        'IBM i Collection Services memory',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post66-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Memory Pools and Pool Sizing: WRKSHRPOOL, Activity Levels, Automatic Performance Adjustment, and Paging Fault Diagnosis in 2026',
        'post_name'     => 'ibm-i-memory-pools-pool-sizing-wrkshrpool-apa-performance-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Tune IBM i memory performance in 2026: understand the *BASE, *INTERACT, and *SPOOL shared pool structure, set pool sizes and activity levels with WRKSHRPOOL and CHGSHRPOOL, diagnose paging faults using Collection Services and the WRKMEMPOOL command, configure automatic performance adjustment (APA), and size pools correctly for interactive, batch, and PASE workloads.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-09 08:00:00',
        'post_date_gmt' => '2026-07-09 02:30:00',
        'meta_input'    => array(
            '_as400_post66'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Memory Pools 2026: WRKSHRPOOL, Activity Levels, APA, Paging Faults',
            '_yoast_wpseo_metadesc'              => 'Tune IBM i memory in 2026: *BASE, *INTERACT, *SPOOL pools, WRKSHRPOOL and CHGSHRPOOL sizing, activity levels, APA automatic tuning, and Collection Services paging fault diagnosis.',
            '_yoast_wpseo_focuskw'               => 'IBM i memory pools pool sizing WRKSHRPOOL APA performance 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-memory-pools-pool-sizing-wrkshrpool-apa-performance-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Memory Pools and Pool Sizing 2026: WRKSHRPOOL, APA, Paging Faults',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i memory pool tuning: *BASE/*INTERACT/*SPOOL architecture, WRKSHRPOOL and CHGSHRPOOL, activity levels, APA, Collection Services paging fault analysis, and workload-specific sizing guidelines.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Memory Pools 2026: WRKSHRPOOL, APA, Paging Faults',
            '_yoast_wpseo_twitter-description'   => 'Tune IBM i memory pools: *BASE, *INTERACT, *SPOOL sizing, WRKSHRPOOL, activity levels, APA automatic tuning, and Collection Services paging fault diagnosis in 2026.',
            '_aioseo_title'                      => 'IBM i Memory Pools 2026: WRKSHRPOOL, Activity Levels, APA, Paging Faults',
            '_aioseo_description'                => 'Tune IBM i memory in 2026: *BASE, *INTERACT, *SPOOL pools, WRKSHRPOOL and CHGSHRPOOL sizing, activity levels, APA automatic tuning, and Collection Services paging fault diagnosis.',
            '_aioseo_keywords'                   => 'IBM i memory pools, IBM i WRKSHRPOOL, IBM i pool sizing, IBM i *INTERACT pool, IBM i APA, IBM i paging faults, IBM i memory performance 2026',
            '_aioseo_og_title'                   => 'IBM i Memory Pools and Pool Sizing 2026: WRKSHRPOOL, APA, Paging Faults',
            '_aioseo_og_description'             => 'Complete guide to IBM i memory pool tuning: *BASE/*INTERACT/*SPOOL architecture, WRKSHRPOOL and CHGSHRPOOL, activity levels, APA, Collection Services paging fault analysis, and workload-specific sizing guidelines.',
            '_aioseo_twitter_title'              => 'IBM i Memory Pools 2026: WRKSHRPOOL, APA, Paging Faults',
            '_aioseo_twitter_description'        => 'Tune IBM i memory pools: *BASE, *INTERACT, *SPOOL sizing, WRKSHRPOOL, activity levels, APA automatic tuning, and Collection Services paging fault diagnosis in 2026.',
            'rank_math_focus_keyword'            => 'IBM i memory pools pool sizing WRKSHRPOOL APA performance 2026',
            'rank_math_description'              => 'Tune IBM i memory in 2026: *BASE, *INTERACT, *SPOOL pools, WRKSHRPOOL and CHGSHRPOOL sizing, activity levels, APA automatic tuning, and Collection Services paging fault diagnosis.',
            'rank_math_title'                    => 'IBM i Memory Pools 2026: WRKSHRPOOL, Activity Levels, APA, Paging Faults',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post66_use_classic', 10, 2);
function as400_post66_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post66', true) === '1') return false;
    return $use_block_editor;
}
