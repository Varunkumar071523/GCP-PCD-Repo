<?php
/**
 * Plugin Name: AS400 Decoded - Post 62 IBM i RPG Subfile Programming
 * Description: Publishes Post 62 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post62_exists');
function as400_ensure_post62_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post62',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-rpg-subfile-programming-sflctl-sflpag-sfldsp-paging-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post62', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i RPG subfile',
        'RPG subfile programming',
        'IBM i SFLCTL',
        'IBM i SFLPAG',
        'IBM i SFLDSP',
        'IBM i SFLSIZ',
        'IBM i DDS subfile',
        'RPG subfile paging',
        'IBM i 5250 subfile',
        'IBM i SFLDSPCTL',
        'IBM i subfile record format',
        'RPG free-format subfile',
        'IBM i subfile 2026',
        'RPG EXFMT subfile',
        'IBM i subfile cursor positioning',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post62-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i RPG Subfile Programming: SFLCTL, SFLPAG, SFLDSP, Loading Records, Paging, and Cursor Positioning in 2026',
        'post_name'     => 'ibm-i-rpg-subfile-programming-sflctl-sflpag-sfldsp-paging-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i RPG subfile programming in 2026: design subfile and subfile control record formats in DDS with SFLPAG and SFLSIZ, load records in a loop using WRITE, display with SFLDSP and SFLDSPCTL, handle user input and option codes, implement page-up and page-down paging logic, and position the subfile cursor with SFLRCDNBR.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-05 08:00:00',
        'post_date_gmt' => '2026-07-05 02:30:00',
        'meta_input'    => array(
            '_as400_post62'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP, Paging',
            '_yoast_wpseo_metadesc'              => 'Master IBM i RPG subfile programming: DDS subfile design with SFLPAG and SFLSIZ, loading records, SFLDSP display, paging logic, option codes, and SFLRCDNBR cursor positioning.',
            '_yoast_wpseo_focuskw'               => 'IBM i RPG subfile programming SFLCTL SFLPAG SFLDSP paging 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-rpg-subfile-programming-sflctl-sflpag-sfldsp-paging-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP, Paging',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i RPG subfile programming: DDS keywords, SFLPAG and SFLSIZ, loading subfile records, SFLDSP and SFLDSPCTL display, page-up/down logic, option codes, and cursor positioning with SFLRCDNBR.',
            '_yoast_wpseo_twitter-title'         => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP',
            '_yoast_wpseo_twitter-description'   => 'RPG subfile programming on IBM i: DDS design, SFLPAG, SFLSIZ, loading records, paging, option codes, and cursor positioning in 2026.',
            '_aioseo_title'                      => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP, Paging',
            '_aioseo_description'                => 'Master IBM i RPG subfile programming: DDS subfile design with SFLPAG and SFLSIZ, loading records, SFLDSP display, paging logic, option codes, and SFLRCDNBR cursor positioning.',
            '_aioseo_keywords'                   => 'IBM i RPG subfile, RPG subfile programming, IBM i SFLCTL, IBM i SFLPAG, IBM i SFLDSP, RPG subfile paging, IBM i 5250 subfile 2026',
            '_aioseo_og_title'                   => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP, Paging',
            '_aioseo_og_description'             => 'Complete guide to IBM i RPG subfile programming: DDS keywords, SFLPAG and SFLSIZ, loading subfile records, SFLDSP and SFLDSPCTL display, page-up/down logic, option codes, and cursor positioning.',
            '_aioseo_twitter_title'              => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP',
            '_aioseo_twitter_description'        => 'RPG subfile programming on IBM i: DDS design, SFLPAG, SFLSIZ, loading records, paging, option codes, and cursor positioning in 2026.',
            'rank_math_focus_keyword'            => 'IBM i RPG subfile programming SFLCTL SFLPAG SFLDSP paging 2026',
            'rank_math_description'              => 'Master IBM i RPG subfile programming: DDS subfile design with SFLPAG and SFLSIZ, loading records, SFLDSP display, paging logic, option codes, and SFLRCDNBR cursor positioning.',
            'rank_math_title'                    => 'IBM i RPG Subfile Programming 2026: SFLCTL, SFLPAG, SFLDSP, Paging',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post62_use_classic', 10, 2);
function as400_post62_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post62', true) === '1') return false;
    return $use_block_editor;
}
