<?php
/**
 * Plugin Name: AS400 Decoded - Post 87 DB2 for i Stored Procedures
 * Description: Publishes Post 87 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post87_exists');
function as400_ensure_post87_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post87',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('db2-for-i-stored-procedures-create-procedure-in-out-cursor-handler-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post87', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i stored procedures',
        'CREATE PROCEDURE IBM i',
        'IBM i SQL procedure IN OUT parameters',
        'DB2 for i DECLARE HANDLER',
        'IBM i stored procedure cursor',
        'CALL stored procedure IBM i',
        'DB2 SQLSTATE IBM i',
        'IBM i stored procedure result set',
        'DB2 for i procedure error handling',
        'IBM i RUNSQL stored procedure',
        'IBM i RPG CALL SQL procedure',
        'DB2 for i local variable procedure',
        'IBM i stored procedure SQLCODE',
        'IBM i stored procedure 2026',
        'IBM i DB2 procedure example',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post87-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Stored Procedures: CREATE PROCEDURE, IN OUT Parameters, Cursors, and Error Handling in 2026',
        'post_name'     => 'db2-for-i-stored-procedures-create-procedure-in-out-cursor-handler-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master DB2 for i stored procedures in 2026: create SQL procedures with CREATE PROCEDURE, define IN, OUT, and INOUT parameters, use local variables and cursors for row-by-row processing, return result sets to callers, handle errors with DECLARE HANDLER and SQLSTATE, call procedures from RPG and CL with RUNSQL, and build reusable database logic encapsulated in DB2 procedures on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-30 08:00:00',
        'post_date_gmt' => '2026-07-30 02:30:00',
        'meta_input'    => array(
            '_as400_post87'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE IN OUT Cursor DECLARE HANDLER',
            '_yoast_wpseo_metadesc'              => 'DB2 for i stored procedures in 2026: CREATE PROCEDURE with IN, OUT, INOUT parameters, local variables and cursors, result sets, DECLARE HANDLER for error handling, SQLSTATE and SQLCODE, calling procedures from RPG and CL, and building reusable database logic on IBM i.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i stored procedures CREATE PROCEDURE IN OUT cursor DECLARE HANDLER 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/db2-for-i-stored-procedures-create-procedure-in-out-cursor-handler-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE, IN OUT, Cursors, Error Handling',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i stored procedures: CREATE PROCEDURE, IN OUT INOUT parameters, local variables, cursors, result sets, DECLARE HANDLER, SQLSTATE, and calling from RPG and CL on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE, IN OUT, Cursors, Error Handling',
            '_yoast_wpseo_twitter-description'   => 'DB2 for i stored procedures: CREATE PROCEDURE, IN OUT parameters, cursors, DECLARE HANDLER error handling, and calling from RPG in 2026.',
            '_aioseo_title'                      => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE IN OUT Cursor DECLARE HANDLER',
            '_aioseo_description'                => 'DB2 for i stored procedures in 2026: CREATE PROCEDURE with IN, OUT, INOUT parameters, local variables and cursors, result sets, DECLARE HANDLER for error handling, SQLSTATE and SQLCODE, calling procedures from RPG and CL, and building reusable database logic on IBM i.',
            '_aioseo_keywords'                   => 'DB2 for i stored procedures, CREATE PROCEDURE IBM i, IN OUT parameters, DECLARE HANDLER, IBM i stored procedure 2026',
            '_aioseo_og_title'                   => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE, IN OUT, Cursors, Error Handling',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i stored procedures: CREATE PROCEDURE, IN OUT INOUT parameters, local variables, cursors, result sets, DECLARE HANDLER, SQLSTATE, and calling from RPG and CL on IBM i.',
            '_aioseo_twitter_title'              => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE, IN OUT, Cursors, Error Handling',
            '_aioseo_twitter_description'        => 'DB2 for i stored procedures: CREATE PROCEDURE, IN OUT parameters, cursors, DECLARE HANDLER error handling, and calling from RPG in 2026.',
            'rank_math_focus_keyword'            => 'DB2 for i stored procedures CREATE PROCEDURE IN OUT cursor DECLARE HANDLER 2026',
            'rank_math_description'              => 'DB2 for i stored procedures in 2026: CREATE PROCEDURE with IN, OUT, INOUT parameters, local variables and cursors, result sets, DECLARE HANDLER for error handling, SQLSTATE and SQLCODE, calling procedures from RPG and CL, and building reusable database logic on IBM i.',
            'rank_math_title'                    => 'DB2 for i Stored Procedures 2026: CREATE PROCEDURE IN OUT Cursor DECLARE HANDLER',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post87_use_classic', 10, 2);
function as400_post87_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post87', true) === '1') return false;
    return $use_block_editor;
}
