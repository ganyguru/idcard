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

for($i=0;$i<count($directories);$i++)
	{
//		$folder=explode('/', $directories[$i]);
//		$directories[$i]=$folder[1];
//		echo $directories[$i]."<br>";		
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

		echo "<br><br>Year 2:<br>";
		print_r($year2);


		echo "<br><br>Year 3:<br>";
		print_r($year3);



		echo "<br><br>Year 4:<br>";
		print_r($year4);

		foreach ($year2 as $item) {
			
		
		echo '<script>window.open("card.php?post=Coordinator&year=2&name='.$item[0].'&team='.$item[1].'","_blank")</script>';
		}
?>