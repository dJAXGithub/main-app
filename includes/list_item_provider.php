<? if($content_item->active && $content_item->fileid<>'') { ?>
<div class="ask" ><a class="link_item" href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>"><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg?".md5(time()); ?>" style="border:none" alt="" /></a>
	<ul>
		<li class="item_provider_header">
			<div class="listItemHeaderBackground">
				<h1><?php echo $content_item->title; ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
			</div>
			<div class="listItemBackground">
				<br />
				<div class="button-view"><a href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>" target="_blank">View Product</a></div><br />
				<!--<div class="button-view"><a href="#" target="_blank">View Stats</a></div><br />-->
				<!-- <div class="button-view"><a href="cp_upcoming.php?type=<?php echo $content_item->content_type; ?>&contentid=<?php echo $content_item->id; ?>">Upcoming</a></div><br />
				<div class="button-view"><a href="cp_critics.php?type=<?php echo $content_item->content_type; ?>&contentid=<?php echo $content_item->id; ?>">Critics</a></div><br /> -->
				<? if($content_item->price>0){ ?>
				<div class="button-view"><a href="cp_gratis_content.php?type=<?php echo $content_item->content_type; ?>&contentid=<?php echo $content_item->id; ?>">Gratis</a></div><br />
				<? } ?>
				<div class="button-view"><a href="cp_edit_content.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>">Edit Product</a></div><br />
				<div class="button-view"><a onclick='return confirm(&#039;Are you sure?&#039;);' href="cp_delete_content.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>" style="color:orange">Delete Product</a></div>
<?php if ($rhovit_user_provider_series_count > 0) { ?>
				<div class="button-shoutout">
					Series:&nbsp;<select name="cmb_serie_<?php echo $content_item->id; ?>" id="cmb_serie_<?php echo $content_item->id; ?>" onchange="changeContentSerie(<?php echo $content_item->id; ?>, '<?php echo $content_item->content_type; ?>', this.value)">
						<option value="0">None</option>
<?php
						foreach ($rhovit_user_provider_series as $rhovit_user_provider_serie) {
							$selected = $rhovit_user_provider_serie->rhovit_user_provider_serieId == $content_item->serieid ? ' selected="selected"' : '';
							echo '<option value="'.$rhovit_user_provider_serie->rhovit_user_provider_serieId.'"'.$selected.'>'.$rhovit_user_provider_serie->name.'</option>';
						}
?>
					</select>
				</div>
<?php } ?>
			</div>
		</li>
	</ul>
</div>
<div class="shadowProduct"></div>

<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 20); ?></p>
<? 
	if($content_item->price>0) echo '<p class="jcarousel-precio">$'.$content_item->price.'</p>';
	else echo '<p class="jcarousel-precio">"Pay what you want" item</p>';
?>
<!--<p style="display:inline; padding-left:26px; padding-top:0px"><?php echo content_review_extended::GetRatingStars($content_item->rating); ?></p>-->
<? }elseif(!$content_item->active && $content_item->fileid==''){ 

//$errors[] = "Unable to find files";

$pq = New process_video_queue;
$pqe = New process_video_queue_error_log;

$a_filter = array(array('content_id','=',$content_item->id), array('type','=',$content_item->content_type));
$pqs = $pq->GetList($a_filter);

if($pqs[0]->status=="error"){
	$pqe_list = $pqe->GetList(array(array('id_process_video_queue','=',$pqs[0]->process_video_queueId)));
	foreach($pqe_list as $item) $errors[] = $item->description;
}

if(!count($errors)){

?>

<div class="ask" ><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"; ?>" style="border:none" alt="" />
	<ul>
		<li class="item_provider_header">
			<div class="listItemHeaderBackground">
				<h1><?php echo $content_item->title; ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
			</div>
			<div class="listItemBackground">
				<br />
				<h2 style="font-size:12px;color:red">THE CONTENT IS BEING PROCESSED: Will be available on the site soon...</h2>
			</div>
		<br />
</li>
	</ul>
</div>
<div class="shadowProduct"></div>
<p class="jcarousel-titulo"><img src="images/loading.gif" align="absmiddle" width="15" /><span style="color:black; padding-left:5px">Encoding file...</span></p>
<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 20); ?></p>
<? 
	if($content_item->price>0) echo '<p class="jcarousel-precio">$'.$content_item->price.'</p>';
	else echo '<p class="jcarousel-precio">"Pay what you want" item</p>';
	
}else{

?>
	<div class="ask" ><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"; ?>" style="border:none" alt="" />
		<ul>
			<li class="item_provider_header">
				<div class="listItemHeaderBackground">
					<h1><?php echo $content_item->title; ?></h1>
					<h2><?php echo $content_item->name; ?></h2>
				</div>
				<div class="listItemBackground">
					<br>
					<h2 style="font-size:12px;color:red">Error(s) detected:</h2>
					<span style="color:black; font-size:12px">
						<? foreach($errors as $e) echo "<br />- ".$e;?>
					</span>
					<br>
					<br>
					<hr>
					<span style="color:black; font-size:10px">
					<a href="mailto:info@rhovit.com">Contact Us</a> for help
					</span>
				</div>
			<br />
			</li>
		</ul>
	</div>
	<div class="shadowProduct"></div>
	<p class="jcarousel-titulo"><span style="color:red">ERROR Encoding file</span></p>
	<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 20); ?></p>
	<? 
	if($content_item->price>0) echo '<p class="jcarousel-precio">$'.$content_item->price.'</p>';
	else echo '<p class="jcarousel-precio">"Pay what you want" item</p>';
	?>
	<?
	}
}

 ?> 
