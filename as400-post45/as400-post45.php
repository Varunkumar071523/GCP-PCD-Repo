<?php
/**
 * Plugin Name: AS400 Decoded - Post 45 AI-Assisted Legacy Code Documentation on IBM i
 * Description: Publishes Post 45 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post45_exists');
function as400_ensure_post45_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post45',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ai-legacy-code-documentation-rpg-llm-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post45', '1', true);
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
        'IBM i AI documentation',
        'RPG code documentation AI',
        'IBM i legacy code AI',
        'IBM i LLM',
        'GPT-4 RPG documentation',
        'IBM i business rules extraction',
        'IBM i knowledge base AI',
        'IBM i code explanation AI',
        'RPG program documentation',
        'IBM i technical debt AI',
        'IBM i Claude AI',
        'IBM i Granite AI',
        'IBM i AI modernisation',
        'IBM i documentation automation',
        'IBM i code analysis AI',
        'IBM i 2026 AI',
        'IBM i AI tooling',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post45-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'AI-Assisted Legacy Code Documentation on IBM i in 2026: Using LLMs to Document RPG Programs, Extract Business Rules, and Build a Knowledge Base',
        'post_name'     => 'ibm-i-ai-legacy-code-documentation-rpg-llm-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A practical guide to using AI and large language models to document legacy IBM i RPG programs in 2026: extracting source code from IBM i, calling GPT-4o and IBM Granite via API, prompt engineering for RPG documentation, building a batch documentation pipeline, and creating a semantic search knowledge base over your entire IBM i codebase.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-18 08:00:00',
        'post_date_gmt' => '2026-06-18 02:30:00',
        'meta_input'    => array(
            '_as400_post45'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_yoast_wpseo_metadesc'              => 'Use AI to document IBM i RPG programs in 2026. Extract business rules with GPT-4o and IBM Granite, build a batch documentation pipeline, and create a semantic search knowledge base over your legacy IBM i codebase.',
            '_yoast_wpseo_focuskw'               => 'IBM i AI legacy code documentation RPG LLM GPT watsonx knowledge base',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ai-legacy-code-documentation-rpg-llm-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_yoast_wpseo_opengraph-description' => 'Practical guide to AI-assisted documentation for IBM i RPG programs: GPT-4o, IBM Granite, batch pipelines, vector search, and DDS data dictionary generation.',
            '_yoast_wpseo_twitter-title'         => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_yoast_wpseo_twitter-description'   => 'Practical AI documentation for IBM i RPG: GPT-4o, IBM Granite, batch pipelines, vector search, and DDS data dictionary generation.',
            '_aioseo_title'                      => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_aioseo_description'                => 'Use AI to document IBM i RPG programs in 2026. Extract business rules with GPT-4o and IBM Granite, build a batch documentation pipeline, and create a semantic search knowledge base over your legacy IBM i codebase.',
            '_aioseo_keywords'                   => 'IBM i AI documentation, RPG code documentation AI, IBM i LLM, GPT-4 RPG documentation, IBM i knowledge base AI, IBM i Granite AI, IBM i AI modernisation',
            '_aioseo_og_title'                   => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_aioseo_og_description'             => 'Practical guide to AI-assisted documentation for IBM i RPG programs: GPT-4o, IBM Granite, batch pipelines, vector search, and DDS data dictionary generation.',
            '_aioseo_twitter_title'              => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_aioseo_twitter_description'        => 'Practical AI documentation for IBM i RPG: GPT-4o, IBM Granite, batch pipelines, vector search, and DDS data dictionary generation.',
            'rank_math_focus_keyword'            => 'IBM i AI legacy code documentation RPG LLM GPT watsonx knowledge base',
            'rank_math_description'              => 'Use AI to document IBM i RPG programs in 2026. Extract business rules with GPT-4o and IBM Granite, build a batch documentation pipeline, and create a semantic search knowledge base over your legacy IBM i codebase.',
            'rank_math_title'                    => 'IBM i AI Legacy Code Documentation 2026: LLMs, GPT-4, Granite, and RPG Knowledge Base',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post45_use_classic', 10, 2);
function as400_post45_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post45', true) === '1') return false;
    return $use_block_editor;
}
