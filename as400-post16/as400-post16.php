<?php
/**
 * Plugin Name: AS400 Decoded - Post 16 IBM i Security Hardening
 * Description: Publishes Post 16 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post16_exists');
function as400_ensure_post16_exists() {

    // Check already published
    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post16',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-security-hardening-object-authority-exit-programs-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post16', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i security',
        'QSECURITY',
        'object authority',
        'exit programs',
        'QAUDJRN',
        'IBM i hardening',
        '*ALLOBJ',
        'IBM i network security',
        'PASE SSH',
        'IBM i user profiles',
        'DB2 for i security',
        'IFS permissions',
        'IBM i audit journal',
        'IBM i modernisation',
        'IBM i 2026',
        'Powertech',
        'IBM i compliance'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) {
            $term = wp_insert_term($tag, 'post_tag');
        }
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    // ── Content ───────────────────────────────────
    $content = file_get_contents(dirname(__FILE__) . '/post16-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i Security Hardening in 2026: Object Authority, Exit Programs, QAUDJRN, and What Good Security Practice Actually Looks Like',
        'post_name'    => 'ibm-i-security-hardening-object-authority-exit-programs-2026',
        'post_content' => $content,
        'post_excerpt' => 'IBM i has a reputation for security — but reputation is not configuration. This post covers practical hardening: QSECURITY levels, object authority, *ALLOBJ profiles, exit programs for network services, audit journaling, SSH, and a prioritised checklist for any IBM i environment.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-20 08:00:00',
        'post_date_gmt' => '2026-05-20 02:30:00',
        'meta_input'   => array(

            // ── Internal marker ───────────────────
            '_as400_post16' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i Security Hardening in 2026: Object Authority, Exit Programs and Audit Journaling',
            '_yoast_wpseo_metadesc'      => 'Practical IBM i security hardening: QSECURITY levels, *ALLOBJ profiles, exit programs for JDBC/FTP/sign-on, QAUDJRN auditing, SSH configuration, and a prioritised checklist.',
            '_yoast_wpseo_focuskw'       => 'IBM i security hardening exit programs object authority',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-security-hardening-object-authority-exit-programs-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Security Hardening in 2026: What Good Actually Looks Like',
            '_yoast_wpseo_opengraph-description' => 'Object authority, exit programs, QAUDJRN, *ALLOBJ profiles, SSH, and IFS permissions — a practical IBM i security hardening guide for 2026.',
            '_yoast_wpseo_twitter-title'         => 'IBM i security hardening — the practical checklist for 2026',
            '_yoast_wpseo_twitter-description'   => 'QSECURITY, exit programs, *ALLOBJ, QAUDJRN, SSH. What does good IBM i security configuration actually look like?',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i Security Hardening in 2026: Object Authority, Exit Programs and Audit Journaling',
            '_aioseo_description'        => 'Practical IBM i security hardening: QSECURITY levels, *ALLOBJ profiles, exit programs for JDBC/FTP/sign-on, QAUDJRN auditing, SSH configuration, and a prioritised checklist.',
            '_aioseo_keywords'           => 'IBM i security hardening,exit programs IBM i,QAUDJRN,object authority IBM i,*ALLOBJ IBM i,IBM i network security,QSECURITY,IBM i SSH',
            '_aioseo_og_title'           => 'IBM i Security Hardening in 2026: What Good Actually Looks Like',
            '_aioseo_og_description'     => 'Object authority, exit programs, QAUDJRN, *ALLOBJ profiles, SSH, and IFS permissions — a practical IBM i security hardening guide for 2026.',
            '_aioseo_twitter_title'      => 'IBM i security hardening — the practical checklist for 2026',
            '_aioseo_twitter_description'=> 'QSECURITY, exit programs, *ALLOBJ, QAUDJRN, SSH. What does good IBM i security configuration actually look like?',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i security hardening exit programs object authority',
            'rank_math_description'      => 'Practical IBM i security hardening: QSECURITY levels, *ALLOBJ profiles, exit programs for JDBC/FTP/sign-on, QAUDJRN auditing, SSH configuration, and a prioritised checklist.',
            'rank_math_title'            => 'IBM i Security Hardening in 2026: Object Authority, Exit Programs and Audit Journaling',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    // ── Attach tags ───────────────────────────────
    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

/* ─────────────────────────────────────────────────
   Force classic editor for this post
   ───────────────────────────────────────────────── */
add_filter('use_block_editor_for_post', 'as400_post16_use_classic', 10, 2);
function as400_post16_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    $marker = get_post_meta($post->ID, '_as400_post16', true);
    if ($marker === '1') {
        return false;
    }
    return $use_block_editor;
}
