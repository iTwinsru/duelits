<?php
function createtoken($login,$pass)
{	
	$hua = (@$_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';
	$ra =(@$_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
	return 	md5($ra.$hua.$login.$pass);
}

function getAccess($calback)
{
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(!isset($_COOKIE['duelistgametoken']) || (@$_COOKIE['duelistgametoken'] && $_COOKIE['duelistgametoken']=="unknown"))
		{
			if(isset($_POST['duelist']) && $_POST['duelist']!="")
			{
				$DI=GetAccessDataDuelist($_POST['duelist'],'login');
				if($_POST['duelist']==$DI['login'])
				{
					if(isset($_POST['pass']) && $_POST['pass']==$DI['pass'])
					{
						$token=createtoken($_POST['duelist'],$_POST['pass']);
						dbupdata("token",$token,"login",$_POST['duelist']);
						setcookie("duelistgametoken", $token,time()+3600);
						$calback(json_decode('{"token":"'.$token.'","login":"'.$_POST['duelist'].'","status":"ok","access":1}'));
					}
					else
					{
						dbupdata("token","","login",$_POST['duelist']);
						setcookie("duelistgametoken", "unknown",time()+3600);
						CPrint('pass_err');	
						$calback(json_decode('{"access":2}'));
					}
				}
				else
				{
					$token=createtoken($_POST['duelist'],$_POST['pass']);
					CreateNewDuelist($token,$_POST['duelist'],@$_POST['pass']?$_POST['pass']:'');
					setcookie("duelistgametoken", $token,time()+3600);
					$calback(json_decode('{"token":"'.$token.'","login":"'.$_POST['duelist'].'","status":"new","access":1}'));
				}
			}
			else
			{
				CPrint('login_err');
				setcookie("duelistgametoken", "unknown",time()+3600);
				$calback(json_decode('{"access":3}'));
			}
		}
		else
		{
			if(isset($_POST['exit']) && $_POST['exit']=='1')
			{
				$login_db=dbgetsell("login","token",$_COOKIE['duelistgametoken']);
				dbupdata("token","","login",$login_db);
				dbupdata("lanstatus","0","login",$login_db);
				dbupdata("status","0","login",$login_db);
				setcookie("duelistgametoken", "",time()-3600);
				setcookie("findfight", "",time()-3600);
				CPrint('login');
				$calback(json_decode('{"access":4}'));
			}
			else
				header("Location: https://itwins.ru:4433/");
		}
	
	}
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		if(!isset($_COOKIE['duelistgametoken']) || (isset($_COOKIE['duelistgametoken']) && ($_COOKIE['duelistgametoken']=="" || $_COOKIE['duelistgametoken']=="unknown")))
		{
			CPrint('login');
			setcookie("duelistgametoken", "unknown",time()+3600);
			$calback(json_decode('{"access":5}'));			
		}
		else
		{
			$token_c=$_COOKIE['duelistgametoken'];
			$login_db=dbgetsell("login","token",$token_c);
			$pass_db=dbgetsell("pass","token",$token_c);
			$token_db=dbgetsell("token","login",$login_db);
			$token_now=createtoken($login_db,$pass_db);
			if($token_c==$token_db && $token_c==$token_now && $token_db==$token_now)
			{
				setcookie("duelistgametoken", $token_c,time()+3600);
				$calback(json_decode('{"token":"'.$token_c.'","login":"'.$login_db.'","status":"ok","access":1}'));
			}
			else
			{
				CPrint('login');
				setcookie("duelistgametoken", "unknown",time()+3600);
				$calback(json_decode('{"access":6}'));	
			}
		}
	}
}
