<?php
	$db_load_time_start =0;
	$db_load_time_end =0; 
	$dbServer = "localhost"; 
    $dbname = "mysql"; 
    $dbuser = "root";
    $dbpass = ""; 
	function conndb()
	{
		$GLOBALS['db_load_time_start']=microtime(true);
		global $dbServer,$dbname,$dbuser,$dbpass;
		$db = @mysql_connect($dbServer, $dbuser, $dbpass);
		if(!$db)return -1;
		if(!@mysql_select_db($dbname,$db))return -2;
		return $db;
	}
	function reqdbsql($sql,$opt='',$rtn=true)
	{
		if(!($db=conndb()))return -1;
        if(!($res=mysql_query($sql)))return 0;
		mysql_close($db);
		$GLOBALS['db_load_time_end']=microtime(true);
		DLog("DB reqdbsql: ".$sql.' : time req => '.round((($GLOBALS['db_load_time_end']-$GLOBALS['db_load_time_start'])*100),2).' ms');
		if($rtn)
		{
			$out =array();
			if(mysql_num_rows($res)>1) 
				while ($row = mysql_fetch_assoc($res))
					array_push($out,$opt!=""?$row[$opt]:$row);
			else
				$out=mysql_fetch_assoc($res);
			return $out;
		}
	}
	function dbgetsell($id,$key,$val)
	{
		if(!($db=conndb()))return 0;
		if(!($res = mysql_query('SELECT * FROM duelist WHERE '.$key.' ="'.$val.'"')))return 0;
		mysql_close($db);
		$GLOBALS['db_load_time_end']=microtime(true);
		DLog("DB getsell: ".'SELECT '.$id.' FROM duelist WHERE '.$key.'="'.$val.'" : time req => '.round((($GLOBALS['db_load_time_end']-$GLOBALS['db_load_time_start'])*100),2).' ms');
		return mysql_fetch_array($res)[$id];
	}
	function dbinsert($key,$val)
	{
		if(!($db=conndb()))return 0;
		if(!($res = mysql_query("INSERT INTO duelist (".$key.") VALUES (".$val.")")))return 0;
		mysql_close($db);
		$GLOBALS['db_load_time_end']=microtime(true);
		DLog("DB insert: "."INSERT INTO duelist ('".$key."') VALUES ('".$val."') : time req => ".round((($GLOBALS['db_load_time_end']-$GLOBALS['db_load_time_start'])*100),2)." ms");
		return 1;
	}
	function dbupdata($key,$val,$id,$idval)
	{
		if(!($db=conndb()))return 0;
		if(!($res = mysql_query("UPDATE duelist SET ".$key."='".$val."' WHERE ".$id."='".$idval."'"))) return 0;
		mysql_close($db);
		$GLOBALS['db_load_time_end']=microtime(true);
		DLog("DB updata: "."UPDATE duelist SET ".$key."='".$val."' WHERE ".$id."='".$idval."' : time req => ".round((($GLOBALS['db_load_time_end']-$GLOBALS['db_load_time_start'])*100),2)." ms");
		return 1;
	}
	function dbdelete($id)
	{
		if(!($db=conndb()))return 0;
		if(!($res = mysql_query("DELETE FROM duelist WHERE token=".$id))) return 0;
		mysql_close($db);
		$GLOBALS['db_load_time_end']=microtime(true);
		DLog("DB delete: "."DELETE FROM duelist WHERE token=".$id."' : time req => ".round((($GLOBALS['db_load_time_end']-$GLOBALS['db_load_time_start'])*100),2)." ms");
		return 1;
	}
?>
