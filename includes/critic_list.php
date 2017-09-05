<?php
$content_critic = new content_critic();
$content_critic_list = $content_critic->GetList(array(array("contentid", "=", $id), array("content_type", "=", $content_type)));
if (count($content_critic_list) == 0) {
	echo '<div class="critic-list-no-results"><div class="Orange">NO</div><div class="BlackBold">CRITICS</div></div>';
}
else {
	foreach ($content_critic_list as $content_critic) {
?>
		<div class="critic-list">
			<hr />
			<div class="critic-list-title">
<?php echo $content_critic->title; ?>
			</div>
			<div class="critic-list-date">
<?php echo 'Posted '.converter::convert_date("Y-m-d H:i:s", "M j, Y, g:i a", $content_critic->critic_date); ?>
			</div>
			<div class="critic-list-comment">
<?php echo $content_critic->comment; ?>
			</div>
		</div>
<?php
	}
}
?>