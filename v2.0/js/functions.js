// 通过下拉菜单筛选内容

	function selectList() {
		var tool = $(".tool").val();
		var check_time = $(".check_time").val();
		console.log(tool, check_time);

		$.ajax({
			type: 'POST',
			data: {
				tool : tool,
				check_time : check_time
			},
			// 使用绝对路径
			url: "http://localhost/wordpress/kywds-lib/kywds-lib-db",
			dataType: 'json',
			beforeSend: function() {
				$("table").before('<div id="loading"><img src="http://localhost/wordpress/wp-content/themes/dac-zoo/components/img/loading.gif" /></div>');
			},
			success: function(data2) {
				if ( $("thead").length === 0 ) {
					$("caption").after(data2.thead);
				}

				// $("#table-notes").nextAll().remove(); // 直接移除容易残留空白
				// 重新拼接 tbody 部分
				var table_notes = $("#table-notes");
				// 先清空，然后填充
				$("tbody").empty();
				var script_js = data2.script_js;
				var trs = data2.tr;

				// $("tbody").append(table-notes).append(trs); // 错误写法
				$("tbody").append(table_notes);
				$("tbody").append(trs);
			},
			complete: function() {
				$("#loading").remove();
				// alert($("thead").offset()); // 在此之前，thead 标签已经生成，所以获取成功。
				// $("table").stickyTableHeaders();
				// $('table').stickyTableHeaders({cacheHeaderHeight: true});
			}
		});
	}











