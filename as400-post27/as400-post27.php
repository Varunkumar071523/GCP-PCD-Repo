<?php
/**
 * Plugin Name: AS400 Decoded - Post 27 IBM i Performance Tuning
 * Description: Publishes Post 27 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post27_exists');
function as400_ensure_post27_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post27',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-performance-tuning-memory-pools-wrkactjob-collection-services-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post27', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i performance',
        'IBM i memory pools',
        'WRKACTJOB IBM i',
        'WRKSYSSTS IBM i',
        'IBM i performance tuning',
        'Collection Services IBM i',
        'IBM i paging faults',
        'IBM i batch performance',
        'IBM i subsystems performance',
        'QPFRADJ',
        'IBM i auxiliary storage pools',
        'IBM i Index Advisor',
        'IBM i slow jobs',
        'IBM i 2026',
        'IBM i system values performance',
        'IBM i plan cache',
        'IBM i Navigator performance'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post27-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i Performance Tuning in 2026: Memory Pools, Reading WRKACTJOB, Collection Services, and Diagnosing Slow Batch Jobs',
        'post_name'    => 'ibm-i-performance-tuning-memory-pools-wrkactjob-collection-services-2026',
        'post_content' => $content,
        'post_excerpt' => 'IBM i performance problems are almost always paging (undersized memory pools) or SQL without indexes. This post covers the IBM i memory pool model, reading WRKSYSSTS and WRKACTJOB correctly, key performance system values including QPFRADJ, Collection Services for historical analysis, diagnosing LCKW and DSKW job states, the Index Advisor, and common performance anti-patterns in batch RPG and SQL programs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-31 08:00:00',
        'post_date_gmt' => '2026-05-31 02:30:00',
        'meta_input'   => array(
            '_as400_post27' => '1',
            '_yoast_wpseo_title'         => 'IBM i Performance Tuning in 2026: Memory Pools, WRKACTJOB and Collection Services',
            '_yoast_wpseo_metadesc'      => 'A practical guide to IBM i performance: memory pools and paging, WRKSYSSTS and WRKACTJOB interpretation, QPFRADJ and performance system values, Collection Services, diagnosing LCKW and DSKW, the Index Advisor, and batch performance anti-patterns.',
            '_yoast_wpseo_focuskw'       => 'IBM i performance tuning memory pools WRKACTJOB Collection Services',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-performance-tuning-memory-pools-wrkactjob-collection-services-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Performance Tuning in 2026: Reading the Signals That Matter',
            '_yoast_wpseo_opengraph-description' => 'Memory pools, paging faults, WRKACTJOB job states, Collection Services, Index Advisor — the IBM i performance diagnostic path explained.',
            '_yoast_wpseo_twitter-title'         => 'IBM i performance in 2026 — pools, paging, WRKACTJOB, and why batch jobs go slow',
            '_yoast_wpseo_twitter-description'   => 'DSKW means disk wait. LCKW means lock wait. High DB faults mean your pool is too small. Here is how to read IBM i performance signals correctly.',
            '_aioseo_title'              => 'IBM i Performance Tuning in 2026: Memory Pools, WRKACTJOB and Collection Services',
            '_aioseo_description'        => 'A practical guide to IBM i performance: memory pools and paging, WRKSYSSTS and WRKACTJOB interpretation, QPFRADJ and performance system values, Collection Services, diagnosing LCKW and DSKW, the Index Advisor, and batch performance anti-patterns.',
            '_aioseo_keywords'           => 'IBM i performance,IBM i memory pools,WRKACTJOB,WRKSYSSTS,Collection Services IBM i,QPFRADJ,IBM i paging faults,IBM i batch performance,IBM i Index Advisor,IBM i plan cache',
            '_aioseo_og_title'           => 'IBM i Performance Tuning in 2026: Reading the Signals That Matter',
            '_aioseo_og_description'     => 'Memory pools, paging faults, WRKACTJOB job states, Collection Services, Index Advisor — the IBM i performance diagnostic path explained.',
            '_aioseo_twitter_title'      => 'IBM i performance in 2026 — pools, paging, WRKACTJOB, and why batch jobs go slow',
            '_aioseo_twitter_description'=> 'DSKW means disk wait. LCKW means lock wait. High DB faults mean your pool is too small. Here is how to read IBM i performance signals correctly.',
            'rank_math_focus_keyword'    => 'IBM i performance tuning memory pools WRKACTJOB Collection Services',
            'rank_math_description'      => 'A practical guide to IBM i performance: memory pools and paging, WRKSYSSTS and WRKACTJOB interpretation, QPFRADJ and performance system values, Collection Services, diagnosing LCKW and DSKW, the Index Advisor, and batch performance anti-patterns.',
            'rank_math_title'            => 'IBM i Performance Tuning in 2026: Memory Pools, WRKACTJOB and Collection Services',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post27_use_classic', 10, 2);
function as400_post27_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post27', true) === '1') return false;
    return $use_block_editor;
}
