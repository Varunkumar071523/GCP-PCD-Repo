# AS400 Decoded — New Post Creation Prompt
# Copy everything below this line and paste it into a new Claude Code window

---

## YOUR TASK

You are helping maintain the blog **AS400 Decoded** (site: `as400decoded.com`).
The blog teaches IBM i / AS400 / iSeries topics. Posts are published as WordPress plugin files.

Create **7 new posts** (or the number the user specifies) continuing from the last post number.
Each post requires **two files** per the exact structure below.

---

## WORKING DIRECTORY

`C:\Work Folder CVS\AS400 KB\`

Each post lives in its own subfolder:
```
as400-postNN\
    as400-postNN.php        ← WordPress plugin that creates the post
    postNN-content.html     ← The actual blog post HTML content
```

---

## STEP 1 — DETERMINE THE NEXT POST NUMBER

Run this PowerShell to find the highest existing post number:
```powershell
Get-ChildItem "C:\Work Folder CVS\AS400 KB\" -Directory |
  Where-Object { $_.Name -match '^as400-post(\d+)$' } |
  ForEach-Object { [int]($_.Name -replace 'as400-post','') } |
  Sort-Object | Select-Object -Last 1
```
Start numbering from (that result + 1).

---

## PUBLISHING SCHEDULE

- One post per day, published at **08:00:00 IST** = **02:30:00 UTC**
- Check the last post's `post_date` in its PHP file and increment by one day per post
- Format: `'post_date' => '2026-MM-DD 08:00:00'` and `'post_date_gmt' => '2026-MM-DD 02:30:00'`

---

## CATEGORIES TO SPREAD ACROSS (use different ones — do not repeat the same category two days in a row)

| Category Label | WordPress Slug |
|---|---|
| RPG Programming | `rpg-cl-development` |
| CL Commands | `cl-commands` |
| DB2 for i | `db2-for-i` |
| IFS & File Systems | `ifs-file-systems` |
| Modern Integrations | `modern-integrations` |
| Operations & Admin | `operations-admin` |
| AI for IBM i | `ai-for-ibm-i` |
| APIs & Integration | `apis-integration` |
| Modernization | `modernization` |

In each PHP file the category lookup uses three fallback slugs (primary → secondary → tertiary):
```php
$cat = get_category_by_slug('primary-slug');
if (!$cat) $cat = get_category_by_slug('secondary-slug');
if (!$cat) $cat = get_category_by_slug('tertiary-slug');
```

---

## ALL TOPICS ALREADY PUBLISHED (DO NOT DUPLICATE)

Post 16 — IBM i Security Hardening
Post 17 — IBM i DevOps Pipeline
Post 18 — IBM i Observability
Post 19 — IBM i Cloud Connectivity
Post 20 — CL Control Language
Post 21 — RPG Modern Free-Format
Post 22 — DB2 for i
Post 23 — IBM i Security
Post 24 — IBM i IFS
Post 25 — AI for IBM i
Post 26 — Node.js on IBM i
Post 27 — IBM i Performance Tuning
Post 28 — DB2 for i Advanced SQL
Post 29 — IBM i System Operations CL
Post 30 — IBM i IFS Advanced
Post 31 — Advanced ILE RPG APIs
Post 32 — Python on IBM i
Post 33 — IBM i High Availability and Disaster Recovery
Post 34 — IBM i PTF Management and OS Upgrades
Post 35 — Display Files and 5250 UX Modernisation
Post 36 — IBM i and Apache Kafka Event Streaming
Post 37 — DB2 for i Replication and CDC
Post 38 — IBM i Save and Restore Strategy
Post 39 — Vector Search and Embeddings on IBM i
Post 40 — IBM i Application Modernisation Roadmap
Post 41 — RPG Unit Testing with RPGUnit
Post 42 — DB2 for i Triggers
Post 43 — HTTP REST API Calls from RPG with HTTPAPI
Post 44 — IBM i System Startup and Shutdown Procedures
Post 45 — AI-Assisted Legacy Code Documentation on IBM i
Post 46 — DB2 for i SQL Stored Procedures and UDFs
Post 47 — IBM i Security Hardening (second deep-dive)
Post 48 — IBM i Message Files and Exception Handling in CL
Post 49 — IBM i ILE Binding, Activation Groups, and Service Programs
Post 50 — DB2 for i JSON and XML Support
Post 51 — IBM i Integration with Microsoft Azure
Post 52 — IBM i Work Management in Depth
Post 53 — IBM Merlin and VS Code for IBM i Development
Post 54 — IBM i PASE Deep Dive
Post 55 — RPG Data Structures in Depth (LIKEDS, qualified DS, EXTNAME, LIKEREC)
Post 56 — CL Error Handling and Exception Management (MONMSG, SNDPGMMSG, DMPJOB)
Post 57 — DB2 for i Query Optimization (Visual Explain, SQE, EVI, STRDBMON, plan cache)
Post 58 — OAuth 2.0 and JWT Authentication from IBM i
Post 59 — AI-Assisted RPG Modernization (CVTRPGSRC, LLM refactoring, test generation)
Post 60 — IBM i Journal Management (STRJRNOBJ, receivers, DSPJRN, remote journaling, QAUDJRN)

---

## TOPIC IDEAS (pick from here or suggest your own — avoid repeats above)

**RPG Programming**
- RPG subfile programming (SFLCTL, SFLPAG, SFLDSP, paging)
- RPG service program design and binding directories
- RPG date/time handling (%DATE, %DIFF, %ADDUR, CEE APIs)
- RPG string handling (%SCAN, %SUBST, %REPLACE, varchar fields)
- RPG error handling with monitor/on-error blocks
- RPG multi-threading (*CONCURRENT)
- RPG XML parsing with XML-SAX and XML-INTO
- RPG embedded SQL cursor patterns (open/fetch/close, scrollable cursors)

**CL Commands**
- CL program variables, expressions, and string manipulation
- Job scheduling with ADDJOBSCDE and IBM i scheduler
- CL data areas and data queues for inter-program communication
- Output queue and spooled file management from CL
- Network attributes and TCP/IP configuration from CL
- User profile management and authority from CL

**DB2 for i**
- DB2 for i CTEs (Common Table Expressions) and recursive SQL
- DB2 for i window functions (ROW_NUMBER, RANK, LAG, LEAD)
- DB2 for i temporal tables and time travel queries
- DB2 for i global variables and session variables
- IBM i Access Client Solutions (ACS) SQL scripting
- DB2 for i partitioned tables and large object handling

**IFS & File Systems**
- IFS permissions and security (CHGAUT, CHGOWN, ACLs)
- IFS stream file I/O from RPG (open/read/write IFS APIs)
- Working with ZIP files in the IFS using PASE tools
- IFS symbolic links and their authority implications
- FTP and SFTP automation from IBM i CL and PASE

**Modern Integrations**
- IBM i and GraphQL (Node.js server, RPG client)
- IBM MQ messaging from IBM i
- IBM i and gRPC using PASE and Node.js
- IBM i and Redis for caching
- IBM i and MongoDB using PASE drivers
- IBM i outbound email (SNDDST, PASE sendmail, SMTP via RPG)

**Operations & Admin**
- IBM i output queue and print management
- IBM i licensed program object (LPO) and object signing
- IBM i network job table (NJT) and distributed jobs
- IBM i TCP/IP configuration and troubleshooting
- IBM i memory pools and pool sizing
- IBM i disk management and ASPs

**AI for IBM i**
- IBM watsonx on Power: deploying AI inference near IBM i data
- Using Claude API / OpenAI API from IBM i PASE
- AI-driven anomaly detection on IBM i operational data
- Building a RAG (retrieval-augmented generation) pipeline with IBM i DB2 data

**APIs & Integration**
- Building a REST API server on IBM i with Node.js and Express
- IBM i XMLSERVICE and itoolkit for remote IBM i API calls
- IBM i and Swagger/OpenAPI documentation
- Db2 for i as a REST data source via IBM i Db2 Web Query

**Modernization**
- Strangler fig pattern for IBM i application modernization
- Event-driven architecture on IBM i
- IBM i and microservices: decomposing monolithic RPG applications
- IBM i containerization strategy (IBM i workloads alongside containers)

---

## EXACT FILE TEMPLATES

### Template A — PHP Plugin File (`as400-postNN.php`)

Replace every `NN` with the post number, `SLUG` with the URL slug, etc.

```php
<?php
/**
 * Plugin Name: AS400 Decoded - Post NN [SHORT TOPIC TITLE]
 * Description: Publishes Post NN with SEO metadata, tags, custom slug, no Gutenberg
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', 'as400_ensure_postNN_exists');
function as400_ensure_postNN_exists() {

    $existing = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'future'),
        'posts_per_page' => 1,
        'meta_key'       => '_as400_postNN',
        'meta_value'     => '1',
    ));
    if (!empty($existing)) return;

    $by_slug = get_page_by_path('YOUR-URL-SLUG-HERE', OBJECT, 'post');
    if ($by_slug) {
        add_post_meta($by_slug->ID, '_as400_postNN', '1', true);
        return;
    }

    // ── Category ──────────────────────────────────
    $cat = get_category_by_slug('primary-category-slug');
    if (!$cat) $cat = get_category_by_slug('secondary-category-slug');
    if (!$cat) $cat = get_category_by_slug('tertiary-category-slug');
    $cat_id = $cat ? $cat->term_id : 1;

    // ── Tags ──────────────────────────────────────
    $tag_names = array(
        'IBM i',
        'AS400',
        'iSeries',
        // ADD 15-17 MORE SPECIFIC TAGS FOR THIS POST'S TOPIC
    );
    $tag_ids = array();
    foreach ($tag_names as $tag) {
        $term = term_exists($tag, 'post_tag');
        if (!$term) $term = wp_insert_term($tag, 'post_tag');
        if (!is_wp_error($term)) {
            $tag_ids[] = is_array($term) ? (int) $term['term_id'] : (int) $term;
        }
    }

    $content = file_get_contents(dirname(__FILE__) . '/postNN-content.html');

    $post_id = wp_insert_post(array(
        'post_title'    => 'FULL LONG POST TITLE HERE',
        'post_name'     => 'YOUR-URL-SLUG-HERE',
        'post_content'  => $content,
        'post_excerpt'  => 'CONCISE 1-2 SENTENCE EXCERPT FOR SEARCH SNIPPETS',
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_category' => array($cat_id),
        'tags_input'    => $tag_ids,
        'post_author'   => 1,
        'post_date'     => '2026-MM-DD 08:00:00',
        'post_date_gmt' => '2026-MM-DD 02:30:00',
        'meta_input'    => array(
            '_as400_postNN'                      => '1',
            '_yoast_wpseo_title'                 => 'YOAST TITLE (60 chars max)',
            '_yoast_wpseo_metadesc'              => 'YOAST META DESCRIPTION (155 chars max)',
            '_yoast_wpseo_focuskw'               => 'PRIMARY FOCUS KEYWORD PHRASE',
            '_yoast_wpseo_canonical'             => 'https://as400decoded.com/YOUR-URL-SLUG-HERE/',
            '_yoast_wpseo_opengraph-title'       => 'OG TITLE',
            '_yoast_wpseo_opengraph-description' => 'OG DESCRIPTION',
            '_yoast_wpseo_twitter-title'         => 'TWITTER TITLE',
            '_yoast_wpseo_twitter-description'   => 'TWITTER DESCRIPTION',
            '_aioseo_title'                      => 'AIOSEO TITLE',
            '_aioseo_description'                => 'AIOSEO DESCRIPTION',
            '_aioseo_keywords'                   => 'keyword1, keyword2, keyword3, keyword4',
            '_aioseo_og_title'                   => 'AIOSEO OG TITLE',
            '_aioseo_og_description'             => 'AIOSEO OG DESCRIPTION',
            '_aioseo_twitter_title'              => 'AIOSEO TWITTER TITLE',
            '_aioseo_twitter_description'        => 'AIOSEO TWITTER DESCRIPTION',
            'rank_math_focus_keyword'            => 'PRIMARY FOCUS KEYWORD PHRASE',
            'rank_math_description'              => 'RANK MATH DESCRIPTION',
            'rank_math_title'                    => 'RANK MATH TITLE',
            '_classic_editor_enabled'            => 'classic',
        ),
    ));

    if ($post_id && !is_wp_error($post_id) && !empty($tag_ids)) {
        wp_set_post_tags($post_id, $tag_ids, false);
    }
}

add_filter('use_block_editor_for_post', 'as400_postNN_use_classic', 10, 2);
function as400_postNN_use_classic($use_block_editor, $post) {
    if (!$post) return $use_block_editor;
    if (get_post_meta($post->ID, '_as400_postNN', true) === '1') return false;
    return $use_block_editor;
}
```

---

### Template B — HTML Content File (`postNN-content.html`)

**Structure (follow this exactly):**

```html
<p>The previous post covered [RECAP OF PRIOR POST TOPIC — 1-2 sentences]. 
This post covers [THIS POST'S TOPIC]: [list the 4-6 specific aspects covered].</p>

<h2>Section 1 Title</h2>
<p>...</p>
<ul>
  <li><strong>Item</strong> — explanation</li>
</ul>

<h2>Section 2 Title</h2>
<p>...</p>
<pre>
/* Code example — use real IBM i commands, RPG, CL, or SQL */
/* Always use realistic field names, library names (APPLIB, ORDLIB etc.) */
EXAMPLE COMMAND OR CODE HERE
</pre>

<!-- Repeat 6–9 H2 sections total, each with explanatory paragraphs + code -->

<em>Next post: [TEASER — describe the NEXT post's topic in 1 sentence including 
the key technical terms that will be covered].</em>
```

**Content rules:**
- Opening `<p>` always references the previous post topic so the series chains together
- Every section must have at least one code sample in `<pre>` tags OR a bullet list
- Code must be realistic: use library names like `APPLIB`, `ORDLIB`, `SALESLIB`; user names like `DEVUSER`; file names that make sense for the topic
- Do NOT use placeholder text — write complete, working code examples
- The closing `<em>Next post:...</em>` teases the FOLLOWING day's post topic
- Target length: 300–400 lines of HTML (similar depth to a thorough technical blog post)
- Use `<table>` for comparisons (like PASE vs QShell), `<ol>` for numbered steps, `<ul>` for feature lists

---

## CREATION WORKFLOW

1. Run the PowerShell command above to get the last post number
2. Decide the 7 topics — one per category, no two consecutive posts in the same category
3. For each post N (from last+1 to last+7):
   a. Create directory: `New-Item -ItemType Directory -Force "C:\Work Folder CVS\AS400 KB\as400-postN"`
   b. Write `as400-postN\as400-postN.php` (PHP plugin)
   c. Write `as400-postN\postN-content.html` (blog HTML content)
4. Create all 14 files (7 PHP + 7 HTML) using parallel Write tool calls where possible

---

## QUALITY CHECKLIST (verify before finishing)

- [ ] Post numbers are sequential (no gaps)
- [ ] Post dates increment by exactly 1 day each
- [ ] post_date_gmt = post_date time − 5h30m (IST to UTC)
- [ ] Each post has a unique category (no two consecutive posts share a category)
- [ ] Each post has 18–20 tags (always includes 'IBM i', 'AS400', 'iSeries' as first 3)
- [ ] Function names all include the post number: `as400_ensure_postNN_exists`, `as400_postNN_use_classic`
- [ ] Meta key `_as400_postNN` matches the post number everywhere it appears (7 occurrences in PHP)
- [ ] Slug in `post_name`, `_yoast_wpseo_canonical`, and `get_page_by_path` are identical
- [ ] HTML file opens with a sentence referencing the previous post
- [ ] HTML file closes with `<em>Next post: ...</em>` teaser
- [ ] No topic from the "already published" list above is duplicated
- [ ] Code examples use realistic IBM i identifiers (not foo/bar placeholders)

---

## EXAMPLE — what a correct post looks like

See any of these existing files for reference:
- `C:\Work Folder CVS\AS400 KB\as400-post53\as400-post53.php`
- `C:\Work Folder CVS\AS400 KB\as400-post53\post53-content.html`
- `C:\Work Folder CVS\AS400 KB\as400-post60\as400-post60.php`
- `C:\Work Folder CVS\AS400 KB\as400-post60\post60-content.html`

Read these files first to calibrate the expected depth and style before writing new posts.

---

## HOW TO START

Paste this entire prompt, then tell the model:

> "Create the next 7 posts starting from post [N+1]. 
>  Use categories: [list 7 categories you want covered, one per day]."

Or simply:

> "Create the next 7 posts. Pick the categories yourself, spread them across 
>  different areas — don't repeat the same category two days in a row."
