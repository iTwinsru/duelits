<?php
//----
$DEBUG_LOG=1;	
$DEBUG="";
//-------------------------------------------------------------------------------------------
$TimeStartDuels=30; // таймер до начало дуэли
//-------------------------------------------------------------------------------------------
include "db.php";
include "content.php";
include "access.php";
include "engine.php";
function DLog($txt)
{
	global $DEBUG;
	$DEBUG.=' > '.$txt."<br>";
}
function out_debug()
{
	if($GLOBALS['DEBUG_LOG']==1)
	{
		GLOBAL $pages_load_time_start;
		$pg=round(((microtime(true) - $pages_load_time_start) * 100),2);
		echo '<div class="DEBUG dialog whDBG">Page load time: '.$pg." ms<br>".$GLOBALS['DEBUG'].'</div>'; 
	}
}

function ClearAllData()
{
	echo 'Data<br>';
	if(isset($_SERVER['HTTP_COOKIE']))echo $_SERVER['HTTP_COOKIE'];
	setcookie("duelistgametoken","",time()-3600);
	setcookie("duelistgametoken","",time()-3600,"","itwins.ru",1);
	setcookie("findfight","",time()-3600,"","itwins.ru",1);
	setcookie("findfight","",time()-3600);
	setcookie("opponent","",time()-3600);
	setcookie("lasfightlogid","",time()-3600);
	setcookie("lastfightlogid","",time()-3600);
	setcookie("step","",time()-3600);
	setcookie("fight","",time()-3600);
	setcookie("duelistgametoken","",time()-3600,"","itwins.ru",1);
	setcookie("gametoken","",time()-3600);
	setcookie("PHPSESSID","",time()-3600);
	setcookie("io","",time()-3600);
	reqdbsql("delete from duelist where id>1;",'',false);
	echo '<br>Clear!';
	exit;
}
//----
?>