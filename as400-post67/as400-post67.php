<?php
/**
 * Plugin Name: AS400 Decoded - Post 67 IBM watsonx on Power for IBM i
 * Description: Publishes Post 67 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post67_exists');
function as400_ensure_post67_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post67',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-watsonx-power-ibm-i-ai-inference-granite-models-rpg-python-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post67', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM watsonx on Power',
        'IBM i AI inference',
        'IBM watsonx.ai IBM i',
        'IBM Granite models IBM i',
        'IBM i AI integration 2026',
        'watsonx RPG integration',
        'IBM i Python AI PASE',
        'IBM i machine learning',
        'IBM watsonx 2026',
        'IBM i AI REST API',
        'IBM Granite model inference',
        'IBM i PASE AI workload',
        'IBM i LLM inference',
        'IBM i watsonx API call',
        'IBM i watsonx.governance',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post67-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM watsonx on Power for IBM i: AI Inference Near Your Data, Granite Models, RPG and Python Integration in 2026',
        'post_name'     => 'ibm-watsonx-power-ibm-i-ai-inference-granite-models-rpg-python-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Bring AI inference to IBM i in 2026 with IBM watsonx on Power: deploy Granite foundation models co-located with your DB2 data, call watsonx REST APIs from RPG using HTTPAPI, integrate Python-based inference pipelines in PASE, implement document classification and anomaly detection use cases, and govern production AI with watsonx.governance.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-10 08:00:00',
        'post_date_gmt' => '2026-07-10 02:30:00',
        'meta_input'    => array(
            '_as400_post67'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM watsonx on Power for IBM i 2026: AI Inference, Granite, RPG, Python',
            '_yoast_wpseo_metadesc'              => 'Deploy watsonx on IBM Power near IBM i data in 2026: Granite model inference, REST API calls from RPG, Python AI pipelines in PASE, document classification, anomaly detection, and watsonx.governance.',
            '_yoast_wpseo_focuskw'               => 'IBM watsonx Power IBM i AI inference Granite models RPG Python 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-watsonx-power-ibm-i-ai-inference-granite-models-rpg-python-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM watsonx on Power for IBM i 2026: AI Inference, Granite Models, RPG, Python',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM watsonx on Power for IBM i: architecture, Granite model deployment, REST API calls from RPG, Python inference in PASE, document classification, log anomaly detection, and watsonx.governance.',
            '_yoast_wpseo_twitter-title'         => 'IBM watsonx on Power for IBM i 2026: Granite AI, RPG, Python',
            '_yoast_wpseo_twitter-description'   => 'Deploy watsonx on Power near IBM i data: Granite models, REST API from RPG, Python AI in PASE, document classification, anomaly detection, and watsonx.governance in 2026.',
            '_aioseo_title'                      => 'IBM watsonx on Power for IBM i 2026: AI Inference, Granite, RPG, Python',
            '_aioseo_description'                => 'Deploy watsonx on IBM Power near IBM i data in 2026: Granite model inference, REST API calls from RPG, Python AI pipelines in PASE, document classification, anomaly detection, and watsonx.governance.',
            '_aioseo_keywords'                   => 'IBM watsonx on Power, IBM i AI inference, IBM Granite models, IBM watsonx.ai IBM i, IBM i Python AI, IBM i watsonx 2026',
            '_aioseo_og_title'                   => 'IBM watsonx on Power for IBM i 2026: AI Inference, Granite Models, RPG, Python',
            '_aioseo_og_description'             => 'Complete guide to IBM watsonx on Power for IBM i: architecture, Granite model deployment, REST API calls from RPG, Python inference in PASE, document classification, log anomaly detection, and watsonx.governance.',
            '_aioseo_twitter_title'              => 'IBM watsonx on Power for IBM i 2026: Granite AI, RPG, Python',
            '_aioseo_twitter_description'        => 'Deploy watsonx on Power near IBM i data: Granite models, REST API from RPG, Python AI in PASE, document classification, anomaly detection, and watsonx.governance in 2026.',
            'rank_math_focus_keyword'            => 'IBM watsonx Power IBM i AI inference Granite models RPG Python 2026',
            'rank_math_description'              => 'Deploy watsonx on IBM Power near IBM i data in 2026: Granite model inference, REST API calls from RPG, Python AI pipelines in PASE, document classification, anomaly detection, and watsonx.governance.',
            'rank_math_title'                    => 'IBM watsonx on Power for IBM i 2026: AI Inference, Granite, RPG, Python',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post67_use_classic', 10, 2);
function as400_post67_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post67', true) === '1') return false;
    return $use_block_editor;
}
