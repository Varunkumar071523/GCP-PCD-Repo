<?php
/**
 * Plugin Name: AS400 Decoded - Post 49 IBM i ILE Binding Activation Groups and Service Programs
 * Description: Publishes Post 49 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post49_exists');
function as400_ensure_post49_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post49',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ile-binding-activation-groups-service-programs-bnddir-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post49', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i ILE',
        'IBM i activation group',
        'IBM i service program',
        'IBM i binding directory',
        'CRTPGM IBM i',
        'CRTSRVPGM IBM i',
        'IBM i *NEW activation group',
        'IBM i *CALLER activation group',
        'IBM i ILE binding',
        'IBM i BNDDIR',
        'IBM i ILE RPG',
        'IBM i module binding',
        'IBM i CRTBNDRPG',
        'IBM i commitment control ILE',
        'IBM i ILE architecture',
        'IBM i service program export',
        'IBM i 2026 ILE',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post49-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i ILE Binding, Activation Groups, and Service Programs in 2026: BNDDIR, CRTPGM, *NEW vs *CALLER, and Designing for Reuse',
        'post_name'     => 'ibm-i-ile-binding-activation-groups-service-programs-bnddir-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A deep dive into the IBM i ILE binding model: how modules, programs, service programs, and binding directories relate, how CRTPGM and CRTSRVPGM work, the difference between *NEW, *CALLER, and named activation groups, and how to design reusable service programs for production IBM i systems in 2026.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-22 08:00:00',
        'post_date_gmt' => '2026-06-22 02:30:00',
        'meta_input'    => array(
            '_as400_post49'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i ILE Binding, Activation Groups & Service Programs 2026 | AS400 Decoded',
            '_yoast_wpseo_metadesc'              => 'Master IBM i ILE binding: CRTPGM, CRTSRVPGM, BNDDIR, *NEW vs *CALLER vs named activation groups, commitment control scope, and service program design for reuse in 2026.',
            '_yoast_wpseo_focuskw'               => 'IBM i ILE binding activation groups service programs BNDDIR CRTSRVPGM',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ile-binding-activation-groups-service-programs-bnddir-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i ILE Binding, Activation Groups & Service Programs 2026',
            '_yoast_wpseo_opengraph-description' => 'Deep dive into IBM i ILE binding: modules, service programs, BNDDIR, *NEW vs *CALLER activation groups, commitment control scope, and practical CRTSRVPGM design patterns.',
            '_yoast_wpseo_twitter-title'         => 'IBM i ILE Binding, Activation Groups & Service Programs 2026',
            '_yoast_wpseo_twitter-description'   => 'Master CRTPGM, CRTSRVPGM, BNDDIR, and activation groups (*NEW vs *CALLER) on IBM i. Includes commitment control scope, service program export lists, and full working examples.',
            '_aioseo_title'                      => 'IBM i ILE Binding, Activation Groups & Service Programs 2026 | AS400 Decoded',
            '_aioseo_description'                => 'Master IBM i ILE binding: CRTPGM, CRTSRVPGM, BNDDIR, *NEW vs *CALLER vs named activation groups, commitment control scope, and service program design for reuse in 2026.',
            '_aioseo_keywords'                   => 'IBM i ILE binding, activation groups, service programs, BNDDIR, CRTSRVPGM, CRTPGM, *NEW, *CALLER, IBM i 2026',
            '_aioseo_og_title'                   => 'IBM i ILE Binding, Activation Groups & Service Programs 2026',
            '_aioseo_og_description'             => 'Deep dive into IBM i ILE binding: modules, service programs, BNDDIR, *NEW vs *CALLER activation groups, commitment control scope, and practical CRTSRVPGM design patterns.',
            '_aioseo_twitter_title'              => 'IBM i ILE Binding, Activation Groups & Service Programs 2026',
            '_aioseo_twitter_description'        => 'Master CRTPGM, CRTSRVPGM, BNDDIR, and activation groups (*NEW vs *CALLER) on IBM i. Includes commitment control scope, service program export lists, and full working examples.',
            'rank_math_focus_keyword'            => 'IBM i ILE binding activation groups service programs BNDDIR CRTSRVPGM',
            'rank_math_description'              => 'Master IBM i ILE binding: CRTPGM, CRTSRVPGM, BNDDIR, *NEW vs *CALLER vs named activation groups, commitment control scope, and service program design for reuse in 2026.',
            'rank_math_title'                    => 'IBM i ILE Binding, Activation Groups & Service Programs 2026 | AS400 Decoded',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post49_use_classic', 10, 2);
function as400_post49_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post49', true) === '1') return false;
    return $use_block_editor;
}
