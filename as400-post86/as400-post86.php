<?php
/**
 * Plugin Name: AS400 Decoded - Post 86 IBM i HTTP Client from RPG QSYS2 HTTP GET POST
 * Description: Publishes Post 86 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post86_exists');
function as400_ensure_post86_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post86',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-http-client-rpg-qsys2-http-get-post-rest-api-json-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post86', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i HTTP client',
        'QSYS2 HTTP_GET IBM i',
        'QSYS2 HTTP_POST IBM i',
        'IBM i REST API client',
        'IBM i JSON parsing SQL',
        'DB2 for i HTTP functions',
        'IBM i web service call',
        'IBM i JSON_VALUE SQL',
        'IBM i REST integration',
        'IBM i OAuth token HTTP',
        'IBM i SYSTOOLS JSON2TABLE',
        'IBM i API call from RPG',
        'IBM i HTTP SSL certificate',
        'IBM i REST client 2026',
        'IBM i HTTPGETCCSID',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post86-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i HTTP Client from RPG: QSYS2 HTTP_GET, HTTP_POST, and Calling REST APIs with JSON in 2026',
        'post_name'     => 'ibm-i-http-client-rpg-qsys2-http-get-post-rest-api-json-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Call external REST APIs from IBM i in 2026: use QSYS2.HTTP_GET and QSYS2.HTTP_POST SQL table functions to make HTTP requests, parse JSON responses with JSON_VALUE and JSON_QUERY, consume REST APIs from RPG embedded SQL, handle OAuth token authentication, configure the IBM i SSL certificate trust store for HTTPS connections, and integrate external web services with DB2 for i data.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-29 08:00:00',
        'post_date_gmt' => '2026-07-29 02:30:00',
        'meta_input'    => array(
            '_as400_post86'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET HTTP_POST REST API JSON RPG',
            '_yoast_wpseo_metadesc'              => 'Call REST APIs from IBM i in 2026: QSYS2.HTTP_GET and HTTP_POST SQL table functions, JSON parsing with JSON_VALUE and JSON_QUERY, OAuth token authentication, SSL certificate trust store setup, and consuming external web services from RPG embedded SQL on IBM i.',
            '_yoast_wpseo_focuskw'               => 'IBM i HTTP client QSYS2 HTTP_GET HTTP_POST REST API JSON RPG 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-http-client-rpg-qsys2-http-get-post-rest-api-json-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET, HTTP_POST, REST API, JSON',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to calling REST APIs from IBM i: QSYS2.HTTP_GET and HTTP_POST SQL functions, JSON parsing, OAuth tokens, SSL setup, and integrating external web services from RPG on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET, HTTP_POST, REST API, JSON',
            '_yoast_wpseo_twitter-description'   => 'IBM i REST API client: QSYS2.HTTP_GET and HTTP_POST, JSON parsing, OAuth tokens, and calling external web services from RPG in 2026.',
            '_aioseo_title'                      => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET HTTP_POST REST API JSON RPG',
            '_aioseo_description'                => 'Call REST APIs from IBM i in 2026: QSYS2.HTTP_GET and HTTP_POST SQL table functions, JSON parsing with JSON_VALUE and JSON_QUERY, OAuth token authentication, SSL certificate trust store setup, and consuming external web services from RPG embedded SQL on IBM i.',
            '_aioseo_keywords'                   => 'IBM i HTTP client, QSYS2 HTTP_GET, QSYS2 HTTP_POST IBM i, IBM i REST API client, JSON parsing IBM i 2026',
            '_aioseo_og_title'                   => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET, HTTP_POST, REST API, JSON',
            '_aioseo_og_description'             => 'Complete guide to calling REST APIs from IBM i: QSYS2.HTTP_GET and HTTP_POST SQL functions, JSON parsing, OAuth tokens, SSL setup, and integrating external web services from RPG on IBM i.',
            '_aioseo_twitter_title'              => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET, HTTP_POST, REST API, JSON',
            '_aioseo_twitter_description'        => 'IBM i REST API client: QSYS2.HTTP_GET and HTTP_POST, JSON parsing, OAuth tokens, and calling external web services from RPG in 2026.',
            'rank_math_focus_keyword'            => 'IBM i HTTP client QSYS2 HTTP_GET HTTP_POST REST API JSON RPG 2026',
            'rank_math_description'              => 'Call REST APIs from IBM i in 2026: QSYS2.HTTP_GET and HTTP_POST SQL table functions, JSON parsing with JSON_VALUE and JSON_QUERY, OAuth token authentication, SSL certificate trust store setup, and consuming external web services from RPG embedded SQL on IBM i.',
            'rank_math_title'                    => 'IBM i HTTP Client 2026: QSYS2 HTTP_GET HTTP_POST REST API JSON RPG',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post86_use_classic', 10, 2);
function as400_post86_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post86', true) === '1') return false;
    return $use_block_editor;
}
