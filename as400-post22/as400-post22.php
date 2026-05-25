<?php
/**
 * Plugin Name: AS400 Decoded - Post 22 DB2 for i
 * Description: Publishes Post 22 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post22_exists');
function as400_ensure_post22_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post22',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-for-i-integrated-database-system-naming-query-optimiser-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post22', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i',
        'IBM i database',
        'system naming IBM i',
        'SQL naming IBM i',
        'physical files IBM i',
        'logical files IBM i',
        'DB2 query optimiser',
        'QSYS2',
        'IBM i SQL',
        'journalling IBM i',
        'commitment control IBM i',
        'IBM i JDBC',
        'SQL DDL IBM i',
        'IBM i temporal tables',
        'DB2 for i performance',
        'IBM i modernisation',
        'IBM i 2026'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    // ── Content ───────────────────────────────────
    $content = file_get_contents(dirname(__FILE__) . '/post22-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'DB2 for i in 2026: IBM i\'s Integrated Database, System Naming vs SQL Naming, Physical Files, the Query Optimiser, and How It Differs from Standalone Databases',
        'post_name'    => 'ibm-i-db2-for-i-integrated-database-system-naming-query-optimiser-2026',
        'post_content' => $content,
        'post_excerpt' => 'DB2 for i is not a database running on IBM i — it is part of the operating system. This post covers the integrated architecture of DB2 for i, the difference between system naming and SQL naming, physical and logical files versus SQL tables and views, journalling and commitment control, the System Query Optimiser, QSYS2 system views, SQL DDL patterns, temporal tables, global temporary tables, and how to connect external applications via JDBC and ODBC.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-26 08:00:00',
        'post_date_gmt' => '2026-05-26 02:30:00',
        'meta_input'   => array(
            '_as400_post22' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'DB2 for i in 2026: Integrated Database, System Naming, Query Optimiser and SQL Patterns',
            '_yoast_wpseo_metadesc'      => 'How DB2 for i actually works: integrated OS architecture, system naming versus SQL naming, physical and logical files versus SQL tables, journalling, commitment control, the query optimiser, QSYS2 views, and connecting external apps via JDBC and ODBC.',
            '_yoast_wpseo_focuskw'       => 'DB2 for i IBM i database system naming SQL naming query optimiser',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-db2-for-i-integrated-database-system-naming-query-optimiser-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i in 2026: IBM i\'s Integrated Database Explained',
            '_yoast_wpseo_opengraph-description' => 'System naming, SQL naming, physical files, logical files, journalling, the query optimiser, QSYS2 views, and JDBC/ODBC connectivity — everything DB2 for i that trips up developers from other platforms.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i in 2026 — IBM i\'s integrated database is not what you think',
            '_yoast_wpseo_twitter-description'   => 'No server process. No connection string to a port. DB2 for i is the OS. Here is how it works and what that means for SQL development in 2026.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'DB2 for i in 2026: Integrated Database, System Naming, Query Optimiser and SQL Patterns',
            '_aioseo_description'        => 'How DB2 for i actually works: integrated OS architecture, system naming versus SQL naming, physical and logical files versus SQL tables, journalling, commitment control, the query optimiser, QSYS2 views, and connecting external apps via JDBC and ODBC.',
            '_aioseo_keywords'           => 'DB2 for i,IBM i database,system naming IBM i,SQL naming IBM i,physical files IBM i,logical files IBM i,QSYS2,journalling IBM i,DB2 query optimiser,IBM i JDBC ODBC',
            '_aioseo_og_title'           => 'DB2 for i in 2026: IBM i\'s Integrated Database Explained',
            '_aioseo_og_description'     => 'System naming, SQL naming, physical files, logical files, journalling, the query optimiser, QSYS2 views, and JDBC/ODBC connectivity — everything DB2 for i that trips up developers from other platforms.',
            '_aioseo_twitter_title'      => 'DB2 for i in 2026 — IBM i\'s integrated database is not what you think',
            '_aioseo_twitter_description'=> 'No server process. No connection string to a port. DB2 for i is the OS. Here is how it works and what that means for SQL development in 2026.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'DB2 for i IBM i database system naming SQL naming query optimiser',
            'rank_math_description'      => 'How DB2 for i actually works: integrated OS architecture, system naming versus SQL naming, physical and logical files versus SQL tables, journalling, commitment control, the query optimiser, QSYS2 views, and connecting external apps via JDBC and ODBC.',
            'rank_math_title'            => 'DB2 for i in 2026: Integrated Database, System Naming, Query Optimiser and SQL Patterns',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post22_use_classic', 10, 2);
function as400_post22_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post22', true) === '1') return false;
    return $use_block_editor;
}
