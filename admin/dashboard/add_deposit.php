<?php

// echo 'its showing here';
session_start();
//echo $_POST['btitle'].'<br>'.$_POST['bpostby'].'<br>'.$_POST['pstat'].'<br>'.$_POST['editor1'];
//print_r($_FILES['bpic']);
include 'db_conn.php';

class createPost extends connection{
	private $bt;
	private $ba;
	

	public function addPost($BT,$BA){
			$this->bt = $BT;
			$this->ba = $BA;
		
			//echo $this->bt.$this->bl.$this->bct.$this->bc.$this->bpic.$this->bd.$this->btime;

			$sql = "INSERT INTO l_deposit(name,amount) VALUES('$this->bt','$this->ba');";
			$send = $this->connect()->query($sql);

			if($send){
				// echo 'sucess';
				$_SESSION['err'] = 'success';
				header('Location: ./create_deposit.php');
			}else{
				$_SESSION['err'] = 'failed';
				header('Location: ./create_deposit.php');
			}
	}
}


if(isset($_POST['submit'])){
// 	echo $_POST['btitle'].'<br>'.$_POST['bpostby'].'<br>'.$_POST['pstat'].'<br>'.$_POST['editor1'];
// print_r($_FILES['bpic']);

	$name = $_POST['bname'];
	$amount = $_POST['bamount'];

	
	if(empty($name) || empty($amount)){
		$_SESSION['err'] = 'empty';
		header('Location: ./create_deposit.php');
	}
	else{

                

                    $add_new = new createPost;

                    $name = mysqli_real_escape_string($add_new->connect(), $name);
                    $amount = mysqli_real_escape_string($add_new->connect(), $amount);

					$add_new->addPost($name,$amount);

	}

}

?>