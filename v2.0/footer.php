
</body>

	<!-- scrollProgress -->
	<!-- 下面的文件引入，不能放在头部，会产生下面的错误 -->
	<!-- Uncaught TypeError: Cannot read property 'appendChild' of null -->
	<script src="<?php echo get_template_directory_uri(); ?>/components/plugins/scrollProgress/js.js"></script>

	<script>
		// 底部进度条
		// Bug > 在 AJAX 重新获取数据后没有触发 onload 事件，所以没有执行

		// 虽然解决了网页较短无法触发进度条的问题
		// 但是又产生了进度条结束过早的问题
		// $("body").height($(window).height() + 0.5)

		// 改用 jQuery 实现，需要引入 jQuery 库
		/*
		$(window).on("load", function(){
			scrollProgress.set({
					color: '#F44336',
					height: '2px',
				});

			// window.onresize = scrollProgress.update;
			$(window).on("resize", function(){
				scrollProgress.update;
			});

			// window.onscroll = scrollProgress.trigger;
			$(window).on("scroll", function() {
				scrollProgress.trigger;
			});
		});
		*/

		// 原生 JS 实现
		/*
		window.onload = function() {
			alert($(window).height());
			alert($(document).height());
			scrollProgress.set({
				color: '#F44336',
				height: '2px',
			});

			// 在内部改 body 高度无效
			// alert($(window).height());
			// alert($("body").height());
			// $("body").height($(window).height() + 1000)
			// alert($("body").height());
			window.onresize = scrollProgress.update;
			window.onscroll = scrollProgress.trigger;
		};
		*/

		// 为 window 对象绑定 scroll 事件
		// 使进度条在 AJAX 传输数据以后还能被触发
		$(window).on("scroll", function() {
			// 判断是否出现垂直滚动条
			// if ( $(document).height() > $(window).height() ) {
			// }

			// alert($(document).height());
			// alert($(window).height());

			scrollProgress.set({
				color: '#F44336',
				height: '2px',
			});

			window.onresize = scrollProgress.update;
			window.onscroll = scrollProgress.trigger;

		});
	</script>

</html>