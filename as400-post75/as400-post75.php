<?php
/**
 * Plugin Name: AS400 Decoded - Post 75 ILE RPG String Handling
 * Description: Publishes Post 75 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post75_exists');
function as400_ensure_post75_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post75',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ile-rpg-string-handling-scan-subst-replace-trim-varchar-ccsid-ibm-i-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post75', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modernization');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'ILE RPG string handling',
        'RPG %SCAN built-in',
        'RPG %SUBST built-in',
        'RPG %REPLACE built-in',
        'RPG %TRIM %TRIMR %TRIML',
        'RPG VARCHAR fields',
        'RPG string manipulation IBM i',
        'ILE RPG CCSID handling',
        'RPG delimited string parsing',
        'RPG %LEN %SIZE',
        'RPG string concatenation',
        'RPG %CHAR %INT conversion',
        'IBM i RPG string functions 2026',
        'RPG multi-byte character handling',
        'ILE RPG free-format strings',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post75-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'ILE RPG String Handling: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR Fields, Delimited Parsing, and CCSID-Safe String Operations on IBM i in 2026',
        'post_name'     => 'ile-rpg-string-handling-scan-subst-replace-trim-varchar-ccsid-ibm-i-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master ILE RPG string handling on IBM i in 2026: use %SCAN, %SUBST, %REPLACE, %TRIM, %TRIMR, and %TRIML for text manipulation, declare VARCHAR and VARYING fields for variable-length data, build and parse delimited strings, handle CCSID conversion, and use %CHAR, %INT, and %DEC for type conversion in free-format RPG programs.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-18 08:00:00',
        'post_date_gmt' => '2026-07-18 02:30:00',
        'meta_input'    => array(
            '_as400_post75'                      => '1',
            '_yoast_wpseo_title'                 => 'ILE RPG String Handling 2026: %SCAN %SUBST %REPLACE %TRIM VARCHAR CCSID IBM i',
            '_yoast_wpseo_metadesc'              => 'Master ILE RPG string handling on IBM i in 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR fields, delimited string parsing, CCSID-safe operations, and type conversion with %CHAR, %INT, and %DEC.',
            '_yoast_wpseo_focuskw'               => 'ILE RPG string handling %SCAN %SUBST %REPLACE %TRIM VARCHAR CCSID IBM i 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ile-rpg-string-handling-scan-subst-replace-trim-varchar-ccsid-ibm-i-2026/',
            '_yoast_wpseo_opengraph-title'       => 'ILE RPG String Handling 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR, CCSID',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to ILE RPG string handling on IBM i: %SCAN, %SUBST, %REPLACE, %TRIM family, VARCHAR/VARYING fields, delimited string building and parsing, CCSID handling, and conversion built-ins.',
            '_yoast_wpseo_twitter-title'         => 'ILE RPG String Handling 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR',
            '_yoast_wpseo_twitter-description'   => 'ILE RPG string handling on IBM i: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR fields, delimited parsing, and CCSID-safe string operations in 2026.',
            '_aioseo_title'                      => 'ILE RPG String Handling 2026: %SCAN %SUBST %REPLACE %TRIM VARCHAR CCSID IBM i',
            '_aioseo_description'                => 'Master ILE RPG string handling on IBM i in 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR fields, delimited string parsing, CCSID-safe operations, and type conversion with %CHAR, %INT, and %DEC.',
            '_aioseo_keywords'                   => 'ILE RPG string handling, RPG %SCAN, RPG %SUBST, RPG %REPLACE, RPG %TRIM, RPG VARCHAR, IBM i string functions 2026',
            '_aioseo_og_title'                   => 'ILE RPG String Handling 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR, CCSID',
            '_aioseo_og_description'             => 'Complete guide to ILE RPG string handling on IBM i: %SCAN, %SUBST, %REPLACE, %TRIM family, VARCHAR/VARYING fields, delimited string building and parsing, CCSID handling, and conversion built-ins.',
            '_aioseo_twitter_title'              => 'ILE RPG String Handling 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR',
            '_aioseo_twitter_description'        => 'ILE RPG string handling on IBM i: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR fields, delimited parsing, and CCSID-safe string operations in 2026.',
            'rank_math_focus_keyword'            => 'ILE RPG string handling %SCAN %SUBST %REPLACE %TRIM VARCHAR CCSID IBM i 2026',
            'rank_math_description'              => 'Master ILE RPG string handling on IBM i in 2026: %SCAN, %SUBST, %REPLACE, %TRIM, VARCHAR fields, delimited string parsing, CCSID-safe operations, and type conversion with %CHAR, %INT, and %DEC.',
            'rank_math_title'                    => 'ILE RPG String Handling 2026: %SCAN %SUBST %REPLACE %TRIM VARCHAR CCSID IBM i',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post75_use_classic', 10, 2);
function as400_post75_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post75', true) === '1') return false;
    return $use_block_editor;
}
