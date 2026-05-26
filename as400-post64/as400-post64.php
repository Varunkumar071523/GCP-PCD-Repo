<?php
/**
 * Plugin Name: AS400 Decoded - Post 64 IBM i Job Scheduling ADDJOBSCDE
 * Description: Publishes Post 64 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post64_exists');
function as400_ensure_post64_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post64',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-job-scheduling-addjobscde-wrkjobscde-advanced-job-scheduler-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post64', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i ADDJOBSCDE',
        'IBM i job scheduling',
        'IBM i WRKJOBSCDE',
        'IBM i advanced job scheduler',
        'IBM i 5770-JS1',
        'IBM i CHGJOBSCDE',
        'IBM i RMVJOBSCDE',
        'IBM i SBMJOB scheduling',
        'IBM i batch automation',
        'IBM i job schedule entry',
        'IBM i job scheduler 2026',
        'IBM i automated batch jobs',
        'IBM i CL batch scheduling',
        'IBM i QUSRJOBI job info',
        'IBM i scheduled jobs notification',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post64-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Job Scheduling: ADDJOBSCDE, WRKJOBSCDE, IBM Advanced Job Scheduler, Notifications, and Batch Automation in 2026',
        'post_name'     => 'ibm-i-job-scheduling-addjobscde-wrkjobscde-advanced-job-scheduler-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Automate IBM i batch jobs in 2026: add recurring schedule entries with ADDJOBSCDE, manage and monitor schedules with WRKJOBSCDE, set up failure notifications via message queues, configure the IBM Advanced Job Scheduler (5770-JS1) for complex job dependencies, and query schedule history from QSYS2.SCHEDULED_JOB_INFO.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-07 08:00:00',
        'post_date_gmt' => '2026-07-07 02:30:00',
        'meta_input'    => array(
            '_as400_post64'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Advanced Job Scheduler',
            '_yoast_wpseo_metadesc'              => 'Automate IBM i batch jobs in 2026: ADDJOBSCDE schedule entries, WRKJOBSCDE management, failure notifications, IBM Advanced Job Scheduler 5770-JS1, and job schedule SQL monitoring.',
            '_yoast_wpseo_focuskw'               => 'IBM i job scheduling ADDJOBSCDE WRKJOBSCDE advanced job scheduler 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-job-scheduling-addjobscde-wrkjobscde-advanced-job-scheduler-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Advanced Job Scheduler',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i job scheduling: ADDJOBSCDE, frequency patterns, WRKJOBSCDE, failure notifications, IBM Advanced Job Scheduler 5770-JS1 dependencies, and SQL-based schedule monitoring.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Job Scheduling 2026: ADDJOBSCDE, Advanced Job Scheduler',
            '_yoast_wpseo_twitter-description'   => 'Automate IBM i batch jobs: ADDJOBSCDE, WRKJOBSCDE, IBM Advanced Job Scheduler 5770-JS1, dependency chains, and failure notifications in 2026.',
            '_aioseo_title'                      => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Advanced Job Scheduler',
            '_aioseo_description'                => 'Automate IBM i batch jobs in 2026: ADDJOBSCDE schedule entries, WRKJOBSCDE management, failure notifications, IBM Advanced Job Scheduler 5770-JS1, and job schedule SQL monitoring.',
            '_aioseo_keywords'                   => 'IBM i ADDJOBSCDE, IBM i job scheduling, IBM i WRKJOBSCDE, IBM i advanced job scheduler, IBM i 5770-JS1, IBM i batch automation 2026',
            '_aioseo_og_title'                   => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Advanced Job Scheduler',
            '_aioseo_og_description'             => 'Complete guide to IBM i job scheduling: ADDJOBSCDE, frequency patterns, WRKJOBSCDE, failure notifications, IBM Advanced Job Scheduler 5770-JS1 dependencies, and SQL-based schedule monitoring.',
            '_aioseo_twitter_title'              => 'IBM i Job Scheduling 2026: ADDJOBSCDE, Advanced Job Scheduler',
            '_aioseo_twitter_description'        => 'Automate IBM i batch jobs: ADDJOBSCDE, WRKJOBSCDE, IBM Advanced Job Scheduler 5770-JS1, dependency chains, and failure notifications in 2026.',
            'rank_math_focus_keyword'            => 'IBM i job scheduling ADDJOBSCDE WRKJOBSCDE advanced job scheduler 2026',
            'rank_math_description'              => 'Automate IBM i batch jobs in 2026: ADDJOBSCDE schedule entries, WRKJOBSCDE management, failure notifications, IBM Advanced Job Scheduler 5770-JS1, and job schedule SQL monitoring.',
            'rank_math_title'                    => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Advanced Job Scheduler',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post64_use_classic', 10, 2);
function as400_post64_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post64', true) === '1') return false;
    return $use_block_editor;
}
