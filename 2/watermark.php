<?php
if(	(!isset($_POST['text'])) || (strlen($_POST['text'])<= 0)) echo 'Пожалуйста, введите текст для наложения<br/>';
if( (!isset($_FILES['image'])) || (strlen($_FILES['image']['name']) == 0)) { echo 'Пожалуйста, выберете изображение<br/>'; exit(); }
watermark($_FILES['image'],$_POST['text']);
function watermark($image,$text) {
		if($_FILES['image']['size'] < 1){
		echo 'Ошибка загрузки!<br/>';
		exit(); 
	}else {
		switch($_FILES['image']['type']){
			case 'image/gif':
				$image = imagecreatefromgif($_FILES['image']['tmp_name']);
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				$image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
				break;
			case 'image/png':
				$image = imagecreatefrompng($_FILES['image']['tmp_name']);
			break;
		}
		if(!isset($image)){
			echo 'Неверный формат изображения. Допустимы только .gif, .jpg или .png!';
		}else{
			
			$im = imagecreatetruecolor(400, 30);
			$red = imagecolorallocate($im, 0xFF, 0x00, 0x00);
			$font_path = 'arial.ttf';
			imagettftext($image, 50, 0, 10, 160, $red, $font_path, $text);
			$content = 'content-type: '.$_FILES['image']['type'];
			header($content); 
			imagejpeg($image);
			imagedestroy($image);
		}
	}
	
}
?>