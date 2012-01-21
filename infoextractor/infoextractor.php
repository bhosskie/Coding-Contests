<?php

$l = 0; 
$outfile = fopen("output.txt","a");
$footer = "--------------------------------------------------------------------------------------------------------------------------\n";
for($fileno = 1;$fileno<=1000;$fileno++)
{
//Full path of the location of the file. While testing,this should be changed according to the location of the file in the local disk.
$filename = "/".$fileno;
$file = fopen($filename,"r") or exit("Either the file does not exist or an Error occured while attempting to open the file");

echo "FILE ".$fileno.":<br />";
echo"--------------<br />";

$header = "FILE ".$fileno.":\n--------------\n";
fputs($outfile,$header);

$i = 0;
while(!feof($file))
{
	$line[$i] = fgets($file);
	$i++;
}

$k = 0;
while(strpos($line[$k],"\n") != 1)
{
	preg_match_all('/\b([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\b/',$line[$k],$matches);
	$size = sizeof($matches[0]);
	for($i=0;$i<$size;$i++)
	{
		echo "IP : ";
		print_r($matches[0][$i]);
		echo "<br />";
		fputs($outfile,"IP : ".$matches[0][$i]."\n");
	}
	$k++;
}

$end_of_header = $k;
$nlines = sizeof($line);

while($end_of_header<$nlines)
{
	preg_match_all('/\b^(http|https)\:\/\/([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}\b/s',$line[$end_of_header],$matches1);	
	$size1 = sizeof($matches1[0]);
	for($i=0;$i<$size1;$i++)
	{
		$host[$l] = $matches1[0][$i];
		preg_match('/[a-z0-9\-]+\.[^.]+$/s', $host[$l], $matches2);
		$sub = substr($matches2[0],strlen($matches2[0])-3,strlen($matches2[0]));
		
		if(strcmp($sub,"pdf") != 0 && strcmp($sub,"gif") != 0 && strcmp($sub,"jpg") != 0 && strcmp($sub,"png") != 0 && strcmp($sub,"doc") != 0 && strcmp($sub,"peg") != 0 && strcmp($sub,"ocx") != 0 && strcmp($sub,"tml") != 0 && strcmp($sub,"asp") != 0 && strcmp($sub,"spx") != 0 && strcmp($sub,"php") != 0)
		{
		$domain[$l] = $matches2[0];
		$l++;
		}
	}
	$end_of_header++;
}
$domain_size = sizeof($domain);
$unique_domain = array_unique($domain);
$keys = array_keys($unique_domain);
$unique_domain_size = sizeof($unique_domain);

for($j=0;$j < sizeof($keys);$j++)
{
	echo "Domain : ".$unique_domain[$keys[$j]]."<br />";
	fputs($outfile,"Domain : ".$unique_domain[$keys[$j]]."\n");
}

echo "--------------------------------------------------------------------------------------------------------------------------------<br />";
fputs($outfile,$footer);

fclose($file);	
}
fclose($outfile);
?>