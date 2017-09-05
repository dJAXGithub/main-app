<?php

	require_once('includes/pack_includes.php');
    if(!isset($public_staff)){
        session_start();
        security::AuthenticateRhovitUserProvider();
        $rhovit_user_provider = security::RhovitUserProvider();
    }else{
        $rhovit_user_provider = $cp;
    }
    
    
 	$cat = New Rhovit_user_provider_about_staff_category;
    $item = New Rhovit_user_provider_about_staff_item;
	$cat_list = $cat->GetList(array(array('provider_id','=',(string)$rhovit_user_provider->rhovit_user_providerId)));
	$result = array();
    foreach($cat_list as $cat){
        $item_list = $item->GetList(array(array('category_id','=',$cat->rhovit_user_provider_about_staff_categoryId)));
         if(isset($public_staff)){
                $delete_category = '';
                $class = 'member-category-title';
            }else{
                $class = '';
                $delete_category = '[ <a class="link_item" onclick="deleteCategory('.$cat->rhovit_user_provider_about_staff_categoryId.')" href="javascript:void(0)">Delete Category</a> ]';
            }
        echo '<div style="clear:both"></div>  
        <div class="'.$class.'"><strong>'.$cat->name.'</strong> '.$delete_category.'<br><br></div>';
        foreach($item_list as $i){
            if(isset($public_staff)){
                $img_size = '155';
                $delete_item = '';
            }else{
                $img_size = '90';
                $delete_item = '<a title="Remove" class="link_item" onclick="deleteMember('.$i->rhovit_user_provider_about_staff_itemId.')" href="javascript:void(0)"> <img alt="Remove" src="images/admin-delete.png" width="12" /> </a>';
            }
            $image = UPLOAD_USERS_PROVIDERS_STAFF_IMAGES.$i->rhovit_user_provider_about_staff_itemId.".jpg";
            echo '<div class="member-item">
                        <div class="member-item-image"><img src="'.$image.'" width="'.$img_size.'" height="'.$img_size.'" /></div> 
                        <div class="member-item-meta">
                            <div class="member-item-name">'.$i->person_name.' </div> 
                            <div class="member-item-title">'.$i->person_title.'</div> 
                            <div class="member-item-location"> - '.$i->person_location . $delete_item.'</div> 
                        </div> 
                  </div>';
            //$result[$cat->name][] = array('id' => $i->rhovit_user_provider_about_staff_itemId, 'name' => $i->person_name, 'title' => $i->person_title, 'location' => $i->person_location, 'file' => '');
        }
    }
    
?>
