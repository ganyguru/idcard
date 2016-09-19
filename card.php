<?php
      

$post=$_GET['post'];
$name=$_GET['name'];
$team=$_GET['team'];
$year=$_GET['year'];
$filename=$name.'.jpg';

      
      
      $jpg_image = imagecreatefromjpeg('photo/'.$year.'.jpg');
      $src = imagecreatefromjpeg('ID/'.$team.'/'.$year.'/'.$name.'.jpg');
      $size = 543;

      

      $thumb = imagecreatetruecolor($size, $size);



      imagecopyresized($thumb, $src, 0, 0, 0, 0, $size, $size, 600, 600);
      
      

      imagecopymerge($jpg_image, $thumb, 165, 339, 0, 0, $size,$size, 100);

      putenv('GDFONTPATH=' . realpath('.'));
      $font_path = 'font.ttf';

      $angle = 45;





$image_width = imagesx($jpg_image);  
$image_height = imagesy($jpg_image);

// Get Bounding Box Size
$text_box1 = imagettfbbox(50,$angle,$font_path,$name);

// Get your Text Width and Height
$text_width1 = $text_box1[2]-$text_box1[0];
$text_height1 = $text_box1[7]-$text_box1[1];

// Calculate coordinates of the text
$x1 = ($image_width/2) - ($text_width1/1.5);

      
$position=$post.",".$team;
      

$text_box2 = imagettfbbox(40,$angle,$font_path,$position);

// Get your Text Width and Height
$text_width2 = $text_box2[2]-$text_box2[0];
$text_height2 = $text_box2[7]-$text_box2[1];

// Calculate coordinates of the text
$x2 = ($image_width/2) - ($text_width2/1.5);



      $white = imagecolorallocate($jpg_image, 255,255,255);
      imagettftext($jpg_image, 50, 0, $x1, 1120, $white, $font_path, $name);
      imagettftext($jpg_image, 40, 0, $x2, 1190, $white, $font_path, $position);
      
header('Content-type: image/jpeg');
      
      imagejpeg($jpg_image);

      
      imagedestroy($jpg_image);
      //imagedestroy($src);