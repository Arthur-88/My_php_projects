<?php

namespace Controllers;

use Models\Model;
use Views\Output;
use Helpers\JSON;

class YouTubeController
{
	public function searchVIDEO($sort = null)
    {
		$error = ['errorMessage' => 'Введите слово для поиска'];
        if (empty($_POST['search'])) 
			return JSON::toJson($error);
		
		$search = $_POST['search'];
		$maxResults = $_POST['maxResults'];
		if($maxResults > 20) 
			$maxResults = 20;
		
		if(!$sort)
			$VIDEO = (new Model) -> getVIDEOlist($search,$maxResults);
		else
		{
			$VIDEOS = new Model;
			$VIDEOlist = $VIDEOS -> getVIDEOlist($search,$maxResults);
			$VIDEO = $VIDEOS -> getVIDEOproperties($sort);	
		}
		if(!$VIDEO)
			return 'Результаты поиска отсутствуют';
		
		$output = (new Output()) -> returnVIDEOlist($VIDEO);	//кодирует список ВИДЕО в HTML
		$data = compact("search","maxResults","output");
		return \View::render($data);
	}
}