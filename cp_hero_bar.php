<?php
define('YOUTUBE','youtube');
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$rhovit_user_provider_edit = new rhovit_user_provider_extended();
$rhovit_user_provider_edit->Get($rhovit_user_provider->rhovit_user_providerId);

$content_manager = new content_manager();
//$content_type_par = $_REQUEST["cmb_content_type"];
//var_dump($content_type_par);exit;
$content_type_list = $content_manager->GetContentTypes();
$hero_item = New Rhovit_user_provider_hero_link;

if ($rhovit_user_provider->rhovit_user_provider_typeid != USERPROVIDERTYPE_NETWORK) {
	header("location: cp_product_list.php");
	exit();
}
if (!$_POST["cmb_picture"]) $_POST["cmb_picture"] = 1;
if ($_POST["hdn_hero_bar"]) {
	if ($_FILES['fil_thumb']) {
		$target_path = UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$_POST["cmb_picture"]."_thumb.jpg";
		move_uploaded_file($_FILES['fil_thumb']['tmp_name'], $target_path);
	}
	//var_dump($_POST);exit;
    $hero_item->DeleteList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId)));
	for($i=1;$i<=5;$i++) { 
		if ($_FILES['fil_large_'.$i]) {
			$target_path = UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$i."_large.jpg";
			//var_dump($target_path);
			move_uploaded_file($_FILES['fil_large_'.$i]['tmp_name'], $target_path);
		}
        //var_dump($hero_item->content_type);
        if($_POST['txt_link_item_id_' . $i]>0 || ($_POST['txt_link_item_title_' . $i]!='' && $_POST['cmb_link_content_type_' . $i]==YOUTUBE)){
            $hero_item->content_type = $_POST['cmb_link_content_type_' . $i];
            if($hero_item->content_type==YOUTUBE){
                $hero_item->video_link = $_POST['txt_link_item_title_' . $i];
                $hero_item->content_id = 0;
            }else{
                $hero_item->content_id = $_POST['txt_link_item_id_' . $i];
                $hero_item->video_link = '';
            }
            $hero_item->provider_id = $rhovit_user_provider->rhovit_user_providerId;
            $hero_item->image_index = $i;
            $hero_item->SaveNew();
        }
	}
}


$header_helper = new header_helper();
$header_helper->provider_page = true;
$header_helper->AddJsScript('js/scripts.js');
$header_helper->AddJsScript('js/jquery-ui-1.9.2.custom.min.js');
$header_helper->AddJsScript('js/hero_bar.js');
$header_helper->AddCssSheet('css/jquery-ui-1.9.2.custom.min.css');

include('header.php');
?>
<div class="contentCenter">	
 <div class="cboth"></div> 
    <div class="contentHeaderCpProfile">
        <div class="contentHeaderCpProfileAvatar">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="150"><? 
							if(file_exists(UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.".png")) echo '<img src="'.UPLOAD_USERS_PROVIDERS_AVATARS.$rhovit_user_provider->rhovit_user_providerId.'.png" width="111"  />';
							else echo '<img src="images/movie256x256.png" width="95" />';
							?></td>
				<td width="93%">
					<div class="contentHeaderCpProfileName">
					<?php echo $rhovit_user_provider_edit->alias; ?>
					</div>
				</td>
			</tr>
		</table>
		</div>
    </div>
	<div class="adminPageContent">
		<h2>HERO BAR</h2>
		<!--
		<div class="contentHeaderAdmin">	
			<div class="imgHeaderLeft">
				<div class="imgHeader">
<?php
	for ($i = 1; $i < 4; $i++) echo '<img src="'.UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$i.'_thumb.jpg?v='.date("His").'" id="thumb__'.$i.'" alt="" class="adminHeroBarEditThumb" onclick="changeLargeImageHeroBar(\'\', '.$i.')" />';
?>
			  </div>
			</div>
			
			<div class="imgHeaderCenterAdmin">
<?php
for ($i = 1; $i < 7; $i++) echo '<img src="'.UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$i.'_large.jpg?v='.date("His").'" id="large__'.$i.'" alt="" class="adminHeroBarEditLarge"'.($i == 1 ? '' : ' style="display:none"').' />';
?>
			</div>
			
			<div class="imgHeaderRight">
<?php
	for ($i = 4; $i < 7; $i++) echo '<img src="'.UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$i.'_thumb.jpg?v='.date("His").'" id="thumb__'.$i.'" alt="" class="adminHeroBarEditThumb" onclick="changeLargeImageHeroBar(\'\', '.$i.')" />';
?>
			</div>
			
		</div>
		-->
		<div class="cboth">&nbsp;</div>
		<form name="frm_hero_bar" id="frm_hero_bar" action="cp_hero_bar.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="hdn_hero_bar" id="hdn_hero_bar" value="1" />
			<div class="register_field_between"></div>
			<!--
			<div class="register_field">Picture:</div>
			<div>
				<select name="cmb_picture" id="cmb_picture">
<?php
$pictures = array(1 => "UPPER LEFT", 2 => "MEDIUM LEFT", 3 => "LOWER LEFT", 4 => "UPPER RIGHT", 5 => "MEDIUM RIGHT", 6 => "LOWER RIGHT");
foreach ($pictures as $number => $position) {
	$selected = $number == $_POST["cmb_picture"] ? ' selected="selected"' : '';
	echo '<option value="'.$number.'"'.$selected.'>'.$position.'</option>';
}
?>
				</select>
			</div>
			-->
			<!--
			<div class="register_field_between"></div>
			<div class="register_field">Thumbnail [JPG]:</div>
			<div>
				<input type="file" name="fil_thumb" id="fil_thumb" />
			</div>
			-->
			<?php for($i=1;$i<=5;$i++) { ?>
			<div class="register_field_between"></div>
			<div class="register_field">Picture <?=$i?> [JPG]:</div>
			<div>
				<input type="file" name="fil_large_<?=$i?>" id="fil_large_<?=$i?>" /><br>
				 <?php 
                 $file = UPLOAD_USERS_PROVIDERS_HERO.$rhovit_user_provider->rhovit_user_providerId."_".$i."_large.jpg";
                 //echo $file;
				 if(file_exists($file)) 
							echo '<input type="hidden" name="fil_large_'.$i.'_hidden" id="fil_large_'.$i.'_hidden" value="'.$file.'" />
                                  <img src="'.$file.'?v='.date('His').'" width="111"  />';
				 ?>
                 
                <div class="cboth"></div>
                <br>
                <div class="register_field">Link to:</div>
                <div><?php
                    $content_name = '';
                    $content_id = '';
                    $current_content_type = '';
                    $aux = $hero_item->GetList(array(array('provider_id','=',$rhovit_user_provider->rhovit_user_providerId), array('image_index','=',$i)));
                    if(isset($aux[0])){
                        $content_id = $aux[0]->content_id;
                        $content_name = $aux[0]->video_link;
                        $current_content_type = $aux[0]->content_type;
                        if($current_content_type!=YOUTUBE){
                            $content_manager_aux = new content_manager($current_content_type);
                            $content_item = $content_manager_aux->GetContentItem($content_id);
                            $content_name = $content_item->title;
                        }
                        //var_dump($content_item->name);
                    }
                ?>
                    <select name="cmb_link_content_type_<?=$i?>" id="cmb_link_content_type_<?=$i?>" onchange="resetHeroBarLink(<?=$i?>)">
                    <?php
                    
                    foreach ($content_type_list as $content_type) {
                        $content_manager->content_type = $content_type;
                        $selected = $content_type == $current_content_type ? ' selected="selected"' : '';
                        echo '<option value="'.$content_type.'"'.$selected.'>'.$content_manager->GetContentTypeName().' Product</option>';
                    }
                        if($current_content_type == YOUTUBE)
                            $selected = ' selected="selected"';
                        echo '<option value="'.YOUTUBE.'"'.$selected.'>YOUTUBE Link</option>';
                    ?>
                                    </select>
                    
                    <input type="text" name="txt_link_item_title_<?=$i?>" id="txt_link_item_title_<?=$i?>" maxlength="255" size="55" value="<?php echo $content_name; ?>" />
                    <span id="loading_link_<?=$i?>"></span>
                    <?php
                    
                    ?>
                    <input type="hidden" name="txt_link_item_id_<?=$i?>" id="txt_link_item_id_<?=$i?>" value="<?=$content_id?>" />
                    <a href="#" onclick="return resetHeroBarLink(<?=$i?>)" class="link_item">Remove</a>
                </div>
                 
			</div>
            <hr>
			<?php } ?>
			</form>
			<div class="buttonLogin"><a href="cp_product_list.php" >Cancel</a></div>
			<div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editHeroBar(false)">Save HERO BAR</a></div>
			
			<div class="register_field_between"></div>
			<br>
		<div class="cboth"></div>
		<div class="loginErrorList">
			<ul id="ul_hero_bar_error" class="login_error errorList"<?php if (!$hero_bar_error) echo ' style="display:none"'; ?>><?php echo $hero_bar_error; ?></ul>&nbsp;
		</div>
	</div>
	<div class="cboth"></div>
</div>
<?php include('footer.php'); ?>  
<script>


function autocomplete(index){
		jQuery("#txt_link_item_title_" + index).autocomplete( {
			source: function(request, response) {
                if(jQuery("#cmb_link_content_type_" + index).val()!='<?=YOUTUBE?>'){
                    jQuery("#loading_link_" + index).html("Loading...");
                    jQuery("#txt_link_item_id_" + index).val("");
                    jQuery.ajax({
                        url: "admin/ajax/search_items.php", 
                        data: { q: request.term, type: jQuery("#cmb_link_content_type_" + index).val() },
                        dataType: "json",
                        success: function( data ) {
                            console.log(data);
                            response( jQuery.map( data.items, function( item ) {
                                jQuery("#loading_link_" + index).html("");
                                return {
                                    id: item.id,
                                    label: item.title,
                                    value: item.title
                                }
                            }));
                        },
                        error: function( data ) {
                            console.log(data);
                        }
                    });
                }
			},
			select: function(event, ui) {
				jQuery("#txt_link_item_id_" + index).val(ui.item.id);
			}
		});
}

jQuery(document).ready(function() {
	if (jQuery("#txt_link_item_title_1").length) {
        autocomplete(1);
    }
	if (jQuery("#txt_link_item_title_2").length) {
        autocomplete(2);
    }
	if (jQuery("#txt_link_item_title_3").length) {
        autocomplete(3);
    }
	if (jQuery("#txt_link_item_title_4").length) {
        autocomplete(4);
    }
	if (jQuery("#txt_link_item_title_5").length) {
        autocomplete(5);
    }
});
</script>
</div>
