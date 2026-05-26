<?php
/**
 * Plugin Name: AS400 Decoded - Post 83 DB2 for i Triggers
 * Description: Publishes Post 83 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post83_exists');
function as400_ensure_post83_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post83',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('db2-for-i-triggers-create-trigger-before-after-transition-variables-audit-logging-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post83', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i triggers',
        'CREATE TRIGGER IBM i',
        'DB2 BEFORE trigger IBM i',
        'DB2 AFTER trigger IBM i',
        'DB2 for i transition variables OLD NEW',
        'IBM i SQL trigger audit logging',
        'DB2 for i ROW trigger STATEMENT trigger',
        'IBM i trigger cascading update',
        'DROP TRIGGER IBM i',
        'DB2 for i trigger performance',
        'IBM i trigger INSTEAD OF view',
        'DB2 for i business rule trigger',
        'IBM i referential integrity trigger',
        'IBM i trigger 2026',
        'DB2 for i audit trail trigger',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post83-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Triggers: CREATE TRIGGER, BEFORE and AFTER, Transition Variables, and Audit Logging on IBM i in 2026',
        'post_name'     => 'db2-for-i-triggers-create-trigger-before-after-transition-variables-audit-logging-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master DB2 for i triggers in 2026: create BEFORE and AFTER triggers with CREATE TRIGGER, use FOR EACH ROW and FOR EACH STATEMENT granularity, access transition variables OLD and NEW for changed data, build audit logging triggers for change tracking, cascade business rules across tables, create INSTEAD OF triggers on views, and apply trigger best practices on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-26 08:00:00',
        'post_date_gmt' => '2026-07-26 02:30:00',
        'meta_input'    => array(
            '_as400_post83'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Triggers 2026: CREATE TRIGGER BEFORE AFTER Transition Variables Audit Logging',
            '_yoast_wpseo_metadesc'              => 'DB2 for i triggers in 2026: CREATE TRIGGER with BEFORE and AFTER events, FOR EACH ROW and STATEMENT granularity, OLD and NEW transition variables, audit logging, cascading business rules, INSTEAD OF triggers on views, and trigger best practices on IBM i.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i triggers CREATE TRIGGER BEFORE AFTER transition variables audit logging 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/db2-for-i-triggers-create-trigger-before-after-transition-variables-audit-logging-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Triggers 2026: CREATE TRIGGER, BEFORE, AFTER, Transition Variables',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i triggers: CREATE TRIGGER, BEFORE and AFTER events, FOR EACH ROW, OLD and NEW transition variables, audit logging patterns, cascading business rules, and INSTEAD OF triggers on IBM i.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Triggers 2026: CREATE TRIGGER, BEFORE, AFTER, Audit Logging',
            '_yoast_wpseo_twitter-description'   => 'DB2 for i triggers: CREATE TRIGGER, BEFORE and AFTER, transition variables OLD and NEW, audit logging, and business rule enforcement in 2026.',
            '_aioseo_title'                      => 'DB2 for i Triggers 2026: CREATE TRIGGER BEFORE AFTER Transition Variables Audit Logging',
            '_aioseo_description'                => 'DB2 for i triggers in 2026: CREATE TRIGGER with BEFORE and AFTER events, FOR EACH ROW and STATEMENT granularity, OLD and NEW transition variables, audit logging, cascading business rules, INSTEAD OF triggers on views, and trigger best practices on IBM i.',
            '_aioseo_keywords'                   => 'DB2 for i triggers, CREATE TRIGGER IBM i, BEFORE AFTER trigger, DB2 transition variables OLD NEW, IBM i audit logging trigger 2026',
            '_aioseo_og_title'                   => 'DB2 for i Triggers 2026: CREATE TRIGGER, BEFORE, AFTER, Transition Variables',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i triggers: CREATE TRIGGER, BEFORE and AFTER events, FOR EACH ROW, OLD and NEW transition variables, audit logging patterns, cascading business rules, and INSTEAD OF triggers on IBM i.',
            '_aioseo_twitter_title'              => 'DB2 for i Triggers 2026: CREATE TRIGGER, BEFORE, AFTER, Audit Logging',
            '_aioseo_twitter_description'        => 'DB2 for i triggers: CREATE TRIGGER, BEFORE and AFTER, transition variables OLD and NEW, audit logging, and business rule enforcement in 2026.',
            'rank_math_focus_keyword'            => 'DB2 for i triggers CREATE TRIGGER BEFORE AFTER transition variables audit logging 2026',
            'rank_math_description'              => 'DB2 for i triggers in 2026: CREATE TRIGGER with BEFORE and AFTER events, FOR EACH ROW and STATEMENT granularity, OLD and NEW transition variables, audit logging, cascading business rules, INSTEAD OF triggers on views, and trigger best practices on IBM i.',
            'rank_math_title'                    => 'DB2 for i Triggers 2026: CREATE TRIGGER BEFORE AFTER Transition Variables Audit Logging',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post83_use_classic', 10, 2);
function as400_post83_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post83', true) === '1') return false;
    return $use_block_editor;
}
