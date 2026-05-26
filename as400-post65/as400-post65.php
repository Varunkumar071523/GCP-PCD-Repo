<?php
/**
 * Plugin Name: AS400 Decoded - Post 65 IBM i Outbound Email
 * Description: Publishes Post 65 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post65_exists');
function as400_ensure_post65_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post65',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-outbound-email-snddst-smtp-pase-sendmail-rpg-html-email-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post65', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i outbound email',
        'IBM i SNDDST',
        'IBM i SMTP configuration',
        'IBM i PASE sendmail',
        'IBM i email from RPG',
        'IBM i HTML email',
        'IBM i MIME email',
        'IBM i SNDSMTPEMM',
        'IBM i email notification',
        'IBM i SMTP setup',
        'IBM i CL email alert',
        'IBM i email 2026',
        'IBM i PASE Python email',
        'IBM i RPG email integration',
        'IBM i batch job email alert',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post65-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Outbound Email in 2026: SNDDST, SMTP Configuration, SNDSMTPEMM, HTML Email from RPG, and PASE Sendmail',
        'post_name'     => 'ibm-i-outbound-email-snddst-smtp-pase-sendmail-rpg-html-email-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Send email from IBM i in 2026 using every available method: configure the SMTP server with CHGSMTPA, send plain-text alerts via SNDDST and SNDSMTPEMM from CL, build multipart MIME HTML email directly from RPG using HTTP API calls, send notifications from PASE with Python smtplib, and design a reusable CL email alert pattern for batch job failures.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-08 08:00:00',
        'post_date_gmt' => '2026-07-08 02:30:00',
        'meta_input'    => array(
            '_as400_post65'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Outbound Email 2026: SNDDST, SMTP, SNDSMTPEMM, RPG HTML Email',
            '_yoast_wpseo_metadesc'              => 'Send email from IBM i in 2026: SMTP setup with CHGSMTPA, SNDDST and SNDSMTPEMM from CL, HTML email from RPG via MIME, Python smtplib in PASE, and batch job failure alerts.',
            '_yoast_wpseo_focuskw'               => 'IBM i outbound email SNDDST SMTP PASE sendmail RPG HTML email 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-outbound-email-snddst-smtp-pase-sendmail-rpg-html-email-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Outbound Email 2026: SNDDST, SMTP, SNDSMTPEMM, RPG HTML Email',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to outbound email from IBM i in 2026: SMTP configuration, SNDDST, SNDSMTPEMM, HTML MIME email from RPG, Python smtplib in PASE, and batch alert patterns.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Outbound Email 2026: SNDDST, SMTP, RPG HTML Email, PASE',
            '_yoast_wpseo_twitter-description'   => 'Send email from IBM i: SMTP configuration, SNDDST, SNDSMTPEMM, HTML email from RPG via MIME, and Python smtplib in PASE in 2026.',
            '_aioseo_title'                      => 'IBM i Outbound Email 2026: SNDDST, SMTP, SNDSMTPEMM, RPG HTML Email',
            '_aioseo_description'                => 'Send email from IBM i in 2026: SMTP setup with CHGSMTPA, SNDDST and SNDSMTPEMM from CL, HTML email from RPG via MIME, Python smtplib in PASE, and batch job failure alerts.',
            '_aioseo_keywords'                   => 'IBM i outbound email, IBM i SNDDST, IBM i SMTP, IBM i SNDSMTPEMM, IBM i HTML email RPG, IBM i PASE sendmail, IBM i email 2026',
            '_aioseo_og_title'                   => 'IBM i Outbound Email 2026: SNDDST, SMTP, SNDSMTPEMM, RPG HTML Email',
            '_aioseo_og_description'             => 'Complete guide to outbound email from IBM i in 2026: SMTP configuration, SNDDST, SNDSMTPEMM, HTML MIME email from RPG, Python smtplib in PASE, and batch alert patterns.',
            '_aioseo_twitter_title'              => 'IBM i Outbound Email 2026: SNDDST, SMTP, RPG HTML Email, PASE',
            '_aioseo_twitter_description'        => 'Send email from IBM i: SMTP configuration, SNDDST, SNDSMTPEMM, HTML email from RPG via MIME, and Python smtplib in PASE in 2026.',
            'rank_math_focus_keyword'            => 'IBM i outbound email SNDDST SMTP PASE sendmail RPG HTML email 2026',
            'rank_math_description'              => 'Send email from IBM i in 2026: SMTP setup with CHGSMTPA, SNDDST and SNDSMTPEMM from CL, HTML email from RPG via MIME, Python smtplib in PASE, and batch job failure alerts.',
            'rank_math_title'                    => 'IBM i Outbound Email 2026: SNDDST, SMTP, SNDSMTPEMM, RPG HTML Email',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post65_use_classic', 10, 2);
function as400_post65_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post65', true) === '1') return false;
    return $use_block_editor;
}
