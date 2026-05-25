<?php
/**
 * Plugin Name: AS400 Decoded - Post 48 IBM i Message Files and Exception Handling in CL
 * Description: Publishes Post 48 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post48_exists');
function as400_ensure_post48_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post48',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-message-files-exception-handling-cl-sndpgmmsg-monmsg-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post48', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i message files',
        'IBM i SNDPGMMSG',
        'IBM i MONMSG',
        'IBM i RCVMSG',
        'IBM i exception handling',
        'IBM i CL error handling',
        'IBM i message queue',
        'IBM i escape message',
        'IBM i *ESCAPE message',
        'IBM i *STATUS message',
        'IBM i CRTMSGF',
        'IBM i ADDMSGD',
        'IBM i message handling',
        'IBM i CL programming',
        'IBM i error logging CL',
        'IBM i CL best practices',
        'IBM i 2026 CL',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post48-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Message Files and Exception Handling in CL in 2026: SNDPGMMSG, MONMSG, RCVMSG, Message Types, and Robust Error Handling',
        'post_name'     => 'ibm-i-message-files-exception-handling-cl-sndpgmmsg-monmsg-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i CL exception handling in 2026: message file architecture, CRTMSGF and ADDMSGD to define messages, SNDPGMMSG for escape and informational messages, MONMSG for structured exception catching, RCVMSG to retrieve message data, and a complete CL error handling programme template with DB2 audit logging.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-21 08:00:00',
        'post_date_gmt' => '2026-06-21 02:30:00',
        'meta_input'    => array(
            '_as400_post48'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Message Files & Exception Handling in CL 2026: SNDPGMMSG, MONMSG, RCVMSG %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Complete guide to IBM i CL message handling in 2026: CRTMSGF, ADDMSGD, SNDPGMMSG message types, MONMSG for structured exception handling, RCVMSG to retrieve error data, and a full CL error handling template with DB2 audit logging.',
            '_yoast_wpseo_focuskw'               => 'IBM i message files exception handling CL SNDPGMMSG MONMSG RCVMSG',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-message-files-exception-handling-cl-sndpgmmsg-monmsg-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Message Files and Exception Handling in CL 2026: SNDPGMMSG, MONMSG, RCVMSG & Error Handling Patterns',
            '_yoast_wpseo_opengraph-description' => 'Master IBM i CL exception handling: message file architecture, SNDPGMMSG *ESCAPE and *INFO, MONMSG catch-all and specific CPF handlers, RCVMSG for error data retrieval, and a complete CL programme error handling template.',
            '_yoast_wpseo_twitter-title'         => 'IBM i CL Exception Handling 2026: SNDPGMMSG, MONMSG, RCVMSG & Message Files',
            '_yoast_wpseo_twitter-description'   => 'Comprehensive IBM i CL error handling: message types, CRTMSGF, SNDPGMMSG, MONMSG, RCVMSG, complete CL error programme template, and RPG MONITOR/ON-ERROR integration.',
            '_aioseo_title'                      => 'IBM i Message Files & Exception Handling in CL 2026: SNDPGMMSG, MONMSG, RCVMSG',
            '_aioseo_description'                => 'Complete guide to IBM i CL message handling in 2026: CRTMSGF, ADDMSGD, SNDPGMMSG message types, MONMSG for structured exception handling, RCVMSG to retrieve error data, and a full CL error handling template with DB2 audit logging.',
            '_aioseo_keywords'                   => 'IBM i message files, IBM i SNDPGMMSG, IBM i MONMSG, IBM i RCVMSG, IBM i exception handling CL, IBM i CRTMSGF, IBM i CL error handling 2026',
            '_aioseo_og_title'                   => 'IBM i Message Files and Exception Handling in CL 2026: SNDPGMMSG, MONMSG, RCVMSG & Error Handling Patterns',
            '_aioseo_og_description'             => 'Master IBM i CL exception handling: message file architecture, SNDPGMMSG *ESCAPE and *INFO, MONMSG catch-all and specific CPF handlers, RCVMSG for error data retrieval, and a complete CL programme error handling template.',
            '_aioseo_twitter_title'              => 'IBM i CL Exception Handling 2026: SNDPGMMSG, MONMSG, RCVMSG & Message Files',
            '_aioseo_twitter_description'        => 'Comprehensive IBM i CL error handling: message types, CRTMSGF, SNDPGMMSG, MONMSG, RCVMSG, complete CL error programme template, and RPG MONITOR/ON-ERROR integration.',
            'rank_math_focus_keyword'            => 'IBM i message files exception handling CL SNDPGMMSG MONMSG RCVMSG',
            'rank_math_description'              => 'Complete guide to IBM i CL message handling in 2026: CRTMSGF, ADDMSGD, SNDPGMMSG message types, MONMSG for structured exception handling, RCVMSG to retrieve error data, and a full CL error handling template with DB2 audit logging.',
            'rank_math_title'                    => 'IBM i Message Files & Exception Handling in CL 2026: SNDPGMMSG, MONMSG, RCVMSG',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post48_use_classic', 10, 2);
function as400_post48_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post48', true) === '1') return false;
    return $use_block_editor;
}
