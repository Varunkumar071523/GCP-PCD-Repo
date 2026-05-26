<?php
/**
 * Plugin Name: AS400 Decoded - Post 81 IBM i Job Scheduling with ADDJOBSCDE
 * Description: Publishes Post 81 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post81_exists');
function as400_ensure_post81_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post81',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-job-scheduling-addjobscde-wrkjobscde-rtvjobscde-calendar-exceptions-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post81', '1', true);
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
        'IBM i job scheduling',
        'ADDJOBSCDE command',
        'WRKJOBSCDE IBM i',
        'RTVJOBSCDE CL',
        'IBM i job scheduler',
        'IBM i CHGJOBSCDE',
        'IBM i HLDJOBSCDE RLSJOBSCDE',
        'IBM i job schedule calendar',
        'IBM i schedule exception calendar',
        'IBM i QWCJBSCH job scheduler',
        'IBM i recurring batch job',
        'IBM i scheduled job monitoring',
        'IBM i SBMJOB automation',
        'IBM i job scheduling 2026',
        'IBM i QUSRJOBI scheduled jobs',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post81-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Job Scheduling with ADDJOBSCDE: Recurring Jobs, Schedule Calendars, Exception Calendars, RTVJOBSCDE, WRKJOBSCDE, and Monitoring in 2026',
        'post_name'     => 'ibm-i-job-scheduling-addjobscde-wrkjobscde-rtvjobscde-calendar-exceptions-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Master IBM i job scheduling in 2026: add recurring batch jobs with ADDJOBSCDE, manage schedules with WRKJOBSCDE and CHGJOBSCDE, create schedule calendars and exception calendars for bank holidays, retrieve schedule entries with RTVJOBSCDE, hold and release schedules with HLDJOBSCDE and RLSJOBSCDE, and monitor scheduled job execution from CL.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-07-24 08:00:00',
        'post_date_gmt' => '2026-07-24 02:30:00',
        'meta_input'    => array(
            '_as400_post81'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Job Scheduling 2026: ADDJOBSCDE WRKJOBSCDE RTVJOBSCDE Calendar Exceptions',
            '_yoast_wpseo_metadesc'              => 'Master IBM i job scheduling in 2026: ADDJOBSCDE for recurring jobs, WRKJOBSCDE management, schedule and exception calendars, RTVJOBSCDE in CL, HLDJOBSCDE, RLSJOBSCDE, and scheduled job monitoring.',
            '_yoast_wpseo_focuskw'               => 'IBM i job scheduling ADDJOBSCDE WRKJOBSCDE RTVJOBSCDE calendar exceptions 2026',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-job-scheduling-addjobscde-wrkjobscde-rtvjobscde-calendar-exceptions-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Calendars, Exceptions',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i job scheduling: ADDJOBSCDE for recurring batch jobs, WRKJOBSCDE and CHGJOBSCDE management, schedule calendars, exception calendars for holidays, RTVJOBSCDE in CL, and monitoring scheduled job execution.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Calendars',
            '_yoast_wpseo_twitter-description'   => 'IBM i job scheduling with ADDJOBSCDE: recurring batch jobs, schedule and exception calendars, RTVJOBSCDE, HLDJOBSCDE, RLSJOBSCDE, and monitoring in 2026.',
            '_aioseo_title'                      => 'IBM i Job Scheduling 2026: ADDJOBSCDE WRKJOBSCDE RTVJOBSCDE Calendar Exceptions',
            '_aioseo_description'                => 'Master IBM i job scheduling in 2026: ADDJOBSCDE for recurring jobs, WRKJOBSCDE management, schedule and exception calendars, RTVJOBSCDE in CL, HLDJOBSCDE, RLSJOBSCDE, and scheduled job monitoring.',
            '_aioseo_keywords'                   => 'IBM i job scheduling, ADDJOBSCDE, WRKJOBSCDE, IBM i job schedule calendar, IBM i exception calendar 2026',
            '_aioseo_og_title'                   => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Calendars, Exceptions',
            '_aioseo_og_description'             => 'Complete guide to IBM i job scheduling: ADDJOBSCDE for recurring batch jobs, WRKJOBSCDE and CHGJOBSCDE management, schedule calendars, exception calendars for holidays, RTVJOBSCDE in CL, and monitoring scheduled job execution.',
            '_aioseo_twitter_title'              => 'IBM i Job Scheduling 2026: ADDJOBSCDE, WRKJOBSCDE, Calendars',
            '_aioseo_twitter_description'        => 'IBM i job scheduling with ADDJOBSCDE: recurring batch jobs, schedule and exception calendars, RTVJOBSCDE, HLDJOBSCDE, RLSJOBSCDE, and monitoring in 2026.',
            'rank_math_focus_keyword'            => 'IBM i job scheduling ADDJOBSCDE WRKJOBSCDE RTVJOBSCDE calendar exceptions 2026',
            'rank_math_description'              => 'Master IBM i job scheduling in 2026: ADDJOBSCDE for recurring jobs, WRKJOBSCDE management, schedule and exception calendars, RTVJOBSCDE in CL, HLDJOBSCDE, RLSJOBSCDE, and scheduled job monitoring.',
            'rank_math_title'                    => 'IBM i Job Scheduling 2026: ADDJOBSCDE WRKJOBSCDE RTVJOBSCDE Calendar Exceptions',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post81_use_classic', 10, 2);
function as400_post81_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post81', true) === '1') return false;
    return $use_block_editor;
}
