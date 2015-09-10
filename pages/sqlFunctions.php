<?php

/*
* returnValues Function will return all the value for the select query you declared
* and redirect it to a page you want to for example you want to know if the user is already registerd
* just call the function and it will return all the values on the database
* If the database has no records it will redirect it to and error page.
*
*
*
* returns fields and values on success and false on falure
*
*/
function returnValues($sql_result)
{
	$x = 0;
	$controlNumber = 0;
	global $field;
	global $return;

	if(mysql_num_rows($sql_result) > 0)
{
	$return = true;
	while($fieldName = mysql_fetch_field($sql_result))
	{
		$name[$x] = $fieldName->name;
		$x++;
		$controlNumber++;
	}
	$x = 0;
	while($row = mysql_fetch_assoc($sql_result))
	{
		while ($controlNumber > 0)
		{
			$field[$name[$x]] = $row[$name[$x]];
			//echo $name[$x].": ".$field[$name[$x]]."<br> ";
			$x++;
			$controlNumber--;
		}
		
	}
}
	else
	{
		$return = false;
	}
}



/*
*
*
* insert Function
* returns true on success and ERROR on falure
*/


function insertData($tableName, $fields, $values)
{
	global $insertData;
	$sql_query = "INSERT INTO $tableName ($fields) VALUES ($values)";

	if(mysql_query($sql_query))
	{
		$insertData = true;
	}
	else
	{
		echo "ERROR ". mysql_error();
	}

}

/*
*
*
* delete function
* returns true on success or false on falure
*/

function deleteData($tableName,$args)
{
	global $deleteData;
	$sql = "DELETE FROM $tableName WHERE $args";
	if(mysql_query($sql))
	{
		$deleteData = true;
	}
	else
	{
		$deleteData = false;
	}
}


/*
*
* update function
* returns true on success or false on falure
*/

function updateData($tableName, $args, $control)
{
	global $updateData;
	$sql = "UPDATE $tableName SET $args WHERE $control";
	if(mysql_query($sql))
	{
		$updateData = true;
	}
	else
	{
		$updateData = false;
	}
}


/*
*
* filter function
*
*/

function sanitizeString($str)
{
	global $filteredStr;
	$filteredStr = filter_var($str, FILTER_SANITIZE_STRING);
	return $filteredStr;
}

function validateName($name)
{
	global $validateName;
	if(!preg_match("/^[a-zA-Z ]*$/", $name))
	{
		return $validateName = false;
	}
	else
	{
		return $validateName = true;
	}
}