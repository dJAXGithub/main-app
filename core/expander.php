<?php
class expander {
	public static function GetExpander($text, $length, $expandID, $collapseID, $textClass, $linkClass, $expandText, $collapseText) {
		if (strlen($text) > $length) {
			return '
				<div id="'.$collapseID.'" class="'.$textClass.'">'.substr($text, 0, $length).'...<div class="'.$linkClass.'"><a href="#" onclick="return Expander.Expand(\''.$collapseID.'\', \''.$expandID.'\')">'.$expandText.'</a></div></div>
				<div id="'.$expandID.'" class="'.$textClass.'" style="display:none">'.$text.'<div class="'.$linkClass.'"><a href="#" onclick="return Expander.Collapse(\''.$collapseID.'\', \''.$expandID.'\')">'.$collapseText.'</a></div></div>
			';
		}
		else return '<div class="'.$textClass.'">'.$text.'</div>';
	}
}
?>