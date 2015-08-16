 <html>
<head><link rel="Stylesheet" type="text/css"
            href="X-TRAKT0R/style.css">
<link href="X-TRAKT0R/themes/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="X-TRAKT0R/themes/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
    <title></title>
</head>
<body>
<fieldset class="menubar">
<h3>&nbsp;&nbsp;<a href="g.php" class="x">File Index</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="retrieval2.php" class="x">Delete Data</a></h3>
</fieldset><br>
<h2>&nbsp;&nbsp;<img src="icon.png" align="middle"> &nbsp;SOZO-R</h2>
<hr>
<form id="serchfrm" method="post" action="urlret.php">
<fieldset class="normal">
        <p align="center">
        <b/> Enter domain keyword: <input name="link_search" id="link_search" placeholder="Keyword(eg:yahoo,google)" type="text" autofocus required autocomplete="on" style="width:230";>
<br>
        <br/>
<br/>
        
        <input class="sub2" type="submit" id="submit" name="submit" value="GO">
</form>
    </p>
</fieldset>

  <div id="sliderFrame">
        <div id="slider">
                <img src="X-TRAKT0R/images/text.jpg" alt="TEXT" />
            <img src="X-TRAKT0R/images/image.jpg" alt="IMAGE" />
            <img src="X-TRAKT0R/images/audio.jpg" alt="AUDIO" />
            <img src="X-TRAKT0R/images/video.jpg" alt="VIDEO" />
        </div>
 <div id="thumbs">
            <!--Each thumb-->
            <div class="thumb"><img src="X-TRAKT0R/images/thumb-3.gif" /></div>
            <div class="thumb"><img src="X-TRAKT0R/images/thumb-4.gif" /></div>
            <div class="thumb"><img src="X-TRAKT0R/images/thumb-2.gif" /></div>
            <div class="thumb"><img src="X-TRAKT0R/images/thumb-1.gif" /></div>
        </div>
      
    </div>
</body>
</html>