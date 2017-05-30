<?php
/**
 * Plugin Name: When Last Login - Export User Records
 * Description: Exports all login records into a CSV file
 * Plugin URI: https://yoohooplugins.com
 * Author: YooHoo Plugins
 * Author URI: https://yoohooplugins.com
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: when-last-login-export-user-records
 */

class WhenLastLoginExportUserRecords{

	public function __construct(){

		add_filter( 'wll_settings_page_tabs', array( $this, 'wll_eur_settings_tab' ) );
        add_filter( 'wll_settings_page_content', array( $this, 'wll_eur_settings_content' ) );
        add_action( 'init', array( $this, 'wll_eur_export_records' ) );
	}

	public function wll_eur_settings_tab( $array ){

        $array['export-user-records'] = array(
            'title' => __('Export User Records', 'when-last-login-export-user-records'),
            'icon' => ''
        );

        return $array;

    }

    public function wll_eur_settings_content( $content ){

        $content['export-user-records'] = plugin_dir_path( __FILE__ ).'/when-last-login-export-user-records-settings.php';

        return $content;

    }

    public function wll_eur_export_records(){

    	if( isset( $_GET['tab'] ) && $_GET['tab'] == 'export-user-records' ){

    		if( isset( $_GET['export'] ) ){

    			$args = array(
		    		'posts_per_page' => -1,
		    		'post_type' => 'wll_records'
				);

		    	$the_query = new WP_Query( $args );

		    	$export_array = array();

		    	$export_array[] = array( 'title', 'author', 'date', 'ip_address' );

				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
						
						$the_query->the_post();

						$ip_address = get_post_meta( get_the_ID(), 'wll_user_ip_address', true );

						if( $ip_address == '' ){
							$ip_address = __('No IP Address Recorded', 'when-last-login-export-user-records');
						}

						$export_array[] = array(
							'title' => get_the_title(),
							'author' => get_the_author(),
							'date' => get_the_date(),
							'ip_address' => $ip_address
						);
						

					}

					wp_reset_postdata();

				}

    			if( $_GET['export'] == 'csv' ){

    				$fileName = time().'-when-last-login-export-user-records.csv';

			        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			        header('Content-Description: File Transfer');
			        header("Content-type: text/csv");
			        header("Content-Disposition: attachment; filename=".$fileName);
			        header("Expires: 0");
			        header("Pragma: public");
			        $fh = @fopen( 'php://output', 'w' );

		            foreach( $export_array as $record ){
		            	fputcsv($fh, $record, ",", '"');
		            }

			        fclose($fh);

			        exit();

    			} else if( $_GET['export'] == 'json' ){

    				$fileName = time().'-when-last-login-export-user-records.json';

			        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			        header('Content-Description: File Transfer');
			        header("Content-type: text/json");
			        header("Content-Disposition: attachment; filename=".$fileName);
			        header("Expires: 0");
			        header("Pragma: public");
			        $fh = @fopen( 'php://output', 'w' );
		            
	            	fputs( $fh, json_encode( $export_array ) );

			        fclose($fh);

			        exit();

    			}

    		}

    	}

    	

    }

}

new WhenLastLoginExportUserRecords();