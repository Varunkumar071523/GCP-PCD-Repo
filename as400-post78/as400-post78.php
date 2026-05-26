<?php
/**
 * Plugin Name: AS400 Decoded - Post 78 IBM MQ Messaging from IBM i
 * Description: Publishes Post 78 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post78_exists');
function as400_ensure_post78_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post78',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-mq-messaging-ibm-i-queue-manager-mqput-mqget-triggering-channels-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post78', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('apis-integration');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM MQ IBM i',
        'IBM MQ queue manager',
        'IBM MQ MQPUT API',
        'IBM MQ MQGET API',
        'IBM MQ channels IBM i',
        'IBM MQ triggering',
        'IBM MQ MQOPEN MQCLOSE',
        'IBM MQ dead letter queue',
        'IBM MQ sender receiver channel',
        'IBM MQ persistent messages',
        'IBM MQ RPG integration',
        'IBM MQ MQCONN MQDISC',
        'IBM i enterprise messaging',
        'IBM MQ 2026',
        'IBM MQ AMQSPUT AMQSGET',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post78-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM MQ Messaging from IBM i: Queue Managers, Channels, MQPUT, MQGET, Triggering, Dead Letter Queues, and RPG Integration in 2026',
        'post_name'     => 'ibm-mq-messaging-ibm-i-queue-manager-mqput-mqget-triggering-channels-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Integrate IBM MQ with IBM i in 2026: create and configure queue managers, define local and remote queues, set up sender/receiver channels, send and receive messages with MQPUT and MQGET from RPG programs, configure MQ Triggering to start IBM i jobs on message arrival, handle dead letter queues, and monitor MQ activity with AMQSPUT and AMQSGET.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-21 08:00:00',
        'post_date_gmt' => '2026-07-21 02:30:00',
        'meta_input'    => array(
            '_as400_post78'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM MQ Messaging IBM i 2026: Queue Manager MQPUT MQGET Triggering Channels',
            '_yoast_wpseo_metadesc'              => 'Integrate IBM MQ with IBM i in 2026: queue managers, local/remote queues, sender/receiver channels, MQPUT/MQGET from RPG, MQ Triggering, dead letter queues, and AMQSPUT/AMQSGET monitoring.',
            '_yoast_wpseo_focuskw'               => 'IBM MQ messaging IBM i queue manager MQPUT MQGET triggering channels 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-mq-messaging-ibm-i-queue-manager-mqput-mqget-triggering-channels-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM MQ Messaging on IBM i 2026: Queue Manager, MQPUT, MQGET, Triggering',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM MQ on IBM i: queue managers, local and remote queues, sender/receiver channels, MQPUT/MQGET from RPG programs, MQ Triggering for job start-on-arrival, dead letter queues, and operational monitoring.',
            '_yoast_wpseo_twitter-title'         => 'IBM MQ Messaging on IBM i 2026: MQPUT, MQGET, Triggering',
            '_yoast_wpseo_twitter-description'   => 'IBM MQ on IBM i in 2026: queue managers, channels, MQPUT/MQGET from RPG, MQ Triggering, dead letter queues, and enterprise messaging integration.',
            '_aioseo_title'                      => 'IBM MQ Messaging IBM i 2026: Queue Manager MQPUT MQGET Triggering Channels',
            '_aioseo_description'                => 'Integrate IBM MQ with IBM i in 2026: queue managers, local/remote queues, sender/receiver channels, MQPUT/MQGET from RPG, MQ Triggering, dead letter queues, and AMQSPUT/AMQSGET monitoring.',
            '_aioseo_keywords'                   => 'IBM MQ IBM i, IBM MQ queue manager, IBM MQ MQPUT MQGET, IBM MQ triggering IBM i, IBM MQ channels 2026',
            '_aioseo_og_title'                   => 'IBM MQ Messaging on IBM i 2026: Queue Manager, MQPUT, MQGET, Triggering',
            '_aioseo_og_description'             => 'Complete guide to IBM MQ on IBM i: queue managers, local and remote queues, sender/receiver channels, MQPUT/MQGET from RPG programs, MQ Triggering for job start-on-arrival, dead letter queues, and operational monitoring.',
            '_aioseo_twitter_title'              => 'IBM MQ Messaging on IBM i 2026: MQPUT, MQGET, Triggering',
            '_aioseo_twitter_description'        => 'IBM MQ on IBM i in 2026: queue managers, channels, MQPUT/MQGET from RPG, MQ Triggering, dead letter queues, and enterprise messaging integration.',
            'rank_math_focus_keyword'            => 'IBM MQ messaging IBM i queue manager MQPUT MQGET triggering channels 2026',
            'rank_math_description'              => 'Integrate IBM MQ with IBM i in 2026: queue managers, local/remote queues, sender/receiver channels, MQPUT/MQGET from RPG, MQ Triggering, dead letter queues, and AMQSPUT/AMQSGET monitoring.',
            'rank_math_title'                    => 'IBM MQ Messaging IBM i 2026: Queue Manager MQPUT MQGET Triggering Channels',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post78_use_classic', 10, 2);
function as400_post78_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post78', true) === '1') return false;
    return $use_block_editor;
}
