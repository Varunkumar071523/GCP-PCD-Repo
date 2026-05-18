<?php
/**
 * Plugin Name: AS400 Decoded — Auto Post: CL Job Scheduling
 * Description: Creates a single SEO-optimised article in the CL Commands category. Activate the plugin to publish the post, then deactivate and delete the plugin.
 * Version:     1.0.0
 * Author:      AS400 Decoded
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_activation_hook( __FILE__, 'as400_create_cl_job_scheduling_post' );

function as400_create_cl_job_scheduling_post() {

	/* ------------------------------------------------------------------ *
	 * 1. Guard — don't create duplicate if post already exists
	 * ------------------------------------------------------------------ */
	$existing = get_page_by_path( 'cl-job-scheduling-ibm-i-sbmjob-wrkjobscde-automate-batch', OBJECT, 'post' );
	if ( $existing ) {
		return;
	}

	/* ------------------------------------------------------------------ *
	 * 2. Resolve category — find or create "CL Commands"
	 * ------------------------------------------------------------------ */
	$cat = get_term_by( 'name', 'CL Commands', 'category' );
	if ( ! $cat ) {
		$cat_id = wp_insert_term( 'CL Commands', 'category', array(
			'slug'        => 'cl-commands',
			'description' => 'Control language scripting, job management, and automation on IBM AS400.',
		) );
		$cat_id = is_wp_error( $cat_id ) ? 1 : $cat_id['term_id'];
	} else {
		$cat_id = $cat->term_id;
	}

	/* ------------------------------------------------------------------ *
	 * 3. Post content
	 * ------------------------------------------------------------------ */
	$content = <<<'HTML'
<p>Every IBM i shop runs batch jobs. End-of-day processing, report generation, file transfers, data archiving — these are the jobs nobody watches, the ones that are supposed to run overnight and finish quietly before the morning shift arrives. When they work, nobody notices. When they fail, everyone does.</p>

<p>CL is the language you use to build, submit, schedule, and monitor those jobs. This post covers the commands that matter most: <code>SBMJOB</code> for submitting work to batch, <code>WRKJOBSCDE</code> for scheduling recurring jobs, and the monitoring patterns that tell you when something went wrong before your manager does.</p>

<h2>How IBM i batch processing works</h2>

<p>On IBM i, every running program runs inside a <em>job</em>. Interactive jobs are the ones users log into. Batch jobs run in the background, in subsystems designed for that purpose — typically <code>QBATCH</code> or a custom batch subsystem your shop has defined.</p>

<p>When you submit a job, you are asking the system to run a program (or CL command) as a separate, independent job — completely detached from your own session. The submitting job does not wait. It fires the request and moves on.</p>

<p>The batch job runs under its own user profile, its own job description, its own library list. Getting those right is most of what job submission is actually about.</p>

<h2>SBMJOB — the command you will use every day</h2>

<p>The basic form is simple:</p>

<pre><code>SBMJOB CMD(CALL PGM(MYLIB/NIGHTLY))</code></pre>

<p>That submits a job to <code>QBATCH</code> using your current job description. In practice you will almost always specify more:</p>

<pre><code>SBMJOB CMD(CALL PGM(MYLIB/NIGHTLY) PARM('FULL' '20260518')) +
       JOB(NIGHTLYRPT)         +
       JOBD(MYLIB/BATCHJD)     +
       JOBQ(MYLIB/BATCHQ)      +
       OUTQ(MYLIB/BATCHOUTQ)   +
       USER(BATCHUSR)          +
       LOGCLPGM(*YES)          +
       MSGQ(MYLIB/BATCHMSGQ)</code></pre>

<p>What each parameter does:</p>

<ul>
  <li><strong>CMD</strong> — the program or command to run. You can pass parameters here exactly like a direct CALL.</li>
  <li><strong>JOB</strong> — the name that appears in WRKACTJOB and the job log. Use something meaningful.</li>
  <li><strong>JOBD</strong> — job description, which controls library list, message logging, and dozens of other attributes. Always specify this explicitly in production.</li>
  <li><strong>JOBQ</strong> — the queue the job waits in until a subsystem picks it up. Different queues can have different priorities and run under different subsystems.</li>
  <li><strong>OUTQ</strong> — where spooled output (reports, printed output) goes. Separate from your interactive output queue.</li>
  <li><strong>USER</strong> — the user profile the batch job runs under. In production this is almost always a dedicated batch user, not a person's profile.</li>
  <li><strong>LOGCLPGM(*YES)</strong> — logs every CL command that executes into the job log. Invaluable for debugging. Turn it on for any job that does real work.</li>
  <li><strong>MSGQ</strong> — where completion and error messages are sent. If you specify a message queue here you can monitor it programmatically.</li>
</ul>

<h2>Passing parameters to batch jobs</h2>

<p>Parameters in <code>SBMJOB</code> are passed as part of the CMD parameter. CL passes everything as character strings:</p>

<pre><code>DCL VAR(&RUNDATE) TYPE(*CHAR) LEN(8)
DCL VAR(&RUNTYPE) TYPE(*CHAR) LEN(4)

RTVSYSVAL SYSVAL(QDATE) RTNVAR(&RUNDATE)
CHGVAR VAR(&RUNTYPE) VALUE('FULL')

SBMJOB CMD(CALL PGM(MYLIB/NIGHTLY) PARM(&RUNTYPE &RUNDATE)) +
       JOB(NIGHTLYRPT) +
       JOBD(MYLIB/BATCHJD)</code></pre>

<p>Your RPG program receives these as its <code>*ENTRY</code> parameters. Make sure the lengths match what the program expects — CL does not enforce types at the boundary.</p>

<h2>Holding and releasing jobs</h2>

<p>Sometimes you want to submit a job but not let it run yet — useful when you need to set something up first, or when you want jobs queued but held until you are ready to release them at a specific time.</p>

<pre><code>/* Submit held — job sits in queue but will not start */
SBMJOB CMD(CALL PGM(MYLIB/MONTHEND)) +
       JOB(MONTHEND) +
       JOBD(MYLIB/BATCHJD) +
       HOLD(*YES)

/* Later — release it to run */
RLSJOB JOB(MONTHEND)</code></pre>

<p>You can also hold an entire job queue and release it when the time is right:</p>

<pre><code>HLDJOBQ JOBQ(MYLIB/BATCHQ)
/* ... set up, load files, verify data ... */
RLSJOBQ JOBQ(MYLIB/BATCHQ)</code></pre>

<h2>WRKJOBSCDE — scheduling recurring jobs</h2>

<p>IBM i has a built-in job scheduler that most shops underuse. <code>WRKJOBSCDE</code> (Work with Job Schedule Entries) gives you a screen to view and manage scheduled jobs. To add an entry from CL:</p>

<pre><code>ADDJOBSCDE JOB(DAILYRPT)              +
           CMD(CALL PGM(MYLIB/DAILYRPT) PARM('DAILY')) +
           FRQ(*WEEKLY)               +
           SCDDAY(*MON *TUE *WED *THU *FRI) +
           SCDTIME(220000)            +
           JOBD(MYLIB/BATCHJD)        +
           USER(BATCHUSR)             +
           TEXT('Daily report — weeknights at 22:00')</code></pre>

<p>Key parameters:</p>

<ul>
  <li><strong>FRQ</strong> — frequency: <code>*ONCE</code>, <code>*WEEKLY</code>, <code>*MONTHLY</code>. For daily use <code>*WEEKLY</code> with all days listed.</li>
  <li><strong>SCDDAY</strong> — which days to run. <code>*ALL</code> for every day, or list specific days.</li>
  <li><strong>SCDTIME</strong> — time in HHMMSS format. <code>220000</code> means 22:00:00.</li>
  <li><strong>OMITDAY</strong> — days to skip, useful for excluding weekends from a *WEEKLY job.</li>
</ul>

<p>To modify an existing entry:</p>

<pre><code>CHGJOBSCDE JOB(DAILYRPT) SCDTIME(210000)</code></pre>

<p>To remove one:</p>

<pre><code>RMVJOBSCDE JOB(DAILYRPT)</code></pre>

<p>The scheduler is reliable and survives IPL (system restart). For most shops it is the right place for recurring batch work rather than third-party schedulers — unless you need cross-system dependencies or advanced calendar logic.</p>

<h2>Checking job status from CL</h2>

<p>After submitting a job you often need to know whether it finished — especially when one job depends on the output of another. The <code>CHKJOB</code> approach uses <code>RTVJOBA</code> and a loop:</p>

<pre><code>DCL VAR(&JOBNAME)   TYPE(*CHAR) LEN(10) VALUE('NIGHTLYRPT')
DCL VAR(&JOBSTS)    TYPE(*CHAR) LEN(10)
DCL VAR(&WAITCOUNT) TYPE(*DEC)  LEN(3 0) VALUE(0)
DCL VAR(&MAXWAIT)   TYPE(*DEC)  LEN(3 0) VALUE(60)

CHKJOB: CHKOBJ OBJ(QSYS/&JOBNAME) OBJTYPE(*JOBD)
MONMSG MSGID(CPF9801) EXEC(GOTO CMDLBL(JOBDONE))

/* Job still active — wait 60 seconds and check again */
DLYJOB DLY(60)
CHGVAR VAR(&WAITCOUNT) VALUE(&WAITCOUNT + 1)

IF COND(&WAITCOUNT >= &MAXWAIT) THEN(DO)
  SNDPGMMSG MSG('Timeout waiting for NIGHTLYRPT') MSGTYPE(*ESCAPE)
ENDDO

GOTO CMDLBL(CHKJOB)

JOBDONE:
SNDPGMMSG MSG('NIGHTLYRPT completed — proceeding') MSGTYPE(*INFO)</code></pre>

<p><code>DLYJOB DLY(60)</code> pauses the CL program for 60 seconds before checking again. The timeout guard prevents an infinite loop if the job hangs.</p>

<h2>Reading completion messages from a batch job</h2>

<p>A more robust pattern is to have the batch job send a message to a known message queue when it finishes — success or failure — and have the monitoring job wait on that queue:</p>

<pre><code>/* In the batch job — send completion status */
SNDMSG MSG('NIGHTLYRPT completed successfully') TOUSR(BATCHUSR) +
       MSGTYPE(*INFO)

/* Or on failure */
SNDMSG MSG('NIGHTLYRPT FAILED — see job log') TOUSR(BATCHUSR) +
       MSGTYPE(*INFO)</code></pre>

<p>A better version uses a dedicated message queue and <code>RCVMSG</code> in the monitoring job:</p>

<pre><code>/* Monitoring job waits on the message queue */
DCL VAR(&MSGTEXT) TYPE(*CHAR) LEN(256)

RCVMSG MSGQ(MYLIB/BATCHMSGQ) WAIT(3600) MSGDTA(&MSGTEXT)
MONMSG MSGID(CPF2410) EXEC(DO)
  /* CPF2410 = timeout, no message received */
  SNDPGMMSG MSG('Timed out waiting for batch completion') +
             MSGTYPE(*ESCAPE)
ENDDO

IF COND(%SST(&MSGTEXT 1 6) = 'FAILED') THEN(DO)
  SNDPGMMSG MSG('Batch job reported failure') MSGTYPE(*ESCAPE)
ENDDO</code></pre>

<p><code>WAIT(3600)</code> tells <code>RCVMSG</code> to wait up to 3600 seconds (one hour) for a message. If nothing arrives, it raises CPF2410 which you can monitor.</p>

<h2>A complete job submission wrapper</h2>

<p>Putting the patterns together, here is a CL program that submits a batch job, waits for confirmation, and handles failure:</p>

<pre><code>PGM PARM(&RUNDATE)

DCL VAR(&RUNDATE)  TYPE(*CHAR) LEN(8)
DCL VAR(&MSGTEXT)  TYPE(*CHAR) LEN(256)
DCL VAR(&JOBLOG)   TYPE(*CHAR) LEN(100)

/* Clear the reply queue before submitting */
CLRMSGQ MSGQ(MYLIB/BATCHMSGQ)
MONMSG MSGID(CPF0000)

/* Submit the batch job */
SBMJOB CMD(CALL PGM(MYLIB/NIGHTLY) PARM('FULL' &RUNDATE)) +
       JOB(NIGHTLYRPT)       +
       JOBD(MYLIB/BATCHJD)   +
       JOBQ(MYLIB/BATCHQ)    +
       USER(BATCHUSR)        +
       LOGCLPGM(*YES)        +
       MSGQ(MYLIB/BATCHMSGQ)
MONMSG MSGID(CPF0000) EXEC(DO)
  SNDPGMMSG MSG('Failed to submit NIGHTLY job') MSGTYPE(*ESCAPE)
ENDDO

SNDPGMMSG MSG('NIGHTLYRPT submitted — waiting for completion') +
           MSGTYPE(*INFO)

/* Wait up to 2 hours for the batch job to reply */
RCVMSG MSGQ(MYLIB/BATCHMSGQ) WAIT(7200) MSGDTA(&MSGTEXT)
MONMSG MSGID(CPF2410) EXEC(DO)
  SNDPGMMSG MSG('Timeout: NIGHTLYRPT did not complete in 2 hours') +
             MSGTYPE(*ESCAPE)
ENDDO

/* Check the reply */
IF COND(%SST(&MSGTEXT 1 2) *NE 'OK') THEN(DO)
  CHGVAR VAR(&JOBLOG) VALUE('Job failed. Check BATCHMSGQ or job log.')
  SNDPGMMSG MSG(&JOBLOG) MSGTYPE(*ESCAPE)
ENDDO

SNDPGMMSG MSG('Nightly run completed successfully') MSGTYPE(*INFO)
RETURN

ENDPGM</code></pre>

<h2>Common mistakes and how to avoid them</h2>

<p><strong>Using your own user profile for batch jobs.</strong> When the person who set up the job leaves the company and their profile is disabled, every batch job that ran under their profile stops working. Always use a dedicated batch user profile — one that belongs to the application, not a person.</p>

<p><strong>Not specifying JOBD.</strong> If you omit <code>JOBD</code>, the job inherits your current job description. That is almost never what you want in production. Specify the job description explicitly so the library list, logging level, and message routing are always predictable.</p>

<p><strong>Forgetting LOGCLPGM(*YES).</strong> When a batch job fails and nobody turned on CL logging, the job log contains almost nothing useful. It takes seconds to add and saves hours when things go wrong.</p>

<p><strong>Submitting to QBATCH directly in production.</strong> Default <code>QBATCH</code> mixes all batch work together. A long-running job can block a short urgent one. Separate job queues for different work types give you control over priority and throughput.</p>

<p><strong>No timeout on RCVMSG.</strong> If a batch job hangs and never sends a completion message, <code>RCVMSG</code> without a timeout waits forever — tying up the monitoring job indefinitely. Always specify <code>WAIT</code>.</p>

<h2>Commands worth knowing next</h2>

<p>Once SBMJOB and WRKJOBSCDE are comfortable, these are the natural next steps:</p>

<ul>
  <li><strong>WRKACTJOB</strong> — see all active jobs on the system, their status, CPU usage, and which lock they might be waiting on.</li>
  <li><strong>ENDJOB</strong> — end a stuck or runaway batch job cleanly (<code>OPTION(*CNTRLD)</code>) or forcibly (<code>OPTION(*IMMED)</code>).</li>
  <li><strong>WRKJOB</strong> — drill into a specific job to see its job log, open files, locks, and call stack.</li>
  <li><strong>DSPJOBLOG</strong> — display the full job log for a completed job, which lives in <code>QHST</code> after the job ends.</li>
  <li><strong>STRJOBD / CHGJOBSCDE</strong> — manage job descriptions and scheduler entries programmatically from automated deployment scripts.</li>
</ul>

<p>Batch job management is one of those areas where a small investment in understanding pays back every single day. The jobs run overnight, unattended, on a schedule nobody thinks about — until one fails. The patterns in this post are what make the difference between a failure that wakes someone up at 2am and one that sends a clean error message to a queue, waits for the morning team, and tells them exactly what to fix.</p>

<p><em>Next: Writing CL programs that manage the IFS — reading directories, moving files, and handling the integrated file system from your batch routines.</em></p>
HTML;

	/* ------------------------------------------------------------------ *
	 * 4. SEO meta (Yoast / RankMath compatible via post meta)
	 * ------------------------------------------------------------------ */
	$seo_title       = 'CL Job Scheduling on IBM i: SBMJOB, WRKJOBSCDE & Batch Automation';
	$seo_description = 'Learn how to submit, schedule, and monitor batch jobs on IBM i using SBMJOB and WRKJOBSCDE. Includes complete CL examples, error handling, and production-ready patterns.';
	$focus_keyword   = 'IBM i job scheduling CL commands';

	/* ------------------------------------------------------------------ *
	 * 5. Insert the post
	 * ------------------------------------------------------------------ */
	$post_data = array(
		'post_title'    => 'CL job scheduling on IBM i: SBMJOB, WRKJOBSCDE, and automating batch work',
		'post_name'     => 'cl-job-scheduling-ibm-i-sbmjob-wrkjobscde-automate-batch',
		'post_content'  => $content,
		'post_excerpt'  => 'IBM i batch jobs are the ones nobody watches — until one fails. This post covers SBMJOB, WRKJOBSCDE, job queues, completion monitoring, and the production patterns that keep overnight processing reliable.',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_category' => array( $cat_id ),
		'post_type'     => 'post',
		'tags_input'    => array(
			'CL Commands', 'SBMJOB', 'WRKJOBSCDE', 'IBM i', 'AS400',
			'batch processing', 'job scheduling', 'job queue', 'RCVMSG',
		),
	);

	$post_id = wp_insert_post( $post_data, true );

	if ( is_wp_error( $post_id ) ) {
		return; // Silently bail — do not crash the activation
	}

	/* ------------------------------------------------------------------ *
	 * 6. SEO meta — Yoast fields (works for both Yoast SEO and SEOPress)
	 * ------------------------------------------------------------------ */
	update_post_meta( $post_id, '_yoast_wpseo_title',         $seo_title );
	update_post_meta( $post_id, '_yoast_wpseo_metadesc',      $seo_description );
	update_post_meta( $post_id, '_yoast_wpseo_focuskw',       $focus_keyword );
	update_post_meta( $post_id, '_yoast_wpseo_canonical',     '' );

	/* RankMath fields */
	update_post_meta( $post_id, 'rank_math_title',            $seo_title );
	update_post_meta( $post_id, 'rank_math_description',      $seo_description );
	update_post_meta( $post_id, 'rank_math_focus_keyword',    $focus_keyword );

	/* Generic / All in One SEO fallback */
	update_post_meta( $post_id, '_aioseop_title',             $seo_title );
	update_post_meta( $post_id, '_aioseop_description',       $seo_description );

	/* Open Graph */
	update_post_meta( $post_id, '_yoast_wpseo_opengraph-title',       $seo_title );
	update_post_meta( $post_id, '_yoast_wpseo_opengraph-description', $seo_description );
	update_post_meta( $post_id, '_yoast_wpseo_twitter-title',         $seo_title );
	update_post_meta( $post_id, '_yoast_wpseo_twitter-description',   $seo_description );
}
