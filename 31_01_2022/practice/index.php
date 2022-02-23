<?php
class practice{

	#Simple Variable
	public $simple_variable;
	public $i=2,$j=5;
	public $val;

	public function myfunction(){
		$this->simple_variable="Helow World";
		# Overwrite
		$this->simple_variable="My World";
		echo $this->simple_variable;
	}

	public function condition(){
		if($this->i < $this->j){
			echo $this->j." is Big";
		}
		else{
			echo $this->i." is Big";
		}

	}

	#with Return Value
	public function return_fun(){
		$this->i = 25;
		$this->j = 30;

		return $this->i;
	}

	#with Parameters
	public function return_parameter($val){
		$this->val = $val;

		return $this->val;
	}	
	
}


# Object
$myobj = new practice();
$myobj->myfunction();
echo "<br><br>";
$myobj->condition();
echo "<br><br>";
echo $myobj->return_fun();
echo "<br><br>";
echo $myobj->return_parameter("Helow");
?>