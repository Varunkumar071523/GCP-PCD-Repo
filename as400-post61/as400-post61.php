<?php
/**
 * Plugin Name: AS400 Decoded - Post 61 IBM i IFS Permissions and Security
 * Description: Publishes Post 61 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post61_exists');
function as400_ensure_post61_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post61',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-qaudjrn-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post61', '1', true);
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
        'IBM i IFS security',
        'IBM i IFS permissions',
        'IBM i CHGAUT command',
        'IBM i CHGOWN command',
        'IBM i IFS ACL',
        'IBM i IFS access control list',
        'IBM i *PUBLIC authority IFS',
        'IBM i IFS symbolic links',
        'IBM i IFS directory security',
        'IBM i PASE IFS security',
        'IBM i QAUDJRN IFS audit',
        'IBM i CHGDIRAUT',
        'IBM i IFS stream file authority',
        'IBM i IFS 2026',
        'IBM i IFS PASE application security',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post61-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i IFS Permissions and Security: CHGAUT, CHGOWN, Access Control Lists, Symbolic Links, and QAUDJRN Auditing in 2026',
        'post_name'     => 'ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-qaudjrn-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Secure the IBM i Integrated File System in 2026: understand the IFS authority model, control *PUBLIC access, use CHGAUT and CHGOWN to set object permissions and ownership, configure IFS access control lists, handle symbolic link authority implications, design secure PASE application directory trees, and audit IFS access using QAUDJRN.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-04 08:00:00',
        'post_date_gmt' => '2026-07-04 02:30:00',
        'meta_input'    => array(
            '_as400_post61'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i IFS Permissions and Security 2026: CHGAUT, CHGOWN, ACL, QAUDJRN',
            '_yoast_wpseo_metadesc'              => 'Secure the IBM i IFS in 2026: CHGAUT, CHGOWN, access control lists, *PUBLIC authority, symbolic link risks, PASE directory trees, and QAUDJRN IFS auditing.',
            '_yoast_wpseo_focuskw'               => 'IBM i IFS permissions security CHGAUT CHGOWN ACL QAUDJRN 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ifs-permissions-security-chgaut-chgown-acl-pase-qaudjrn-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i IFS Permissions and Security 2026: CHGAUT, CHGOWN, ACL, QAUDJRN',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i IFS security in 2026: authority model, *PUBLIC access, CHGAUT and CHGOWN, IFS ACLs, symbolic link implications, PASE application directories, and QAUDJRN auditing.',
            '_yoast_wpseo_twitter-title'         => 'IBM i IFS Security 2026: CHGAUT, CHGOWN, ACL, Symbolic Links, QAUDJRN',
            '_yoast_wpseo_twitter-description'   => 'Secure the IBM i IFS: CHGAUT, CHGOWN, access control lists, *PUBLIC authority patterns, symbolic link risks, and QAUDJRN IFS auditing in 2026.',
            '_aioseo_title'                      => 'IBM i IFS Permissions and Security 2026: CHGAUT, CHGOWN, ACL, QAUDJRN',
            '_aioseo_description'                => 'Secure the IBM i IFS in 2026: CHGAUT, CHGOWN, access control lists, *PUBLIC authority, symbolic link risks, PASE directory trees, and QAUDJRN IFS auditing.',
            '_aioseo_keywords'                   => 'IBM i IFS security, IBM i CHGAUT, IBM i CHGOWN, IBM i IFS ACL, IBM i IFS permissions, IBM i QAUDJRN IFS, IBM i IFS 2026',
            '_aioseo_og_title'                   => 'IBM i IFS Permissions and Security 2026: CHGAUT, CHGOWN, ACL, QAUDJRN',
            '_aioseo_og_description'             => 'Complete guide to IBM i IFS security in 2026: authority model, *PUBLIC access, CHGAUT and CHGOWN, IFS ACLs, symbolic link implications, PASE application directories, and QAUDJRN auditing.',
            '_aioseo_twitter_title'              => 'IBM i IFS Security 2026: CHGAUT, CHGOWN, ACL, Symbolic Links, QAUDJRN',
            '_aioseo_twitter_description'        => 'Secure the IBM i IFS: CHGAUT, CHGOWN, access control lists, *PUBLIC authority patterns, symbolic link risks, and QAUDJRN IFS auditing in 2026.',
            'rank_math_focus_keyword'            => 'IBM i IFS permissions security CHGAUT CHGOWN ACL QAUDJRN 2026',
            'rank_math_description'              => 'Secure the IBM i IFS in 2026: CHGAUT, CHGOWN, access control lists, *PUBLIC authority, symbolic link risks, PASE directory trees, and QAUDJRN IFS auditing.',
            'rank_math_title'                    => 'IBM i IFS Permissions and Security 2026: CHGAUT, CHGOWN, ACL, QAUDJRN',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post61_use_classic', 10, 2);
function as400_post61_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post61', true) === '1') return false;
    return $use_block_editor;
}
