<?php
/**
 * Plugin Name: AS400 Decoded - Post 41 RPG Unit Testing with RPGUnit
 * Description: Publishes Post 41 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post41_exists');
function as400_ensure_post41_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post41',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-rpg-unit-testing-rpgunit-tdd-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post41', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('rpg-cl-development');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    if (!$cat) $cat = get_category_by_slug('operations-admin');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'RPGUnit',
        'IBM i unit testing',
        'RPG unit testing',
        'ILE RPG testing',
        'IBM i TDD',
        'RPGUnit test case',
        'RPGUnit test suite',
        'IBM i test driven development',
        'RPGUnit CI integration',
        'IBM i automated testing',
        'RPGUnit RUCRT',
        'RPGUnit RURUN',
        'RPG service program testing',
        'IBM i quality assurance',
        'IBM i Bob build RPGUnit',
        'IBM i testing 2026',
        'RPG modernisation testing',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post41-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'RPG Unit Testing with RPGUnit in 2026: Writing Test Cases for ILE RPG Service Programs, Test Suites, and CI Integration',
        'post_name'     => 'ibm-i-rpg-unit-testing-rpgunit-tdd-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'A complete guide to RPGUnit for ILE RPG in 2026: install the framework, write test cases and test suites for RPG service programs, run tests with RURUN, parse TAP output, and integrate automated RPG testing into a Bob or Jenkins CI pipeline.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-14 08:00:00',
        'post_date_gmt' => '2026-06-14 02:30:00',
        'meta_input'    => array(
            '_as400_post41'                      => '1',
            '_yoast_wpseo_title'                 => 'RPG Unit Testing with RPGUnit 2026: ILE RPG Test Cases, TDD and CI %%sep%% %%sitename%%',
            '_yoast_wpseo_metadesc'              => 'Master RPGUnit for ILE RPG in 2026. Install the framework, write test cases with assertions, build test suites, run RURUN, parse TAP output, and wire automated RPG tests into a Bob or Jenkins CI pipeline.',
            '_yoast_wpseo_focuskw'               => 'RPG unit testing RPGUnit ILE RPG test cases TDD IBM i',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-rpg-unit-testing-rpgunit-tdd-2026/',
            '_yoast_wpseo_opengraph-title'       => 'RPG Unit Testing with RPGUnit 2026: ILE RPG Test Cases and CI Integration',
            '_yoast_wpseo_opengraph-description' => 'Install RPGUnit, write test cases for ILE RPG service programs, run RURUN, parse TAP, and integrate into a Bob or Jenkins CI pipeline — a practical guide for IBM i developers.',
            '_yoast_wpseo_twitter-title'         => 'RPGUnit for ILE RPG in 2026: Test Cases, TDD, and CI Integration',
            '_yoast_wpseo_twitter-description'   => 'A step-by-step guide to RPGUnit on IBM i: installation, writing assertions, test suites, TAP output, and CI pipeline integration with Bob and Jenkins.',
            '_aioseo_title'                      => 'RPG Unit Testing with RPGUnit 2026: ILE RPG Test Cases, TDD and CI',
            '_aioseo_description'                => 'Master RPGUnit for ILE RPG in 2026. Install the framework, write test cases with assertions, build test suites, run RURUN, parse TAP output, and wire automated RPG tests into a Bob or Jenkins CI pipeline.',
            '_aioseo_keywords'                   => 'RPG unit testing RPGUnit ILE RPG test cases TDD IBM i, RPGUnit installation, RPGUnit CI integration, IBM i automated testing, RPG TDD',
            '_aioseo_og_title'                   => 'RPG Unit Testing with RPGUnit 2026: ILE RPG Test Cases and CI Integration',
            '_aioseo_og_description'             => 'Install RPGUnit, write test cases for ILE RPG service programs, run RURUN, parse TAP, and integrate into a Bob or Jenkins CI pipeline — a practical guide for IBM i developers.',
            '_aioseo_twitter_title'              => 'RPGUnit for ILE RPG in 2026: Test Cases, TDD, and CI Integration',
            '_aioseo_twitter_description'        => 'A step-by-step guide to RPGUnit on IBM i: installation, writing assertions, test suites, TAP output, and CI pipeline integration with Bob and Jenkins.',
            'rank_math_focus_keyword'            => 'RPG unit testing RPGUnit ILE RPG test cases TDD IBM i',
            'rank_math_description'              => 'Master RPGUnit for ILE RPG in 2026. Install the framework, write test cases with assertions, build test suites, run RURUN, parse TAP output, and wire automated RPG tests into a Bob or Jenkins CI pipeline.',
            'rank_math_title'                    => 'RPG Unit Testing with RPGUnit 2026: ILE RPG Test Cases, TDD and CI %sep% %sitename%',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post41_use_classic', 10, 2);
function as400_post41_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post41', true) === '1') return false;
    return $use_block_editor;
}
