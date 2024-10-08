<div style="width: 620px; padding: 10px">
	<h2><?php esc_html_e( 'Export Playlists', 'radio-station' ); ?></h2>
	<form action="" method="post" id="export_form" accept-charset="utf-8" style="position:relative">

		<?php wp_nonce_field( 'station_export_valid' ); ?>

		<input type="hidden" name="export_action" value="station_playlist_export"/>
		<table class="form-table">

			<tr valign="top">
				<?php // 2.5.6: replace integer casting with absint
				$smonth = isset( $_POST['station_export_start_month'] ) ? absint( $_POST['station_export_start_month'] ) : '';
				?>
				<th scope="row"><?php esc_html_e( 'Start Date', 'radio-station' ); ?></th>
				<td>
					<select name="station_export_start_month" id="station_export_start_month">
						<?php
						$selected = 'selected="selected"';
						for ( $i = 1; $i <= 12; $i++ ) {
							$month_num = $i;
							if ( $month_num < 10 ) {
								$month_num = '0' . $i;
							}
							$date_format = DateTime::createFromFormat( '!m', $i );
							$month_name = $date_format->format( 'M' );
							?>
							<option	value="<?php echo esc_attr( $month_num ); ?>" <?php selected( $i, $smonth ); ?>>
								<?php
								echo esc_html( $month_num );
								echo ' (';
								// TODO: translate month name ?
								echo esc_html( $month_name );
								echo ')';
								?>
							</option>
							<?php
						}
						?>
					</select>

					<?php // 2.5.6: replace integer casting with absint
					$sday = isset( $_POST['station_export_start_day'] ) ? absint( $_POST['station_export_start_day'] ) : ''; ?>
					<select name="station_export_start_day" id="station_export_start_day">
						<?php
						for ( $i = 1; $i <= 31; $i ++ ) {
							$day = $i;
							if ( $i < 10 ) {
								$day = '0' . $day;
							}
							if ( $sday === $day ) {
								$selected = ' selected="selected"';
							} else {
								$selected = '';
							}
							echo '<option value="' . esc_attr( $day ) . '"' . selected( $sday, $day, false ) . '>' . esc_html( $i ) . '</option>';
						}
						?>
					</select>

					<?php // 2.5.6: replace integer casting with absint
					$syear = isset( $_POST['station_export_start_year'] ) ? absint( $_POST['station_export_start_year'] ) : ''; ?>
					<select name="station_export_start_year" id="station_export_start_year">
						<?php
						$year = radio_station_get_time( 'Y' );
						for ( $i = $year - 5; $i <= ( $year + 5 ); $i++ ) {
							echo '<option value="' . esc_attr( $i ) . '"';
							// 2.5.6: output selected attribute directly
							if ( $i == $syear ) {
								echo ' selected="selected"';
							} elseif ( $i === $year && empty( $syear ) ) {
								echo ' selected="selected"';
							}
							echo '>' . esc_html( $i ) . '</option>';
						}
						?>
					</select>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'End Date', 'radio-station' ); ?></th>
				<td>
					<?php // 2.5.6: replace integer casting with absint
					$emonth = isset( $_POST['station_export_end_month'] ) ? absint( $_POST['station_export_end_month'] ) : ''; ?>
					<select name="station_export_end_month" id="station_export_end_month">
						<?php
						$selected = 'selected="selected"';
						for ( $i = 1; $i <= 12; $i ++ ) {
							$month_num = $i;
							if ( $month_num < 10 ) {
								$month_num = '0' . $i;
							}
							$date_format = DateTime::createFromFormat( '!m', $i );
							$month_name = $date_format->format( 'M' );
							?>
							<option	value="<?php echo esc_attr( $month_num ); ?>" <?php selected( $i, $emonth ); ?>>
								<?php
								echo esc_html( $month_num );
								echo ' (';
								// TODO: translate month name ?
								echo esc_html( $month_name );
								echo ')';
								?>
							</option>
							<?php
						}
						?>
					</select>

					<?php // 2.5.6: replace integer casting with absint
					$eday = isset( $_POST['station_export_end_day'] ) ? absint( $_POST['station_export_end_day'] ) : ''; ?>
					<select name="station_export_end_day" id="station_export_end_day">
						<?php
						for ( $i = 1; $i <= 31; $i++ ) {
							$day = $i;
							if ( $i < 10 ) {
								$day = '0' . $day;
							}
							echo '<option value="' . esc_attr( $day ) . '"' . selected( $eday, $day, false ) . '>' . esc_html( $i ) . '</option>';
						}
						?>
					</select>

					<?php // 2.5.6: replace integer casting with absint
					$eyear = isset( $_POST['station_export_end_year'] ) ? absint( $_POST['station_export_end_year'] ) : ''; ?>
					<select name="station_export_end_year" id="station_export_end_year">
						<?php
						$year = radio_station_get_time( 'Y' );
						for ( $i = $year - 5; $i <= ( $year + 5 ); $i++ ) {
							echo '<option value="' . esc_attr( $i ) . '"';
							// 2.5.6: output selected attribute directly
							if ( $i === $eyear ) {
								echo ' selected="selected"';
							} elseif ( $i === $year && empty( $eyear ) ) {
								echo ' selected="selected"';
							}
							echo '>' . esc_html( $i ) . '</option>';
						}
						?>
					</select>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">&nbsp;</th>
				<td>
					<input type="submit" name="Submit" class="button-primary" value="<?php esc_html_e( 'Export', 'radio-station' ); ?>"/>
				</td>
			</tr>
		</table>
	</form>
</div>
