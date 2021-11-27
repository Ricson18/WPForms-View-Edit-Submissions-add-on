<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.wagtechng.com
 * @since      1.0.0
 *
 * @package    Student_Submissions
 * @subpackage Student_Submissions/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Student_Submissions
 * @subpackage Student_Submissions/includes
 * @author     Profoundweb Developer <profoundweb57@gmail.com>
 */
class Student_Submissions_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;

		$table_name_audit = $wpdb->prefix . 'student_submissions_audit';

		$sql1 = "DROP TABLE IF EXISTS $table_name_audit";

		$table_name_reflections_study_day = $wpdb->prefix . 'student_submissions_reflections_study_day';

		$sql2 = "DROP TABLE IF EXISTS $table_name_reflections_study_day";

		$table_name_pat_sat_qtn = $wpdb->prefix . 'student_submissions_pat_sat_qtn';

		$sql3 = "DROP TABLE IF EXISTS $table_name_pat_sat_qtn";

		$table_name_learn_dev_needs = $wpdb->prefix . 'student_submissions_learn_dev_needs';

		$sql4 = "DROP TABLE IF EXISTS $table_name_learn_dev_needs";
		
		$table_name_ref_tutorials = $wpdb->prefix . 'student_submissions_ref_tutorials';

		$sql5 = "DROP TABLE IF EXISTS $table_name_ref_tutorials";
		
		$table_name_case_based_discu = $wpdb->prefix . 'student_submissions_case_based_discu';

		$sql6 = "DROP TABLE IF EXISTS $table_name_case_based_discu";

		$table_name_direc_observ_procd = $wpdb->prefix . 'student_submissions_direc_observ_procd';

		$sql7 = "DROP TABLE IF EXISTS $table_name_direc_observ_procd";

		$student_submissions = $wpdb->prefix . 'student_submissions';

		$std_subm_sql = "DROP TABLE IF EXISTS $student_submissions";
		
		$wpdb->query( $sql1 ); $wpdb->query( $sql2 ); $wpdb->query( $sql3 ); $wpdb->query( $sql4 ); $wpdb->query( $sql5 ); $wpdb->query( $sql6 ); $wpdb->query( $sql7 ); 
		$wpdb->query( $std_subm_sql );
	}

}
