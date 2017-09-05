<?php
class content_files_helper
{
	public function getFileExtension($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}
	
	public function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $w, $h, $cratio = false)
	{
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		switch ($source_image_type) {
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
		}
		if ($source_gd_image === false) {
			return false;
		}
		if($cratio){
			$source_aspect_ratio = $source_image_width / $source_image_height;
			$thumbnail_aspect_ratio = $w / $h;
			if ($source_image_width <= $w && $source_image_height <= $h) {
				$thumbnail_image_width = $source_image_width;
				$thumbnail_image_height = $source_image_height;
			} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
				$thumbnail_image_width = (int) ($h * $source_aspect_ratio);
				$thumbnail_image_height = $h;
			} else {
				$thumbnail_image_width = $w;
				$thumbnail_image_height = (int) ($w / $source_aspect_ratio);
			}
		}else{
			$thumbnail_image_width = $w;
			$thumbnail_image_height = $h;
		}
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 100);
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		return true;
	}
	
	public function IsVideo($content_item){
	    $ext = content_files_helper::getFileExtension($content_item->fileid);
		if(strpos(CONTENTTYPE_FILM_ALLOWED_EXTS,$ext)) return true;
		else return false;
	}
	
	public function generatePdfPreview($input_file_path, $output_file_path, $pages){
		$im1 = new imagick();
		$im1->setResolution(225,225);

		for($i=0;$i<=$pages;$i++) $im1->readImage($input_file_path.'['.$i.']');

		$im1->resetIterator();
		$ima = $im1->appendImages(true);
		$ima->setImageFormat('jpg');
		//resize
		//$ima->setImageResolution(20,20);
		$ima->resampleImage(125,125,imagick::FILTER_UNDEFINED,1);
		//$im1->cropThumbnailImage( 800, 800 );
		//$ima->resizeImage(600,750, imagick::FILTER_LANCZOS, 1);
		$ima->setCompressionQuality(95);

		return $ima->writeImages($output_file_path, true);
	}
	
	
	public function getPdfPagesCount($file_path){
		$im = new imagick($file_path);
		return $im->getNumberImages();
	}   
}
?>
