<?php
$htmlfindload='<div class="cssload-loading"><div class="cssload-finger cssload-finger-1"><div class="cssload-finger-item"><span></span><i></i></div></div>
<div class="cssload-finger cssload-finger-2"><div class="cssload-finger-item"><span></span><i></i></div></div><div class="cssload-finger cssload-finger-3">
<div class="cssload-finger-item"><span></span><i></i></div></div><div class="cssload-finger cssload-finger-4"><div class="cssload-finger-item"><span></span><i></i></div></div>
<div class="cssload-last-finger"><div class="cssload-last-finger-item"><i></i></div></div></div>';
$cssfindload='
.cssload-loading *{
	-khtml-box-sizing: border-box;
	box-sizing: border-box;	
}
	
.cssload-loading {
	position: absolute;
	left: 50%;
	margin: -24px 0 0 -39px;
	width: 84px;
	height: 49px;
	*zoom: 1;
}
.cssload-loading:before,
.cssload-loading:after {
	display: table;
	content: "";
}
.cssload-loading:after {
	clear: both;
}
.cssload-loading .cssload-finger {
	float: left;
	margin: 0 1px 0 0;
	width: 14px;
	height: 100%;
}
.cssload-loading .cssload-finger-1 {
	animation: cssload-finger-1-animation 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-1 span {
	animation: cssload-finger-1-animation-span 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-1 i {
	animation: cssload-finger-1-animation-i 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-2 {
	animation: cssload-finger-2-animation 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-2 span {
	animation: cssload-finger-2-animation-span 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-2 i {
	animation: cssload-finger-2-animation-i 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-3 {
	animation: cssload-finger-3-animation 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-3 span {
	animation: cssload-finger-3-animation-span 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-3 i {
	animation: cssload-finger-3-animation-i 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-4 {
	animation: cssload-finger-4-animation 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-4 span {
	animation: cssload-finger-4-animation-span 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-4 i {
	animation: cssload-finger-4-animation-i 0.7s infinite ease-out;
}
.cssload-loading .cssload-finger-item {
	position: relative;
	width: 100%;
	height: 100%;
	border-radius: 4px 4px 6px 6px;
	background-clip: padding-box;
	background: rgb(0,0,0);
}
.cssload-loading .cssload-finger-item span {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: auto;
	padding: 3px 3px 0 3px;
}
.cssload-loading .cssload-finger-item span:before,
.cssload-loading .cssload-finger-item span:after {
	content: \'\';
	position: relative;
	display: block;
	margin: 0 0 1px 0;
	width: 100%;
	height: 1px;
	background: rgb(255,255,255);
}
.cssload-loading .cssload-finger-item i {
	position: absolute;
	left: 2px;
	bottom: 2px;
	width: 10px;
	height: 10px;
	border-radius: 7px 7px 5px 5px;
	background-clip: padding-box;
	background: rgb(255,255,255);
}
.cssload-loading .cssload-last-finger {
	position: relative;
	float: left;
	width: 17px;
	height: 100%;
	overflow: hidden;
}
.cssload-loading .cssload-last-finger-item {
	position: absolute;
	right: 0;
	top: 22px;
	width: 110%;
	height: 14px;
	border-radius: 0 3px 10px 0;
	background-clip: padding-box;
	background: rgb(0,0,0);
	animation: cssload-finger-5-animation 0.7s infinite linear;
}
.cssload-loading .cssload-last-finger-item i {
	position: absolute;
	left: 0;
	top: -6px;
	width: 15px;
	height: 6px;
	background: rgb(0,0,0);
	overflow: hidden;
}
.cssload-loading .cssload-last-finger-item i:after {
	content: \'\';
	position: absolute;
	left: 0;
	bottom: 0;
	width: 24px;
	height: 14px;
	border-radius: 0 0 10px 10px;
	background-clip: padding-box;
	background: rgb(255,255,255);
}

@keyframes cssload-finger-1-animation {
	0% {
		padding: 8px 0 3px 0;
	}
	20% {
		padding: 8px 0 3px 0;
	}
	29% {
		padding: 3px 0 17px 0;
	}
	35% {
		padding: 3px 0 17px 0;
	}
	41% {
		padding: 8px 0 3px 0;
	}
	100% {
		padding: 8px 0 3px 0;
	}
}

@keyframes cssload-finger-1-animation-span {
	0% {
		top: 0;
	}
	20% {
		top: 0;
	}
	29% {
		top: -5px;
	}
	35% {
		top: -5px;
	}
	41% {
		top: 0;
	}
	100% {
		top: 0;
	}
}

@keyframes cssload-finger-1-animation-i {
	0% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	20% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	29% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	35% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	41% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	100% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
}

@keyframes cssload-finger-2-animation {
	0% {
		padding: 4px 0 1px 0;
	}
	24% {
		padding: 4px 0 1px 0;
	}
	33% {
		padding: 1px 0 11px 0;
	}
	39% {
		padding: 1px 0 11px 0;
	}
	45% {
		padding: 4px 0 1px 0;
	}
	100% {
		padding: 4px 0 1px 0;
	}
}

@keyframes cssload-finger-2-animation-span {
	0% {
		top: 0;
	}
	24% {
		top: 0;
	}
	33% {
		top: -5px;
	}
	39% {
		top: -5px;
	}
	45% {
		top: 0;
	}
	100% {
		top: 0;
	}
}

@keyframes cssload-finger-2-animation-i {
	0% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	24% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	33% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	39% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	45% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	100% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
}

@keyframes cssload-finger-3-animation {
	0% {
		padding: 0 0 0 0;
	}
	28% {
		padding: 0 0 0 0;
	}
	37% {
		padding: 0 0 8px 0;
	}
	43% {
		padding: 0 0 8px 0;
	}
	49% {
		padding: 0 0 0 0;
	}
	100% {
		padding: 0 0 0 0;
	}
}

@keyframes cssload-finger-3-animation-span {
	0% {
		top: 0;
	}
	28% {
		top: 0;
	}
	37% {
		top: -5px;
	}
	43% {
		top: -5px;
	}
	49% {
		top: 0;
	}
	100% {
		top: 0;
	}
}

@keyframes cssload-finger-3-animation-i {
	0% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	28% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	37% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	43% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	49% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	100% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
}

@keyframes cssload-finger-4-animation {
	0% {
		padding: 6px 0 2px 0;
	}
	32% {
		padding: 6px 0 2px 0;
	}
	41% {
		padding: 3px 0 14px 0;
	}
	47% {
		padding: 3px 0 14px 0;
	}
	53% {
		padding: 6px 0 2px 0;
	}
	100% {
		padding: 6px 0 2px 0;
	}
}

@keyframes cssload-finger-4-animation-span {
	0% {
		top: 0;
	}
	32% {
		top: 0;
	}
	41% {
		top: -5px;
	}
	47% {
		top: -5px;
	}
	53% {
		top: 0;
	}
	100% {
		top: 0;
	}
}

@keyframes cssload-finger-4-animation-i {
	0% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	32% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	41% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	47% {
		bottom: 6px;
		height: 8px;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
		-moz-border-radius: 5px 5px 3px 3px;
		-moz-background-clip: padding;
		border-radius: 5px 5px 3px 3px;
		background-clip: padding-box;
	}
	53% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
	100% {
		bottom: 2px;
		height: 10px;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
		-moz-border-radius: 7px 7px 5px 5px;
		-moz-background-clip: padding;
		border-radius: 7px 7px 5px 5px;
		background-clip: padding-box;
	}
}

@keyframes cssload-finger-5-animation {
	0% {
		top: 22px;
		right: 0;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 3px 10px 0;
		-moz-background-clip: padding;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	34% {
		top: 22px;
		right: 0;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 3px 10px 0;
		-moz-background-clip: padding;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	43% {
		top: 14px;
		right: 1px;
		border-radius: 0 6px 14px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 6px 14px 0;
		-moz-background-clip: padding;
		border-radius: 0 6px 14px 0;
		background-clip: padding-box;
		transform: rotate(-12deg);
		-ms-transform: rotate(-12deg);
		transform: rotate(-12deg);
	}
	50% {
		top: 14px;
		right: 1px;
		border-radius: 0 6px 14px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 6px 14px 0;
		-moz-background-clip: padding;
		border-radius: 0 6px 14px 0;
		background-clip: padding-box;
		transform: rotate(-12deg);
		-ms-transform: rotate(-12deg);
		transform: rotate(-12deg);
	}
	60% {
		top: 22px;
		right: 0;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 3px 10px 0;
		-moz-background-clip: padding;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		top: 22px;
		right: 0;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		-moz-border-radius: 0 3px 10px 0;
		-moz-background-clip: padding;
		border-radius: 0 3px 10px 0;
		background-clip: padding-box;
		transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		transform: rotate(0deg);
	}
}';
?>