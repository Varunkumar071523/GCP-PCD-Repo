<?php
/**
 * Plugin Name: AS400 Decoded - Post 54 IBM i PASE Deep Dive
 * Description: Publishes Post 54 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post54_exists');
function as400_ensure_post54_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post54',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-pase-deep-dive-aix-binary-qshell-environment-process-management-ile-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post54', '1', true);
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
        'IBM i PASE',
        'IBM i PASE runtime',
        'IBM i AIX binary compatibility',
        'IBM i PASE vs QShell',
        'IBM i QShell',
        'IBM i PASE environment variables',
        'IBM i PASE process management',
        'IBM i shared libraries PASE',
        'IBM i yum package manager',
        'IBM i PASE ILE integration',
        'IBM i STRPASE',
        'IBM i PASE Node.js',
        'IBM i PASE Python',
        'IBM i PASE shell scripting',
        'IBM i open source PASE',
        'IBM i PASE 2026',
        'IBM i PASE SSH',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post54-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i PASE Deep Dive: AIX Binary Compatibility, PASE vs QShell, Environment Variables, Process Management, and ILE Integration in 2026',
        'post_name'     => 'ibm-i-pase-deep-dive-aix-binary-qshell-environment-process-management-ile-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Understand the IBM i PASE runtime in depth: AIX binary compatibility, how PASE differs from QShell, managing environment variables, PASE process lifecycle, shared library loading with LD_LIBRARY_PATH, yum package management, and how PASE integrates with the ILE job structure and activation groups on IBM i in 2026.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-27 08:00:00',
        'post_date_gmt' => '2026-06-27 02:30:00',
        'meta_input'    => array(
            '_as400_post54'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i PASE Deep Dive 2026: AIX Binary Compatibility, QShell, Process Management, ILE Integration',
            '_yoast_wpseo_metadesc'              => 'Deep dive into the IBM i PASE runtime: AIX binary compatibility, PASE vs QShell differences, environment variables, process management, shared libraries, yum, and ILE integration.',
            '_yoast_wpseo_focuskw'               => 'IBM i PASE deep dive AIX binary QShell environment process management ILE 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-pase-deep-dive-aix-binary-qshell-environment-process-management-ile-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i PASE Deep Dive 2026: AIX Binary, QShell, Process Management, ILE',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to the IBM i PASE runtime in 2026: AIX compatibility, PASE vs QShell, environment variables, process management, shared libraries, yum packages, and ILE integration.',
            '_yoast_wpseo_twitter-title'         => 'IBM i PASE Deep Dive 2026: AIX Binary, QShell, Process Management',
            '_yoast_wpseo_twitter-description'   => 'Understand IBM i PASE in depth: AIX binary compatibility, PASE vs QShell, env vars, process lifecycle, shared libraries, and how PASE talks to ILE.',
            '_aioseo_title'                      => 'IBM i PASE Deep Dive 2026: AIX Binary Compatibility, QShell, Process Management, ILE Integration',
            '_aioseo_description'                => 'Deep dive into the IBM i PASE runtime: AIX binary compatibility, PASE vs QShell differences, environment variables, process management, shared libraries, yum, and ILE integration.',
            '_aioseo_keywords'                   => 'IBM i PASE, IBM i PASE runtime, IBM i AIX binary, IBM i PASE vs QShell, IBM i PASE process management, IBM i yum, IBM i PASE ILE 2026',
            '_aioseo_og_title'                   => 'IBM i PASE Deep Dive 2026: AIX Binary, QShell, Process Management, ILE',
            '_aioseo_og_description'             => 'Complete guide to the IBM i PASE runtime in 2026: AIX compatibility, PASE vs QShell, environment variables, process management, shared libraries, yum packages, and ILE integration.',
            '_aioseo_twitter_title'              => 'IBM i PASE Deep Dive 2026: AIX Binary, QShell, Process Management',
            '_aioseo_twitter_description'        => 'Understand IBM i PASE in depth: AIX binary compatibility, PASE vs QShell, env vars, process lifecycle, shared libraries, and how PASE talks to ILE.',
            'rank_math_focus_keyword'            => 'IBM i PASE deep dive AIX binary QShell environment process management ILE 2026',
            'rank_math_description'              => 'Deep dive into the IBM i PASE runtime: AIX binary compatibility, PASE vs QShell differences, environment variables, process management, shared libraries, yum, and ILE integration.',
            'rank_math_title'                    => 'IBM i PASE Deep Dive 2026: AIX Binary Compatibility, QShell, Process Management, ILE Integration',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post54_use_classic', 10, 2);
function as400_post54_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post54', true) === '1') return false;
    return $use_block_editor;
}
