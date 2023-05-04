<?php 

class Model_Core_Adapter 
{
	
	public $server = 'localhost';
	public $user = 'root';
	public $password = '';
	public $database = 'project-george-solanki';

	public function connection()
	{
		$connection = mysqli_connect($this->server,$this->user,$this->password,$this->database);
		return $connection;
	}

	public function query($query)
	{
		$this->connect = $this->connection();
		return $connect->query($query);
	} 

	public function fetchAll($query)
	{
		$conn = $this->connection();
		$result = $conn->query($query);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		return $rows;
	}

	public function fetchOne($query)
	{
		$conn = $this->connection();
        $result = $conn->query($query);
	    $row = $result->fetch_assoc();
		return $row;
	}

	public function insert($query)
	{
		$conn = $this->connection();
		$result = $conn->query($query);
		if($result)
		{
			return $conn->insert_id;
		}

		return false;
	} 

	public function Update($query)
	{
		$conn = $this->connection();
		$result = $conn->query($query);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($query)
	{
		$conn = $this->connection();
		$result = $conn->query($query);

		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

?>