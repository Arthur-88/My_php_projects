<?php

namespace Views;

class Output
{
	function returnVIDEOlist(array $VIDEOlist)
	{
		$VIDEOlist_html = null;
		$i=1;
		foreach($VIDEOlist as $value)
		{	
			$VIDEOlist_html.=
				'<li>
					<input type="radio" id="nl-radio-'.$i.'" name="nl-radio" class="nl-radio" />
					<label class="nl-label" for="nl-radio-'.$i.'">'.$i.'. '.$value -> snippet -> title.' <sup>'.$value -> snippet -> publishedAt.'</sup></label>
					<div class="nl-content">
						<center><iframe 
							width="'.$value-> snippet -> thumbnails -> high -> width .'" 
							height="'.$value-> snippet -> thumbnails -> high -> height.'" 
							src="http://www.youtube.com/embed/'.$value -> id -> videoId.'" 
							frameborder="0" 
							allowfullscreen>
						</iframe></center>
					</div>
				</li>';
			$i++;
		}
        return $VIDEOlist_html;
	}
	/*
	function returnVIDEOlistSORTED(array $VIDEOlist)
	{
		$VIDEOlist_html = null;
		$i=1;
		foreach($VIDEOlist as $value)
		{	
			$VIDEOlist_html.=
				'<li>
					<input type="radio" id="nl-radio-'.$i.'" name="nl-radio" class="nl-radio" />
					<label class="nl-label" for="nl-radio-'.$i.'">'.$i.'. '.$value["title"].' <sup>'.$value["date"].'</sup></label>
					<div class="nl-content">
						<center><iframe 
							width="'.$value["width"].'" 
							height="'.$value["height"].'" 
							src="'.$value["VIDEOtag"].'" 
							frameborder="0" 
							allowfullscreen>
						</iframe>
						<P>Автор '.$value["author"].'
						<br>Просмотров '.$value["viewCount"].'
						<br>Лайков '.$value["likeCount"].'
						</p>
					</center>
					</div>
				</li>';
			$i++;
		}
		return $VIDEOlist_html;
	}
	 */
}