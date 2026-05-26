<?php
/**
 * Plugin Name: AS400 Decoded - Post 70 CL Data Areas and Data Queues
 * Description: Publishes Post 70 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post70_exists');
function as400_ensure_post70_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post70',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-cl-data-areas-data-queues-crtdtaara-rtvdtaara-crtdtaq-snddtaq-rcvdtaq-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post70', '1', true);
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
        'IBM i data area',
        'IBM i CRTDTAARA',
        'IBM i RTVDTAARA',
        'IBM i CHGDTAARA',
        'IBM i data queue',
        'IBM i CRTDTAQ',
        'IBM i SNDDTAQ',
        'IBM i RCVDTAQ',
        'IBM i IPC inter-program communication',
        'IBM i CL data area',
        'IBM i keyed data queue',
        'IBM i DTAARA keyword RPG',
        'IBM i LDA local data area',
        'IBM i data queue 2026',
        'IBM i WRKDTAARE',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post70-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i CL Data Areas and Data Queues: CRTDTAARA, RTVDTAARA, CHGDTAARA, CRTDTAQ, SNDDTAQ, RCVDTAQ, and Inter-Program Communication in 2026',
        'post_name'     => 'ibm-i-cl-data-areas-data-queues-crtdtaara-rtvdtaara-crtdtaq-snddtaq-rcvdtaq-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i data areas and data queues for inter-program communication in 2026: create and manage data areas with CRTDTAARA, RTVDTAARA, and CHGDTAARA, use the LDA local data area, declare DTAARA in RPG, build producer-consumer pipelines with CRTDTAQ, SNDDTAQ, and RCVDTAQ, and use keyed data queues for priority message routing.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-13 08:00:00',
        'post_date_gmt' => '2026-07-13 02:30:00',
        'meta_input'    => array(
            '_as400_post70'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i CL Data Areas & Data Queues 2026: CRTDTAARA CRTDTAQ SNDDTAQ RCVDTAQ',
            '_yoast_wpseo_metadesc'              => 'Master IBM i data areas and data queues for IPC in 2026: CRTDTAARA, RTVDTAARA, CHGDTAARA, LDA, RPG DTAARA keyword, CRTDTAQ, SNDDTAQ, RCVDTAQ, and keyed data queues.',
            '_yoast_wpseo_focuskw'               => 'IBM i CL data areas data queues CRTDTAARA RTVDTAARA CRTDTAQ SNDDTAQ RCVDTAQ 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-cl-data-areas-data-queues-crtdtaara-rtvdtaara-crtdtaq-snddtaq-rcvdtaq-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Data Areas & Data Queues 2026: CRTDTAARA, CRTDTAQ, SNDDTAQ, RCVDTAQ',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i data areas and data queues: CRTDTAARA, RTVDTAARA, CHGDTAARA, local data area (LDA), RPG DTAARA keyword, CRTDTAQ, SNDDTAQ, RCVDTAQ, keyed queues, and producer-consumer pipeline patterns.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Data Areas & Data Queues 2026: CRTDTAARA, CRTDTAQ, SNDDTAQ',
            '_yoast_wpseo_twitter-description'   => 'IBM i data areas and data queues for IPC: CRTDTAARA, RTVDTAARA, CHGDTAARA, LDA, CRTDTAQ, SNDDTAQ, RCVDTAQ, and keyed queues in 2026.',
            '_aioseo_title'                      => 'IBM i CL Data Areas & Data Queues 2026: CRTDTAARA CRTDTAQ SNDDTAQ RCVDTAQ',
            '_aioseo_description'                => 'Master IBM i data areas and data queues for IPC in 2026: CRTDTAARA, RTVDTAARA, CHGDTAARA, LDA, RPG DTAARA keyword, CRTDTAQ, SNDDTAQ, RCVDTAQ, and keyed data queues.',
            '_aioseo_keywords'                   => 'IBM i data area, IBM i CRTDTAARA, IBM i RTVDTAARA, IBM i data queue, IBM i CRTDTAQ, IBM i SNDDTAQ RCVDTAQ, IBM i IPC 2026',
            '_aioseo_og_title'                   => 'IBM i Data Areas & Data Queues 2026: CRTDTAARA, CRTDTAQ, SNDDTAQ, RCVDTAQ',
            '_aioseo_og_description'             => 'Complete guide to IBM i data areas and data queues: CRTDTAARA, RTVDTAARA, CHGDTAARA, local data area (LDA), RPG DTAARA keyword, CRTDTAQ, SNDDTAQ, RCVDTAQ, keyed queues, and producer-consumer pipeline patterns.',
            '_aioseo_twitter_title'              => 'IBM i Data Areas & Data Queues 2026: CRTDTAARA, CRTDTAQ, SNDDTAQ',
            '_aioseo_twitter_description'        => 'IBM i data areas and data queues for IPC: CRTDTAARA, RTVDTAARA, CHGDTAARA, LDA, CRTDTAQ, SNDDTAQ, RCVDTAQ, and keyed queues in 2026.',
            'rank_math_focus_keyword'            => 'IBM i CL data areas data queues CRTDTAARA RTVDTAARA CRTDTAQ SNDDTAQ RCVDTAQ 2026',
            'rank_math_description'              => 'Master IBM i data areas and data queues for IPC in 2026: CRTDTAARA, RTVDTAARA, CHGDTAARA, LDA, RPG DTAARA keyword, CRTDTAQ, SNDDTAQ, RCVDTAQ, and keyed data queues.',
            'rank_math_title'                    => 'IBM i CL Data Areas & Data Queues 2026: CRTDTAARA CRTDTAQ SNDDTAQ RCVDTAQ',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post70_use_classic', 10, 2);
function as400_post70_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post70', true) === '1') return false;
    return $use_block_editor;
}
