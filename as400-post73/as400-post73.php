<?php
/**
 * Plugin Name: AS400 Decoded - Post 73 Strangler Fig Pattern IBM i Modernization
 * Description: Publishes Post 73 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post73_exists');
function as400_ensure_post73_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post73',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-strangler-fig-pattern-rpg-modernization-api-gateway-incremental-migration-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post73', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i strangler fig pattern',
        'IBM i application modernization 2026',
        'IBM i RPG modernization strangler',
        'IBM i monolith decomposition',
        'IBM i API gateway modernization',
        'IBM i incremental migration',
        'IBM i modernization roadmap',
        'IBM i strangler pattern 2026',
        'IBM i RPG facade pattern',
        'IBM i legacy modernization approach',
        'IBM i CQRS modernization',
        'IBM i event-driven modernization',
        'IBM i Node.js strangler facade',
        'IBM i modernization coexistence',
        'IBM i RPG microservices decomposition',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post73-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'Strangler Fig Pattern for IBM i Application Modernization: Decomposing Monolithic RPG, API Gateway Routing, Incremental Migration, and Coexistence Strategies in 2026',
        'post_name'     => 'ibm-i-strangler-fig-pattern-rpg-modernization-api-gateway-incremental-migration-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Apply the strangler fig pattern to IBM i modernization in 2026: identify seams in monolithic RPG applications, build a facade REST API over legacy RPG program calls, route traffic incrementally from old to new implementations, use an API gateway for transparent switchover, and keep DB2 for i as the shared data layer during coexistence.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-16 08:00:00',
        'post_date_gmt' => '2026-07-16 02:30:00',
        'meta_input'    => array(
            '_as400_post73'                      => '1',
            '_yoast_wpseo_title'                 => 'Strangler Fig Pattern for IBM i RPG Modernization 2026: API Gateway Incremental Migration',
            '_yoast_wpseo_metadesc'              => 'Apply the strangler fig pattern to IBM i in 2026: decompose monolithic RPG, build a REST facade, route traffic via API gateway, migrate incrementally, and maintain DB2 coexistence.',
            '_yoast_wpseo_focuskw'               => 'IBM i strangler fig pattern RPG modernization API gateway incremental migration 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-strangler-fig-pattern-rpg-modernization-api-gateway-incremental-migration-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Strangler Fig Pattern for IBM i RPG Modernization 2026: API Gateway, Incremental Migration',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to the strangler fig modernization pattern for IBM i: identifying RPG seams, building a REST facade, API gateway routing, incremental traffic migration, DB2 shared data layer, and full cutover strategies in 2026.',
            '_yoast_wpseo_twitter-title'         => 'Strangler Fig Pattern for IBM i Modernization 2026: API Gateway, RPG Migration',
            '_yoast_wpseo_twitter-description'   => 'Modernize IBM i applications with the strangler fig pattern: RPG seams, REST facade, API gateway routing, incremental migration, and DB2 coexistence in 2026.',
            '_aioseo_title'                      => 'Strangler Fig Pattern for IBM i RPG Modernization 2026: API Gateway Incremental Migration',
            '_aioseo_description'                => 'Apply the strangler fig pattern to IBM i in 2026: decompose monolithic RPG, build a REST facade, route traffic via API gateway, migrate incrementally, and maintain DB2 coexistence.',
            '_aioseo_keywords'                   => 'IBM i strangler fig pattern, IBM i RPG modernization, IBM i API gateway, IBM i incremental migration, IBM i modernization 2026',
            '_aioseo_og_title'                   => 'Strangler Fig Pattern for IBM i RPG Modernization 2026: API Gateway, Incremental Migration',
            '_aioseo_og_description'             => 'Complete guide to the strangler fig modernization pattern for IBM i: identifying RPG seams, building a REST facade, API gateway routing, incremental traffic migration, DB2 shared data layer, and full cutover strategies in 2026.',
            '_aioseo_twitter_title'              => 'Strangler Fig Pattern for IBM i Modernization 2026: API Gateway, RPG Migration',
            '_aioseo_twitter_description'        => 'Modernize IBM i applications with the strangler fig pattern: RPG seams, REST facade, API gateway routing, incremental migration, and DB2 coexistence in 2026.',
            'rank_math_focus_keyword'            => 'IBM i strangler fig pattern RPG modernization API gateway incremental migration 2026',
            'rank_math_description'              => 'Apply the strangler fig pattern to IBM i in 2026: decompose monolithic RPG, build a REST facade, route traffic via API gateway, migrate incrementally, and maintain DB2 coexistence.',
            'rank_math_title'                    => 'Strangler Fig Pattern for IBM i RPG Modernization 2026: API Gateway Incremental Migration',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post73_use_classic', 10, 2);
function as400_post73_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post73', true) === '1') return false;
    return $use_block_editor;
}
