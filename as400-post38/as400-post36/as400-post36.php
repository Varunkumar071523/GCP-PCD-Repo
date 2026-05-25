<?php
/**
 * Plugin Name: AS400 Decoded - Post 36 IBM i and Apache Kafka Event Streaming
 * Description: Publishes Post 36 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post36_exists');
function as400_ensure_post36_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post36',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-kafka-event-streaming-confluent-cdc-journal-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post36', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i Kafka',
        'Apache Kafka IBM i',
        'Kafka IBM i PASE',
        'IBM i event streaming',
        'IBM i change data capture',
        'IBM i CDC Kafka',
        'journal-based CDC IBM i',
        'Kafka Connect IBM i',
        'IBM i DB2 Kafka',
        'IBM i Node.js Kafka',
        'IBM i Python Kafka',
        'Confluent IBM i',
        'IBM i real-time integration',
        'Kafka topic IBM i',
        'IBM i event-driven architecture',
        'IBM i streaming 2026',
        'kafkajs IBM i',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post36-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i and Apache Kafka in 2026: Journal-Based CDC to Kafka Topics, PASE Producers, and Event-Driven IBM i Integration',
        'post_name'     => 'ibm-i-kafka-event-streaming-confluent-cdc-journal-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A hands-on guide to connecting IBM i with Apache Kafka in 2026 — running kafkajs and confluent-kafka-python producers in PASE, journal-based change data capture using QSYS2.DISPLAY_JOURNAL, Kafka Connect via IBM MQ bridge, consuming Kafka messages to write back into DB2 for i, and practical event-driven architecture patterns for IBM i integration.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-09 08:00:00',
        'post_date_gmt' => '2026-06-09 02:30:00',
        'meta_input'    => array(
            '_as400_post36'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i & Apache Kafka 2026: Journal CDC, PASE Producers, Event-Driven Integration',
            '_yoast_wpseo_metadesc'              => 'Connect IBM i to Apache Kafka in 2026 — kafkajs and Python producers in PASE, journal-based CDC with QSYS2.DISPLAY_JOURNAL, Kafka Connect via MQ bridge, and consuming Kafka events back into DB2 for i.',
            '_yoast_wpseo_focuskw'               => 'IBM i Kafka event streaming journal-based CDC PASE producer',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-kafka-event-streaming-confluent-cdc-journal-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i & Apache Kafka 2026: Journal CDC, PASE Producers, Event-Driven Integration',
            '_yoast_wpseo_opengraph-description' => 'Hands-on guide to IBM i and Kafka — PASE producers, journal-based CDC, Kafka Connect via MQ, Python consumers writing to DB2 for i, and event-driven architecture patterns.',
            '_yoast_wpseo_twitter-title'         => 'IBM i & Apache Kafka 2026: CDC, PASE Producers, Event Streaming',
            '_yoast_wpseo_twitter-description'   => 'Journal-based CDC from IBM i to Kafka topics, kafkajs producers in PASE, Python Kafka consumers, and IBM MQ bridge patterns. Full code examples.',
            '_aioseo_title'                      => 'IBM i & Apache Kafka 2026: Journal CDC, PASE Producers, Event-Driven Integration',
            '_aioseo_description'                => 'Connect IBM i to Apache Kafka in 2026 — kafkajs and Python producers in PASE, journal-based CDC with QSYS2.DISPLAY_JOURNAL, Kafka Connect via MQ bridge, and consuming Kafka events back into DB2 for i.',
            '_aioseo_keywords'                   => 'IBM i Kafka, Apache Kafka IBM i, IBM i CDC Kafka, journal-based CDC IBM i, Kafka Connect IBM i, IBM i Node.js Kafka, IBM i Python Kafka, IBM i event streaming',
            '_aioseo_og_title'                   => 'IBM i & Apache Kafka 2026: Journal CDC, PASE Producers, Event-Driven Integration',
            '_aioseo_og_description'             => 'Hands-on guide to IBM i and Kafka — PASE producers, journal-based CDC, Kafka Connect via MQ, Python consumers writing to DB2 for i, and event-driven architecture patterns.',
            '_aioseo_twitter_title'              => 'IBM i & Apache Kafka 2026: CDC, PASE Producers, Event Streaming',
            '_aioseo_twitter_description'        => 'Journal-based CDC from IBM i to Kafka topics, kafkajs producers in PASE, Python Kafka consumers, and IBM MQ bridge patterns. Full code examples.',
            'rank_math_focus_keyword'            => 'IBM i Kafka event streaming journal-based CDC PASE producer',
            'rank_math_description'              => 'Connect IBM i to Apache Kafka in 2026 — kafkajs and Python producers in PASE, journal-based CDC with QSYS2.DISPLAY_JOURNAL, Kafka Connect via MQ bridge, and consuming Kafka events back into DB2 for i.',
            'rank_math_title'                    => 'IBM i & Apache Kafka 2026: Journal CDC, PASE Producers, Event-Driven Integration',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post36_use_classic', 10, 2);
function as400_post36_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post36', true) === '1') return false;
    return $use_block_editor;
}
