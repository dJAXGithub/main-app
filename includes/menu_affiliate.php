<div class="afilliateContentBotoneraHeader">
	<div class="afilliateContentBotonera">
		<ul id="nav" class="dropdown dropdown-horizontal">
			<li class="afilliateListItem"><a href="<?php echo url_handler::GetAbsoluteUrl("portals/".($affiliate->content_type ? ($affiliate->content_type."/") : "").$affiliate->slug); ?>"><?php echo strtoupper($affiliate->name); ?></a></li>
			<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php"); ?>" class="dir">MAJORS</a>
<?php
if ($affiliate->content_type) {
	$rhovit_user_provider = new rhovit_user_provider_extended();
	$rhovit_user_provider_list = $rhovit_user_provider->FindNetworkProviders($affiliate->content_type);
	if (count($rhovit_user_provider_list) > 0) {
		echo '<ul>';
		foreach ($rhovit_user_provider_list as $rhovit_user_provider) {
			echo '<li><a href="'.url_handler::GetAbsoluteUrl("cp_network_items.php?id=".$rhovit_user_provider->rhovit_user_providerId).'">'.$rhovit_user_provider->alias.'</a></li>';
			}
		echo '</ul>';
	}
}
else {
?>
			  <ul>
				<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php?type=".CONTENTTYPE_FILM); ?>">FILMS</a></li>
				<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php?type=".CONTENTTYPE_MUSIC); ?>">MUSIC</a></li>
				<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php?type=".CONTENTTYPE_SHOW); ?>">TV SHOWS</a></li>
				<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php?type=".CONTENTTYPE_GAME); ?>">GAMES</a></li>
				<li><a href="<?php echo url_handler::GetAbsoluteUrl("networks_list.php?type=".CONTENTTYPE_COMIC); ?>">COMICS</a></li>
			  </ul>
<?php } ?>
			</li>
		</ul>
	</div>
</div>