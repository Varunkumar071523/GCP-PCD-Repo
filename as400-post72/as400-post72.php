<?php
/**
 * Plugin Name: AS400 Decoded - Post 72 Node.js REST API Server on IBM i
 * Description: Publishes Post 72 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post72_exists');
function as400_ensure_post72_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post72',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-nodejs-express-rest-api-server-db2-routing-json-batch-job-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post72', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i Node.js REST API',
        'IBM i Express REST server',
        'IBM i Node.js Express 2026',
        'IBM i Node.js DB2 access',
        'IBM i odbc Node.js',
        'IBM i REST API routing',
        'IBM i JSON REST response',
        'IBM i Node.js batch job PASE',
        'IBM i itoolkit Node.js',
        'IBM i Node.js PASE',
        'IBM i Express middleware',
        'IBM i REST API endpoint',
        'IBM i Node.js DB2 query',
        'IBM i Node.js 2026',
        'IBM i API server PASE Express',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post72-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'Building a REST API Server on IBM i with Node.js and Express: DB2 Access via ODBC, Routing, JSON Responses, Middleware, and Running as a Batch Job in 2026',
        'post_name'     => 'ibm-i-nodejs-express-rest-api-server-db2-routing-json-batch-job-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Build a production REST API server on IBM i in 2026 using Node.js and Express in PASE: connect to DB2 for i with the odbc package, define routes, add authentication middleware, return JSON responses, handle errors, and run the server as a persistent IBM i batch job submitted via SBMJOB.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-15 08:00:00',
        'post_date_gmt' => '2026-07-15 02:30:00',
        'meta_input'    => array(
            '_as400_post72'                      => '1',
            '_yoast_wpseo_title'                 => 'Node.js Express REST API Server on IBM i 2026: DB2 ODBC Routing JSON Batch Job',
            '_yoast_wpseo_metadesc'              => 'Build a REST API server on IBM i with Node.js and Express in 2026: DB2 for i access via odbc, route handlers, JSON responses, auth middleware, error handling, and running as a PASE batch job.',
            '_yoast_wpseo_focuskw'               => 'IBM i Node.js Express REST API server DB2 ODBC routing JSON batch job 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-nodejs-express-rest-api-server-db2-routing-json-batch-job-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Node.js + Express REST API Server on IBM i 2026: DB2, Routing, JSON, Batch Job',
            '_yoast_wpseo_opengraph-description' => 'Step-by-step guide to building a REST API server on IBM i using Node.js and Express: DB2 for i queries via odbc, request routing, JSON serialization, API key middleware, error handling, and persistent PASE batch job deployment in 2026.',
            '_yoast_wpseo_twitter-title'         => 'Node.js + Express REST API on IBM i 2026: DB2, Routing, JSON, Batch Job',
            '_yoast_wpseo_twitter-description'   => 'Build a REST API server on IBM i with Node.js and Express: DB2 odbc queries, routes, JSON responses, middleware, and PASE batch job deployment in 2026.',
            '_aioseo_title'                      => 'Node.js Express REST API Server on IBM i 2026: DB2 ODBC Routing JSON Batch Job',
            '_aioseo_description'                => 'Build a REST API server on IBM i with Node.js and Express in 2026: DB2 for i access via odbc, route handlers, JSON responses, auth middleware, error handling, and running as a PASE batch job.',
            '_aioseo_keywords'                   => 'IBM i Node.js REST API, IBM i Express server, IBM i Node.js DB2 odbc, IBM i PASE Node.js 2026, IBM i REST API routing',
            '_aioseo_og_title'                   => 'Node.js + Express REST API Server on IBM i 2026: DB2, Routing, JSON, Batch Job',
            '_aioseo_og_description'             => 'Step-by-step guide to building a REST API server on IBM i using Node.js and Express: DB2 for i queries via odbc, request routing, JSON serialization, API key middleware, error handling, and persistent PASE batch job deployment in 2026.',
            '_aioseo_twitter_title'              => 'Node.js + Express REST API on IBM i 2026: DB2, Routing, JSON, Batch Job',
            '_aioseo_twitter_description'        => 'Build a REST API server on IBM i with Node.js and Express: DB2 odbc queries, routes, JSON responses, middleware, and PASE batch job deployment in 2026.',
            'rank_math_focus_keyword'            => 'IBM i Node.js Express REST API server DB2 ODBC routing JSON batch job 2026',
            'rank_math_description'              => 'Build a REST API server on IBM i with Node.js and Express in 2026: DB2 for i access via odbc, route handlers, JSON responses, auth middleware, error handling, and running as a PASE batch job.',
            'rank_math_title'                    => 'Node.js Express REST API Server on IBM i 2026: DB2 ODBC Routing JSON Batch Job',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post72_use_classic', 10, 2);
function as400_post72_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post72', true) === '1') return false;
    return $use_block_editor;
}
