<?php
/**
 * Plugin Name: AS400 Decoded - Post 43 HTTP REST API Calls from RPG with HTTPAPI
 * Description: Publishes Post 43 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post43_exists');
function as400_ensure_post43_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post43',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-httpapi-rpg-http-client-rest-api-yajl-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post43', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'HTTPAPI IBM i',
        'Scott Klement HTTPAPI',
        'IBM i HTTP client RPG',
        'IBM i REST API RPG',
        'IBM i YAJL JSON',
        'IBM i JSON parsing RPG',
        'IBM i OAuth 2.0 RPG',
        'IBM i HTTP GET RPG',
        'IBM i HTTP POST RPG',
        'IBM i web service RPG',
        'IBM i REST client',
        'IBM i HTTPAPI install',
        'IBM i SSL TLS RPG',
        'IBM i HTTP ILE',
        'IBM i API integration RPG',
        'IBM i REST 2026',
        'IBM i RPG JSON',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post43-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI by Scott Klement, HTTP GET and POST, JSON Parsing with YAJL, and OAuth 2.0',
        'post_name'     => 'ibm-i-httpapi-rpg-http-client-rest-api-yajl-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'HTTPAPI by Scott Klement is the standard open source library for making outbound HTTP calls from IBM i RPG programs. This post covers installing HTTPAPI and YAJL, making GET and POST requests, parsing JSON responses, implementing the OAuth 2.0 client credentials flow from ILE RPG, and managing SSL certificates on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-16 08:00:00',
        'post_date_gmt' => '2026-06-16 02:30:00',
        'meta_input'    => array(
            '_as400_post43'                      => '1',
            '_yoast_wpseo_title'                 => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI, GET/POST, YAJL JSON, OAuth 2.0 %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Call external REST APIs from IBM i RPG using Scott Klement\'s HTTPAPI in 2026. Covers HTTP GET and POST, JSON parsing with YAJL, OAuth 2.0 token flows, and SSL/TLS certificate management.',
            '_yoast_wpseo_focuskw'               => 'IBM i HTTPAPI RPG HTTP client REST API YAJL JSON OAuth 2.0',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-httpapi-rpg-http-client-rest-api-yajl-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI, GET/POST, YAJL JSON, OAuth 2.0',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to calling external REST APIs from ILE RPG on IBM i using Scott Klement\'s HTTPAPI library — HTTP GET/POST, YAJL JSON parsing, OAuth 2.0 client credentials, and SSL certificate setup.',
            '_yoast_wpseo_twitter-title'         => 'REST APIs from IBM i RPG in 2026: HTTPAPI, YAJL JSON, OAuth 2.0',
            '_yoast_wpseo_twitter-description'   => 'How to call external REST APIs from IBM i RPG with HTTPAPI — HTTP GET and POST, parsing JSON with YAJL, OAuth 2.0 bearer tokens, and SSL/TLS on IBM i.',
            '_aioseo_title'                      => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI, GET/POST, YAJL JSON, OAuth 2.0',
            '_aioseo_description'                => 'Call external REST APIs from IBM i RPG using Scott Klement\'s HTTPAPI in 2026. Covers HTTP GET and POST, JSON parsing with YAJL, OAuth 2.0 token flows, and SSL/TLS certificate management.',
            '_aioseo_keywords'                   => 'IBM i HTTPAPI, Scott Klement HTTPAPI, IBM i REST API RPG, IBM i YAJL JSON, IBM i OAuth 2.0 RPG, IBM i HTTP GET POST, IBM i SSL TLS RPG',
            '_aioseo_og_title'                   => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI, GET/POST, YAJL JSON, OAuth 2.0',
            '_aioseo_og_description'             => 'Complete guide to calling external REST APIs from ILE RPG on IBM i using Scott Klement\'s HTTPAPI library — HTTP GET/POST, YAJL JSON parsing, OAuth 2.0 client credentials, and SSL certificate setup.',
            '_aioseo_twitter_title'              => 'REST APIs from IBM i RPG in 2026: HTTPAPI, YAJL JSON, OAuth 2.0',
            '_aioseo_twitter_description'        => 'How to call external REST APIs from IBM i RPG with HTTPAPI — HTTP GET and POST, parsing JSON with YAJL, OAuth 2.0 bearer tokens, and SSL/TLS on IBM i.',
            'rank_math_focus_keyword'            => 'IBM i HTTPAPI RPG HTTP client REST API YAJL JSON OAuth 2.0',
            'rank_math_description'              => 'Call external REST APIs from IBM i RPG using Scott Klement\'s HTTPAPI in 2026. Covers HTTP GET and POST, JSON parsing with YAJL, OAuth 2.0 token flows, and SSL/TLS certificate management.',
            'rank_math_title'                    => 'Calling REST APIs from IBM i RPG in 2026: HTTPAPI, GET/POST, YAJL JSON, OAuth 2.0 %sep% %sitename%',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post43_use_classic', 10, 2);
function as400_post43_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post43', true) === '1') return false;
    return $use_block_editor;
}
