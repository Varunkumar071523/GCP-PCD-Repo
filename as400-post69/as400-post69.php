<?php
/**
 * Plugin Name: AS400 Decoded - Post 69 DB2 for i Window Functions
 * Description: Publishes Post 69 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post69_exists');
function as400_ensure_post69_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post69',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('db2-for-i-window-functions-row-number-rank-lag-lead-over-partition-by-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post69', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i window functions',
        'DB2 for i ROW_NUMBER',
        'DB2 for i RANK function',
        'DB2 for i DENSE_RANK',
        'DB2 for i LAG function',
        'DB2 for i LEAD function',
        'DB2 for i OVER clause',
        'DB2 for i PARTITION BY',
        'DB2 for i FIRST_VALUE LAST_VALUE',
        'IBM i SQL analytics 2026',
        'DB2 for i OLAP functions',
        'IBM i SQL window function examples',
        'DB2 for i NTILE function',
        'IBM i ranking SQL queries',
        'DB2 for i analytical SQL',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post69-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Window Functions: ROW_NUMBER, RANK, DENSE_RANK, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER and PARTITION BY on IBM i in 2026',
        'post_name'     => 'db2-for-i-window-functions-row-number-rank-lag-lead-over-partition-by-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master DB2 for i window functions in 2026: use ROW_NUMBER, RANK, DENSE_RANK, NTILE, LAG, LEAD, FIRST_VALUE, and LAST_VALUE with the OVER clause, PARTITION BY, and ORDER BY to write advanced analytical SQL queries against IBM i DB2 data without self-joins or subqueries.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-12 08:00:00',
        'post_date_gmt' => '2026-07-12 02:30:00',
        'meta_input'    => array(
            '_as400_post69'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Window Functions 2026: ROW_NUMBER RANK LAG LEAD OVER PARTITION BY',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i window functions on IBM i in 2026: ROW_NUMBER, RANK, DENSE_RANK, NTILE, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER, PARTITION BY, ORDER BY, and frame clauses.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i window functions ROW_NUMBER RANK LAG LEAD OVER PARTITION BY IBM i 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/db2-for-i-window-functions-row-number-rank-lag-lead-over-partition-by-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Window Functions 2026: ROW_NUMBER, RANK, LAG, LEAD, OVER, PARTITION BY',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i window functions on IBM i: ranking functions, value functions, aggregate window functions, OVER/PARTITION BY/ORDER BY, frame clauses, and practical sales analytics examples.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Window Functions 2026: ROW_NUMBER, RANK, LAG, LEAD',
            '_yoast_wpseo_twitter-description'   => 'DB2 for i window functions on IBM i: ROW_NUMBER, RANK, DENSE_RANK, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER and PARTITION BY in 2026.',
            '_aioseo_title'                      => 'DB2 for i Window Functions 2026: ROW_NUMBER RANK LAG LEAD OVER PARTITION BY',
            '_aioseo_description'                => 'Master DB2 for i window functions on IBM i in 2026: ROW_NUMBER, RANK, DENSE_RANK, NTILE, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER, PARTITION BY, ORDER BY, and frame clauses.',
            '_aioseo_keywords'                   => 'DB2 for i window functions, DB2 for i ROW_NUMBER, DB2 for i RANK, DB2 for i LAG LEAD, IBM i SQL analytics, DB2 OVER PARTITION BY 2026',
            '_aioseo_og_title'                   => 'DB2 for i Window Functions 2026: ROW_NUMBER, RANK, LAG, LEAD, OVER, PARTITION BY',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i window functions on IBM i: ranking functions, value functions, aggregate window functions, OVER/PARTITION BY/ORDER BY, frame clauses, and practical sales analytics examples.',
            '_aioseo_twitter_title'              => 'DB2 for i Window Functions 2026: ROW_NUMBER, RANK, LAG, LEAD',
            '_aioseo_twitter_description'        => 'DB2 for i window functions on IBM i: ROW_NUMBER, RANK, DENSE_RANK, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER and PARTITION BY in 2026.',
            'rank_math_focus_keyword'            => 'DB2 for i window functions ROW_NUMBER RANK LAG LEAD OVER PARTITION BY IBM i 2026',
            'rank_math_description'              => 'Master DB2 for i window functions on IBM i in 2026: ROW_NUMBER, RANK, DENSE_RANK, NTILE, LAG, LEAD, FIRST_VALUE, LAST_VALUE with OVER, PARTITION BY, ORDER BY, and frame clauses.',
            'rank_math_title'                    => 'DB2 for i Window Functions 2026: ROW_NUMBER RANK LAG LEAD OVER PARTITION BY',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post69_use_classic', 10, 2);
function as400_post69_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post69', true) === '1') return false;
    return $use_block_editor;
}
