<tr>
	<?php $all_login_records_nonce = wp_create_nonce( 'wll_all_login_records_nonce' ); ?>
	<th><?php esc_html_e( 'Export All Login Records', 'when-last-login-export-user-records' ); ?></th>
	<td>
	
	<a href='<?php echo admin_url( 'admin.php?page=when-last-login-settings&tab=export-user-records' ) . '&export=login-records&type=csv&nonce=' . $all_login_records_nonce; ?>' target='_BLANK' class='button button-primary'><?php esc_html_e( 'Export to CSV', 'when-last-login-export-user-records' ); ?></a> 
	
	<a href='<?php echo admin_url( 'admin.php?page=when-last-login-settings&tab=export-user-records' ) . '&export=login-records&type=json&nonce=' . $all_login_records_nonce; ?>' target='_BLANK' class='button button-primary'><?php esc_html_e( 'Export to JSON', 'when-last-login-export-user-records' ); ?></a>
</td>
</tr>
<tr>
	<?php $all_user_records_nonce = wp_create_nonce( 'wll_all_user_records_nonce' ); ?>
	<th><?php esc_html_e( 'Export All User Records', 'when-last-login-export-user-records' ); ?></th>
	<td>
	<a href='<?php echo admin_url( 'admin.php?page=when-last-login-settings&tab=export-user-records' ) . '&export=user-records&type=csv&user_nonce=' . $all_user_records_nonce; ?>' target='_BLANK' class='button button-primary'><?php esc_html_e( 'Export to CSV', 'when-last-login-export-user-records' ); ?></a> 
	
	<a href='<?php echo admin_url( 'admin.php?page=when-last-login-settings&tab=export-user-records' ) . '&export=user-records&type=json&user_nonce=' . $all_user_records_nonce; ?>' target='_BLANK' class='button button-primary'><?php esc_html_e( 'Export to JSON', 'when-last-login-export-user-records' ); ?></a></td>
</tr>
