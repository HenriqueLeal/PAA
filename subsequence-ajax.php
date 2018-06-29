<?php
   function recursiveLCS($x, $y, $m, $n){
	   if ($m == 0 || $n == 0) {
		  return 0;
	   }

	   if ($x[$m - 1] == $y[$n - 1]) {
		  return 1 + recursiveLCS($x, $y, $m - 1, $n - 1);
	   }
	   else{
          return max(recursiveLCS($x, $y, $m, $n - 1), recursiveLCS($x, $y, $m - 1, $n));
	   }
   }

	function printLCS($bMatrix, $x, $i, $j)
	{
		if($i == 0 || $j == 0){
		   return;	
		} 

		if($bMatrix[$i][$j] == "\\"){
			printLCS($bMatrix, $x, $i-1, $j-1);
			echo $x[$i];
		}

		elseif($bMatrix[$i][$j] == "|") printLCS($bMatrix, $x, $i-1, $j);
		else printLCS($bMatrix, $x, $i, $j-1);
	}


	function subsequence($x, $y)
	{
		$m = count($x);
		$n = count($y);

		$lMatrix = array();
		$bMatrix = array();

		// incializo o array C
		//for($i=0; $i<=$m; $i++) $lMatrix[$i][0] = 0;
		//for($j=0; $j<=$n; $j++) $lMatrix[0][$j] = 0;

		for ($i=0; $i < $m + 1; $i++) { 
			for ($j=0; $j < $n + 1; $j++) { 
				$lMatrix[$i][$j] = 0;
			}
		}
		for ($i=0; $i < $m + 1; $i++) { 
			for ($j=0; $j < $n + 1; $j++) { 
				$bMatrix[$i][$j] = 0;
			}
		}

		for($i=1; $i < $m + 1; $i++)
		{
			for($j=1; $j < $n + 1; $j++)
			{
				if($x[$i - 1] == $y[$j - 1]){
					$lMatrix[$i][$j] = $lMatrix[$i-1][$j-1] + 1;
					$bMatrix[$i][$j] = "\\";
				}
				/*
				elseif ($lMatrix[$i - 1][$j] >= $lMatrix[$i][$j - 1]) {
					$lMatrix[$i][$j] = $lMatrix[$i - 1][$j];
					$bMatrix[$i][$j] = "|";
				}
				else{
					$lMatrix[$i][$j] = $lMatrix[$i][$j - 1];
					$bMatrix[$i][$j] = "_";
				}*/


				else{
				  $lMatrix[$i][$j] = max($lMatrix[$i][$j - 1], $lMatrix[$i-1][$j]);
				   if ($lMatrix[$i][$j - 1] > $lMatrix[$i - 1][$j]) {
				       $bMatrix[$i][$j] = "_";
				   }
				   else{
				   	   $bMatrix[$i][$j] = "|";
				   }
				}
				
			}
		}

		$result = array();
		array_push($result, $lMatrix);
		array_push($result, $bMatrix);

		echo "<table class='table table-hover'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>&nbsp;</th>";
		echo "<th>y[j]</th>";
		for($i=0; $i<count($y); $i++){
			echo "<th>";
			echo $y[$i];
			echo "</th>";
		}
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		for($f=0; $f<=count($x); $f++){

			echo "<tr>";
			if($f == 0) echo "<th>x[i]</th>";
			else{
				echo "<th>";
				echo $x[$f - 1];
				echo "</th>";
			}
			for($j=0; $j<count($bMatrix[$i]); $j++)
			{
				echo "<th>";
				echo $lMatrix[$f][$j]." ".$bMatrix[$f][$j];
				echo "</th>";
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table><hr>";

		return $result;
	}
    
    
    $x = str_split($_POST['x']);
    $y = str_split($_POST['y']);
    //$x = str_split('ABCBDAB');
    //$y = str_split('BDCABA');

	$result = subsequence($x, $y);

	echo "A maior sequência comum encontrada é: <b> "; 
	$result = recursiveLCS($x, $y, count($x), count($y));
	echo $result . " </b> " ;
	//printLCS($result[1], $x, count($x), count($y)); echo "</b>";
?>