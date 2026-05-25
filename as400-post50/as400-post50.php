<?php
/**
 * Plugin Name: AS400 Decoded - Post 50 DB2 for i JSON and XML Support
 * Description: Publishes Post 50 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post50_exists');
function as400_ensure_post50_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post50',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-json-xml-json-table-json-value-xmltable-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post50', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i JSON',
        'IBM i JSON_VALUE',
        'IBM i JSON_TABLE',
        'IBM i FOR JSON',
        'IBM i JSON SQL',
        'IBM i JSON parsing SQL',
        'IBM i XML SQL',
        'IBM i XMLTABLE',
        'IBM i JSON REST SQL',
        'IBM i JSON_OBJECT',
        'IBM i JSON_ARRAY',
        'IBM i JSON_QUERY',
        'IBM i DB2 REST JSON',
        'IBM i SQL JSON 2026',
        'IBM i JSON HTTP response',
        'IBM i DB2 JSON functions',
        'IBM i XML parsing',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post50-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i JSON and XML Support in 2026: JSON_VALUE, JSON_TABLE, FOR JSON, XMLTABLE, and Building REST Responses in SQL',
        'post_name'     => 'ibm-i-db2-json-xml-json-table-json-value-xmltable-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A comprehensive guide to DB2 for i JSON and XML functions in 2026: extracting scalars with JSON_VALUE, shredding arrays with JSON_TABLE, constructing responses with JSON_OBJECT and JSON_ARRAYAGG, producing JSON with FOR JSON, parsing XML with XMLTABLE, and building a complete REST payload processor stored procedure.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-23 08:00:00',
        'post_date_gmt' => '2026-06-23 02:30:00',
        'meta_input'    => array(
            '_as400_post50'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i JSON and XML Support 2026: JSON_TABLE, JSON_VALUE, FOR JSON, XMLTABLE | AS400 Decoded',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i JSON and XML in 2026: JSON_VALUE, JSON_QUERY, JSON_TABLE for shredding payloads, JSON_OBJECT and FOR JSON for building REST responses, XMLTABLE for XML parsing, and a complete stored procedure example.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i JSON XML JSON_TABLE JSON_VALUE FOR JSON XMLTABLE SQL',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-db2-json-xml-json-table-json-value-xmltable-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i JSON and XML Support 2026: JSON_TABLE, FOR JSON, XMLTABLE',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i JSON and XML functions: shred payloads with JSON_TABLE, build REST responses with JSON_OBJECT and FOR JSON, parse XML with XMLTABLE, and process REST API payloads entirely in SQL.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i JSON & XML 2026: JSON_TABLE, FOR JSON, XMLTABLE',
            '_yoast_wpseo_twitter-description'   => 'Shred JSON payloads into DB2 rows, build REST responses, and parse XML — all in DB2 for i SQL. Full working examples including a JSON order processor stored procedure.',
            '_aioseo_title'                      => 'DB2 for i JSON and XML Support 2026: JSON_TABLE, JSON_VALUE, FOR JSON, XMLTABLE | AS400 Decoded',
            '_aioseo_description'                => 'Master DB2 for i JSON and XML in 2026: JSON_VALUE, JSON_QUERY, JSON_TABLE for shredding payloads, JSON_OBJECT and FOR JSON for building REST responses, XMLTABLE for XML parsing, and a complete stored procedure example.',
            '_aioseo_keywords'                   => 'DB2 for i JSON, JSON_TABLE, JSON_VALUE, FOR JSON, XMLTABLE, IBM i SQL JSON, JSON_OBJECT, JSON_ARRAYAGG, IBM i 2026',
            '_aioseo_og_title'                   => 'DB2 for i JSON and XML Support 2026: JSON_TABLE, FOR JSON, XMLTABLE',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i JSON and XML functions: shred payloads with JSON_TABLE, build REST responses with JSON_OBJECT and FOR JSON, parse XML with XMLTABLE, and process REST API payloads entirely in SQL.',
            '_aioseo_twitter_title'              => 'DB2 for i JSON & XML 2026: JSON_TABLE, FOR JSON, XMLTABLE',
            '_aioseo_twitter_description'        => 'Shred JSON payloads into DB2 rows, build REST responses, and parse XML — all in DB2 for i SQL. Full working examples including a JSON order processor stored procedure.',
            'rank_math_focus_keyword'            => 'DB2 for i JSON XML JSON_TABLE JSON_VALUE FOR JSON XMLTABLE SQL',
            'rank_math_description'              => 'Master DB2 for i JSON and XML in 2026: JSON_VALUE, JSON_QUERY, JSON_TABLE for shredding payloads, JSON_OBJECT and FOR JSON for building REST responses, XMLTABLE for XML parsing, and a complete stored procedure example.',
            'rank_math_title'                    => 'DB2 for i JSON and XML Support 2026: JSON_TABLE, JSON_VALUE, FOR JSON, XMLTABLE | AS400 Decoded',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post50_use_classic', 10, 2);
function as400_post50_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post50', true) === '1') return false;
    return $use_block_editor;
}
