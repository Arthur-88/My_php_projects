<?php
namespace Models;
class User extends Model
{
    protected static $table = 'users.csv';
	
	public static function authById($id,$pass)
	{
		$file = fopen('Tables/'.static::$table, 'r');
		$rowCounter = 0;
		while ($row = fgetcsv($file, null, ';'))
		{
			$rowCounter++;
			if ($rowCounter <= 1) continue;
			if (($row[0] == $id)&&($row[3] == $pass))
			{
				return $row;
			}
		}
		return false;
		fclose($file);
	}
	
	public static function registerUser($name,$role,$pass)
	{
		$file = fopen('Tables/'.static::$table, 'a+');
		$rowCounter = 1;
		while ($row = fgetcsv($file, null, ';'))
			$rowCounter++;
		$newUser[] = $rowCounter;
		$newUser[] = $name;
		$newUser[] = $role;
		$newUser[] = $pass;
		$write = fwrite($file,"\n");
		$write = fputcsv($file,$newUser,';');
		if($write) return $rowCounter;
		else return false;
		fclose($file);
	}
}