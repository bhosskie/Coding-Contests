<?php

$lines = file($argv[1], FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$time1 = microtime(true);
foreach ($lines as $l) {
    print_spiral($l);
}
$time2 = microtime(true);

$time_diff = $time2 - $time1;

echo "Elapsed time: ".$time_diff."\n";

function print_spiral($test_line)
{
	$my_array[][] = array();
	$test_params = explode(";",$test_line);
	$n = $test_params[0];
	$m = $test_params[1];
	
	$test_array = explode(" ",$test_params[2]);

	$k = 0;


for($i=0;$i<$n;$i++)
{
	
	for($j=0;$j<$m;$j++)
	{
		$my_array[$i][$j] = $test_array[$k++];
	}
}


top_right($my_array,0,0,($m-1),($n-1));
echo "\n";
}

function top_right(&$arr,$x1,$y1,$x2,$y2)
{
	for($i=$x1;$i<=$x2;$i++)
	{
		echo $arr[$y1][$i]." ";
	}
	
	for($j=$y1+1;$j<=$y2;$j++)
	{
		echo $arr[$j][$x2]." ";
	}
	
	if(($x2-$x1) > 0 && ($y2-$y1) > 0)
	{
		bottom_left($arr,$x1,$y1+1,$x2-1,$y2);
	}
}

function bottom_left(&$arr,$x1,$y1,$x2,$y2)
{
	for($i=$x2;$i>=$x1;$i--)
	{
		echo $arr[$y2][$i]." ";
	}
	
	for($j=$y2-1;$j>=$y1;$j--)
	{
		echo $arr[$j][$x1]." ";
	}
	
	if(($x2-$x1) > 0 && ($y2-$y1) > 0)
	{
		top_right($arr,$x1+1,$y1,$x2,$y2-1);
	}
	
}
?>