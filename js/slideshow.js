window.onload = function() {
constantInterval();
}

var modal = document.getElementsByClassName('modal')[0];
var modalhead = document.getElementsByClassName('modal-header')[0];
var modbody = document.getElementsByClassName("modal-body")[0];
var slidesTXT = document.getElementsByClassName("text");
var modalfooter = document.getElementById('modal-footer');
var zoomBtn = document.getElementsByClassName("zoomBtn");
var fullscreenBUTTON = document.getElementsByClassName("zoomBtn");
var nextButtons = document.getElementsByClassName("next");
var prevButtons = document.getElementsByClassName("prev");
var dots = document.getElementsByClassName("dot");
var slides = document.getElementsByClassName("indexSlides");
var zoomslides = document.getElementsByClassName("zoomSlides");
var zoomsTXT = document.getElementsByClassName("slideTXT");

var x;
var i;
var rest;
var slideIndex = 1;
var pause = '';

function sizeZOOM (){

	var itemwidth = zoomslides[slideIndex - 1].width;
	var itemheight = zoomslides[slideIndex - 1].height;

	if(itemwidth < itemheight){
		//alert("portrait");
		zoomslides[slideIndex - 1].style.width = 'auto';
		zoomslides[slideIndex - 1].style.height = screen.height + 'px';

	} else if (itemwidth == itemheight){
		//alert("square");
		if (screen.width > screen.height){
			zoomslides[slideIndex - 1].style.width = screen.height + 'px';
			zoomslides[slideIndex - 1].style.height = screen.height + 'px';
		} else {
			zoomslides[slideIndex - 1].style.width = screen.width + 'px';
			zoomslides[slideIndex - 1].style.height = 'auto';
		}

	} else {
		//alert("landscape");
		var imageRATIO = zoomslides[slideIndex - 1].height/zoomslides[slideIndex - 1].width;
		var screenRATIO = screen.height/screen.width;
		
		if (imageRATIO < screenRATIO){
			zoomslides[slideIndex - 1].style.width = "100%";
			zoomslides[slideIndex - 1].style.height = "auto";
		} else{
			zoomslides[slideIndex - 1].style.height = screen.height + 'px';
			zoomslides[slideIndex - 1].style.width = "auto";
		}
	}

	var thisrest;
	thisrest = screen.height - zoomslides[slideIndex - 1].height;
	thisrest = thisrest / 2;
	zoomslides[slideIndex - 1].style.top = thisrest+"px 0px";
	displayBLOCK(zoomslides[slideIndex - 1]);
	displayBLOCK(zoomsTXT[slideIndex - 1]);
}

function sizeIMG (){

	var slideimg = document.getElementsByClassName("slideimg");

	var slidecontainer = document.getElementsByClassName("slideshow-container");
	for (var i = 0; i < slidecontainer.length; i++) {
		slidecontainer = slidecontainer[i];
	}
	var conwidth = slidecontainer.clientWidth;
	var conheight = slidecontainer.clientHeight;
	var width = slideimg[slideIndex - 1].width;
	var height = slideimg[slideIndex - 1].height;
	var mode;
	var finalConHeight = conwidth * 9 / 16;
	slidecontainer.style.height = finalConHeight + "px";

	var newslideimg = document.getElementsByClassName("slideimg");
	var newimgwidth = newslideimg[slideIndex - 1].width;
	var newimgheight = newslideimg[slideIndex - 1].height;
	
	if(newimgwidth == newimgheight) {
		slideimg[slideIndex - 1].style.width = finalConHeight + 'px';
		slideimg[slideIndex - 1].style.height = finalConHeight + 'px';
		slideimg[slideIndex - 1].style.margin = newrest+"0px";
	} else if (newimgwidth > newimgheight) {
		var test = slideimg[slideIndex - 1].height/slideimg[slideIndex - 1].width;
		var test2 = finalConHeight/conwidth;
		if (test < test2){
			slideimg[slideIndex - 1].style.width = "100%";
			slideimg[slideIndex - 1].style.height = "auto";
			var newrest;
			newrest = finalConHeight - slideimg[slideIndex - 1].height;
			newrest = newrest / 2;
			slideimg[slideIndex - 1].style.top = newrest+"px";
		}else{
			slideimg[slideIndex - 1].style.height = finalConHeight + 'px';
			slideimg[slideIndex - 1].style.width = "auto";
		}
	} else if(newimgwidth < newimgheight) {
		slideimg[slideIndex - 1].style.width = 'auto';
		slideimg[slideIndex - 1].style.height = finalConHeight + 'px';
		slideimg[slideIndex - 1].style.margin = newrest+"0px";
	}
	displayBLOCK(slides[slideIndex - 1]);
	displayBLOCK(slidesTXT[slideIndex - 1]);

}









showSlides(slideIndex);

function plusSlides(n) {
	showSlides(slideIndex += n);
}

function currentSlide(n) {
	showSlides(slideIndex = n);
}

function displayNONE(displayitem){
	displayitem.style.display = "none";
}
function displayBLOCK(displayitem){
	displayitem.style.display = "block";
}


window.addEventListener("resize", finalConResize);

function finalConResize() {
	sizeIMG();
}

function showSlides(n) {

	if (n > slides.length) {
		slideIndex = 1
	};
	if (n < 1) {
		slideIndex = slides.length
	};

	for (i = 0; i < slides.length; i++) {
		displayNONE(slides[i]);
	}
	for (i = 0; i < slidesTXT.length; i++) {
		displayNONE(slidesTXT[i]);
	}
	for (i = 0; i < zoomslides.length; i++) {
		displayNONE(zoomslides[i]);
	}
	for (i = 0; i < zoomsTXT.length; i++) {
		displayNONE(zoomsTXT[i]);
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	}
	
	/*
	if (typeof slides[slideIndex - 1] == 'undefined'){
		var slidecontainer = document.getElementsByClassName("slideshow-container")[0];
	 	slidecontainer.innerHTML = '<h2 class="empty">EMPTY</h2>';
	} 
	*/
	if (typeof slides[slideIndex - 1] != 'undefined'){

		slides[slideIndex - 1].ondragstart = function() {
			return false;
		};

		dots[slideIndex - 1].className += " active";

	}
	

	/*
	zoomslides[slideIndex - 1].ondragstart = function() {
		return false;
	};
	*/
	//sizeZOOM();
	sizeIMG();
}

function toggleFullScreen() {
	
	if ((document.fullScreenElement && document.fullScreenElement !== null) ||
		(!document.mozFullScreen && !document.webkitIsFullScreen)) {
		if (document.documentElement.requestFullScreen) {
			document.documentElement.requestFullScreen();
		} else if (document.documentElement.mozRequestFullScreen) {
			document.documentElement.mozRequestFullScreen();
		} else if (document.documentElement.webkitRequestFullScreen) {
			document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
		}
		//document.documentElement.style.overflowY = "hidden";
		sizeZOOM();
		displayBLOCK(modal);
		displayBLOCK(modalhead);
				
	} else {
		if (document.cancelFullScreen) {
			document.cancelFullScreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			document.webkitCancelFullScreen();
		}
		//document.documentElement.style.overflowY = "auto";
	displayNONE(modal);
	displayNONE(modalhead);
	
	}
}




window.addEventListener("resize", modalResize);

function modalResize() {
	
	if (modal.style.display !== 'none' && modal.style.display !== '') {
		sizeZOOM();
	} else {
		sizeIMG(); 
	}
}

function constantInterval() {

	if (modal.style.display !== 'none' && modal.style.display !== '') {
		sizeZOOM();
	} else {
		sizeIMG();
	}

	
	var autoslidepart = document.getElementsByClassName("autoslidepart");
	for (x = 0; x < autoslidepart.length; x++) {
		var eachpart = autoslidepart[x];
		displayBLOCK(eachpart);
	}
	var width = 0;
	var id = setInterval(frame, 100);

	function frame() {

		if (width >= 100) {

			clearInterval(id);
			plusSlides(1);
			constantInterval();
			sizeIMG();
		} else {
			width++;
			var progressbars = document.getElementsByClassName("slideshow-progress-bar");
			for (var x = 0; x < progressbars.length; x++) {
				progressbars[x].style.width = width + '%';
			}
			
			document.getElementsByClassName("label")[0].innerHTML = width * 1 + '%';
			document.onkeydown = controls;

			function controls(e) {
				e = e || window.event;
				if (e.keyCode == '38') {
					// up arrow
				} else if (e.keyCode == '40') {
					// down arrow
				} else if (e.keyCode == '27') {
					// esc
					displayNONE(modal);
					displayNONE(modalhead);
					toggleFullScreen();
				} else if (e.keyCode == '13') {
					// enter
					/*
					if (modal.style.display !== 'none' && modal.style.display !== '') {
						displayNONE(modal);
						displayNONE(modalhead);
						toggleFullScreen();
					} else {
						sizeZOOM();
						displayBLOCK(modal);
						displayBLOCK(modalhead);
						toggleFullScreen();
					}
					*/
				} else if (e.keyCode == '37') {
					// left arrow
					plusSlides(-1);
					clearInterval(id);
					if (pause != 'true'){constantInterval();}else{if (modal.style.display !== 'none' && modal.style.display !== '') {sizeZOOM();}}
				} else if (e.keyCode == '39') {
					// right arrow
					plusSlides(1);
					clearInterval(id);
					if (pause != 'true'){constantInterval();}else{if (modal.style.display !== 'none' && modal.style.display !== '') {sizeZOOM();}}
				}
			}

			var pauseButtons = document.getElementsByClassName("pause");
			var playButtons = document.getElementsByClassName("play");
			var dots = document.getElementsByClassName("dot");
			

			for (x = 0; x < pauseButtons.length; x++) {
				var btnPAUSE = pauseButtons[x];
				var btnPLAY = playButtons[x];
				displayBLOCK(btnPAUSE);
				btnPAUSE.onclick = function() {
					displayNONE(btnPAUSE);
					displayBLOCK(btnPLAY);
					clearInterval(id);
				var progressbars = document.getElementsByClassName("slideshow-progress-bar");
			for (var x = 0; x < progressbars.length; x++) {
				progressbars[x].style.width = 0 + '%';
			}				
					
					document.getElementsByClassName("label")[0].innerHTML = '0%';
					pause = 'true';
				}
				btnPLAY.onclick = function() {
					displayNONE(btnPLAY);
					displayBLOCK(btnPAUSE);
					clearInterval(id);
					constantInterval();
					pause = 'false';
				}
			}

			for (x = 0; x < dots.length; x++) {
				var dot = dots[x];
				dot.onclick = function() {
					var current = this.id;
					currentSlide(parseInt(current));
					if (pause == 'true') {} else {
						clearInterval(id);
						constantInterval();
					}
				}
			}

			for (x = 0; x < nextButtons.length; x++) {
				var btnNEXT = nextButtons[x];
				btnNEXT.onclick = function() {
					plusSlides(1);
					sizeIMG();
					sizeZOOM();
					if (pause == 'true') {} else {
						clearInterval(id);
						constantInterval();
					}
				}
				var btnPREV = prevButtons[x];
				btnPREV.onclick = function() {
					plusSlides(-1);
					sizeIMG();
					sizeZOOM();
					if (pause == 'true') {} else {
						clearInterval(id);
						constantInterval();
					}
				}
			}
		}
	}
}

if (autoslideshow == 'true') {
	if (slides.length > 1) {
		//onload
		//sizeIMG();
		//constantInterval();
	} else {
		for (x = 0; x < nextButtons.length; x++) {
			displayNONE(nextButtons[x]);
			displayNONE(prevButtons[x]);
		}
	}
} else {

	sizeIMG();

	document.onkeydown = controls;

	function controls(e) {
		e = e || window.event;

		if (e.keyCode == '38') {
			// up arrow
		} else if (e.keyCode == '40') {
			// down arrow
		} else if (e.keyCode == '27') {
			// esc
			displayNONE(modal);
			displayNONE(modalhead);
			toggleFullScreen();
		} else if (e.keyCode == '13') {
			// enter
			/*
			if (modal.style.display !== 'none' && modal.style.display !== '') {
				displayNONE(modal);
				displayNONE(modalhead);
				toggleFullScreen();
			} else {
				displayBLOCK(modal);
				displayBLOCK(modalhead);
				toggleFullScreen();
				sizeZOOM();
			}
			*/
		} else if (e.keyCode == '37') {
			// left arrow
			if (modal.style.display !== 'none' && modal.style.display !== '') {
				sizeZOOM();
			} else {
				sizeIMG();
			}
			plusSlides(-1);
		} else if (e.keyCode == '39') {
			// right arrow
			if (modal.style.display !== 'none' && modal.style.display !== '') {
				sizeZOOM();
			} else {
				sizeIMG();
			}
			plusSlides(1);
		}
	}

	for (x = 0; x < nextButtons.length; x++) {
		var btnNEXT = nextButtons[x];
		btnNEXT.onclick = function() {
			plusSlides(1);
			sizeIMG();
		}
		var btnPREV = prevButtons[x];
		btnPREV.onclick = function() {   	
			plusSlides(-1);
			sizeIMG();
		}
	}

	var dots = document.getElementsByClassName("dot");
	for (x = 0; x < dots.length; x++) {
		var dot = dots[x];
		dot.onclick = function() {
			var current = this.id;
			//sizeIMG();
			currentSlide(parseInt(current));
		}
	}

}
