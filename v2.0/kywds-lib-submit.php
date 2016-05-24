<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>关键词提交</title>
</head>
<body>
	<form action="kywds-lib-do" method="post">
		<h4>关键词</h4>
		<textarea name="kywds" id="kywds" cols="30" rows="10">
		</textarea>
		<h4>工具</h4>
		<input type="radio" id="tool1" name="tool" value="baidu" />
		<label for="tool1">百度</label>
		<input type="radio" id="tools2" name="tool" value="aizhan" />
		<label for="tool2">爱站</label>
		<input type="radio" id="tools3" name="tool" value="bdpro" />
		<label for="tool3">百度推广客户端</label>
		<div><input type="submit" value="提交" /></div>
	</form>
</body>
</html>