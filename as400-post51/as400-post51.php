<?php
/**
 * Plugin Name: AS400 Decoded - Post 51 IBM i Integration with Microsoft Azure
 * Description: Publishes Post 51 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post51_exists');
function as400_ensure_post51_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post51',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-microsoft-azure-integration-event-hub-blob-service-bus-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post51', '1', true);
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
        'IBM i Azure',
        'IBM i Microsoft Azure',
        'IBM i Azure Event Hub',
        'IBM i Azure Blob Storage',
        'IBM i Azure Service Bus',
        'IBM i Azure SQL',
        'IBM i Azure integration',
        'IBM i cloud Azure',
        'IBM i Python Azure',
        'IBM i Node.js Azure',
        'IBM i PASE Azure SDK',
        'IBM i Azure data pipeline',
        'IBM i Azure messaging',
        'IBM i hybrid cloud',
        'IBM i Azure 2026',
        'azure-eventhub IBM i',
        'IBM i cloud integration 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post51-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Integration with Microsoft Azure in 2026: Azure Event Hubs, Blob Storage, Service Bus, and Azure SQL from PASE',
        'post_name'     => 'ibm-i-microsoft-azure-integration-event-hub-blob-service-bus-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Learn how to integrate IBM i with Microsoft Azure in 2026 using the Azure Python and Node.js SDKs in PASE. Stream DB2 for i data to Azure Event Hubs, offload to Blob Storage, exchange messages via Service Bus, and sync data to Azure SQL for Power BI reporting.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-24 08:00:00',
        'post_date_gmt' => '2026-06-24 02:30:00',
        'meta_input'    => array(
            '_as400_post51'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Microsoft Azure Integration 2026: Event Hubs, Blob Storage, Service Bus, Azure SQL from PASE',
            '_yoast_wpseo_metadesc'              => 'Step-by-step guide to integrating IBM i with Microsoft Azure in 2026. Stream DB2 for i data to Azure Event Hubs, upload to Blob Storage, message via Service Bus, and connect to Azure SQL from PASE.',
            '_yoast_wpseo_focuskw'               => 'IBM i Microsoft Azure integration Event Hubs Blob Storage Service Bus PASE',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-microsoft-azure-integration-event-hub-blob-service-bus-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Integration with Microsoft Azure in 2026: Event Hubs, Blob Storage, Service Bus, Azure SQL',
            '_yoast_wpseo_opengraph-description' => 'Connect IBM i to Microsoft Azure using the Azure Python and Node.js SDKs in PASE. Real working code for Event Hubs, Blob Storage, Service Bus, and Azure SQL integration.',
            '_yoast_wpseo_twitter-title'         => 'IBM i + Microsoft Azure Integration in 2026: Event Hubs, Blob, Service Bus, Azure SQL',
            '_yoast_wpseo_twitter-description'   => 'Stream IBM i data to Azure Event Hubs, upload to Blob Storage, and connect to Azure SQL — all from PASE using Python and Node.js Azure SDKs.',
            '_aioseo_title'                      => 'IBM i Microsoft Azure Integration 2026: Event Hubs, Blob Storage, Service Bus, Azure SQL from PASE',
            '_aioseo_description'                => 'Step-by-step guide to integrating IBM i with Microsoft Azure in 2026. Stream DB2 for i data to Azure Event Hubs, upload to Blob Storage, message via Service Bus, and connect to Azure SQL from PASE.',
            '_aioseo_keywords'                   => 'IBM i Microsoft Azure integration, IBM i Azure Event Hubs, IBM i Azure Blob Storage, IBM i Azure Service Bus, IBM i Azure SQL, IBM i PASE Azure SDK',
            '_aioseo_og_title'                   => 'IBM i Integration with Microsoft Azure in 2026: Event Hubs, Blob Storage, Service Bus, Azure SQL',
            '_aioseo_og_description'             => 'Connect IBM i to Microsoft Azure using the Azure Python and Node.js SDKs in PASE. Real working code for Event Hubs, Blob Storage, Service Bus, and Azure SQL integration.',
            '_aioseo_twitter_title'              => 'IBM i + Microsoft Azure Integration in 2026: Event Hubs, Blob, Service Bus, Azure SQL',
            '_aioseo_twitter_description'        => 'Stream IBM i data to Azure Event Hubs, upload to Blob Storage, and connect to Azure SQL — all from PASE using Python and Node.js Azure SDKs.',
            'rank_math_focus_keyword'            => 'IBM i Microsoft Azure integration Event Hubs Blob Storage Service Bus PASE',
            'rank_math_description'              => 'Step-by-step guide to integrating IBM i with Microsoft Azure in 2026. Stream DB2 for i data to Azure Event Hubs, upload to Blob Storage, message via Service Bus, and connect to Azure SQL from PASE.',
            'rank_math_title'                    => 'IBM i Microsoft Azure Integration 2026: Event Hubs, Blob Storage, Service Bus, Azure SQL from PASE',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post51_use_classic', 10, 2);
function as400_post51_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post51', true) === '1') return false;
    return $use_block_editor;
}
