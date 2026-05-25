<?php
/**
 * Plugin Name: AS400 Decoded - Post 28 DB2 for i Advanced SQL
 * Description: Publishes Post 28 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post28_exists');
function as400_ensure_post28_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post28',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-advanced-sql-mti-sqe-cqe-index-advisor-statistics-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post28', '1', true);
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
        'DB2 for i advanced SQL',
        'SQE CQE IBM i',
        'IBM i query optimiser',
        'IBM i Index Advisor',
        'Materialized Query Tables IBM i',
        'MQT DB2 for i',
        'DB2 for i statistics',
        'bitmap indexes IBM i',
        'Visual Explain IBM i',
        'IBM i plan cache',
        'DB2 for i performance',
        'IBM i SQL anti-patterns',
        'IBM i sargable predicates',
        'IBM i 2026',
        'DB2 for i MTI',
        'IBM i query tuning',
        'IBM i SQL performance'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post28-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'DB2 for i Advanced SQL in 2026: SQE vs CQE, Index Advisor, Column Statistics, Materialized Query Tables, and Query Performance Patterns',
        'post_name'    => 'ibm-i-db2-advanced-sql-mti-sqe-cqe-index-advisor-statistics-2026',
        'post_content' => $content,
        'post_excerpt' => 'Advanced DB2 for i query performance: the SQE versus CQE split and what it means for your queries, column statistics and automatic maintenance, the Index Advisor and MTI (Managed Temporary Index) detection, Visual Explain in ACS, Materialized Query Tables for pre-computed aggregations, bitmap indexes for analytics, and the SQL anti-patterns that consistently cause performance problems on IBM i — non-sargable predicates, SELECT *, implicit type conversions, and leading wildcard LIKE.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-01 08:00:00',
        'post_date_gmt' => '2026-06-01 02:30:00',
        'meta_input'   => array(
            '_as400_post28' => '1',
            '_yoast_wpseo_title'         => 'DB2 for i Advanced SQL in 2026: SQE, Index Advisor, MQTs and Query Performance',
            '_yoast_wpseo_metadesc'      => 'Deep dive into DB2 for i query performance: SQE vs CQE, column statistics, the Index Advisor and MTI detection, Visual Explain, Materialized Query Tables, bitmap indexes, and the SQL anti-patterns that slow down IBM i queries.',
            '_yoast_wpseo_focuskw'       => 'DB2 for i advanced SQL SQE CQE Index Advisor Materialized Query Tables',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-db2-advanced-sql-mti-sqe-cqe-index-advisor-statistics-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Advanced SQL in 2026: Performance Patterns That Actually Work',
            '_yoast_wpseo_opengraph-description' => 'SQE vs CQE, Index Advisor, column statistics, Materialized Query Tables, bitmap indexes, Visual Explain — the complete query performance toolkit for DB2 for i.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i advanced SQL in 2026 — SQE, MTIs, MQTs, and what makes queries slow',
            '_yoast_wpseo_twitter-description'   => 'MTI_USED=Y means the optimiser built a temporary index at runtime. Create the permanent index. Here is the full DB2 for i query tuning workflow.',
            '_aioseo_title'              => 'DB2 for i Advanced SQL in 2026: SQE, Index Advisor, MQTs and Query Performance',
            '_aioseo_description'        => 'Deep dive into DB2 for i query performance: SQE vs CQE, column statistics, the Index Advisor and MTI detection, Visual Explain, Materialized Query Tables, bitmap indexes, and the SQL anti-patterns that slow down IBM i queries.',
            '_aioseo_keywords'           => 'DB2 for i advanced SQL,SQE CQE IBM i,IBM i Index Advisor,Materialized Query Tables IBM i,DB2 for i statistics,bitmap indexes IBM i,Visual Explain IBM i,IBM i plan cache,IBM i SQL performance,IBM i query tuning',
            '_aioseo_og_title'           => 'DB2 for i Advanced SQL in 2026: Performance Patterns That Actually Work',
            '_aioseo_og_description'     => 'SQE vs CQE, Index Advisor, column statistics, Materialized Query Tables, bitmap indexes, Visual Explain — the complete query performance toolkit for DB2 for i.',
            '_aioseo_twitter_title'      => 'DB2 for i advanced SQL in 2026 — SQE, MTIs, MQTs, and what makes queries slow',
            '_aioseo_twitter_description'=> 'MTI_USED=Y means the optimiser built a temporary index at runtime. Create the permanent index. Here is the full DB2 for i query tuning workflow.',
            'rank_math_focus_keyword'    => 'DB2 for i advanced SQL SQE CQE Index Advisor Materialized Query Tables',
            'rank_math_description'      => 'Deep dive into DB2 for i query performance: SQE vs CQE, column statistics, the Index Advisor and MTI detection, Visual Explain, Materialized Query Tables, bitmap indexes, and the SQL anti-patterns that slow down IBM i queries.',
            'rank_math_title'            => 'DB2 for i Advanced SQL in 2026: SQE, Index Advisor, MQTs and Query Performance',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post28_use_classic', 10, 2);
function as400_post28_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post28', true) === '1') return false;
    return $use_block_editor;
}
