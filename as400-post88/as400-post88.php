<?php
/**
 * Plugin Name: AS400 Decoded - Post 88 IBM i Message Queues and CL Error Handling
 * Description: Publishes Post 88 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post88_exists');
function as400_ensure_post88_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post88',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-message-queues-sndpgmmsg-rcvmsg-monmsg-crtmsgf-addmsgd-cl-error-handling-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post88', '1', true);
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
        'IBM i message queues',
        'SNDPGMMSG IBM i',
        'RCVMSG IBM i CL',
        'MONMSG IBM i CL',
        'IBM i message file CRTMSGF',
        'IBM i ADDMSGD message description',
        'IBM i escape message CL',
        'IBM i inquiry message',
        'IBM i QSYSOPR message queue',
        'IBM i SNDUSRMSG',
        'IBM i DSPMSGQ CLRMSGQ',
        'IBM i CL error handling',
        'IBM i SNDBRKMSG operator',
        'IBM i message queue 2026',
        'IBM i CRTMSGQ RTVMSG',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post88-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Message Queues and CL Error Handling: SNDPGMMSG, RCVMSG, MONMSG, and Message Files in 2026',
        'post_name'     => 'ibm-i-message-queues-sndpgmmsg-rcvmsg-monmsg-crtmsgf-addmsgd-cl-error-handling-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i message queues and CL error handling in 2026: create message files with CRTMSGF and ADDMSGD, send informational and escape messages with SNDPGMMSG, handle exceptions with MONMSG, receive messages with RCVMSG, send interactive prompts with SNDUSRMSG, monitor QSYSOPR with SNDBRKMSG, build structured CL error routines, and manage message queue housekeeping on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-31 08:00:00',
        'post_date_gmt' => '2026-07-31 02:30:00',
        'meta_input'    => array(
            '_as400_post88'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Message Queues 2026: SNDPGMMSG RCVMSG MONMSG CRTMSGF CL Error Handling',
            '_yoast_wpseo_metadesc'              => 'IBM i message queues and CL error handling in 2026: CRTMSGF and ADDMSGD for message files, SNDPGMMSG for escape and informational messages, MONMSG for exception handling, RCVMSG, SNDUSRMSG, QSYSOPR monitoring, and structured CL error routines on IBM i.',
            '_yoast_wpseo_focuskw'               => 'IBM i message queues SNDPGMMSG RCVMSG MONMSG CRTMSGF CL error handling 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-message-queues-sndpgmmsg-rcvmsg-monmsg-crtmsgf-addmsgd-cl-error-handling-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Message Queues 2026: SNDPGMMSG, RCVMSG, MONMSG, CL Error Handling',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i message queues: CRTMSGF, ADDMSGD, SNDPGMMSG escape messages, MONMSG exception handling, RCVMSG, SNDUSRMSG, QSYSOPR, and CL error routines on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Message Queues 2026: SNDPGMMSG, RCVMSG, MONMSG, CL Error Handling',
            '_yoast_wpseo_twitter-description'   => 'IBM i message queues: SNDPGMMSG, RCVMSG, MONMSG, CRTMSGF, ADDMSGD, and CL error handling in 2026.',
            '_aioseo_title'                      => 'IBM i Message Queues 2026: SNDPGMMSG RCVMSG MONMSG CRTMSGF CL Error Handling',
            '_aioseo_description'                => 'IBM i message queues and CL error handling in 2026: CRTMSGF and ADDMSGD for message files, SNDPGMMSG for escape and informational messages, MONMSG for exception handling, RCVMSG, SNDUSRMSG, QSYSOPR monitoring, and structured CL error routines on IBM i.',
            '_aioseo_keywords'                   => 'IBM i message queues, SNDPGMMSG IBM i, RCVMSG MONMSG CL, IBM i CRTMSGF ADDMSGD, IBM i CL error handling 2026',
            '_aioseo_og_title'                   => 'IBM i Message Queues 2026: SNDPGMMSG, RCVMSG, MONMSG, CL Error Handling',
            '_aioseo_og_description'             => 'Complete guide to IBM i message queues: CRTMSGF, ADDMSGD, SNDPGMMSG escape messages, MONMSG exception handling, RCVMSG, SNDUSRMSG, QSYSOPR, and CL error routines on IBM i.',
            '_aioseo_twitter_title'              => 'IBM i Message Queues 2026: SNDPGMMSG, RCVMSG, MONMSG, CL Error Handling',
            '_aioseo_twitter_description'        => 'IBM i message queues: SNDPGMMSG, RCVMSG, MONMSG, CRTMSGF, ADDMSGD, and CL error handling in 2026.',
            'rank_math_focus_keyword'            => 'IBM i message queues SNDPGMMSG RCVMSG MONMSG CRTMSGF CL error handling 2026',
            'rank_math_description'              => 'IBM i message queues and CL error handling in 2026: CRTMSGF and ADDMSGD for message files, SNDPGMMSG for escape and informational messages, MONMSG for exception handling, RCVMSG, SNDUSRMSG, QSYSOPR monitoring, and structured CL error routines on IBM i.',
            'rank_math_title'                    => 'IBM i Message Queues 2026: SNDPGMMSG RCVMSG MONMSG CRTMSGF CL Error Handling',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post88_use_classic', 10, 2);
function as400_post88_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post88', true) === '1') return false;
    return $use_block_editor;
}
