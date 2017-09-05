<? 

	require_once('includes/pack_includes.php');
	session_start();
	
	$rhovit_user_provider = security::RhovitUserProvider();
	$providerid = $rhovit_user_provider->rhovit_user_providerId;
	$content_manager = new content_manager($_GET['type'],  null, null, $providerid);
	$contentList = $content_manager->GetContentItemsBackend($_GET['category_id']);
	

	foreach($contentList as $content_item){ ?>
	<? if($content_item->active && $content_item->fileid<>'') { ?>
	<div class="listItem" >
	<div class="ask" ><a class="link_item" href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>"><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"; ?>" style="border:none" alt="" /></a>
		<ul>
			<li class="item_provider_header">
				<h1><?php echo $content_item->title; ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
	<br>

				
				<div class="button-view"><a href="view.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>" target="_blank">View Product</a></div><br />
				<!--<div class="button-view"><a href="#" target="_blank">View Stats</a></div><br />-->
				<div class="button-view"><a href="cp_upcoming.php?type=<?php echo $content_item->content_type; ?>&contentid=<?php echo $content_item->id; ?>">The Upcoming</a></div><br />
				<div class="button-view"><a href="cp_gratis_content.php?type=<?php echo $content_item->content_type; ?>&contentid=<?php echo $content_item->id; ?>">The Gratis</a></div><br />
				<div class="button-view"><a href="cp_edit_content.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>">Edit Product</a></div><br />
				<div class="button-view"><a onclick='return confirm(&#039;Are you sure?&#039;);' href="cp_delete_content.php?type=<?php echo $content_item->content_type; ?>&id=<?php echo $content_item->id; ?>" style="color:orange">Delete Product</a></div>
			</li>
		</ul>
	</div>
	<div class="shadowProduct"></div>

	<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 25); ?></p>
	<p class="jcarousel-precio">$<?php echo $content_item->price; ?></p>
	<p style="display:inline; padding-left:26px; padding-top:0px"><?php echo content_review_extended::GetRatingStars($content_item->rating); ?></p>
	</div>
	<? }elseif(!$content_item->active && $content_item->fileid==''){ ?>
<div class="listItem" >
	<div class="ask" ><img width="157" height="225" src="<?php echo UPLOAD_CONTENT.$content_item->content_type."/".$content_item->id."_cover.jpg"; ?>" style="border:none" alt="" />
		<ul>
			<li class="item_provider_header">
				<h1><?php echo $content_item->title; ?></h1>
				<h2><?php echo $content_item->name; ?></h2>
				<br>
				<h2 style="font-size:12px;color:red">THE CONTENT IS BEING PROCESSED: Will be available in the site soon...</h2>
	<br>
	</li>
		</ul>
	</div>
	<div class="shadowProduct"></div>
	<p class="jcarousel-titulo"><img src="images/loading.gif" align="absmiddle" width="15" /><span style="color:black; padding-left:5px">Encoding file...</span></p>
	<p class="jcarousel-titulo"><?php echo converter::TrimText($content_item->title, 25); ?></p>
	<p class="jcarousel-precio">$<?php echo $content_item->price; ?></p>
</div>
	<? 	} ?> 
<? } 

if(count($contentList)==0) echo '<div class="searchContentNoResult"><div class="Orange">NO</div><div class="BlackBold">RESULTS</div></div>';


?> 

