    <script>
	
		function breakdown_large_view(){
			jQuery("#scrollbar").hide();
			jQuery("#large_view_link").hide();
			jQuery("#small_view_link").show();
			jQuery("#viewport").height(400);
		}
		
		function breakdown_small_view(){
			jQuery("#scrollbar").show();
			jQuery("#large_view_link").show();
			jQuery("#small_view_link").hide();
			jQuery("#viewport").height(254);
		}
	
	</script>
	
	
        <div style="font-weight:200; font-size:12px;float:left">
          <div id="scrollbarSmall">
		<div class="scrollbar" id="scrollbar">
        <div class="track"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport">
			 <div class="overview">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:4px; font-size:13px">
  <tr>
    <td width="57%" height="38" valign="top">
        <div align="left" style="padding-left:8px">
       <? if($writer<>''){?>
          <span style="padding-left:8px; padding-top:10px;"><strong><br />
            <br />
      	Written by:</strong><br />
        <?=$writer?>
        </span>
        <? } ?>
        </div>
    </td>
    <td width="43%" rowspan="2">
      <? 

	switch($content_item->content_type){
			case(CONTENTTYPE_FILM):
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.strtoupper($content_item->content_type).' '.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Company:</strong><br />'.$content_item->company.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Rating:</strong><br />'.$content_item->rating.'</div>
				<div style="width:100%; padding:5px"><strong>Format:</strong><br />'.$content_item->format.'</div>
				<div style="width:100%; padding:5px"><strong>Resolution:</strong><br />'.$content_item->resolution.'</div>
				<!--<div style="width:100%; padding:5px"><strong>File Size:</strong><br />'.$content_item->file_size.'</div>-->
				<div style="width:100%; padding:5px"><strong>Director:</strong><br />'.$content_item->director.'</div>
				<div style="width:100%; padding:5px"><strong>Actors:</strong><br />'.$content_item->actors.'</div>
				<div style="width:100%; padding:5px"><strong>Producer:</strong><br />'.$content_item->producer.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				<div style="width:100%; padding:5px"><strong>Runtime:</strong><br />'.$content_item->runtime.'</div>
				';
				$writer = $content_item->writer;
				
				break;
				
			case(CONTENTTYPE_MUSIC):
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Company:</strong><br />'.$content_item->company.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				<div style="width:100%; padding:5px"><strong>Length:</strong><br />'.$content_item->length.'</div>
				<div style="width:100%; padding:5px"><strong>UPC Code:</strong><br />'.$content_item->upc_code.'</div>
				<div style="width:100%; padding:5px"><strong>ISCR:</strong><br />'.$content_item->iscr.'</div>
				';
				break;
				
			case(CONTENTTYPE_SHOW):			
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Company:</strong><br />'.$content_item->company.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Rating:</strong><br />'.$content_item->rating.'</div>
				<div style="width:100%; padding:5px"><strong>Format:</strong><br />'.$content_item->format.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				';
				
				break;
				
			case(CONTENTTYPE_COMIC):
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Publisher:</strong><br />'.$content_item->publisher.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				<div style="width:100%; padding:5px"><strong>Number Series:</strong><br />'.$content_item->number_series.'</div>
				
				<div style="width:100%; padding:5px"><strong>Artist:</strong><br />'.$content_item->artist.'</div>
				<div style="width:100%; padding:5px"><strong>Inker:</strong><br />'.$content_item->inker.'</div>
				<div style="width:100%; padding:5px"><strong>Page Count:</strong><br />'.$content_item->page_count.'</div>
				';
				$writer = $content_item->writer;
				break;	

			case(CONTENTTYPE_GAME):
				
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Publisher:</strong><br />'.$content_item->publisher.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				<div style="width:100%; padding:5px"><strong>Platforms:</strong><br />'.$content_item->platforms.'</div>
				<div style="width:100%; padding:5px"><strong>File Size:</strong><br />'.$content_item->file_size.'</div>
				<div style="width:100%; padding:5px"><strong>Rating:</strong><br />'.$content_item->rating.'</div>
				<div style="width:100%; padding:5px"><strong>Code:</strong><br />'.$content_item->code.'</div>
				';
				
				break;	

			case(CONTENTTYPE_BOOK):
				echo '
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br /><a class="link_item" href="list.php?type='.$content_item->content_type.'&categoryid='.$content_item->GetCategoryId().'">'.$content_item->GetDisplayNameCategory().'</a></div>
				<div style="width:100%; padding:5px"><strong>Genre:</strong><br />'.$content_item->GetDisplayNameCategory().'</div>
				<div style="width:100%; padding:5px"><strong>Author:</strong><br />'.$content_item->author.'</div>
				<div style="width:100%; padding:5px"><strong>Publisher:</strong><br />'.$content_item->publisher.'</div>
				<div style="width:100%; padding:5px"><strong>Copyright:</strong><br />'.$content_item->copyright.'</div>
				<div style="width:100%; padding:5px"><strong>Release Date:</strong><br />'.($content_item->release_date == DATE_NULL ? "" : converter::convert_date("Y-m-d", "F j, Y", $content_item->release_date)).'</div>
				<div style="width:100%; padding:5px"><strong>Page Count:</strong><br />'.$content_item->page_count.'</div>
				<div style="width:100%; padding:5px"><strong>ISBN:</strong><br />'.$content_item->isbn.'</div>

				';
				break;	
			
		}
	?>
      
      </td>
  </tr>
  <tr>
    <? if($writer) {?>
    <td valign="top"><div align="left" style="padding-left:8px; padding-top:10px;"></div>
      </td>
    <? } ?>
  </tr>
                </table>

                              
			</div>
		</div>
	</div>	
        </div>
    
	<a id="large_view_link" class="link_item" href="javascript:breakdown_large_view();">Full view ></a>
	<a id="small_view_link" class="link_item" href="javascript:breakdown_small_view();" style="display:none">< Small view</a>
    <div style="clear:both"></div>
