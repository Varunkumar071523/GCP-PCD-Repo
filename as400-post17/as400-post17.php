<?php
/**
 * Plugin Name: AS400 Decoded - Post 17 IBM i DevOps Pipeline
 * Description: Publishes Post 17 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post17_exists');
function as400_ensure_post17_exists() {

    // Check already published
    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post17',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-devops-pipeline-git-bob-ci-cd-rpgunit', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post17', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i DevOps',
        'Git IBM i',
        'Bob IBM i',
        'makei',
        'RPGUnit',
        'IBM i CI CD',
        'PASE',
        'IBM i build automation',
        'GitHub Actions IBM i',
        'Azure DevOps IBM i',
        'IBM i source control',
        'IFS source files',
        'IBM i pipeline',
        'IBM i modernisation',
        'IBM i 2026',
        'CPYTOSTMF',
        'IBM i open source'
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
    $content = file_get_contents(dirname(__FILE__) . '/post17-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i in a DevOps Pipeline: Git, Bob, Automated Builds, and CI/CD for RPG in 2026',
        'post_name'    => 'ibm-i-devops-pipeline-git-bob-ci-cd-rpgunit',
        'post_content' => $content,
        'post_excerpt' => 'IBM i DevOps is not theoretical — Git, Bob, RPGUnit, and GitHub Actions all run on IBM i 7.3+. This post covers moving source to the IFS, automated builds with Bob, CI pipelines via GitHub Actions and Azure DevOps, RPGUnit testing, and a step-by-step progression from manual releases to a working pipeline.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-21 08:00:00',
        'post_date_gmt' => '2026-05-21 02:30:00',
        'meta_input'   => array(

            // ── Internal marker ───────────────────
            '_as400_post17' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i DevOps Pipeline: Git, Bob, CI/CD and Automated Builds for RPG',
            '_yoast_wpseo_metadesc'      => 'How to build a real CI/CD pipeline for IBM i: Git in PASE, Bob for automated RPG builds, GitHub Actions and Azure DevOps integration, RPGUnit testing, and library promotion to production.',
            '_yoast_wpseo_focuskw'       => 'IBM i DevOps pipeline Git Bob CI CD',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-devops-pipeline-git-bob-ci-cd-rpgunit/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i DevOps in 2026: Git, Bob, and a Real CI/CD Pipeline for RPG',
            '_yoast_wpseo_opengraph-description' => 'Git, Bob, RPGUnit, GitHub Actions, Azure DevOps — everything you need to move IBM i from manual releases to automated pipelines.',
            '_yoast_wpseo_twitter-title'         => 'IBM i DevOps — Git, Bob, and CI/CD for RPG in 2026',
            '_yoast_wpseo_twitter-description'   => 'The full IBM i DevOps stack: Git in PASE, Bob builds, RPGUnit tests, GitHub Actions pipelines, and staged deployment to production.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i DevOps Pipeline: Git, Bob, CI/CD and Automated Builds for RPG',
            '_aioseo_description'        => 'How to build a real CI/CD pipeline for IBM i: Git in PASE, Bob for automated RPG builds, GitHub Actions and Azure DevOps integration, RPGUnit testing, and library promotion to production.',
            '_aioseo_keywords'           => 'IBM i DevOps,Git IBM i,Bob IBM i build,makei,RPGUnit,IBM i CI CD,GitHub Actions IBM i,Azure DevOps IBM i,IBM i pipeline,IFS source control',
            '_aioseo_og_title'           => 'IBM i DevOps in 2026: Git, Bob, and a Real CI/CD Pipeline for RPG',
            '_aioseo_og_description'     => 'Git, Bob, RPGUnit, GitHub Actions, Azure DevOps — everything you need to move IBM i from manual releases to automated pipelines.',
            '_aioseo_twitter_title'      => 'IBM i DevOps — Git, Bob, and CI/CD for RPG in 2026',
            '_aioseo_twitter_description'=> 'The full IBM i DevOps stack: Git in PASE, Bob builds, RPGUnit tests, GitHub Actions pipelines, and staged deployment to production.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i DevOps pipeline Git Bob CI CD',
            'rank_math_description'      => 'How to build a real CI/CD pipeline for IBM i: Git in PASE, Bob for automated RPG builds, GitHub Actions and Azure DevOps integration, RPGUnit testing, and library promotion to production.',
            'rank_math_title'            => 'IBM i DevOps Pipeline: Git, Bob, CI/CD and Automated Builds for RPG',

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
add_filter('use_block_editor_for_post', 'as400_post17_use_classic', 10, 2);
function as400_post17_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    $marker = get_post_meta($post->ID, '_as400_post17', true);
    if ($marker === '1') {
        return false;
    }
    return $use_block_editor;
}
