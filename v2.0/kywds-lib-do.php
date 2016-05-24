<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>达客族关键词管理系统</title>
</head>
<body>
	<?php

		// var_dump( $_POST ); exit;
		// var_dump( $_POST['kywds'] ); exit;
		// $kywds = explode( '\t', $_POST['kywds'] ); // 单引号里的转义字符无效
		$kywds = explode( "\n", trim( $_POST['kywds'] ) );

		$tool = $_POST['tool'];

		// 查询时间（按天记录）
		// 查询数据当天几乎没有变化
		$time = date( "Y-m-d", time() );

		switch ( $tool ) {
			case 'baidu':
				foreach ( $kywds as $kywd ) {
					$kywd = explode( "\t", trim( $kywd ) );
					$dkl_kywds = $kywd[0];
					$dkl_weight_set = '"百度":{"百度指数":"'.$kywd[1].'","相关结果":"'.$kywd[2].'"}';

					$data = array(
						'dkl_kywds' => $dkl_kywds,
						'dkl_tool' => 'baidu',
						'dkl_weight_set' => $dkl_weight_set,
						'dkl_time' => $time
					);
					$wpdb->insert( 'dz_kywds', $data );
				}
				break;
			case 'aizhan':
				foreach ( $kywds as $kywd ) {
					$kywd = explode( "\t", trim( $kywd ) );
					$dkl_kywds = $kywd[0];
					$dkl_weight_set = '{"搜索量":"'.$kywd[1].'","优化难度":"'.$kywd[2].'"}';

					$data = array(
						'dkl_kywds' => $dkl_kywds,
						'dkl_tool' => 'aizhan',
						'dkl_weight_set' => $dkl_weight_set,
						'dkl_time' => $time
					);
					$wpdb->insert( 'dz_kywds', $data );
				}
				break;
			case 'bdpro':
				foreach ( $kywds as $kywd ) {
					$kywd = explode( "\t", trim( $kywd ) );
					$dkl_kywds = $kywd[0];
					// $dkl_weight_set = '"百度推广客户端":{"展现理由":"'.$kywd[1].'","整体日均搜索量":"'.$kywd[2].'","移动日均搜索量":"'.$kywd[3].'","计算机日均搜索量":"'.$kywd[4].'","左侧（上方）准入价":"'.$kywd[5].'","竞争激烈程度":"'.$kywd[6].'"}';
					$dkl_weight_set = '{"展现理由":"'.$kywd[1].'","整体日均搜索量":"'.$kywd[2].'","移动日均搜索量":"'.$kywd[3].'","计算机日均搜索量":"'.$kywd[4].'","左侧（上方）准入价":"'.$kywd[5].'","竞争激烈程度":"'.$kywd[6].'"}';

					// INSERT INTO $wpdb->dz_kywds 正确执行，但没有效果。
					// INSERT INTO $wpdb->'dz_kywds' 报错
					// $wpdb->query() 是执行查询语句的方法，插入要用 $wpdb->insert() 方法
					// $wpdb->query( "INSERT INTO $wpdb->dz_kywds ( `dkl_kywds`, `dkl_tool`, `dkl_weight_set`, `dkl_time` ) VALUES ( '$dkl_kywds', 'bdpro', '$dkl_weight_set', '$time' )" );
					$data = array(
						'dkl_kywds' => $dkl_kywds,
						'dkl_tool' => 'bdpro',
						'dkl_weight_set' => $dkl_weight_set,
						'dkl_time' => $time
					);
					$wpdb->insert( 'dz_kywds', $data );
				}
				break;
		}

	?>
</body>
</html>