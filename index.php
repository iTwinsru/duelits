<?php
$pages_load_time_start = microtime(true);
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('mysql.trace_mode', 1);*/

include "php/inc.php";

//ClearAllData();

starthtml();
//---------------------------------------------------------------------------------------------
DLog('REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']);
DLog('HTTP_REFERER: '.(@$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:"undefined"));
DLog('$_POST[login]: '.(@$_POST['duelist']?$_POST['duelist']:"undefined"));
DLog('$_POST[pass]: '.(@$_POST['pass']?$_POST['pass']:"undefined"));


getAccess(function($res)
{
	DLog("getAccess: ".$res->access);
	if($res->access==1)
	{
		$duelistinfo=GetDuelistInfo($res->token);
		$get=@$_GET['duelist']?$_GET['duelist']==''?"0":$_GET['duelist']:"0";
		$step=@$_COOKIE['step']?$_COOKIE['step']:"0";
		if($step>3)$get=$step;

		DLog('Get: '.$get);
		DLog('Step: '.$step);
		
		switch ($get)
		{
			case '0':
				DLog("Step: страница главная...");
				UpDataStatusToNotReady($res->token);
				UpDataStatusOpponentSelect($res->token,"");
				CPrint('main_'.$res->status,$res->login);
			break;
			case '1':
				DLog("Step: страница дуэлий...");
				CPrint('duelists',$duelistinfo);
			break;
			case '2':
				DLog("Step: страница поиска дуэлянта...");
				Head('<meta http-equiv="Refresh" content="0;URL=/?duelist=3" />');
				UpDataStatusToReady($res->token);
				CPrint('findfight',$duelistinfo);
			break;
			case '3':
				DelLog($res->token);
				$duelist2info=FindingDuelist($res->token);
				if($duelist2info!='')
				{	
					CPrint('duelfound',array($duelistinfo,GetDuelistInfo($duelist2info)));
					DLog("Step: страница таймера ожидания дуэли...");
					setcookie("step", "4",time()+3600);
					Head('<meta http-equiv="Refresh" content="'.($GLOBALS['TimeStartDuels']-1).'" />');
				}
				else
				{
					UpDataStatusToNotReady($res->token);
				    UpDataStatusOpponentSelect($res->token,"");
					setcookie("step", "",time()-3600);
					CPrint('notfoundfight',$duelistinfo);
				}
			break;
			case '4':
				$log=FightLog($res->token);
				$dl2=GetDuelist2Info($res->token);
				if($dl2=='') $dl2=GetDuelistInfo($log[4],'login');
				CPrint('fight',array($duelistinfo,$dl2,$log[0],$log[1],$log[2],$log[3],$log[4],$log[5],$log[6]));
				UpDataStatusToNotReady($res->token);
				UpDataStatusOpponentSelect($res->token,"");	
				setcookie("step", "5",time()+3600);
			break;
			case '5':
				setcookie("step", "",time()-3600);
				EndFight($res->token,$duelistinfo);			
				Head('<meta http-equiv="Refresh" content="0;URL=/" />');
			break;
		}
		
		DLog("Login: ".$res->login);
		DLog("Token: ".$res->token);
		DLog("Status: ".$res->status);
	}
	
});
//---------------------------------------------------------------------------------------------
endhtml();
?>