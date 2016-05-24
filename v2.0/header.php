<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>达客族关键词库</title>

	<!-- CSS List -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/library/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/library/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/plugins/BootstrapStarRating/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/plugins/BootstrapStarRating/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/plugins/BootstrapStarRating/css/star-rating.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/plugins/BootstrapStarRating/css/theme-krajee-fa.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/components/custom.css" />

	<!-- JS List -->
	<script src="<?php echo get_template_directory_uri(); ?>/components/library/jquery-2.2.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/components/js/StickyTableHeaders.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/components/plugins/BootstrapStarRating/js/star-rating.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/components/plugins/animatedScrollTo/js.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/components/js/functions.js"></script>
	<script>
		$(function() {
			// 固定头部导航
				// $("body").on("scroll", function() { // body 元素绑定 scroll 事件无效
				// $(window).on("scroll", function() { // 使用 window 可以绑定，滚动事件只触发一次。
				// 	alert($("thead").offset());
				// });
				$(window).trigger('resize.stickyTableHeaders');

			// 切换查询工具和查询时间
				// $("tbody").on('change', '.check_time', selectList()); // 回调函数 selectList() 不需要加 ()
				// $("tbody").on('change', '.check_time', 'selectList'); // 回调函数 selectList 不需要加 ''
				$("tbody").on('change', '.tool', selectList);
				$("tbody").on('change', '.check_time', selectList);

			// 回到底部
				$("table").on('click', '#btnScrollDown', function() {
					clientHeight = document.body.clientHeight;
					animatedScrollTo( document.body, clientHeight, 400 );
				});
			// 返回顶部
				$("table").on('click', '#btnScrollTop', function() {
					animatedScrollTo( document.body, 0, 400 );
				});
		});
	</script>
</head>
