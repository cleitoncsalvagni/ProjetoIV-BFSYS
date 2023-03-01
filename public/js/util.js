const BASE_URL = "http://127.0.0.1/bfsys/";

$(function () {
	function blinker() {
		$(".blink_me").fadeOut(1000);
		$(".blink_me").fadeIn(1000);
	}
	setInterval(blinker, 1000);
}); //]]>
