<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.wagtechng.com
 * @since      1.0.0
 *
 * @package    Student_Submissions
 * @subpackage Student_Submissions/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Student_Submissions
 * @subpackage Student_Submissions/includes
 * @author     Profoundweb Developer <profoundweb57@gmail.com>
 */
class Student_Submissions_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {

		global $wpdb;
	
		// $table_name = $wpdb->prefix . 'student_submissions';

		// foreign key(student_id) references id($wpdb->prefix . 'users')

		$charset_collate = $wpdb->get_charset_collate();

		$student_submissions = $wpdb->prefix . 'student_submissions';

		$std_subm_sql = "CREATE TABLE IF NOT EXISTS $student_submissions(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),

			form_id int(11) DEFAULT 0 NOT NULL,
			entry_id int(11) DEFAULT 0 NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";


		$table_name_reflections_study_day = $wpdb->prefix . 'student_submissions_reflections_study_day';

		$sql2 = "CREATE TABLE IF NOT EXISTS $table_name_reflections_study_day(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),
			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,
				
			study_day varchar(255) DEFAULT '' NOT NULL,
			study_month varchar(255) DEFAULT '' NOT NULL,
			study_year varchar(255) DEFAULT '' NOT NULL,
			reflection_day varchar(255) DEFAULT '' NOT NULL,
			reflection_month varchar(255) DEFAULT '' NOT NULL,
			reflection_year varchar(255) DEFAULT '' NOT NULL,
			study_day_length varchar(255) DEFAULT '' NOT NULL,
			topics varchar(255) DEFAULT '' NOT NULL,
			relflection_on_learning1 varchar(255) DEFAULT '' NOT NULL,
			relflection_on_learning2 varchar(255) DEFAULT '' NOT NULL,
			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			std_professionalism_mgmt varchar(255) DEFAULT '' NOT NULL,
			std_mgt varchar(255) DEFAULT '' NOT NULL,
			std_leadership varchar(255) DEFAULT '' NOT NULL,
			clinical_catgs varchar(255) DEFAULT '' NOT NULL,
			mentor_comments varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

//--------------------------------------------------------------------------------------		

		$table_name_audit = $wpdb->prefix . 'student_submissions_audit';

		$sql1 = "CREATE TABLE IF NOT EXISTS $table_name_audit(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),

			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,
			upload_type varchar(255) DEFAULT '' NOT NULL,
			upload_file varchar(255) DEFAULT '' NOT NULL,
			upload_file_descr varchar(255) DEFAULT '' NOT NULL,
			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			std_professionalism_mgmt varchar(255) DEFAULT '' NOT NULL,
			std_mgt varchar(255) DEFAULT '' NOT NULL,
			std_leadership varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		$table_name_reflections_study_day = $wpdb->prefix . 'student_submissions_reflections_study_day';

		$sql2 = "CREATE TABLE IF NOT EXISTS $table_name_reflections_study_day(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),
			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,
				
			study_day varchar(255) DEFAULT '' NOT NULL,
			study_month varchar(255) DEFAULT '' NOT NULL,
			study_year varchar(255) DEFAULT '' NOT NULL,
			reflection_day varchar(255) DEFAULT '' NOT NULL,
			reflection_month varchar(255) DEFAULT '' NOT NULL,
			reflection_year varchar(255) DEFAULT '' NOT NULL,
			study_day_length varchar(255) DEFAULT '' NOT NULL,
			topics varchar(255) DEFAULT '' NOT NULL,
			relflection_on_learning1 varchar(255) DEFAULT '' NOT NULL,
			relflection_on_learning2 varchar(255) DEFAULT '' NOT NULL,
			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			std_professionalism_mgmt varchar(255) DEFAULT '' NOT NULL,
			std_mgt varchar(255) DEFAULT '' NOT NULL,
			std_leadership varchar(255) DEFAULT '' NOT NULL,
			clinical_catgs varchar(255) DEFAULT '' NOT NULL,
			mentor_comments varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		$table_name_pat_sat_qtn = $wpdb->prefix . 'student_submissions_pat_sat_qtn';

		$sql3 = "CREATE TABLE IF NOT EXISTS $table_name_pat_sat_qtn(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_name varchar(255) DEFAULT '' NOT NULL,

			student_id varchar(255),

			gdc_number varchar(255) DEFAULT '' NOT NULL,
			upload_file varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		$table_name_learn_dev_needs = $wpdb->prefix . 'student_submissions_learn_dev_needs';

		$sql4 = "CREATE TABLE IF NOT EXISTS $table_name_learn_dev_needs(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_name varchar(255) DEFAULT '' NOT NULL,

			student_id varchar(255),

			gdc_number varchar(255) DEFAULT '' NOT NULL,
			learning_dev_needs_name varchar(255) DEFAULT '' NOT NULL,
			pat_satisn_qtn varchar(255) DEFAULT '' NOT NULL,

			learning_dev_needs_day varchar(255) DEFAULT '' NOT NULL,
			learning_dev_needs_month varchar(255) DEFAULT '' NOT NULL,
			learning_dev_needs_year varchar(255) DEFAULT '' NOT NULL,

			learning_obj varchar(255) DEFAULT '' NOT NULL,
			learning_obj_addrssd varchar(255) DEFAULT '' NOT NULL,

			learning_obj_met_day varchar(255) DEFAULT '' NOT NULL,
			learning_obj_met_month varchar(255) DEFAULT '' NOT NULL,
			learning_obj_met_year varchar(255) DEFAULT '' NOT NULL,

			priority varchar(255) DEFAULT '' NOT NULL,

			achv_dev_learn_need varchar(255) DEFAULT '' NOT NULL,
			others_specify varchar(255) DEFAULT '' NOT NULL,
			reflection_dev_learn_need varchar(255) DEFAULT '' NOT NULL,

			achv_day varchar(255) DEFAULT '' NOT NULL,
			achv_month varchar(255) DEFAULT '' NOT NULL,
			achv_year varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		$table_name_ref_tutorials = $wpdb->prefix . 'student_submissions_ref_tutorials';

		$sql5 = "CREATE TABLE IF NOT EXISTS $table_name_ref_tutorials(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),

			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,

			tutorial_day varchar(255) DEFAULT '' NOT NULL,
			tutorial_month varchar(255) DEFAULT '' NOT NULL,
			tutorial_year varchar(255) DEFAULT '' NOT NULL,

			reflections_day varchar(255) DEFAULT '' NOT NULL,
			reflections_month varchar(255) DEFAULT '' NOT NULL,
			reflections_year varchar(255) DEFAULT '' NOT NULL,

			tutorial_title varchar(255) DEFAULT '' NOT NULL,
			tutorial_length varchar(255) DEFAULT '' NOT NULL,
			details varchar(255) DEFAULT '' NOT NULL,

			analysis_relection varchar(255) DEFAULT '' NOT NULL,

			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			std_professionalism_mgmt varchar(255) DEFAULT '' NOT NULL,

			std_mgt varchar(255) DEFAULT '' NOT NULL,
			std_leadership varchar(255) DEFAULT '' NOT NULL,
			clinical_catgs varchar(255) DEFAULT '' NOT NULL,
			mentor_comments varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		$table_name_case_based_discu = $wpdb->prefix . 'student_submissions_case_based_discu';

		$sql6 = "CREATE TABLE IF NOT EXISTS $table_name_case_based_discu(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),

			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,

			cbd_day varchar(255) DEFAULT '' NOT NULL,
			cbd_month varchar(255) DEFAULT '' NOT NULL,
			cbd_year varchar(255) DEFAULT '' NOT NULL,

			pat_recd_kepn varchar(255) DEFAULT '' NOT NULL,
			inv_ref varchar(255) DEFAULT '' NOT NULL,
			clin_diag varchar(255) DEFAULT '' NOT NULL,
			tretm_plan varchar(255) DEFAULT '' NOT NULL,
			follow_up_pat_mgt varchar(255) DEFAULT '' NOT NULL,

			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			std_professionalism_mgmt varchar(255) DEFAULT '' NOT NULL,

			overl_clin_judgmt varchar(255) DEFAULT '' NOT NULL,
			case_pres_skills varchar(255) DEFAULT '' NOT NULL,
			fds_insights varchar(255) DEFAULT '' NOT NULL,

			ar_good_perf varchar(255) DEFAULT '' NOT NULL,
			ar_dev_bef_compl_dft varchar(255) DEFAULT '' NOT NULL,
			min_spent_obs varchar(255) DEFAULT '' NOT NULL,
			min_spent_giv_feedbck varchar(255) DEFAULT '' NOT NULL,
			clin_competncs varchar(255) DEFAULT '' NOT NULL,
			qtn_asked varchar(255) DEFAULT '' NOT NULL,
			evaluator_notes varchar(255) DEFAULT '' NOT NULL,

			clinical_catgs varchar(255) DEFAULT '' NOT NULL,
			mentor_comments varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		
		$table_name_direc_observ_procd = $wpdb->prefix . 'student_submissions_direc_observ_procd';

		$sql7 = "CREATE TABLE IF NOT EXISTS $table_name_direc_observ_procd(
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

			student_id varchar(255),

			student_name varchar(255) DEFAULT '' NOT NULL,
			gdc_number varchar(255) DEFAULT '' NOT NULL,

			dops_day varchar(255) DEFAULT '' NOT NULL,
			dops_month varchar(255) DEFAULT '' NOT NULL,
			dops_year varchar(255) DEFAULT '' NOT NULL,

			case_descr varchar(255) DEFAULT '' NOT NULL,
			pat_exam varchar(255) DEFAULT '' NOT NULL,
			diag_clin_jud varchar(255) DEFAULT '' NOT NULL,
			tretm_plan varchar(255) DEFAULT '' NOT NULL,
			proced_knwge varchar(255) DEFAULT '' NOT NULL,
			communication varchar(255) DEFAULT '' NOT NULL,

			std_professionalism varchar(255) DEFAULT '' NOT NULL,
			fds_insights varchar(255) DEFAULT '' NOT NULL,

			ar_good_perf varchar(255) DEFAULT '' NOT NULL,
			ar_dev varchar(255) DEFAULT '' NOT NULL,
			min_spnt_observ varchar(255) DEFAULT '' NOT NULL,
			min_spnt_feedbck varchar(255) DEFAULT '' NOT NULL,

			clinical_catgs varchar(255) DEFAULT '' NOT NULL,
			mentor_comments varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";



		// $sql = "CREATE IF NOT EXISTS TABLE $table_name(
		// 	id mediumint(9) NOT NULL AUTO_INCREMENT,
		// 	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		// 	name tinytext NOT NULL,
		// 	text text NOT NULL,
		// 	url varchar(55) DEFAULT '' NOT NULL,
		// 	PRIMARY KEY  (id)
		// ) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		dbDelta( $sql1 ); dbDelta( $sql2 ); dbDelta( $sql3 ); dbDelta( $sql4 ); dbDelta( $sql5 ); dbDelta( $sql6 ); dbDelta( $sql7 ); dbDelta( $std_subm_sql );

	}

}