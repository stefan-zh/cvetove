/* $Id: pngfix.js,v 1.1.2.2 2005/11/30 21:09:00 robinmonks Exp $ */

// Correctly handle PNG transparency in Win IE 5.5 or higher.
// http://homepage.ntlworld.com/bobosola. Updated 02-March-2004
// updated 2005-05-11 to test for IE

function correctPNG() {
if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && navigator.userAgent.indexOf("Opera") == -1 && window.attachEvent) {
    for(var i=0; i<document.images.length; i++) {
  	  var img = document.images[i]
  	  var imgName = img.src.toUpperCase()
  	  if (imgName.substring(imgName.length-3, imgName.length) == "PNG") {
        var imgID = (img.id) ? "id=\"" + img.id + "\" " : ""
        var imgClass = (img.className) ? "class=\"" + img.className + "\" " : ""
        var imgTitle = (img.title) ? "title=\"" + img.title + "\" " : "title=\"" + img.alt + "\" "
	var imgOver = ""
	if (img.onmouseover != null) {
		var s = img.onmouseover + ""
		s = s.replace(/[\s\S]+\{[\s]*([\s\S]*)[\s]*\}$/, "$1");
		imgOver = "onmouseover=\"" + s + "\" "
	}
	var imgOut = ""
	if (img.onmouseout != null) {
		var s = img.onmouseout + ""
		s = s.replace(/[\s\S]+\{[\s]*([\s\S]*)[\s]*\}$/, "$1")
		imgOut = "onmouseout=\"" + s + "\" "
	}
	var imgDown = ""
	if (img.onmousedown != null) {
		var s = img.onmousedown + ""
		s = s.replace(/[\s\S]+\{[\s]*([\s\S]*)[\s]*\}$/, "$1");
		imgDown = "onmousedown=\"" + s + "\" "
	}
	var imgClick = ""
	if (img.onclick != null) {
		var s = img.onclick + "";
		s = s.replace(/[\s\S]+\{[\s]*([\s\S]*)[\s]*\}$/, "$1");
	        imgClick = "onclick=\"" + s + "\" "
	}
	var imgAttr = imgID + imgClass + imgTitle + imgOver + imgOut + imgDown + imgClick
        var imgStyle = "display:inline-block;" + img.style.cssText 
        if (img.align == "left") imgStyle = "float:left;" + imgStyle
        if (img.align == "right") imgStyle = "float:right;" + imgStyle
        if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle		
        var strNewHTML = "<span " + imgAttr
		      + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
          + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
		      + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
		      img.outerHTML = strNewHTML
		      i = i-1
	    }
    }
  }
}
if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && navigator.userAgent.indexOf("Opera") == -1 && window.attachEvent) {
  window.attachEvent("onload", correctPNG);
}
