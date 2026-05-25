<?php
/**
 * Plugin Name: AS400 Decoded - Post 38 IBM i Save and Restore Strategy
 * Description: Publishes Post 38 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post38_exists');
function as400_ensure_post38_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post38',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-save-restore-strategy-savlib-savobj-sav-backup-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post38', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('ifs-file-systems');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i save restore',
        'SAVLIB IBM i',
        'SAVOBJ IBM i',
        'SAV IBM i',
        'RSTLIB IBM i',
        'RSTOBJ IBM i',
        'GO SAVE IBM i',
        'IBM i backup strategy',
        'IBM i BRMS',
        'IBM i IMGCLG backup',
        'IBM i virtual tape',
        'IBM i backup schedule',
        'IBM i full system save',
        'IBM i incremental backup',
        'IBM i tape library',
        'IBM i disaster recovery backup',
        'IBM i 2026 backup',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post38-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Save and Restore Strategy in 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG Virtual Tape, and BRMS Backup Management',
        'post_name'     => 'ibm-i-save-restore-strategy-savlib-savobj-sav-backup-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'IBM i save and restore strategy in 2026 requires understanding GO SAVE options 21, 22, and 23, granular SAVLIB and SAVOBJ commands, SAV for IFS paths, virtual optical media with IMGCLG, and BRMS for automated incremental and cumulative backup management. This post covers the full IBM i backup stack with real CL examples and a practical daily-weekly-monthly backup schedule.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-11 08:00:00',
        'post_date_gmt' => '2026-06-11 02:30:00',
        'meta_input'    => array(
            '_as400_post38'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Save and Restore Strategy 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG, BRMS Backup',
            '_yoast_wpseo_metadesc'              => 'Master IBM i backup in 2026 — GO SAVE options 21/22/23, SAVLIB, SAVOBJ, SAV for IFS, virtual optical media with IMGCLG, and BRMS-managed backup schedules with real CL command examples.',
            '_yoast_wpseo_focuskw'               => 'IBM i save restore SAVLIB SAVOBJ GO SAVE IMGCLG BRMS backup strategy',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-save-restore-strategy-savlib-savobj-sav-backup-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Save and Restore Strategy 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG, BRMS Backup',
            '_yoast_wpseo_opengraph-description' => 'Complete IBM i backup guide for 2026 — GO SAVE options, SAVLIB, SAVOBJ, SAV for IFS, IMGCLG virtual tape, and BRMS automated backup management.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Save & Restore 2026: SAVLIB, GO SAVE, IMGCLG, BRMS Explained',
            '_yoast_wpseo_twitter-description'   => 'Complete IBM i backup strategy — GO SAVE 21/22/23, SAVLIB, SAVOBJ, SAV for IFS, IMGCLG virtual tape, and BRMS with real CL examples.',
            '_aioseo_title'                      => 'IBM i Save and Restore Strategy 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG, BRMS Backup',
            '_aioseo_description'                => 'Master IBM i backup in 2026 — GO SAVE options 21/22/23, SAVLIB, SAVOBJ, SAV for IFS, virtual optical media with IMGCLG, and BRMS-managed backup schedules with real CL command examples.',
            '_aioseo_keywords'                   => 'IBM i save restore, SAVLIB IBM i, SAVOBJ IBM i, GO SAVE IBM i, IBM i BRMS, IBM i IMGCLG backup, IBM i backup strategy, IBM i incremental backup',
            '_aioseo_og_title'                   => 'IBM i Save and Restore Strategy 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG, BRMS Backup',
            '_aioseo_og_description'             => 'Complete IBM i backup guide for 2026 — GO SAVE options, SAVLIB, SAVOBJ, SAV for IFS, IMGCLG virtual tape, and BRMS automated backup management.',
            '_aioseo_twitter_title'              => 'IBM i Save & Restore 2026: SAVLIB, GO SAVE, IMGCLG, BRMS Explained',
            '_aioseo_twitter_description'        => 'Complete IBM i backup strategy — GO SAVE 21/22/23, SAVLIB, SAVOBJ, SAV for IFS, IMGCLG virtual tape, and BRMS with real CL examples.',
            'rank_math_focus_keyword'            => 'IBM i save restore SAVLIB SAVOBJ GO SAVE IMGCLG BRMS backup strategy',
            'rank_math_description'              => 'Master IBM i backup in 2026 — GO SAVE options 21/22/23, SAVLIB, SAVOBJ, SAV for IFS, virtual optical media with IMGCLG, and BRMS-managed backup schedules with real CL command examples.',
            'rank_math_title'                    => 'IBM i Save and Restore Strategy 2026: SAVLIB, SAVOBJ, GO SAVE, IMGCLG, BRMS Backup',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post38_use_classic', 10, 2);
function as400_post38_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post38', true) === '1') return false;
    return $use_block_editor;
}
