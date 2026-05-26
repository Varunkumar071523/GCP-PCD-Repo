<?php
/**
 * Plugin Name: AS400 Decoded - Post 63 DB2 for i CTEs and Recursive SQL
 * Description: Publishes Post 63 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post63_exists');
function as400_ensure_post63_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post63',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('db2-for-i-cte-recursive-sql-with-clause-bom-hierarchy-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post63', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i CTE',
        'DB2 for i WITH clause',
        'DB2 for i recursive SQL',
        'IBM i recursive CTE',
        'DB2 for i BOM explosion SQL',
        'DB2 for i hierarchical data SQL',
        'IBM i SQL common table expression',
        'DB2 for i WITH RECURSIVE',
        'IBM i BOM query SQL',
        'DB2 for i SQL 2026',
        'IBM i SQL subquery optimization',
        'DB2 for i organizational hierarchy SQL',
        'IBM i CTE performance',
        'DB2 for i SQL best practices',
        'IBM i SQL DML with CTE',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post63-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i CTEs and Recursive SQL: WITH Clause, Recursive Queries, BOM Explosion, and Organizational Hierarchy in 2026',
        'post_name'     => 'db2-for-i-cte-recursive-sql-with-clause-bom-hierarchy-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Unlock the power of DB2 for i CTEs and recursive SQL in 2026: write readable multi-step queries using the WITH clause, chain multiple CTEs, use CTEs in UPDATE and DELETE statements, and traverse hierarchical data structures like BOMs and org charts with WITH RECURSIVE and the LEVEL pseudo-column.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-06 08:00:00',
        'post_date_gmt' => '2026-07-06 02:30:00',
        'meta_input'    => array(
            '_as400_post63'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i CTEs and Recursive SQL 2026: WITH Clause, BOM, Hierarchy',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, chained CTEs, CTEs in DML, WITH RECURSIVE for BOM explosion, org hierarchy, and cycle detection.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i CTE recursive SQL WITH clause BOM hierarchy 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/db2-for-i-cte-recursive-sql-with-clause-bom-hierarchy-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i CTEs and Recursive SQL 2026: WITH Clause, BOM Explosion, Hierarchy',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i CTEs and recursive SQL: WITH clause syntax, multiple CTEs, CTEs in UPDATE/DELETE, WITH RECURSIVE for BOM explosion and organizational hierarchy traversal.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i CTEs and Recursive SQL 2026: WITH, BOM, Hierarchy',
            '_yoast_wpseo_twitter-description'   => 'DB2 for i CTEs and recursive SQL: WITH clause, chained CTEs, DML with CTEs, and WITH RECURSIVE for BOM explosion and org charts in 2026.',
            '_aioseo_title'                      => 'DB2 for i CTEs and Recursive SQL 2026: WITH Clause, BOM, Hierarchy',
            '_aioseo_description'                => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, chained CTEs, CTEs in DML, WITH RECURSIVE for BOM explosion, org hierarchy, and cycle detection.',
            '_aioseo_keywords'                   => 'DB2 for i CTE, DB2 for i WITH clause, DB2 for i recursive SQL, IBM i BOM explosion SQL, DB2 for i hierarchical data, IBM i SQL CTE 2026',
            '_aioseo_og_title'                   => 'DB2 for i CTEs and Recursive SQL 2026: WITH Clause, BOM Explosion, Hierarchy',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i CTEs and recursive SQL: WITH clause syntax, multiple CTEs, CTEs in UPDATE/DELETE, WITH RECURSIVE for BOM explosion and organizational hierarchy traversal.',
            '_aioseo_twitter_title'              => 'DB2 for i CTEs and Recursive SQL 2026: WITH, BOM, Hierarchy',
            '_aioseo_twitter_description'        => 'DB2 for i CTEs and recursive SQL: WITH clause, chained CTEs, DML with CTEs, and WITH RECURSIVE for BOM explosion and org charts in 2026.',
            'rank_math_focus_keyword'            => 'DB2 for i CTE recursive SQL WITH clause BOM hierarchy 2026',
            'rank_math_description'              => 'Master DB2 for i CTEs and recursive SQL in 2026: WITH clause, chained CTEs, CTEs in DML, WITH RECURSIVE for BOM explosion, org hierarchy, and cycle detection.',
            'rank_math_title'                    => 'DB2 for i CTEs and Recursive SQL 2026: WITH Clause, BOM, Hierarchy',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post63_use_classic', 10, 2);
function as400_post63_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post63', true) === '1') return false;
    return $use_block_editor;
}
