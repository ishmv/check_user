<?php
//set_time_limit(90);
//(c) dx

$nick=isset($_POST['nick']) && !is_array($_POST['nick']) ? trim($_POST['nick']) : '';
$pages=isset($_POST['pages']) && !is_array($_POST['nick']) ? $_POST['pages'] : 3;
$sleeptime=isset($_POST['sleeptime']) && !is_array($_POST['sleeptime']) ? $_POST['sleeptime'] : 1;
$icq=isset($_POST['icq']) ? 1 : 0;
$email=isset($_POST['email']) ? 1 : 0;
$ru=isset($_POST['ru']) ? 1 : 0;
$psycho=isset($_POST['psycho']) ? 1 : 0;

if(!preg_match("/^\d+$/",$pages) || $pages==0 || $pages>30)
  $pages=3;

if(!preg_match("/^\d+$/",$sleeptime) || $sleeptime>10)
  $sleeptime=1;


if(ini_get('magic_quotes_gpc')==1)
  $nick=stripslashes($nick);

$nlen=strlen($nick);
$lnick=strtolower_ru(transl($nick));


//address, type, sub-type
$blogs=Array(
Array('free-lance.ru/users/',2,6),
Array('weblancer.net/users/',2,6),
Array('darkdiary.ru/users',1,10),
Array('molotok.ru/show_user.php?uid=',3,1),
Array('clubmusic.in/user',0,7),
Array('lastfm.ru/user/',4,7),
Array('freelance.ru/users/',2,6),
Array('last.fm/user',4,7),
Array('.livejournal.com/',1,10),
Array('weblancer.com.ua/users',2,6),
Array('forum.antichat.ru/member.php?u',0,5),
Array('forum.blackhack.ru/member.php?u',0,5),
Array('forum.xaknet.ru/user',0,5),
Array('planety-hackeram.ru/member.php?',0,5),
Array('forum.asechka.ru/member.php?u',0,5),
Array('forum.hack-team.info/member.php?u',0,5),
Array('forum.whack.ru/repa.php?u=',0,5),
Array('forum.4game.ru',0,8),
Array('fotoplenka.ru/users',0,9),
Array('wasm.ru/forum',0,2),
Array('forum.fishki.net/index.php?showuser',0,10),
Array('fishki.net/profile.php?uid=',4,10),
Array('forums.goha.ru/member.php?u',0,8),
Array('series60.ru/forum/index.php?showuser=',0,11),
Array('forum.inattack.ru/index.php?showuser',0,5),
Array('prozzak.ru/forums/index.php?act=Profile',0,11),
Array('forum.telefon.ru/member.php?u=',0,11),
Array('forum.4pda.info/index.php?act=Profile',0,11),
Array('4pda.ru/forum/index.php?showuser=',0,11),
Array('metacafe.com/channels/',4,12),
Array('alterportal.ru/user/',4,7),
Array('drupal.ru/blog/',1,10),
Array('drupal.ru/user/',5,6),
Array('securitylab.ru/blog/user/',5,5),
Array('forum.igromania.ru/member.php?',0,8),
Array('.habrahabr.ru/',5,5),
Array('developers.org.ua/m/',5,2),
Array('damagelab.org/index.php?showuser=',0,2),
Array('forum.0day.kiev.ua/index.php?showuser=',6,13),
Array('forum.ru-board.com/profile.cgi?action=show&member=',0,10),
Array('profile.myspace.com/index.cfm?fuseaction=user.viewProfile',7,10),
Array('cyber-arena.ru/user/',4,8),
Array('.liveinternet.ru/users/',1,10),
Array('youtube.com/user/',4,12),
Array('honda-club.ru/forum/member.php?u',5,14),
Array('demiart.ru/forum/index.php?showuser=',0,4),
Array('dozory.ru/bbs/profile.php?mode=viewprofile&u=',8,8),
Array('forum.coder-club.in/index.php?act=Profile',0,2),
Array('hackzona.ru/hz.php?name=Forums&file=profile',0,5),
Array('.vocalist.su/',4,7),
Array('photosight.ru/users/',4,9),
Array('megashara.com/member',6,13),
Array('hip-hop.ru/forum/member.php?',0,7),
Array('smartmovie.ru/index.php?subaction=userinfo',4,11),
Array('privet.ru/user/',7,10),
Array('antimir.com/~',9,15),
Array('blogs.mail.ru/mail/',1,10),
Array('love.hochuvse.ru/',9,15),
Array('xakepok.org/user/',0,5),
Array('forum.arena.ru/index.php?showuser=',0,8),
Array('forum.dotgame.ru/index.php?showuser=',0,8),
Array('risovaska.ru/user/',4,9),
Array('scripter.biz/user/',5,2),
Array('4dle.su/user/',5,6),
Array('6dle.ru/user/',5,6),
Array('domenforum.net/member.php?u=',3,1),
Array('mmogame.ru/forum/index.php?showuser=',0,8),
Array('passion.ru/profile.php?user=',4,10),
Array('mirtesen.ru/people/',7,10),
Array('.hiblogger.net',1,10),
Array('.blog.ru/profile',1,10),
Array('medikforum.ru/profile.php?mode=',0,16),
Array('limpa.ru/users/',9,15),
Array('.ziza.ru',4,17),
Array('.rutube.ru/',4,12),
Array('mobilize.in/user',4,11),
Array('se4ever.ru/user',4,11),
Array('smotri.com/user/',4,12),
Array('.deviantart.com',4,9),
Array('html.by/member.php?u',0,2),
Array('x-bikers.ru/bikera/anketa_bikera.php?id=',4,18),
Array('airsoftclub.ru/phpbb/profile.php?mode=viewprofile',0,18),
Array('nokia-mobile.org/forum/member.php?u',0,11),
Array('forum.searchengines.ru/member.php?',0,3),
Array('kinoline.com.ua/forum/index.php?showuser=',0,12),
Array('astronomy.ru/forum/index.php?action=profile',0,19),
Array('taxhelp.ru/new/forum/member.php?u=',0,1),
Array('mihas.net/profile.php?userid=',0,10),
Array('wmforum.net.ru/index.php?showuser=',0,1),
Array('world-of-love.ru/forum/member.php?u',0,15),
Array('forum.4x4club.ru/index.php?showuser=',0,14),
Array('club.foto.ru/user/',4,9),
Array('otvety.google.ru/otvety/user?userid',5,10),
Array('forumprosport.ru/member.php',0,18),
Array('pickupforum.ru/index.php?showuser=',0,15),
Array('axevice.ru/users',8,8),
Array('klavogonki.ru/profile/',8,8),
Array('userbars.ru/search.html?search_user=',4,4),
Array('medprof.ru/user',0,16),
Array('forum.oszone.net/member.php?userid=',0,20),
Array('guitar.ru/forum/index.php?showuser=',0,7),
Array('iphoneapps.ru/forums/index.php?showuser=',0,11),
Array('libo.ru/index.php?subaction=userinfo&user=',4,10),
Array('forum.x-drivers.ru/index.php?showuser=',0,21),
Array('pspfaqs.ru/forum2/member.php?u=',0,8),
Array('mangos.ru/member.php?u=',0,2),
Array('afisha.ru/personalpage/',5,12),
Array('forum.nov.ru/index.php?showuser=',0,10),
Array('4ppc.ru/user/',4,21),
Array('hackulo.us/forums/index.php?showuser=',4,11),
Array('nokiasmart.com/user/',4,11),
Array('fotoplenka.ru/users/',4,9),
Array('electropeople.org/user/',4,7),
Array('ipoding.ru/forum/search.php?search_author=',5,11),
Array('myspeccy.ru/ru/users/',4,8),
Array('avalife.ru/user/',4,21),
Array('xsellize.com/member.php?u=',5,11),
Array('oslik.ru/phpBB2/profile.php?mode=viewprofile',4,11),
Array('thg.ru/forum/member.php?u=',5,20),
Array('rus-phpfusion.com/profile.php?lookup=',5,2),
Array('forum.web-hack.ru/index.php?showuser=',0,5),
Array('gofuckbiz.com/member.php?u=',0,3),
Array('forum.52nn.net/member.php?u=',0,3),
Array('umaxforum.com/member.php?u=',0,3),
Array('majesty.ru/forum/user',0,1),
Array('forum.tgbr.in/members/',0,5),
Array('secnull.info/index.php?showuser=',0,5),
Array('exploit.in/forum/index.php?showuser=',0,5),
Array('.mylivepage.ru/about',1,10),
Array('mastertalk.ru/user',0,3),
Array('exbii.com/member.php?u=',4,21),
Array('web-script.org/user/',5,6),
Array('mpcforum.com/member.php?u=',5,8),
Array('forum.xeka.ru/members/534',0,5),
Array('bug-track.ru/forum/profile.php?mode=viewprofile&u',0,5),
Array('forum.intuit.ru/member.php?u=',5,19),
Array('metallibrary.ru/team/members',4,7),
Array('moblex.ru/user/',4,21),
Array('world-of-love.ru/forum/member.php?u=',0,15),
Array('afportal.ru/user/',5,19),
Array('rap.ru/forum/member.php?u=',0,7),
Array('rusfaq.ru/info/user/',0,2),
Array('miranda-planet.com/forum/index.php?showuser=',0,6),
Array('facebook.com/people/',7,10),
Array('milw0rm.com/author/',5,5),
Array('devilart.net/members/',0,6),
Array('mobilehotel.ru/user/',4,11),
Array('mygreatphone.com/forum/members/',0,11),
Array('ibresource.ru/forums/index.php?showuser=',0,6),
Array('dle-news.ru/user/',5,6),
Array('forum.igromania.ru/member.php?u',0,8),
Array('uploder.ws/user/',4,12),
Array('uletno.info/user/',4,12),
Array('.wordpress.com',1,10),
Array('sphynxportal.com/forum/index.php?showuser=',0,9),
Array('predanie.ru/forum/index.php?showuser=',0,22),
Array('users.playground.ru',4,8),
Array('loveplanet.ru/page/',9,15),
Array('forum.sysfaq.ru/index.php?showuser=',0,20),
Array('digg.com/users/',2,10),
Array('users.nnm.ru/',4,10),
Array('.promodj.ru/',4,7),
Array('coderx.ru/member.php?u',0,8),
Array('bobrdobr.ru/people/',5,10),
Array('pwonline.ru/member.php?u=',0,8),
Array('mu-forum.apocalips.net/index.php?showuser=',0,8),
Array('fitsport.ru/fm/index.php?act=Profile&MID=',0,18),
Array('fo2.rambler.ru/forum/member.php?u=',0,8),
Array('muonline.aliennation.biz/index.php?showuser=',0,8),
Array('forum.rusgames.net/index.php?showuser=',0,8),
Array('diablo2.pnz.ru/modules.php?name=Your_Account&op=userinfo&username=',4,8),
Array('forum.destinysphere.ru/profile.php?mode=viewprofile&u=',0,8),
Array('gentoo.ru/user/',5,20),
Array('claneq.ru/player_stats.aspx?CharID=',8,8),
Array('postnuclear.ru/gm/info.php?nick=',8,8),
Array('cyberfight.ru/site/profile/',4,8),
Array('xfire.com/profile/',4,8),
Array('photographer.ru/nonstop/author.htm?id=',4,9),
Array('baltgames.lv/v2/users/',4,8),
Array('corbina.net/index.php?showuser=',4,10),
Array('cwars.ru/info.php?login=',8,8),
Array('carnage.ru/inf.pl?user=',8,8),
Array('joomlart.com/forums/member.php?u=',0,4),
Array('consoles.net/player/',4,8),
Array('kinopoisk.ru/level/79/user/',5,12),
Array('bit-torrent.kiev.ua/member.php?u=',6,13),
Array('forum.bashtel.ru/member.php?u=',0,8),
Array('board.bigpoint.com/darkorbit/member.php?u=',0,8),
Array('limon.kg/forums/member.php?u=',0,10),
Array('old-games.ru/forum/member.php?u=',0,8),
Array('usde.ru/user/',4,21),
Array('forum.nwfr.ru/index.php?showuser=',0,18),
Array('vvw.ru/index.php?subaction=userinfo&user=',4,17),
Array('capitalcity.combats.com/inf.pl?login=',8,8),
Array('.hiblogger.net/',1,10),
Array('neora.ru/anketa/index.php?user=',5,2),
Array('forum.nivalonline.com/member.php?u=',0,8),
Array('football.ua/profile/',5,18),
Array('komap.net.ru/user/',5,19),
Array('.dribbler.ru/',1,10),
Array('uined.ru/forum/member.php?u=',0,5),
Array('tmgame.ru/userinfo.php?nick=',8,8),
Array('myworld.ebay.com/',3,1),
Array('rybolov.de/users/',4,18),
Array('pippler.ru/social/user/',3,1),
Array('forum.format.org.ua/index.php?showuser=',0,21),
Array('forum.freelance.ru/index.php?showuser=',0,6),
Array('ludi.by/user/',7,10),
Array('forum.worldofwarcraft.ru/member.php?u=',0,8),
Array('forum.nashguu.ru/member.php?u',0,10),
Array('traderacademy.ru/forum/member.php?u=',0,1),
Array('gamelandaward.ru/forum/index.php?action=profile',0,8),
Array('xvatit.com/user/',4,10),
Array('q1.kpoxa.net/member.php?u=',0,8),
Array('boxing.ru/forum/member.php?u=',0,18),
Array('badminton-forum.ru/index.php?action=profile',0,18),
Array('forum.stalkerz.info/member.php?u=',0,8),
Array('wowedge.info/Forum/member.php?u=',0,8),
Array('animeshik.net/user/',4,17),
Array('ava-warez.com/user/',5,21),
Array('forum.cxem.net/index.php?showuser=',0,19),
Array('cyberforum.ru/members/',0,2),
Array('.blogspot.com',1,10),
Array('fotokritik.ru/member/?member_id=',4,9),
Array('emofans.ru/forum/member.php?u=',0,17),
Array('forum.allsoch.ru/member.php3?',0,10),
Array('flickr.com/photos/',4,9),
Array('forum.ragezone.com/members/',0,6),
Array('hachoo.ru/users/',4,10),
Array('ogl.ru/project/users/view.php?user_id=',0,8),
Array('softodrom.ru/scr/user.php?id=',4,21),
Array('piratia.ru/member.php?u=',8,8),
Array('la2.meganet.org.ua/vb/member.php?u=',0,8),
Array('cgresource.net/forum/member.php?u=',0,4),
Array('zoneofgames.ru/forum/index.php?showuser=',0,8),
Array('kvazar.org/member.php?u=',0,10),
Array('cyber66.org/users/',0,8),
Array('python.tigrov.net/stat/top.php',0,5),
Array('blackcat.catzone.ws/user/',4,21),
Array('phreaker.us/forum/member.php?userid=',0,5),
Array('blackcat.or.kz/user/',4,21),
Array('justsay.ru/users/',9,15),
Array('forum.od.ua/member.php?u=',0,10),
Array('guitarpro.ru/forum/profile.php?action=show&member=',0,7),
Array('midi-midi.mids.ru/midi/showuser.php?uid=',0,7),
Array('forum.antichat.net/member.php?u',0,5),
Array('forum.antichat.net/member.php?u',4,4),
Array('gelipo.com/members/',9,15),
Array('aol.com/member/',4,10),
Array('forum.vpleer.ru/member.php?u=',0,7),
Array('blackobelisk.ru/forums/index.php?act=Profile',0,7),
Array('blackobelisk.ru/forums/index.php?showuser=',0,7),
Array('getafreelancer.com/users/',5,6),
Array('clubforum.ru/member.php?u=',0,10),
Array('kino-govno.com/forums/index.php?showuser=',0,12),
Array('vbios.com/showuser.php?uid',4,8),
Array('animezone.ru/smf/index.php?action=profile',0,10),
Array('forums.azuregaming.net/member.php?u=',4,8),
Array('pcmusic.ru/user/',4,7),
Array('ceedworld.ru/forum/member.php?u',0,14),
Array('forum.kolesa.kz/index.php?showuser=',0,14),
Array('forum.mabico.ru/member.php?u',0,1),
Array('forum.l2planet.ru/index.php?action=profile',0,8),
Array('matchfishing.ru/forum/member.php?u=',0,18),
Array('live4fun.ru/users/',4,17),
Array('trinixy.ru/user/',4,17),
Array('kinopoisk.ru/board/member.php?u',0,12),
Array('forum.joltiy.ru/member.php?u=',0,10),
Array('dom2.ru/community?userId=',4,10),
Array('dom2.ru/user/info/view.do?userId=',4,10),
Array('klk.pp.ru/user/',4,10),
Array('radiokot.ru/forum/profile.php?mode=viewprofile&u',0,2),
Array('drive.ru/users/',5,14),
Array('forum.dwg.ru/member.php?u',0,6),
Array('forum.korol-i-shut.ru/index.php?act=Profile&',0,7),
Array('photoshare.ru/user/',4,9),
Array('la2bash.ru/user/',4,17),
Array('sovserv.ru/vbb/member.php?u',0,10),
Array('animeforum.ru/index.php?showuser=',0,10),
Array('diary.ru/member/?',1,10),
Array('fictionbook.ru/en/user/',5,10),
Array('babyblog.ru/user/',1,10),
Array('lookatme.ru/users/',4,9),
Array('foto.rambler.ru/users/',4,9),
Array('forum.mhealth.ru/index.php?showuser=',0,10),
Array('narod.i.ua/user/',4,10),
Array('mgdc.ru/board/member.php?u=',0,2),
Array('goldmebel.ru/member.php?u=',0,10),
Array('forum.realmusic.ru/member.php?u=',0,7),
Array('forumjoy.net/forum/member.php?u=',0,10),
Array('rl-team.net/member.php?u=',0,21),
Array('life360.ru/profile_view.php?bb_id=',4,10),
Array('mymuzzone.com/index.php?showuser=',0,7),
Array('sports.ru/profile/',5,18),
Array('.nnov.ru/?',1,10),
Array('nnov.ru/profile/?user_id=',1,10),
Array('free-lancers.net/users/',2,1),
Array('forum.sources.ru/index.php?act=Profile',0,2),
Array('pspiso.ru/user/',4,8),
Array('lj.rossia.org/users/',1,10),
Array('fotki.yandex.ru/users/',4,9),
Array('subscribe.ru/author/',5,10),
Array('kazus.ru/users/',5,20),
Array('mainpeople.ru/user/',4,17),
Array('bashtube.ru/users/',4,12),
Array('forum.hnet.ru/index.php?showuser=',0,10),
Array('djrogoff.ru/user/',4,12),
Array('forum.haddan.ru/member.php?',0,8),
Array('gamebox.by/member.php?u',4,8),
Array('fh2.ru/forums/member.php?',0,8),
Array('boarderz.ru/phpBB2/profile.php?mode=viewprofile',0,18),
Array('carsguru.ru/profile/',3,14),
Array('planety-carderam.ru/member.php?u=',0,5),
Array('memori.ru/',4,10),
Array('forum.oszone.net/member.php?u=',0,20),
Array('lib.rus.ec/user/',5,19),
Array('petelin.ru/conference/profile.php?mode=viewprofile&u=',0,7),
Array('ciscolab.ru/user/',5,2),
Array('.mopoto.com/',1,9),
Array('answers.mail.ru/inbox/',4,10),
Array('photofile.name/users/',4,9),
Array('webxakep.net/user/',5,5),
Array('forum.xakepok.org/members/',0,5),
Array('vzlom.in/member.php?u=',0,5),
Array('forum.xeka.ru/members/',0,5),
Array('forum.motofan.ru/index.php?showuser=',0,18),
Array('.kidala.info/',10,0),
Array('kidala.info/kidala_ripper',10,0),
Array('uinz.net/member.php?u=',0,5),
Array('csite.net/member.php?u=',0,11),
Array('forum.asiansthetic.com/member.php?u=',0,10),
Array('allrusnews.info/user/',5,19),
Array('l2info.net/forum/member.php?u=',0,8),
Array('forum.woh.ru/member.php?u=',0,8),
Array('ofp2.ru/forums/member.php?u=',0,8),
Array('planeta.rambler.ru/users/',1,10),
Array('mooir.ru/forum/index.php?showuser=',0,18),
Array('mindmix.ru/users/',1,10),
Array('.mindmix.ru/',1,10),
Array('anionline.ru/user/',4,12),
Array('forum.electronicarts.ru/member.php?u=',0,8),




//add more here



Array('index.php?showuser=',0,0),
Array('index.php?action=profile',0,0),
Array('showuser.php?uid',0,0),
Array('index.php?act=Profile',0,0),
Array('/member.php?u',0,0),
Array('/user/',2,0),
Array('/users/',2,0),
Array('index.php?subaction=userinfo&user=',2,0),
Array('index.php?user=',2,0),
Array('/members/',2,0),
Array('/profile/',2,0),
Array('/member/',2,0),
Array('view.php?user_id',0,0),
Array('user.php?id=',2,0),
Array('profile.php?mode=viewprofile',0,0),
Array('/profile.php?action=show&member',0,0)
);

$types=Array(
0 => 'форум',
1 => 'блог',
2 => 'другое',
3 => 'магазин',
4 => 'сайт развлечений',
5 => 'информационный сайт',
6 => 'торрент-трекер',
7 => 'соцсеть',
8 => 'онлайн-игра',
9 => 'сайт знакомств',
10 => 'Кидала?'
);

$subtypes=Array(
0 => 'другое',
1 => 'продажа и покупка товаров, заработок',
2 => 'программирование',
3 => 'seo',
4 => 'дизайн/графика',
5 => 'хакинг/security',
6 => 'программирование или дизайн',
7 => 'музыка',
8 => 'игры',
9 => 'фото',
10 => 'общение',
11 => 'смартфоны/мобильники',
12 => 'видео/TV/кино',
13 => 'торренты',
14 => 'автомобили',
15 => 'знакомства, любовь',
16 => 'медицина',
17 => 'юмор/развлечения',
18 => 'спорт',
19 => 'наука/новости мира',
20 => 'компьютеры/железо',
21 => 'софт/программы/драйверы/варез',
22 => 'религия'
);

$temptypes=$tempsubtypes=$tempsites=$tempsubtypespercents=$temptypespercents=Array();

$info='';

$hnick=htmlspecialchars($nick);

if(strlen($hnick)<1)
{
  $hnick='&lt;введите ник&gt;';
}

$c1= $icq==1 ? 'checked' : '';
$c2= $email==1 ? 'checked' : '';
$c3= $ru==1 ? 'checked' : '';
$c4= $psycho ? 'checked' : '';

header("Content-type: text/html; charset=utf-8");



print <<<HERE
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>People search 1.0 by DX [beta]</title>
<style>
table
{
border-width:1px;
border-style:solid;
border-color:gray;
border-collapse:collapse;
}
td.utd
{
border-width:1px;
border-style:solid;
border-color:gray;
}
td.hdr
{
background-color:gold;
}
a {
COLOR: #5555aa;
FONT-FAMILY:Arial, Helvetica, sans-serif;
FONT-SIZE:12px;
TEXT-DECORATION:none;
}
a:active {
COLOR: #111177;
FONT-FAMILY:Arial, Helvetica, sans-serif;
FONT-SIZE:12px;
TEXT-DECORATION:none;
}
a:hover {
COLOR: #111177;
FONT-FAMILY:Arial, Helvetica, sans-serif;
FONT-SIZE:12px;
TEXT-DECORATION:underline;
}
INPUT,button
{
BORDER-RIGHT: rgb(50,50,50) 1px outset;
BORDER-TOP: rgb(50,50,50) 1px outset;
FONT-SIZE: 11px;
font-family:Arial;
BORDER-LEFT: rgb(50,50,50) 1px outset;
BORDER-BOTTOM: rgb(50,50,50) 1px outset;
}

textarea
{
BORDER-RIGHT: rgb(50,50,50) 1px outset;
BORDER-TOP: rgb(50,50,50) 1px outset;
BORDER-LEFT: rgb(50,50,50) 1px outset;
BORDER-BOTTOM: rgb(50,50,50) 1px outset;
FONT-SIZE: 13px;
font-family:Arial;
}
</style>
</head>
<center><h3>Информация о $hnick</h3></center><hr>
<form action='?' method='post'>
Никнейм или имя: <input type='text' name='nick' value="$hnick"> <input type="submit" value="Поиск"><br>
Просматривать страниц поиска: <input type='text' value='$pages' name='pages'><br>
Задержка при просмотре страниц: <input type='text' value='$sleeptime' name='sleeptime'> сек.<br>
<input type='checkbox' name='psycho' $c4> Определить примерные интересы, места посещения, составить психологический портрет<br>
<input type='checkbox' name='icq' $c1> Искать номера ICQ<br>
<input type='checkbox' name='email' $c2> Искать адреса e-mail<br>
<input type='checkbox' name='ru' $c3> Ограничить поиск зоной .ru<hr>
Так как всё определяется через русский google, можно использовать и стандартные запросы гугла, например, inurl, intitle и т.п.
Можно вместо ника вводить имя или запрос вида &quot;icq &lt;номер&gt;&quot; для поиска по номеру icq.<br><br>
Для проверки в базе кидал можно, например, ввести запрос &quot;ник inurl:kidala&quot;.
</form><hr>
HERE;

print '<b>Записей сайтов в БД: '.count($blogs).'</b><hr>';



if(strlen($nick)<1)
  die('</body></html>');


print <<<HERE
<b>Возможные профили пользователя на сайтах:</b><br>
<table cellpadding=1 cellspacing=1 style="width:100%;"><tr align=center><td class='hdr'>Сайт</td><td class='hdr'>Тип сайта</td><td class='hdr'>Тематика сайта</td></tr>
HERE;


$nick=urlencode($nick);

$info=mygoogle($nick);


for($i=0;$i<=22;$i++)
{
  $temptypes[$i]=$tempsubtypes[$i]=$tempsubtypespercents[$i]=$temptypespercents[$i]=0;
}



//preg_match_all("/<li class=g><h3 class=r><a href=\"((http:\/\/|https:\/\/).+)\" /isU",$info,$m);
preg_match_all("/<h3 class=\"r\"><a href=\"((http:\/\/|https:\/\/).+)\" /isU",$info,$m);

foreach($m[1] as $site)
{
  if($ru && !preg_match("/.ru(\/|$)/i",$site))
    continue;

  for($i=0,$cnt=count($blogs);$i<$cnt;$i++)
  {
    if(is_array($blogs[$i]) && strpos($site,$blogs[$i][0])!==false)
    {
      print "<tr><td class='utd'><a href='$site' target='_blank'>$site</a></td><td class='utd'>{$types[$blogs[$i][1]]}</td><td class='utd'>{$subtypes[$blogs[$i][2]]}</td></tr>"; 

      $temptypes[$blogs[$i][1]]= isset($temptypes[$blogs[$i][1]]) ? $temptypes[$blogs[$i][1]]+1 : 1;
      $tempsubtypes[$blogs[$i][2]]= isset($tempsubtypes[$blogs[$i][2]]) ? $tempsubtypes[$blogs[$i][2]]+1 : 1;

      break;
    }
  }

  $tmpsite=str_replace(Array('www.','http://','https://'),Array('','',''),$site);
  $csite=substr($tmpsite,0,strpos($tmpsite,'/'));


  if(strpos(str_replace('-','',$csite),$lnick)===0 && $csite{$nlen}=='.')
    $tempsites[]=$csite;
}


$sum1=array_sum($temptypes);
$sum2=array_sum($tempsubtypes);

print '</table>';


if($psycho)
{

print '<hr><b>Места пребывания:</b><br>';


if($sum1>0)
{
  foreach($temptypes as $key => $tt)
  {
    if($tt==0) continue;
    $perc=round($tt*100.0/$sum1,1);

    print "<li>{$types[$key]}: ".$perc.'%';
  }

  $sum1-=$temptypes[2];

  if($sum1==0) $sum1=1;

  foreach($temptypes as $key => $tt)
  {
    if($tt==0) continue;
    $perc=round($tt*100.0/$sum1,1);
    $temptypespercents[$key]=$perc;
  }
}
else
{
  print '&lt;не найдено&gt;';
}

print '<hr><b>Интересы:</b><br>';

if($sum2>0)
{
  foreach($tempsubtypes as $key => $tt)
  {
    if($tt==0) continue;
    $perc=round($tt*100.0/$sum2,1);

    print "<li>{$subtypes[$key]}: ".$perc.'%';
  }


  $sum2-=$tempsubtypes[0];

  if($sum2==0) $sum2=1;


  foreach($tempsubtypes as $key => $tt)
  {
    if($tt==0) continue;
    $perc=round($tt*100.0/$sum2,1);
    $tempsubtypespercents[$key]=$perc;
  }


  print '<hr><b>Обобщённая характеристика (предполагаемые значения):</b><br>';

  $intellect=$nervous=$commmunicable=$otvetstv=$inetlove=0;

  $tmpint=$tempsubtypes[2]+$tempsubtypes[3]+$tempsubtypes[5]+$tempsubtypes[19]+$tempsubtypes[20]+$tempsubtypes[6];

  if($tmpint!=0)
  {
    $intellect=round(($tmpint-$tempsubtypes[8]/2-$tempsubtypes[15]/2.5-$tempsubtypes[10]/5)*100.0/$tmpint,1);
    if($intellect>=0 && $intellect<=30)
      $inttype='(обычный юзер интернета, ничем заумным и особенным в сети не занимается)';
    else if($intellect>30 && $intellect<=65)
      $inttype='(продвинутый пользователь, поосещающий различные интеллектуальные интернет-ресурсы)';
    else if($intellect>65)
      $inttype='(настоящий интеллектуал, который много времени в сети посвящает изучению различных вопросов)';
    else
      $inttype='(вероятно, пользователь, не наделенный особым умом, занят в основном играми и развлечениями)';

    $intellect.='%';
  }
  else
  {
    $inttype='';
    $intellect='невозможно определить';
  }

  $tmpnerv=$tempsubtypes[1]+$tempsubtypes[5]+$tempsubtypes[15];
  if($tmpnerv!=0)
  {
    $nervous=round(($tmpnerv-$tempsubtypes[22]-$tempsubtypes[17]-$tempsubtypes[7])*100.0/$tmpnerv,1);
    if($nervous>=0 && $nervous<=40)
      $ntype='(достаточно спокойная личность)';
    else if($nervous>40 && $nervous<=75)
      $ntype='(неуравновешенная личность, при общении с такими людьми необходимо соблюдать некоторую осторожность)';
    else if($nervous>75)
      $ntype='(очень вспыльчивая личность, принимает всё близко к сердцу)';
    else if($nervous<0 && $nervous>=-55)
      $ntype='(спокойный человек, которого не так просто вывести из себя)';
    else
      $ntype='(полный пофигист, которому глубоко плевать на всё, кроме того, что касается его самого)';

    $nervous.='%';
  }
  else
  {
    $ntype='';
    $nervous='невозможно определить';
  }

  $tmpcomm=$tempsubtypes[10]+$tempsubtypes[15]+$tempsubtypes[7]/2;
  if($tmpcomm!=0)
  {
    $communicable=round(($tmpcomm-$tempsubtypes[8]-$tempsubtypes[5]/2)*100.0/$tmpcomm,1);
    if($communicable>=0 && $communicable<=30)
      $ctype='(весьма замкнутый человек, с которым трудно общаться)';
    else if($communicable>30 && $communicable<=65)
      $ctype='(достаточно общительная личность, которая не стремится избегать общения)';
    else if($communicable>65)
      $ctype='(очень общительный человек, который будет сам стремиться к общению с вами)';
    else
      $ctype='(очень замкнутый человек, избегающий общения и, возможно, имеющий внутренние комплексы)';


    $communicable.='%';
  }
  else
  {
    $ctype='';
    $communicable='невозможно определить';
  }

  $tmpotv=$tempsubtypes[1]+$tempsubtypes[19]+$tempsubtypes[16]+$tempsubtypes[9]/2;
  if($tmpotv!=0)
  {
    $otvetstv=round(($tmpotv-$tempsubtypes[8]-$tempsubtypes[17]/3)*100.0/$tmpotv,1);
    if($otvetstv>=0 && $otvetstv<=30)
      $otype='(этот человек почти безответственный, дела с ним нужно вести осторожно)';
    else if($otvetstv>30 && $otvetstv<=60)
      $otype='(этому человеку можно доверять с некоторой осторожностью)';
    else if($otvetstv>60)
      $otype='(этот человек очень ответственный, вы можете ему доверять)';
    else
      $otype='(это безответственная личность, с которой нужно быть крайне осторожным)';

    $otvetstv.='%';
  }
  else
  {
    $otype='';
    $otvetstv='невозможно определить';
  }


  $tmpinet=$tempsubtypes[8]+$tempsubtypes[15]+$tempsubtypes[22]+$tempsubtypes[13]+$tempsubtypes[1]+$tempsubtypes[5]/1.5+$tempsubtypes[3]/1.5+$temptypes[1];

  if($tmpinet!=0)
  {
    $inetlove=round(($tmpinet-$tempsubtypes[18]-$tempsubtypes[7]/2-$tempsubtypes[19])*100.0/$tmpinet,1);
    if($inetlove>=0 && $inetlove<=30)
      $itype='(этот человек проводит время в сети только в случае необходимости или по работе)';
    else if($inetlove>=30 && $inetlove<=65)
      $itype='(этот человек достаточно зависим от интернета, любит проводить время в сети)';
    else if($inetlove>65)
      $itype='(этот человек очень зависим от интернета, без сети не может и пару дней спокойно прожить)';
    else
      $itype='(этот человек практически независим от сети, он просто пользуется интернетом по мере необходимости)';

    $inetlove.='%';
  }
  else
  {
    $itype='';
    $inetlove='невозможно определить';
  }

  print "<li>Уровень интеллекта: {$intellect} $inttype<li>Раздражительность: {$nervous} $ntype<li>Коммуникабельность: {$communicable} $ctype<li>Ответственность: {$otvetstv} $otype<li>Зависимость от интернета: {$inetlove} $itype";

  if($tempsubtypespercents[0]>=40)
    print '<li>Об этом человеке очень много информации неизвестно.';
  else if($tempsubtypespercents[0]>=20)
    print '<li>К сожалению, об этом человеке много чего неизвестно.';

  if($temptypespercents[0]>=40)
    print '<li>Этот человек много времени проводит на форумах.';
  else if($temptypespercents[0]>=20)
    print '<li>Этот человек достаточно много времени проводит на форумах.';

  if($temptypespercents[1]>=40)
    print '<li>Этот человек много времени проводит на своих блогах.';
  else if($temptypespercents[1]>=20)
    print '<li>Этот человек достаточно много времени проводит на своих блогах.';

  if($temptypespercents[3]>=40 || $tempsubtypespercents[1]>=30)
    print '<li>Этот человек много времени в сети проводит на сайтах интернет-магазинов - возможно, он также проводит много времени и за экраном монитора, раз не может пользоватья реальными магазинами.';
  else if($temptypespercents[3]>=20 || $tempsubtypespercents[1]>=20)
    print '<li>Этот человек достаточно много времени проводит на сайтах интернет-магазинов.';

  if($temptypespercents[7]+$temptypespercents[9]>=50)
    print '<li>Этот человек достаточно времени в сети посвящает соцсетям и знакомствам, т.е., скорее всего, в реальной жизни у него дефицит общения.';

  if($temptypespercents[8]>=40)
    print '<li>Этот человек много времени посвящает онлайн-играм, это может говорить о его замкнутости или отсутствии друзей в реальной жизни.';
  else if($temptypespercents[8]>=20)
    print '<li>Этот человек достаточно времени посвящает онлайн-играм - это может свидетельствовать о некоторой зависимости от сети.';

  if($tempsubtypespercents[8]>=20)
    print '<li>Этот человек достаточно времени проводит на различных игровых порталах и форумах - это может говорить о его зависимости от игр.';


  if($temptypespercents[4]>=22)
    print '<li>Этот человек часто посещает юмористические порталы, что может свидетельствовать о его доброте.';

  if($temptypespercents[0]<=15 && $temptypespercents[0]>0 && $temptypespercents[1]<=15 && $temptypespercents[1]>0 && $temptypespercents[4]<=15 && $temptypespercents[4]>0 && $temptypespercents[5]<=15 && $temptypespercents[5]>0)
    print '<li>Этот человек уделяет время всему и понемногу - и развлечениям, и форумам, и  блогам. Возможно, он просто зависим от интернета.';

  if($tempsubtypespercents[5]>=18 && $tempsubtypespercents[2]+$tempsubtypespercents[6]>=7)
  {
    print '<li>Пожалуй, этот человек неплохо смыслит в программировании, а также увлекается взломом или защитой различных систем. На хакерских сайтах он выступает не в роли потребителя, а в роли именно программиста.';
    if($tempsubtypespercents[1]+$temptypespercents[3]>15)
      print '<li>Посещение этой личностью разных интернет-магазинов говорит, видимо, о том, что этот человек результаты своего труда продает.';
  }
  else if($tempsubtypespercents[5]>=20)
  {
    print '<li>Этот человек посещает хакерские сайты, но, скорее всего, в роли потребителя программ и скриптов.';
    if($tempsubtypespercents[1]+$temptypespercents[3]>15)
      print '<li>Посещение этой личностью разных интернет-магазинов подтверждает такую догадку.';
  }

  if($tempsubtypespercents[7]+$tempsubtypespercents[9]>=20)
    print '<li>Эта личность увлекается искусством в сети - фотографией, музыкой. Вероятно, в реальной жизни его хобби также связано с искусством.';

  if($tempsubtypespercents[10]>=20)
  {
    print '<li>Этот человек посещает сайты, где можно пообщаться - это говорит о том, что с этим человеком будет достаточно легко общаться по сети, но в реальной жизни у него, по-видимому, дефицит общения.';
    if($tempsubtypespercents[17]>0)
      print '<li>Ну а раз он еще и юмористические порталы посещает, то общаться по сети с ним будет совсем легко.';
  }

  if($tempsubtypespercents[0]>=25)
    print '<li>К сожалению, много чего из интересов этого человека определить не удалось.';

  if($tempsubtypespercents[12]>=15)
    print '<li>Этот человек много времени уделяет просмотру фильмов или видеоклипов на компьютере. Как правило, такие люди сильно зависят от сети и много времени проводят за экраном монитора, не выходя из дома.';

  if($tempsubtypespercents[16]>=15)
    print '<li>Этот человек замечен на сайтах, посвященных медицине - это говорит о том, что либо у него проблемы со здоровьем, что скорее всего, либо он просто интересуется этой областью знаний.';

  if($tempsubtypespercents[13]>=20 || $temptypespercents[6]>=15)
  {
    print '<li>Этот человек пользуется торрент-трекерами - это иногда вызывает такую же зависимость, как и онлайн-игры.';
    if($tempsubtypespercents[21]>0)
      print '<li>Он плюс к этому еще и скачивает различный варез с всевозможных порталов.';
  }


  if($tempsubtypespercents[2]+$tempsubtypespercents[6]>=20)
  {
    print '<li>Этот человек серьезно занимается программированием - возможно, это его основной заработок или профессия.';
    if($temptypespercents[0]+$temptypespercents[5]>=20)
      print '<li>Это подтверждается тем, что он проводит время на форумах и информационных ресурсах.';
  }

  if($tempsubtypespercents[18]>=15)
    print '<li>Этот человек достаточно времени уделяет спорту - это говорит о его хорошем здоровье и, вероятно, отсутствии зависимости от интернета.';

  if($tempsubtypespercents[2]+$tempsubtypespercents[4]>=20 && $tempsubtypespercents[4]>0 && $tempsubtypespercents[2]>0)
  {
    print '<li>Этот человек помимо программирования занимается еще и дизайном - скорее всего, он веб-мастер.';
    if($tempsubtypespercents[3]>0)
      print '<li>Плюс к этому, этот человек еще и заинтересован в СЕО.';
  }

  $cnt=0;

  foreach($tempsubtypespercents as $tt)
  {
    if($tt>0)
      $cnt++;
  }

  if(max($tempsubtypespercents)<=16 || $cnt>=7)
    print '<li>Интересы этого человека распространяются на много областей - сложно выделить его предпочтения.';
}
else
{
  print '&lt;не найдено&gt;';
}


}



print '<hr><b>Возможные сайты '.$hnick.':</b><br>';

if(count($tempsites)>0)
{
  $tempsites=array_unique($tempsites);

  foreach($tempsites as $tt)
  {
    print "<li><a href='http://$tt' target='_blank'>$tt</a>";
  }
}
else
{
  print '&lt;не найдено&gt;';
}


if($icq)
{
  $info=mygoogle($nick.'%20ICQ');
  $info=strip_tags($info);

  preg_match_all("/(icq|icq number|icq номер|icq num|аська|аську|ася|асю)(:?)([\n\r\W]*)([\-\d]{5,18})([^\-\d]+)/isU",$info,$m);

  print '<hr><b>Возможные номера ICQ:</b><br>';

  $tempnums=Array();

  foreach($m[4] as $num)
  {
    $num=str_replace('-','',$num);
    $tempnums[$num]=isset($tempnums[$num]) ? $tempnums[$num]+1 : 1;
  }

  if(count($tempnums)>0)
  {
    foreach($tempnums as $num => $amount)
    {
      print "<li>ICQ: <b>$num</b> найдено раз: $amount"; 
    }
  }
  else
  {
    print '&lt;не найдено&gt;';
  }
}






if($email)
{
  $info=mygoogle($nick.'%20e-mail');
  $info=strip_tags($info);

  preg_match_all("/(mail|почта|письмо|адрес|почту)(:?)([\n\r\W]*)([_\-\.0-9a-z]+@[0-9a-z]{1}[_0-9a-z\.]+\.[a-z]{2,4})([\W]+)/isU",$info,$m);

  print '<hr><b>Возможные адреса e-mail:</b><br>';

  $tempmails=Array();

  foreach($m[4] as $mail)
  {
    $mail=strtolower($mail);
    $tempmails[$mail]=isset($tempmails[$mail]) ? $tempmails[$mail]+1 : 1;
  }

  if(count($tempmails)>0)
  {
    foreach($tempmails as $mail => $amount)
    {
      print "<li>E-mail: <b>$mail</b> найден раз: $amount"; 
    }
  }
  else
  {
    print '&lt;не найдено&gt;';
  }
}





function strtolower_ru($text)
{
  return strtr(strtolower($text),'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ','йцукенгшщзхъфывапролджэячсмитьбюё');
}


function mygoogle($what)
{
  global $pages;
  global $sleeptime;

  $info='';

  $s=new websock('www.google.ru',80,false);

  for($i=0;$i<$pages;$i++)
  {
    $s->sconnect();
    //$s->get_header("/search?hl=ru&lr=&newwindow=1&pwst=1&q=$what&sa=N&start=".($i*10));
    $s->get_header("/search?q=$what&safe=off&hl=ru&start=".($i*10));
    $s->swrite();
    $ret=$s->http11read();
    $s->sclose();

    $info.=$ret[1];

    if(strpos($ret[1],'<span style="display:block;margin-left:53px;')===false)
      break;

    sleep($sleeptime);
  }

  return $info;
}

function transl($txt)
{
  $txt=preg_replace("/[^а-яА-ЯёЁa-z0-9\.\-]+/i",'',$txt);
  $txt=strtr($txt,'абвгдеёжзийклмнопрстуфхцыэюя','abvgdeejzijklmnoprstufhcyeua');
  $txt=str_replace(Array('ч','ш','щ','ъ','ь'),Array('ch','sh','sch','',''),$txt);
  return $txt;
}





/* WEBsock class by DX */

class websock
{
  /*все переменные private*/
  var $sock;
  var $connection=0;
  var $keepalive=300;
  var $request='';
  var $browser='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/3.6';
  var $proto='1.0';
  var $addr='';
  var $success=0;
  var $proxy='';
  var $pport=0;
  var $port=0;
  var $s_addr='';
  var $s_port=0;
  var $use_lowlevel_socks=true;
  var $fsock_err='';
  var $auto_unzip=true;
  var $unzipped=false;


  /*** Конструктор. $addr - адрес или IP сайта, $port - порт. ***/

  function websock($addr,$port=80,$use_lowlevel_socks=true)
  {
    if(!function_exists('socket_create') && $use_lowlevel_socks)
      return;

    $this->addr=$addr;
    $this->s_addr=$addr;
    $this->s_port=$port;
    $this->use_lowlevel_socks=$use_lowlevel_socks;


    if($this->use_lowlevel_socks)
    {
      if(!preg_match("/^(\d{1,3}\.){3}\d{1,3}$/",$addr))
        $addr=gethostbyname($addr);

      if(!$addr) return;

      $this->sock=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

      if(!$this->sock)
        return;
    }

    $this->success=1;
  }

  function set_autounzip($au=true)
  {
    $this->auto_unzip=$au ? true : false;
    return true;
  }

  function get_unzipped()
  {
    return $this->unzipped;
  }


  /*** Подключает сокет (через прокси или напрямую). ***/

  function sconnect()
  {
    if($this->use_lowlevel_socks)
    {
      if($this->proxy)
      {
        if(!socket_connect($this->sock,$this->proxy,$this->pport)) return false;
      }
      else
      {
        if(!socket_connect($this->sock,$this->s_addr,$this->s_port)) return false;
      }

      if(!socket_set_nonblock($this->sock)) return false;
    }
    else
    {
      if($this->proxy)
      {
        $this->sock=fsockopen("tcp://".$this->proxy,$this->pport,$errno,$errstr,30);
        $this->fsock_err=$errno.': '.$errstr;
        if(!$this->sock) return false;
      }
      else
      {
        $this->sock=fsockopen("tcp://".$this->s_addr,$this->s_port,$errno,$errstr,30);
        $this->fsock_err=$errno.': '.$errstr;
        if(!$this->sock) return false;
      }
    }

    return true;
  }


  /*** Устанавливает прокси с ip $addr и портом $port. ***/

  function set_proxy($addr,$port)
  {
    $this->proxy=$addr;
    $this->pport=$port;
    return true;
  }


  /*** Проверка успешности создания сокета и подключения к нему. ***/

  function check_success()
  {
    return $this->success;
  }


  /*** Запись в сокет. $data - данные для записи в сокет. Возвращает число байт, записанных в сокет. Если $data не указано, то будет записаны заголовки, созданные функцикей get_header() (см. ниже). ***/

  function swrite($data='')
  {
    if(!$data) $data=$this->request;

    if($this->use_lowlevel_socks)
    {
      if(socket_select($r=NULL,$w=array($this->sock),$f=NULL,5)!=1)
        return false;

      return socket_write($this->sock,$data);
    }
    else
    {
      return fputs($this->sock,$data);
    }
  }


  /*** Чтение $bytes байт из сокета. Возвращает считанный контент. ***/

  function sread($bytes)
  {
    if($this->use_lowlevel_socks)
    {
      if(socket_select($r=array($this->sock),$w=NULL,$f=NULL,5)!=1)
        return false;

      return socket_read($this->sock,$bytes);
    }
    else
    {
      return fgets($this->sock,$bytes);
    }
  }


  /*** Чтение из сокета всего доступного содержимого. Эта функция не работает с HTTP/1.1. $stepbytes - сколько байтов считывать за раз. Возвращает считанный контент. ***/

  function sreadfull($stepbytes=128)
  {
    $reading='';

    while(($ret=$this->sread($stepbytes))!='')
    {
      $reading.=$ret;
    }

    $reading=$this->get_content_headers($reading);

    if($this->auto_unzip)
    {
      if(strpos($reading[0],'Content-Encoding: gzip')!==false)
      {
        $this->unzipped=true;
        $reading[1]=gzBody($reading[1]);
      }
      else
      {
        $this->unzipped=false;
      }
    }

    return $reading;
  }





  /*** Установка типа соединения. $conn==0 - close, $conn==1 - keep-alive; $keepalive - время поддержки соединения. ***/

  function set_connection($conn=0,$keepalive=300)
  {
    $this->connection=$conn==0 ? 0 : 1;
    $this->keepalive=$keepalive;
    return true;
  }

  function set_proto($proto='1.0') //set 1.0 or 1.1
  {
    $this->proto= ($proto=='1.0' || $proto=='1.1') ? $proto : '1.0';
    return true;
  }


  /*** Универсальная функция чтения из сокета, читает правильно независимо от типа соединения. Возвращает массив: $c[0] - заголовки, $c[1] - содержимое ***/

  function http11read($stepbytes=128)
  {
    $c=$this->sreadfull($stepbytes);

    if(strpos($c[0],'Transfer-Encoding: chunked')!==false)
      return array($c[0],$this->remove_lengths($c[1]));
    else
      return $c;
  }


  /*** Получение cookies из заголовка ответа сервера и представление их в виде, удобном для вставки в заголовок Cookie. ***/
  /*** $header - заголовок ответа сервера; $ret==0 - будет возвращена строка для заголовка Cookie, $ret==1 - будет возвращён массив cookies. ***/

  function get_cookie($header,$ret=0)
  {
    preg_match_all('/Set-Cookie: (.+);/iUs',$header,$cook);
    if(!isset($cook[1])) return $ret==0 ? '' : array();

    $carr=array_unique($cook[1]);

    $cookies=implode('; ',$carr);
    return $ret==0 ? $cookies : $carr;
  }


  /*** Обрабатывает страницу с Transfer-encoding: chunked. Возвратит страницу без разбиений. ***/

  function remove_lengths($res)
  {
    $len=1;
    $nlen=0;
    $curlen=0;
    $ret='';

    $tmp=explode("\r\n",$res);

    foreach($tmp as $line)
    {
      if($len==1)
      {
        if($line=="\r\n")
        {
          $ret.=$line."\r\n";
          continue;
        }

        $nlen=base_convert($line,16,10);
        if($nlen==0) continue;
        $len=0;
        $curlen=0;
        continue;
      }

      $curlen+=strlen($line."\r\n");

      $ret.=$line."\r\n";

      if($curlen>=$nlen)
      {
        $len=1;
        continue;
      }
    }

    return $ret;
  }


  /*** Разбивает полученные данные на заголовок и содержимое. $res - весь контент. Возвратит массив: $ret[0] - заголовки, $ret[1] - содержимое. ***/

  function get_content_headers($res)
  {
    $ret=explode("\r\n\r\n",$res,2);
    return $ret;
  }


  /*** Устанавливает виртуальный браузер. ***/

  function set_browser($browser='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0')
  {
    $this->browser=$browser;
    return true;
  }


  /*** Формирует заголовки для записи в сокет. ***/
  /*** $service_uri - SERVICE_URI. Например, для http://site.com/aaa/bbb.php это /aaa/bbb.php ***/
  /*** $page - страница. Для примера выше это site.com. Если сокет был создан как new websock('site.com'), то страницу можно не указывать. Если же как new websock('1.2.3.4'), то необходимо указывать. ***/
  /*** $data - передаваемые скрипту данные (только для POST) ***/
  /*** $method - GET/POST и т.д. ***/
  /*** $cookie - cookies в виде строки ***/
  /*** $ref - Referer ***/
  /*** $addheaders - дополнительные заголовки, которые мы хотим установить ***/
  /***  Возвращает запрос и устанавливает его как запрос по умолчанию. ***/

  function get_header($service_uri,$page='',$data='',$method='GET',$cookie='',$ref='',$addheaders='')
  {
    if(!$page) $page=$this->addr;

    if($this->proxy)
      $request="$method http://{$this->s_addr}:{$this->s_port} HTTP/{$this->proto}\r\n";
    else
      $request="$method $service_uri HTTP/{$this->proto}\r\n";

    $request.="Host: $page\r\n";
    if($this->browser) $request.="User-Agent: {$this->browser}\r\n";
    if($ref) $request.="Referer: $ref\r\n";

    if($method=='POST')
    {
      $request.="Content-Type: application/x-www-form-urlencoded\r\n";
      $request.="Content-Length: ".strlen($data)."\r\n";
    }

    if($this->connection==0)
    { 
      $request.="Connection: close\r\n";
    }
    else
    {
      $request.="Keep-alive: {$this->keepalive}\r\n";
      $request.="Connection: keep-alive\r\n";
    }

    if($addheaders)
      $request.=$addheaders;

    if($cookie)
      $request.="Cookie: $cookie\r\n";

    $request.="\r\n";

    $request.=$data;

    $this->request=$request;

    return $request;
  }


  /*** Закрывает соединение ***/

  function sclose()
  {
    return $this->use_lowlevel_socks ? socket_close($this->sock) : fclose($this->sock);
  }


  /*** Возвращает последнюю ошибку работы с сокетами. ***/

  function serr()
  {
    return $this->use_lowlevel_socks ? socket_last_error($this->sock) : $this->fsock_err;
  }


  function gzBody($gzData)
  {
    if(substr($gzData,0,3)=="\x1f\x8b\x08")
    {
      $i=10;
      $flg=ord(substr($gzData,3,1));
      if($flg>0)
      {
        if($flg&4)
        {
          list($xlen)=unpack('v',substr($gzData,$i,2));
          $i=$i+2+$xlen;
        }

        if($flg&8) $i=strpos($gzData,"\0",$i)+1;
        if($flg&16) $i=strpos($gzData,"\0",$i)+1;
        if($flg&2) $i=$i+2;
      }

      return gzinflate(substr($gzData,$i,-8));
    }
    else
      return false;
  }
}
?>