<?php
//genData generates a data structure with 10000 random values from 0-10000 and returns it
function genData() {
	$data = [];
	for ($i = 0; $i < 10000; $i++) {
		$data[] = rand(0, 10000);
	}
	return $data;
}

//findCommon finds the values shared between two, passed in data structures and returns it.
//-!-Passed in data structures must be sorted-!-
function findCommon($set1, $set2) {
	$i1 = 0;
	$i2 = 0;
	$data = [];
	while($i1 < count($set1) && $i2 < count($set1))
	{
		if ($set1[$i1] < $set2[$i2]) {
			$i1++;
		}
		else if ($set1[$i1] > $set2[$i2]){
			$i2++;
		}
		else {
			if ($i1 > 0 && $set1[$i1] != $set1[$i1 - 1]) {
				$data[] = $set1[$i1];
			}
			$i1++;
			$i2++;
		}
	}
	return $data;
}

//Set rand seed
srand(mktime());

//Generate data
$timeStart = microtime(true); 
$dataSet1 = genData();
$dataSet2 = genData();
$timeEnd = microtime(true); 
$timeEx = $timeEnd - $timeStart;
echo "Time taken to generate data: $timeEx   <br />\n";

//Find common values between data
$timeStart = microtime(true); 
sort($dataSet1);
sort($dataSet2);
$commonData = findCommon($dataSet1, $dataSet2);
$timeEnd = microtime(true); 
$timeEx = $timeEnd - $timeStart;
echo "Time taken to find comman values between data: $timeEx   <br />\n";
?>