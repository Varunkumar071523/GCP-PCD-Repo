<?php
/**
 * Plugin Name: AS400 Decoded - Post 25 AI for IBM i
 * Description: Publishes Post 25 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post25_exists');
function as400_ensure_post25_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post25',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ai-integration-watsonx-openai-rpg-sql-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post25', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'AI for IBM i',
        'watsonx IBM i',
        'OpenAI IBM i',
        'RPG AI integration',
        'IBM i HTTP_POST SQL',
        'QSYS2 HTTP functions',
        'JSON_VALUE DB2 for i',
        'IBM i modernisation AI',
        'IBM Merlin',
        'LLM IBM i',
        'AI-assisted RPG',
        'IBM i REST API AI',
        'watsonx.ai IBM i',
        'IBM i batch AI',
        'fixed-format RPG conversion',
        'IBM i 2026',
        'IBM i AI integration'
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
    $content = file_get_contents(dirname(__FILE__) . '/post25-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'AI for IBM i in 2026: Calling AI APIs from RPG and SQL, Integrating watsonx, and What AI Can Realistically Do for IBM i Modernisation',
        'post_name'    => 'ibm-i-ai-integration-watsonx-openai-rpg-sql-2026',
        'post_content' => $content,
        'post_excerpt' => 'AI intersects with IBM i in three ways: as an integration target (calling OpenAI or watsonx from RPG and SQL programs), as a development tool (using AI assistants to explain and modernise legacy RPG), and as a data platform feature (watsonx.data federating IBM i and cloud data). This post covers QSYS2 HTTP_POST for calling AI APIs directly from SQL, embedded SQL in SQLRPGLE for AI integration, JSON_VALUE for parsing responses, watsonx.ai Granite models, IBM Merlin, and a complete batch AI classification example.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-29 08:00:00',
        'post_date_gmt' => '2026-05-29 02:30:00',
        'meta_input'   => array(
            '_as400_post25' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'AI for IBM i in 2026: Calling AI APIs from RPG, watsonx Integration and Modernisation',
            '_yoast_wpseo_metadesc'      => 'How to call OpenAI and watsonx AI APIs directly from IBM i using QSYS2.HTTP_POST in SQL and SQLRPGLE, parse JSON responses with JSON_VALUE, build batch AI classification jobs, use IBM Merlin, and what AI assistants can realistically do for RPG modernisation.',
            '_yoast_wpseo_focuskw'       => 'AI for IBM i watsonx OpenAI RPG SQL QSYS2 HTTP_POST',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-ai-integration-watsonx-openai-rpg-sql-2026/',
            '_yoast_wpseo_opengraph-title'       => 'AI for IBM i in 2026: Calling AI APIs from RPG and SQL',
            '_yoast_wpseo_opengraph-description' => 'QSYS2.HTTP_POST, JSON_VALUE, watsonx.ai, IBM Merlin, and AI-assisted RPG modernisation — what AI for IBM i actually looks like in production in 2026.',
            '_yoast_wpseo_twitter-title'         => 'AI for IBM i in 2026 — calling OpenAI and watsonx directly from RPG and SQL',
            '_yoast_wpseo_twitter-description'   => 'No middleware needed. QSYS2.HTTP_POST lets IBM i call any AI API directly from SQL. Here is how to build batch AI workflows on IBM i.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'AI for IBM i in 2026: Calling AI APIs from RPG, watsonx Integration and Modernisation',
            '_aioseo_description'        => 'How to call OpenAI and watsonx AI APIs directly from IBM i using QSYS2.HTTP_POST in SQL and SQLRPGLE, parse JSON responses with JSON_VALUE, build batch AI classification jobs, use IBM Merlin, and what AI assistants can realistically do for RPG modernisation.',
            '_aioseo_keywords'           => 'AI for IBM i,watsonx IBM i,OpenAI IBM i,QSYS2 HTTP_POST,JSON_VALUE DB2 for i,IBM Merlin,RPG AI integration,IBM i modernisation AI,LLM IBM i,IBM i batch AI',
            '_aioseo_og_title'           => 'AI for IBM i in 2026: Calling AI APIs from RPG and SQL',
            '_aioseo_og_description'     => 'QSYS2.HTTP_POST, JSON_VALUE, watsonx.ai, IBM Merlin, and AI-assisted RPG modernisation — what AI for IBM i actually looks like in production in 2026.',
            '_aioseo_twitter_title'      => 'AI for IBM i in 2026 — calling OpenAI and watsonx directly from RPG and SQL',
            '_aioseo_twitter_description'=> 'No middleware needed. QSYS2.HTTP_POST lets IBM i call any AI API directly from SQL. Here is how to build batch AI workflows on IBM i.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'AI for IBM i watsonx OpenAI RPG SQL QSYS2 HTTP_POST',
            'rank_math_description'      => 'How to call OpenAI and watsonx AI APIs directly from IBM i using QSYS2.HTTP_POST in SQL and SQLRPGLE, parse JSON responses with JSON_VALUE, build batch AI classification jobs, use IBM Merlin, and what AI assistants can realistically do for RPG modernisation.',
            'rank_math_title'            => 'AI for IBM i in 2026: Calling AI APIs from RPG, watsonx Integration and Modernisation',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post25_use_classic', 10, 2);
function as400_post25_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post25', true) === '1') return false;
    return $use_block_editor;
}
