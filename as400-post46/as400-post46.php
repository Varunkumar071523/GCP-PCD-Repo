<?php
/**
 * Plugin Name: AS400 Decoded - Post 46 DB2 for i SQL Stored Procedures and UDFs
 * Description: Publishes Post 46 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post46_exists');
function as400_ensure_post46_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post46',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-sql-stored-procedures-udf-create-procedure-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post46', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i stored procedure',
        'IBM i SQL procedure',
        'CREATE PROCEDURE IBM i',
        'DB2 for i UDF',
        'IBM i user-defined function',
        'IBM i cursor SQL',
        'IBM i SQL CALL',
        'IBM i IN OUT parameter',
        'IBM i table function',
        'IBM i scalar function',
        'IBM i SQL loop',
        'IBM i SQLRPGLE procedure',
        'IBM i DB2 business logic',
        'IBM i SQL compound statement',
        'IBM i DECLARE cursor',
        'IBM i SQL procedure 2026',
        'IBM i DB2 reusable logic',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post46-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i SQL Stored Procedures and User-Defined Functions in 2026: CREATE PROCEDURE, Cursors, UDFs, and Reusable Business Logic in DB2',
        'post_name'     => 'ibm-i-db2-sql-stored-procedures-udf-create-procedure-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A comprehensive guide to DB2 for i SQL stored procedures and user-defined functions in 2026: CREATE PROCEDURE syntax, IN/OUT parameters, cursor loops, calling from RPG and Node.js, scalar and table UDFs, and external stored procedures backed by ILE RPG programs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-19 08:00:00',
        'post_date_gmt' => '2026-06-19 02:30:00',
        'meta_input'    => array(
            '_as400_post46'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i SQL stored procedures and UDFs in 2026. Complete guide to CREATE PROCEDURE, IN/OUT parameters, cursor loops, calling from RPG and Node.js, scalar functions, table functions, and external procedures.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i stored procedures SQL UDF CREATE PROCEDURE cursor IBM i',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-db2-sql-stored-procedures-udf-create-procedure-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i stored procedures and UDFs: CREATE PROCEDURE, cursor loops, calling from RPG and Node.js, scalar UDFs, table functions, and external RPG procedures.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_yoast_wpseo_twitter-description'   => 'Complete DB2 for i stored procedures and UDFs guide: CREATE PROCEDURE, cursors, RPG and Node.js calling, scalar UDFs, table functions, and external procedures.',
            '_aioseo_title'                      => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_aioseo_description'                => 'Master DB2 for i SQL stored procedures and UDFs in 2026. Complete guide to CREATE PROCEDURE, IN/OUT parameters, cursor loops, calling from RPG and Node.js, scalar functions, table functions, and external procedures.',
            '_aioseo_keywords'                   => 'DB2 for i stored procedure, IBM i SQL procedure, CREATE PROCEDURE IBM i, DB2 for i UDF, IBM i user-defined function, IBM i cursor SQL, IBM i table function',
            '_aioseo_og_title'                   => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i stored procedures and UDFs: CREATE PROCEDURE, cursor loops, calling from RPG and Node.js, scalar UDFs, table functions, and external RPG procedures.',
            '_aioseo_twitter_title'              => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_aioseo_twitter_description'        => 'Complete DB2 for i stored procedures and UDFs guide: CREATE PROCEDURE, cursors, RPG and Node.js calling, scalar UDFs, table functions, and external procedures.',
            'rank_math_focus_keyword'            => 'DB2 for i stored procedures SQL UDF CREATE PROCEDURE cursor IBM i',
            'rank_math_description'              => 'Master DB2 for i SQL stored procedures and UDFs in 2026. Complete guide to CREATE PROCEDURE, IN/OUT parameters, cursor loops, calling from RPG and Node.js, scalar functions, table functions, and external procedures.',
            'rank_math_title'                    => 'DB2 for i Stored Procedures and UDFs 2026: CREATE PROCEDURE, Cursors, Scalar and Table Functions',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post46_use_classic', 10, 2);
function as400_post46_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post46', true) === '1') return false;
    return $use_block_editor;
}
