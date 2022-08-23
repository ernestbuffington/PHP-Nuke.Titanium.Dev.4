/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 - 2014 coRpSE                                     */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This javascript flash coded by SgtLegend.                            */
/* Thanks to him for providing this.                                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


;(function(window, document) {

	var
		blinkers = [], // The array of spans
		blinkState = true; // The state of the blinkers

	/**
	 * Tests the given element's class attribute to see whether the given class exists
	 * 
	 * @param  {Object}  el   The element's DOM object
	 * @param  {String}  name The class name to look for
	 * @return {Boolean}      A boolean representing whether or not the class name exists
	 */
	function hasClass(el, name) {
		return new RegExp('(\\s|^)' + name + '(\\s|$)').test(el.className);
	}

	/**
	 * Begins the antibox execution
	 */
	function blink() {
		var
			spans = document.getElementsByTagName('span'),
			length = spans.length,
			i = 0;

		if (!spans || !length) {
			return;
		}

		// Traverse through the spans
		for (; i < length; i++) {
			if (spans.hasOwnProperty(i) && hasClass(spans[i], 'blink')) {
				blinkers.push(spans[i]);
			}
		}

		// Execute!
		blinkIt();
// time in m.secs between blinks
// 500 = 1/2 second
		setInterval(blinkIt, 400);
	}

	/**
	 * Executes the loop that toggles the blinker elements in the DOM
	 */
	function blinkIt() {
		var
			i = 0,
			l = blinkers.length;

		for (; i < l; i++) {
			if (blinkers.hasOwnProperty(i)) {
				blinkers[i].style.visibility = blinkState === true ? 'hidden' : 'visible';
			}
		}

		blinkState = !blinkState;
	}

	// Bind the blink function to the window object
	window.blink = blink;

}(window, document));