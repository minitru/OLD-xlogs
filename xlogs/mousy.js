/**
 * Big Brother overlay menus
 *
 * Based on SimpleModal
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Revision: $Id: simplemodal.js 185 2009-02-09 21:51:12Z emartin24 $
 *
 */

/* SMM CAN'T GET THIS WORKING
http://www.webmasterworld.com/javascript/3752159.htm
*/

function ShowDIV(d) { 
	/* IE6 IS UNSUPPORTED... SO NEVER SHOW THE MENU */
	isIE6 = navigator.userAgent.toLowerCase().indexOf('msie 6') != -1;
	if (! isIE6) {
		document.getElementById(d).style.display = "block"; 
	}
}

function HideDIV(d) { 
	var IE = document.all?true:false;
	if (!IE) {
	/*
		alert("Not IE");
	*/
		document.getElementById(d).style.display = "none";
		return false;
	}
	if (HideDIV.flag != 1 ) {
		HideDIV.flag=1;
		document.getElementById(d).style.display = "none";
	}
	var posx = 0;
	var posy = 0;

	var e = window.event;
	posx = e.clientX + document.body.scrollLeft;
	posy = e.clientY + document.body.scrollTop;

	/* alert(posx + "," + posy);  */


	if ((posx > 50) || (posy > 140)){
		/* alert("hide");  */
		document.getElementById(d).style.display = "none";
		return false;
	}
}

