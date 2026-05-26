<?php
/**
 * Plugin Name: AS400 Decoded - Post 77 IBM i Output Queue and Print Management
 * Description: Publishes Post 77 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post77_exists');
function as400_ensure_post77_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post77',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-output-queue-print-management-wrkoutq-chgoutq-spooled-file-splf-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post77', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i output queue management',
        'IBM i WRKOUTQ command',
        'IBM i CHGOUTQ',
        'IBM i spooled file SPLF',
        'IBM i WRKSPLF command',
        'IBM i CHGSPLFA',
        'IBM i DLTSPLF',
        'IBM i CPYSPLF command',
        'IBM i SNDNETSPLF',
        'IBM i print services PSF',
        'IBM i OUTQ printer writer',
        'IBM i STRPRTWTR',
        'IBM i spooled file PDF conversion',
        'IBM i print management 2026',
        'IBM i QPRINT output queue',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post77-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Output Queue and Print Management: WRKOUTQ, CHGOUTQ, Spooled Files, CPYSPLF, SNDNETSPLF, PDF Conversion, and Printer Writers in 2026',
        'post_name'     => 'ibm-i-output-queue-print-management-wrkoutq-chgoutq-spooled-file-splf-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i output queue and print management in 2026: create and configure output queues with CRTOUTQ and CHGOUTQ, work with spooled files using WRKOUTQ and WRKSPLF, move and copy spooled files, convert spooled files to PDF with IBM i Transform Services, send spooled files over the network with SNDNETSPLF, and manage printer writers with STRPRTWTR and ENDWTR.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-20 08:00:00',
        'post_date_gmt' => '2026-07-20 02:30:00',
        'meta_input'    => array(
            '_as400_post77'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Output Queue & Print Management 2026: WRKOUTQ CHGOUTQ SPLF PDF',
            '_yoast_wpseo_metadesc'              => 'Master IBM i output queue and print management in 2026: CRTOUTQ, CHGOUTQ, WRKOUTQ, spooled files, CPYSPLF, SNDNETSPLF, PDF conversion via Transform Services, and printer writer management.',
            '_yoast_wpseo_focuskw'               => 'IBM i output queue print management WRKOUTQ CHGOUTQ spooled file SPLF PDF 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-output-queue-print-management-wrkoutq-chgoutq-spooled-file-splf-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Output Queue & Print Management 2026: WRKOUTQ, CHGOUTQ, SPLF, PDF',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i print management: CRTOUTQ, CHGOUTQ, WRKOUTQ, WRKSPLF, spooled file operations, CPYSPLF, SNDNETSPLF, PDF conversion with IBM i Transform Services, and printer writer control.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Output Queue & Print Management 2026: WRKOUTQ, SPLF, PDF',
            '_yoast_wpseo_twitter-description'   => 'IBM i output queue and print management: CRTOUTQ, CHGOUTQ, spooled files, CPYSPLF, SNDNETSPLF, PDF conversion, and printer writers in 2026.',
            '_aioseo_title'                      => 'IBM i Output Queue & Print Management 2026: WRKOUTQ CHGOUTQ SPLF PDF',
            '_aioseo_description'                => 'Master IBM i output queue and print management in 2026: CRTOUTQ, CHGOUTQ, WRKOUTQ, spooled files, CPYSPLF, SNDNETSPLF, PDF conversion via Transform Services, and printer writer management.',
            '_aioseo_keywords'                   => 'IBM i output queue, IBM i WRKOUTQ, IBM i CHGOUTQ, IBM i spooled file SPLF, IBM i PDF conversion, IBM i print management 2026',
            '_aioseo_og_title'                   => 'IBM i Output Queue & Print Management 2026: WRKOUTQ, CHGOUTQ, SPLF, PDF',
            '_aioseo_og_description'             => 'Complete guide to IBM i print management: CRTOUTQ, CHGOUTQ, WRKOUTQ, WRKSPLF, spooled file operations, CPYSPLF, SNDNETSPLF, PDF conversion with IBM i Transform Services, and printer writer control.',
            '_aioseo_twitter_title'              => 'IBM i Output Queue & Print Management 2026: WRKOUTQ, SPLF, PDF',
            '_aioseo_twitter_description'        => 'IBM i output queue and print management: CRTOUTQ, CHGOUTQ, spooled files, CPYSPLF, SNDNETSPLF, PDF conversion, and printer writers in 2026.',
            'rank_math_focus_keyword'            => 'IBM i output queue print management WRKOUTQ CHGOUTQ spooled file SPLF PDF 2026',
            'rank_math_description'              => 'Master IBM i output queue and print management in 2026: CRTOUTQ, CHGOUTQ, WRKOUTQ, spooled files, CPYSPLF, SNDNETSPLF, PDF conversion via Transform Services, and printer writer management.',
            'rank_math_title'                    => 'IBM i Output Queue & Print Management 2026: WRKOUTQ CHGOUTQ SPLF PDF',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post77_use_classic', 10, 2);
function as400_post77_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post77', true) === '1') return false;
    return $use_block_editor;
}
