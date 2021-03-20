<?php

	header("Content-Type: text/css");

	function random() {
		return '#'.str_pad(dechex(rand(0, pow(2, 24) - 1)), 6, 0);
	}

	switch($_SESSION['theme'])
	{
		case 'light':
			?>* {
				--green: #280;
				--blue: #48F;
				--brown: #942;
				--white: #EED;
				--gray1: #AAA;
				--gray2: #444;
				--black: #050505;
			}
			.typed { /*222*/
				filter: invert(0%) sepia(78%) saturate(2297%) hue-rotate(20deg) brightness(92%) contrast(73%);
			}
			#settings {/*48F*/
				filter: invert(43%) sepia(92%) saturate(1723%) hue-rotate(202deg) brightness(101%) contrast(102%);
			}
			.typed:hover, #settings:hover { /*280*/
				filter: invert(48%) sepia(57%) saturate(6734%) hue-rotate(76deg) brightness(91%) contrast(101%);
			}<?php
			break;

		case 'dark':
			?>* {
				--green: #D63;
				--blue: #04A;
				--brown: #050505;
				--white: #222;
				--gray1: #666;
				--gray2: #AAA;
				--black: #EED;
			}
			.typed {/*EED*/
				filter: invert(92%) sepia(8%) saturate(660%) hue-rotate(340deg) brightness(111%) contrast(87%);
			}
			#settings {/*04A*/
				filter: invert(15%) sepia(89%) saturate(3207%) hue-rotate(211deg) brightness(91%) contrast(101%);

				transition-timing-function: cubic-bezier(1, 0, 0, 1);
			}
			.typed:hover, #settings:hover {/*D63*/
				filter: invert(51%) sepia(21%) saturate(2180%) hue-rotate(335deg) brightness(91%) contrast(89%);
			}<?php
			break;

		case 'random':
			?>* {
				--white: <?=random()?>;
				--green: <?=random()?>;
				--blue: <?=random()?>;
				--brown: <?=random()?>;
				--gray1: <?=random()?>;
				--gray2: <?=random()?>;
				--black: <?=random()?>;
			}
			.typed, #settings, .go img, #drag img {
				filter: invert(<?=rand(0,100)?>%) sepia(<?=rand(0,100)?>%) saturate(<?=rand(0,7500)?>%) hue-rotate(<?=rand(0,100)?>deg) brightness(<?=rand(0,200)?>%) contrast(<?=rand(0,200)?>%);
			}
			.typed:hover, #settings:hover, #border {
				filter: invert(<?=rand(0,100)?>%) sepia(<?=rand(0,100)?>%) saturate(<?=rand(0,7500)?>%) hue-rotate(<?=rand(0,100)?>deg) brightness(<?=rand(0,200)?>%) contrast(<?=rand(0,200)?>%);
			}<?php
			break;

		default:
			?>* {
				--white: #<?=substr($_SESSION['theme'], 18, 6)?>;
				--green: #<?=substr($_SESSION['theme'], 0, 6)?>;
				--blue: #<?=substr($_SESSION['theme'], 6, 6)?>;
				--brown: #<?=substr($_SESSION['theme'], 12, 6)?>;
				--gray1: #<?=substr($_SESSION['theme'], 30, 6)?>;
				--gray2: #444;
				--black: #<?=substr($_SESSION['theme'], 24, 6)?>;
			}
			.typed { /*222*/
				filter: invert(0%) sepia(78%) saturate(2297%) hue-rotate(20deg) brightness(92%) contrast(73%);
			}
			#settings {/*48F*/
				filter: invert(43%) sepia(92%) saturate(1723%) hue-rotate(202deg) brightness(101%) contrast(102%);
			}
			.typed:hover, #settings:hover { /*280*/
				filter: invert(48%) sepia(57%) saturate(6734%) hue-rotate(76deg) brightness(91%) contrast(101%);
			}<?php
			break;
	}
	?>#personal {
		background-color: #<?=substr($_SESSION['rgb'], 6, 6)?>;
	}
	#random {
		background-image: linear-gradient(45deg, <?=random()?>, <?=random()?>, <?=random()?>);
	}
	#random:hover {
		background-image: linear-gradient(45deg, <?=random()?>, <?=random()?>, <?=random()?>);
	}
