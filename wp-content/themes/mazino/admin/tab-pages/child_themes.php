<?php
/**
 * Child themes template
 */
?>
<div id="child_themes" class="mazino-tab-pane panel-close">

	<?php
		$current_theme = wp_get_theme();
	?>
<div class="container-fluid">
		<div class="row">	

	<div class="mazino-pane-center">

		<h1><?php esc_html_e('Install & Use Quality Child Themes','mazino' ); ?></h1>

		<p><?php esc_html_e('Below you will find a selection of Quality child themes that will totally transform the look of your site.','mazino' ); ?></p>

	</div>

	<div class="col-md-4">
	<div class="mazino-tab-pane-half mazino-tab-pane-first-half">
		<!-- mazino Blue -->
		<div class="mazino-child-theme-container">
			<div class="mazino-child-theme-image-container">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/admin/img/quality-blue.png'; ?>" alt="<?php esc_html_e( 'Quality Blue Child Theme', 'mazino' ); ?>" />
				<div class="mazino-child-theme-description">
					<h2><?php esc_html_e( 'Quality Blue', 'mazino' ); ?></h2>
				</div>
			</div>
			<div class="mazino-child-theme-details">
				<?php if ( 'quality-blue' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name"><?php echo 'Quality Blue'; ?></span>
						<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=quality-blue' ), 'install-theme_quality-blue' ) ); ?>" class="button button-primary install right"><?php printf( __( 'Install %s now', 'mazino' ), '<span class="screen-reader-text">quality-blue</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="https://wp-themes.com/quality-blue"><?php esc_html_e( 'Live Preview','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Quality Blue - Current theme', 'mazino' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
	<div class="col-md-4">
	<div class="mazino-tab-pane-half mazino-tab-pane-first-half">
		<!-- Quality Green -->
		<div class="mazino-child-theme-container">
			<div class="mazino-child-theme-image-container">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/admin/img/quality-green.png'; ?>" alt="<?php esc_html_e( 'Quality Green Child Theme', 'mazino' ); ?>" />
				<div class="mazino-child-theme-description">
					<h2><?php esc_html_e('Quality Green', 'mazino' ); ?></h2>
				</div>
			</div>
			<div class="mazino-child-theme-details">
				<?php if ( 'quality-green' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name"><?php esc_html_e( 'Quality Green', 'mazino' ); ?></span>
						<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=quality-green' ), 'install-theme_quality-green' ) ); ?>" class="button button-primary install right"><?php printf( __( 'Install %s now', 'mazino' ), '<span class="screen-reader-text">quality green</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="https://wp-themes.com/quality-green"><?php esc_html_e( 'Live Preview','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Quality - Current theme', 'mazino' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
	
	<div class="col-md-4">	
	<div class="mazino-tab-pane-half mazino-tab-pane-first-half">	
		<!-- Zifer Child -->
		<div class="mazino-child-theme-container">
			<div class="mazino-child-theme-image-container">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/admin/img/quality-orange.png'; ?>" alt="<?php esc_html_e( 'Quality Orange Child Theme', 'mazino' ); ?>" />
				<div class="mazino-child-theme-description">
					<h2><?php esc_html_e( 'Quality Orange', 'mazino' ); ?></h2>
				</div>
			</div>
			<div class="mazino-child-theme-details">
				<?php if ( 'quality orange' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name"><?php esc_html_e( 'Quality Orange', 'mazino' ); ?></span>
						<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=quality-orange' ), 'install-theme_quality-orange' ) ); ?>" class="button button-primary install right"><?php printf( __( 'Install %s now', 'mazino' ), '<span class="screen-reader-text">Quality Orange</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="https://wp-themes.com/quality-orange"><?php esc_html_e( 'Live Preview','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Quality Orange - Current theme', 'mazino' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e( 'Customize','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
	 </div>
	 </div>
	 <div class="clearfix">
	<div class="col-md-4">	
	<div class="mazino-tab-pane-half mazino-tab-pane-first-half">	
		<!-- Zifer Child -->
		<div class="mazino-child-theme-container">
			<div class="mazino-child-theme-image-container">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/admin/img/heroic.png'; ?>" alt="<?php esc_html_e( 'Heroic Child Theme', 'mazino' ); ?>" />
				<div class="mazino-child-theme-description">
					<h2><?php esc_html_e( 'Heroic', 'mazino' ); ?></h2>
				</div>
			</div>
			<div class="mazino-child-theme-details">
				<?php if ( 'heroic' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name"><?php esc_html_e( 'Heroic', 'mazino' ); ?></span>
						<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=heroic' ), 'install-theme_heroic' ) ); ?>" class="button button-primary install right"><?php printf( __( 'Install %s now', 'mazino' ), '<span class="screen-reader-text">Heroic</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="https://wp-themes.com/heroic"><?php esc_html_e( 'Live Preview','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Heroic - Current theme', 'mazino' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e( 'Customize','mazino'); ?></a>
						<div class="mazino-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
	 </div>
	 </div>
	 
	</div>
</div>	
</div>

</div>