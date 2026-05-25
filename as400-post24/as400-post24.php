<?php
/**
 * Plugin Name: AS400 Decoded - Post 24 IBM i IFS
 * Description: Publishes Post 24 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post24_exists');
function as400_ensure_post24_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post24',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-ifs-integrated-file-system-stream-files-git-rpg-cl-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post24', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ifs-file-systems');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i IFS',
        'Integrated File System IBM i',
        'stream files IBM i',
        'IFS directories IBM i',
        'Git IBM i IFS',
        'CPYFRMSTMF',
        'CPYTOSTMF',
        'IFS permissions IBM i',
        'RPG IFS file handling',
        'QSYS2 IFS_READ',
        'PASE IBM i',
        'QOpenSys IBM i',
        'IBM i open source',
        'IBM i build pipeline IFS',
        'IBM i SFTP',
        'IBM i modernisation',
        'IBM i 2026'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    // ── Content ───────────────────────────────────
    $content = file_get_contents(dirname(__FILE__) . '/post24-content.html');

    // ── Insert post ───────────────────────────────
    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i IFS in 2026: The Integrated File System, Stream Files, Git in the IFS, and Working with IFS from RPG and CL',
        'post_name'    => 'ibm-i-ifs-integrated-file-system-stream-files-git-rpg-cl-2026',
        'post_content' => $content,
        'post_excerpt' => 'The IBM i Integrated File System is the foundation of modern IBM i development — Git, open-source packages, Node.js, Python, and build pipelines all live in the IFS. This post covers the IFS directory structure including QSYS.LIB and QOpenSys, working with stream files from CL and RPG, POSIX permissions, copying between the library system and IFS, Git setup and workflow, SRCSTMF compilation, and practical IFS patterns for build pipelines and configuration management.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-05-28 08:00:00',
        'post_date_gmt' => '2026-05-28 02:30:00',
        'meta_input'   => array(
            '_as400_post24' => '1',

            // ── Yoast SEO ─────────────────────────
            '_yoast_wpseo_title'         => 'IBM i IFS in 2026: Integrated File System, Stream Files, Git and Build Pipelines',
            '_yoast_wpseo_metadesc'      => 'Everything IBM i developers need to know about the IFS: directory structure, QSYS.LIB bridge, stream files, POSIX permissions, CPYFRMSTMF, reading IFS files from RPG and SQL, Git setup in PASE, SRCSTMF compilation, and practical IFS patterns.',
            '_yoast_wpseo_focuskw'       => 'IBM i IFS Integrated File System stream files Git PASE',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-ifs-integrated-file-system-stream-files-git-rpg-cl-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i IFS in 2026: The Integrated File System Explained',
            '_yoast_wpseo_opengraph-description' => 'Stream files, QSYS.LIB bridge, POSIX permissions, Git in PASE, SRCSTMF compilation — how the IBM i IFS works and why it matters for modern development.',
            '_yoast_wpseo_twitter-title'         => 'IBM i IFS in 2026 — stream files, Git, and the foundation of modern IBM i development',
            '_yoast_wpseo_twitter-description'   => 'The IFS is where Git, Node.js, Python, and build pipelines live on IBM i. Here is how it works and how to use it properly.',

            // ── All in One SEO ────────────────────
            '_aioseo_title'              => 'IBM i IFS in 2026: Integrated File System, Stream Files, Git and Build Pipelines',
            '_aioseo_description'        => 'Everything IBM i developers need to know about the IFS: directory structure, QSYS.LIB bridge, stream files, POSIX permissions, CPYFRMSTMF, reading IFS files from RPG and SQL, Git setup in PASE, SRCSTMF compilation, and practical IFS patterns.',
            '_aioseo_keywords'           => 'IBM i IFS,Integrated File System IBM i,stream files IBM i,PASE IBM i,QOpenSys IBM i,Git IBM i,CPYFRMSTMF,SRCSTMF IBM i,IFS permissions,QSYS2 IFS_READ',
            '_aioseo_og_title'           => 'IBM i IFS in 2026: The Integrated File System Explained',
            '_aioseo_og_description'     => 'Stream files, QSYS.LIB bridge, POSIX permissions, Git in PASE, SRCSTMF compilation — how the IBM i IFS works and why it matters for modern development.',
            '_aioseo_twitter_title'      => 'IBM i IFS in 2026 — stream files, Git, and the foundation of modern IBM i development',
            '_aioseo_twitter_description'=> 'The IFS is where Git, Node.js, Python, and build pipelines live on IBM i. Here is how it works and how to use it properly.',

            // ── Rank Math ─────────────────────────
            'rank_math_focus_keyword'    => 'IBM i IFS Integrated File System stream files Git PASE',
            'rank_math_description'      => 'Everything IBM i developers need to know about the IFS: directory structure, QSYS.LIB bridge, stream files, POSIX permissions, CPYFRMSTMF, reading IFS files from RPG and SQL, Git setup in PASE, SRCSTMF compilation, and practical IFS patterns.',
            'rank_math_title'            => 'IBM i IFS in 2026: Integrated File System, Stream Files, Git and Build Pipelines',

            // ── Disable Gutenberg ─────────────────
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post24_use_classic', 10, 2);
function as400_post24_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post24', true) === '1') return false;
    return $use_block_editor;
}
