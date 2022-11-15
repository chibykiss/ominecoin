<?php
session_start();
include 'db_conn.php';

class Delete extends connection{
	private $id;

	public function deleteIt($ID){
		$this->id = $ID;



		$sql = "DELETE FROM l_withdrawal WHERE id = '$this->id';";

		$send = $this->connect()->query($sql);

		

		if($send){
            //echo 'sucess';
            $_SESSION['err'] = 'delsuccess';
			header("Location: ./last_withdraw.php");
			
		}else{
            //echo 'failed';
            $_SESSION['err'] = 'delfailed';
			header("Location: ./last_withdraw.php");
			
		}
	}
}

$theid = $_GET['id'];

$deleteme = new Delete;

$theid = mysqli_real_escape_string($deleteme->connect(), $theid);

$deleteme->deleteIt($theid);
?>