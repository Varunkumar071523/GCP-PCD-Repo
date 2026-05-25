<?php
/**
 * Plugin Name: AS400 Decoded - Post 35 Display Files and 5250 UX Modernisation
 * Description: Publishes Post 35 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post35_exists');
function as400_ensure_post35_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post35',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-display-files-5250-ux-modernisation-dspf-subfiles-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post35', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i display files',
        'DDS display file',
        'IBM i DSPF',
        '5250 IBM i',
        'IBM i subfile',
        'SFLCTL IBM i',
        'IBM i green screen',
        'RPG display file I/O',
        'IBM i screen programming',
        'EXFMT IBM i',
        'IBM i modernisation 5250',
        'Profound UI IBM i',
        'IBM i web modernisation',
        'IBM i indicators',
        'IBM i CHGVAR subfile',
        'IBM i UX modernisation 2026',
        'IBM i RPG UI',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post35-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Display Files and 5250 UX Modernisation in 2026: DDS, Subfiles, RPG Screen I/O, and Modern Web Front-Ends',
        'post_name'     => 'ibm-i-display-files-5250-ux-modernisation-dspf-subfiles-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A practical guide to IBM i display files in 2026 — DDS syntax, CRTDSPF, RPG EXFMT screen I/O, subfile programming with SFL and SFLCTL, indicator handling, and a clear-eyed look at when and how to modernise 5250 green-screen interfaces with Profound UI, Node.js REST APIs, or IBM i Access Client Solutions.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-08 08:00:00',
        'post_date_gmt' => '2026-06-08 02:30:00',
        'meta_input'    => array(
            '_as400_post35'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Display Files & 5250 UX Modernisation 2026: DDS, Subfiles, RPG Screen I/O',
            '_yoast_wpseo_metadesc'              => 'Master IBM i display files in 2026 — DDS syntax, CRTDSPF, RPG EXFMT, subfiles with SFL/SFLCTL, indicator handling, and how to modernise 5250 green-screen interfaces using Profound UI and Node.js REST APIs.',
            '_yoast_wpseo_focuskw'               => 'IBM i display files DDS subfile 5250 UX modernisation RPG',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-display-files-5250-ux-modernisation-dspf-subfiles-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Display Files & 5250 UX Modernisation 2026: DDS, Subfiles, RPG Screen I/O',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i display files — DDS syntax, subfile programming, RPG EXFMT I/O, indicator management, and modernisation paths from green screen to web UI.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Display Files & 5250 UX Modernisation 2026',
            '_yoast_wpseo_twitter-description'   => 'DDS display files, subfiles, EXFMT, RPG indicators, and how to modernise IBM i 5250 screens in 2026. Full code examples.',
            '_aioseo_title'                      => 'IBM i Display Files & 5250 UX Modernisation 2026: DDS, Subfiles, RPG Screen I/O',
            '_aioseo_description'                => 'Master IBM i display files in 2026 — DDS syntax, CRTDSPF, RPG EXFMT, subfiles with SFL/SFLCTL, indicator handling, and how to modernise 5250 green-screen interfaces using Profound UI and Node.js REST APIs.',
            '_aioseo_keywords'                   => 'IBM i display files, DDS display file, IBM i DSPF, 5250 IBM i, IBM i subfile, SFLCTL IBM i, RPG display file I/O, EXFMT IBM i, IBM i modernisation 5250',
            '_aioseo_og_title'                   => 'IBM i Display Files & 5250 UX Modernisation 2026: DDS, Subfiles, RPG Screen I/O',
            '_aioseo_og_description'             => 'Complete guide to IBM i display files — DDS syntax, subfile programming, RPG EXFMT I/O, indicator management, and modernisation paths from green screen to web UI.',
            '_aioseo_twitter_title'              => 'IBM i Display Files & 5250 UX Modernisation 2026',
            '_aioseo_twitter_description'        => 'DDS display files, subfiles, EXFMT, RPG indicators, and how to modernise IBM i 5250 screens in 2026. Full code examples.',
            'rank_math_focus_keyword'            => 'IBM i display files DDS subfile 5250 UX modernisation RPG',
            'rank_math_description'              => 'Master IBM i display files in 2026 — DDS syntax, CRTDSPF, RPG EXFMT, subfiles with SFL/SFLCTL, indicator handling, and how to modernise 5250 green-screen interfaces using Profound UI and Node.js REST APIs.',
            'rank_math_title'                    => 'IBM i Display Files & 5250 UX Modernisation 2026: DDS, Subfiles, RPG Screen I/O',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post35_use_classic', 10, 2);
function as400_post35_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post35', true) === '1') return false;
    return $use_block_editor;
}
