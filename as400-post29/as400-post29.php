<?php
/**
 * Plugin Name: AS400 Decoded - Post 29 IBM i System Operations CL
 * Description: Publishes Post 29 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post29_exists');
function as400_ensure_post29_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post29',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-system-operations-cl-commands-subsystems-job-management-data-queues-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post29', '1', true);
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
        'IBM i CL commands',
        'IBM i subsystem management',
        'WRKACTJOB commands',
        'CHGJOB IBM i',
        'ENDJOB IBM i',
        'IBM i job management',
        'IBM i output queues',
        'IBM i spooled files',
        'IBM i data queues',
        'ADDJOBSCDE IBM i',
        'DSPMSG IBM i',
        'IBM i message queues',
        'IBM i job scheduler',
        'IBM i operational commands',
        'IBM i 2026',
        'WRKJOBQ IBM i',
        'IBM i SBMJOB'
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post29-content.html');

    $post_id = wp_insert_post(array(
        'post_title'   => 'IBM i System Operations with CL in 2026: Subsystem Management, Job Control, Data Queues, Output Queues, and Job Scheduling',
        'post_name'    => 'ibm-i-system-operations-cl-commands-subsystems-job-management-data-queues-2026',
        'post_content' => $content,
        'post_excerpt' => 'The operational CL commands IBM i administrators use every day: WRKACTJOB status codes explained (RUN, DSKW, LCKW, MSGW), CHGJOB and ENDJOB for job control, WRKSBS and ENDSBS for subsystem management, DSPMSG and SNDMSG for message queues, WRKSPLF and CPYSPLF for output queues, CRTDTAQ and RCVDTAQ for inter-job data queues, ADDJOBSCDE for the built-in job scheduler, and practical patterns for production operations.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-02 08:00:00',
        'post_date_gmt' => '2026-06-02 02:30:00',
        'meta_input'   => array(
            '_as400_post29' => '1',
            '_yoast_wpseo_title'         => 'IBM i System Operations CL in 2026: Subsystems, Job Control, Data Queues and Scheduling',
            '_yoast_wpseo_metadesc'      => 'The IBM i operational CL command reference: subsystem management, WRKACTJOB status codes, CHGJOB, ENDJOB, message queues, output queues, spooled files, data queues for inter-job communication, and ADDJOBSCDE for job scheduling.',
            '_yoast_wpseo_focuskw'       => 'IBM i system operations CL commands subsystems job management data queues',
            '_yoast_wpseo_canonical'     => 'https://as400decoded.com/ibm-i-system-operations-cl-commands-subsystems-job-management-data-queues-2026/',
            '_yoast_wpseo_opengraph-title'       => 'IBM i System Operations in 2026: The CL Command Reference That Matters',
            '_yoast_wpseo_opengraph-description' => 'Subsystems, WRKACTJOB job states, CHGJOB, ENDJOB, data queues, output queues, and job scheduling — the operational CL commands that keep IBM i production systems running.',
            '_yoast_wpseo_twitter-title'         => 'IBM i system operations in 2026 — subsystems, job control, data queues, and scheduling',
            '_yoast_wpseo_twitter-description'   => 'LCKW = lock wait. MSGW = waiting for operator reply. DSKW = disk wait. Here is what to do when IBM i jobs show each status.',
            '_aioseo_title'              => 'IBM i System Operations CL in 2026: Subsystems, Job Control, Data Queues and Scheduling',
            '_aioseo_description'        => 'The IBM i operational CL command reference: subsystem management, WRKACTJOB status codes, CHGJOB, ENDJOB, message queues, output queues, spooled files, data queues for inter-job communication, and ADDJOBSCDE for job scheduling.',
            '_aioseo_keywords'           => 'IBM i CL commands,IBM i subsystem management,WRKACTJOB,CHGJOB IBM i,ENDJOB IBM i,IBM i job management,IBM i data queues,ADDJOBSCDE,IBM i message queues,IBM i job scheduler',
            '_aioseo_og_title'           => 'IBM i System Operations in 2026: The CL Command Reference That Matters',
            '_aioseo_og_description'     => 'Subsystems, WRKACTJOB job states, CHGJOB, ENDJOB, data queues, output queues, and job scheduling — the operational CL commands that keep IBM i production systems running.',
            '_aioseo_twitter_title'      => 'IBM i system operations in 2026 — subsystems, job control, data queues, and scheduling',
            '_aioseo_twitter_description'=> 'LCKW = lock wait. MSGW = waiting for operator reply. DSKW = disk wait. Here is what to do when IBM i jobs show each status.',
            'rank_math_focus_keyword'    => 'IBM i system operations CL commands subsystems job management data queues',
            'rank_math_description'      => 'The IBM i operational CL command reference: subsystem management, WRKACTJOB status codes, CHGJOB, ENDJOB, message queues, output queues, spooled files, data queues for inter-job communication, and ADDJOBSCDE for job scheduling.',
            'rank_math_title'            => 'IBM i System Operations CL in 2026: Subsystems, Job Control, Data Queues and Scheduling',
            '_classic_editor_enabled'    => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post29_use_classic', 10, 2);
function as400_post29_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post29', true) === '1') return false;
    return $use_block_editor;
}
