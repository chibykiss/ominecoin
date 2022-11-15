<?php
include 'db_conn.php';

class viewNews extends connection{
	private $pg;
	private $limit;
	private $start;
	private $decide;
	public function see_News($PG){
		$this->limit = 10;
		$this->pg = $PG;
		$this->start = ($this->pg-1)*$this->limit;
		
		$sql = "SELECT * FROM  l_withdrawal LIMIT $this->start,$this->limit;";
		$send = $this->connect()->query($sql);
		$i = 0;
		$this->decide = mysqli_num_rows($send);
		// echo $this->decide;
		if ($this->decide > 0){
			while($result = $send->fetch_assoc()){
				$id = $result['id'];
				$name = $result['name'];
				$amount = $result['amount'];
				//$by = $result['poster'];
				$i++;
				echo '
					    <tr>
                                                <td>'.$i.'</td>
                                                <td>'.$name.'</td>
                                                <td>'.$amount.'</td>
												<td><a href="delete_withdrawal.php?id='.$id.'" onclick="return checkDelete()">delete</a></td>
                                                
                          </tr>
				';
			}

		}
	}

	public function see_all($PG){
		$this->limit = 10;
		$this->pg = $PG;
		$this->start = ($this->pg-1)*$this->limit;
		
		$sql = "SELECT * FROM  l_deposit LIMIT $this->start,$this->limit;";
		$send = $this->connect()->query($sql);
		$i = 0;
		$this->decide = mysqli_num_rows($send);
		// echo $this->decide;
		if ($this->decide > 0){
			while($result = $send->fetch_assoc()){
				$id = $result['id'];
				$name = $result['name'];
				$amount = $result['amount'];
				//$by = $result['poster'];
				$i++;
				echo '
					    <tr>
                                                <td>'.$i.'</td>
                                                <td>'.$name.'</td>
                                                <td>'.$amount.'</td>
												<td><a href="delete_deposit.php?id='.$id.'" onclick="return checkDelete()">delete</a></td>
                                                
                          </tr>
				';
			}

		}
	}



	public function pagination(){
		$sql3 = "SELECT * FROM blog";
		$send3 = $this->connect()->query($sql3);
		$total = mysqli_num_rows($send3);
		// $result3 = $send3->fetch_all(MYSQLI_ASSOC);
		// $total = $result3[0]['id'];
		// echo $this->decide;
		// if($this->decide > 1){
			$pages = ceil($total/$this->limit);
		$previous = $this->pg-1;
		$next = $this->pg+1;
		$to = $this->start+$this->limit;
		echo '
		<div class="row">
		<div class="col-md-12">
			<p>Showing '.$this->start.' to '.$to.' of '.$total.' Entries</p>
			<nav aria-label="Page navigation examp1">
				<ul class="pagination">
		';
		echo '
		<li class="page-item"><a class="page-link" href="edit_events.php?page='.$previous.'">Previous</a></li>
		';
		for($j=1; $j<=$pages; $j++){
			echo '
		<li class="page-item"><a class="page-link" href="edit_events.php?page='.$j.'">'.$j.'</a></li>
		';
		}
		echo '
		<li class="page-item"><a class="page-link" href="edit_events.php?page='.$next.'">Next</a></li>
		';
		// }else{
			
		// }
		
		
		
    }
}

// $check = new viewNews;
// $check->see_news(1);