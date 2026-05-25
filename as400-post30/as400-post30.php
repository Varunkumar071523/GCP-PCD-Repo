<?php
/**
 * Plugin Name: AS400 Decoded - Post 30 IBM i IFS Advanced
 * Description: Publishes Post 30 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post30_exists');
function as400_ensure_post30_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post30',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ifs-advanced-journalling-netserver-backup-ccsid-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post30', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ifs-file-systems');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i IFS advanced',
        'IFS journalling IBM i',
        'NetServer IBM i',
        'IBM i SMB share',
        'IBM i NFS',
        'IBM i IFS backup',
        'SAV RST IBM i IFS',
        'IBM i large file support',
        'CCSID IBM i IFS',
        'IBM i encoding IFS',
        'IBM i IFS permissions',
        'IBM i stream file journal',
        'IBM i IFS CCSID 1208',
        'IBM i IFS performance',
        'IBM i 2026',
        'IBM i NetServer Windows drive',
        'IFS STRJRNLK IBM i'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post30-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i IFS Advanced in 2026: Journalling Stream Files, NetServer SMB Shares, IFS Backup, Large Files, and CCSID Encoding',
        'post_name'    => 'ibm-i-ifs-advanced-journalling-netserver-backup-ccsid-2026',
        'post_content' => $content,
        'post_excerpt' => 'Advanced IBM i IFS topics for production environments: enabling journalling on IFS directories for recovery and replication, sharing IFS directories as Windows network drives through NetServer, NFS exports for Linux clients, saving and restoring IFS data with SAV/RST, large file support for files over 1GB, and CCSID encoding management — why CCSID 1208 (UTF-8) matters, how to set it, and the CCSID 65535 trap that breaks modern tooling.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-03 08:00:00',
        'post_date_gmt' => '2026-06-03 02:30:00',
        'meta_input'   => array(
            '_as400_post30' => '1',
            '_yoast_wpseo_title'         => 'IBM i IFS Advanced in 2026: Journalling, NetServer, Backup and CCSID Encoding',
            '_yoast_wpseo_metadesc'      => 'Advanced IBM i IFS: journalling stream files for recovery and replication, NetServer SMB shares for Windows access, NFS exports, SAV/RST backup, large file support over 1GB, CCSID 1208 UTF-8 encoding, and the CCSID 65535 trap that breaks Git and modern tools.',
            '_yoast_wpseo_focuskw'       => 'IBM i IFS advanced journalling NetServer backup CCSID encoding',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-ifs-advanced-journalling-netserver-backup-ccsid-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i IFS Advanced in 2026: The Operational Guide',
            '_yoast_wpseo_opengraph-description' => 'IFS journalling, NetServer Windows shares, NFS, SAV/RST backup, large file support, and CCSID 1208 — the operational topics that matter when the IFS is in active production use.',
            '_yoast_wpseo_twitter-title'         => 'IBM i IFS advanced in 2026 — journalling, NetServer, CCSID, and backup',
            '_yoast_wpseo_twitter-description'   => 'CCSID 65535 on IFS files breaks Git and modern editors. Always set CCSID 1208 (UTF-8). Here is the full IFS operational guide for IBM i in 2026.',
            '_aioseo_title'              => 'IBM i IFS Advanced in 2026: Journalling, NetServer, Backup and CCSID Encoding',
            '_aioseo_description'        => 'Advanced IBM i IFS: journalling stream files for recovery and replication, NetServer SMB shares for Windows access, NFS exports, SAV/RST backup, large file support over 1GB, CCSID 1208 UTF-8 encoding, and the CCSID 65535 trap that breaks Git and modern tools.',
            '_aioseo_keywords'           => 'IBM i IFS advanced,IFS journalling IBM i,NetServer IBM i,IBM i SMB share,IBM i NFS,IBM i IFS backup,SAV RST IBM i,CCSID IBM i IFS,IBM i encoding,IBM i large file support',
            '_aioseo_og_title'           => 'IBM i IFS Advanced in 2026: The Operational Guide',
            '_aioseo_og_description'     => 'IFS journalling, NetServer Windows shares, NFS, SAV/RST backup, large file support, and CCSID 1208 — the operational topics that matter when the IFS is in active production use.',
            '_aioseo_twitter_title'      => 'IBM i IFS advanced in 2026 — journalling, NetServer, CCSID, and backup',
            '_aioseo_twitter_description'=> 'CCSID 65535 on IFS files breaks Git and modern editors. Always set CCSID 1208 (UTF-8). Here is the full IFS operational guide for IBM i in 2026.',
            'rank_math_focus_keyword'    => 'IBM i IFS advanced journalling NetServer backup CCSID encoding',
            'rank_math_description'      => 'Advanced IBM i IFS: journalling stream files for recovery and replication, NetServer SMB shares for Windows access, NFS exports, SAV/RST backup, large file support over 1GB, CCSID 1208 UTF-8 encoding, and the CCSID 65535 trap that breaks Git and modern tools.',
            'rank_math_title'            => 'IBM i IFS Advanced in 2026: Journalling, NetServer, Backup and CCSID Encoding',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post30_use_classic', 10, 2);
function as400_post30_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post30', true) === '1') return false;
    return $use_block_editor;
}
