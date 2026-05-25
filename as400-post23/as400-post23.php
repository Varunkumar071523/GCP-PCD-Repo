<?php
/**
 * Plugin Name: AS400 Decoded - Post 23 IBM i Security
 * Description: Publishes Post 23 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post23_exists');
function as400_ensure_post23_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post23',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-security-user-profiles-object-authority-adopted-authority-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post23', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i security',
        'user profiles IBM i',
        'object authority IBM i',
        'adopted authority IBM i',
        'QSECURITY',
        'IBM i auditing',
        'QAUDJRN',
        'special authorities IBM i',
        'group profiles IBM i',
        'authorisation list IBM i',
        'IBM i compliance',
        'RCAC IBM i',
        'IBM i least privilege',
        'IBM i service account',
        'IBM i 2026',
        'IBM i security audit',
        'IBM i PCI compliance'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    // ── Content ───────────────────────────────────
    $content = file_get_contents(dirname(__FILE__) . '/post23-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i Security in 2026: User Profiles, Object Authority, Adopted Authority, and Practical Security Patterns',
        'post_name'    => 'ibm-i-security-user-profiles-object-authority-adopted-authority-2026',
        'post_content' => $content,
        'post_excerpt' => 'IBM i security is object-based and OS-enforced — bypassing the application does not bypass security. This post covers QSECURITY levels, user profiles and special authorities, object authority and the authority checking sequence, adopted authority for controlled privilege elevation, group profiles, authorisation lists, QAUDJRN audit journalling, Row and Column Access Control (RCAC), and the practical patterns IBM i shops use to maintain least-privilege configurations.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-27 08:00:00',
        'post_date_gmt' => '2026-05-27 02:30:00',
        'meta_input'   => array(
            '_as400_post23' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i Security in 2026: User Profiles, Object Authority and Adopted Authority',
            '_yoast_wpseo_metadesc'      => 'A practical guide to IBM i security: QSECURITY levels, user profiles, special authorities, object authority, the authority checking sequence, adopted authority, group profiles, authorisation lists, QAUDJRN auditing, and RCAC row and column access control.',
            '_yoast_wpseo_focuskw'       => 'IBM i security user profiles object authority adopted authority',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-security-user-profiles-object-authority-adopted-authority-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Security in 2026: Object Authority Done Right',
            '_yoast_wpseo_opengraph-description' => 'QSECURITY, user profiles, adopted authority, QAUDJRN, RCAC — how IBM i security actually works and the practical patterns that keep production systems compliant.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Security in 2026 — object authority, adopted authority, and audit journalling',
            '_yoast_wpseo_twitter-description'   => 'IBM i enforces security at the OS level. Here is how QSECURITY, user profiles, adopted authority, and QAUDJRN work in practice.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i Security in 2026: User Profiles, Object Authority and Adopted Authority',
            '_aioseo_description'        => 'A practical guide to IBM i security: QSECURITY levels, user profiles, special authorities, object authority, the authority checking sequence, adopted authority, group profiles, authorisation lists, QAUDJRN auditing, and RCAC row and column access control.',
            '_aioseo_keywords'           => 'IBM i security,user profiles IBM i,object authority IBM i,adopted authority,QSECURITY,QAUDJRN IBM i,group profiles IBM i,authorisation list IBM i,RCAC IBM i,IBM i compliance',
            '_aioseo_og_title'           => 'IBM i Security in 2026: Object Authority Done Right',
            '_aioseo_og_description'     => 'QSECURITY, user profiles, adopted authority, QAUDJRN, RCAC — how IBM i security actually works and the practical patterns that keep production systems compliant.',
            '_aioseo_twitter_title'      => 'IBM i Security in 2026 — object authority, adopted authority, and audit journalling',
            '_aioseo_twitter_description'=> 'IBM i enforces security at the OS level. Here is how QSECURITY, user profiles, adopted authority, and QAUDJRN work in practice.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i security user profiles object authority adopted authority',
            'rank_math_description'      => 'A practical guide to IBM i security: QSECURITY levels, user profiles, special authorities, object authority, the authority checking sequence, adopted authority, group profiles, authorisation lists, QAUDJRN auditing, and RCAC row and column access control.',
            'rank_math_title'            => 'IBM i Security in 2026: User Profiles, Object Authority and Adopted Authority',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post23_use_classic', 10, 2);
function as400_post23_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post23', true) === '1') return false;
    return $use_block_editor;
}
