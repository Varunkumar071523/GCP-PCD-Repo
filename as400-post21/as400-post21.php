<?php
/**
 * Plugin Name: AS400 Decoded - Post 21 RPG Modern Free-Format
 * Description: Publishes Post 21 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post21_exists');
function as400_ensure_post21_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post21',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-rpg-free-format-rpg-iv-modern-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post21', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'RPG programming',
        'free-format RPG',
        'RPG IV',
        'ILE RPG',
        'SQLRPGLE',
        'embedded SQL RPG',
        'data structures RPG',
        'service programs IBM i',
        'prototyped procedures RPG',
        'modern RPG',
        'RPG subprocedures',
        'IBM i SQL RPG',
        'CRTBNDRPG',
        'IBM i modernisation',
        'IBM i 2026',
        'RPG vs COBOL',
        'IBM i free-format source'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    // ── Content ───────────────────────────────────
    $content = file_get_contents(dirname(__FILE__) . '/post21-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'RPG in 2026: Modern Free-Format RPG IV, Prototyped Procedures, SQL Integration, and What Current RPG Actually Looks Like',
        'post_name'    => 'ibm-i-rpg-free-format-rpg-iv-modern-2026',
        'post_content' => $content,
        'post_excerpt' => 'Modern RPG is not the fixed-format column-dependent code that gave the language its reputation. This post covers fully free-format RPG IV: program structure, data types, qualified data structures, prototyped procedures, embedded SQL with cursors and null handling, service programs, the monitor group for error handling, and what a current SQLRPGLE program actually looks like.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-25 08:00:00',
        'post_date_gmt' => '2026-05-25 02:30:00',
        'meta_input'   => array(
            '_as400_post21' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'RPG in 2026: Modern Free-Format RPG IV, Prototyped Procedures and SQL Integration',
            '_yoast_wpseo_metadesc'      => 'A practical guide to modern IBM i RPG: fully free-format RPG IV structure, data structures, prototyped procedures, SQLRPGLE embedded SQL, service programs, error handling with monitor groups, and what current RPG actually looks like.',
            '_yoast_wpseo_focuskw'       => 'free-format RPG IV ILE RPG SQLRPGLE modern IBM i',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-rpg-free-format-rpg-iv-modern-2026/',
            '_yoast_wpseo_opengraph-title'       => 'RPG in 2026: What Modern Free-Format RPG Actually Looks Like',
            '_yoast_wpseo_opengraph-description' => 'Free-format RPG IV, SQLRPGLE, prototyped procedures, data structures, service programs, and monitor groups — modern RPG without the fixed-format stigma.',
            '_yoast_wpseo_twitter-title'         => 'Modern RPG in 2026 — free-format ILE RPG with SQL, procedures, and service programs',
            '_yoast_wpseo_twitter-description'   => 'Free-format RPG IV is readable, structured, and SQL-integrated. Here is what a real SQLRPGLE program looks like in 2026.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'RPG in 2026: Modern Free-Format RPG IV, Prototyped Procedures and SQL Integration',
            '_aioseo_description'        => 'A practical guide to modern IBM i RPG: fully free-format RPG IV structure, data structures, prototyped procedures, SQLRPGLE embedded SQL, service programs, error handling with monitor groups, and what current RPG actually looks like.',
            '_aioseo_keywords'           => 'free-format RPG,RPG IV IBM i,ILE RPG,SQLRPGLE,embedded SQL RPG,data structures RPG,prototyped procedures,service programs IBM i,monitor group RPG,modern RPG 2026',
            '_aioseo_og_title'           => 'RPG in 2026: What Modern Free-Format RPG Actually Looks Like',
            '_aioseo_og_description'     => 'Free-format RPG IV, SQLRPGLE, prototyped procedures, data structures, service programs, and monitor groups — modern RPG without the fixed-format stigma.',
            '_aioseo_twitter_title'      => 'Modern RPG in 2026 — free-format ILE RPG with SQL, procedures, and service programs',
            '_aioseo_twitter_description'=> 'Free-format RPG IV is readable, structured, and SQL-integrated. Here is what a real SQLRPGLE program looks like in 2026.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'free-format RPG IV ILE RPG SQLRPGLE modern IBM i',
            'rank_math_description'      => 'A practical guide to modern IBM i RPG: fully free-format RPG IV structure, data structures, prototyped procedures, SQLRPGLE embedded SQL, service programs, error handling with monitor groups, and what current RPG actually looks like.',
            'rank_math_title'            => 'RPG in 2026: Modern Free-Format RPG IV, Prototyped Procedures and SQL Integration',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post21_use_classic', 10, 2);
function as400_post21_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post21', true) === '1') return false;
    return $use_block_editor;
}
