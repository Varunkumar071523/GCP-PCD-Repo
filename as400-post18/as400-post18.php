<?php
/**
 * Plugin Name: AS400 Decoded - Post 18 IBM i Observability
 * Description: Publishes Post 18 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post18_exists');
function as400_ensure_post18_exists() {

    // Check already published
    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post18',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-observability-collection-services-sql-monitoring-logging', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post18', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i monitoring',
        'Collection Services',
        'QSYS2',
        'IBM i performance',
        'IBM i observability',
        'IBM i logging',
        'Prometheus IBM i',
        'Grafana IBM i',
        'DB2 for i performance',
        'QSYS2 INDEX_ADVICE',
        'IBM i health check',
        'PASE logging',
        'IBM i SQL monitoring',
        'IBM i plan cache',
        'IBM i modernisation',
        'IBM i 2026',
        'IBM i Elasticsearch'
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
    $content = file_get_contents(dirname(__FILE__) . '/post18-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i Observability in 2026: Collection Services, QSYS2 Health Queries, Structured Logging, and Prometheus Dashboards',
        'post_name'    => 'ibm-i-observability-collection-services-sql-monitoring-logging',
        'post_content' => $content,
        'post_excerpt' => 'IBM i has collected detailed performance data for decades — most shops only look at it when something breaks. This post covers Collection Services, QSYS2 health views, DB2 plan cache analysis, structured logging with Pino, Prometheus metrics from PASE, and a practical starting order for adding real observability to any IBM i environment.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-22 08:00:00',
        'post_date_gmt' => '2026-05-22 02:30:00',
        'meta_input'   => array(

            // ── Internal marker ───────────────────
            '_as400_post18' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i Observability: Collection Services, QSYS2 Monitoring, and Structured Logging',
            '_yoast_wpseo_metadesc'      => 'How to add real observability to IBM i: Collection Services SQL queries, QSYS2 health views, DB2 index advice, structured Pino logging in PASE, Prometheus metrics, and Grafana dashboards.',
            '_yoast_wpseo_focuskw'       => 'IBM i observability Collection Services QSYS2 monitoring',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-observability-collection-services-sql-monitoring-logging/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Observability in 2026: From WRKACTJOB to Grafana Dashboards',
            '_yoast_wpseo_opengraph-description' => 'Collection Services, QSYS2 health views, DB2 plan cache, structured logging, Prometheus, and alerting — the complete IBM i observability stack.',
            '_yoast_wpseo_twitter-title'         => 'IBM i observability — Collection Services, QSYS2, and Grafana in 2026',
            '_yoast_wpseo_twitter-description'   => 'Stop waiting for users to report problems. Here is how to build a real IBM i observability stack using tools already on the system.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i Observability: Collection Services, QSYS2 Monitoring, and Structured Logging',
            '_aioseo_description'        => 'How to add real observability to IBM i: Collection Services SQL queries, QSYS2 health views, DB2 index advice, structured Pino logging in PASE, Prometheus metrics, and Grafana dashboards.',
            '_aioseo_keywords'           => 'IBM i observability,Collection Services IBM i,QSYS2 monitoring,IBM i performance SQL,IBM i logging PASE,Prometheus IBM i,Grafana IBM i,DB2 plan cache,QSYS2 INDEX_ADVICE',
            '_aioseo_og_title'           => 'IBM i Observability in 2026: From WRKACTJOB to Grafana Dashboards',
            '_aioseo_og_description'     => 'Collection Services, QSYS2 health views, DB2 plan cache, structured logging, Prometheus, and alerting — the complete IBM i observability stack.',
            '_aioseo_twitter_title'      => 'IBM i observability — Collection Services, QSYS2, and Grafana in 2026',
            '_aioseo_twitter_description'=> 'Stop waiting for users to report problems. Here is how to build a real IBM i observability stack using tools already on the system.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i observability Collection Services QSYS2 monitoring',
            'rank_math_description'      => 'How to add real observability to IBM i: Collection Services SQL queries, QSYS2 health views, DB2 index advice, structured Pino logging in PASE, Prometheus metrics, and Grafana dashboards.',
            'rank_math_title'            => 'IBM i Observability: Collection Services, QSYS2 Monitoring, and Structured Logging',

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
add_filter('use_block_editor_for_post', 'as400_post18_use_classic', 10, 2);
function as400_post18_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    $marker = get_post_meta($post->ID, '_as400_post18', true);
    if ($marker === '1') {
        return false;
    }
    return $use_block_editor;
}
