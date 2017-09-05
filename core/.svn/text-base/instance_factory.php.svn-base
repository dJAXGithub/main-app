<?php
class instance_factory {
	public static function GetContentInstance($content_type) {
		// TODO: add missing content types
		$instance = null;
		switch ($content_type) {
			case CONTENTTYPE_FILM:
				$instance = new content_film_extended();
				break;
			case CONTENTTYPE_MUSIC:
				$instance = new content_music_extended();
				break;
			case CONTENTTYPE_COMIC:
				$instance = new content_comic_extended();
				break;
			case CONTENTTYPE_BOOK:
				$instance = new content_book_extended();
				break;
			case CONTENTTYPE_GAME:
				$instance = new content_game_extended();
				break;
			case CONTENTTYPE_SHOW:
				$instance = new content_show_extended();
				break;
			case CONTENTTYPE_TRACK:
				$instance = new content_music_track_extended();
				break;
			case CONTENTTYPE_SHOW_TRACK:
				$instance = new content_show_track_extended();
				break;
		}
		return $instance;
	}
	
	public static function GetCategoryInstance($content_type) {
		// TODO: add missing content types
		$instance = null;
		switch ($content_type) {
			case CONTENTTYPE_FILM:
				$instance = new film_category_extended();
				break;
			case CONTENTTYPE_MUSIC:
				$instance = new music_category_extended();
				break;
			case CONTENTTYPE_COMIC:
				$instance = new comic_category_extended();
				break;
			case CONTENTTYPE_BOOK:
				$instance = new book_category_extended();
				break;
			case CONTENTTYPE_GAME:
				$instance = new game_category_extended();
				break;
			case CONTENTTYPE_SHOW:
				$instance = new show_category_extended();
				break;
		}
		return $instance;
	}
}
?>