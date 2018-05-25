<?php
class TaskAssignment{
	private $minAssign; 
	private $minCost;

	public function start($matrix)
	{
		$this->minCost = PHP_INT_MAX;
		for($i=0; $i<count($matrix); $i++){
			$this->minAssign[$i] = PHP_INT_MAX;
		}
		$assoc = array();
		$this->branchAndBound($matrix, $assoc, 0);

		return $this->minAssign;
	}

	// UTILIZAÇÃO DO BRANCH AND BOUND
	public function branchAndBound($matrix, $assoc, $relCost)
	{
		if( (count($this->minAssign) == count($assoc)) && ($relCost < $this->minCost))
		{
			for($b=0; $b<count($this->minAssign); $b++){
				$this->minAssign[$b] = $assoc[$b];
			}
			$this->minCost = $relCost;
		}
		else{
			for($c = 0; $c < count($matrix); $c++)
			{
				if( ($this->verify($assoc, $c)) && ($relCost + $matrix[count($assoc)][$c] < $this->minCost))
				{
					$index = count($assoc);
					array_push($assoc, $c);
					$this->branchAndBound($matrix, $assoc, ($relCost+$matrix[$index][$c]));
					unset($assoc[$index]);
					$assoc = array_values($assoc);
				}
			}
		}
	}

	public function verify($assoc, $col)
	{
		foreach($assoc as $a)
		{
			if($a == $col) return false;
		}
		return true;
	}

	public function getBestSolution(){
		return $this->minCost;
	}

	public function getBestState()
	{
		return $this->minAssign;
	}
}

echo "<br><br>";
$costs = $_POST['works'];

$obj = new TaskAssignment;
$obj->start($costs);

echo "Solução:<br>";
foreach($obj->getBestState() as $key => $item):
	echo "Funcionário ".($key + 1)." fará a <b>Tarefa ".($item + 1)."</b><br>";
endforeach;
echo "O custo total será de: <b>".$obj->getBestSolution()."</b>";
?>
