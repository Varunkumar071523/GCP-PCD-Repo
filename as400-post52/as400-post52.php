<?php
/**
 * Plugin Name: AS400 Decoded - Post 52 IBM i Work Management in Depth
 * Description: Publishes Post 52 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post52_exists');
function as400_ensure_post52_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post52',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-work-management-subsystem-routing-job-queue-class-objects-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post52', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('operations-admin');
    if (!$cat) $cat = get_category_by_slug('cl-commands');
    if (!$cat) $cat = get_category_by_slug('rpg-cl-development');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i work management',
        'IBM i subsystem',
        'IBM i routing entry',
        'IBM i job queue',
        'IBM i class object',
        'IBM i CRTSBSD',
        'IBM i ADDRTGE',
        'IBM i ADDJOBQE',
        'IBM i SBMJOB routing',
        'IBM i work management design',
        'IBM i WRKACTJOB',
        'IBM i Collection Services',
        'IBM i job performance',
        'IBM i multi-threaded job',
        'IBM i CHGCLS',
        'IBM i subsystem description',
        'IBM i 2026 work management',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post52-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'IBM i Work Management in Depth in 2026: Subsystem Design, Routing Entries, Job Queue Priorities, Class Objects, and Performance Diagnosis',
        'post_name'     => 'ibm-i-work-management-subsystem-routing-job-queue-class-objects-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A complete guide to IBM i work management in 2026: create custom subsystem descriptions, configure routing entries and class objects, manage job queue priorities, diagnose multi-threaded jobs, and analyse performance with WRKACTJOB and Collection Services.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-25 08:00:00',
        'post_date_gmt' => '2026-06-25 02:30:00',
        'meta_input'    => array(
            '_as400_post52'                      => '1',
            '_yoast_wpseo_title'                 => 'IBM i Work Management 2026: Subsystem Design, Routing Entries, Job Queue Priorities, Class Objects, WRKACTJOB',
            '_yoast_wpseo_metadesc'              => 'Master IBM i work management in 2026. Create custom subsystems with CRTSBSD, configure routing entries with ADDRTGE, set class objects with CRTCLS, and diagnose performance with WRKACTJOB and Collection Services.',
            '_yoast_wpseo_focuskw'               => 'IBM i work management subsystem routing entries job queue class objects performance',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-work-management-subsystem-routing-job-queue-class-objects-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i Work Management in Depth 2026: Subsystem, Routing, Job Queues, Class Objects',
            '_yoast_wpseo_opengraph-description' => 'Complete guide to IBM i work management: design subsystem descriptions, routing entries, class objects, job queues, and diagnose performance with WRKACTJOB and Collection Services.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Work Management 2026: Subsystems, Routing Entries, Class Objects, WRKACTJOB',
            '_yoast_wpseo_twitter-description'   => 'Design custom IBM i subsystems, configure routing entries and class objects, and diagnose job performance with WRKACTJOB and Collection Services.',
            '_aioseo_title'                      => 'IBM i Work Management 2026: Subsystem Design, Routing Entries, Job Queue Priorities, Class Objects, WRKACTJOB',
            '_aioseo_description'                => 'Master IBM i work management in 2026. Create custom subsystems with CRTSBSD, configure routing entries with ADDRTGE, set class objects with CRTCLS, and diagnose performance with WRKACTJOB and Collection Services.',
            '_aioseo_keywords'                   => 'IBM i work management, IBM i subsystem description, IBM i routing entry, IBM i class object, IBM i job queue, IBM i WRKACTJOB, IBM i Collection Services',
            '_aioseo_og_title'                   => 'IBM i Work Management in Depth 2026: Subsystem, Routing, Job Queues, Class Objects',
            '_aioseo_og_description'             => 'Complete guide to IBM i work management: design subsystem descriptions, routing entries, class objects, job queues, and diagnose performance with WRKACTJOB and Collection Services.',
            '_aioseo_twitter_title'              => 'IBM i Work Management 2026: Subsystems, Routing Entries, Class Objects, WRKACTJOB',
            '_aioseo_twitter_description'        => 'Design custom IBM i subsystems, configure routing entries and class objects, and diagnose job performance with WRKACTJOB and Collection Services.',
            'rank_math_focus_keyword'            => 'IBM i work management subsystem routing entries job queue class objects performance',
            'rank_math_description'              => 'Master IBM i work management in 2026. Create custom subsystems with CRTSBSD, configure routing entries with ADDRTGE, set class objects with CRTCLS, and diagnose performance with WRKACTJOB and Collection Services.',
            'rank_math_title'                    => 'IBM i Work Management 2026: Subsystem Design, Routing Entries, Job Queue Priorities, Class Objects, WRKACTJOB',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post52_use_classic', 10, 2);
function as400_post52_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post52', true) === '1') return false;
    return $use_block_editor;
}
