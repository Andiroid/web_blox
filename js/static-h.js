/* ============================================================
	TOOLBOX START
============================================================ */


	/* ============================================================
		TEXT CUTTER START
	============================================================ */

	function txtCutter(cutlength, classname){
		var txtcrop = document.getElementsByClassName(classname);
		var forbidden = [" ", ".", "?", "!"];
		var x;
		for(x = 0; x < txtcrop.length; x++) {
			var calculate = txtcrop[x].innerHTML.length;
			if (calculate > cutlength){
				var a = cutlength;
				var b = calculate;
				var c = Math.abs(a - b);
				var payload = txtcrop[x].innerHTML;
				var calculate = payload.substring(0, calculate-c); 
				var i;
				for (i = 0; i < forbidden.length; i++) {
					if (calculate.substring(calculate.length-1) == forbidden[i]){
						calculate = calculate.substring(0, calculate.length-1);
					}
				}
				txtcrop[x].innerHTML = calculate+'...';
			}
		}
	}

	// example call
	// txtcutter(<MAXIMUM TEXT LENGTH>, <HTML ELEMENT CLASSNAME>)
	// txtCutter(150, 'txtcrop');

	/* ============================================================
		TEXT CUTTER END
	============================================================ */



	/* ============================================================
		SLEEP START
	============================================================ */

	function sleep (time) {
		return new Promise((resolve) => setTimeout(resolve, time));
	}

	/*
	sleep(500).then(() => {
		//usage
	});
	*/

	/* ============================================================
		SLEEP END
	============================================================ */



	/* ============================================================
		FADE IN & FADE OUT START
	============================================================ */

	function fadeout(element, settimer) {
		var op = 1;  // initial opacity
		var timer = setInterval(function () {
			if (op <= 0.1){
				clearInterval(timer);
				element.style.display = 'none';
			}
			element.style.opacity = op;
			element.style.filter = 'alpha(opacity=' + op * 100 + ")";
			op -= op * 0.1;
		}, settimer);
	}
	/*
	fadeout(element, 100);
	*/
/*
	function fadein(element, settimer) {

	var op = 0.1;  // initial opacity
	element.style.opacity = op;
	element.style.display = 'block';
		var timer = setInterval(function () {
			if (op >= 1){
			    clearInterval(timer);
			}

			element.style.opacity = op;
			element.style.filter = 'alpha(opacity=' + op * 100 + ")";
			op += op * 0.1;
			//alert("here");
		}, settimer);

	}
	
	fadein(element, 100);
	*/

	/* ============================================================
		FADE IN & FADE OUT END
	============================================================ */

	/* ============================================================
		16:9 RATIO EXPANDER START
	============================================================ */
	function ratioEXPAND(element, dividend, divisor) {
		element = document.getElementById(element);
		var width = element.clientWidth;
		var height = width * divisor / dividend;
		element.style.height = height + 'px';
	}

	/*
	window.addEventListener("resize", triggerRATIO);

	function triggerRATIO() {
		ratioEXPAND('demo', 16, 9);
	}

	triggerRATIO();
	*/

	/* ============================================================
		16:9 RATIO EXPANDER END
	============================================================ */














/* ============================================================
	TOOLBOX END
============================================================ */
