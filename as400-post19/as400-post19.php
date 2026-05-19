<?php
/**
 * Plugin Name: AS400 Decoded - Post 19 IBM i Cloud Connectivity
 * Description: Publishes Post 19 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post19_exists');
function as400_ensure_post19_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post19',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-cloud-integration-azure-aws-hybrid-architecture', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post19', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i cloud integration',
        'IBM i Azure',
        'IBM i AWS',
        'Power Virtual Server',
        'IBM i hybrid architecture',
        'Azure Service Bus IBM i',
        'AWS SQS IBM i',
        'IBM i data replication',
        'IIDR IBM i',
        'Debezium IBM i',
        'SYSTOOLS HTTPPOSTCLOB',
        'IBM i REST API cloud',
        'IBM Cloud Direct Link',
        'IBM i modernisation',
        'IBM i 2026',
        'IBM i CDC replication',
        'IBM i SaaS integration'
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
    $content = file_get_contents(dirname(__FILE__) . '/post19-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'Connecting IBM i to the Cloud: Azure, AWS, Power Virtual Server, and Hybrid Integration Patterns That Actually Work',
        'post_name'    => 'ibm-i-cloud-integration-azure-aws-hybrid-architecture',
        'post_content' => $content,
        'post_excerpt' => 'IBM i can integrate with Azure, AWS, and SaaS platforms without custom adapters or protocol gymnastics. This post covers five production-ready patterns: REST API layer, message queue integration, DB2 CDC replication, outbound cloud API calls via SYSTOOLS, and IBM Power Virtual Server with Direct Link connectivity.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-23 08:00:00',
        'post_date_gmt' => '2026-05-23 02:30:00',
        'meta_input'   => array(
            '_as400_post19' => '1',

            '_yoast_wpseo_title'         => 'IBM i Cloud Integration: Azure, AWS, Power Virtual Server and Hybrid Patterns',
            '_yoast_wpseo_metadesc'      => 'Five production-ready patterns for connecting IBM i to Azure and AWS: REST API layer, Azure Service Bus / AWS SQS messaging, DB2 CDC replication, SYSTOOLS HTTP calls, and IBM Power Virtual Server with Direct Link.',
            '_yoast_wpseo_focuskw'       => 'IBM i cloud integration Azure AWS hybrid architecture',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-cloud-integration-azure-aws-hybrid-architecture/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Cloud Integration in 2026: Azure, AWS and Hybrid Patterns',
            '_yoast_wpseo_opengraph-description' => 'REST APIs, message queues, CDC replication, SYSTOOLS HTTP, and Power Virtual Server — every practical pattern for connecting IBM i to the cloud.',
            '_yoast_wpseo_twitter-title'         => 'IBM i to Azure and AWS — the integration patterns that work in 2026',
            '_yoast_wpseo_twitter-description'   => 'Five hybrid integration patterns for IBM i: REST API, Service Bus, CDC replication, SYSTOOLS HTTP calls, and Power Virtual Server.',

            '_aioseo_title'              => 'IBM i Cloud Integration: Azure, AWS, Power Virtual Server and Hybrid Patterns',
            '_aioseo_description'        => 'Five production-ready patterns for connecting IBM i to Azure and AWS: REST API layer, Azure Service Bus / AWS SQS messaging, DB2 CDC replication, SYSTOOLS HTTP calls, and IBM Power Virtual Server with Direct Link.',
            '_aioseo_keywords'           => 'IBM i cloud integration,IBM i Azure,IBM i AWS,Power Virtual Server IBM i,IBM i hybrid architecture,Azure Service Bus IBM i,IIDR IBM i,SYSTOOLS HTTPPOSTCLOB,IBM i CDC replication',
            '_aioseo_og_title'           => 'IBM i Cloud Integration in 2026: Azure, AWS and Hybrid Patterns',
            '_aioseo_og_description'     => 'REST APIs, message queues, CDC replication, SYSTOOLS HTTP, and Power Virtual Server — every practical pattern for connecting IBM i to the cloud.',
            '_aioseo_twitter_title'      => 'IBM i to Azure and AWS — the integration patterns that work in 2026',
            '_aioseo_twitter_description'=> 'Five hybrid integration patterns for IBM i: REST API, Service Bus, CDC replication, SYSTOOLS HTTP calls, and Power Virtual Server.',

            'rank_math_focus_keyword'    => 'IBM i cloud integration Azure AWS hybrid architecture',
            'rank_math_description'      => 'Five production-ready patterns for connecting IBM i to Azure and AWS: REST API layer, Azure Service Bus / AWS SQS messaging, DB2 CDC replication, SYSTOOLS HTTP calls, and IBM Power Virtual Server with Direct Link.',
            'rank_math_title'            => 'IBM i Cloud Integration: Azure, AWS, Power Virtual Server and Hybrid Patterns',

            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post19_use_classic', 10, 2);
function as400_post19_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post19', true) === '1') return false;
    return $use_block_editor;
}
