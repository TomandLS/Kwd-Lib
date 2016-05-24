$(function() {

	$(".kywd").mouseenter(function(){

		// 关键词
		var word = $(this).find(".word").text();
		alert(word);
		// 星级
		var rate = $(this).prev();
		// 定义关联数组无效
		// var captions = {
		// 	'2.5' : '9', 'a', 'b', 'c'
		// };

		var captions = new Array();
		// captions['0.5'] = '未定'; // 赋值有效
		captions['0'] = '不做';
		captions['0.5'] = '未定';
		captions['1'] = '选择';
		captions['1.5'] = '等待评级';
		captions['2'] = '普通';
		captions['2.5'] = '权重较高';
		captions['3'] = '关注';
		captions['3.5'] = '近期关注';
		captions['4'] = '重点';
		captions['4.5'] = '近期重点';
		captions['5'] = '主推';

		// console.log(captions);
		// console.log(rate.attr("id")); // 获取元素的 id 值
		// console.log(rate.text()); // 获取元素的文本值

		// Bug > 鼠标滑过追加：每次滑过都追加。可以通过移出时删除来处理
		// reBug > 但是悬停的时候，在有效范围内移动会一直自动执行 mouseover 事件触发的函数。改用 mouseenter 也会出现这种情况，只是次数触发的少了一些。
		// deBug > 通过函数判断 .kywd 内是否包含 input 标签，如果不包含才追加。
		// reBug > 也可能与点评插件本身重复执行有关
		// if ($(".kywd input").length === 0) { // 不应该判断 input，应该判断点评图标加载后的最外层标签 div.rating-container
		// if ($(".kywd div.rating-container").length === 0) { // 其他 .kywd 标签页收到影响
		// 只针对当前悬停的标签起作用
		if ($(this).find("div.rating-container").length === 0) {
			$(this).append('<input type="text" class="kv-fa rating-loading" value="2" data-size="xs" title="" />');

			// BootstrapStarRating Start
			$('.kv-fa').rating({
				theme: 'krajee-fa',
				filledStar: '<i class="fa fa-star"></i>',
				emptyStar: '<i class="fa fa-star-o"></i>'
			});

			// $('.rating, .kv-fa').on( 'change', function(){
			$('.kv-fa').on( 'change', function(){
				// alert("评级：" + $(this).val());
				// console.log('Rating selected: ' + $(this).val());
				var rating = $(this).val();
				// alert(rating); // 清空/不选时值为 0

				// 通过 AJAX 与数据库交互，将评分写入数据库
				objson = $.ajax({
					type: 'POST',
					data: {
						// 'rating' = rating // 不是用 = 而是用 : 指定值
						// 'rating' : rating
						word : word,
						rating : rating
					},
					// url: "<?php echo get_template_directory_uri(); ?>/components/kywds-lib-db.php",
					url: "http://localhost/wordpress/kywds-lib/kywds-lib-db",
					dataType: 'json',
					success: function(data2) {
						console.log(data2.rating);
						// console.log($("this").val()); // this 是系统保留字不能加引号
						// console.log($(this));
						// rate.text(captions[data2.rating]);
						rate.html('<span>' + captions[data2.rating] + '</span>');
						rate.attr('data-rate-value', data2.rating);
						rate.children('span').addClass('star' + data2.rating.replace('.', ''));
					}
				});

				// console.log(objson);
				// console.log(objson.status);

			});

			// BootstrapStarRating End

			var width = $(this).children("a").width() + 15;
			$("div.rating-container").css("left", width);

			// alert($(this).height()); // 无效
			// var height = $(this).height();
			// $("div.rating-container").css("height", height);
		}
	});

	// deBug > 改成鼠标移除时删除
	$(".kywd").mouseleave(function() {
		$(".kywd div.rating-container").remove();
	});

});