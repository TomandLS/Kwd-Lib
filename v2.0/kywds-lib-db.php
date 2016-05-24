<?php

// var_dump( count( $_POST ) ); exit;
// var_dump( isset( $_POST['rating'] ) );
// empty(0); // 为 true
// var_dump( empty( $_POST['rating'] ) ); exit;

if ( isset( $_POST['rating'] ) ) {

	$kywd['rating'] = $_POST['rating'];
	$kywd['word'] = $_POST['word'];

	$rating = $kywd['rating'];
	$word = $kywd['word'];

	// echo "hello";
	// var_dump( $wpdb ); exit;

	// $wpdb->query( "UPDATE $wpdb->dz_kywds SET `dkl_rate` = $kywd['rating'] WHERE `dkl_kywds` = $kywd['word']" );
	// 测试数据，更新成功。
	// $wpdb->query( "UPDATE `dz_kywds` SET `dkl_rate` = 3 WHERE `dkl_kywds` = '怎么自制阳台种菜花盆'" );
	// $wpdb->query( "UPDATE `dz_kywds` SET `dkl_rate` = 2.5 WHERE `dkl_kywds` = '怎么自制阳台种菜花盆'" );

	$num = $wpdb->get_results( "SELECT COUNT(*) as num FROM `dz_kywds` WHERE `dkl_kywds` = '$word'" );
	// var_dump( $num ); exit;
	// var_dump( $num[0]->num ); exit;

	if ( $num[0]->num == 0 ) {
		// echo "插入" . $word;
		$time = date( "Y-m-d H:i:s", time() );
		// $wpdb->query( "INSERT INTO `dz_kywds` ( `dkl_kywds`, `dkl_rate`, `dkl_add_time` ) VALUES ( '$word', $rating, $time )" ); // 插入无效
		$wpdb->query( "INSERT INTO `dz_kywds` ( `dkl_kywds`, `dkl_rate`, `dkl_add_time` ) VALUES ( '$word', '$rating', '$time' )" ); // 插入成功，字符类型和时间类型的值都需要加引号
	}

	if ( $num[0]->num == 1 ) {
		// echo "更新";
		$time = date( "Y-m-d H:i:s", time() );
		$wpdb->query( "UPDATE `dz_kywds` SET `dkl_rate` = '$rating', `dkl_update_time` = '$time' WHERE `dkl_kywds` = '$word'" );
	}

	// var_dump( json_encode( $kywd ) );
	// return json_encode( $kywd ); // 不是 return 是 echo
	echo json_encode( $kywd );

}

if ( isset( $_POST['tool'] ) ) {

	// 获取首页地址
		$home_url = get_option( 'home' );

	// 获取关键词对应评级
		$captions = array();
		$captions['0'] = '不做';
		$captions['0.5'] = '未定';
		$captions['1'] = '选择';
		$captions['1.5'] = '等待评级';
		$captions['2'] = '普通';
		$captions['2.5'] = '权重较高';
		$captions['3'] = '关注';
		$captions['3.5'] = '近期关注';
		$captions['4'] = '重点';
		$captions['4.5'] = '近期重点';
		$captions['5'] = '主推';

		$kywds = $wpdb->get_results( "SELECT * FROM `dz_kywds` ORDER BY `dkl_kywds`" );

		foreach ( $kywds as $v ) {
			// echo $v->'dkl_rate'; // 报错
			// echo $v->dkl_rate; exit; // 正常输出
			// $kywds_rate["$v->dkl_kywds"] = $v->dkl_rate; // 正常输出
			$kywds_rate[$v->dkl_kywds] = $v->dkl_rate;
		}
		// var_dump( $kywds_rate ); exit;

	// 数据表头部
		$str_thead = "
			<thead>
				<tr>
					<th>序号</th>
					<th>评级</th>
					<th>关键词</th>
					<th>展现理由</th>
					<th>整体日均搜索量</th>
					<th>移动日均搜索量</th>
					<th>计算机日均搜索量</th>
					<th>左侧（上方）准入价</th>
					<th>竞争激烈程度</th>
				</tr>
				<tr id=\"btnScrollTo\">
					<td id=\"menu\">
						<a href=\"$home_url\" target=\"_blank\"><i class=\"icon-home\"></i> 达客族</a>
					</td>
					<td colspan=\"9\">
						<span id=\"btnScrollTop\" class=\"icon-chevron-up\"></span>
						<span id=\"btnScrollDown\" class=\"icon-chevron-down\"></span>
					</td>
				</tr>
			</thead>
		";

	// 数据主体行
		// 获取查询的工具和时间
		$tool = $_POST['tool'];
		$check_time = $_POST['check_time'];

		// $tool 需要加单引号，否则查询不到值，但浏览器调试的时候并不报错
		$items = $wpdb->get_results( "SELECT * FROM `dz_kywds_weight` WHERE `dkl_tool` = '$tool' and `dkl_time` LIKE '$check_time%' ORDER BY `dkl_kywds`" );
		// var_dump( $items );

		$i = 1;

		foreach ( $items as $item ) {
			$rate = $kywds_rate[$item->dkl_kywds];
			$rate2 = str_replace( '.', '', $rate );
			$dkl_weight_set = json_decode( $item->dkl_weight_set, true );

			$str_tr .= "
				<tr>
					<td class=\"num\">$i</td>
					<td class=\"rate\" data-rate-value=\"$rate\">
						<span class=\"star$rate2\">$captions[$rate]</span>
					</td>
					<td class=\"kywd\">
						<a href=\"https://www.baidu.com/s?wd=$item->dkl_kywds\" target=\"_blank\">
							<span class=\"word\">$item->dkl_kywds</span>
						</a>
					</td>
					<td>$dkl_weight_set[1]</td>
					<td>$dkl_weight_set[2]</td>
					<td>$dkl_weight_set[3]</td>
					<td>$dkl_weight_set[4]</td>
					<td>$dkl_weight_set[5]</td>
					<td>$dkl_weight_set[6]</td>
				</tr>
			";

			$i++;
		}

	// JS 部分
		$script_js = '<script src="' . get_template_directory_uri() . '/components/ajax-after.js"></script>';

	$str['thead'] = $str_thead;
	$str['tr'] = $str_tr;
	$str['script_js'] = $script_js;

	echo json_encode( $str );

}

?>