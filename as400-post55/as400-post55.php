<?php
/**
 * Plugin Name: AS400 Decoded - Post 55 RPG Data Structures in Depth
 * Description: Publishes Post 55 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post55_exists');
function as400_ensure_post55_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post55',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-rpg-data-structures-likeds-qualified-template-ds-arrays-extname-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post55', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('rpg-programming');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'RPG data structures',
        'IBM i LIKEDS',
        'IBM i qualified data structure',
        'IBM i dcl-ds',
        'IBM i template data structure',
        'IBM i data structure array',
        'IBM i EXTNAME data structure',
        'IBM i LIKEREC',
        'IBM i RPG nested DS',
        'IBM i RPG free-format DS',
        'IBM i RPG subprocedure DS parameter',
        'IBM i RPG DS dot notation',
        'IBM i ILE RPG data structures',
        'IBM i RPG modernization DS',
        'IBM i RPG 2026',
        'IBM i free-format RPG',
        'IBM i RPG data structure best practices',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post55-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'RPG Data Structures in Depth: LIKEDS, Qualified DS, Template Data Structures, DS Arrays, EXTNAME, and LIKEREC in ILE RPG on IBM i',
        'post_name'     => 'ibm-i-rpg-data-structures-likeds-qualified-template-ds-arrays-extname-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master ILE RPG data structures: dcl-ds syntax, qualified data structures with dot notation, LIKEDS for cloning a structure, template data structures, data structure arrays with DIM, external DB2 data structures using EXTNAME and LIKEREC, and passing data structures to subprocedures by reference and value.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-28 08:00:00',
        'post_date_gmt' => '2026-06-28 02:30:00',
        'meta_input'    => array(
            '_as400_post55'                      => '1',
            '_yoast_wpseo_title'                 => 'RPG Data Structures in Depth 2026: LIKEDS, Qualified DS, Template, Arrays, EXTNAME, LIKEREC',
            '_yoast_wpseo_metadesc'              => 'Deep dive into ILE RPG data structures: dcl-ds, qualified DS, LIKEDS, template DS, DS arrays, EXTNAME from DB2, LIKEREC, nested DS, and subprocedure parameter patterns.',
            '_yoast_wpseo_focuskw'               => 'IBM i RPG data structures LIKEDS qualified template arrays EXTNAME LIKEREC 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-rpg-data-structures-likeds-qualified-template-ds-arrays-extname-2026/',
            '_yoast_wpseo_opengraph-title'       => 'RPG Data Structures in Depth 2026: LIKEDS, Qualified DS, Template, Arrays, EXTNAME',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to ILE RPG data structures: dcl-ds, qualified DS with dot notation, LIKEDS, template DS, DIM arrays, EXTNAME, LIKEREC, nested DS, and passing DS to procedures.',
            '_yoast_wpseo_twitter-title'         => 'RPG Data Structures 2026: LIKEDS, Qualified DS, Template, Arrays',
            '_yoast_wpseo_twitter-description'   => 'Master ILE RPG data structures: LIKEDS, qualified DS, template DS, DS arrays, EXTNAME from DB2 files, and procedure parameter patterns.',
            '_aioseo_title'                      => 'RPG Data Structures in Depth 2026: LIKEDS, Qualified DS, Template, Arrays, EXTNAME, LIKEREC',
            '_aioseo_description'                => 'Deep dive into ILE RPG data structures: dcl-ds, qualified DS, LIKEDS, template DS, DS arrays, EXTNAME from DB2, LIKEREC, nested DS, and subprocedure parameter patterns.',
            '_aioseo_keywords'                   => 'IBM i RPG data structures, IBM i LIKEDS, IBM i qualified data structure, IBM i EXTNAME DS, IBM i LIKEREC, IBM i template DS, IBM i DS array 2026',
            '_aioseo_og_title'                   => 'RPG Data Structures in Depth 2026: LIKEDS, Qualified DS, Template, Arrays, EXTNAME',
            '_aioseo_og_description'             => 'Complete guide to ILE RPG data structures: dcl-ds, qualified DS with dot notation, LIKEDS, template DS, DIM arrays, EXTNAME, LIKEREC, nested DS, and passing DS to procedures.',
            '_aioseo_twitter_title'              => 'RPG Data Structures 2026: LIKEDS, Qualified DS, Template, Arrays',
            '_aioseo_twitter_description'        => 'Master ILE RPG data structures: LIKEDS, qualified DS, template DS, DS arrays, EXTNAME from DB2 files, and procedure parameter patterns.',
            'rank_math_focus_keyword'            => 'IBM i RPG data structures LIKEDS qualified template arrays EXTNAME LIKEREC 2026',
            'rank_math_description'              => 'Deep dive into ILE RPG data structures: dcl-ds, qualified DS, LIKEDS, template DS, DS arrays, EXTNAME from DB2, LIKEREC, nested DS, and subprocedure parameter patterns.',
            'rank_math_title'                    => 'RPG Data Structures in Depth 2026: LIKEDS, Qualified DS, Template, Arrays, EXTNAME, LIKEREC',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post55_use_classic', 10, 2);
function as400_post55_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post55', true) === '1') return false;
    return $use_block_editor;
}
