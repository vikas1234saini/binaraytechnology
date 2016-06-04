var arVersion = navigator.appVersion.split("MSIE")
	var version = parseFloat(arVersion[1])
	
	function fixPNG(myImage){
		if ((version >= 5.5) && (version < 7) && (document.body.filters)) {
			var imgID = (myImage.id) ? "id='" + myImage.id + "' " : ""
			var imgBorder = "0"
			var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : ""
			var imgTitle = (myImage.title) ? "title='" + myImage.title + "' " : "title='" + myImage.alt + "' "
			var imgStyle = "display:inline-block;" + myImage.style.cssText
			var strNewHTML = "<span " + imgID + imgClass + imgTitle +
			" style=\"" +
			"width:" +
			myImage.width +
			"px; height:" +
			myImage.height +
			"px;" +
			imgStyle +
			";" +
			"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader" +
			"(src=\'" +
			myImage.src +
			"\', sizingMethod='scale');\"></span>"
			myImage.outerHTML = strNewHTML
		}
	}
	
function mouseOverhome()
{
document.getElementById("home").src="images/hover/home.jpg" ;

}
function mouseOuthome()
{
document.getElementById("home").src ="images/home.jpg";
}

function mouseOveratt()
{
document.getElementById("attendance").src="images/hover/attendance.jpg" ;
}
function mouseOutatt()
{
document.getElementById("attendance").src ="images/attendance.jpg";
}

function mouseOvertest()
{
document.getElementById("test").src="images/hover/test.jpg" ;
}
function mouseOuttest()
{
document.getElementById("test").src ="images/test.jpg";
}

function mouseOverassign()
{
document.getElementById("assignment").src="images/hover/assignment.jpg" ;
}
function mouseOutassign()
{
document.getElementById("assignment").src ="images/assignment.jpg";
}

function mouseOveralmanac()
{
document.getElementById("almanac").src="images/hover/almanac.jpg" ;
}
function mouseOutalmanac()
{
document.getElementById("almanac").src ="images/almanac.jpg";
}

function mouseOverprofile()
{
document.getElementById("profile").src="images/hover/profile.jpg" ;
}
function mouseOutprofile()
{
document.getElementById("profile").src ="images/profile.jpg";
}

function mouseOverlogout()
{
document.getElementById("logout").src="images/hover/logout.jpg" ;
}
function mouseOutlogout()
{
document.getElementById("logout").src ="images/logout.jpg";
}

function mouseOvernotice()
{
document.getElementById("fmenu1").src="images/noticeboard.jpg" ;
}
function mouseOutnotice()
{
document.getElementById("fmenu1").src ="images/noticeboard1.jpg";
}

function mouseOverremarks()
{
document.getElementById("fmenu2").src="images/remarks.jpg" ;
}
function mouseOutremarks()
{
document.getElementById("fmenu2").src ="images/remarks1.jpg";
}


function mouseOvercntct()
{
document.getElementById("fmenu3").src="images/contactteCHER.jpg" ;
}
function mouseOutcntct()
{
document.getElementById("fmenu3").src ="images/contactteCHER1.jpg";
}

function mouseOverbutton()
{
document.getElementById("image_button").src="images/change-imagehover.jpg" ;
}
function mouseOutbutton()
{
document.getElementById("image_button").src ="images/change-image.jpg";
}

ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
var firstreel=new reelslideshow({
	wrapperid: "myreel", //ID of blank DIV on page to house Slideshow
	dimensions: [960, 250], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		["images/flash-images/Web-development.png","http://phpzone.co.in/service/2#Services-We-Offers","_SELF"],
		["images/flash-images/iphone.png","http://phpzone.co.in/service/2#iPhone-Application","_SELF"], //["image_path", "optional_link", "optional_target"]
		["images/flash-images/SEO.png","http://phpzone.co.in/hires/4","_SELF"],
		["images/flash-images/Psd-Conversion.png","http://phpzone.co.in/service/3#Services-We-Offers","_SELF"],
		["images/flash-images/Open-Source.png","http://phpzone.co.in/hires/1","_SELF"],
		["images/flash-images/hire-web-developer.png","http://phpzone.co.in/hires/4","_SELF"],
		["images/flash-images/E-commerce.png","http://phpzone.co.in/service/2#E-Commerce-Development","_SELF"],
		["images/flash-images/Android-Application.png","http://phpzone.co.in/service/2#iPhone-Application","_SELF"]//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:3000, cycles:10, pauseonmouseover:false},
	orientation: "h", //Valid values: "h" or "v"
	persist: true, //remember last viewed slide and recall within same session?
	slideduration: 300 //transition duration (milliseconds)
})