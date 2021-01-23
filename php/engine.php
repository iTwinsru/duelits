<?php
//$memcache = new Memcache;
//$memcache->connect('127.0.0.1', 30183);

function GetDuelistInfo($req,$opt='token')
{
	$stat=reqdbsql("select login,rating,live,damage,status,lanstatus from duelist where ".$opt."='".$req."'");
	//Body(json_encode($stat));
	if(!$stat)
		return array('login'=>'???','rating'=>'???','live'=>'???','damage'=>'???','status'=>'0','lanstatus'=>'0');
	else
		return array("login"=>$stat['login'],"rating"=>$stat['rating'],"live"=>$stat['live'],"damage"=>$stat['damage'],"status"=>$stat['status'],"lanstatus"=>$stat['lanstatus']);
}
function GetAccessDataDuelist($keyval, $key='token'){return reqdbsql("select login,pass,token from duelist where ".$key."='".$keyval."'");}
function CreateNewDuelist($token,$login,$pass){dbinsert("login,pass,damage,live,rating,lanstatus,status,token","'".$login."','".$pass."','10','100','0','1','0','".$token."'");}
function GetDuelist2Info($token)
{
	$res=dbgetsell("opponent",'token',$token);
	if($res!='') return GetDuelistInfo($res);
	return '';
}
function GetStatus($token,$opt='token'){dbgetsell("status",$opt,$token);}
function UpDataStatusToReady($token){dbupdata("status","1","token",$token);}
function UpDataStatusToNotReady($token){dbupdata("status","0","token",$token);}
function UpDataStatusToFight($token){dbupdata("status","2","token",$token);}
function UpDataStatusToFerstSelect($token){dbupdata("status","3","token",$token);}
function UpDataStatusOpponentSelect($token,$token2){dbupdata("opponent",$token2,"token",$token);}
function UpDataLogID($token,$id){dbupdata("logid",$id,"token",$token);}
function DelLog($token)
{
	$logid=dbgetsell("logid",'token',$token);
	DeleteFileLog($logid);	
	UpDataLogID($token,'');
	setcookie("lasfightlogid","",time()-3600);
}
function SaveFightLog($txt,$name)
{
	$fd = fopen($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$name, 'w');
	if(!$fd)return 0;
	fwrite($fd, $txt);
	fclose($fd);
}
function ReadFightLog($name)
{
	$out='';
	$fd = fopen($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$name, 'r');
	if(!$fd) return '';
	while(!feof($fd)){$out.=fread($fd, 100);}
	fclose($fd);
	return $out;
}
function DeleteFileLog($name)
{
	if(file_exists($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$name))
		if(is_readable($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$name))
			unlink($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$name);
}

function FindingDuelist($token)
{
	$step=1;
	$out='';
	do
	{
		$opp=dbgetsell("token","opponent",$token);
		if($opp!='')
		{
			UpDataStatusToFerstSelect($token);
			UpDataStatusOpponentSelect($token,$opp);
			$out=$opp;
			break;
		}
		$arr=reqdbsql('select token from duelist where status="1" and token!="'.$token.'"','token');
		if($arr!='')
		{
			$dcount=count($arr);
			if($dcount==1)
				$gds=$arr['token'];
			else
				$gds=$arr[rand(0,($dcount-1))];

			$opp=dbgetsell("opponent",'token',$gds);
			if($opp=="")
			{
				UpDataStatusToFight($token);
				UpDataStatusOpponentSelect($token,$gds);
				$out=$gds;
				break;
			}
		}
		sleep(0.3);
	}while($step++<6000);
	return $out;
}

function FightLog($token)
{
	$ferstsel=dbgetsell("status",'token',$token);
	$token2=dbgetsell("opponent",'token',$token);
	$di1=GetDuelistInfo($token);
	$di2=GetDuelistInfo($token2);
	$win=0;
	$css='';
	$counter=0;
	$logid=dbgetsell("logid",'token',$token);
	if($ferstsel==3)
	{
		$ph_your=array('Вы ударили ','Вы нанесли удар ','Вы пронзили ');
		$ph_he=array('ударил Вас ','нанес Вам удар ','пронзил Вас ');

		$damage=array($di1['damage'],$di2['damage']);
		$live=array($di1['live'],$di2['live']);
		$ph_who=array($di1['login'].' ',$di2['login'].' ');
		$out='<div class="fightlog">';
		$out2='<div class="fightlog">';
		$whosemove=0;
		$cssmov0='';
		$cssmov1='';
		$udari0=array($di1['live']);
		$udari1=array($di2['live']);
		while(1)
		{	
			if($live[0]>=0 && $live[1]>=0)
			{
				if(rand(0,50)<48)  // Крит
					$dmg=rand(1,$damage[$whosemove]);
				else
					$dmg=rand($damage[$whosemove],($damage[$whosemove]*1.5));	
				$dmg=rand(1,$dmg);
				$rnd=rand(0,2);
				$you=$ph_your[$rnd];
				$he=$ph_he[$rnd];

				$out.="<div class='ph".$whosemove." anim ".($whosemove?"movr".$counter:"movl".$counter)."'><p>".($whosemove==0?'':$ph_who[$whosemove]).($whosemove==0?$you." ".$ph_who[1]:$he)."на ".$dmg." урона".($dmg>$damage[$whosemove]?' (Крит)':'').".</p></div>";
				$cssmov0.=($whosemove?'.movr'.$counter.'{animation-delay: '.$counter.'s; animation-name: fil;}':'.movl'.$counter.'{animation-delay: '.$counter.'s; animation-name: fir;}');
				
				$out2.="<div class='ph".($whosemove?0:1)." anim ".($whosemove?"movr".$counter:"movl".$counter)."'><p>".($whosemove==1?'':$ph_who[$whosemove]).($whosemove==0?$he." ":$you.' '.$ph_who[0])."на ".$dmg." урона".($dmg>$damage[$whosemove]?' (Крит)':'').".</p></div>";
				$cssmov1.=($whosemove?".movr".$counter.'{animation-delay: '.$counter.'s; animation-name: fil;}':".movl".$counter.'{animation-delay: '.$counter.'s; animation-name: fir;}');
				$live[$whosemove?0:1]-=$dmg;
				array_push($udari0,$live[0]);
				array_push($udari1,$live[1]);
				$whosemove=$whosemove?0:1;
				
			}
			else
			{
				if($live[0]==$live[1] || $live[0]<=0&&$live[1]<=0)
				{
					$out.='<div class="ph"><p>Бой окончен!<br>ИТОГО...</p><br>Ничья!</div>';
					$out2.=$out;
					$win=2;
				}
				else
				{
					if($live[0]<=0 && $live[1]>0)$win=1;
					if($live[0]>0 && $live[1]<=0)$win=0;
					$out.='<div class="ph anim movend"><p>Бой окончен!<br>ИТОГО...</p><br>Вы '.($live[0]<=0?'проиграли!<br>Его жизни: '.$live[1]:'победитель. Поздравляю!').'</div>';
					$out2.='<div class="ph anim movend"><p>Бой окончен!<br>ИТОГО...</p><br>Вы '.($live[1]<=0?'проиграли!<br>Его жизни: '.$live[0]:'победитель. Поздравляю!').'</div>';
					$cssmov0.=".movend{animation-delay: ".$counter."s;animation-name: cen;}";
					$cssmov1.=".movend{animation-delay: ".$counter."s;animation-name: cen;}";
				}
				break;
			}
			$counter++;
		}
			
		$out.='</div>';
		$out2.='</div>';
		$css.=$cssmov0;
		$loguniqid=uniqid();
		$loguniqid2=uniqid();
		UpDataLogID($token,$loguniqid);
		UpDataLogID($token2,$loguniqid2);
		SaveFightLog(implode('|', array($win==2?2:$win?0:1,$out2,$win?$cssmov0:$cssmov1,$counter,$di1['login'],implode('#',$udari1),implode('#',$udari0))),$loguniqid2);
		SaveFightLog(implode('|', array($win,$out,$cssmov0,$counter,$di2['login'],implode('#',$udari0),implode('#',$udari1))),$loguniqid);
		while(!is_readable($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$loguniqid2)){}
		while(!is_readable($_SERVER["DOCUMENT_ROOT"].'/fightlog/log'.$loguniqid)){}
	}
	else
	{
		while(1){if($logid=='')$logid=dbgetsell("logid",'token',$token);else break; sleep(1);}
		$opnlog=explode('|',ReadFightLog($logid));
		return array($opnlog[1],$opnlog[0],$opnlog[2],$opnlog[3],$opnlog[4],$opnlog[5],$opnlog[6]);
	}
	return array($out,$win,$css,$counter,$di2['login'],implode('#',$udari0),implode('#',$udari1));
}

function EndFight($token,$d)
{
	$win=explode('|',ReadFightLog(dbgetsell("logid",'token',$token)));
	if($win[0]==0) reqdbsql('UPDATE duelist SET rating = rating + 1 where token="'.$token.'"','',false);
	else 
	{
		if($d['rating']!=0)reqdbsql('UPDATE duelist SET rating = rating - 1 where token="'.$token.'"','',false);
	}
		
	reqdbsql('UPDATE duelist SET live = live + 1 where token="'.$token.'"','',false);
	reqdbsql('UPDATE duelist SET damage = damage + 1 where token="'.$token.'"','',false);

	//UpDataStatusToNotReady($token);
	//UpDataStatusOpponentSelect($token,"");
}
?>