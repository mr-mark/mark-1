(function($){$.jScrollPane={active:[]};$.fn.jScrollPane=function(bp){bp=$.extend({},$.fn.jScrollPane.defaults,bp);var ba=function(){return false};return this.each(function(){var j=$(this);var k=this;var l=0;var m;var o;var q;var r=bp.topCapHeight;var s;if($(this).parent().is('.jScrollPaneContainer')){s=$(this).parent();l=bp.maintainPosition?j.position().top:0;var t=$(this).parent();m=t.innerWidth();o=t.outerHeight();$('>.jScrollPaneTrack, >.jScrollArrowUp, >.jScrollArrowDown, >.jScrollCap',t).remove();j.css({'top':0})}else{j.data('originalStyleTag',j.attr('style'));j.css('overflow','hidden');this.originalPadding=j.css('paddingTop')+' '+j.css('paddingRight')+' '+j.css('paddingBottom')+' '+j.css('paddingLeft');this.originalSidePaddingTotal=(parseInt(j.css('paddingLeft'))||0)+(parseInt(j.css('paddingRight'))||0);m=j.innerWidth();o=j.innerHeight();s=$('<div></div>').attr({'className':'jScrollPaneContainer'}).css({'height':o+'px','width':m+'px'});if(bp.enableKeyboardNavigation){s.attr('tabindex',bp.tabIndex)}j.wrap(s);s=j.parent();$(document).bind('emchange',function(e,a,b){j.jScrollPane(bp)})}q=o;if(bp.reinitialiseOnImageLoad){var u=$.data(k,'jScrollPaneImagesToLoad')||$('img',j);var v=[];if(u.length){u.each(function(i,b){$(this).bind('load readystatechange',function(){if($.inArray(i,v)==-1){v.push(b);u=$.grep(u,function(n,i){return n!=b});$.data(k,'jScrollPaneImagesToLoad',u);var a=$.extend(bp,{reinitialiseOnImageLoad:false});j.jScrollPane(a)}}).each(function(i,a){if(this.complete||this.complete===undefined){this.src=this.src}})})}}var p=this.originalSidePaddingTotal;var w=m-bp.scrollbarWidth-bp.scrollbarMargin-p;var x={'height':'auto','width':w+'px'}if(bp.scrollbarOnLeft){x.paddingLeft=bp.scrollbarMargin+bp.scrollbarWidth+'px'}else{x.paddingRight=bp.scrollbarMargin+'px'}j.css(x);var y=j.outerHeight();var z=o/y;var A=z<.99;s[A?'addClass':'removeClass']('jScrollPaneScrollable');if(A){s.append($('<div></div>').addClass('jScrollCap jScrollCapTop').css({height:bp.topCapHeight}),$('<div></div>').attr({'className':'jScrollPaneTrack'}).css({'width':bp.scrollbarWidth+'px'}).append($('<div></div>').attr({'className':'jScrollPaneDrag'}).css({'width':bp.scrollbarWidth+'px'}).append($('<div></div>').attr({'className':'jScrollPaneDragTop'}).css({'width':bp.scrollbarWidth+'px'}),$('<div></div>').attr({'className':'jScrollPaneDragBottom'}).css({'width':bp.scrollbarWidth+'px'}))),$('<div></div>').addClass('jScrollCap jScrollCapBottom').css({height:bp.bottomCapHeight}));var B=$('>.jScrollPaneTrack',s);var C=$('>.jScrollPaneTrack .jScrollPaneDrag',s);var D;var E=[];var F;var G=function(){if(F>4||F%4==0){Z(S+D*R)}F++};if(bp.enableKeyboardNavigation){s.bind('keydown.jscrollpane',function(e){switch(e.keyCode){case 38:D=-1;F=0;G();E[E.length]=setInterval(G,100);return false;case 40:D=1;F=0;G();E[E.length]=setInterval(G,100);return false;case 33:case 34:return false;default:}}).bind('keyup.jscrollpane',function(e){if(e.keyCode==38||e.keyCode==40){for(var i=0;i<E.length;i++){clearInterval(E[i])}return false}})}if(bp.showArrows){var H;var I;var J=function(a){$('html').unbind('mouseup',J);H.removeClass('jScrollActiveArrowButton');clearInterval(I)};var K=function(){$('html').bind('mouseup',J);H.addClass('jScrollActiveArrowButton');F=0;G();I=setInterval(G,100)};s.append($('<a></a>').attr({'href':'javascript:;','className':'jScrollArrowUp','tabindex':-1}).css({'width':bp.scrollbarWidth+'px','top':bp.topCapHeight+'px'}).html('Scroll up').bind('mousedown',function(){H=$(this);D=-1;K();this.blur();return false}).bind('click',ba),$('<a></a>').attr({'href':'javascript:;','className':'jScrollArrowDown','tabindex':-1}).css({'width':bp.scrollbarWidth+'px','bottom':bp.bottomCapHeight+'px'}).html('Scroll down').bind('mousedown',function(){H=$(this);D=1;K();this.blur();return false}).bind('click',ba));var L=$('>.jScrollArrowUp',s);var M=$('>.jScrollArrowDown',s)}if(bp.arrowSize){q=o-bp.arrowSize-bp.arrowSize;r+=bp.arrowSize}else if(L){var N=L.height();bp.arrowSize=N;q=o-N-M.height();r+=N}q-=bp.topCapHeight+bp.bottomCapHeight;B.css({'height':q+'px',top:r+'px'})var O=$(this).css({'position':'absolute','overflow':'visible'});var P;var Q;var R;var S=0;var T=z*o/2;var U=function(a,c){var p=c=='X'?'Left':'Top';return a['page'+c]||(a['client'+c]+(document.documentElement['scroll'+p]||document.body['scroll'+p]))||0};var V=function(){return false};var W=function(){bm();P=C.offset(false);P.top-=S;Q=q-C[0].offsetHeight;R=2*bp.wheelSpeed*Q/y};var X=function(a){W();T=U(a,'Y')-S-P.top;$('html').bind('mouseup',Y).bind('mousemove',bb).bind('mouseleave',Y)if($.browser.msie){$('html').bind('dragstart',V).bind('selectstart',V)}return false};var Y=function(){$('html').unbind('mouseup',Y).unbind('mousemove',bb);T=z*o/2;if($.browser.msie){$('html').unbind('dragstart',V).unbind('selectstart',V)}};var Z=function(a){s.scrollTop(0);a=a<0?0:(a>Q?Q:a);S=a;C.css({'top':a+'px'});var p=a/Q;j.data('jScrollPanePosition',(o-y)*-p);O.css({'top':((o-y)*p)+'px'});j.trigger('scroll');if(bp.showArrows){L[a==0?'addClass':'removeClass']('disabled');M[a==Q?'addClass':'removeClass']('disabled')}};var bb=function(e){Z(U(e,'Y')-P.top-T)};var bc=Math.max(Math.min(z*(o-bp.arrowSize*2),bp.dragMaxHeight),bp.dragMinHeight);C.css({'height':bc+'px'}).bind('mousedown',X);var bd;var be;var bf;var bg=function(){if(be>8||be%4==0){Z((S-((S-bf)/2)))}be++};var bh=function(){clearInterval(bd);$('html').unbind('mouseup',bh).unbind('mousemove',bi)};var bi=function(a){bf=U(a,'Y')-P.top-T};var bj=function(a){W();bi(a);be=0;$('html').bind('mouseup',bh).bind('mousemove',bi);bd=setInterval(bg,100);bg();return false};B.bind('mousedown',bj);s.bind('mousewheel',function(a,b){b=b||(a.wheelDelta?a.wheelDelta/120:(a.detail)?-a.detail/3:0);W();bm();var d=S;Z(S-b*R);var c=d!=S;return!c});var bk;var bl;function animateToPosition(){var a=(bk-S)/bp.animateStep;if(a>1||a<-1){Z(S+a)}else{Z(bk);bm()}}var bm=function(){if(bl){clearInterval(bl);delete bk}};var bn=function(a,b){if(typeof a=="string"){try{$e=$(a,j)}catch(err){return}if(!$e.length)return;a=$e.offset().top-j.offset().top}bm();var c=y-o;a=a>c?c:a;j.data('jScrollPaneMaxScroll',c);var d=a/c*Q;if(b||!bp.animateTo){Z(d)}else{s.scrollTop(0);bk=d;bl=setInterval(animateToPosition,bp.animateInterval)}};j[0].scrollTo=bn;j[0].scrollBy=function(a){var b=-parseInt(O.css('top'))||0;bn(b+a)};W();bn(-l,true);$('*',this).bind('focus',function(a){var b=$(this);var c=0;var d=100;while(b[0]!=j[0]){c+=b.position().top;b=b.offsetParent();if(!d--){return}}var e=-parseInt(O.css('top'))||0;var f=e+o;var g=c>e&&c<f;if(!g){var h=c-bp.scrollbarMargin;if(c>e){h+=$(this).height()+15+bp.scrollbarMargin-o}bn(h)}})if(bp.observeHash){if(location.hash&&location.hash.length>1){setTimeout(function(){bn(location.hash)},$.browser.safari?100:0)}$(document).bind('click',function(e){$target=$(e.target);if($target.is('a')){var h=$target.attr('href');if(h&&h.substr(0,1)=='#'&&h.length>1){setTimeout(function(){bn(h,!bp.animateToInternalLinks)},$.browser.safari?100:0)}}})}function onSelectScrollMouseDown(e){$(document).bind('mousemove.jScrollPaneDragging',onTextSelectionScrollMouseMove);$(document).bind('mouseup.jScrollPaneDragging',onSelectScrollMouseUp)}var bo;var bq;function onTextSelectionInterval(){direction=bo<0?-1:1;j[0].scrollBy(bo/2)}function clearTextSelectionInterval(){if(bq){clearInterval(bq);bq=undefined}}function onTextSelectionScrollMouseMove(e){var a=j.parent().offset().top;var b=a+o;var c=U(e,'Y');bo=c<a?c-a:(c>b?c-b:0);if(bo==0){clearTextSelectionInterval()}else{if(!bq){bq=setInterval(onTextSelectionInterval,100)}}}function onSelectScrollMouseUp(e){$(document).unbind('mousemove.jScrollPaneDragging').unbind('mouseup.jScrollPaneDragging');clearTextSelectionInterval()}s.bind('mousedown.jScrollPane',onSelectScrollMouseDown);$.jScrollPane.active.push(j[0])}else{j.css({'height':o+'px','width':m-this.originalSidePaddingTotal+'px','padding':this.originalPadding});j[0].scrollTo=j[0].scrollBy=function(){};j.parent().unbind('mousewheel').unbind('mousedown.jScrollPane').unbind('keydown.jscrollpane').unbind('keyup.jscrollpane')}})};$.fn.jScrollPaneRemove=function(){$(this).each(function(){$this=$(this);var a=$this.parent();if(a.is('.jScrollPaneContainer')){$this.css({'top':'','height':'','width':'','padding':'','overflow':'','position':''});$this.attr('style',$this.data('originalStyleTag'));a.after($this).remove()}})}$.fn.jScrollPane.defaults={scrollbarWidth:10,scrollbarMargin:5,wheelSpeed:18,showArrows:false,arrowSize:0,animateTo:false,dragMinHeight:1,dragMaxHeight:99999,animateInterval:100,animateStep:3,maintainPosition:true,scrollbarOnLeft:false,reinitialiseOnImageLoad:false,tabIndex:0,enableKeyboardNavigation:true,animateToInternalLinks:false,topCapHeight:0,bottomCapHeight:0,observeHash:true};$(window).bind('unload',function(){var a=$.jScrollPane.active;for(var i=0;i<a.length;i++){a[i].scrollTo=a[i].scrollBy=null}})})(jQuery);