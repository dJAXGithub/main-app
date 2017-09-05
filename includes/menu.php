<ul id="nav" class="dropdown dropdown-horizontal">
    <li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_FILM); ?>" class="dir">FILMS</a>
		<ul>
<?php
$film_category = new film_category();
$film_categories = $film_category->GetList(null,'name');
for ($i = 0; $i < count($film_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
	echo '<li'.$first.'><a href="'.url_handler::GetAbsoluteUrl('list.php?type='.CONTENTTYPE_FILM.'&categoryid='.$film_categories[$i]->film_categoryId).'">'.$film_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_MUSIC); ?>" class="dir">MUSIC</a>
		<ul>
<?php
$music_category = new music_category();
$music_categories = $music_category->GetList(null,'name');
for ($i = 0; $i < count($music_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
	echo '<li'.$first.'><a href="list.php?type='.CONTENTTYPE_MUSIC.'&categoryid='.$music_categories[$i]->music_categoryId.'">'.$music_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_SHOW); ?>" class="dir dir-show">SERIES</a>
		<ul>
<?php
$show_category = new show_category();
$show_categories = $show_category->GetList(null,'name');
for ($i = 0; $i < count($show_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
	echo '<li'.$first.'><a href="list.php?type='.CONTENTTYPE_SHOW.'&categoryid='.$show_categories[$i]->show_categoryId.'">'.$show_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_GAME); ?>" class="dir">GAMES</a>
		<ul>
<?php
$game_category = new game_category();
$game_categories = $game_category->GetList(null,'name');
for ($i = 0; $i < count($game_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
	echo '<li'.$first.'><a href="list.php?type='.CONTENTTYPE_GAME.'&categoryid='.$game_categories[$i]->game_categoryId.'">'.$game_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_BOOK); ?>" class="dir">BOOKS</a>
		<ul>
<?php
$book_category = new book_category();
$book_categories = $book_category->GetList(null,'name');
for ($i = 0; $i < count($book_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
	echo '<li'.$first.'><a href="list.php?type='.CONTENTTYPE_BOOK.'&categoryid='.$book_categories[$i]->book_categoryId.'">'.$book_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="<?php echo url_handler::GetAbsoluteUrl("product_index.php?type=".CONTENTTYPE_COMIC); ?>" class="dir">COMICS</a>
		<ul>
<?php
$comic_category = new comic_category();
$comic_categories = $comic_category->GetList(null,'name');
for ($i = 0; $i < count($comic_categories); $i++) {
	$first = $i == 0 ? ' class="first"' : '';
echo '<li'.$first.'><a href="list.php?type='.CONTENTTYPE_COMIC.'&categoryid='.$comic_categories[$i]->comic_categoryId.'">'.$comic_categories[$i]->name.'</a></li>';
}
?>
		</ul>
	</li>
	<li><a href="networks_list.php" class="dir">SHOPS</a>
    <!--  <ul>
   		<li><a href="networks_list.php?type=<?php echo CONTENTTYPE_FILM; ?>">FILMS</a></li>
		<li><a href="networks_list.php?type=<?php echo CONTENTTYPE_MUSIC; ?>">MUSIC</a></li>
		<li><a href="networks_list.php?type=<?php echo CONTENTTYPE_SHOW; ?>">SERIES</a></li>
		<li><a href="networks_list.php?type=<?php echo CONTENTTYPE_GAME; ?>">GAMES</a></li>
		<li><a href="networks_list.php?type=<?php echo CONTENTTYPE_COMIC; ?>">COMICS</a></li>
      </ul>
      -->
    </li>
	<li><a href="#">CHARITY</a>
        <ul>
            <li><a href="#">Coming soon</a></li>
        </ul>    
    </li>       
</ul>
