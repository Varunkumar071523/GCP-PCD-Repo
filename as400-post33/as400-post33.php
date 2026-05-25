<?php
/**
 * Plugin Name: AS400 Decoded - Post 33 IBM i High Availability and Disaster Recovery
 * Description: Publishes Post 33 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post33_exists');
function as400_ensure_post33_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post33',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-high-availability-disaster-recovery-geographic-mirroring-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post33', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i high availability',
        'IBM i disaster recovery',
        'geographic mirroring IBM i',
        'switchable independent ASP',
        'MIMIX IBM i',
        'iTera IBM i',
        'IBM i HA tools',
        'IBM i replication',
        'IBM i RTO RPO',
        'IBM i backup recovery',
        'IBM i clustering',
        'PowerHA SystemMirror IBM i',
        'IBM i production availability',
        'IBM i failover',
        'journal-based replication IBM i',
        'IBM i IASP',
        'IBM i 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post33-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i High Availability and Disaster Recovery in 2026: Geographic Mirroring, Switchable ASPs, and HA Tools Compared',
        'post_name'     => 'ibm-i-high-availability-disaster-recovery-geographic-mirroring-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'IBM i high availability and disaster recovery in 2026 requires understanding the full stack: geographic mirroring at the storage layer, switchable Independent Auxiliary Storage Pools for role swaps, and journal-based logical replication for granular data protection. This post compares the major IBM i HA architectures and leading third-party tools — MIMIX, iTera, and PowerHA SystemMirror for i — explaining how to align your RTO and RPO targets with the right replication strategy. You will learn how IASPs enable a production disk pool to be varied off one system and varied on another, how geographic mirroring keeps a remote copy synchronised at the hardware level, and how journals underpin every logical replication product on the platform. Practical CL command examples cover VRYCFG, STRGEOMRR, DSPGEOMRR, CHGJRN, and the steps needed to execute and test a planned switchover.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-06 08:00:00',
        'post_date_gmt' => '2026-06-06 02:30:00',
        'meta_input'    => array(
            '_as400_post33'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i High Availability & Disaster Recovery 2026: Geographic Mirroring, Switchable ASPs, HA Tools',
            '_yoast_wpseo_metadesc'              => 'Compare IBM i HA options in 2026: geographic mirroring, switchable IASPs, journal-based replication, MIMIX, iTera, and PowerHA SystemMirror. Practical CL examples included.',
            '_yoast_wpseo_focuskw'               => 'IBM i high availability disaster recovery geographic mirroring',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-high-availability-disaster-recovery-geographic-mirroring-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i High Availability & Disaster Recovery 2026: Geographic Mirroring, Switchable ASPs, HA Tools Compared',
            '_yoast_wpseo_opengraph-description' => 'Everything you need to know about IBM i HA and DR in 2026 — geographic mirroring, switchable IASPs, journal-based replication, and a comparison of MIMIX, iTera, and PowerHA SystemMirror.',
            '_yoast_wpseo_twitter-title'         => 'IBM i HA & DR 2026: Geographic Mirroring, Switchable ASPs, and HA Tools Compared',
            '_yoast_wpseo_twitter-description'   => 'Geographic mirroring vs switchable IASPs vs journal replication — compare IBM i HA options for 2026 with real CL examples.',
            '_aioseo_title'                      => 'IBM i High Availability & Disaster Recovery 2026: Geographic Mirroring, Switchable ASPs, HA Tools',
            '_aioseo_description'                => 'Compare IBM i HA options in 2026: geographic mirroring, switchable IASPs, journal-based replication, MIMIX, iTera, and PowerHA SystemMirror. Practical CL examples included.',
            '_aioseo_keywords'                   => 'IBM i high availability, IBM i disaster recovery, geographic mirroring IBM i, switchable IASP, MIMIX IBM i, iTera IBM i, PowerHA SystemMirror IBM i, journal-based replication IBM i',
            '_aioseo_og_title'                   => 'IBM i High Availability & Disaster Recovery 2026: Geographic Mirroring, Switchable ASPs, HA Tools Compared',
            '_aioseo_og_description'             => 'Everything you need to know about IBM i HA and DR in 2026 — geographic mirroring, switchable IASPs, journal-based replication, and a comparison of MIMIX, iTera, and PowerHA SystemMirror.',
            '_aioseo_twitter_title'              => 'IBM i HA & DR 2026: Geographic Mirroring, Switchable ASPs, and HA Tools Compared',
            '_aioseo_twitter_description'        => 'Geographic mirroring vs switchable IASPs vs journal replication — compare IBM i HA options for 2026 with real CL examples.',
            'rank_math_focus_keyword'            => 'IBM i high availability disaster recovery geographic mirroring',
            'rank_math_description'              => 'Compare IBM i HA options in 2026: geographic mirroring, switchable IASPs, journal-based replication, MIMIX, iTera, and PowerHA SystemMirror. Practical CL examples included.',
            'rank_math_title'                    => 'IBM i High Availability & Disaster Recovery 2026: Geographic Mirroring, Switchable ASPs, HA Tools',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post33_use_classic', 10, 2);
function as400_post33_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post33', true) === '1') return false;
    return $use_block_editor;
}
