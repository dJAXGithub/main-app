<?php
interface icontent {
	function GetId();
	function GetCategoryId();
	function GetDisplayName();
	function GetDisplayNameCategory();
	function GetItemsBySection($section, $count, $limit);
	function GetItemsByCategory($categoryid, $count);
	function SearchItems($q, $providerid, $count, $limit);
	function GetHtmlSlideImages();
	function GetTrackList();
	function GetPurchasedItems($userid, $count);
	//GetAmazonContentUrl()->Return the secured amazon URI
	//INPUT PARAMETER: (BOOL)$main_file  true to return the main file - false to return the promotional video (mp4 file)
	//TODO evaluate move out from INTERFACE if is factorizable
	function GetAmazonContentUrl($main_file);
	function GetItemsByProvider($providerid);
	function GetParent();
	function GetItemsBySerie($serieid, $count);
	function GetSerieContentItemsForEdit($providerid, $serieid);
	function AddToSerie($id, $serieid);
	function UpdateRating();
	function GetReviewItems($userid);
	function deleteAmazonFiles();
	function UpdateSection($section, $enabled);
}
?>