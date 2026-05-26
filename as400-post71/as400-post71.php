<?php
/**
 * Plugin Name: AS400 Decoded - Post 71 IFS Stream File IO from RPG
 * Description: Publishes Post 71 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post71_exists');
function as400_ensure_post71_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post71',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ifs-stream-file-io-rpg-qp0lopen-read-write-csv-config-file-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post71', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ifs-file-systems');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modernization');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i IFS stream file I/O',
        'IBM i Qp0lOpen',
        'IBM i IFS RPG API',
        'IBM i IFS write from RPG',
        'IBM i IFS read file RPG',
        'IBM i CSV file generation RPG',
        'IBM i IFS open flags',
        'IBM i IFS file descriptor',
        'IBM i UNIX-type APIs RPG',
        'IBM i IFS config file parsing',
        'IBM i Qp0lClose',
        'IBM i CCSID IFS stream file',
        'IBM i IFS O_CREAT O_WRONLY',
        'IBM i IFS 2026',
        'IBM i stream file API RPG',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post71-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IFS Stream File I/O from RPG on IBM i: Qp0lOpen, Qp0lRead, Qp0lWrite, Open Flags, CSV File Generation, and Config File Parsing in 2026',
        'post_name'     => 'ibm-i-ifs-stream-file-io-rpg-qp0lopen-read-write-csv-config-file-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Read and write IFS stream files from ILE RPG programs on IBM i in 2026: use Qp0lOpen, Qp0lRead, Qp0lWrite, and Qp0lClose UNIX-type APIs, set open flags for create/append/read-only modes, handle CCSID encoding, generate CSV files for downstream systems, and parse INI-style config files at runtime.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-14 08:00:00',
        'post_date_gmt' => '2026-07-14 02:30:00',
        'meta_input'    => array(
            '_as400_post71'                      => '1',
            '_yoast_wpseo_title'                 => 'IFS Stream File I/O from RPG 2026: Qp0lOpen Qp0lRead Qp0lWrite CSV Config IBM i',
            '_yoast_wpseo_metadesc'              => 'Read and write IFS stream files from ILE RPG on IBM i in 2026: Qp0lOpen, Qp0lRead, Qp0lWrite, Qp0lClose, open flags, CCSID handling, CSV generation, and config file parsing.',
            '_yoast_wpseo_focuskw'               => 'IFS stream file I/O RPG IBM i Qp0lOpen Qp0lRead Qp0lWrite CSV config 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-ifs-stream-file-io-rpg-qp0lopen-read-write-csv-config-file-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IFS Stream File I/O from RPG on IBM i 2026: Qp0lOpen, Read, Write, CSV, Config',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IFS stream file I/O from ILE RPG on IBM i: Qp0lOpen, Qp0lRead, Qp0lWrite, Qp0lClose, UNIX open flags, CCSID encoding, CSV generation, and config file parsing in 2026.',
            '_yoast_wpseo_twitter-title'         => 'IFS Stream File I/O from RPG 2026: Qp0lOpen, Qp0lRead, Qp0lWrite',
            '_yoast_wpseo_twitter-description'   => 'IFS stream file I/O from ILE RPG on IBM i: Qp0lOpen, Qp0lRead, Qp0lWrite, UNIX open flags, CCSID, CSV generation, and config parsing in 2026.',
            '_aioseo_title'                      => 'IFS Stream File I/O from RPG 2026: Qp0lOpen Qp0lRead Qp0lWrite CSV Config IBM i',
            '_aioseo_description'                => 'Read and write IFS stream files from ILE RPG on IBM i in 2026: Qp0lOpen, Qp0lRead, Qp0lWrite, Qp0lClose, open flags, CCSID handling, CSV generation, and config file parsing.',
            '_aioseo_keywords'                   => 'IBM i IFS stream file RPG, IBM i Qp0lOpen, IBM i IFS read write RPG, IBM i CSV file generation, IBM i UNIX-type API 2026',
            '_aioseo_og_title'                   => 'IFS Stream File I/O from RPG on IBM i 2026: Qp0lOpen, Read, Write, CSV, Config',
            '_aioseo_og_description'             => 'Complete guide to IFS stream file I/O from ILE RPG on IBM i: Qp0lOpen, Qp0lRead, Qp0lWrite, Qp0lClose, UNIX open flags, CCSID encoding, CSV generation, and config file parsing in 2026.',
            '_aioseo_twitter_title'              => 'IFS Stream File I/O from RPG 2026: Qp0lOpen, Qp0lRead, Qp0lWrite',
            '_aioseo_twitter_description'        => 'IFS stream file I/O from ILE RPG on IBM i: Qp0lOpen, Qp0lRead, Qp0lWrite, UNIX open flags, CCSID, CSV generation, and config parsing in 2026.',
            'rank_math_focus_keyword'            => 'IFS stream file I/O RPG IBM i Qp0lOpen Qp0lRead Qp0lWrite CSV config 2026',
            'rank_math_description'              => 'Read and write IFS stream files from ILE RPG on IBM i in 2026: Qp0lOpen, Qp0lRead, Qp0lWrite, Qp0lClose, open flags, CCSID handling, CSV generation, and config file parsing.',
            'rank_math_title'                    => 'IFS Stream File I/O from RPG 2026: Qp0lOpen Qp0lRead Qp0lWrite CSV Config IBM i',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post71_use_classic', 10, 2);
function as400_post71_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post71', true) === '1') return false;
    return $use_block_editor;
}
