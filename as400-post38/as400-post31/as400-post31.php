<?php
/**
 * Plugin Name: AS400 Decoded - Post 31 Advanced ILE RPG APIs
 * Description: Publishes Post 31 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post31_exists');
function as400_ensure_post31_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post31',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-advanced-ile-rpg-system-apis-pointers-dynamic-calls-user-spaces-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post31', '1', true);
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
        'advanced ILE RPG',
        'IBM i system APIs',
        'QCMDEXC RPG',
        'QUSLOBJ IBM i',
        'QUSRTVUS IBM i',
        'user spaces IBM i',
        'dynamic program calls RPG',
        'system pointers IBM i',
        'QUSROBJD IBM i',
        'IBM i OS APIs RPG',
        'QUSLJOB IBM i',
        'IBM i object listing RPG',
        'ILE RPG pointers',
        'IBM i procedure pointers',
        'IBM i 2026',
        'QUSCHGUS IBM i',
        'IBM i capability-based system'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post31-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'Advanced ILE RPG in 2026: System Pointers, IBM i OS APIs, Dynamic Program Calls, and User Spaces',
        'post_name'    => 'ibm-i-advanced-ile-rpg-system-apis-pointers-dynamic-calls-user-spaces-2026',
        'post_content' => $content,
        'post_excerpt' => 'The IBM i OS API layer accessible from ILE RPG: QCMDEXC for running CL commands at runtime, the list API pattern using user spaces (QUSCRTUS, QUSLOBJ, QUSRTVUS), listing objects in a library at runtime, dynamic program calls using variable names and procedure pointers, system pointers and the capability-based OS model, and QUSROBJD for checking object existence without triggering an error message.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-04 08:00:00',
        'post_date_gmt' => '2026-06-04 02:30:00',
        'meta_input'   => array(
            '_as400_post31' => '1',
            '_yoast_wpseo_title'         => 'Advanced ILE RPG in 2026: System APIs, Pointers, Dynamic Calls and User Spaces',
            '_yoast_wpseo_metadesc'      => 'IBM i OS APIs from ILE RPG: QCMDEXC for runtime CL commands, the user space list API pattern with QUSCRTUS and QUSLOBJ, dynamic program calls, system and procedure pointers, QUSROBJD for object existence checking, and the IBM i OS API calling convention.',
            '_yoast_wpseo_focuskw'       => 'advanced ILE RPG IBM i system APIs user spaces dynamic calls QCMDEXC',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-advanced-ile-rpg-system-apis-pointers-dynamic-calls-user-spaces-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Advanced ILE RPG in 2026: IBM i OS APIs and System-Level Programming',
            '_yoast_wpseo_opengraph-description' => 'QCMDEXC, QUSLOBJ, QUSRTVUS, QUSROBJD, dynamic calls, and user spaces — the IBM i OS API patterns that unlock system-level capabilities from RPG programs.',
            '_yoast_wpseo_twitter-title'         => 'Advanced ILE RPG in 2026 — calling IBM i system APIs, user spaces, and dynamic program calls',
            '_yoast_wpseo_twitter-description'   => 'QCMDEXC runs any CL command from RPG. QUSLOBJ lists objects into a user space. QUSROBJD checks if an object exists. Here is how they all work.',
            '_aioseo_title'              => 'Advanced ILE RPG in 2026: System APIs, Pointers, Dynamic Calls and User Spaces',
            '_aioseo_description'        => 'IBM i OS APIs from ILE RPG: QCMDEXC for runtime CL commands, the user space list API pattern with QUSCRTUS and QUSLOBJ, dynamic program calls, system and procedure pointers, QUSROBJD for object existence checking, and the IBM i OS API calling convention.',
            '_aioseo_keywords'           => 'advanced ILE RPG,IBM i system APIs,QCMDEXC RPG,QUSLOBJ IBM i,user spaces IBM i,dynamic program calls RPG,system pointers IBM i,QUSROBJD IBM i,QUSRTVUS IBM i,IBM i OS APIs',
            '_aioseo_og_title'           => 'Advanced ILE RPG in 2026: IBM i OS APIs and System-Level Programming',
            '_aioseo_og_description'     => 'QCMDEXC, QUSLOBJ, QUSRTVUS, QUSROBJD, dynamic calls, and user spaces — the IBM i OS API patterns that unlock system-level capabilities from RPG programs.',
            '_aioseo_twitter_title'      => 'Advanced ILE RPG in 2026 — calling IBM i system APIs, user spaces, and dynamic program calls',
            '_aioseo_twitter_description'=> 'QCMDEXC runs any CL command from RPG. QUSLOBJ lists objects into a user space. QUSROBJD checks if an object exists. Here is how they all work.',
            'rank_math_focus_keyword'    => 'advanced ILE RPG IBM i system APIs user spaces dynamic calls QCMDEXC',
            'rank_math_description'      => 'IBM i OS APIs from ILE RPG: QCMDEXC for runtime CL commands, the user space list API pattern with QUSCRTUS and QUSLOBJ, dynamic program calls, system and procedure pointers, QUSROBJD for object existence checking, and the IBM i OS API calling convention.',
            'rank_math_title'            => 'Advanced ILE RPG in 2026: System APIs, Pointers, Dynamic Calls and User Spaces',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post31_use_classic', 10, 2);
function as400_post31_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post31', true) === '1') return false;
    return $use_block_editor;
}
