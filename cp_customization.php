<?php
include('includes/pack_includes.php');
security::AuthenticateRhovitUserProvider();
$rhovit_user_provider = security::RhovitUserProvider();
$rhovit_user_provider_edit = new rhovit_user_provider_extended();
$rhovit_user_provider_edit->Get($rhovit_user_provider->rhovit_user_providerId);

if ($rhovit_user_provider->rhovit_user_provider_typeid != USERPROVIDERTYPE_NETWORK) {
	header("location: cp_product_list.php");
	exit();
}

if ($_POST["hdn_custom_setting"]) {
    
	$rhovit_user_provider_edit->background_color = $_POST["background_color"];
	$rhovit_user_provider_edit->background_content_color = $_POST["background_content_color"];
	$rhovit_user_provider_edit->font_color = $_POST["font_color"];
	$prefix = str_replace(' ','',$_POST["network_prefix"]);
	$prefix = strtolower($prefix);
	$rhovit_user_provider_edit->url_alias = $prefix;
	$url_streaming = str_replace(' ','',$_POST["url_streaming"]);
	$url_streaming = strtolower($url_streaming);
	$rhovit_user_provider_edit->url_streaming = $url_streaming;
	$rhovit_user_provider_edit->url_socnet_facebook = $_POST["url_socnet_facebook"];
    $rhovit_user_provider_edit->url_socnet_twitter = $_POST["url_socnet_twitter"];
    $rhovit_user_provider_edit->url_socnet_instagram = $_POST["url_socnet_instagram"];
    $rhovit_user_provider_edit->url_socnet_youtube = $_POST["url_socnet_youtube"];
    $rhovit_user_provider_edit->city_id = $_POST["city_id"];
    $rhovit_user_provider_edit->about = $_POST["about"];
    $rhovit_user_provider_edit->about_youtube = $_POST["about_youtube"];
	
    $rhovit_user_provider_edit->Save();
	//var_dump($rhovit_user_provider_edit);
}
$header_helper = new header_helper();
$header_helper->provider_page = true;
$header_helper->AddJsScript('js/scripts.js');
$header_helper->AddJsScript('js/hero_bar.js');
include('header.php');
?>
<div class="contentCenter">	
 <div class="cboth"></div> 
   <div class="adminPageContent">
		
			<h2>Customization</h2>
            <form name="frm_custom_settings" id="frm_custom_settings" action="cp_customization.php" method="post">
                <input type="hidden" name="hdn_custom_setting" id="hdn_custom_setting" value="1" />
            <!--
			<h3>Page Colors</h3>
				<div class="register_field_between"></div>
				<div class="register_field">Background Color:</div>
				<div>
					<input type="color" name="background_color" id="background_color" <?php if($rhovit_user_provider_edit->background_color!='') { ?> value="<?=$rhovit_user_provider_edit->background_color?>" <?php } ?> />
				</div>
				<div class="register_field_between"></div>
				<div class="register_field">Background Content Color:</div>
				<div>
					<input type="color" name="background_content_color" id="background_content_color" <?php if($rhovit_user_provider_edit->background_content_color!='') { ?> value="<?=$rhovit_user_provider_edit->background_content_color?>" <?php } ?> />
				</div>
				<div class="register_field_between"></div>
				<div class="register_field">Font Color:</div>
				<div>
					<input type="color" name="font_color" id="font_color" <?php if($rhovit_user_provider_edit->font_color!='') { ?> value="<?=$rhovit_user_provider_edit->font_color?>" <?php } ?> />
				</div>
		
			<div class="register_field_between"></div>
			-->
			<h3>Network URL</h3>
				<input type="hidden" name="hdn_custom_url" id="hdn_custom_url" value="1" />
				<div class="register_field_between"></div>
				<div class="register_field">Prefix:</div>
				<div>
					<input type="text" name="network_prefix" id="network_prefix" value="<?=$rhovit_user_provider_edit->url_alias?>" />
				</div>
				<br>
				<div>Your custom URL will be: <strong><?=SITE_URL?>network/{YOUR_PREFIX}</strong> <?php if($rhovit_user_provider_edit->url_alias!='') { ?> | <a href="<?=SITE_URL?>network/<?=$rhovit_user_provider_edit->url_alias?>" target="blank">TEST</a> <?php } ?></div>
			<div class="register_field_between"></div>
			<h3>LIVE Streaming</h3>
				
				<div class="register_field"> URL:</div>
				<div>
					<input style="width:400px" type="text" name="url_streaming" id="url_streaming" value="<?=$rhovit_user_provider_edit->url_streaming?>" placeholder="http://www.yourstream.com/example" />
				</div>
				<br>
				<div>A link to your LIVE Streaming page will be showed on your Network page</div>
			
				<div class="register_field_between"></div>
			<h3>Social Networks</h3>
				
				<div class="register_field"> Facebook URL:</div>
				<div>
					<input style="width:400px" type="text" name="url_socnet_facebook" id="url_socnet_facebook" value="<?=$rhovit_user_provider_edit->url_socnet_facebook?>" placeholder="http://www.facebook.com/youraccount" />
				</div>
                <div class="register_field_between"></div>
                <div class="register_field"> Twitter URL:</div>
				<div>
					<input style="width:400px" type="text" name="url_socnet_twitter" id="url_socnet_twitter" value="<?=$rhovit_user_provider_edit->url_socnet_twitter?>" placeholder="http://www.twitter.com/youraccount" />
				</div>
			    <div class="register_field_between"></div>
                <div class="register_field"> Instagram URL:</div>
				<div>
					<input style="width:400px" type="text" name="url_socnet_instagram" id="url_socnet_instagram" value="<?=$rhovit_user_provider_edit->url_socnet_instagram?>" placeholder="http://www.instagram.com/youraccount" />
				</div>
			    <div class="register_field_between"></div>
                <div class="register_field"> Youtube URL:</div>
				<div>
					<input style="width:400px" type="text" name="url_socnet_youtube" id="url_socnet_youtube" value="<?=$rhovit_user_provider_edit->url_socnet_youtube?>" placeholder="http://www.youtube.com/youraccount" />
				</div>
			    <div class="register_field_between"></div>
                <h3>City</h3>
				<div class="register_field">
                    <div class="city_select">
                        <select name="city_id" id="city_id">
                        <?php
                            $current_city = $rhovit_user_provider_edit->city_id;
                            $city = new city();
                            $cities = $city->GetList(array(), "name");
                            foreach ($cities as $city) {
                                $selected = $city->cityId == $current_city ? ' selected="selected"' : '';
                                echo '<option value="'.$city->cityId.'"'.$selected.'>'.$city->name.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="register_field_between"></div>
                <div class="register_field_between"></div>
                <h2>ABOUT</h2>
                <div class="register_field"> Text:</div>
				<div class="register_field">
                    <textarea cols="85" rows="3" name="about" id="about" placeholder="About text to be published on the site"><?=$rhovit_user_provider_edit->about?></textarea>
                </div>
                <div class="register_field_between"></div>
                <div class="register_field_between"></div>
				<div class="cboth"></div>
                <br>
                <div class="register_field"> Youtube video URL:</div>
				<div>
					<input style="width:400px" type="text" name="about_youtube" id="about_youtube" value="<?=$rhovit_user_provider_edit->about_youtube?>" placeholder="https://www.youtube.com/watch?v=XXXXXXXX" />
				</div>
                <div class="register_field_between"></div>
                <div>
                    <div class="buttonLogin"><a href="cp_product_list.php" >Cancel</a></div>
                    <div class="buttonLogin" style="margin-left:10px"><a href="#" onclick="return editCustomSettings(false)">Save Custom Settings</a></div>
                </div>
                <div class="cboth"></div>
                <div class="loginErrorList">
                    <ul id="ul_hero_bar_error" class="login_error errorList"<?php if (!$hero_bar_error) echo ' style="display:none"'; ?>><?php echo $hero_bar_error; ?></ul>&nbsp;
                </div>
                <hr>
                <div class="register_field_between"></div>
                <h2>STAFF/MEMBERS</h2> <div id="staff-add"><a class="link_item" onclick="showElement('staff-add-form', true);showElement('staff-add', false)" href="javascript:void(0)"><img src="images/contact_grey_add.png" width="16" /> Add staff member</a></div>
                <div id="staff-add-form" class="staff-add-form" style="display:none">
                    <div class="register_field"> Category:</div>
					<div class="staff_category_select">
                        <select name="category_id" id="category_id">
                        <?php
                            $category = new rhovit_user_provider_about_staff_category();
                            $category = $category->GetList(array(array('provider_id', '=',$rhovit_user_provider->rhovit_user_providerId)));
                            echo '<option value="">Select</option>';
                            echo '<option value="create">Create new Category...</option>';
                            foreach ($category as $c) {
                                echo '<option value="'.$c->rhovit_user_provider_about_staff_categoryId.'">'.$c->name.'</option>';
                            }
                        ?>
                        </select>
                        <span id="div-add-category" style="display:none">
                            <input style="width:120px" type="text" name="category_name_new" id="category_name_new" value="" placeholder="Name" /> [ <a class="link_item" onclick="addCategory()" href="javascript:void(0)">+ Add</a> ]
                        </span>
                    </div>
                    <div class="register_field_between"></div>
                    <div class="register_field"> Member Name:</div>
					<input style="width:250px" type="text" name="member_name" id="member_name" value="" placeholder="" />
                    <div class="register_field_between"></div>
                    <div class="register_field"> Member Title:</div>
					<input style="width:250px" type="text" name="member_title" id="member_title" value="" placeholder="" />
                    <div class="register_field_between"></div>
                    <div class="register_field"> Location:</div>
					<input style="width:250px" type="text" name="member_location" id="member_location" value="" placeholder="" />
                    <div class="register_field_between"></div>
                    <div class="register_field"> Image:</div>
					<input type="file" name="member_file" id="member_file" />
                    <div class="register_field_between"></div>
                    <div class="buttonLogin" style="align:right"><a onclick="showElement('staff-add', true);showElement('staff-add-form', false);" href="javascript:void(0)" >Cancel</a></div>
                    <div class="buttonLogin" style="margin-left:10px"><a href="javascript:void(0)" onclick="addStaffMember();">Add member</a></div>
                    <div id="add-member-loading" style="display:none">
                        <div class="register_field_between"></div>
                        <img src="images/loading_2.gif" width="22" /> Sending data...
                    </div>
                    <div class="register_field_between"></div>
                    <div class="register_field_between"></div>
                    <div class="register_field_between"></div>
				</div>
				<div class="register_field_between"></div>
                <div id="member-list">No records</div>
                
			</form>
		
	</div>
	<div class="cboth"></div>
</div>
<?php include('footer.php'); ?>  
<script type="text/javascript">
    jQuery(document).ready(function($) {
        loadMemberList(); 
    });
    function loadMemberList(){
        jQuery("#member-list").html("Loading...")
        jQuery.ajax({
            type: "POST",
            url: "ajax_list_staff_member.php",
            context: document.body
        }).done(function(response) {
            jQuery("#member-list").html(response)
        }).error(function() {
            jQuery("#member-list").html("Error creating member list")
        }); 
    }
    function addStaffMember(){
        
        if(jQuery("#category_id").val()=='' || jQuery("#category_id").val()=='create'){
            alert("Category is required");
            return;
        }
        else if(jQuery("#member_name").val()==''){
            alert("Name is required");
            return;
        }
        else if(jQuery("#member_title").val()==''){
            alert("Title is required");
            return;
        }
        else if(jQuery("#member_file").val()==''){
            alert("File is required");
            return;
        }
        
        showElement('add-member-loading', true);
        
        var data = new FormData();
        data.append('category_id', jQuery("#category_id").val());
        data.append('member_name',jQuery("#member_name").val());
        data.append('member_title',jQuery("#member_title").val());
        data.append('member_location',jQuery("#member_location").val());
        
        var inputs = jQuery("#member_file");
        jQuery.each(inputs, function (obj, v) {
            var file = v.files[0];
            var filename = jQuery(v).val();
            var name = jQuery(v).attr("id");
            data.append(name, file, filename);
        });
        
        jQuery.ajax({
            data: data,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            type: "POST",
            url: "ajax_create_staff_member.php",
            context: document.body
        }).done(function(response) {
            console.log(response);
            //Reload list
            loadMemberList();
            jQuery("#member_name").val("")
            jQuery("#member_title").val("")
            jQuery("#member_location").val("")
            jQuery("#member_file").val("")
            jQuery("#category_id").val("").change();
            showElement('staff-add', true);
            showElement('staff-add-form', false);
            showElement('add-member-loading', false);
        }).error(function() {
            showElement('add-member-loading', false);
            alert("Error creating member");
        });
    }

    function addCategory(){
        showElement('add-member-loading', true);
        jQuery.ajax({
          type: "POST",
          url: "ajax_create_staff_category.php",
          data: { "name" : jQuery("#category_name_new").val() },
          context: document.body
        }).done(function(response) {
            var returnedData = JSON.parse(response);
            jQuery("#category_name_new").val("")
            jQuery("#category_id").append(jQuery('<option>', {
                value: returnedData.id,
                text:  returnedData.name
            }));
            jQuery("#category_id").val(returnedData.id).change();
            showElement('add-member-loading', false);
        }).error(function() {
          alert("Error creating the category");
          showElement('add-member-loading', false);
        });
    }
    
    function deleteCategory(id){
        if(confirm('Are you sure delete this Category?')){
            jQuery("#member-list").html("Loading...");
            jQuery.ajax({
              type: "POST",
              url: "ajax_delete_staff_category.php",
              data: { "id" : id },
              context: document.body
            }).done(function(response) {
                loadMemberList();
            }).error(function() {
              alert("Error deleting record");
            });
        }
    }
    
    function deleteMember(id){
        if(confirm('Are you sure delete this Member?')){
            jQuery("#member-list").html("Loading...");
            jQuery.ajax({
              type: "POST",
              url: "ajax_delete_staff_member.php",
              data: { "id" : id },
              context: document.body
            }).done(function(response) {
                loadMemberList();
            }).error(function() {
              alert("Error deleting record");
            });
        }
    }

    function showElement(element, show){
        if(show)
            jQuery('#'+element).show();
        else    
            jQuery('#'+element).hide();
    }

    jQuery('#category_id').on('change', function() {
        if(this.value=="create")
            jQuery("#div-add-category").show();
        else
            jQuery("#div-add-category").hide();   
    });

</script>
</div>
