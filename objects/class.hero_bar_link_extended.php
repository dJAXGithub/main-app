<?php
class hero_bar_link_extended extends hero_bar_link {
	public $title;
	
	public function GetCurrentHeroBarLinks($content_type) {
		$this->pog_query = "select h.hero_bar_linkid as hero_bar_linkid, h.contentid as contentid, h.menu as menu, h.position as position, c.title as title 
                            from hero_bar_link h 
                            inner join content_".$content_type." c on h.contentid = c.content_".$content_type."id and h.content_type = '".$content_type."'";
		$connection = Database::Connect();
		$cursor = Database::Reader($this->pog_query, $connection);
		$list = array();
		while ($row = Database::Read($cursor)) {
			$hero_bar_link = new hero_bar_link_extended();
			$hero_bar_link->hero_bar_linkId = $row['hero_bar_linkid'];
			$hero_bar_link->content_type = $content_type;
			$hero_bar_link->contentid = $this->Unescape($row['contentid']);
			$hero_bar_link->menu = $this->Unescape($row['menu']);
			$hero_bar_link->position = $this->Unescape($row['position']);
			$hero_bar_link->title = $this->Unescape($row['title']);
			$list[] = $hero_bar_link;
		}
		return $list;
	}
	
	public function GetHeroBarLargeImage($content_type, $position, $image_path, $links, $link_aux = null) {
        $menu = $content_type ? $content_type : "home";
        if(isset($link_aux)){
            if($link_aux->content_type!='youtube'){
                $link->content_type = $link_aux->content_type;
                $link->contentid = $link_aux->content_id;
            }else{
                $video_link = $link_aux->video_link;
                $video_link = str_replace('www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_link); 
            }
        }else{
            $link = finder::find_hero_bar_link($links, $menu, $position);
        }
		if(file_exists($image_path.$position.'_large.jpg')){
			$image_url = url_handler::GetAbsoluteUrl($image_path.$position.'_large.jpg');
            if($link_aux->content_type!='youtube'){
                $res =  ($link ? '<a href="'.url_handler::GetAbsoluteUrl("view.php?type=".$link->content_type."&id=".$link->contentid).'" class="nivo-custom-large-link">' : '')
						.'<img src="'.$image_url.'" alt="" class="nivo-custom-large" />' . ($link ? '</a>' : '');
            }else{
                $res =  '
                    <a href="javascript:openVideoModal(\''.$video_link.'\')" class="nivo-custom-large-link youtube-image">
                        <img src="'.$image_url.'" alt="" class="nivo-custom-large video-play-image" />
                    </a>';  
            }    
        }else{
			$res = '';	
		}
		return $res;
	}
}
?>

