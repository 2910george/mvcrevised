<?php 

class Model_Core_Table
{
	protected $tableName = null;
	protected $primaryKey = null;
	protected $adapter = null;

	function __construct()
	{
		
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setAdpter($adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter)
		{
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdpter($adapter);
		return $adapter;
	}

	public function fetchAll($query)
	{
		$result = $this->getAdapter()->fetchAll($query);
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	public function fetchOne($query)
	{
		if($query)
		{
			$result = $this->getAdapter()->fetchOne($query);
			return $result;
		}

		return false;
	}

	public function insert($data)
	{
		$keys = array_keys($data);
		$values = array_values($data);

		$keyString = '`'.implode('`,`', $keys).'`';
		$valueString = "'".implode("','",$values)."'";

		echo $sql = "INSERT INTO `{$this->getTableName()}` ({$keyString}) VALUES ({$valueString})";
		return $this->getAdapter()->insert($sql);

	}

	public function update($data,$condition)
	{
		foreach ($data as $key => $value) 
		{
			$keys[] = "`$key`='$value'";
		}
		$keyValueString = implode(',',$keys);

		foreach($condition as $key => $value)
		{
			$conditionArray[] = "`$key` = '$value'";
		}
		$primaryKeyString = implode('AND',$conditionArray);
		echo $sql = "UPDATE `{$this->getTableName()}` SET {$keyValueString} WHERE {$primaryKeyString}";
		return $this->getAdapter()->update($sql);
	}

	public function delete($condition)
	{
		foreach($condition as $key => $value)
		{
			$conditionArray[] = "`$key` = $value";
		}
		$keyString = implode('AND',$conditionArray);
		$query = "DELETE FROM `{$this->getTableName()}` WHERE {$keyString}";
		return $this->getAdapter()->delete($query);
	}

	public function load($value,$column=null)
	{
		$column = (!$column) ? $this->getPrimaryKey() : $column;
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE '{$column}' = {$value}";
		$row = $this->getAdapter()->fetchOne($query);
		return $row;
	}

}


?>