<?php
/**
 * Plugin Name: AS400 Decoded - Post 32 Python on IBM i
 * Description: Publishes Post 32 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post32_exists');
function as400_ensure_post32_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post32',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-python-pase-ibm-db-itoolkit-ai-integration-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post32', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'Python IBM i',
        'Python PASE IBM i',
        'ibm_db Python IBM i',
        'pyodbc IBM i',
        'itoolkit Python IBM i',
        'pandas DB2 for i',
        'IBM i data pipeline',
        'Python AI IBM i',
        'OpenAI Python IBM i',
        'watsonx Python IBM i',
        'IBM i Python boto3',
        'Python S3 IBM i',
        'IBM i automation Python',
        'IBM i open source Python',
        'IBM i 2026',
        'Python vs Node.js IBM i',
        'ibm-watsonx-ai Python'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post32-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'Python on IBM i in 2026: Running Python in PASE, Accessing DB2 for i, Calling IBM i Programs with itoolkit, and AI Integration',
        'post_name'    => 'ibm-i-python-pase-ibm-db-itoolkit-ai-integration-2026',
        'post_content' => $content,
        'post_excerpt' => 'Python runs natively on IBM i in PASE with direct DB2 access via ibm_db and pyodbc, IBM i program calls via itoolkit-for-i, and access to the full Python AI ecosystem. This post covers installing Python via yum, querying DB2 for i with ibm_db_dbi, loading IBM i data into pandas DataFrames, calling CL commands and RPG programs with itoolkit, extracting IBM i data to AWS S3 with boto3, batch AI classification with the OpenAI Python library, watsonx.ai integration, running Python from CL, and when to use Python versus Node.js versus RPG.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-05 08:00:00',
        'post_date_gmt' => '2026-06-05 02:30:00',
        'meta_input'   => array(
            '_as400_post32' => '1',
            '_yoast_wpseo_title'         => 'Python on IBM i in 2026: PASE, ibm_db, itoolkit, Data Pipelines and AI Integration',
            '_yoast_wpseo_metadesc'      => 'Python running natively on IBM i in PASE: ibm_db and pyodbc for DB2 access, pandas for data analysis, itoolkit for RPG and CL calls, boto3 for S3 data pipelines, OpenAI and watsonx.ai for AI workflows — complete guide for 2026.',
            '_yoast_wpseo_focuskw'       => 'Python IBM i PASE ibm_db itoolkit DB2 for i AI integration',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-python-pase-ibm-db-itoolkit-ai-integration-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Python on IBM i in 2026: Data Pipelines, AI, and DB2 Access from PASE',
            '_yoast_wpseo_opengraph-description' => 'ibm_db, pyodbc, pandas, itoolkit, boto3, OpenAI, and watsonx — the Python ecosystem running natively on IBM i in PASE for data and AI workflows.',
            '_yoast_wpseo_twitter-title'         => 'Python on IBM i in 2026 — DB2 access, itoolkit program calls, S3 pipelines and AI',
            '_yoast_wpseo_twitter-description'   => 'pandas + ibm_db_dbi + boto3 + openai, all running in PASE on IBM i. Here is how to build data and AI pipelines directly on your IBM i LPAR.',
            '_aioseo_title'              => 'Python on IBM i in 2026: PASE, ibm_db, itoolkit, Data Pipelines and AI Integration',
            '_aioseo_description'        => 'Python running natively on IBM i in PASE: ibm_db and pyodbc for DB2 access, pandas for data analysis, itoolkit for RPG and CL calls, boto3 for S3 data pipelines, OpenAI and watsonx.ai for AI workflows — complete guide for 2026.',
            '_aioseo_keywords'           => 'Python IBM i,Python PASE IBM i,ibm_db Python,pyodbc IBM i,itoolkit Python,pandas DB2 for i,IBM i data pipeline,Python AI IBM i,OpenAI Python IBM i,watsonx Python IBM i',
            '_aioseo_og_title'           => 'Python on IBM i in 2026: Data Pipelines, AI, and DB2 Access from PASE',
            '_aioseo_og_description'     => 'ibm_db, pyodbc, pandas, itoolkit, boto3, OpenAI, and watsonx — the Python ecosystem running natively on IBM i in PASE for data and AI workflows.',
            '_aioseo_twitter_title'      => 'Python on IBM i in 2026 — DB2 access, itoolkit program calls, S3 pipelines and AI',
            '_aioseo_twitter_description'=> 'pandas + ibm_db_dbi + boto3 + openai, all running in PASE on IBM i. Here is how to build data and AI pipelines directly on your IBM i LPAR.',
            'rank_math_focus_keyword'    => 'Python IBM i PASE ibm_db itoolkit DB2 for i AI integration',
            'rank_math_description'      => 'Python running natively on IBM i in PASE: ibm_db and pyodbc for DB2 access, pandas for data analysis, itoolkit for RPG and CL calls, boto3 for S3 data pipelines, OpenAI and watsonx.ai for AI workflows — complete guide for 2026.',
            'rank_math_title'            => 'Python on IBM i in 2026: PASE, ibm_db, itoolkit, Data Pipelines and AI Integration',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post32_use_classic', 10, 2);
function as400_post32_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post32', true) === '1') return false;
    return $use_block_editor;
}
