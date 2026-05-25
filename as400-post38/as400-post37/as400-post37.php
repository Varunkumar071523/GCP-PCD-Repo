<?php
/**
 * Plugin Name: AS400 Decoded - Post 37 DB2 for i Replication and CDC
 * Description: Publishes Post 37 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post37_exists');
function as400_ensure_post37_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post37',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-replication-q-replication-cdc-journal-based-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post37', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i replication',
        'IBM i CDC',
        'Q-Replication IBM i',
        'IBM i InfoSphere Data Replication',
        'MIMIX replication IBM i',
        'journal-based replication IBM i',
        'IBM i logical replication',
        'IBM i subscription replication',
        'IBM i data replication 2026',
        'DB2 for i journal',
        'IBM i CHGJRN',
        'IBM i replication strategy',
        'IBM i reporting offload',
        'IBM i HA replication',
        'IBM i DR replication',
        'IBM i QRPLOBJ',
        'IBM i change data capture',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post37-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Replication in 2026: Journal-Based CDC, Q-Replication, MIMIX, and Designing a Replication Strategy',
        'post_name'     => 'ibm-i-db2-replication-q-replication-cdc-journal-based-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'DB2 for i replication in 2026 is built on IBM i journals — the same journal receivers that underpin HA tools and Kafka CDC also power Q-Replication and MIMIX. This post explains journal-based logical replication, the Q-Replication Capture and Apply architecture, what MIMIX adds for HA and DR, and how to design a replication strategy that matches your latency targets and data distribution needs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-10 08:00:00',
        'post_date_gmt' => '2026-06-10 02:30:00',
        'meta_input'    => array(
            '_as400_post37'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Replication 2026: Journal-Based CDC, Q-Replication, MIMIX, and Replication Strategy',
            '_yoast_wpseo_metadesc'              => 'Learn DB2 for i replication in 2026 — journal-based CDC, Q-Replication Capture/Apply architecture, MIMIX for HA and DR, and how to design a replication strategy with practical SQL and CL examples.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i replication CDC journal-based Q-Replication MIMIX',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-db2-replication-q-replication-cdc-journal-based-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Replication 2026: Journal-Based CDC, Q-Replication, MIMIX, and Replication Strategy',
            '_yoast_wpseo_opengraph-description' => 'Journal-based CDC, Q-Replication architecture, MIMIX for HA and DR, and practical replication strategy design for IBM i in 2026.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Replication 2026: CDC, Q-Replication, MIMIX Explained',
            '_yoast_wpseo_twitter-description'   => 'Journal-based CDC and DB2 for i replication deep dive — Q-Replication, MIMIX, and designing a replication strategy for IBM i.',
            '_aioseo_title'                      => 'DB2 for i Replication 2026: Journal-Based CDC, Q-Replication, MIMIX, and Replication Strategy',
            '_aioseo_description'                => 'Learn DB2 for i replication in 2026 — journal-based CDC, Q-Replication Capture/Apply architecture, MIMIX for HA and DR, and how to design a replication strategy with practical SQL and CL examples.',
            '_aioseo_keywords'                   => 'DB2 for i replication, IBM i CDC, Q-Replication IBM i, MIMIX replication IBM i, journal-based replication IBM i, IBM i change data capture, IBM i replication strategy',
            '_aioseo_og_title'                   => 'DB2 for i Replication 2026: Journal-Based CDC, Q-Replication, MIMIX, and Replication Strategy',
            '_aioseo_og_description'             => 'Journal-based CDC, Q-Replication architecture, MIMIX for HA and DR, and practical replication strategy design for IBM i in 2026.',
            '_aioseo_twitter_title'              => 'DB2 for i Replication 2026: CDC, Q-Replication, MIMIX Explained',
            '_aioseo_twitter_description'        => 'Journal-based CDC and DB2 for i replication deep dive — Q-Replication, MIMIX, and designing a replication strategy for IBM i.',
            'rank_math_focus_keyword'            => 'DB2 for i replication CDC journal-based Q-Replication MIMIX',
            'rank_math_description'              => 'Learn DB2 for i replication in 2026 — journal-based CDC, Q-Replication Capture/Apply architecture, MIMIX for HA and DR, and how to design a replication strategy with practical SQL and CL examples.',
            'rank_math_title'                    => 'DB2 for i Replication 2026: Journal-Based CDC, Q-Replication, MIMIX, and Replication Strategy',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post37_use_classic', 10, 2);
function as400_post37_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post37', true) === '1') return false;
    return $use_block_editor;
}
