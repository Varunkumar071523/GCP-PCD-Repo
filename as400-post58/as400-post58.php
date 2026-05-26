<?php
/**
 * Plugin Name: AS400 Decoded - Post 58 OAuth 2.0 and JWT from IBM i
 * Description: Publishes Post 58 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post58_exists');
function as400_ensure_post58_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post58',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-oauth2-jwt-bearer-token-rest-api-rpg-https-authentication-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post58', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i OAuth2',
        'IBM i OAuth 2.0',
        'IBM i JWT',
        'IBM i Bearer token',
        'IBM i REST API authentication',
        'IBM i HTTPAPI OAuth',
        'IBM i RPG OAuth2',
        'IBM i HTTPS token',
        'IBM i client credentials flow',
        'IBM i API authentication',
        'IBM i certificate management',
        'IBM i SYSTOOLS HTTPGETCLOB',
        'IBM i DB2 HTTP functions',
        'IBM i outbound HTTPS',
        'IBM i Salesforce integration',
        'IBM i OAuth token refresh',
        'IBM i REST API 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post58-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'OAuth 2.0 and JWT Authentication from IBM i: Client Credentials Flow, Bearer Token Management, and Calling OAuth-Protected REST APIs from ILE RPG in 2026',
        'post_name'     => 'ibm-i-oauth2-jwt-bearer-token-rest-api-rpg-https-authentication-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Implement OAuth 2.0 authentication from IBM i in 2026: the client credentials flow using HTTPAPI and DB2 HTTP functions, storing and refreshing Bearer tokens, JWT structure and validation, certificate management in the IBM i digital certificate store, and a complete example calling the Salesforce REST API from ILE RPG.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-01 08:00:00',
        'post_date_gmt' => '2026-07-01 02:30:00',
        'meta_input'    => array(
            '_as400_post58'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i OAuth 2.0 and JWT 2026: Client Credentials, Bearer Token, RPG REST API Authentication',
            '_yoast_wpseo_metadesc'              => 'Implement OAuth 2.0 from IBM i: client credentials flow, Bearer token management, JWT handling, certificate store, DB2 HTTP functions, and calling OAuth-protected APIs from ILE RPG.',
            '_yoast_wpseo_focuskw'               => 'IBM i OAuth2 JWT Bearer token REST API RPG HTTPS authentication 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-oauth2-jwt-bearer-token-rest-api-rpg-https-authentication-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i OAuth 2.0 and JWT 2026: Client Credentials, Bearer Token, RPG API Auth',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to OAuth 2.0 from IBM i: client credentials flow, Bearer token lifecycle, JWT, certificate management, and practical RPG examples for calling secured APIs.',
            '_yoast_wpseo_twitter-title'         => 'IBM i OAuth 2.0 + JWT 2026: Client Credentials, Bearer Token, RPG',
            '_yoast_wpseo_twitter-description'   => 'OAuth 2.0 from IBM i in 2026: client credentials flow, Bearer token management, JWT, certificates, and calling OAuth-protected REST APIs from ILE RPG.',
            '_aioseo_title'                      => 'IBM i OAuth 2.0 and JWT 2026: Client Credentials, Bearer Token, RPG REST API Authentication',
            '_aioseo_description'                => 'Implement OAuth 2.0 from IBM i: client credentials flow, Bearer token management, JWT handling, certificate store, DB2 HTTP functions, and calling OAuth-protected APIs from ILE RPG.',
            '_aioseo_keywords'                   => 'IBM i OAuth2, IBM i JWT, IBM i Bearer token, IBM i REST API authentication, IBM i client credentials, IBM i HTTPAPI OAuth, IBM i SYSTOOLS HTTP 2026',
            '_aioseo_og_title'                   => 'IBM i OAuth 2.0 and JWT 2026: Client Credentials, Bearer Token, RPG API Auth',
            '_aioseo_og_description'             => 'Complete guide to OAuth 2.0 from IBM i: client credentials flow, Bearer token lifecycle, JWT, certificate management, and practical RPG examples for calling secured APIs.',
            '_aioseo_twitter_title'              => 'IBM i OAuth 2.0 + JWT 2026: Client Credentials, Bearer Token, RPG',
            '_aioseo_twitter_description'        => 'OAuth 2.0 from IBM i in 2026: client credentials flow, Bearer token management, JWT, certificates, and calling OAuth-protected REST APIs from ILE RPG.',
            'rank_math_focus_keyword'            => 'IBM i OAuth2 JWT Bearer token REST API RPG HTTPS authentication 2026',
            'rank_math_description'              => 'Implement OAuth 2.0 from IBM i: client credentials flow, Bearer token management, JWT handling, certificate store, DB2 HTTP functions, and calling OAuth-protected APIs from ILE RPG.',
            'rank_math_title'                    => 'IBM i OAuth 2.0 and JWT 2026: Client Credentials, Bearer Token, RPG REST API Authentication',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post58_use_classic', 10, 2);
function as400_post58_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post58', true) === '1') return false;
    return $use_block_editor;
}
