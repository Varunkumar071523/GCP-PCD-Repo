<?php
/**
 * Plugin Name: AS400 Decoded - Post 40 IBM i Application Modernisation Roadmap
 * Description: Publishes Post 40 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post40_exists');
function as400_ensure_post40_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post40',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-application-modernisation-roadmap-strategies-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post40', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i modernisation',
        'IBM i application modernisation',
        'IBM i API wrapping',
        'IBM i screen scraping',
        'IBM i strangler fig',
        'IBM i modernisation roadmap',
        'IBM i RPG modernisation',
        'IBM i web services',
        'IBM i REST API modernisation',
        'IBM i UI modernisation',
        'IBM i microservices',
        'IBM i open source modernisation',
        'IBM i phased modernisation',
        'IBM i 2026 modernisation',
        'IBM i Node.js modernisation',
        'IBM i cloud modernisation',
        'IBM i legacy modernisation',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post40-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Application Modernisation Roadmap in 2026: Strategies from API Wrapping to Full Rewrite and How to Choose',
        'post_name'     => 'ibm-i-application-modernisation-roadmap-strategies-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A practical IBM i application modernisation roadmap for 2026: compare six strategies from screen transformation and API wrapping to selective rewrite and full migration, apply the strangler fig pattern, assess your RPG estate, and build the business case for phased modernisation.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-13 08:00:00',
        'post_date_gmt' => '2026-06-13 02:30:00',
        'meta_input'    => array(
            '_as400_post40'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Application Modernisation Roadmap 2026: API Wrapping to Full Rewrite %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Plan your IBM i modernisation in 2026. Compare six strategies — screen transformation, API wrapping, UI replacement, strangler fig, selective rewrite, and full migration — with working code examples and an assessment framework.',
            '_yoast_wpseo_focuskw'               => 'IBM i application modernisation roadmap strategies 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-application-modernisation-roadmap-strategies-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Application Modernisation Roadmap 2026: Six Strategies Compared',
            '_yoast_wpseo_opengraph-description' => 'Screen transformation, API wrapping, strangler fig, selective rewrite — a practical guide to choosing the right modernisation strategy for every part of your IBM i estate.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Modernisation Roadmap 2026: From API Wrapping to Full Rewrite',
            '_yoast_wpseo_twitter-description'   => 'Six modernisation strategies for IBM i in 2026, with a strangler fig walkthrough, RPG API wrapping example, and an assessment framework for your RPG estate.',
            '_aioseo_title'                      => 'IBM i Application Modernisation Roadmap 2026: API Wrapping to Full Rewrite',
            '_aioseo_description'                => 'Plan your IBM i modernisation in 2026. Compare six strategies — screen transformation, API wrapping, UI replacement, strangler fig, selective rewrite, and full migration — with working code examples and an assessment framework.',
            '_aioseo_keywords'                   => 'IBM i application modernisation roadmap strategies 2026, IBM i modernisation, IBM i API wrapping, IBM i strangler fig, RPG modernisation',
            '_aioseo_og_title'                   => 'IBM i Application Modernisation Roadmap 2026: Six Strategies Compared',
            '_aioseo_og_description'             => 'Screen transformation, API wrapping, strangler fig, selective rewrite — a practical guide to choosing the right modernisation strategy for every part of your IBM i estate.',
            '_aioseo_twitter_title'              => 'IBM i Modernisation Roadmap 2026: From API Wrapping to Full Rewrite',
            '_aioseo_twitter_description'        => 'Six modernisation strategies for IBM i in 2026, with a strangler fig walkthrough, RPG API wrapping example, and an assessment framework for your RPG estate.',
            'rank_math_focus_keyword'            => 'IBM i application modernisation roadmap strategies 2026',
            'rank_math_description'              => 'Plan your IBM i modernisation in 2026. Compare six strategies — screen transformation, API wrapping, UI replacement, strangler fig, selective rewrite, and full migration — with working code examples and an assessment framework.',
            'rank_math_title'                    => 'IBM i Application Modernisation Roadmap 2026: API Wrapping to Full Rewrite %sep% %sitename%',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post40_use_classic', 10, 2);
function as400_post40_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post40', true) === '1') return false;
    return $use_block_editor;
}
