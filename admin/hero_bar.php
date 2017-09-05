<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["cmb_picture"]) $_POST["cmb_picture"] = 1;
if (!$_REQUEST["cmb_content_type"]) $_REQUEST["cmb_content_type"] = "home";
if ($_POST["cmb_content_type"] != "home") $display_home = ' style="display:none"';
$content_manager = new content_manager();
$content_type_par = $_REQUEST["cmb_content_type"];
//var_dump($content_type_par);exit;
$content_type_list = $content_manager->GetContentTypes();
$hero_bar_link = new hero_bar_link_extended();
if ($_POST["hdn_hero_bar"]) {
    /*
	if ($_FILES['fil_thumb']) {
		$target_path = "../".UPLOAD_HEADER.($display_home ? ($_POST["cmb_content_type"]."/") : "").$_POST["cmb_picture"]."_thumb.jpg";
		move_uploaded_file($_FILES['fil_thumb']['tmp_name'], $target_path);
	}
    */ 
	if ($_FILES['fil_large']) {
		$target_path = "../".UPLOAD_HEADER.($display_home ? ($_POST["cmb_content_type"]."/") : "").$_POST["cmb_picture"]."_large.jpg";
		move_uploaded_file($_FILES['fil_large']['tmp_name'], $target_path);
	}
	$hero_bar_link = $hero_bar_link->GetSingle(array(array("menu", "=", $_POST["cmb_content_type"]), array("position", "=", $_POST["cmb_picture"])));
	if ($_POST["txt_link_item_id"]) {
		if (!$hero_bar_link->hero_bar_linkId) {
			$hero_bar_link = new hero_bar_link_extended();
			$hero_bar_link->menu = $_POST["cmb_content_type"];
			$hero_bar_link->position = $_POST["cmb_picture"];
		}
		$hero_bar_link->content_type = $_POST["cmb_link_content_type"];
		$hero_bar_link->contentid = $_POST["txt_link_item_id"];
		$hero_bar_link->Save();
	}
	else if ($hero_bar_link->hero_bar_linkId) {
		$hero_bar_link->Delete();
	}
}
$header_helper = new header_helper();
$header_helper->AddJsScript('js/jquery-ui-1.9.2.custom.min.js');
$header_helper->AddJsScript('js/hero_bar.js');
$header_helper->AddCssSheet('css/jquery-ui-1.9.2.custom.min.css');
include('header.php');
$current_links = array();
foreach ($content_type_list as $content_type) {
	$current_type_links = $hero_bar_link->GetCurrentHeroBarLinks($content_type);
	foreach ($current_type_links as $current_type_link) $current_links[] = $current_type_link;
}

?>
<script type="text/javascript">
	var currentLinks = new Array(
<?php
$i = 0;
foreach ($current_links as $current_link) {
	if ($i > 0) echo ', ';
	echo '{ "type":"'.$current_link->content_type.'", "id":'.$current_link->contentid.', "menu":"'.$current_link->menu.'", "position":'.$current_link->position.', "title":"'.$current_link->title.'" }';
	if ($current_link->position == $_POST["cmb_picture"] && strcmp($current_link->menu, $_POST["cmb_content_type"]) == 0) {
		$link_content_type = $current_link->content_type;
		$link_item_id = $current_link->contentid;
		$link_item_title = $current_link->title;
	}
	$i++;
}
?>
	);
</script>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="adminPageContent">
		<h2>HERO BAR</h2>
		<div>	
        <!--
			<div class="imgHeaderLeft">
				<div class="imgHeader">
				<img src="../<?php echo UPLOAD_HEADER; ?>1_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_1" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 1)" />
				<img src="../<?php echo UPLOAD_HEADER; ?>2_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_2" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 2)" />
				<img src="../<?php echo UPLOAD_HEADER; ?>3_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_3" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 3)" />
                <?php
                foreach ($content_type_list as $content_type) {
                    $display_content_type = $content_type == $_POST["cmb_content_type"] ? '' : ' style="display:none"';
                    for ($i = 1; $i < 4; $i++) echo '<img src="../'.UPLOAD_HEADER.$content_type."/".$i.'_thumb.jpg?v='.date("His").'" id="thumb_'.$content_type.'_'.$i.'" alt="" class="adminHeroBarEditThumb"'.$display_content_type.' onclick="changeLargeImageHeroBar(\''.$content_type.'\', '.$i.')" />';
                }
                ?>
			  </div>
             
			</div> -->
			<div class="imgHeaderCenterAdmin">
            <?php
            if($content_type_par=='home')
                $content_type_par = '';
            for ($i = 1; $i < 7; $i++) {
                $display = ($i>1) ? 'style="display:none"' : '';
                echo '<img src="../'.UPLOAD_HEADER.$content_type_par.'/'.$i.'_large.jpg?v='.date("His").'" id="large_home_'.$i.'" alt="" class="adminHeroBarEditLarge" '.$display.' />';
                
            }
            /*
            foreach ($content_type_list as $content_type) {
                for ($i = 1; $i < 7; $i++) {
                    if ($i == 1) echo '<img src="../'.UPLOAD_HEADER.$content_type."/".$i.'_large.jpg?v='.date("His").'" id="large_'.$content_type.'_'.$i.'" alt="" class="adminHeroBarEditLarge"'.($content_type == $_POST["cmb_content_type"] ? '' : ' style="display:none"').' />';
                    else echo '<img src="../'.UPLOAD_HEADER.$content_type."/".$i.'_large.jpg?v='.date("His").'" id="large_'.$content_type.'_'.$i.'" alt="" class="adminHeroBarEditLarge" style="display:none" />';
                }
            }
            */ 
            ?>
			</div>
	<!--		<div class="imgHeaderRight">
				<img src="../<?php echo UPLOAD_HEADER; ?>4_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_4" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 4)" />
				<img src="../<?php echo UPLOAD_HEADER; ?>5_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_5" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 5)" />
				<img src="../<?php echo UPLOAD_HEADER; ?>6_thumb.jpg?v=<?php echo date("His"); ?>" id="thumb_home_6" alt="" class="adminHeroBarEditThumb"<?php echo $display_home; ?> onclick="changeLargeImageHeroBar('home', 6)" />

<?php
foreach ($content_type_list as $content_type) {
	$display_content_type = $content_type == $_POST["cmb_content_type"] ? '' : ' style="display:none"';
	for ($i = 4; $i < 7; $i++) echo '<img src="../'.UPLOAD_HEADER.$content_type."/".$i.'_thumb.jpg?v='.date("His").'" id="thumb_'.$content_type.'_'.$i.'" alt="" class="adminHeroBarEditThumb"'.$display_content_type.' onclick="changeLargeImageHeroBar(\''.$content_type.'\', '.$i.')" />';
}
?>
			</div>
            -->
		</div>
		<div class="cboth">&nbsp;</div>
       
		<form name="frm_hero_bar" id="frm_hero_bar" action="hero_bar.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="hdn_hero_bar" id="hdn_hero_bar" value="1" />
			
            <div class="register_field_between"></div>
			<div class="register_field">Picture:</div>
			<div>
				<select name="cmb_picture" id="cmb_picture" onchange="adminChangeHeroBarLink(this.value)">
                <?php
                $pictures = array(1 => "1", 2 => "2", 3 => "3", 4 => "4", 5 => "5", 6 => "6");
                foreach ($pictures as $number => $position) {
                    $selected = $number == $_POST["cmb_picture"] ? ' selected="selected"' : '';
                    echo '<option value="'.$number.'"'.$selected.'>'.$position.'</option>';
                }
                ?>
				</select>
			</div>
       
			<div class="register_field_between"></div>
			<div class="register_field">Menu:</div>
			<div>
				<select name="cmb_content_type" id="cmb_content_type" onchange="adminChangeHeroBar(this.value, new Array('home'<?php foreach ($content_type_list as $content_type) echo ", '".$content_type."'"; ?>))">
					<option value="home">HOME</option>
                    <?php
                    foreach ($content_type_list as $content_type) {
                        $content_manager->content_type = $content_type;
                        $selected = $content_type == $content_type_par ? ' selected="selected"' : '';
                        echo '<option value="'.$content_type.'"'.$selected.'>'.$content_manager->GetContentTypeName().'</option>';
                    }
                    ?>
				</select>
			</div>
            <!--
			<div class="register_field_between"></div>
			<div class="register_field">Thumbnail [JPG]:</div>
			<div>
				<input type="file" name="fil_thumb" id="fil_thumb" />
			</div>
            -->
			<div class="register_field_between"></div>
			<div class="register_field">Picture [JPG]:</div>
			<div>
				<input type="file" name="fil_large" id="fil_large" />
			</div>
			<div class="register_field_between"></div>
			<div class="register_field">Link to Product:</div>
			<div>
				<select name="cmb_link_content_type" id="cmb_link_content_type" onchange="adminResetHeroBarLink()">
<?php
foreach ($content_type_list as $content_type) {
	$content_manager->content_type = $content_type;
	$selected = $content_type == $link_content_type ? ' selected="selected"' : '';
	echo '<option value="'.$content_type.'"'.$selected.'>'.$content_manager->GetContentTypeName().'</option>';
}
?>
				</select>
                
				<input type="text" name="txt_link_item_title" id="txt_link_item_title" maxlength="255" size="55" value="<?php echo $link_item_title; ?>" />
                <span id="loading_link"></span>
				<input type="hidden" name="txt_link_item_id" id="txt_link_item_id" value="<?php echo $link_item_id; ?>" />
				<a href="#" onclick="return adminResetHeroBarLink()" class="link_item">Remove</a>
			</div>
			<div class="register_field_between"></div>
		</form>
		<div>
			<div class="buttonLogin"><a href="main.php" >Cancel</a></div>
			<div class="buttonLogin" style="margin-left:8px"><a href="#" onclick="return editHeroBar(true)">Save</a></div>
		</div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_hero_bar_error" class="login_error errorList"<?php if (!$hero_bar_error) echo ' style="display:none"'; ?>><?php echo $hero_bar_error; ?></ul>&nbsp;</div>

	</div>
</div>
<?php
include('footer.php');
?>
