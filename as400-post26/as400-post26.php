<?php
/**
 * Plugin Name: AS400 Decoded - Post 26 Node.js on IBM i
 * Description: Publishes Post 26 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post26_exists');
function as400_ensure_post26_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post26',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-nodejs-pase-idb-connector-rest-api-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post26', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'Node.js IBM i',
        'IBM i PASE Node.js',
        'idb-connector',
        'idb-pconnector',
        'itoolkit IBM i Node',
        'Express IBM i REST API',
        'IBM i REST API',
        'IBM i open source',
        'PM2 IBM i',
        'IBM i API layer',
        'DB2 for i Node.js',
        'IBM i modernisation',
        'IBM i integration',
        'IBM i 2026',
        'IBM i web services',
        'Node.js DB2',
        'IBM i JWT authentication'
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
    $content = file_get_contents(dirname(__FILE__) . '/post26-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i and Node.js in 2026: Running Node.js in PASE, Accessing DB2 for i, and Building REST APIs on IBM i',
        'post_name'    => 'ibm-i-nodejs-pase-idb-connector-rest-api-2026',
        'post_content' => $content,
        'post_excerpt' => 'Node.js runs natively on IBM i in PASE with direct in-process access to DB2 for i via idb-connector and to IBM i programs via itoolkit. This post covers installing Node.js via yum, synchronous and async DB2 queries with idb-pconnector, calling RPG service programs with itoolkit, building a REST API with Express.js, managing processes with PM2, JWT authentication, and using nginx as a reverse proxy on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-30 08:00:00',
        'post_date_gmt' => '2026-05-30 02:30:00',
        'meta_input'   => array(
            '_as400_post26' => '1',
            '_yoast_wpseo_title'         => 'IBM i and Node.js in 2026: PASE, idb-connector, itoolkit and REST APIs',
            '_yoast_wpseo_metadesc'      => 'Run Node.js natively on IBM i in PASE. Access DB2 for i with idb-connector, call RPG programs with itoolkit, build REST APIs with Express.js, manage processes with PM2, and secure with JWT — complete guide for 2026.',
            '_yoast_wpseo_focuskw'       => 'Node.js IBM i PASE idb-connector REST API itoolkit',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-nodejs-pase-idb-connector-rest-api-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i and Node.js in 2026: Build REST APIs Directly on IBM i',
            '_yoast_wpseo_opengraph-description' => 'idb-connector for DB2, itoolkit for RPG calls, Express.js for REST APIs, PM2 for process management — Node.js on IBM i is production-ready.',
            '_yoast_wpseo_twitter-title'         => 'Node.js on IBM i in 2026 — REST APIs, DB2 access, and RPG program calls from PASE',
            '_yoast_wpseo_twitter-description'   => 'Express.js + idb-connector + itoolkit running in PASE on IBM i. Here is the full pattern for building a modern API layer on top of your IBM i data.',
            '_aioseo_title'              => 'IBM i and Node.js in 2026: PASE, idb-connector, itoolkit and REST APIs',
            '_aioseo_description'        => 'Run Node.js natively on IBM i in PASE. Access DB2 for i with idb-connector, call RPG programs with itoolkit, build REST APIs with Express.js, manage processes with PM2, and secure with JWT — complete guide for 2026.',
            '_aioseo_keywords'           => 'Node.js IBM i,PASE IBM i,idb-connector,idb-pconnector,itoolkit IBM i,Express IBM i,IBM i REST API,DB2 for i Node.js,PM2 IBM i,IBM i JWT',
            '_aioseo_og_title'           => 'IBM i and Node.js in 2026: Build REST APIs Directly on IBM i',
            '_aioseo_og_description'     => 'idb-connector for DB2, itoolkit for RPG calls, Express.js for REST APIs, PM2 for process management — Node.js on IBM i is production-ready.',
            '_aioseo_twitter_title'      => 'Node.js on IBM i in 2026 — REST APIs, DB2 access, and RPG program calls from PASE',
            '_aioseo_twitter_description'=> 'Express.js + idb-connector + itoolkit running in PASE on IBM i. Here is the full pattern for building a modern API layer on top of your IBM i data.',
            'rank_math_focus_keyword'    => 'Node.js IBM i PASE idb-connector REST API itoolkit',
            'rank_math_description'      => 'Run Node.js natively on IBM i in PASE. Access DB2 for i with idb-connector, call RPG programs with itoolkit, build REST APIs with Express.js, manage processes with PM2, and secure with JWT — complete guide for 2026.',
            'rank_math_title'            => 'IBM i and Node.js in 2026: PASE, idb-connector, itoolkit and REST APIs',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post26_use_classic', 10, 2);
function as400_post26_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post26', true) === '1') return false;
    return $use_block_editor;
}
