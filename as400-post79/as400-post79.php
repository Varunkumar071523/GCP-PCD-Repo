<?php
/**
 * Plugin Name: AS400 Decoded - Post 79 IFS Permissions and Security
 * Description: Publishes Post 79 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post79_exists');
function as400_ensure_post79_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post79',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-umask-audit-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post79', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ifs-file-systems');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i IFS permissions',
        'IBM i CHGAUT command',
        'IBM i CHGOWN IFS',
        'IBM i IFS ACL access control list',
        'IBM i PASE umask',
        'IBM i IFS authority auditing',
        'IBM i DSPOBJAUT IFS',
        'IBM i IFS object ownership',
        'IBM i IFS *PUBLIC authority',
        'IBM i IFS directory permissions',
        'IBM i SETFACL GETFACL',
        'IBM i IFS security 2026',
        'IBM i stream file authority',
        'IBM i IFS WRKAUT',
        'IBM i IFS symbolic link security',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post79-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IFS Permissions and Security on IBM i: CHGAUT, CHGOWN, ACLs, PASE umask, Authority Auditing, and Stream File Security Best Practices in 2026',
        'post_name'     => 'ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-umask-audit-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Secure the IBM i Integrated File System (IFS) in 2026: manage stream file and directory authorities with CHGAUT and WRKOBJAUT, change ownership with CHGOWN, apply access control lists (ACLs) using SETFACL and GETFACL in PASE, configure the PASE umask for default creation permissions, audit IFS object access with QAUDJRN, and follow stream file security best practices.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-22 08:00:00',
        'post_date_gmt' => '2026-07-22 02:30:00',
        'meta_input'    => array(
            '_as400_post79'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i IFS Permissions & Security 2026: CHGAUT CHGOWN ACL PASE umask Audit',
            '_yoast_wpseo_metadesc'              => 'Secure IBM i IFS stream files in 2026: CHGAUT, CHGOWN, ACLs with SETFACL/GETFACL, PASE umask, QAUDJRN authority auditing, *PUBLIC authority, and directory permission best practices.',
            '_yoast_wpseo_focuskw'               => 'IBM i IFS permissions security CHGAUT CHGOWN ACL PASE umask audit 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-umask-audit-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i IFS Permissions & Security 2026: CHGAUT, CHGOWN, ACL, PASE umask',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IFS security on IBM i: CHGAUT, CHGOWN, ACLs with SETFACL/GETFACL, PASE umask defaults, QAUDJRN auditing, *PUBLIC authority control, and stream file security best practices.',
            '_yoast_wpseo_twitter-title'         => 'IBM i IFS Permissions & Security 2026: CHGAUT, CHGOWN, ACL, PASE umask',
            '_yoast_wpseo_twitter-description'   => 'IFS security on IBM i: CHGAUT, CHGOWN, ACLs, PASE umask, QAUDJRN auditing, and stream file security best practices in 2026.',
            '_aioseo_title'                      => 'IBM i IFS Permissions & Security 2026: CHGAUT CHGOWN ACL PASE umask Audit',
            '_aioseo_description'                => 'Secure IBM i IFS stream files in 2026: CHGAUT, CHGOWN, ACLs with SETFACL/GETFACL, PASE umask, QAUDJRN authority auditing, *PUBLIC authority, and directory permission best practices.',
            '_aioseo_keywords'                   => 'IBM i IFS permissions, IBM i CHGAUT, IBM i CHGOWN IFS, IBM i IFS ACL, IBM i PASE umask, IBM i IFS security 2026',
            '_aioseo_og_title'                   => 'IBM i IFS Permissions & Security 2026: CHGAUT, CHGOWN, ACL, PASE umask',
            '_aioseo_og_description'             => 'Complete guide to IFS security on IBM i: CHGAUT, CHGOWN, ACLs with SETFACL/GETFACL, PASE umask defaults, QAUDJRN auditing, *PUBLIC authority control, and stream file security best practices.',
            '_aioseo_twitter_title'              => 'IBM i IFS Permissions & Security 2026: CHGAUT, CHGOWN, ACL, PASE umask',
            '_aioseo_twitter_description'        => 'IFS security on IBM i: CHGAUT, CHGOWN, ACLs, PASE umask, QAUDJRN auditing, and stream file security best practices in 2026.',
            'rank_math_focus_keyword'            => 'IBM i IFS permissions security CHGAUT CHGOWN ACL PASE umask audit 2026',
            'rank_math_description'              => 'Secure IBM i IFS stream files in 2026: CHGAUT, CHGOWN, ACLs with SETFACL/GETFACL, PASE umask, QAUDJRN authority auditing, *PUBLIC authority, and directory permission best practices.',
            'rank_math_title'                    => 'IBM i IFS Permissions & Security 2026: CHGAUT CHGOWN ACL PASE umask Audit',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post79_use_classic', 10, 2);
function as400_post79_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post79', true) === '1') return false;
    return $use_block_editor;
}
