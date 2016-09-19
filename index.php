<?php
$directories = glob('ID/*' , GLOB_ONLYDIR);
$imagecount=0;
$folder=[];
$team_temp=[];
$year2=[];
$year3=[];
$year4=[];
$team='';
$data=[];

function create_id($post, $name, $team, $year) {
    
      $filename=$name.'.jpg';

      $jpg_image = imagecreatefromjpeg("photo/$year.jpg");
      $src = imagecreatefromjpeg("ID/$team/$year/$name.jpg");
      if(!$src)
        $src = imagecreatefrompng("ID/$team/$year/$name.png");
      $size = 543;

      $thumb = imagecreatetruecolor($size, $size);

      $w = imagesx($src);
      $h = imagesy($src);

      imagecopyresized($thumb, $src, 0, 0, 0, 0, $size, $size, $w, $h);
      imagecopymerge($jpg_image, $thumb, 165, 339, 0, 0, $size,$size, 100);

      putenv('GDFONTPATH=' . realpath('.'));
      $font_path = 'font.ttf';

      $angle = 45;

      $image_width = imagesx($jpg_image);  
      $image_height = imagesy($jpg_image);

      $text_box1 = imagettfbbox(50,$angle,$font_path,$name);

      $text_width1 = $text_box1[2]-$text_box1[0];
      $text_height1 = $text_box1[7]-$text_box1[1];

      $x1 = ($image_width/2) - ($text_width1/1.5);
      
      $position=$post.",".$team;
      
      $text_box2 = imagettfbbox(40,$angle,$font_path,$position);

      $text_width2 = $text_box2[2]-$text_box2[0];
      $text_height2 = $text_box2[7]-$text_box2[1];

      $x2 = ($image_width/2) - ($text_width2/1.5);

      $white = imagecolorallocate($jpg_image, 255,255,255);
      imagettftext($jpg_image, 50, 0, $x1, 1120, $white, $font_path, $name);
      imagettftext($jpg_image, 40, 0, $x2, 1190, $white, $font_path, $position);

      return $jpg_image;
}

foreach ($directories as $directory) 
		{

			$years=glob($directory.'/*' , GLOB_ONLYDIR);
			//print_r($years);
			
			foreach ($years as $year)
			{
				
					$folder=explode('/', $year);
					$year=$folder[2];			
					$path=$directory.'/'.$year.'/';
					$team_temp=explode("/",$directory);
					
					$team=$team_temp[1];
					$files = scandir($path);
					$files = array_diff(scandir($path), array('.', '..'));
					foreach ($files as $file)
					{
						$names=[];
						$names=explode(".",$file);
						$filename=$names[0];
						$data=[];
						array_push($data, $filename);
						array_push($data, $team);
						if ($year=='2')
						{
							array_push($year2, $data);	
						}
						else
						if ($year=='3')
						{
							array_push($year3, $data);	
						}
						else
						{
							array_push($year4, $data);	
						}

					}
			}

		}

        $id_final_format = imagecreatetruecolor(3496, 4960);
        $white = imagecolorallocate ($id_final_format, 255, 255, 255 );
        imagefilledrectangle($id_final_format, 0, 0, 3496, 4960, $white);
        $width = 874;
        $height = 1240;

        $cnt = 0;
        $no = 1;
        $post = "Coordinator";
        $yr = 2;    
    	foreach ($year2 as $item) {
        if($cnt === 16)
        {
            imagejpeg($id_final_format, $post."_$no.jpg", 100);
            $no++;
            $id_final_format = imagecreatetruecolor(3496, 4960);
            imagefilledrectangle($id_final_format, 0, 0, 3496, 4960, $white);
            $cnt = 0;
        }
        $temp_gd_content = create_id($post, $item[0], $item[1], $yr);

        $i = floor($cnt/4);
        $j = $cnt%4;
        $cur_width = $j*$width;
        $cur_height = $i*$height;

        imagecopymerge($id_final_format, $temp_gd_content, $cur_width, $cur_height, 0, 0, $width, $height, 100);

        $cnt++;
		}

        if($cnt !=0 )
            imagejpeg($id_final_format, $post."_$no.jpg", 100);
?>