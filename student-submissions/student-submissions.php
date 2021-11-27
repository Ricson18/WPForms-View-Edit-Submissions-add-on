<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.wagtechng.com
 * @since             1.0.0
 * @package           Student_Submissions
 *
 * @wordpress-plugin
 * Plugin Name:       Student Submissions
 * Plugin URI:        https://wagtechng.com
 * Description:       This plugin will enable students view/edit their submissions.
 * Version:           1.0.0
 * Author:            Profoundweb Developer
 * Author URI:        https://www.wagtechng.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       student-submissions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STUDENT_SUBMISSIONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-student-submissions-activator.php
 */
function activate_student_submissions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-submissions-activator.php';
	Student_Submissions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-student-submissions-deactivator.php
 */
function deactivate_student_submissions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-submissions-deactivator.php';
	Student_Submissions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_student_submissions' );
register_deactivation_hook( __FILE__, 'deactivate_student_submissions' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
function enqueue_styles() {
	wp_enqueue_style( 'custom-css', plugin_dir_url( __FILE__ ) . 'css/student-submissions-admin.css', array(), 1, 'all' );

	wp_enqueue_style( 'custom-css1', 'https://use.fontawesome.com/releases/v5.11.2/css/all.css',array(),1,'all');
    wp_enqueue_style( 'custom-css2', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',array(),1,'all');
    wp_enqueue_style( 'custom-css3', plugin_dir_url( __FILE__ ) . 'mdbootstrap/css/bootstrap.min.css',array(),1,'all');
    wp_enqueue_style( 'custom-css4', plugin_dir_url( __FILE__ ) . 'mdbootstrap/css/mdb.min.css',array(),1,'all');
    wp_enqueue_style( 'custom-css5', plugin_dir_url( __FILE__ ) . 'mdbootstrap/css/style.css',array(),1,'all');
	wp_enqueue_style( 'custom-css5', plugin_dir_url( __FILE__ ) . 'extras/style.css',array(),1,'all');
}
function enqueue_scripts() {
	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'extras/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), 1, false );
	// wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'js/student-submissions-admin.js', array( 'jquery' ), 1, false );
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

require plugin_dir_path( __FILE__ ) . 'includes/class-student-submissions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_student_submissions() {

	$plugin = new Student_Submissions();
	$plugin->run();

}
run_student_submissions();



/**
 * Action that fires during form entry processing after initial field validation.
 *
 * @link   https://wpforms.com/developers/wpforms_process/
 *
 * @param  array  $fields    Sanitized entry field. values/properties.
 * @param  array  $entry     Original $_POST global.
 * @param  array  $form_data Form data and settings.
 *
 */
function wpf_dev_process( $fields, $entry, $form_data ) {
      
	global $wpdb;
	// Optional, you can limit to specific forms. Below, we restrict output to
    // form #5.
    
     
	if ( absint( $form_data['id'] ) === 304 ) {
		//Audit
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];
		$upload_type=$fields[2]['value'];
		$upload_file=$fields[3]['value'];
		// $upload_file_descr=$fields[4]['value'];
		// $std_professionalism=$fields[5]['value'];
		// $std_professionalism_mgmt=$fields[6]['value'];
		// $std_mgt=$fields[7]['value'];
		// $std_leadership=$fields[8]['value'];
		
		//INSERT VALUES INTO DATABASE TABLE	
		$table_name_audit = $wpdb->prefix . 'student_submissions_audit';
		
		$wpdb->insert( 
			$table_name_audit, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'upload_type' => $upload_type,
				'upload_file' => $upload_file,
				'upload_file_descr' => "upload_file_descr",
				'std_professionalism' => "std_professionalism",
				'std_professionalism_mgmt' => "std_professionalism_mgmt",
				'std_mgt' => "std_mgt",
				'std_leadership' => "std_leadership",
			) 
		);

		
    }
	else if ( absint( $form_data['id'] ) === 368 ) {
		//REFLECTION ON STUDY DAYS
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];

		$study_day=$fields[4]['value'];
		$study_month=$fields[5]['value'];
		$study_year=$fields[6]['value'];

		$reflection_day=$fields[4]['value'];
		$reflection_month=$fields[5]['value'];
		$reflection_year=$fields[6]['value'];

		$study_day_length=$fields[6]['value'];
		$topics=$fields[6]['value'];

		$relflection_on_learning1=$fields[6]['value'];
		$relflection_on_learning2=$fields[6]['value'];

		$std_professionalism=$fields[2]['value'];
		$std_professionalism_mgmt=$fields[3]['value'];


		$std_mgt=$fields[7]['value'];
		$std_leadership=$fields[8]['value'];

		$clinical_catgs=$fields[9]['value'];
		$mentor_comments=$fields[10]['value'];

		//INSERT VALUES INTO DATABASE TABLE
		$table_name_reflections_study_day = $wpdb->prefix . 'student_submissions_reflections_study_day';
		
		$wpdb->insert( 
			$table_name_reflections_study_day, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,

				'study_day' => $study_day,
				'study_month' => $study_month,
				'study_year' => $study_year,
				'reflection_day' => $reflection_day,
				'reflection_month' => $reflection_month,
				'reflection_year' => $reflection_year,
				'study_day_length' => $study_day_length,
				'topics' => $topics,
				'relflection_on_learning1' => $relflection_on_learning1,
				'relflection_on_learning2' => $relflection_on_learning2,
				'std_professionalism' => $std_professionalism,
				'std_professionalism_mgmt' => $std_professionalism_mgmt,
				'std_mgt' => $std_mgt,
				'std_leadership' => $std_leadership,
				'clinical_catgs' => $clinical_catgs,
				'mentor_comments' => $mentor_comments,
			) 
		);
    }
	else if ( absint( $form_data['id'] ) === 468 ) {
		//Patient Satisfaction Questionaire
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];
		$upload_file=$fields[2]['value'];
		
		//INSERT VALUES INTO DATABASE TABLE
		$table_name_pat_sat_qtn = $wpdb->prefix . 'student_submissions_pat_sat_qtn';
		
		$wpdb->insert( 
			$table_name_pat_sat_qtn, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'upload_file' => $upload_file,
			) 
		);
    }
	else if ( absint( $form_data['id'] ) === 374 ) {
		//Learning and Development Needs
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];
		$learning_dev_needs_name=$fields[2]['value'];
		$pat_satisn_qtn=$fields[3]['value'];

		$learning_dev_needs_day=$fields[4]['value'];
		$learning_dev_needs_month=$fields[5]['value'];
		$learning_dev_needs_year=$fields[6]['value'];

		$learning_obj=$fields[7]['value'];
		$learning_obj_addrssd=$fields[8]['value'];

		$learning_obj_met_day=$fields[9]['value'];
		$learning_obj_met_month=$fields[10]['value'];
		$learning_obj_met_year=$fields[11]['value'];

		
		$priority=$fields[12]['value'];

		$achv_dev_learn_need=$fields[13]['value'];
		$others_specify=$fields[14]['value'];
		$reflection_dev_learn_need=$fields[15]['value'];

		$achv_day=$fields[16]['value'];
		$achv_month=$fields[17]['value'];
		$achv_year=$fields[18]['value'];

		//INSERT VALUES INTO DATABASE TABLE
		$table_name_learn_dev_needs = $wpdb->prefix . 'student_submissions_learn_dev_needs';
		
		$wpdb->insert( 
			$table_name_learn_dev_needs, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'learning_dev_needs_name' => $learning_dev_needs_name,
				'pat_satisn_qtn' => $pat_satisn_qtn,
				'learning_dev_needs_day' => $learning_dev_needs_day,
				'learning_dev_needs_month' => $learning_dev_needs_month,
				'learning_dev_needs_year' => $learning_dev_needs_year,
				'learning_obj' => $learning_obj,
				'learning_obj_addrssd' => $learning_obj_addrssd,
				'learning_obj_met_day' => $learning_obj_met_day,
				'learning_obj_met_month' => $learning_obj_met_month,
				'learning_obj_met_year' => $learning_obj_met_year,
				'priority' => $priority,
				'achv_dev_learn_need' => $achv_dev_learn_need,
				'others_specify' => $others_specify,
				'reflection_dev_learn_need' => $reflection_dev_learn_need,
				'achv_day' => $achv_day,
				'achv_month' => $achv_month,
				'achv_year' => $achv_year,
			) 
		);
    }
	else if ( absint( $form_data['id'] ) === 455 ) {
		//Reflections on Tutorials
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];

		$tutorial_day=$fields[2]['value'];
		$tutorial_month=$fields[3]['value'];
		$tutorial_year=$fields[4]['value'];

		$reflections_day=$fields[5]['value'];
		$reflections_month=$fields[6]['value'];
		$reflections_year=$fields[7]['value'];

		$tutorial_title=$fields[8]['value'];
		$tutorial_length=$fields[9]['value'];
		$details=$fields[10]['value'];

		$analysis_relection=$fields[11]['value'];
		
		$std_professionalism=$fields[12]['value'];
		$std_professionalism_mgmt=$fields[13]['value'];

		$std_mgt=$fields[14]['value'];
		$std_leadership=$fields[15]['value'];
		$clinical_catgs=$fields[16]['value'];
		$mentor_comments=$fields[17]['value'];
		

		//INSERT VALUES INTO DATABASE TABLE
		$table_name_ref_tutorials = $wpdb->prefix . 'student_submissions_ref_tutorials';
		
		$wpdb->insert( 
			$table_name_ref_tutorials, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'tutorial_day' => $tutorial_day,
				'tutorial_month' => $tutorial_month,
				'tutorial_year' => $tutorial_year,
				'reflections_day' => $reflections_day,
				'reflections_month' => $reflections_month,
				'reflections_year' => $reflections_year,
				'tutorial_title' => $tutorial_title,
				'tutorial_length' => $tutorial_length,
				'details' => $details,
				'analysis_relection' => $analysis_relection,
				'std_professionalism' => $std_professionalism,
				'std_professionalism_mgmt' => $std_professionalism_mgmt,
				'std_mgt' => $std_mgt,
				'std_leadership' => $std_leadership,
				'clinical_catgs' => $clinical_catgs,
				'mentor_comments' => $mentor_comments,
			) 
		);

		
    }
	else if ( absint( $form_data['id'] ) === 499 ) {
		//Case-based Discussions
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];

		$cbd_day=$fields[2]['value'];
		$cbd_month=$fields[3]['value'];
		$cbd_year=$fields[4]['value'];

		$pat_recd_kepn=$fields[5]['value'];
		$inv_ref=$fields[6]['value'];
		$clin_diag=$fields[7]['value'];
		$tretm_plan=$fields[8]['value'];
		$follow_up_pat_mgt=$fields[9]['value'];
		
		$std_professionalism=$fields[10]['value'];
		$std_professionalism_mgmt=$fields[11]['value'];
		
		$overl_clin_judgmt=$fields[12]['value'];
		$case_pres_skills=$fields[13]['value'];
		$fds_insights=$fields[14]['value'];

		$ar_good_perf=$fields[15]['value'];
		$ar_dev_bef_compl_dft=$fields[16]['value'];
		$min_spent_obs=$fields[17]['value'];
		$min_spent_giv_feedbck=$fields[18]['value'];
		$clin_competncs=$fields[19]['value'];
		$qtn_asked=$fields[20]['value'];
		$evaluator_notes=$fields[21]['value'];
		
		$clinical_catgs=$fields[22]['value'];
		$mentor_comments=$fields[23]['value'];

		//INSERT VALUES INTO DATABASE TABLE
		$table_name_case_based_discu = $wpdb->prefix . 'student_submissions_case_based_discu';
		
		$wpdb->insert( 
			$table_name_case_based_discu, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'cbd_day' => $cbd_day,
				'cbd_month' => $cbd_month,
				'cbd_year' => $cbd_year,
				'pat_recd_kepn' => $pat_recd_kepn,
				'inv_ref' => $inv_ref,
				'clin_diag' => $clin_diag,
				'tretm_plan' => $tretm_plan,
				'follow_up_pat_mgt' => $follow_up_pat_mgt,
				'std_professionalism' => $std_professionalism,
				'std_professionalism_mgmt' => $std_professionalism_mgmt,
				'overl_clin_judgmt' => $overl_clin_judgmt,
				'case_pres_skills' => $case_pres_skills,
				'fds_insights' => $fds_insights,
				'ar_good_perf' => $ar_good_perf,
				'ar_dev_bef_compl_dft' => $ar_dev_bef_compl_dft,
				'min_spent_obs' => $min_spent_obs,
				'min_spent_giv_feedbck' => $min_spent_giv_feedbck,
				'clin_competncs' => $clin_competncs,
				'qtn_asked' => $qtn_asked,
				'evaluator_notes' => $evaluator_notes,
				'clinical_catgs' => $clinical_catgs,
				'mentor_comments' => $mentor_comments,
			) 
		);

		
    }
	else if ( absint( $form_data['id'] ) === 501 ) {
		//Direct Observation of Procedural Skills (DOPS)
		$student_name=$fields[0]['value'];
		$gdc_number=$fields[1]['value'];

		$dops_day=$fields[2]['value'];
		$dops_month=$fields[3]['value'];
		$dops_year=$fields[4]['value'];

		$case_descr=$fields[5]['value'];
		$pat_exam=$fields[6]['value'];
		$diag_clin_jud=$fields[7]['value'];
		$tretm_plan=$fields[8]['value'];
		$proced_knwge=$fields[9]['value'];
		$communication=$fields[10]['value'];
		
		$std_professionalism=$fields[11]['value'];
		$fds_insights=$fields[12]['value'];
		
		$ar_good_perf=$fields[13]['value'];
		$ar_dev=$fields[14]['value'];
		$min_spnt_observ=$fields[15]['value'];
		$min_spnt_feedbck=$fields[16]['value'];
		
		$clinical_catgs=$fields[17]['value'];
		$mentor_comments=$fields[18]['value'];
		
		//INSERT VALUES INTO DATABASE TABLE
		$table_name_direc_observ_procd = $wpdb->prefix . 'student_submissions_direc_observ_procd';
		
		$wpdb->insert( 
			$table_name_direc_observ_procd, 
			array( 
				'student_id' => get_current_user_id(),
				'student_name' => $student_name,
				'gdc_number' => $gdc_number,
				'dops_day' => $dops_day,
				'dops_month' => $dops_month,
				'dops_year' => $dops_year,
				'case_descr' => $case_descr,
				'pat_exam' => $pat_exam,
				'diag_clin_jud' => $diag_clin_jud,
				'tretm_plan' => $tretm_plan,
				'proced_knwge' => $proced_knwge,
				'communication' => $communication,
				'std_professionalism' => $std_professionalism,
				'fds_insights' => $fds_insights,
				'ar_good_perf' => $ar_good_perf,
				'ar_dev' => $ar_dev,
				'min_spnt_observ' => $min_spnt_observ,
				'min_spnt_feedbck' => $min_spnt_feedbck,
				'clinical_catgs' => $clinical_catgs,
				'mentor_comments' => $mentor_comments,
			) 
		);
    }
    else return $fields;
}

// add_action( 'wpforms_process', 'wpf_dev_process', 10, 3 );


/**
 * This will fire at the very end of a (successful) form entry.
 *
 * @link  https://wpforms.com/developers/wpforms_process_complete/
 *
 * @param array  $fields    Sanitized entry field values/properties.
 * @param array  $entry     Original $_POST global.
 * @param array  $form_data Form data and settings.
 * @param int    $entry_id  Entry ID. Will return 0 if entry storage is disabled or using WPForms Lite.
 */
 
function wpf_dev_process_complete( $fields, $entry, $form_data, $entry_id ) {
	global $wpdb;
    // Optional, you can limit to specific forms. Below, we restrict output to
    // form #5.
    //if ( absint( $form_data['id'] ) === 362 ) {
     if (absint( $form_data['id'] ) === 574) $entry_id = $fields[18]['value'];
		
		// Get the full entry object
		$entry = wpforms()->entry->get( $entry_id );
	
		// Fields are in JSON, so we decode to an array
		$entry_fields = json_decode( $entry->fields, true );

		//INSERT VALUES INTO DATABASE TABLE	
		$student_submissions = $wpdb->prefix . 'student_submissions';
		
		$wpdb->insert( 
			$student_submissions, 
			array( 
				'student_id' => get_current_user_id(),
				'form_id' => $form_data['id'],
				'entry_id'	=> $entry_id,
			) 
		);

		switch ($form_data['id']) {
			case 570:
				$entry_index=18;
				break;
			case 571:
				$entry_index=48;
				break;
			case 572:
				$entry_index=39;
				break;
			case 574:
				$entry_index=18;
				break;
			case 577:
				$entry_index=23;
				break;
			case 578:
				$entry_index=15;
				break;
			case 579:
				$entry_index=22;
				break;
		}

		$entry_id = $fields[$entry_index]['value'];
		
		$entry2 = wpforms()->entry->get( $entry_id );
		
		$entry_fields2 = json_decode( $entry2->fields, true );
		
		if (absint( $form_data['id'] ) === 574) {
			$entry_id = $fields[18]['value'];
			$entry2 = wpforms()->entry->get( $entry_id );
			$entry_fields2 = json_decode( $entry2->fields, true );

			$entry_fields2[16]['value'] = $fields[16]['value'];
			$entry_fields2[17]['value'] = $fields[17]['value'];
			$entry_fields2[4]['value']  = $fields[4]['value'];
		}else{
			foreach($entry_fields2 as $index=>&$field_id3){
				if($index===$entry_index)continue;
				$entry_fields2[$index]['value'] = $fields[$index]['value'];
			}

		}
		
		// Convert back to json
		$entry_fields2 = json_encode( $entry_fields2 );
	
		// Save changes
		wpforms()->entry->update( $entry_id, array( 'fields' => $entry_fields2 ), '', '', array( 'cap' => false ) );
//    }
    
}
add_action( 'wpforms_process_complete', 'wpf_dev_process_complete', 10, 4 );



/**
 * Custom shortcode to display WPForms form entries in table view.
 *
 * Basic usage: [wpforms_entries_table id="FORMID"].
 * 
 * Possible shortcode attributes:
 * id (required)  Form ID of which to show entries.
 * user           User ID, or "current" to default to current logged in user.
 * fields         Comma separated list of form field IDs.
 * number         Number of entries to show, defaults to 30.
 * 
 * @link https://wpforms.com/developers/how-to-display-form-entries/
 *
 * Realtime counts could be delayed due to any caching setup on the site
 *
 * @param array $atts Shortcode attributes.
 * 
 * @return string
 */
 
function view_student_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
		$link=''; $link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );

								switch ($entry_field['id']) {
									case 16:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 17:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 5:
										$link.="file-descr=".$entry_field['value'].'&';
										# code...
										break;
								}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-audits/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
					</a></span>
					
				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_student_table', 'view_student_table' );





//-----------------------------------------



/**
 * Custom shortcode to display WPForms form entries in table view.
 *
 * Basic usage: [wpforms_entries_table id="FORMID"].
 * 
 * Possible shortcode attributes:
 * id (required)  Form ID of which to show entries.
 * user           User ID, or "current" to default to current logged in user.
 * fields         Comma separated list of form field IDs.
 * number         Number of entries to show, defaults to 30.
 * 
 * @link https://wpforms.com/developers/how-to-display-form-entries/
 *
 * Realtime counts could be delayed due to any caching setup on the site
 *
 * @param array $atts Shortcode attributes.
 * 
 * @return string
 */
 
function view_reflections_study_days_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
		$link=''; $link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );



								switch ($entry_field['id']) {
									case 20:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 21:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 5:
										$link.="study-day-length=".$entry_field['value'].'&';
										# code...
										break;
									case 9:
										$link.="topics=".$entry_field['value'].'&';
										# code...
										break;
									case 3:
										$link.="study-length=".$entry_field['value'].'&';
										# code...
										break;
									case 10:
										$link.="refl-learn=".$entry_field['value'].'&';
										# code...
										break;
									case 11:
										$link.="refl-learn2=".$entry_field['value'].'&';
										# code...
										break;
									case 80:
										$link.="men-comm=".$entry_field['value'].'&';
										# code...
										break;
								}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-reflections-on-study-days/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
					</a></span>
					
				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_reflections_study_days_table', 'view_reflections_study_days_table' );



function view_learn_dev_needs_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
			$link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );

								switch ($entry_field['id']) {
									case 13:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 14:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 1:
										$link.="learn-dev-needs=".$entry_field['value'].'&';
										# code...
										break;
									case 4:
										$link.="learn_obj=".$entry_field['value'].'&';
										# code...
										break;
									case 5:
										$link.="learn-obj-addr=".$entry_field['value'].'&';
										# code...
										break;
									case 10:
										$link.="other-specify=".$entry_field['value'].'&';
										# code...
										break;
									case 11:
										$link.="refl-meeting=".$entry_field['value'].'&';
										# code...
										break;
								}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-learning-and-development-needs/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
						</a></span>

				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_learn_dev_needs_table', 'view_learn_dev_needs_table' );




function view_pat_satisf_qtn_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th style="text-align:center">';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
			$link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {

                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {

								if(substr($entry_field['value'],count($entry_field['value'])-5,-1) =='.jp'){
									echo "<img src='".$entry_field['value']."' width='50' height='50'>";
								}else 
									echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );

								switch ($entry_field['id']) {
									case 16: $link.="full-name=".$entry_field['value'].'&'; break;
									case 17: $link.="gdc-number=".$entry_field['value'].'&'; break;
								}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove">
						<a href="/edit-patient-satisfaction-questionnaire/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
							Edit
						</a></span>
				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_pat_satisf_qtn_table', 'view_pat_satisf_qtn_table' );


//-----------------------------------------



/**
 * Custom shortcode to display WPForms form entries in table view.
 *
 * Basic usage: [wpforms_entries_table id="FORMID"].
 * 
 * Possible shortcode attributes:
 * id (required)  Form ID of which to show entries.
 * user           User ID, or "current" to default to current logged in user.
 * fields         Comma separated list of form field IDs.
 * number         Number of entries to show, defaults to 30.
 * 
 * @link https://wpforms.com/developers/how-to-display-form-entries/
 *
 * Realtime counts could be delayed due to any caching setup on the site
 *
 * @param array $atts Shortcode attributes.
 * 
 * @return string
 */
 
function view_ref_on_tutorials_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
		$link=''; $link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );



								switch ($entry_field['id']) {
									case 20:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 21:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 3:
										$link.="tut-title=".$entry_field['value'].'&';
										# code...
										break;
									case 22:
										$link.="tut-length=".$entry_field['value'].'&';
										# code...
										break;
									case 9:
										$link.="details=".$entry_field['value'].'&';
										# code...
										break;
									case 10:
										$link.="analysis_refl=".$entry_field['value'].'&';
										# code...
										break;
									case 19:
										$link.="men-comm=".$entry_field['value'].'&';
										# code...
										break;
											}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-reflections-on-tutorials/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
						</a></span>
						
				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_ref_on_tutorials_table', 'view_ref_on_tutorials_table' );




function view_case_based_discu_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
		$link=''; $link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );



								switch ($entry_field['id']) {
									case 20:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 21:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 3:
										$link.="ar-perf=".$entry_field['value'].'&';
										# code...
										break;
									case 22:
										$link.="ar-dev-dft=".$entry_field['value'].'&';
										# code...
										break;
									case 23:
										$link.="min-observ=".$entry_field['value'].'&';
										# code...
										break;
									case 24:
										$link.="min-giv-feedbck=".$entry_field['value'].'&';
										# code...
										break;
									case 25:
										$link.="qtns-asked=".$entry_field['value'].'&';
										# code...
										break;
									case 26:
										$link.="ev-notes=".$entry_field['value'].'&';
										# code...
										break;
									case 19:
										$link.="men-notes=".$entry_field['value'].'&';
										# code...
										break;
											}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-case-based-discussions/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
						</a></span>
				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_case_based_discu_table', 'view_case_based_discu_table' );




function view_dops_table( $atts ) {
 
    // Pull ID shortcode attributes.
    $atts = shortcode_atts(
        [
            'id'     => '',
            'user'   => '',
            'fields' => '',
            'number' => '',
                        'type' => 'all' // all, unread, read, or starred.
        ],
        $atts
    );
 
    // Check for an ID attribute (required) and that WPForms is in fact
    // installed and activated.
    if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
        return;
    }
 
    // Get the form, from the ID provided in the shortcode.
    $form = wpforms()->form->get( absint( $atts['id'] ) );
 
    // If the form doesn't exists, abort.
    if ( empty( $form ) ) {
        return;
    }
 
    // Pull and format the form data out of the form object.
    $form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';
 
    // Check to see if we are showing all allowed fields, or only specific ones.
    $form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];
 
    // Setup the form fields.
    if ( empty( $form_field_ids ) ) {
        $form_fields = $form_data['fields'];
    } else {
        $form_fields = [];
        foreach ( $form_field_ids as $field_id ) {
            if ( isset( $form_data['fields'][ $field_id ] ) ) {
                $form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
            }
        }
    }
 
    if ( empty( $form_fields ) ) {
        return;
    }
 
    // Here we define what the types of form fields we do NOT want to include,
    // instead they should be ignored entirely.
    $form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );
 
    // Loop through all form fields and remove any field types not allowed.
    foreach ( $form_fields as $field_id => $form_field ) {
        if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
            unset( $form_fields[ $field_id ] );
        }
    }
 
    $entries_args = [
        'form_id' => absint( $atts['id'] ),
    ];
 
    // Narrow entries by user if user_id shortcode attribute was used.
    if ( ! empty( $atts['user'] ) ) {
        if ( $atts['user'] === 'current' && is_user_logged_in() ) {
            $entries_args['user_id'] = get_current_user_id();
        } else {
            $entries_args['user_id'] = absint( $atts['user'] );
        }
    }
 
    // Number of entries to show. If empty, defaults to 30.
    if ( ! empty( $atts['number'] ) ) {
        $entries_args['number'] = absint( $atts['number'] );
    }
 
// Filter the type of entries all, unread, read, or starred
    if ( $atts['type'] === 'unread' ) {
        $entries_args['viewed'] = '0';
    } elseif( $atts['type'] === 'read' ) {
        $entries_args['viewed'] = '1';
    } elseif ( $atts['type'] === 'starred' ) {
        $entries_args['starred'] = '1';
    }
 
    // Get all entries for the form, according to arguments defined.
    // There are many options available to query entries. To see more, check out
    // the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
    $entries = wpforms()->entry->get_entries( $entries_args );
 
    if ( empty( $entries ) ) {
        return '<p>No entries found.</p>';
    }
 
    ob_start();
?> 

	<div class="card">
	<h3 class="card-header text-center font-weight-bold text-uppercase py-4">
	  Table View
	</h3>
	<div class="card-body">
	  <div id="table" class="table">
		<span class="table-add float-right mb-3 mr-2"
		  ><a href="#!" class="text-success"
			><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
		></span>
		<table class="table table-bordered table-responsive-md table-striped text-center">
		  <thead><tr>

		<?php
    	// echo '<table class="wpforms-frontend-entries">';
        // echo '<thead><tr>';
 
            // Loop through the form data so we can output form field names in
            // the table header.
            foreach ( $form_fields as $form_field ) {
 
                // Output the form field name/label.
                echo '<th>';
                    echo esc_html( sanitize_text_field( $form_field['label'] ) );
                echo '</th>';
            } ?>
 
        </tr></thead>
 
        <tbody>
 
		<?php
			$link='?';
            // Now, loop through all the form entries.
            foreach ( $entries as $entry ) {
 
                echo '<tr>';
 
                // Entry field values are in JSON, so we need to decode.
                $entry_fields = json_decode( $entry->fields, true );
 
                foreach ( $form_fields as $form_field ) {
 
                    echo '<td>';
 
                        foreach ( $entry_fields as $entry_field ) {
                            if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
                                echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );

								switch ($entry_field['id']) {
									case 20:
										$link.="full-name=".$entry_field['value'].'&';
										# code...
										break;
									case 21:
										$link.="gdc-number=".$entry_field['value'].'&';
										# code...
										break;
									case 39:
										$link.="descr-case=".$entry_field['value'].'&';
										# code...
										break;
									case 22:
										$link.="areas-perf=".$entry_field['value'].'&';
										# code...
										break;
									case 47:
										$link.="ar-dev=".$entry_field['value'].'&';
										# code...
										break;
									case 23:
										$link.="min-observ=".$entry_field['value'].'&';
										# code...
										break;
									case 24:
										$link.="min-giv-feedbck=".$entry_field['value'].'&';
										# code...
										break;
											}

                                break;
                            }
                        }
 
                    echo '</td>';
                }
				?>

				<td>
					<span class="table-remove"
						><a href="/edit-dops/<?php echo $link."entry_id=".$entry->entry_id; ?>" type="button" class="btn btn-primary btn-rounded btn-sm my-0">
						Edit
						</a></span>

				</td><?php $link="";
                echo '</tr>';
            }
 ?>
        </tbody>
 
 <?php
    echo '</table>';
 
    $output = ob_get_clean();
 
    return $output;
}
add_shortcode( 'view_dops_table', 'view_dops_table' );


//---------------------------------------------


function view_submissions_list( $atts = array() ) {

	?><div class="container">
	<div class="row">
	<div class="col-sm-4">
		<!-- Category -->
		<div class="single category">
			<h3 class="side-title">Category</h3>
			<ul class="list-unstyled">
				<li><a href="https://dentalgpfp.com/view-audit-submissions/" title="">Audits </a></li>
				<li><a href="https://dentalgpfp.com/view-reflections-on-study-days/" title="">Reflections on Study Days </a></li>
				<li><a href="https://dentalgpfp.com/view-patient-satisfaction-questionnaire/" title="">Patient Satisfaction Questionnaire </a></li>
				<li><a href="https://dentalgpfp.com/view-learning-and-development-needs/" title="">Learning & Development Needs </a></li>
				<li><a href="https://dentalgpfp.com/view-reflections-on-tutorials/" title="">Reflections on Tutorials </a></li>
				<li><a href="https://dentalgpfp.com/view-case-based-discussions/" title="">Case-based Discussions </a></li>
				<li><a href="https://dentalgpfp.com/view-dops/" title="">DOPS </a></li>
			</ul>
	   </div>
	</div> 
	</div>
	</div><?php
}

add_shortcode('view_submissions_list', 'view_submissions_list');





/**
 * Custom shortcode to display WPForms form entries in table view.
 *
 * Basic usage: [wpforms_entries_table id="FORMID"].
 * 
 * Possible shortcode attributes:
 * id (required)  Form ID of which to show entries.
 * user           User ID, or "current" to default to current logged in user.
 * fields         Comma separated list of form field IDs.
 * number         Number of entries to show, defaults to 30.
 * 
 * @link https://wpforms.com/developers/how-to-display-form-entries/
 *
 * Realtime counts could be delayed due to any caching setup on the site
 *
 * @param array $atts Shortcode attributes.
 * 
 * @return string
 */
 
function wpf_entries_table( $atts ) {

// Pull ID shortcode attributes.
$atts = shortcode_atts(
	[
		'id'     => '',
		'user'   => '',
		'fields' => '',
		'number' => '',
					'type' => 'all' // all, unread, read, or starred.
	],
	$atts
);

// Check for an ID attribute (required) and that WPForms is in fact
// installed and activated.
if ( empty( $atts['id'] ) || ! function_exists( 'wpforms' ) ) {
	return;
}

// Get the form, from the ID provided in the shortcode.
$form = wpforms()->form->get( absint( $atts['id'] ) );

// If the form doesn't exists, abort.
if ( empty( $form ) ) {
	return;
}

// Pull and format the form data out of the form object.
$form_data = ! empty( $form->post_content ) ? wpforms_decode( $form->post_content ) : '';

// Check to see if we are showing all allowed fields, or only specific ones.
$form_field_ids = isset( $atts['fields'] ) && $atts['fields'] !== '' ? explode( ',', str_replace( ' ', '', $atts['fields'] ) ) : [];

// Setup the form fields.
if ( empty( $form_field_ids ) ) {
	$form_fields = $form_data['fields'];
} else {
	$form_fields = [];
	foreach ( $form_field_ids as $field_id ) {
		if ( isset( $form_data['fields'][ $field_id ] ) ) {
			$form_fields[ $field_id ] = $form_data['fields'][ $field_id ];
		}
	}
}

if ( empty( $form_fields ) ) {
	return;
}

// Here we define what the types of form fields we do NOT want to include,
// instead they should be ignored entirely.
$form_fields_disallow = apply_filters( 'wpforms_frontend_entries_table_disallow', [ 'divider', 'html', 'pagebreak', 'captcha' ] );

// Loop through all form fields and remove any field types not allowed.
foreach ( $form_fields as $field_id => $form_field ) {
	if ( in_array( $form_field['type'], $form_fields_disallow, true ) ) {
		unset( $form_fields[ $field_id ] );
	}
}

$entries_args = [
	'form_id' => absint( $atts['id'] ),
];

// Narrow entries by user if user_id shortcode attribute was used.
if ( ! empty( $atts['user'] ) ) {
	if ( $atts['user'] === 'current' && is_user_logged_in() ) {
		$entries_args['user_id'] = get_current_user_id();
	} else {
		$entries_args['user_id'] = absint( $atts['user'] );
	}
}

// Number of entries to show. If empty, defaults to 30.
if ( ! empty( $atts['number'] ) ) {
	$entries_args['number'] = absint( $atts['number'] );
}

// Filter the type of entries all, unread, read, or starred
if ( $atts['type'] === 'unread' ) {
	$entries_args['viewed'] = '0';
} elseif( $atts['type'] === 'read' ) {
	$entries_args['viewed'] = '1';
} elseif ( $atts['type'] === 'starred' ) {
	$entries_args['starred'] = '1';
}

// Get all entries for the form, according to arguments defined.
// There are many options available to query entries. To see more, check out
// the get_entries() function inside class-entry.php (https://a.cl.ly/bLuGnkGx).
$entries = wpforms()->entry->get_entries( $entries_args );

if ( empty( $entries ) ) {
	return '<p>No entries found.</p>';
}

ob_start();

echo '<table class="wpforms-frontend-entries">';

	echo '<thead><tr>';

		// Loop through the form data so we can output form field names in
		// the table header.
		foreach ( $form_fields as $form_field ) {

			// Output the form field name/label.
			echo '<th>';
				echo esc_html( sanitize_text_field( $form_field['label'] ) );
			echo '</th>';
		}

	echo '</tr></thead>';

	echo '<tbody>';

		// Now, loop through all the form entries.
		foreach ( $entries as $entry ) {

			echo '<tr>';

			// Entry field values are in JSON, so we need to decode.
			$entry_fields = json_decode( $entry->fields, true );

			foreach ( $form_fields as $form_field ) {

				echo '<td>';

					foreach ( $entry_fields as $entry_field ) {
						if ( absint( $entry_field['id'] ) === absint( $form_field['id'] ) ) {
							echo apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $entry_field['value'] ), $entry_field, $form_data, 'entry-frontend-table' );
							break;
						}
					}

				echo '</td>';
			}

			echo '</tr>';
		}

	echo '</tbody>';

echo '</table>';

$output = ob_get_clean();

return $output;
}
add_shortcode( 'wpforms_entries_table', 'wpf_entries_table' );