<?php
include "findload.php";
$cssmain='
@charset "utf-8";
body {overflow: hidden; font-family: Arial;font-size: 15px;}
.dialog{position:relative;box-shadow: 0 7px 28px grey, 0 3px 6px #CCCCFF;border: 1px solid #CCCCFF;margin: 3 auto;padding: 20;border-radius:15px;}
input {border:1px solid #CCCCFF; outline: 0;border-radius:5px;margin: 5px;}
input:hover{box-shadow: 0 3px 8px grey, 0 3px 8px #CCCCFF;transition: 0.5s;}
input:not(:hover){transition: 0.5s;}
P{margin:0;padding:0;}
.sublogin {margin: auto;width:100%}';

if($GLOBALS['DEBUG_LOG']==1)
{
	$cssmain.='.DEBUG{position: fixed; left: 0; bottom: 0;	padding: 5 10;overflow:hidden scroll;color:green;background-color:black}';
	$cssmain.=css_posdialog('whDBG',"calc(100% - 21px)",100);
}
function css_posdialog($n,$w,$h,$l=0,$t=0)
{	
	$out='.'.$n.'{width:'.$w.';height:'.$h;
	if($l!=0)$out.=';left:'.$l;
	if($t!=0)$out.=';top:'.$t;
	$out.='}';
	return $out;
}
function endhtml(){include "out.php";}
function Head($out){$GLOBALS['HEAD'].=$out."\r\n";}
function CSS($out){$GLOBALS['CSS'].=$out."\r\n";}
function Body($out){$GLOBALS['BODY'].=$out;}
function SetTimer($count)
{
	$id=uniqid();
	$GLOBALS['CSS'].='.timer-'.$id.' {position: relative;top:0;left:0;width: 34px;height: 25px;text-align: center;font-size: 30px;overflow:hidden;}
		  @keyframes timer {100%{transform: translateY(-'.(30*$count).'px);}}.timer_'.$id.' p{position:relative;width:20;height:30;top:-5;bored:1px solid;}
		  .timer_'.$id.' {animation: timer '.$count.'s steps('.$count.', end) 1;}';
	
	$html='<div class="timer-'.$id.'"><div class="timer_'.$id.'">';
	for($l=$count;$l>-1;$l--)$html.='<p>'.$l.'</p>';
	$html.='</div></div>';
	return $html;
}
function SetTimerLive($arr,$l)
{
	$id=uniqid();
	$arr=explode('#',$arr);
	$count=count($arr);
	
	$GLOBALS['CSS'].='.timer-'.$id.' {position: absolute;top:37;left:'.$l.';width: 25px;height: 15px;border:0px solid;overflow:hidden}
					@keyframes load'.$id.' {100%{transform: translateY(-'.(17*$count).'px);}}
					.timer_'.$id.' p{font-size: 15px;text-align: center;position:relative;top:-1}
					.timer_'.$id.' {animation: load'.$id.' '.$count.'s steps('.$count.', end) 1;}';
	
	$html='<div class="timer-'.$id.'"><div class="timer_'.$id.'">';
	for($l=0;$l<$count;$l++)
	{
		$html.='<p>'.$arr[$l].'</p>';
	}
	$html.='</div></div>';
	return $html;
}

function starthtml()
{
/*	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');*/
	$GLOBALS['DEBUG']="";
	$GLOBALS['CSS']=$GLOBALS['cssmain'];
	$GLOBALS['BODY']="";
	$GLOBALS['HEAD']="";
}


function CPrint($cmd,$out="")
{
	global $CSS;
	if($cmd=='login' || $cmd=='pass_err' || $cmd=='login_err')
	{
		CSS(css_posdialog('whlogin',280,100));
		CSS('input[type="submit"]{width:100;margin:0 calc(50% - 50px)}
			 input[type="text"]{padding-left:5;width:200}
			 input[type="password"]{width:200}');
		Body('<h2 align="center">Добро пожаловать в дуэли!</h2>
			<div class="dialog whlogin">
				<form action="/" method="POST">');
		if($cmd=='pass_err' || $cmd=='login_err')Body('<p align="center" style="color:red">Не верный логин или пароль!</p>');
		Body('<span>
				<p style="padding-left: 28px;">Ник:
				<input type="text" name="duelist"> </p>
			</span>
			<span>
				<p>Пароль: 
				<input type="password" name="pass"></p>
			</span>
			<br>
			<div class="sublogin"><input type="submit" value="Войти"></div>
			</form></div>');
	}
	if($cmd=='main_ok' || $cmd=='main_new')
	{
		CSS(css_posdialog('whmain',350,190));
		CSS('.imgduels{border:1px solid #CCCCFF;border-radius:15px;position: relative; left: calc(50% - 55px);margin-top:20;width:105;height:105;padding:7 0 0 5;}');
		CSS('.imgduels img{width:100;height:100}');
		CSS('.imgduels:hover{box-shadow: 0 3px 8px #CCCCFF, 0 3px 8px #CCCCFF;transition: 0.5s;}');
		CSS('.imgduels:not(hover){transition: 0.5s;}');
		CSS('input[type="submit"]{width:110;margin:30 0 0 calc(50% - 55px);background-color:#FFFFFF}');

		Body('<div class="dialog whmain">');
		if($cmd=='main_ok')
			Body('<p align="center">Самое время сразиться в поединке, '.$out.'! :) </p>');
		else
			Body('<p align="center">Добро пожаловать в дуэли новичек!</p>');
		Body('<div class="imgduels"><a href="/?duelist=1"><img src="img/duels.png"></a></div>
			<form action="/" method="POST">
			<input type="hidden" name="exit" value="1">
			<input type="submit" value="Выйти">
			</form></div>');
	}
	if($cmd=='duelists' || $cmd=='findfight' || $cmd=='notfoundfight')
	{
		CSS(css_posdialog('whduelists',350,190));
		if($cmd=='findfight' || $cmd=='notfoundfight')
		{
			CSS('.duelist1 {width:200;position: relative; left: 0; top:0;}
				 .duelist1 .pos {position: relative; animation:duelistmove1 2s;}
				 .duelist1 .statmove {position: relative;height:100;left:15;top:20}
				 .duelist1 .statmove .stat {position: relative; animation:duelistmove11 2s;}');
			if($cmd=='findfight')CSS('@keyframes duelistmove1 {from {right:-84;top:10;} to {right:0;top:0;}} 
				 @keyframes duelistmove11{from {right:-100;top:-104;} to {right:0;top:0;}}
				 @keyframes duelistopacity2 {0% {opacity: 0;} 100% {opacity: 0.2;}}');
			CSS('.duelist2 {position: relative; left: 245; top:-205;width:105;height:200;padding:4;overflow:hidden;opacity: 0.2;
							animation-duration: 4s;animation-fill-mode: both;animation-name: duelistopacity2;}
				 .duelist2 .logo{position: relative;height:100;left:0;top:0}
				 .duelist2 .stat{position: relative;height:100;left:45;top:20}
				 .findload{position: relative; left: 0; top:-315;z-index:10}
				  ');
			if($cmd=='notfoundfight')
				CSS('.notfound{position: relative; left: 0; top:-385;z-index:2;}
					 .notfound p{text-align:center}
					 .notfound a{text-align:center}
					 .nf{display:block;border-radius:5px;width:135;height:35;padding-top:15;margin:20 auto;border:1px solid #CCCCFF}
					 .nfbk{display:block;border-radius:5px;width:135;height:20;margin:40 auto;border:1px solid #CCCCFF}
					 .nf:hover, .nfbk:hover{box-shadow: 0 3px 8px grey, 0 3px 8px #CCCCFF;transition: 0.5s;}
					 .nf:not(hover), .nfbk:not(hover){transition: 0.5s;}
					 ');
			else
				CSS($GLOBALS['cssfindload']);
		}
		if($cmd=='duelists')
		{
			CSS('.duelist1{position: relative; left: calc(50% - 95px); top:10;width:200;height:105;padding:4;overflow:hidden}
				 .duelist1 .statmove{position: relative;height:100;left:115;top:-100}');
		}
		CSS('.duelist1 img, .duelist2 img{width:100;height:100;}
			 .duelist1 .logo {position: relative;height:100;left:0}
			 .duelist1 .imgs, .duelist2 .imgs{width:15;height:15;}
			 
			 .find{display:block;border-radius:5px;width:115;height:32;margin:20 auto;padding:15 0 0 20;border:1px solid #CCCCFF}
			 .find:hover{box-shadow: 0 3px 8px grey, 0 3px 8px #CCCCFF;transition: 0.5s;}
			 .find:not(hover){transition: 0.5s;}
			 a{text-decoration: none;color: #000 !important;}');
		Body('<div class="dialog whduelists">
				<div class="duelist1">
					<div class="pos">
						<div class="logo"><img src="img/duelist1.png"></div>
						<div class="statmove">
							<div class="stat"><p>'.$out['login'].'</p>
								<p><img src="img/rating.png" class="imgs"> '.$out['rating'].'</p>
								<p><img src="img/live.png" class="imgs"> '.$out['live'].'</p>
								<p><img src="img/dmg2.png" class="imgs"> '.$out['damage'].'</p>
							</div>
						</div>
					</div>
				</div>');
		if($cmd=='duelists'){Body('<a class="find" href="/?duelist=2">Начать дуэль</a>');}
		if($cmd=='findfight' || $cmd=='notfoundfight')
		{
			Body('<div class="duelist2">
					<div class="logo"><img src="img/duelist2.png"></div>
					<div class="stat"><p>???</p>
						<p>??? <img src="img/rating.png" class="imgs"></p>
						<p>??? <img src="img/live.png" class="imgs"></p>
						<p>??? <img src="img/dmg2.png" class="imgs"></p>
					</div></div>');
			if($cmd=='findfight')	Body('<div class="findload">'.$GLOBALS['htmlfindload'].'</div>');
			if($cmd=='notfoundfight') 
				Body('<div class="notfound"><p>Нет соперников</p><br><a class="nf" href="/?duelist=2">Повторный поиск!</a><a class="nfbk" href="/?duelist=0">Назад</a>
			</div></div>');
		}
	/*	if($cmd=='notfoundfight')
		{
			Body('<div class="dialog fightend_ whfightend anim movexit"><p>Нет никто :))</p><br>
				 <div class="stat">

				 </div>
				 <a class="bfightend" href="/?duelist=5">Повторный поиск!</a>
				 </div>');
		}*/
		Body('</div>');
	}
	if($cmd=='duelfound' || $cmd=='fight' || $cmd=='fightend')
	{
		CSS(css_posdialog('whduelfound',350,190));
		CSS('.duelist1 {width:200;position: relative; left: 0; top:0;}
			 .duelist1 .pos {position: relative; animation:duelistmove1 2s;}
			 .duelist1 .statmove {position: relative;height:100;left:15;top:20}
			 .duelist1 .statmove .stat {position: relative; animation:duelistmove11 2s;}
			 .duelist2 {position: relative; left: 245; top:-205;width:105;height:200;padding:4;overflow:hidden;
							animation-duration: 2s;animation-fill-mode: both;animation-name: duelist2;}
			 .duelist2 .logo{position: relative;height:100;left:0;top:0}
			 .duelist2 .stat{position: relative;height:100;left:-15;top:20;}
			 .duelist2 .stat p{text-align:right}
			 .duelist1 img, .duelist2 img{width:100;height:100;}
			 .duelist1 .logo {position: relative;height:100;left:0}
			 .duelist1 .imgs, .duelist2 .imgs{width:15;height:15;} 
			 
			 .find{display:block;border-radius:5px;width:115;height:32;margin:20 auto;padding:15 0 0 20;border:1px solid #CCCCFF}
			 .find:hover{box-shadow: 0 3px 8px grey, 0 3px 8px #CCCCFF;transition: 0.5s;}
			 .find:not(hover){transition: 0.5s;}
			 .waitingforduels {position: relative; width:130;height:200; left: 108; top:-415;z-index:10;border:0px solid}
			 .waitingforduels .top{position: relative;}
			 .waitingforduels .top p{text-align: center}
			 .waitingforduels .top .time{position: relative;top:10; width:30;left:calc(50% - 15px)}
			 .waitingforduels .bottom{position: relative;top:30;left:calc(50% - 50px)}
			 .waitingforduels .bottom img{width:100;height:100}
			 a{text-decoration: none;color: #000 !important;}');
		if($cmd=='duelfound')CSS('@keyframes duelist2 {0% {opacity: 0.2;} 100% {opacity: 1;}}');
			 
		Body('<div class="dialog whduelfound">
				<div class="duelist1">
					<div class="pos">
						<div class="logo"><img src="img/duelist1.png"></div>
						<div class="statmove">
							<div class="stat"><p>'.$out[0]["login"].'</p>
								<p><img src="img/rating.png" class="imgs"> '.$out[0]["rating"].'</p>
								<p><img src="img/live.png" class="imgs"> '.($cmd!='fight'?$out[0]["live"]:'&#8195;').'</p>');
								if($cmd=='fight')Body('<div>'.SetTimerLive($out[7],'17').'</div>');
							Body('<p><img src="img/dmg2.png" class="imgs"> '.$out[0]["damage"].'</p>
							</div>
						</div>
					</div>
				</div>
				<div class="duelist2">
					<div class="logo"><img src="img/duelist2.png"></div>
					<div class="stat"><p>'.$out[1]["login"].'</p>
						<p>'.$out[1]["rating"].' <img src="img/rating.png" class="imgs"></p>');
			if($cmd=='fight')Body('<div>'.SetTimerLive($out[8],'60').'</div>');
			Body('<p>'.($cmd!='fight'?$out[1]["live"]:'&#8195;').' <img src="img/live.png" class="imgs"></p>
						<p>'.$out[1]["damage"].' <img src="img/dmg2.png" class="imgs"></p>
					</div>
				</div>');
				
		if($cmd=='duelfound')
		{
			Body('<div class="waitingforduels">
					<div class="top"><p>До битвы осталось</p><div class="time">'.SetTimer($GLOBALS['TimeStartDuels']).'</div></div>
					<div class="bottom"><img src="img/duels.png"></div>
				</div>');
		}
		else
		{
			Body('<div class="waitingforduels">
					<div class="top"><p>Битва!</p></div>
					<div class="bottom"><img src="img/fight.gif"></div>
				</div>');
		}
		Body('</div>');
		
		if($cmd=='fight' || $cmd=='fightend')
		{
			$rating='';
			if($out[3]==0)$rating='+ 1 = '.($out[0]["rating"]+1);
			if($out[3]==1&&$out[0]["rating"]!=0)$rating='- 1 = '.($out[0]["rating"]-1);
			CSS(css_posdialog('whfightlog',350,($GLOBALS['DEBUG_LOG']==0?470:350),0,0));
			CSS(css_posdialog('whfightend',250,150,0,0));
			CSS('.fightlog_ {overflow:hidden scroll;}
				 .whfightlog p{text-align:center;width:100%;}
				 .fightlog {width:100%;}
				 .fightlog p{font-size:13;}
				 .fightlog div{padding:5;margin-bottom:5;border-radius:10px;box-shadow: 0 3px 8px grey;display: inline-block;}
				 .fightlog .ph0{float:left}
				 .fightlog .ph1{float:right}
				 .anim{ -webkit-animation-duration: 0.2s; animation-duration: 0.2s;-webkit-animation-fill-mode: both; animation-fill-mode: both;}
				 .fightlog .ph{text-align:center;width:100%}
				 .fightend_ {position:absolute;z-index:100;background-color:#ffff;left:calc(50% - 146px);top:25;}
				 .fightend_ p{text-align:center}
				 .fightend_ .imgs{width:15;height:15;}
				 .fightend_ .stat {text-align:center}
				 .fightend_ .sl {display:inline-block}
				 .fightend_ .sr {display:inline-block}
				 .fightend_ .stat p{text-align:left}
				 .bfightend{position:relative;display:block;width:110;border-radius:5px;height:20;top:20;margin:0 auto;padding:10 10;border:1px solid #CCCCFF;text-align:center}
				 .bfightend:hover{box-shadow: 0 3px 8px grey, 0 3px 8px #CCCCFF;transition: 0.5s;}
				 .bfightend:not(hover){transition: 0.5s;}
				 @keyframes fil {from {opacity: 0; transform: translate3d(-100%, 0, 0);} to {opacity: 1; transform: none;}}
				 @keyframes fir {from {opacity: 0; transform: translate3d(100%, 0, 0);} to {opacity: 1; transform: none;}}
				 @keyframes cen {from {opacity: 0;} to {opacity: 1;}}
				 .movexit{animation-delay: '.$out[5].'s; animation-name: cen;}');
			CSS($out[4]);
			Body('<script>	setInterval(() =>{var el=document.querySelector(".whfightlog");el.scroll(0,el.scrollTop+120);}, 4000)</script>
				<div class="dialog fightlog_ whfightlog">
				 <p>Ход боя</p><br>
				 '.$out[2].'
				 </div>
				 <div class="dialog fightend_ whfightend anim movexit"><p>'.($out[3]==2?'Нечья!':$out[3]?'Вы проиграли.':'Победа за вами!!!').'</p><br>
				 <div class="stat">
				 	<div class="sl">
						<p><img src="img/rating.png" class="imgs"> '.$out[0]["rating"].'</p>
						<p><img src="img/live.png" class="imgs"> '.$out[0]["live"].'</p>
						<p><img src="img/dmg2.png" class="imgs"> '.$out[0]["damage"].'</p>
					</div>
				 	<div class="sr">
						<p>'.$rating.'</p>
						<p>+ 1 = '.($out[0]["live"]+1).'</p>
						<p>+ 1 = '.($out[0]["damage"]+1).'</p>
					</div>
				 </div>
				 <a class="bfightend" href="/?duelist=5">Принято!</a>
				 </div>
				 ');
		}
	}
}
?>