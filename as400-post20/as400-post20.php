<?php
/**
 * Plugin Name: AS400 Decoded - Post 20 CL Control Language
 * Description: Publishes Post 20 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post20_exists');
function as400_ensure_post20_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post20',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-cl-control-language-ile-cl-monmsg-batch-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post20', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'CL programming',
        'ILE CL',
        'Control Language IBM i',
        'MONMSG',
        'SBMJOB',
        'OVRDBF',
        'IBM i batch jobs',
        'library list IBM i',
        'RUNSQL CL',
        'CL subprocedures',
        'IBM i error handling',
        'RTVJOBA',
        'IBM i job stream',
        'IBM i DevOps CL',
        'IBM i modernisation',
        'IBM i 2026',
        'CL vs Python IBM i'
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
    $content = file_get_contents(dirname(__FILE__) . '/post20-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'CL in 2026: ILE Control Language, MONMSG Error Handling, Batch Orchestration, and Where CL Fits in a Modern IBM i Stack',
        'post_name'    => 'ibm-i-cl-control-language-ile-cl-monmsg-batch-2026',
        'post_content' => $content,
        'post_excerpt' => 'CL is not a legacy language waiting to be replaced — it is the correct tool for controlling the IBM i environment. This post covers ILE CL structure, MONMSG error handling, library list management, OVRDBF, SBMJOB, SQL from CL, subprocedures, DevOps pipeline integration, and when to use CL versus Python or shell scripts.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-24 08:00:00',
        'post_date_gmt' => '2026-05-24 02:30:00',
        'meta_input'   => array(
            '_as400_post20' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i CL in 2026: ILE Control Language, MONMSG, Batch Jobs and Modern Patterns',
            '_yoast_wpseo_metadesc'      => 'A modern guide to IBM i Control Language: ILE CL structure, MONMSG error handling, library list management, OVRDBF file overrides, SBMJOB, RUNSQL, subprocedures, and CL in a DevOps pipeline.',
            '_yoast_wpseo_focuskw'       => 'IBM i CL Control Language ILE CL MONMSG',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-cl-control-language-ile-cl-monmsg-batch-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i CL in 2026: ILE Control Language Done Right',
            '_yoast_wpseo_opengraph-description' => 'ILE CL, MONMSG, SBMJOB, OVRDBF, RUNSQL, subprocedures, and DevOps pipeline integration — everything CL is actually for on a modern IBM i.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Control Language in 2026 — ILE CL patterns that actually work',
            '_yoast_wpseo_twitter-description'   => 'MONMSG, library lists, OVRDBF, SBMJOB, RUNSQL, subprocedures. What modern ILE CL looks like and where it fits in a 2026 IBM i stack.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i CL in 2026: ILE Control Language, MONMSG, Batch Jobs and Modern Patterns',
            '_aioseo_description'        => 'A modern guide to IBM i Control Language: ILE CL structure, MONMSG error handling, library list management, OVRDBF file overrides, SBMJOB, RUNSQL, subprocedures, and CL in a DevOps pipeline.',
            '_aioseo_keywords'           => 'IBM i CL programming,ILE CL,Control Language IBM i,MONMSG IBM i,SBMJOB CL,OVRDBF,library list CL,RUNSQL CL,CL subprocedures,IBM i batch orchestration',
            '_aioseo_og_title'           => 'IBM i CL in 2026: ILE Control Language Done Right',
            '_aioseo_og_description'     => 'ILE CL, MONMSG, SBMJOB, OVRDBF, RUNSQL, subprocedures, and DevOps pipeline integration — everything CL is actually for on a modern IBM i.',
            '_aioseo_twitter_title'      => 'IBM i Control Language in 2026 — ILE CL patterns that actually work',
            '_aioseo_twitter_description'=> 'MONMSG, library lists, OVRDBF, SBMJOB, RUNSQL, subprocedures. What modern ILE CL looks like and where it fits in a 2026 IBM i stack.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i CL Control Language ILE CL MONMSG',
            'rank_math_description'      => 'A modern guide to IBM i Control Language: ILE CL structure, MONMSG error handling, library list management, OVRDBF file overrides, SBMJOB, RUNSQL, subprocedures, and CL in a DevOps pipeline.',
            'rank_math_title'            => 'IBM i CL in 2026: ILE Control Language, MONMSG, Batch Jobs and Modern Patterns',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post20_use_classic', 10, 2);
function as400_post20_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post20', true) === '1') return false;
    return $use_block_editor;
}
