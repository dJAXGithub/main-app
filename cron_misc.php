<?php


			set_time_limit(0);
			include('includes/pack_includes.php');

			
			//----------------------------CALCULATED VALUES PERSIST-------------------------------------------
			// View counts
			$content_log_helper = new content_log_helper();
			
			//Film case
			$film = New Content_film;
			$content_film_list = $film->GetList(array(array('active', '=', 1)));
			foreach($content_film_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_FILM, $i->content_filmId);
				$i->Save();
			}
			
			//Music case
			$music = New Content_music;
			$content_music_list = $music->GetList(array(array('active', '=', 1)));
			foreach($content_music_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_MUSIC, $i->content_musicId);
				$i->Save();
			}
			
			//Show case
			$show = New Content_show;
			$content_show_list = $show->GetList(array(array('active', '=', 1)));
			foreach($content_show_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_SHOW, $i->content_showId);
				$i->Save();
			}
			
			//Comic case
			$comic = New Content_comic;
			$content_comic_list = $comic->GetList(array(array('active', '=', 1)));
			foreach($content_comic_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_COMIC, $i->content_comicId);
				$i->Save();
			}
			
			//Book case
			$book = New Content_book;
			$content_book_list = $book->GetList(array(array('active', '=', 1)));
			foreach($content_book_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_BOOK, $i->content_bookId);
				$i->Save();
			}
		
			
			//Game case
			$game = New Content_game;
			$content_game_list = $game->GetList(array(array('active', '=', 1)));
			foreach($content_game_list as $i){
				$i->view_count = (int)$content_log_helper::calculateViewCount(CONTENTTYPE_GAME, $i->content_gameId);
				$i->Save();
			}
			
			
			//----------------------------END CALCULATED VALUES PERSIST-------------------------------------------
		
					

?>
