<?php
/**
 * Plugin Name: AS400 Decoded - Post 42 DB2 for i Triggers
 * Description: Publishes Post 42 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post42_exists');
function as400_ensure_post42_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post42',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-db2-triggers-sql-external-before-after-audit-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post42', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'DB2 for i triggers',
        'IBM i SQL trigger',
        'IBM i external trigger',
        'IBM i BEFORE trigger',
        'IBM i AFTER trigger',
        'IBM i trigger buffer',
        'IBM i audit trigger',
        'IBM i trigger program',
        'IBM i row trigger',
        'IBM i ADDPFTRG',
        'IBM i RMVPFTRG',
        'IBM i trigger RPG program',
        'IBM i INSERT trigger',
        'IBM i UPDATE trigger',
        'IBM i DELETE trigger',
        'DB2 for i audit logging',
        'IBM i 2026 triggers',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post42-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'DB2 for i Triggers in 2026: SQL and External Triggers, BEFORE and AFTER Timing, Audit Logging, and Calling RPG from a Trigger',
        'post_name'     => 'ibm-i-db2-triggers-sql-external-before-after-audit-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'DB2 for i triggers fire automatically on INSERT, UPDATE, and DELETE, enforcing rules that application code cannot bypass. This post covers SQL and external trigger types, BEFORE and AFTER timing, transition variables, writing audit tables, calling RPG programs from external triggers using ADDPFTRG, and practical audit and validation patterns.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-15 08:00:00',
        'post_date_gmt' => '2026-06-15 02:30:00',
        'meta_input'    => array(
            '_as400_post42'                      => '1',
            '_yoast_wpseo_title'                 => 'DB2 for i Triggers in 2026: SQL & External Triggers, BEFORE/AFTER, Audit Logging, RPG %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Master DB2 for i triggers on IBM i in 2026. Covers SQL BEFORE and AFTER triggers, external triggers with ADDPFTRG, trigger buffers in RPG, audit logging patterns, and SIGNAL for validation.',
            '_yoast_wpseo_focuskw'               => 'DB2 for i triggers SQL external trigger BEFORE AFTER audit logging IBM i',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-db2-triggers-sql-external-before-after-audit-2026/',
            '_yoast_wpseo_opengraph-title'       => 'DB2 for i Triggers in 2026: SQL & External Triggers, BEFORE/AFTER, Audit Logging, RPG',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to DB2 for i triggers on IBM i — SQL BEFORE/AFTER triggers, external triggers with ADDPFTRG, RPG trigger programs, audit logging, and validation using SIGNAL.',
            '_yoast_wpseo_twitter-title'         => 'DB2 for i Triggers in 2026: SQL & External, BEFORE/AFTER, Audit, RPG',
            '_yoast_wpseo_twitter-description'   => 'Deep dive into DB2 for i triggers: SQL and external, BEFORE/AFTER timing, trigger buffers, audit logging, and calling RPG from a trigger with ADDPFTRG.',
            '_aioseo_title'                      => 'DB2 for i Triggers in 2026: SQL & External Triggers, BEFORE/AFTER, Audit Logging, RPG',
            '_aioseo_description'                => 'Master DB2 for i triggers on IBM i in 2026. Covers SQL BEFORE and AFTER triggers, external triggers with ADDPFTRG, trigger buffers in RPG, audit logging patterns, and SIGNAL for validation.',
            '_aioseo_keywords'                   => 'DB2 for i triggers, IBM i SQL trigger, IBM i external trigger, ADDPFTRG, IBM i audit logging, IBM i trigger RPG, BEFORE trigger IBM i, AFTER trigger IBM i',
            '_aioseo_og_title'                   => 'DB2 for i Triggers in 2026: SQL & External Triggers, BEFORE/AFTER, Audit Logging, RPG',
            '_aioseo_og_description'             => 'Complete guide to DB2 for i triggers on IBM i — SQL BEFORE/AFTER triggers, external triggers with ADDPFTRG, RPG trigger programs, audit logging, and validation using SIGNAL.',
            '_aioseo_twitter_title'              => 'DB2 for i Triggers in 2026: SQL & External, BEFORE/AFTER, Audit, RPG',
            '_aioseo_twitter_description'        => 'Deep dive into DB2 for i triggers: SQL and external, BEFORE/AFTER timing, trigger buffers, audit logging, and calling RPG from a trigger with ADDPFTRG.',
            'rank_math_focus_keyword'            => 'DB2 for i triggers SQL external trigger BEFORE AFTER audit logging IBM i',
            'rank_math_description'              => 'Master DB2 for i triggers on IBM i in 2026. Covers SQL BEFORE and AFTER triggers, external triggers with ADDPFTRG, trigger buffers in RPG, audit logging patterns, and SIGNAL for validation.',
            'rank_math_title'                    => 'DB2 for i Triggers in 2026: SQL & External Triggers, BEFORE/AFTER, Audit Logging, RPG %sep% %sitename%',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post42_use_classic', 10, 2);
function as400_post42_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post42', true) === '1') return false;
    return $use_block_editor;
}
