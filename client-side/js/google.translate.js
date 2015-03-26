function googleTranslateElementInit() {
	var gtElement = document.getElementById('google_translate_element');
	var currentLanguage = gtElement.getAttribute('data-current-language');
	var googleAnalyticsKey = gtElement.getAttribute('data-ga');

	new google.translate.TranslateElement({
		pageLanguage: gtElement.getAttribute('data-page-language'),
		includedLanguages: currentLanguage,
		layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT,
		autoDisplay: false,
		multilanguagePage: true,
		gaTrack: googleAnalyticsKey !== null && googleAnalyticsKey !== '',
		gaId: googleAnalyticsKey
	}, gtElement.getAttribute('id'));

	var _fireEvent = function (element, event) {
		if (document.createEventObject) {
			// dispatch for IE
			var evt = document.createEventObject();
			return element.fireEvent('on' + event, evt);
		}
		else {
			// dispatch for firefox + others
			var evt = document.createEvent('HTMLEvents');
			evt.initEvent(event, true, true); // event type,bubbling,cancelable
			return !element.dispatchEvent(evt);
		}
	};

	$(function () {
		var isReady = function () {
			if ($('.goog-te-combo option:first-child').text() === "Select Language") {
				var jObj = $('.goog-te-combo');
				var db = jObj.get(0);

				jObj.val(currentLanguage);
				_fireEvent(db, 'change');
			} else {
				setTimeout(isReady, 50);
			}
		};

		isReady();
	});
}