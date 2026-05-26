<?php
/**
 * Plugin Name: AS400 Decoded - Post 84 IBM i Save and Restore Operations
 * Description: Publishes Post 84 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post84_exists');
function as400_ensure_post84_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post84',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-save-restore-savobj-rstobj-savlib-savchgobj-savf-backup-strategy-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post84', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i save restore',
        'SAVOBJ IBM i',
        'RSTOBJ IBM i',
        'SAVLIB RSTLIB IBM i',
        'IBM i SAVSYS',
        'IBM i SAVCHGOBJ incremental backup',
        'IBM i save file SAVF',
        'IBM i backup strategy',
        'IBM i CRTSAVF',
        'IBM i SAVSAVFDTA IFS',
        'IBM i BRMS backup recovery',
        'IBM i GO SAVE menu',
        'IBM i object restore verify',
        'IBM i backup 2026',
        'IBM i QHST backup log',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post84-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Save and Restore: SAVOBJ, RSTOBJ, SAVLIB, SAVCHGOBJ, Save Files, and Backup Strategy in 2026',
        'post_name'     => 'ibm-i-save-restore-savobj-rstobj-savlib-savchgobj-savf-backup-strategy-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i save and restore in 2026: save and restore individual objects with SAVOBJ and RSTOBJ, save entire libraries with SAVLIB and RSTLIB, perform full system saves with SAVSYS, run incremental saves with SAVCHGOBJ, create and use save files with CRTSAVF, save the IFS with SAVSAVFDTA, and design a robust IBM i backup strategy using GO SAVE and BRMS.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-27 08:00:00',
        'post_date_gmt' => '2026-07-27 02:30:00',
        'meta_input'    => array(
            '_as400_post84'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Save and Restore 2026: SAVOBJ RSTOBJ SAVLIB SAVCHGOBJ Save File Backup',
            '_yoast_wpseo_metadesc'              => 'IBM i save and restore in 2026: SAVOBJ and RSTOBJ for objects, SAVLIB and RSTLIB for libraries, SAVSYS for full system saves, SAVCHGOBJ incremental backup, save files with CRTSAVF, IFS backup with SAVSAVFDTA, and IBM i backup strategy with GO SAVE and BRMS.',
            '_yoast_wpseo_focuskw'               => 'IBM i save restore SAVOBJ RSTOBJ SAVLIB SAVCHGOBJ save file backup strategy 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-save-restore-savobj-rstobj-savlib-savchgobj-savf-backup-strategy-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Save and Restore 2026: SAVOBJ, RSTOBJ, SAVLIB, SAVCHGOBJ, Backup Strategy',
            '_yoast_wpseo_opengraph-description' => 'Complete IBM i save and restore guide: SAVOBJ, RSTOBJ, SAVLIB, RSTLIB, SAVSYS, SAVCHGOBJ incremental saves, save files, IFS backup, GO SAVE, and BRMS backup strategy in 2026.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Save and Restore 2026: SAVOBJ, RSTOBJ, SAVLIB, Backup Strategy',
            '_yoast_wpseo_twitter-description'   => 'IBM i backup and restore: SAVOBJ, RSTOBJ, SAVLIB, SAVCHGOBJ incremental saves, save files, and GO SAVE backup strategy in 2026.',
            '_aioseo_title'                      => 'IBM i Save and Restore 2026: SAVOBJ RSTOBJ SAVLIB SAVCHGOBJ Save File Backup',
            '_aioseo_description'                => 'IBM i save and restore in 2026: SAVOBJ and RSTOBJ for objects, SAVLIB and RSTLIB for libraries, SAVSYS for full system saves, SAVCHGOBJ incremental backup, save files with CRTSAVF, IFS backup with SAVSAVFDTA, and IBM i backup strategy with GO SAVE and BRMS.',
            '_aioseo_keywords'                   => 'IBM i save restore, SAVOBJ RSTOBJ, SAVLIB IBM i, SAVCHGOBJ incremental backup, IBM i backup strategy 2026',
            '_aioseo_og_title'                   => 'IBM i Save and Restore 2026: SAVOBJ, RSTOBJ, SAVLIB, SAVCHGOBJ, Backup Strategy',
            '_aioseo_og_description'             => 'Complete IBM i save and restore guide: SAVOBJ, RSTOBJ, SAVLIB, RSTLIB, SAVSYS, SAVCHGOBJ incremental saves, save files, IFS backup, GO SAVE, and BRMS backup strategy in 2026.',
            '_aioseo_twitter_title'              => 'IBM i Save and Restore 2026: SAVOBJ, RSTOBJ, SAVLIB, Backup Strategy',
            '_aioseo_twitter_description'        => 'IBM i backup and restore: SAVOBJ, RSTOBJ, SAVLIB, SAVCHGOBJ incremental saves, save files, and GO SAVE backup strategy in 2026.',
            'rank_math_focus_keyword'            => 'IBM i save restore SAVOBJ RSTOBJ SAVLIB SAVCHGOBJ save file backup strategy 2026',
            'rank_math_description'              => 'IBM i save and restore in 2026: SAVOBJ and RSTOBJ for objects, SAVLIB and RSTLIB for libraries, SAVSYS for full system saves, SAVCHGOBJ incremental backup, save files with CRTSAVF, IFS backup with SAVSAVFDTA, and IBM i backup strategy with GO SAVE and BRMS.',
            'rank_math_title'                    => 'IBM i Save and Restore 2026: SAVOBJ RSTOBJ SAVLIB SAVCHGOBJ Save File Backup',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post84_use_classic', 10, 2);
function as400_post84_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post84', true) === '1') return false;
    return $use_block_editor;
}
