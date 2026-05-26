<?php
/**
 * Plugin Name: AS400 Decoded - Post 59 AI-Assisted RPG Modernization
 * Description: Publishes Post 59 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post59_exists');
function as400_ensure_post59_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post59',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ai-rpg-modernization-fixed-format-free-format-llm-cvtrpgsrc-watsonx-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post59', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i AI RPG modernization',
        'IBM i fixed format RPG free format',
        'IBM i CVTRPGSRC',
        'IBM i RPG modernization AI',
        'IBM i watsonx Code Assistant',
        'IBM i LLM RPG',
        'IBM i RPG AI refactoring',
        'IBM i RPG code explanation LLM',
        'IBM i Merlin RPG converter',
        'IBM i ChatGPT RPG',
        'IBM i RPG test generation AI',
        'IBM i fixed format RPG conversion 2026',
        'IBM i RPG free format modernization',
        'IBM i AI code review RPG',
        'IBM i RPG legacy modernization',
        'IBM i modernization 2026',
        'IBM i AI developer tools',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post59-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'AI-Assisted RPG Modernization on IBM i in 2026: CVTRPGSRC, IBM Merlin Converter, LLM Code Explanation, Automated Refactoring, and AI-Generated RPG Tests',
        'post_name'     => 'ibm-i-ai-rpg-modernization-fixed-format-free-format-llm-cvtrpgsrc-watsonx-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Modernize fixed-format RPG on IBM i using AI tools in 2026: convert with CVTRPGSRC and IBM Merlin, use LLMs like watsonx Code Assistant and GitHub Copilot to explain and refactor legacy RPG, generate unit tests with AI assistance, and follow the practical workflow from fixed-format to free-format service programs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-02 08:00:00',
        'post_date_gmt' => '2026-07-02 02:30:00',
        'meta_input'    => array(
            '_as400_post59'                      => '1',
            '_yoast_wpseo_title'                 => 'AI-Assisted RPG Modernization IBM i 2026: CVTRPGSRC, Merlin, LLM Refactoring, AI Tests',
            '_yoast_wpseo_metadesc'              => 'Modernize IBM i RPG with AI in 2026: CVTRPGSRC conversion, Merlin free-format converter, LLM code explanation, watsonx Code Assistant, AI test generation, and modernization workflow.',
            '_yoast_wpseo_focuskw'               => 'IBM i AI RPG modernization fixed format free format LLM CVTRPGSRC watsonx 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ai-rpg-modernization-fixed-format-free-format-llm-cvtrpgsrc-watsonx-2026/',
            '_yoast_wpseo_opengraph-title'       => 'AI-Assisted RPG Modernization IBM i 2026: CVTRPGSRC, Merlin, LLM, Tests',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to AI-assisted RPG modernization: CVTRPGSRC, IBM Merlin converter, LLM code explanation, watsonx Code Assistant, AI test generation, and the full modernization workflow.',
            '_yoast_wpseo_twitter-title'         => 'AI-Assisted RPG Modernization 2026: CVTRPGSRC, LLM, watsonx, Tests',
            '_yoast_wpseo_twitter-description'   => 'Modernize IBM i RPG with AI: CVTRPGSRC, Merlin converter, LLM code explanation, automated refactoring, and AI-generated unit tests.',
            '_aioseo_title'                      => 'AI-Assisted RPG Modernization IBM i 2026: CVTRPGSRC, Merlin, LLM Refactoring, AI Tests',
            '_aioseo_description'                => 'Modernize IBM i RPG with AI in 2026: CVTRPGSRC conversion, Merlin free-format converter, LLM code explanation, watsonx Code Assistant, AI test generation, and modernization workflow.',
            '_aioseo_keywords'                   => 'IBM i AI RPG modernization, IBM i CVTRPGSRC, IBM i fixed format free format, IBM i watsonx Code Assistant, IBM i LLM RPG, IBM i AI test generation 2026',
            '_aioseo_og_title'                   => 'AI-Assisted RPG Modernization IBM i 2026: CVTRPGSRC, Merlin, LLM, Tests',
            '_aioseo_og_description'             => 'Complete guide to AI-assisted RPG modernization: CVTRPGSRC, IBM Merlin converter, LLM code explanation, watsonx Code Assistant, AI test generation, and the full modernization workflow.',
            '_aioseo_twitter_title'              => 'AI-Assisted RPG Modernization 2026: CVTRPGSRC, LLM, watsonx, Tests',
            '_aioseo_twitter_description'        => 'Modernize IBM i RPG with AI: CVTRPGSRC, Merlin converter, LLM code explanation, automated refactoring, and AI-generated unit tests.',
            'rank_math_focus_keyword'            => 'IBM i AI RPG modernization fixed format free format LLM CVTRPGSRC watsonx 2026',
            'rank_math_description'              => 'Modernize IBM i RPG with AI in 2026: CVTRPGSRC conversion, Merlin free-format converter, LLM code explanation, watsonx Code Assistant, AI test generation, and modernization workflow.',
            'rank_math_title'                    => 'AI-Assisted RPG Modernization IBM i 2026: CVTRPGSRC, Merlin, LLM Refactoring, AI Tests',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post59_use_classic', 10, 2);
function as400_post59_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post59', true) === '1') return false;
    return $use_block_editor;
}
