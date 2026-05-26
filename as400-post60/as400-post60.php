<?php
/**
 * Plugin Name: AS400 Decoded - Post 60 IBM i Journal Management
 * Description: Publishes Post 60 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post60_exists');
function as400_ensure_post60_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post60',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-journal-management-strjrnobj-receivers-dspjrn-remote-journaling-qaudjrn-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post60', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i journaling',
        'IBM i journal management',
        'IBM i STRJRNOBJ',
        'IBM i ENDJRNOBJ',
        'IBM i journal receiver',
        'IBM i CRTJRN',
        'IBM i DSPJRN',
        'IBM i remote journaling',
        'IBM i QAUDJRN',
        'IBM i security audit journal',
        'IBM i journal high availability',
        'IBM i DB2 journaling',
        'IBM i CHGJRN',
        'IBM i journal receiver chain',
        'IBM i DISPLAY_JOURNAL',
        'IBM i compliance auditing',
        'IBM i journal 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post60-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Journal Management: STRJRNOBJ, Journal Receivers, DSPJRN, Remote Journaling, and the QAUDJRN Security Audit Journal on IBM i in 2026',
        'post_name'     => 'ibm-i-journal-management-strjrnobj-receivers-dspjrn-remote-journaling-qaudjrn-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i journal management in 2026: create journals and journal receivers with CRTJRN, start and end object journaling with STRJRNOBJ and ENDJRNOBJ, manage the receiver chain with CHGJRN, read journal entries with DSPJRN and the DISPLAY_JOURNAL table function, configure remote journaling for high availability, and use the QAUDJRN security audit journal for compliance auditing.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-03 08:00:00',
        'post_date_gmt' => '2026-07-03 02:30:00',
        'meta_input'    => array(
            '_as400_post60'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Journal Management 2026: STRJRNOBJ, Receivers, DSPJRN, Remote Journaling, QAUDJRN',
            '_yoast_wpseo_metadesc'              => 'Master IBM i journal management: CRTJRN, STRJRNOBJ, journal receiver chains, DSPJRN, DISPLAY_JOURNAL SQL function, remote journaling for HA, and QAUDJRN compliance auditing.',
            '_yoast_wpseo_focuskw'               => 'IBM i journal management STRJRNOBJ receivers DSPJRN remote journaling QAUDJRN 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-journal-management-strjrnobj-receivers-dspjrn-remote-journaling-qaudjrn-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Journal Management 2026: STRJRNOBJ, Receivers, DSPJRN, Remote, QAUDJRN',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i journal management: CRTJRN, STRJRNOBJ, receiver chain management, DSPJRN, SQL access via DISPLAY_JOURNAL, remote journaling, and QAUDJRN security auditing.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Journal Management 2026: STRJRNOBJ, DSPJRN, Remote, QAUDJRN',
            '_yoast_wpseo_twitter-description'   => 'IBM i journal management: create journals, journal receivers, STRJRNOBJ, DSPJRN, remote journaling for HA/DR, and QAUDJRN compliance auditing.',
            '_aioseo_title'                      => 'IBM i Journal Management 2026: STRJRNOBJ, Receivers, DSPJRN, Remote Journaling, QAUDJRN',
            '_aioseo_description'                => 'Master IBM i journal management: CRTJRN, STRJRNOBJ, journal receiver chains, DSPJRN, DISPLAY_JOURNAL SQL function, remote journaling for HA, and QAUDJRN compliance auditing.',
            '_aioseo_keywords'                   => 'IBM i journaling, IBM i STRJRNOBJ, IBM i journal receiver, IBM i DSPJRN, IBM i remote journaling, IBM i QAUDJRN, IBM i compliance audit 2026',
            '_aioseo_og_title'                   => 'IBM i Journal Management 2026: STRJRNOBJ, Receivers, DSPJRN, Remote, QAUDJRN',
            '_aioseo_og_description'             => 'Complete guide to IBM i journal management: CRTJRN, STRJRNOBJ, receiver chain management, DSPJRN, SQL access via DISPLAY_JOURNAL, remote journaling, and QAUDJRN security auditing.',
            '_aioseo_twitter_title'              => 'IBM i Journal Management 2026: STRJRNOBJ, DSPJRN, Remote, QAUDJRN',
            '_aioseo_twitter_description'        => 'IBM i journal management: create journals, journal receivers, STRJRNOBJ, DSPJRN, remote journaling for HA/DR, and QAUDJRN compliance auditing.',
            'rank_math_focus_keyword'            => 'IBM i journal management STRJRNOBJ receivers DSPJRN remote journaling QAUDJRN 2026',
            'rank_math_description'              => 'Master IBM i journal management: CRTJRN, STRJRNOBJ, journal receiver chains, DSPJRN, DISPLAY_JOURNAL SQL function, remote journaling for HA, and QAUDJRN compliance auditing.',
            'rank_math_title'                    => 'IBM i Journal Management 2026: STRJRNOBJ, Receivers, DSPJRN, Remote Journaling, QAUDJRN',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post60_use_classic', 10, 2);
function as400_post60_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post60', true) === '1') return false;
    return $use_block_editor;
}
