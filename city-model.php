 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>City.bg</title>
<link href="http://www.city.bg/new/css/style.css" rel="stylesheet" type="text/css" />
<link href="http://www.city.bg/new/css/navigation.css" rel="stylesheet" type="text/css" />
<link href="http://www.city.bg/new/css/background_2.css" rel="stylesheet" type="text/css" />
<link href="http://www.city.bg/new/css/jquery.lightbox-0.3.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://www.city.bg/new/css/bubble-tooltip.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="http://www.city.bg/new/css/iefix.css" />
<![endif]-->

<!--[if lt IE 7]>
<script defer type="text/javascript" src="http://www.city.bg/new/js/pngfix.js"></script>
<![endif]-->
	<script type="text/javascript" src="http://www.city.bg/new/js/browserdetect_lite.js"></script>
	<script type="text/javascript" src="http://www.city.bg/new/js/opacity.js"></script>
	<script type="text/javascript" src="java/search.js"></script>
</head>
<body>
	<div id="bg">
    <div id="topLine">

	<div id="bgImage">
		<div id="container">
			<!-- START HEADAR-->
			<div id="headar">

				<div id="logo">
				<a href="http://www.city.bg/new/index.php">
				<script language="javascript" type="text/javascript">
					od_displayImage('logo_city', 'http://www.city.bg/new/images/logo_city', 159, 78, '', 'logo_city');
				</script></a>
				</div>
				<div id="topSearch">
					<script language="javascript" type="text/javascript">
						od_displayImage('bg_search', 'http://www.city.bg/new/images/bg_search', 580, 91, '', 'bg_search');
					</script>
					<div id="searchContent">
						<div class="searchForm">

							<form name="searchForm" id="searchForm" method="get" action="#" onsubmit="return mysql_search(this, 'http://localhost/vestnik/');">
								<input name="hidden" type="hidden" value="option1" />
								<input  name="words" type="text"  class="input" />
								<input name="submit" type="image" src="images/empty.gif" class="butt" />
							</form>
						</div>
						<div class="clear"><img src="http://www.city.bg/new/images/trans.gif" alt="" /></div>
						<!--a href="#">City</a-->
						<a id="option1" href="#" onclick="return search_selection(this)" class="selected">Общо търсене</a>
						<a id="option2" href="#" onclick="return search_selection(this)">Crazy Videos</a>
						<a id="option3" href="#" onclick="return search_selection(this)">News</a>
						<a id="option4" href="#" onclick="return search_selection(this)">Artist Info</a>
						<!--a id="s_podcast" href="#" onclick="return search_selection(this)">Podcast/a-->
						<div class="clear"><img src="http://www.city.bg/new/images/trans.gif" alt="" /></div>
					</div>
				</div>

				<div id="logoSub">
				</div>
				<div class="clear"><img src="http://www.city.bg/new/images/trans.gif" alt="" /></div>
			</div>
			<!-- END HEADAR-->
		</div>
	</div>
    </div>
    </div>
</body>
</html>