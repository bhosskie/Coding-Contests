<?php 

/* opening the file in read mode. The file path should be changed appropriately while testing the code. */
$file = fopen("translog.txt","r") or exit("Either the file does not exist or an Error occured while attempting to open the file");
$i = 0;

while(!feof($file)) {
$line = fgets($file); 		// read one line at a time
$name = substr($line,0,strpos($line,"|"));
$customer[$name][sizeof($customer[$name])] =  $line; // Storing each transaction line in an assocative 2-D array which has the customer's name as the key.
}

foreach($customer as $x){
	$revenue = 0;
	foreach($x as $y) {
		$parts = explode("|",$y);		//extract the parts of the line, each part seperated by the delimiter "|"
		$revenue = $revenue + $parts[3];
		$rev[$parts[0]][$parts[1]] = $rev[$parts[0]][$parts[1]] + $parts[3]; // to calculate the amount spent on each category by each customer
	}
	echo "Revenue from ".$parts[0]." => $".($revenue)." Sales Tax => $".round(($revenue * 9.25 /100),2)."\n";
	echo "Purchases by ".$parts[0]."\n";
	
	foreach($rev[$parts[0]] as $j => $k){
		echo $j." => $".$k." Sales Tax => $".round(($k * 9.25 / 100),2)."\n";			
	}
	echo "\n\n";
}

?>