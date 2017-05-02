<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Поиск видео по запросу</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<form method="post">
        <input type="text" value="lifehack" name="search">
	    <input type="submit" name="submit" value="Отправить" formaction="YT/VIDEOlist">
<!--		<input type="submit" name="sort" value="Сортировать по просмотрам" formaction="/YT/VIDEOlist/sort">
-->     <p>Сколько результатов поиска вывести?
			<input type="text" value="2" name="maxResults">
		</p>
	</form>
</body>
</html>