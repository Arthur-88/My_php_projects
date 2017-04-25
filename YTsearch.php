<?php
function search($apikey,$search,$maxResults)
{
	$search =  urlencode($search);
	$url = 'https://www.googleapis.com/youtube/v3/search?&part=snippet&q='.$search.'&type=video&order=date&maxResults='.$maxResults.'&key='.$apikey.'';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,				$url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,	TRUE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,	FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,	false);
//	curl_setopt($curl, CURLOPT_HEADER,			false);
//	curl_setopt($curl, CURLOPT_REFERER,			$url);
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}
$search = 'SNICKERS'; //  Поисковый запрос
$maxResults = 2; // Количество результатов
$apikey = 'AIzaSyCrX_jSWKcLPqkTIJ7FqNe_kEh4qt6AL10'; // Ваш ключ к api youtube v3
$JSONres = search($apikey,$search,$maxResults) ;
//print_r($res_json);
$res = json_decode($JSONres);
//print_r($res);
$videos = $res -> items;
//print_r($videos);

foreach($videos as $key => $value)
{
	$url = 'https://www.googleapis.com/youtube/v3/videos?id='.$value->id->videoId.'&key='.$apikey.
			'&fields=items(id,snippet(title,thumbnails,publishedAt),statistics(viewCount))&part=snippet,statistics';
	$statistics_json = youtube_statistics($value,$url,$apikey);
	$statistics = json_decode($statistics_json);
	$statistics_Key = $statistics -> items;
//	print_r($statistics_Key);
	$newKey=$key+1;
	echo '<p>'.$newKey.'<a href="https://www.youtube.com/embed/'.$value->id->videoId.'">'.$value->snippet->title.'<br><img src='.$value->snippet->thumbnails->default->url.' width='.$value->snippet->thumbnails->default->width.' 
	height='.$value->snippet->thumbnails->default->height.' alt='.$value->snippet->title.'></a></p><p>'.$value->snippet->publishedAt.'</p><p>Просмотров: '.$statistics_Key[0]->statistics->viewCount.'</p>';
}

function youtube_statistics($value,$url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,	FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,	false);
	curl_setopt($curl, CURLOPT_HEADER,			false);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION,	true);	//если выпадает ошибка на эту строку - попробуйте закомментировать её
	curl_setopt($curl, CURLOPT_URL,				$url);
	curl_setopt($curl, CURLOPT_REFERER,			$url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,	TRUE);
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}