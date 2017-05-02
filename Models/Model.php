<?php

namespace Models;
use Helpers\JSON;

class Model
{
	protected $search;
	protected $maxResults;
	
	protected $VIDEOlist;
	
    public function getVIDEOlist($search,$maxResults)
    {
		$requestTYPE = 'search?';
		$searchPARAMS = [
			'part' => 'snippet',
			'q' => &$search,
			'order' => 'date',
			'type' => 'video',
			'maxResults' => &$maxResults,
		];

		$this -> VIDEOlist = self::YTrequest($searchPARAMS,$requestTYPE);

		if (!isset($this -> VIDEOlist))	return false;
		return $this -> VIDEOlist;
    }
	
	public function getVIDEOproperties($sort)
    {
		$requestTYPE = 'videos?';
		$VIDEOlistFormated = array();
		foreach($this -> VIDEOlist as $key => $value)
		{
			$videoParams = [
				'id' => $value->id->videoId,
				'part' => 'snippet,statistics,player',
				'fields' => 'items(id,snippet(title,thumbnails,publishedAt,channelTitle),statistics(viewCount,likeCount,commentCount),player/embedHtml)',
			];

			$VIDEOstatistics = self::YTrequest($videoParams,$requestTYPE);

			$VIDEOlistFormated[] = array
			(   'id'            =>  $VIDEOstatistics[0] -> id,
				'href'          =>  'https://www.youtube.com/embed/'.$VIDEOstatistics[0] -> id,
				'title'         =>  $VIDEOstatistics[0] -> snippet      -> title,
				'date'          =>  $VIDEOstatistics[0] -> snippet      -> publishedAt,
				'image'         =>  $VIDEOstatistics[0] -> snippet      -> thumbnails   -> high -> url,
				'width'         =>  $VIDEOstatistics[0] -> snippet      -> thumbnails   -> high -> width,
				'height'        =>  $VIDEOstatistics[0] -> snippet      -> thumbnails   -> high -> height,
				'viewCount'     =>  $VIDEOstatistics[0] -> statistics   -> viewCount,
				'likeCount'     =>  $VIDEOstatistics[0] -> statistics   -> likeCount,
				'commentCount'  =>  $VIDEOstatistics[0] -> statistics   -> commentCount,
				'VIDEOtag'      =>  $VIDEOstatistics[0] -> player       -> embedHtml,
				'author'		=>	$VIDEOstatistics[0] -> snippet      -> channelTitle,
			);
		}
	   
		$VIDEOlistSorted = self::sortVIDEO($VIDEOlistFormated,$sort);
		return $VIDEOlistSorted;
	}
	
	protected function YTrequest(array $PARAMS,$requestTYPE)
    {
		$url = 'https://www.googleapis.com/youtube/v3/';
		$PARAMS['key'] = 'AIzaSyCrX_jSWKcLPqkTIJ7FqNe_kEh4qt6AL10';
		$requestPARAMS = http_build_query($PARAMS);
		$HTTPrequest = $url.$requestTYPE.'&'.$requestPARAMS;
		
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $HTTPrequest);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,	FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,	FALSE);
        $result_JSON = curl_exec($curl);
        curl_close($curl);
		$result_ARRAY = JSON::fromJson($result_JSON);
		$result = $result_ARRAY -> items;
		return $result;
    }

	public static function sortVIDEO($VIDEOlistFormated, $sort)
	{
		for($i=0;$i+1<count($VIDEOlistFormated);)
			{
				if ($VIDEOlistFormated[$i][$sort] < $VIDEOlistFormated[$i+1][$sort])
				{
					$TEMPVIDEOlist = $VIDEOlistFormated[$i+1];
					$VIDEOlistFormated[$i+1] = $VIDEOlistFormated[$i];
					$VIDEOlistFormated[$i] = $TEMPVIDEOlist;
					$i = 0;
				}
				else $i++;
			}
			return $VIDEOlistFormated;
	}

}