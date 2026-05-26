<?php
/**
 * Plugin Name: AS400 Decoded - Post 57 DB2 for i Query Optimization
 * Description: Publishes Post 57 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post57_exists');
function as400_ensure_post57_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post57',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-query-optimization-visual-explain-sqe-cqe-index-strdbmon-plan-cache-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post57', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i query optimization',
        'IBM i Visual Explain',
        'IBM i SQE',
        'IBM i CQE',
        'IBM i query engine',
        'IBM i DB2 index design',
        'IBM i encoded vector index',
        'IBM i EVI',
        'IBM i STRDBMON',
        'IBM i SQL plan cache',
        'IBM i QSYS2 plan cache',
        'IBM i DB2 performance',
        'IBM i query optimizer',
        'IBM i ACS Visual Explain',
        'IBM i DB2 statistics',
        'IBM i SQL optimization 2026',
        'IBM i DB2 slow query',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post57-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Query Optimization: Visual Explain in ACS, SQE vs CQE, Index Design, Encoded Vector Indexes, STRDBMON, and Reading the SQL Plan Cache on IBM i in 2026',
        'post_name'     => 'ibm-i-db2-query-optimization-visual-explain-sqe-cqe-index-strdbmon-plan-cache-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Optimize DB2 for i query performance in 2026: understand SQE vs CQE query engines, use Visual Explain in ACS to analyze query plans, design effective indexes including encoded vector indexes, collect statistics with STRDBMON, and read the SQL plan cache using QSYS2 catalog views to identify and resolve slow queries.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-30 08:00:00',
        'post_date_gmt' => '2026-06-30 02:30:00',
        'meta_input'    => array(
            '_as400_post57'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Query Optimization 2026: Visual Explain, SQE CQE, Index Design, STRDBMON, Plan Cache',
            '_yoast_wpseo_metadesc'              => 'Optimize DB2 for i queries in 2026: SQE vs CQE engines, Visual Explain in ACS, index design, encoded vector indexes, STRDBMON, and SQL plan cache analysis with QSYS2 views.',
            '_yoast_wpseo_focuskw'               => 'IBM i DB2 query optimization Visual Explain SQE CQE index STRDBMON plan cache 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-db2-query-optimization-visual-explain-sqe-cqe-index-strdbmon-plan-cache-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Query Optimization 2026: Visual Explain, SQE, Index Design, Plan Cache',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i query optimization: SQE vs CQE, Visual Explain in ACS, index design, encoded vector indexes, STRDBMON, and plan cache analysis.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Query Optimization 2026: Visual Explain, SQE, Index, Plan Cache',
            '_yoast_wpseo_twitter-description'   => 'Optimize DB2 for i queries: SQE vs CQE engines, Visual Explain in ACS, index design strategies, encoded vector indexes, and SQL plan cache analysis.',
            '_aioseo_title'                      => 'DB2 for i Query Optimization 2026: Visual Explain, SQE CQE, Index Design, STRDBMON, Plan Cache',
            '_aioseo_description'                => 'Optimize DB2 for i queries in 2026: SQE vs CQE engines, Visual Explain in ACS, index design, encoded vector indexes, STRDBMON, and SQL plan cache analysis with QSYS2 views.',
            '_aioseo_keywords'                   => 'DB2 for i query optimization, IBM i Visual Explain, IBM i SQE CQE, IBM i index design, IBM i EVI, IBM i STRDBMON, IBM i SQL plan cache 2026',
            '_aioseo_og_title'                   => 'DB2 for i Query Optimization 2026: Visual Explain, SQE, Index Design, Plan Cache',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i query optimization: SQE vs CQE, Visual Explain in ACS, index design, encoded vector indexes, STRDBMON, and plan cache analysis.',
            '_aioseo_twitter_title'              => 'DB2 for i Query Optimization 2026: Visual Explain, SQE, Index, Plan Cache',
            '_aioseo_twitter_description'        => 'Optimize DB2 for i queries: SQE vs CQE engines, Visual Explain in ACS, index design strategies, encoded vector indexes, and SQL plan cache analysis.',
            'rank_math_focus_keyword'            => 'IBM i DB2 query optimization Visual Explain SQE CQE index STRDBMON plan cache 2026',
            'rank_math_description'              => 'Optimize DB2 for i queries in 2026: SQE vs CQE engines, Visual Explain in ACS, index design, encoded vector indexes, STRDBMON, and SQL plan cache analysis with QSYS2 views.',
            'rank_math_title'                    => 'DB2 for i Query Optimization 2026: Visual Explain, SQE CQE, Index Design, STRDBMON, Plan Cache',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post57_use_classic', 10, 2);
function as400_post57_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post57', true) === '1') return false;
    return $use_block_editor;
}
