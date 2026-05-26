<?php
/**
 * Plugin Name: AS400 Decoded - Post 56 CL Error Handling and Exception Management
 * Description: Publishes Post 56 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post56_exists');
function as400_ensure_post56_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post56',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-cl-error-handling-monmsg-escape-messages-condition-handler-dmpjob-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post56', '1', true);
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
        'IBM i CL error handling',
        'IBM i MONMSG',
        'IBM i escape message',
        'IBM i CL exception handling',
        'IBM i SNDPGMMSG',
        'IBM i program message queue',
        'IBM i CL condition handler',
        'IBM i DMPJOB',
        'IBM i CL RCVMSG',
        'IBM i CL RMVMSG',
        'IBM i CPF error handling',
        'IBM i CL robust programming',
        'IBM i CL procedure error',
        'IBM i CL notify message',
        'IBM i CL status message',
        'IBM i message file CPF',
        'IBM i CL 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post56-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'CL Error Handling and Exception Management on IBM i: MONMSG, Escape Messages, Condition Handlers, SNDPGMMSG, and Robust CL Procedure Design in 2026',
        'post_name'     => 'ibm-i-cl-error-handling-monmsg-escape-messages-condition-handler-dmpjob-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Build robust IBM i CL programs with proper exception handling: IBM i message types, MONMSG command patterns, program message queue management, SNDPGMMSG for custom errors, RCVMSG for capturing messages, condition handlers in CL procedures, DMPJOB for diagnostic dumps, and complete error-handling templates for production CL.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-29 08:00:00',
        'post_date_gmt' => '2026-06-29 02:30:00',
        'meta_input'    => array(
            '_as400_post56'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Condition Handlers, SNDPGMMSG, DMPJOB',
            '_yoast_wpseo_metadesc'              => 'Master IBM i CL exception handling: message types, MONMSG patterns, program message queues, SNDPGMMSG, RCVMSG, CL condition handlers, DMPJOB dumps, and robust CL procedure design.',
            '_yoast_wpseo_focuskw'               => 'IBM i CL error handling MONMSG escape messages condition handler DMPJOB 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-cl-error-handling-monmsg-escape-messages-condition-handler-dmpjob-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Condition Handlers',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i CL exception handling: message types, MONMSG, program message queues, SNDPGMMSG, condition handlers, DMPJOB, and robust CL program design patterns.',
            '_yoast_wpseo_twitter-title'         => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Handlers',
            '_yoast_wpseo_twitter-description'   => 'Build robust IBM i CL programs: MONMSG, escape message handling, SNDPGMMSG, condition handlers, and DMPJOB diagnostic dumps.',
            '_aioseo_title'                      => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Condition Handlers, SNDPGMMSG, DMPJOB',
            '_aioseo_description'                => 'Master IBM i CL exception handling: message types, MONMSG patterns, program message queues, SNDPGMMSG, RCVMSG, CL condition handlers, DMPJOB dumps, and robust CL procedure design.',
            '_aioseo_keywords'                   => 'IBM i CL error handling, IBM i MONMSG, IBM i escape message, IBM i SNDPGMMSG, IBM i condition handler, IBM i DMPJOB, IBM i CL exception 2026',
            '_aioseo_og_title'                   => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Condition Handlers',
            '_aioseo_og_description'             => 'Complete guide to IBM i CL exception handling: message types, MONMSG, program message queues, SNDPGMMSG, condition handlers, DMPJOB, and robust CL program design patterns.',
            '_aioseo_twitter_title'              => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Handlers',
            '_aioseo_twitter_description'        => 'Build robust IBM i CL programs: MONMSG, escape message handling, SNDPGMMSG, condition handlers, and DMPJOB diagnostic dumps.',
            'rank_math_focus_keyword'            => 'IBM i CL error handling MONMSG escape messages condition handler DMPJOB 2026',
            'rank_math_description'              => 'Master IBM i CL exception handling: message types, MONMSG patterns, program message queues, SNDPGMMSG, RCVMSG, CL condition handlers, DMPJOB dumps, and robust CL procedure design.',
            'rank_math_title'                    => 'IBM i CL Error Handling 2026: MONMSG, Escape Messages, Condition Handlers, SNDPGMMSG, DMPJOB',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post56_use_classic', 10, 2);
function as400_post56_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post56', true) === '1') return false;
    return $use_block_editor;
}
