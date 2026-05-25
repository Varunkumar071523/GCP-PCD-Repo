<?php
/**
 * Plugin Name: AS400 Decoded - Post 39 Vector Search and Embeddings on IBM i
 * Description: Publishes Post 39 with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_post39_exists');
function as400_ensure_post39_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_post39',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('ibm-i-vector-search-embeddings-db2-ai-semantic-search-2026', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_post39', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('ai-for-ibm-i');
    if (!$cat) $cat = get_category_by_slug('db2-for-i');
    if (!$cat) $cat = get_category_by_slug('modern-integrations');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        'IBM i vector search',
        'DB2 for i embeddings',
        'IBM i semantic search',
        'IBM i AI embeddings',
        'OpenAI embeddings IBM i',
        'watsonx embeddings IBM i',
        'IBM i cosine similarity SQL',
        'DB2 for i vector storage',
        'IBM i RAG',
        'IBM i AI 2026',
        'IBM i natural language search',
        'QSYS2.HTTP_POST embeddings',
        'IBM i Python embeddings',
        'IBM i knowledge base AI',
        'DB2 for i JSON vectors',
        'IBM i AI integration 2026',
        'IBM i embedding pipeline',
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/post39-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'Vector Search and Embeddings on IBM i in 2026: Storing Vectors in DB2 for i, Cosine Similarity in SQL, and Semantic Search over IBM i Data',
        'post_name'     => 'ibm-i-vector-search-embeddings-db2-ai-semantic-search-2026',
        'post_content'  => $content,
        'post_excerpt'  => 'Vector search and text embeddings bring semantic search to IBM i in 2026 — converting DB2 for i text fields into float arrays via OpenAI or watsonx.ai, storing vectors as VARBINARY or JSON in DB2, computing cosine similarity in SQL, and building RAG pipelines that ground LLM answers in real IBM i business data. This post covers the full embedding pipeline from generation to retrieval.',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-06-12 08:00:00',
        'post_date_gmt' => '2026-06-12 02:30:00',
        'meta_input'    => array(
            '_as400_post39'                      => '1',
            '_yoast_wpseo_title'                 => 'Vector Search and Embeddings on IBM i 2026: DB2 Vectors, Cosine Similarity SQL, Semantic Search',
            '_yoast_wpseo_metadesc'              => 'Build semantic search on IBM i in 2026 — generate embeddings with OpenAI or watsonx.ai, store vectors in DB2 for i, write cosine similarity SQL, and implement a RAG pipeline over IBM i business data.',
            '_yoast_wpseo_focuskw'               => 'IBM i vector search embeddings DB2 cosine similarity semantic search AI',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/ibm-i-vector-search-embeddings-db2-ai-semantic-search-2026/',
            '_yoast_wpseo_opengraph-title'       => 'Vector Search and Embeddings on IBM i 2026: DB2 Vectors, Cosine Similarity SQL, Semantic Search',
            '_yoast_wpseo_opengraph-description' => 'Semantic search for IBM i in 2026 — generate embeddings, store vectors in DB2 for i, cosine similarity in SQL, and RAG with GPT-4o or Granite over IBM i data.',
            '_yoast_wpseo_twitter-title'         => 'IBM i Vector Search & Embeddings 2026: DB2 Cosine Similarity, Semantic Search, RAG',
            '_yoast_wpseo_twitter-description'   => 'Add semantic search to IBM i — embeddings with OpenAI/watsonx.ai, vector storage in DB2 for i, cosine similarity SQL, and RAG pipelines.',
            '_aioseo_title'                      => 'Vector Search and Embeddings on IBM i 2026: DB2 Vectors, Cosine Similarity SQL, Semantic Search',
            '_aioseo_description'                => 'Build semantic search on IBM i in 2026 — generate embeddings with OpenAI or watsonx.ai, store vectors in DB2 for i, write cosine similarity SQL, and implement a RAG pipeline over IBM i business data.',
            '_aioseo_keywords'                   => 'IBM i vector search, DB2 for i embeddings, IBM i semantic search, IBM i cosine similarity SQL, OpenAI embeddings IBM i, watsonx embeddings IBM i, IBM i RAG, DB2 for i vector storage',
            '_aioseo_og_title'                   => 'Vector Search and Embeddings on IBM i 2026: DB2 Vectors, Cosine Similarity SQL, Semantic Search',
            '_aioseo_og_description'             => 'Semantic search for IBM i in 2026 — generate embeddings, store vectors in DB2 for i, cosine similarity in SQL, and RAG with GPT-4o or Granite over IBM i data.',
            '_aioseo_twitter_title'              => 'IBM i Vector Search & Embeddings 2026: DB2 Cosine Similarity, Semantic Search, RAG',
            '_aioseo_twitter_description'        => 'Add semantic search to IBM i — embeddings with OpenAI/watsonx.ai, vector storage in DB2 for i, cosine similarity SQL, and RAG pipelines.',
            'rank_math_focus_keyword'            => 'IBM i vector search embeddings DB2 cosine similarity semantic search AI',
            'rank_math_description'              => 'Build semantic search on IBM i in 2026 — generate embeddings with OpenAI or watsonx.ai, store vectors in DB2 for i, write cosine similarity SQL, and implement a RAG pipeline over IBM i business data.',
            'rank_math_title'                    => 'Vector Search and Embeddings on IBM i 2026: DB2 Vectors, Cosine Similarity SQL, Semantic Search',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_post39_use_classic', 10, 2);
function as400_post39_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_post39', true) === '1') return false;
    return $use_block_editor;
}
