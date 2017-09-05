<style>
<? if($cp->background_color!=''){ ?>
	 .bodyContent{ 
		 background-color: <?=$cp->background_color?> !important;
	 }
<? } ?> 
<? if($cp->background_content_color!=''){ ?>
	 .contentCenter{ 
		 background-color: <?=$cp->background_content_color?> !important;
		 background-image: none !important;
	 }
<? } ?>
<? if($cp->font_color!=''){ ?> 
	 .contentFooterLeft a{									
		 color: <?=$cp->font_color?> !important;
	 }
	 .textoBotonSuperiorRight a{									
		 color: <?=$cp->font_color?> !important;
	 }
	 .startoff{									
		 color: <?=$cp->font_color?> !important;
	 }
<? } ?>
</style>
