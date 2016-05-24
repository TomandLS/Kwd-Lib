<body>
	<table>
		<caption title="达客族关键词库"><i class="icon-road"></i> DAC-ZOO Keyword Library</caption>
		<tbody>
			<tr id="table-notes">
				<td colspan="3">
					<i class="icon-tasks"></i> <b>查询工具</b>
					<select class="tool" name="tool">
						<option value="bdpro" sleected="selected">百度推广客户端</option>
						<option value ="aizhan">爱站</option>
						<option value ="baidu">百度</option>
					</select>
				</td>
				<td colspan="3">
					<i class="icon-time"></i> <b>查询日期</b>
					<select class="check_time" name="check_time">
						<?php

							$time_result = $wpdb->get_results( "SELECT DISTINCT `dkl_time` FROM `dz_kywds_weight` WHERE `dkl_tool` = 'bdpro' ORDER BY `dkl_time` DESC" );

							$tmp_time = array();
							foreach ( $time_result as $v ) {
								$time = date( 'Y-m-d', strtotime( $v->dkl_time ) );
								if ( !in_array( $time, $tmp_time ) ) {
									$tmp_time[] = $time;
									$selected = ( count( $tmp_time ) == 1 ) ? 'selected = "selected"' : '';
									echo "<option value =\"$time\"$selected>$time</option>";
								}
							}
						?>
					</select>
				</td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
