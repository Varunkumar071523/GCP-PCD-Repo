<?php
/**
 * Plugin Name: AS400 Decoded - Post 68 ILE RPG Date Time Timestamp Handling
 * Description: Publishes Post 68 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post68_exists');
function as400_ensure_post68_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post68',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ile-rpg-date-time-timestamp-handling-date-diff-addur-cee-apis-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post68', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'ILE RPG date handling',
        'RPG %DATE function',
        'RPG %DIFF built-in',
        'RPG %ADDUR date arithmetic',
        'IBM i date format conversion',
        'RPG CEEDAYS API',
        'RPG CEEJULDY',
        'ILE RPG timestamp',
        'RPG %SUBUR',
        'IBM i date century handling',
        'RPG date functions 2026',
        'IBM i CEE date APIs',
        'RPG %TIME function',
        'RPG date format ISO MDY DMY',
        'IBM i date arithmetic RPG',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post68-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'ILE RPG Date, Time, and Timestamp Handling: %DATE, %DIFF, %ADDUR, %SUBUR, Format Conversion, and CEE Date APIs on IBM i in 2026',
        'post_name'     => 'ile-rpg-date-time-timestamp-handling-date-diff-addur-cee-apis-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master ILE RPG date and time handling in 2026: declare date, time, and timestamp fields, convert between formats using %DATE and %CHAR, perform date arithmetic with %DIFF and %ADDUR, process fiscal periods, and call CEEDAYS and CEEJULDY CEE APIs for century-safe date calculations in IBM i RPG programs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-11 08:00:00',
        'post_date_gmt' => '2026-07-11 02:30:00',
        'meta_input'    => array(
            '_as400_post68'                      => '1',
            '_yoast_wpseo_title'                 => 'ILE RPG Date Time Handling 2026: %DATE %DIFF %ADDUR CEE APIs IBM i',
            '_yoast_wpseo_metadesc'              => 'Master ILE RPG date, time, and timestamp handling on IBM i in 2026: %DATE, %DIFF, %ADDUR, %SUBUR, format conversion, fiscal period logic, and CEEDAYS/CEEJULDY CEE date APIs.',
            '_yoast_wpseo_focuskw'               => 'ILE RPG date time timestamp %DATE %DIFF %ADDUR CEE APIs IBM i 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ile-rpg-date-time-timestamp-handling-date-diff-addur-cee-apis-2026/',
            '_yoast_wpseo_opengraph-title'       => 'ILE RPG Date, Time & Timestamp Handling 2026: %DATE, %DIFF, %ADDUR, CEE APIs',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to ILE RPG date and time handling on IBM i: declare date/time/timestamp fields, format conversion, %DIFF arithmetic, %ADDUR/%SUBUR duration operations, fiscal period logic, and CEEDAYS/CEEJULDY CEE date APIs.',
            '_yoast_wpseo_twitter-title'         => 'ILE RPG Date, Time & Timestamp Handling 2026: %DATE, %DIFF, %ADDUR',
            '_yoast_wpseo_twitter-description'   => 'ILE RPG date and time mastery: %DATE, %DIFF, %ADDUR, format conversion, fiscal periods, and CEE date APIs on IBM i in 2026.',
            '_aioseo_title'                      => 'ILE RPG Date Time Handling 2026: %DATE %DIFF %ADDUR CEE APIs IBM i',
            '_aioseo_description'                => 'Master ILE RPG date, time, and timestamp handling on IBM i in 2026: %DATE, %DIFF, %ADDUR, %SUBUR, format conversion, fiscal period logic, and CEEDAYS/CEEJULDY CEE date APIs.',
            '_aioseo_keywords'                   => 'ILE RPG date handling, RPG %DATE, RPG %DIFF, RPG %ADDUR, IBM i date arithmetic, RPG CEEDAYS, ILE RPG timestamp 2026',
            '_aioseo_og_title'                   => 'ILE RPG Date, Time & Timestamp Handling 2026: %DATE, %DIFF, %ADDUR, CEE APIs',
            '_aioseo_og_description'             => 'Complete guide to ILE RPG date and time handling on IBM i: declare date/time/timestamp fields, format conversion, %DIFF arithmetic, %ADDUR/%SUBUR duration operations, fiscal period logic, and CEEDAYS/CEEJULDY CEE date APIs.',
            '_aioseo_twitter_title'              => 'ILE RPG Date, Time & Timestamp Handling 2026: %DATE, %DIFF, %ADDUR',
            '_aioseo_twitter_description'        => 'ILE RPG date and time mastery: %DATE, %DIFF, %ADDUR, format conversion, fiscal periods, and CEE date APIs on IBM i in 2026.',
            'rank_math_focus_keyword'            => 'ILE RPG date time timestamp %DATE %DIFF %ADDUR CEE APIs IBM i 2026',
            'rank_math_description'              => 'Master ILE RPG date, time, and timestamp handling on IBM i in 2026: %DATE, %DIFF, %ADDUR, %SUBUR, format conversion, fiscal period logic, and CEEDAYS/CEEJULDY CEE date APIs.',
            'rank_math_title'                    => 'ILE RPG Date Time Handling 2026: %DATE %DIFF %ADDUR CEE APIs IBM i',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post68_use_classic', 10, 2);
function as400_post68_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post68', true) === '1') return false;
    return $use_block_editor;
}
