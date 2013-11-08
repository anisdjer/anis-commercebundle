/*

 jQuery Tools 1.2.6 Mousewheel

 NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.

 http://flowplayer.org/tools/toolbox/mousewheel.html

 based on jquery.event.wheel.js ~ rev 1 ~
 Copyright (c) 2008, Three Dub Media
 http://threedubmedia.com

 Since: Mar 2010
 Date:
*/
(function(a){var c=[{str:navigator.userAgent,sub:"Chrome",ver:"Chrome",name:"chrome"},{str:navigator.vendor,sub:"Apple",ver:"Version",name:"safari"},{prop:window.opera,ver:"Opera",name:"opera"},{str:navigator.userAgent,sub:"Firefox",ver:"Firefox",name:"firefox"},{str:navigator.userAgent,sub:"MSIE",ver:"MSIE",name:"ie"}],e=function(a,b){var e=a.indexOf(c[b].ver);return-1!==e?parseInt(a.substring(e+c[b].ver.length+1),10):""};a=a("html");for(var b=0;b<c.length;b++)if(c[b].str&&-1!==c[b].str.indexOf(c[b].sub)||
c[b].prop){a.addClass(c[b].name+" "+c[b].name+e(navigator.userAgent,b)||e(navigator.appVersion,b));break}a.addClass("desktop")})(jQuery);
jQuery(function(a){var c,e,b,d;if(a.browser.msie&&9===parseInt(a.browser.version,10)){var h=function(a,b,c,e){e||(e=!1);var d=a.indexOf(b);return-1!==d&&(d+=b.length,b=e?a.lastIndexOf(c):a.indexOf(c,d),-1!==b&&b>d)?a.substr(d,b-d):""},f=function(a,b,c){b||(b=",");c||(c="()");var e=0,d=0,v=[];if(2>c.lenght)return v;for(var k=0;k<a.length;){var l=a[k];l===c[0]&&e++;l===c[1]&&e--;l===b&&1>e&&(v.push(a.substr(d,k-d)),d=k+b.length);k++}v.push(a.substr(d,k-d));return v},n=function(a){for(a=Number(a).toString(16);2>
a.length;)a="0"+a;return a};for(a=0;a<document.styleSheets.length;a++){var g=document.styleSheets[a],m=[g];for(c=0;c<g.imports.length;c++)m.push(g.imports[c]);for(c=0;c<m.length;c++){var g=m[c],l=[];for(e=0;e<g.rules.length;e++)if(b=g.rules[e].cssText||g.rules[e].style.cssText)if(b=h(b,"-svg-background:",";"),""!==b){var q=f(b);for(b=0;b<q.length;b++){var v=h(q[b],"linear-gradient(",")",!0);if(""!==v){var k=f(v);if(!(3>k.length)){var p=0,r=[];for(d=1;d<k.length;d++){var s=f(k[d].trim()," ");if(!(2>
s.length)){var u=s[0].trim(),t=1,w=h(u,"rgba(",")",!0),s=s[1].trim();if(""!==w){t=w.split(",");if(4>t.length)continue;u="#"+n(t[0])+n(t[1])+n(t[2]);t=t[3]}(w=-1!==s.indexOf("px"))&&(p=Math.max(p,parseInt(s,10)||0));r.push({offset:s,color:u,opacity:t,isPx:w})}}u="";t=null;for(d=0;d<r.length;d++)r[d].isPx&&(r[d].offset=(parseInt(r[d].offset,10)||0)/(p/100)+"%"),u+='<stop offset="'+r[d].offset+'" stop-color="'+r[d].color+'" stop-opacity="'+r[d].opacity+'"/>',d===r.length-1&&(t=r[d]);d="left"===k[0].trim();
k='x1="0%" y1="0%" '+(d?'x2="100%" y2="0%"':'x2="0%" y2="100%"');r="100%";0<p&&(r=p+"px");r=d?'width="'+r+'" height="100%"':'width="100%" height="'+r+'"';s="";null!==t&&0<p&&(s="<rect "+(d?'x="'+p+'" y="0"':'x="0" y="'+p+'"')+' width="100%" height="100%" style="fill:'+t.color+";opacity:"+t.opacity+';"/>');q[b]=q[b].replace("linear-gradient("+v+")","url(data:image/svg+xml,"+escape('<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><linearGradient id="g" gradientUnits="objectBoundingBox" '+
k+">"+u+'</linearGradient><rect x="0" y="0" '+r+' fill="url(#g)" />'+s+"</svg>")+")")}}}l.push({s:g.rules[e].selectorText,v:"background: "+q.join(",")})}for(e=0;e<l.length;e++)g.addRule(l[e].s,l[e].v)}}}});jQuery(function(a){!jQuery.browser.msie||8<jQuery.browser.version||a(".art-slider .art-slide-item").each(function(){var c;c=a(this).css("background-image");c=c.replace(/"/g,"").replace(/%20/g,"");c=c.split(/\s*,\s*/);1<c.length&&a(this).css("background-image",c[c.length-1])})});jQuery(function(a){a("nav.art-nav").addClass("desktop-nav")});
jQuery(function(a){!a.browser.msie||7<parseInt(a.browser.version,10)||a("ul.art-hmenu>li:not(:first-child)").each(function(){a(this).prepend('<span class="art-hmenu-separator"> </span>')})});jQuery(function(a){a("ul.art-hmenu a:not([href])").attr("href","#").click(function(a){a.preventDefault()})});
jQuery(function(a){a.browser.msie&&(7<parseInt(a.browser.version,10)||a.each(a("ul.art-hmenu ul"),function(){var c=0,e=a(this),b=null;a.each(e.children("li").children("a"),function(){b=a(this);var e=b.outerWidth();c<e&&(c=e)});if(null!==b){var d=parseInt(b.css("border-left-width"),10)||0,h=parseInt(b.css("border-right-width"),10)||0,f=parseInt(b.css("padding-left"),10)||0,n=parseInt(b.css("padding-right"),10)||0,c=c-(d+h+f+n);e.children("li").children("a").css("width",c+"px")}}))});
jQuery(function(){setHMenuOpenDirection({container:"div.art-sheet",defaultContainer:"#art-main",menuClass:"art-hmenu",leftToRightClass:"art-hmenu-left-to-right",rightToLeftClass:"art-hmenu-right-to-left"})});
var setHMenuOpenDirection=function(a){return function(c){var e=a(c.defaultContainer),e=0<e.length?e=a(e[0]):null;a("ul."+c.menuClass+">li>ul").each(function(){var b=a(this),d=b.outerWidth(),h=b.offset().left,f=b.parents(c.container),n=(f=0<f.length?f=a(f[0]):null)||e;null!==n&&(f=n.offset().left,n=n.outerWidth(),h+d>=f+n?b.addClass(c.rightToLeftClass).find("ul").addClass(c.rightToLeftClass):h<=f&&b.addClass(c.leftToRightClass).find("ul").addClass(c.leftToRightClass))})}}(jQuery);
jQuery(function(){jQuery("ul.art-hmenu ul li").hover(function(){jQuery(this).prev().children("a").addClass("art-hmenu-before-hovered")},function(){jQuery(this).prev().children("a").removeClass("art-hmenu-before-hovered")})});jQuery(window).bind("resize",function(){if("undefined"===typeof responsiveDesign||!responsiveDesign.isResponsive){var a=jQuery(".art-sheet").offset().left;jQuery("header.art-header #art-flash-area").each(function(){jQuery(this).css("left",a+"px")})}});
jQuery(function(a){a.browser.msie&&8>parseInt(a.browser.version,10)&&a(window).bind("resize",function(){var c=a("div.art-content"),e=c.parent().children(".art-layout-cell:not(.art-content)"),b=0;c.hide();e.each(function(){b+=a(this).outerWidth(!0)});c.w=c.parent().width();c.css("width",c.w-b+"px");c.show()});a(window).trigger("resize")});
var artButtonSetup=function(a){return function(c){a.each(a("a."+c+", button."+c+", input."+c),function(c,b){var d=a(b);d.hasClass("art-button")||d.addClass("art-button");d.is("input")&&d.val(d.val().replace(/^\s*/,"")).css("zoom","1");d.mousedown(function(){a(this).addClass("active")});d.mouseup(function(){var b=a(this);b.hasClass("active")&&b.removeClass("active")});d.mouseleave(function(){var b=a(this);b.hasClass("active")&&b.removeClass("active")})})}}(jQuery);jQuery(function(){artButtonSetup("art-button")});
var Control=function(a){return function(){this.init=function(c,e,b){"checked"===c.find('input[type="'+e+'"]').attr("checked")&&c.addClass("art-checked");c.mouseleave(function(){a(this).removeClass("hovered").removeClass("active")});c.mouseover(function(){a(this).addClass("hovered").removeClass("active")});c.mousedown(function(b){1===b.which&&a(this).addClass("active").removeClass("hovered")});c.mouseup(function(c){1===c.which&&(b.apply(this),a(this).removeClass("active").addClass("hovered"))})}}}(jQuery),
fixRssIconLineHeight=function(a){jQuery("."+a).css("line-height",jQuery("."+a).height()+"px")};jQuery(function(a){var c=a(".art-rss-tag-icon");c.length&&(fixRssIconLineHeight("art-rss-tag-icon"),a.browser.msie&&9>parseInt(a.browser.version,10)&&c.each(function(){""===a.trim(a(this).html())&&a(this).css("vertical-align","middle")}))});
(function(a){function c(b){switch(b.type){case "mousemove":return a.extend(b.data,{clientX:b.clientX,clientY:b.clientY,pageX:b.pageX,pageY:b.pageY});case "DOMMouseScroll":a.extend(b,b.data);b.delta=-b.detail/3;break;case "mousewheel":b.delta=b.wheelDelta/120}b.type="wheel";return a.event.handle.call(this,b,b.delta)}a.fn.mousewheel=function(a){return this[a?"bind":"trigger"]("wheel",a)};a.event.special.wheel={setup:function(){a.event.add(this,e,c,{})},teardown:function(){a.event.remove(this,e,c)}};
var e=a.browser.mozilla?"DOMMouseScroll"+("1.9">a.browser.version?" mousemove":""):"mousewheel"})(jQuery);
var ThemeLightbox=function(a){return function(){function c(c){var e=a('<div id="art-lightbox-bg"><div class="close"><div class="cw"> </div><div class="ccw"> </div><div class="close-alt">&#10007;</div></div></div>'),m=a('<img class="art-lightbox-image active" alt="" src="'+n(a(c).attr("src"))+'" />');h(m);m.appendTo(l);b();d(!0);m.load(function(){d(!1);e.appendTo(l).height(Math.max(document.documentElement.scrollHeight,document.body.scrollHeight))});m.error(function(){d(!1);e.appendTo(l).height(Math.max(document.documentElement.scrollHeight,
document.body.scrollHeight));m.attr("src",a(c).attr("src"))});e.click(q);f(a(".arrow").add(m).add(e))}function e(c){if(!(0>c||c>=m.length)){a(".lightbox-error").remove();g=c;a("img.art-lightbox-image:not(.active)").remove();var e=a("img.active"),l=a('<img class="art-lightbox-image" alt="" src="'+n(a(m[g]).attr("src"))+'" />');h(l);e.after(l);b();d(!0);f(a("#art-lightbox-bg").add(l));l.load(function(){d(!1);e.removeClass("active");l.addClass("active")});l.error(function(){d(!1);e.removeClass("active");
l.addClass("active");l.attr("src",a(m[g]).attr("src"))})}}function b(){0===a(".arrow").length&&(l.append(a('<div class="arrow left"><div class="arrow-t ccw"> </div><div class="arrow-b cw"> </div><div class="arrow-left-alt">&#8592;</div></div>').css("top",a(window).height()/2-40)),l.append(a('<div class="arrow right"><div class="arrow-t cw"> </div><div class="arrow-b ccw"> </div><div class="arrow-right-alt">&#8594;</div></div>').css("top",a(window).height()/2-40)));0===g?a(".arrow.left").addClass("disabled"):
a(".arrow.left").removeClass("disabled");g===m.length-1?a(".arrow.right").addClass("disabled"):a(".arrow.right").removeClass("disabled")}function d(b){b?a('<div class="loading"> </div>').css({top:a(window).height()/2-16,left:a(window).width()/2-16}).appendTo(l):a(".loading").remove()}function h(b){var c=a(window).width(),e=a(window).height();b.load(function(){var d=a(this).height(),l=a(this).width();if(e<d+10||c<l+410){var m=Math.abs(l/(c-410)),q=Math.abs(d/(e-100)),m=Math.max(q,m),l=l/m,d=d/m;b.width(l);
b.height(d)}b.css({top:e/2-d/2-5,left:c/2-l/2-5})});return b}function f(a){a.unbind("wheel").mousewheel(function(a,b){e(g+(0<b?1:-1));a.preventDefault()});a.mousedown(function(a){2===a.which&&q();a.preventDefault()})}function n(a){var b=/http:\/\/www.[A-z0-9-]+-image.com\/.webarchive\//;if((0===a.indexOf("http://")||0===a.indexOf("https://"))&&!b.test(a))return a;b=a.substring(0,a.lastIndexOf("."));a=a.substring(a.lastIndexOf("."));return b+"-large"+a}var g,m=a("img.art-lightbox"),l=a("body");this.init=
function(b){a("img.art-lightbox").live("click",{_ctrl:b},function(b){if(!0!==b.data._ctrl||b.ctrlKey)m=a("img.art-lightbox"),g=m.index(this),c(this)});a(".arrow.left:not(.disabled)").live("click",function(){e(g-1)});a(".arrow.right:not(.disabled)").live("click",function(){e(g+1)});a("img.active").live("click",function(){e(g+1)});a(".close").live("click",function(){q()})};var q=function(){a("#art-lightbox-bg, .art-lightbox-image, .arrow, .lightbox-error").remove()}}}(jQuery);jQuery(function(){(new ThemeLightbox).init()});
(function(a){a.support.transition=function(){var c=(document.body||document.documentElement).style;return(void 0!==c.transition||void 0!==c.WebkitTransition||void 0!==c.MozTransition||void 0!==c.MsTransition||void 0!==c.OTransition)&&{event:function(){var b="transitionend";a.browser.opera?(b=parseFloat(a.browser.version),b=12<=b?12.5>b?"otransitionend":"transitionend":"oTransitionEnd"):a.browser.webkit&&(b="webkitTransitionEnd");return b}(),prefix:function(){var b;a.each(a.browser,function(a,c){return"version"===
a?!0:(b={opera:"-o-",mozilla:"-moz-",webkit:"-webkit-",msie:"-ms-"}[a])?!1:!0});return b||""}()}}();window.BackgroundHelper=function(){function c(a,b){var e=[];if(void 0===a)return"";b.x=b.x||0;b.y=b.y||0;for(var d=0;d<a.length;d++)e.push(a[d].x+b.x+"px "+(a[d].y+b.y)+"px");return e.join(", ")}var b=[],d="next",h="horizontal",f=0,n=0,g="";this.init=function(a,c,e){d=c;h=a;b=[];n=f=0;g=e};this.processSlide=function(c){f=c.outerWidth();n=c.outerHeight();var e=[],d=c.css("background-position").split(",");
a.each(d,function(b){var c=a.trim(this).split(" ");1<c.length&&(b=parseInt(c[0],10),c=parseInt(c[1],10),e.push({x:b,y:c}))});b.push({images:c.css("background-image"),positions:e});c.css("background-image","none")};this.setBackground=function(b,c){var e=[];a.each(c,function(a,b){e.push(b.images)});b.css({"background-image":e.join(", "),"background-repeat":"no-repeat"})};this.setPosition=function(b,c){var e=[];a.each(c,function(a,b){e.push(b.positions)});b.css({"background-position":e.join(", ")})};
this.current=function(a){return b[a]||null};this.next=function(a){"next"===d?a=(a+1)%b.length:(a-=1,0>a&&(a=b.length-1));return b[a]};this.items=function(a,b,q){var g={x:0,y:0},k={x:0,y:0},p="next"===d;"horizontal"===h?(k.x=p?f:-f,k.y=0,q&&(g.x+=p?-f:f,k.x+=p?-f:f)):"vertical"===h&&(k.x=0,k.y=p?n:-n,q&&(g.y+=p?-n:n,k.y+=p?-n:n));q=[];a&&q.push({images:a.images,positions:c(a.positions,g)});b&&q.push({images:b.images,positions:c(b.positions,k)});"next"===d&&q.reverse();return q};this.transition=function(b,
c){b.css(a.support.transition.prefix+"transition",c?g+" ease-in-out background-position":"")}};var c=function(c,b){var d=null,h=!1,f=c.find(".active").parent().children(),n=!1,g=!1;this.settings=a.extend({},{animation:"horizontal",direction:"next",speed:600,pause:2500,auto:!0,repeat:!0,navigator:null,clickevents:!0,hover:!0,helper:null},b);this.move=function(b,g){var m=c.find(".active"),k=g||m[b](),p="next"===this.settings.direction?"forward":"back",r="next"===b?"first":"last",s=d,u=this;h=!0;s&&
this.stop(!0);if(!k.length&&(k=c.find(".art-slide-item")[r](),!this.settings.repeat)){n=!0;h=!1;return}a.support.transition?(k.addClass(this.settings.direction),k.get(0),m.addClass(p),k.addClass(p),c.trigger("beforeSlide",f.length),c.one(a.support.transition.event,function(){k.removeClass(u.settings.direction).removeClass(p).addClass("active");m.removeClass("active").removeClass(p);h=!1;setTimeout(function(){c.trigger("afterSlide",f.length)},0)})):(c.trigger("beforeSlide",f.length),m.removeClass("active"),
k.addClass("active"),h=!1,c.trigger("afterSlide",f.length));this.navigate(k);s&&this.start()};this.navigate=function(b){b=f.index(b);a(this.settings.navigator).children().removeClass("active").eq(b).addClass("active")};this.to=function(b){var d=c.find(".active"),f=d.parent().children(),d=f.index(d),g=this;if(!(b>f.length-1||0>b)){if(h)return c.one("afterSlide",function(){g.to(b)});d!==b&&this.move(b>d?"next":"prev",a(f[b]))}};this.next=function(){h||(n?this.stop():this.move("next"))};this.prev=function(){h||
(n?this.stop():this.move("prev"))};this.start=function(b){b&&setTimeout(a.proxy(this.next,this),10);d=setInterval(a.proxy(this.next,this),this.settings.pause);g=!0};this.stop=function(a){clearInterval(d);d=null;g=!!a;h=!1};this.active=function(){return g};this.moving=function(){return h};this.navigate(f.filter(".active"));if(this.settings.clickevents)a(this.settings.navigator).on("click","a",{slider:this},function(b){var c=f.index(f.filter(".active")),d=a(this).parent().children().index(a(this));
c!==d&&b.data.slider.to(d);b.preventDefault()});if(this.settings.hover){var m=this;c.add(this.settings.navigator).add(c.siblings(".art-shapes")).hover(function(){c.is(":visible")&&!n&&m.stop(!0)},function(){c.is(":visible")&&!n&&m.start()})}};a.fn.slider=function(e){return this.each(function(){var b=a(this),d=b.data("slider"),h="object"===typeof e&&e;d||(d=new c(b,h),b.data("slider",d));if("string"===typeof e&&d[e])d[e]();else d.settings.auto&&b.is(":visible")&&d.start()})}})(jQuery);
jQuery(function(a){if(a.browser.msie&&!(8<parseInt(a.browser.version,10))){var c="",e=a("script[src*='script.js']");0<e.length&&(c=e.get(0).src,c=c.substr(0,c.indexOf("script.js")));for(var e=a(".art-header"),b=[""],d=[""],h=0;h<b.length;h++){var f=a.trim(b[h]);""!==f&&(""!==c&&(f=f.replace(/(url\(['"]?)/i,"$1"+c)),e.find(".art-shapes").prepend('<div style="position:absolute;top:0;left:0;width:100%;height:100%;background:'+f+" "+d[h]+' no-repeat">'))}e.css("background-image","url('images/header.jpg')".replace(/(url\(['"]?)/i,
"$1"+c));e.css("background-position","center top")}});