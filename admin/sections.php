<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$header_helper = new header_helper();
$header_helper->AddJsScript('js/jquery-ui-1.9.2.custom.min.js');
$header_helper->AddJsScript('js/admin/section.js');
$header_helper->AddCssSheet('css/jquery-ui-1.9.2.custom.min.css');
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="adminPageContent">
		<h2>SECTIONS</h2>
		<div class="register_field">Section:</div>
		<div>
			<select name="cmb_section" id="cmb_section" onchange="changeSection(this.value)">
				<option value="<?php echo url_handler::SetSectionUrl(SECTION_THECHOSENDAILY); ?>"><?php echo SECTION_THECHOSENDAILY; ?></value>
				<option value="<?php echo url_handler::SetSectionUrl(SECTION_THEFEATURED); ?>"><?php echo SECTION_THEFEATURED; ?></value>
				<option value="<?php echo url_handler::SetSectionUrl(SECTION_THEMAINCHOSENDAILY); ?>"><?php echo SECTION_THEMAINCHOSENDAILY; ?></value>
				<option value="<?php echo url_handler::SetSectionUrl(SECTION_THEMAINFEATURED); ?>"><?php echo SECTION_THEMAINFEATURED; ?></value>
			</select>
		</div>
		<div class="register_field_between"></div>
			<div class="register_field">Product:</div>
			<div>
				<select name="cmb_content_type" id="cmb_content_type" onchange="resetItemToAdd()">
<?php
$content_manager = new content_manager();
$content_type_list = $content_manager->GetContentTypes();
foreach ($content_type_list as $content_type) {
	$content_manager->content_type = $content_type;
	echo '<option value="'.$content_type.'">'.$content_manager->GetContentTypeName().'</option>';
}
?>
				</select>
				<input type="text" name="txt_item_title" id="txt_item_title" maxlength="255" size="55" />
				<input type="hidden" name="txt_item_id" id="txt_item_id" />
				<a href="#" onclick="return addItemToSection()" class="link_item">Add to section</a>
			</div>
		<div class="register_field_between"></div>
		<div class="cboth"></div>
		<div class="loginErrorList"><ul id="ul_sections_error" class="login_error errorList" style="display:none"></ul>&nbsp;</div>
		<div id="div_items" class="cboth">
<?php
include("ajax/items_by_section.php");
?>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>