<?php
/**
 * Plugin Name: AS400 Decoded - Post 80 AI Anomaly Detection on IBM i
 * Description: Publishes Post 80 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post80_exists');
function as400_ensure_post80_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post80',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ai-anomaly-detection-ibm-i-operational-data-db2-python-pase-alerting-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post80', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'AI anomaly detection IBM i',
        'IBM i operational data analytics',
        'IBM i Python PASE anomaly',
        'DB2 for i anomaly detection SQL',
        'IBM i statistical baseline',
        'IBM i Python scikit-learn',
        'IBM i PASE Python machine learning',
        'IBM i job performance anomaly',
        'IBM i DB2 time series analysis',
        'IBM i alerting automation',
        'IBM i Python isolation forest',
        'AI IBM i 2026',
        'IBM i PASE Python pandas',
        'IBM i operational monitoring AI',
        'IBM i Python anomaly alerting',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post80-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'AI-Driven Anomaly Detection on IBM i Operational Data: DB2 Statistical Baselines, Python in PASE, Isolation Forest, and Automated Alerting in 2026',
        'post_name'     => 'ai-anomaly-detection-ibm-i-operational-data-db2-python-pase-alerting-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Build AI-driven anomaly detection for IBM i operational data in 2026: query QSYS2 system views for job and performance metrics, establish DB2 statistical baselines with SQL window functions, install Python and scikit-learn in PASE, train an Isolation Forest model on historical IBM i data, detect real-time anomalies, and trigger automated alerts via email or data queue when anomalies are found.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-23 08:00:00',
        'post_date_gmt' => '2026-07-23 02:30:00',
        'meta_input'    => array(
            '_as400_post80'                      => '1',
            '_yoast_wpseo_title'                 => 'AI Anomaly Detection IBM i 2026: DB2 Baselines Python PASE Isolation Forest',
            '_yoast_wpseo_metadesc'              => 'Build AI-driven anomaly detection for IBM i in 2026: QSYS2 operational data, DB2 SQL baselines, Python PASE with scikit-learn Isolation Forest, real-time detection, and automated alerting.',
            '_yoast_wpseo_focuskw'               => 'AI anomaly detection IBM i operational data DB2 Python PASE Isolation Forest 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ai-anomaly-detection-ibm-i-operational-data-db2-python-pase-alerting-2026/',
            '_yoast_wpseo_opengraph-title'       => 'AI Anomaly Detection on IBM i 2026: DB2 Baselines, Python PASE, Isolation Forest',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to AI-driven anomaly detection on IBM i: QSYS2 operational metrics, DB2 SQL statistical baselines, Python + scikit-learn Isolation Forest in PASE, real-time detection pipeline, and automated email/data queue alerts.',
            '_yoast_wpseo_twitter-title'         => 'AI Anomaly Detection on IBM i 2026: DB2 Baselines, Python PASE',
            '_yoast_wpseo_twitter-description'   => 'AI-driven anomaly detection on IBM i: DB2 statistical baselines, Python PASE with Isolation Forest, real-time detection, and automated alerting in 2026.',
            '_aioseo_title'                      => 'AI Anomaly Detection IBM i 2026: DB2 Baselines Python PASE Isolation Forest',
            '_aioseo_description'                => 'Build AI-driven anomaly detection for IBM i in 2026: QSYS2 operational data, DB2 SQL baselines, Python PASE with scikit-learn Isolation Forest, real-time detection, and automated alerting.',
            '_aioseo_keywords'                   => 'AI anomaly detection IBM i, IBM i Python PASE anomaly, DB2 for i statistical baseline, IBM i scikit-learn, IBM i Isolation Forest 2026',
            '_aioseo_og_title'                   => 'AI Anomaly Detection on IBM i 2026: DB2 Baselines, Python PASE, Isolation Forest',
            '_aioseo_og_description'             => 'Complete guide to AI-driven anomaly detection on IBM i: QSYS2 operational metrics, DB2 SQL statistical baselines, Python + scikit-learn Isolation Forest in PASE, real-time detection pipeline, and automated email/data queue alerts.',
            '_aioseo_twitter_title'              => 'AI Anomaly Detection on IBM i 2026: DB2 Baselines, Python PASE',
            '_aioseo_twitter_description'        => 'AI-driven anomaly detection on IBM i: DB2 statistical baselines, Python PASE with Isolation Forest, real-time detection, and automated alerting in 2026.',
            'rank_math_focus_keyword'            => 'AI anomaly detection IBM i operational data DB2 Python PASE Isolation Forest 2026',
            'rank_math_description'              => 'Build AI-driven anomaly detection for IBM i in 2026: QSYS2 operational data, DB2 SQL baselines, Python PASE with scikit-learn Isolation Forest, real-time detection, and automated alerting.',
            'rank_math_title'                    => 'AI Anomaly Detection IBM i 2026: DB2 Baselines Python PASE Isolation Forest',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post80_use_classic', 10, 2);
function as400_post80_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post80', true) === '1') return false;
    return $use_block_editor;
}
