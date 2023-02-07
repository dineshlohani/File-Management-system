<?php
// if it's going to need the database, then it's
// probably smart to require it before we start
require_once('database.php');
require_once('database_object.php');
class Budget_topic
{
	protected static $table_name = "budget_topic";
	protected static $db_fields = array('id','budget_name');
	public $id;
	public $budget_name;
	// Common database method
	public static function find_all()
	{
		global $database;
		return self::find_by_sql("select * from ".self::$table_name);
		 	
	}
	public function getName($string_id="")
            {
                     $plan_type = self::find_by_id($string_id);
                     return $name_plan_type = $plan_type->budget_name;   
            }
	public static function setEmptyobjects()
        {
            $self = new self;
            return $self;
        }
	public static function find_by_id($id=0)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where id={$id} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
	public static function find_parent_topic()
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where parent_id=0");
		return $result_array;
	}
		public static function find_by_parent_id($id=0)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where parent_id={$id}");
		return $result_array;
	}
	public static function find_current_id()
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where is_current=1 limit 1");
		if(!empty($result_array))
		{
			$id = $result_array[0]->id;
		}
		else
		{
			$id = false;
		}
		return $id;

	}
	public function updateIsCurrent()
	{
		$fiscals = Self::find_all();
		foreach($fiscals as $fiscal)
		{
			$fiscal->is_current = 0;
			$fiscal->save();
		}
	}
	public  function savePostData($post, $clause)
	{
		foreach(self::$db_fields as $db_field)
		{
			if($clause=="create" && $db_field=="id")
			{
				continue;
			}
			if(property_exists($this, $db_field))
			{
				$this->$db_field= $post[$db_field];
			}
		}

		return $this->save();
	}
	public static function find_by_sql($sql="")
	{
		global $database;
		$result_set=$database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set))
		{
			$object_array[]= self::instantiate($row);
		}
		return $object_array;
	}
	public static function count_all()
	{
		global $database;
		$sql = "select count(*) from ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	public static function count_by_detail_id($id)
	{
		global $database;
		$sql = "select count(*) from ".self::$table_name." where detail_id=".$id;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	
	public static function find_max_reg()
	{
		global $database;
		$sql = "select max(reg_no) from ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	public static function find_max_letter_no()
	{
		global $database;
		$sql = "select max(letter_no) from ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	private static function instantiate($record)
	{
		 // could check that $record exists and is an array
		 // simple, long form approach
		 $object= new self;
		/* $object->id			= $record['id'];
		 $object->username		= $record['username'];
		 $object->password 		= $record['password'];
		 $object->first_name 	= $record['first_name'];
		 $object->last_name 	= $record['last_name'];*/
		 
		 
		 // more dynamic, short-form approach:
		foreach($record as $attribute=>$value)
		{
			if ($object->has_attribute($attribute))
			{
				$object->$attribute=$value;
			}
		}
		return $object;
	}
	
	private function has_attribute($attribute)
	{
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!) as the keys and their current values as the value
		$object_vars = get_object_vars($this);
		// we don't care about the value, we just want to know if the key exists
		// will return true or false
		return array_key_exists($attribute, $object_vars);
	}
	protected function attributes()
	{
		// return an array of attribute keys and their values
		$attributes = array();
		foreach(self::$db_fields as $field)
		{
			if(property_exists($this, $field))
			{
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	protected function sanitized_attributes()
	{
		global $database;
		$clean_attributes = array();
		// sanitize the values before submitting
		// note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value)
		{
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	public function save()
	{
		// a new record won't have an id yet
		return isset($this->id) ? $this->update() : $this->create();
	}
	public function create()
	{
		global $database;
		// dont forget sql syntax and good habits
		// insert into table ('key', 'key') values ('value', 'value')
		// single quotes around all values
		// escape all values to prevent sql injection
		$attributes = $this->sanitized_attributes();
		$sql = "insert into ". self::$table_name ."(";
		$sql .= join(",", array_keys($attributes));
		$sql .=") values ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if ($database->query($sql))
		{
			$this->id = $database->insert_id();
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function update()
	{
		global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value)
		{
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "update ".self::$table_name." set ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= "where id=".$database->escape_value($this->id);
		$database->query($sql);
		return ($database->affected_rows() ==1)? true : false;
	}
	
	public function delete()
	{
		global $database;
		// delete from table where condition limit 1
		$sql = "delete from " .self::$table_name ;
		$sql .= " where id=".$database->escape_value($this->id);
		$sql .= " limit 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}	
}
?>