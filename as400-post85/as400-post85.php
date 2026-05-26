<?php
/**
 * Plugin Name: AS400 Decoded - Post 85 ILE RPG Service Programs and Binding Directories
 * Description: Publishes Post 85 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post85_exists');
function as400_ensure_post85_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post85',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ile-rpg-service-programs-binding-directory-crtsrvpgm-export-import-activation-group-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post85', '1', true);
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
        'ILE RPG service programs',
        'CRTSRVPGM IBM i',
        'IBM i binding directory CRTBNDDIR',
        'RPG export import procedures',
        'ILE RPG NOMAIN module',
        'IBM i CRTRPGMOD',
        'ILE activation group IBM i',
        'RPG BNDDIR keyword',
        'IBM i service program versioning',
        'ILE RPG shared procedures',
        'IBM i ADDBNDDIRE',
        'IBM i service program module',
        'RPG procedure pointer IBM i',
        'ILE RPG service program 2026',
        'IBM i modular RPG programming',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post85-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'ILE RPG Service Programs and Binding Directories: CRTSRVPGM, Export and Import, Activation Groups in 2026',
        'post_name'     => 'ile-rpg-service-programs-binding-directory-crtsrvpgm-export-import-activation-group-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master ILE RPG service programs in 2026: compile RPG modules with CRTRPGMOD, create service programs with CRTSRVPGM, export and import procedures with NOMAIN source, build and use binding directories with CRTBNDDIR and ADDBNDDIRE, manage activation groups, use the BNDDIR keyword in RPG source, and build reusable shared procedure libraries on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-28 08:00:00',
        'post_date_gmt' => '2026-07-28 02:30:00',
        'meta_input'    => array(
            '_as400_post85'                      => '1',
            '_yoast_wpseo_title'                 => 'ILE RPG Service Programs 2026: CRTSRVPGM Binding Directory Export Import Activation Group',
            '_yoast_wpseo_metadesc'              => 'ILE RPG service programs in 2026: CRTRPGMOD to compile modules, CRTSRVPGM to create service programs, export and import procedures, CRTBNDDIR and ADDBNDDIRE for binding directories, activation groups, and building reusable shared procedure libraries on IBM i.',
            '_yoast_wpseo_focuskw'               => 'ILE RPG service programs CRTSRVPGM binding directory export import activation group 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ile-rpg-service-programs-binding-directory-crtsrvpgm-export-import-activation-group-2026/',
            '_yoast_wpseo_opengraph-title'       => 'ILE RPG Service Programs 2026: CRTSRVPGM, Binding Directories, Activation Groups',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to ILE RPG service programs: CRTRPGMOD, CRTSRVPGM, export and import procedures, CRTBNDDIR and ADDBNDDIRE, activation groups, and reusable shared procedure libraries on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'ILE RPG Service Programs 2026: CRTSRVPGM, Binding Directories, Activation Groups',
            '_yoast_wpseo_twitter-description'   => 'ILE RPG service programs: CRTSRVPGM, export and import, binding directories, activation groups, and modular RPG programming in 2026.',
            '_aioseo_title'                      => 'ILE RPG Service Programs 2026: CRTSRVPGM Binding Directory Export Import Activation Group',
            '_aioseo_description'                => 'ILE RPG service programs in 2026: CRTRPGMOD to compile modules, CRTSRVPGM to create service programs, export and import procedures, CRTBNDDIR and ADDBNDDIRE for binding directories, activation groups, and building reusable shared procedure libraries on IBM i.',
            '_aioseo_keywords'                   => 'ILE RPG service programs, CRTSRVPGM IBM i, binding directory CRTBNDDIR, RPG export import, ILE activation group 2026',
            '_aioseo_og_title'                   => 'ILE RPG Service Programs 2026: CRTSRVPGM, Binding Directories, Activation Groups',
            '_aioseo_og_description'             => 'Complete guide to ILE RPG service programs: CRTRPGMOD, CRTSRVPGM, export and import procedures, CRTBNDDIR and ADDBNDDIRE, activation groups, and reusable shared procedure libraries on IBM i.',
            '_aioseo_twitter_title'              => 'ILE RPG Service Programs 2026: CRTSRVPGM, Binding Directories, Activation Groups',
            '_aioseo_twitter_description'        => 'ILE RPG service programs: CRTSRVPGM, export and import, binding directories, activation groups, and modular RPG programming in 2026.',
            'rank_math_focus_keyword'            => 'ILE RPG service programs CRTSRVPGM binding directory export import activation group 2026',
            'rank_math_description'              => 'ILE RPG service programs in 2026: CRTRPGMOD to compile modules, CRTSRVPGM to create service programs, export and import procedures, CRTBNDDIR and ADDBNDDIRE for binding directories, activation groups, and building reusable shared procedure libraries on IBM i.',
            'rank_math_title'                    => 'ILE RPG Service Programs 2026: CRTSRVPGM Binding Directory Export Import Activation Group',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post85_use_classic', 10, 2);
function as400_post85_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post85', true) === '1') return false;
    return $use_block_editor;
}
