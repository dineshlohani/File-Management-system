<?php
// if it's going to need the database, then it's
// probably smart to require it before we start
require_once('database.php');
require_once('database_object.php');
class User extends DatabaseObject
{
	protected static $table_name = "user";
	protected static $db_fields = array('id','name','phone','status','ward','email','mode', 'username','password');
	
	public $id;
	public $username;
	public $password;
	public $name;
	public $phone;
	public $ward;
	public $email;
	public $status;
    public $mode;
	
	public static function authenticate_for_user($username = "", $password="")
		{
			global $database;
			$username = $database->escape_value($username);
			$password = $database->escape_value(md5($password));
			$sql = 'select * from ' .self::$table_name;
			$sql.= ' where username ="'.$username.'" ';
			$sql.= 'and password ="'.$password.'"';
			$sql.= ' and status=1 limit 1';
			
			$result_array= self::find_by_sql($sql);
			foreach ($result_array as $results)
			{
				return $results;
				
			}
		}
	
		public static function authenticate_for_admin($username = "", $password="")
		{
			global $database;
			$username = $database->escape_value($username);
			$password = $database->escape_value(md5($password));
			$sql = 'select * from ' .self::$table_name;
			$sql.= ' where email ="'.$username.'" ';
			$sql.= 'and password ="'.$password.'" and mode="administrator"';
			$sql.= ' and enable=1 limit 1';
			$result_array= self::find_by_sql($sql);
			foreach ($result_array as $results)
			{
				return $results;
			}
		}
	
	// Common database method
	public static function find_all()
	{
		global $database;
		return self::find_by_sql("select * from user ");
		 	
		
	}
        public static function find_by_ward($ward)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where ward={$ward} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
	
	public static function find_by_id($id=0)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where id={$id} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
	public static function get_by_param($param)
	{
		global $database;
		$result_array=self::find_by_sql('select * from '.self::$table_name. ' where activeparam="'.$param.'" limit 1');
		return !empty($result_array)? array_shift($result_array) : false;
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
	public static function check_email($email)
	{
		global $database;
		$result_array=self::find_by_sql('select * from '.self::$table_name. ' where email="'.$email.'" limit 1');
		return !empty($result_array)? array_shift($result_array) : false;
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