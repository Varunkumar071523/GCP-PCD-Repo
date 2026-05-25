<?php
/**
 * Plugin Name: AS400 Decoded - Post 53 IBM Merlin and VS Code for IBM i Development
 * Description: Publishes Post 53 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post53_exists');
function as400_ensure_post53_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post53',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-merlin-vscode-rpg-cl-git-modern-developer-tools-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post53', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM Merlin',
        'IBM i VS Code',
        'IBM i VS Code extension',
        'Code for IBM i',
        'IBM i RPG VS Code',
        'IBM i modern IDE',
        'IBM i Git VS Code',
        'IBM i developer tools',
        'IBM i source editing VS Code',
        'IBM i ARCAD',
        'IBM i RDi',
        'IBM i VS Code 2026',
        'IBM i developer workstation',
        'IBM i open source IDE',
        'IBM Merlin 2026',
        'IBM i VS Code lint',
        'IBM i modern development',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post53-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM Merlin and VS Code for IBM i Development in 2026: Modern IDE Setup, RPG and CL Editing, Git Integration, and the IBM i Developer Workstation',
        'post_name'     => 'ibm-i-merlin-vscode-rpg-cl-git-modern-developer-tools-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Set up a modern IBM i development environment in 2026: install the Code for IBM i VS Code extension, edit RPG and CL source with syntax highlighting and inline errors, integrate Git for source control, define custom build actions, and use GitHub Copilot and IBM Merlin for AI-assisted RPG coding.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-26 08:00:00',
        'post_date_gmt' => '2026-06-26 02:30:00',
        'meta_input'    => array(
            '_as400_post53'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM Merlin and VS Code for IBM i Development 2026: RPG CL Git Modern IDE Setup',
            '_yoast_wpseo_metadesc'              => 'Build a modern IBM i development workstation in 2026 with VS Code, Code for IBM i, IBM Merlin, Git integration, custom build actions, and GitHub Copilot for RPG and CL source editing.',
            '_yoast_wpseo_focuskw'               => 'IBM Merlin VS Code IBM i RPG CL Git modern developer tools 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-merlin-vscode-rpg-cl-git-modern-developer-tools-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM Merlin and VS Code for IBM i Development in 2026: Modern IDE, RPG, CL, Git',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to the modern IBM i developer workstation in 2026: VS Code with Code for IBM i, IBM Merlin, Git source control, custom actions, and AI coding assistance for RPG and CL.',
            '_yoast_wpseo_twitter-title'         => 'IBM Merlin + VS Code for IBM i in 2026: RPG, CL, Git, AI Coding',
            '_yoast_wpseo_twitter-description'   => 'Set up the modern IBM i developer workstation in 2026 with VS Code, Code for IBM i extension, IBM Merlin, Git, and GitHub Copilot for RPG development.',
            '_aioseo_title'                      => 'IBM Merlin and VS Code for IBM i Development 2026: RPG CL Git Modern IDE Setup',
            '_aioseo_description'                => 'Build a modern IBM i development workstation in 2026 with VS Code, Code for IBM i, IBM Merlin, Git integration, custom build actions, and GitHub Copilot for RPG and CL source editing.',
            '_aioseo_keywords'                   => 'IBM Merlin, IBM i VS Code, Code for IBM i, IBM i RPG VS Code, IBM i Git VS Code, IBM i modern IDE, IBM i developer workstation 2026',
            '_aioseo_og_title'                   => 'IBM Merlin and VS Code for IBM i Development in 2026: Modern IDE, RPG, CL, Git',
            '_aioseo_og_description'             => 'Complete guide to the modern IBM i developer workstation in 2026: VS Code with Code for IBM i, IBM Merlin, Git source control, custom actions, and AI coding assistance for RPG and CL.',
            '_aioseo_twitter_title'              => 'IBM Merlin + VS Code for IBM i in 2026: RPG, CL, Git, AI Coding',
            '_aioseo_twitter_description'        => 'Set up the modern IBM i developer workstation in 2026 with VS Code, Code for IBM i extension, IBM Merlin, Git, and GitHub Copilot for RPG development.',
            'rank_math_focus_keyword'            => 'IBM Merlin VS Code IBM i RPG CL Git modern developer tools 2026',
            'rank_math_description'              => 'Build a modern IBM i development workstation in 2026 with VS Code, Code for IBM i, IBM Merlin, Git integration, custom build actions, and GitHub Copilot for RPG and CL source editing.',
            'rank_math_title'                    => 'IBM Merlin and VS Code for IBM i Development 2026: RPG CL Git Modern IDE Setup',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post53_use_classic', 10, 2);
function as400_post53_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post53', true) === '1') return false;
    return $use_block_editor;
}
