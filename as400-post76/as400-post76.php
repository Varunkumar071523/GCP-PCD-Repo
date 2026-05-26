<?php
/**
 * Plugin Name: AS400 Decoded - Post 76 DB2 for i CTEs and Recursive SQL
 * Description: Publishes Post 76 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post76_exists');
function as400_ensure_post76_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post76',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('db2-for-i-cte-common-table-expressions-recursive-sql-with-clause-ibm-i-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post76', '1', true);
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
        'DB2 for i CTE',
        'DB2 for i WITH clause',
        'DB2 for i recursive SQL',
        'DB2 for i common table expressions',
        'DB2 for i RECURSIVE WITH',
        'IBM i SQL hierarchical query',
        'DB2 for i anchor member',
        'DB2 for i recursive member',
        'IBM i bill of materials SQL',
        'DB2 for i organization chart SQL',
        'IBM i SQL CTE 2026',
        'DB2 for i WITH UNION ALL',
        'IBM i recursive CTE examples',
        'DB2 for i cycle detection SQL',
        'IBM i advanced SQL queries',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post76-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i CTEs and Recursive SQL: WITH Clause, Anchor and Recursive Members, Hierarchical Queries, Bill of Materials, and Cycle Detection on IBM i in 2026',
        'post_name'     => 'db2-for-i-cte-common-table-expressions-recursive-sql-with-clause-ibm-i-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master DB2 for i common table expressions (CTEs) and recursive SQL in 2026: use the WITH clause to name intermediate result sets, chain multiple CTEs for readable multi-step queries, write recursive CTEs with anchor and recursive members to traverse bill-of-materials hierarchies and organisational trees, and detect cycles in self-referencing data on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-19 08:00:00',
        'post_date_gmt' => '2026-07-19 02:30:00',
        'meta_input'    => array(
            '_as400_post76'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause Hierarchical Queries IBM i',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, anchor/recursive members, bill-of-materials queries, org-chart traversal, cycle detection, and multi-CTE chaining on IBM i.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i CTE common table expressions recursive SQL WITH clause IBM i 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/db2-for-i-cte-common-table-expressions-recursive-sql-with-clause-ibm-i-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause, Hierarchical Queries, IBM i',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i CTEs and recursive SQL: WITH clause, non-recursive CTEs, chained CTEs, recursive CTEs with anchor and recursive members, BOM traversal, org-chart queries, and cycle detection on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause, Hierarchical Queries',
            '_yoast_wpseo_twitter-description'   => 'DB2 for i common table expressions and recursive SQL: WITH clause, anchor/recursive members, BOM traversal, org-chart queries, and cycle detection on IBM i in 2026.',
            '_aioseo_title'                      => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause Hierarchical Queries IBM i',
            '_aioseo_description'                => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, anchor/recursive members, bill-of-materials queries, org-chart traversal, cycle detection, and multi-CTE chaining on IBM i.',
            '_aioseo_keywords'                   => 'DB2 for i CTE, DB2 for i WITH clause, DB2 for i recursive SQL, IBM i hierarchical SQL, DB2 for i bill of materials SQL 2026',
            '_aioseo_og_title'                   => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause, Hierarchical Queries, IBM i',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i CTEs and recursive SQL: WITH clause, non-recursive CTEs, chained CTEs, recursive CTEs with anchor and recursive members, BOM traversal, org-chart queries, and cycle detection on IBM i.',
            '_aioseo_twitter_title'              => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause, Hierarchical Queries',
            '_aioseo_twitter_description'        => 'DB2 for i common table expressions and recursive SQL: WITH clause, anchor/recursive members, BOM traversal, org-chart queries, and cycle detection on IBM i in 2026.',
            'rank_math_focus_keyword'            => 'DB2 for i CTE common table expressions recursive SQL WITH clause IBM i 2026',
            'rank_math_description'              => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, anchor/recursive members, bill-of-materials queries, org-chart traversal, cycle detection, and multi-CTE chaining on IBM i.',
            'rank_math_title'                    => 'DB2 for i CTEs & Recursive SQL 2026: WITH Clause Hierarchical Queries IBM i',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post76_use_classic', 10, 2);
function as400_post76_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post76', true) === '1') return false;
    return $use_block_editor;
}
