<?php
/**
 * Plugin Name: AS400 Decoded - Post 82 IBM i Commitment Control and Transaction Management
 * Description: Publishes Post 82 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post82_exists');
function as400_ensure_post82_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post82',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-commitment-control-strcmtctl-commit-rollback-savepoint-multi-file-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post82', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i commitment control',
        'STRCMTCTL IBM i',
        'ENDCMTCTL IBM i',
        'IBM i COMMIT ROLLBACK',
        'DB2 for i savepoints',
        'IBM i transaction management',
        'IBM i journal commitment control',
        'IBM i commitment control RPG',
        'IBM i multi-file update pattern',
        'STRJRNPF IBM i',
        'IBM i MONMSG CPF8351',
        'IBM i commitment definition',
        'IBM i atomic DB2 update',
        'IBM i rollback on abnormal end',
        'IBM i commitment control 2026',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post82-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Commitment Control and Transaction Management: STRCMTCTL, COMMIT, ROLLBACK, Savepoints, and Multi-File Updates in 2026',
        'post_name'     => 'ibm-i-commitment-control-strcmtctl-commit-rollback-savepoint-multi-file-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i commitment control in 2026: start and end commitment definitions with STRCMTCTL and ENDCMTCTL, control DB2 transaction scope with COMMIT and ROLLBACK in CL and RPG, use savepoints with SAVEPOINT and ROLLBACK TO SAVEPOINT in embedded SQL, handle commitment control errors, and design reliable multi-file update patterns on IBM i.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-25 08:00:00',
        'post_date_gmt' => '2026-07-25 02:30:00',
        'meta_input'    => array(
            '_as400_post82'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Commitment Control 2026: STRCMTCTL COMMIT ROLLBACK Savepoints Multi-File',
            '_yoast_wpseo_metadesc'              => 'IBM i commitment control in 2026: STRCMTCTL and ENDCMTCTL, COMMIT and ROLLBACK in CL and RPG, journal-based commitment control, DB2 savepoints, multi-file update patterns, and handling commitment control errors on IBM i.',
            '_yoast_wpseo_focuskw'               => 'IBM i commitment control STRCMTCTL COMMIT ROLLBACK savepoint multi-file 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-commitment-control-strcmtctl-commit-rollback-savepoint-multi-file-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Commitment Control 2026: STRCMTCTL, COMMIT, ROLLBACK, Savepoints',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i commitment control: STRCMTCTL and ENDCMTCTL, COMMIT and ROLLBACK in CL and RPG, journal-based transactions, DB2 savepoints, reliable multi-file update patterns, and error handling.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Commitment Control 2026: STRCMTCTL, COMMIT, ROLLBACK, Savepoints',
            '_yoast_wpseo_twitter-description'   => 'IBM i commitment control: STRCMTCTL, COMMIT, ROLLBACK, DB2 savepoints, multi-file updates, and transaction error handling in 2026.',
            '_aioseo_title'                      => 'IBM i Commitment Control 2026: STRCMTCTL COMMIT ROLLBACK Savepoints Multi-File',
            '_aioseo_description'                => 'IBM i commitment control in 2026: STRCMTCTL and ENDCMTCTL, COMMIT and ROLLBACK in CL and RPG, journal-based commitment control, DB2 savepoints, multi-file update patterns, and handling commitment control errors on IBM i.',
            '_aioseo_keywords'                   => 'IBM i commitment control, STRCMTCTL, COMMIT ROLLBACK IBM i, DB2 savepoints, IBM i transaction management 2026',
            '_aioseo_og_title'                   => 'IBM i Commitment Control 2026: STRCMTCTL, COMMIT, ROLLBACK, Savepoints',
            '_aioseo_og_description'             => 'Complete guide to IBM i commitment control: STRCMTCTL and ENDCMTCTL, COMMIT and ROLLBACK in CL and RPG, journal-based transactions, DB2 savepoints, reliable multi-file update patterns, and error handling.',
            '_aioseo_twitter_title'              => 'IBM i Commitment Control 2026: STRCMTCTL, COMMIT, ROLLBACK, Savepoints',
            '_aioseo_twitter_description'        => 'IBM i commitment control: STRCMTCTL, COMMIT, ROLLBACK, DB2 savepoints, multi-file updates, and transaction error handling in 2026.',
            'rank_math_focus_keyword'            => 'IBM i commitment control STRCMTCTL COMMIT ROLLBACK savepoint multi-file 2026',
            'rank_math_description'              => 'IBM i commitment control in 2026: STRCMTCTL and ENDCMTCTL, COMMIT and ROLLBACK in CL and RPG, journal-based commitment control, DB2 savepoints, multi-file update patterns, and handling commitment control errors on IBM i.',
            'rank_math_title'                    => 'IBM i Commitment Control 2026: STRCMTCTL COMMIT ROLLBACK Savepoints Multi-File',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post82_use_classic', 10, 2);
function as400_post82_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post82', true) === '1') return false;
    return $use_block_editor;
}
