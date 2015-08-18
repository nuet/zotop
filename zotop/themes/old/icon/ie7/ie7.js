/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referring to this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'zotop\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-home': '&#xe601;',
		'icon-site': '&#xe63b;',
		'icon-tag': '&#xe602;',
		'icon-tags': '&#xe603;',
		'icon-cut': '&#xe605;',
		'icon-crop': '&#xe606;',
		'icon-draft': '&#xe608;',
		'icon-clock': '&#xe60a;',
		'icon-waite': '&#xe60a;',
		'icon-prev': '&#xe60c;',
		'icon-back': '&#xe60c;',
		'icon-next': '&#xe60d;',
		'icon-link': '&#xe611;',
		'icon-url': '&#xe611;',
		'icon-attachment': '&#xe612;',
		'icon-view': '&#xe613;',
		'icon-heart': '&#xe615;',
		'icon-search': '&#xe61d;',
		'icon-expand': '&#xe61e;',
		'icon-list': '&#xe620;',
		'icon-grid': '&#xe621;',
		'icon-music': '&#xe624;',
		'icon-audio': '&#xe624;',
		'icon-video': '&#xe625;',
		'icon-user': '&#xe626;',
		'icon-users': '&#xe627;',
		'icon-wand': '&#xe629;',
		'icon-speed': '&#xe62a;',
		'icon-lightning': '&#xe62e;',
		'icon-up': '&#xe632;',
		'icon-right': '&#xe633;',
		'icon-down': '&#xe634;',
		'icon-left': '&#xe635;',
		'icon-good': '&#xe631;',
		'icon-bad': '&#xe637;',
		'icon-flag': '&#xe639;',
		'icon-bug': '&#xe63d;',
		'icon-share': '&#xe63f;',
		'icon-star': '&#xe640;',
		'icon-map': '&#xe642;',
		'icon-comments': '&#xe643;',
		'icon-ok': '&#xe646;',
		'icon-pending': '&#xe64b;',
		'icon-gift': '&#xe64c;',
		'icon-save': '&#xe64d;',
		'icon-folder': '&#xe645;',
		'icon-file': '&#xe652;',
		'icon-trash': '&#xe654;',
		'icon-upload': '&#xe60e;',
		'icon-download': '&#xe63a;',
		'icon-template': '&#xe63e;',
		'icon-block': '&#xe65a;',
		'icon-model': '&#xe65a;',
		'icon-app': '&#xe65a;',
		'icon-star2': '&#xe614;',
		'icon-edit': '&#xe610;',
		'icon-undo': '&#xe648;',
		'icon-redo': '&#xe65c;',
		'icon-image': '&#xe65e;',
		'icon-reject': '&#xe609;',
		'icon-open': '&#xe604;',
		'icon-color': '&#xe655;',
		'icon-disabled': '&#xe61c;',
		'icon-clear': '&#x36bc;',
		'icon-more': '&#x3572;',
		'icon-apps': '&#x35c8;',
		'icon-admin': '&#x35a5;',
		'icon-skin': '&#x34a6;',
		'icon-item': '&#xe60b;',
		'icon-page': '&#xe60b;',
		'icon-success': '&#xe630;',
		'icon-true': '&#xe630;',
		'icon-selected': '&#xe630;',
		'icon-publish': '&#xe630;',
		'icon-error': '&#xe638;',
		'icon-false': '&#xe638;',
		'icon-config': '&#xe636;',
		'icon-phone': '&#xe61f;',
		'icon-pc': '&#xe649;',
		'icon-mobile': '&#xe64a;',
		'icon-images': '&#xe60f;',
		'icon-ask': '&#xe63c;',
		'icon-confirm': '&#xe63c;',
		'icon-help': '&#xe63c;',
		'icon-info': '&#xe641;',
		'icon-warning': '&#xe644;',
		'icon-calendar': '&#xe628;',
		'icon-bold': '&#xe65d;',
		'icon-setting': '&#xe660;',
		'icon-chart': '&#xe661;',
		'icon-move': '&#xe662;',
		'icon-lock': '&#xe667;',
		'icon-code': '&#xe668;',
		'icon-add': '&#xe61a;',
		'icon-plus': '&#xe61a;',
		'icon-minus': '&#xe600;',
		'icon-remove': '&#xe618;',
		'icon-delete': '&#xe618;',
		'icon-cancel': '&#xe618;',
		'icon-sitemap': '&#xe619;',
		'icon-category': '&#xe619;',
		'icon-priv': '&#xe619;',
		'icon-refresh': '&#xe61b;',
		'icon-out': '&#xe607;',
		'icon-mail': '&#xe622;',
		'icon-cloud-download': '&#xe62b;',
		'icon-cloud-upload': '&#xe62c;',
		'icon-common': '&#xe62d;',
		'icon-index': '&#xe616;',
		'icon-safe': '&#xe617;',
		'icon-server': '&#xe62f;',
		'icon-database': '&#xe623;',
		'icon-library': '&#xe623;',
		'icon-msg': '&#xe647;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());