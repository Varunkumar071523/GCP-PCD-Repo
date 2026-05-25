<?php
/**
 * Plugin Name: AS400 Decoded - Post 47 IBM i Security Hardening
 * Description: Publishes Post 47 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post47_exists');
function as400_ensure_post47_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post47',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-security-hardening-qsecurity-user-profiles-special-authority-network-security-qsys2-security-views-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post47', '1', true);
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
        'IBM i security',
        'IBM i security hardening',
        'QSECURITY IBM i',
        'IBM i user profile security',
        'IBM i special authority',
        'IBM i object authority',
        'IBM i QAUDJRN',
        'IBM i security audit',
        'IBM i network security',
        'QRMTSIGN IBM i',
        'IBM i adopted authority',
        'IBM i RCAC',
        'IBM i security 2026',
        'IBM i QSYS2 security views',
        'IBM i security compliance',
        'IBM i USRPRF security',
        'IBM i security best practices',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post47-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Security Hardening in 2026: QSECURITY Levels, User Profile Auditing, Special Authority, Network Security, and QSYS2 Security Views',
        'post_name'     => 'ibm-i-security-hardening-qsecurity-user-profiles-special-authority-network-security-qsys2-security-views-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A practical guide to IBM i security hardening in 2026: QSECURITY levels 10–50, auditing user profiles with QSYS2.USER_INFO, removing excessive special authorities, object authority management, enabling QAUDJRN, hardening network services, and applying Row and Column Access Control in DB2 for i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-20 08:00:00',
        'post_date_gmt' => '2026-06-20 02:30:00',
        'meta_input'    => array(
            '_as400_post47'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Security Hardening 2026: QSECURITY, User Profiles, Special Authority & QAUDJRN %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Harden your IBM i system in 2026: set QSECURITY to level 40 or 50, audit user profiles with QSYS2.USER_INFO, manage special authorities, enable QAUDJRN, secure network services, and implement RCAC in DB2 for i.',
            '_yoast_wpseo_focuskw'               => 'IBM i security hardening QSECURITY user profiles special authority QAUDJRN',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-security-hardening-qsecurity-user-profiles-special-authority-network-security-qsys2-security-views-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Security Hardening in 2026: QSECURITY, User Profile Auditing, Special Authority, QAUDJRN & RCAC',
            '_yoast_wpseo_opengraph-description' => 'Step-by-step IBM i security hardening: QSECURITY levels explained, QSYS2 audit queries, user profile lockdown, object authority, QAUDJRN journal entries, network security, and Row and Column Access Control.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Security Hardening 2026: QSECURITY, QAUDJRN, RCAC & More',
            '_yoast_wpseo_twitter-description'   => 'Practical IBM i security hardening guide covering QSECURITY levels, special authority auditing, QAUDJRN, network service hardening, and DB2 for i RCAC with working SQL examples.',
            '_aioseo_title'                      => 'IBM i Security Hardening 2026: QSECURITY Levels, User Profile Auditing, Special Authority & QAUDJRN',
            '_aioseo_description'                => 'Harden your IBM i system in 2026: set QSECURITY to level 40 or 50, audit user profiles with QSYS2.USER_INFO, manage special authorities, enable QAUDJRN, secure network services, and implement RCAC in DB2 for i.',
            '_aioseo_keywords'                   => 'IBM i security hardening, QSECURITY IBM i, IBM i user profile security, IBM i special authority, QAUDJRN IBM i, IBM i RCAC, IBM i network security 2026',
            '_aioseo_og_title'                   => 'IBM i Security Hardening in 2026: QSECURITY, User Profile Auditing, Special Authority, QAUDJRN & RCAC',
            '_aioseo_og_description'             => 'Step-by-step IBM i security hardening: QSECURITY levels explained, QSYS2 audit queries, user profile lockdown, object authority, QAUDJRN journal entries, network security, and Row and Column Access Control.',
            '_aioseo_twitter_title'              => 'IBM i Security Hardening 2026: QSECURITY, QAUDJRN, RCAC & More',
            '_aioseo_twitter_description'        => 'Practical IBM i security hardening guide covering QSECURITY levels, special authority auditing, QAUDJRN, network service hardening, and DB2 for i RCAC with working SQL examples.',
            'rank_math_focus_keyword'            => 'IBM i security hardening QSECURITY user profiles special authority QAUDJRN',
            'rank_math_description'              => 'Harden your IBM i system in 2026: set QSECURITY to level 40 or 50, audit user profiles with QSYS2.USER_INFO, manage special authorities, enable QAUDJRN, secure network services, and implement RCAC in DB2 for i.',
            'rank_math_title'                    => 'IBM i Security Hardening 2026: QSECURITY Levels, User Profile Auditing, Special Authority & QAUDJRN',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post47_use_classic', 10, 2);
function as400_post47_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post47', true) === '1') return false;
    return $use_block_editor;
}
