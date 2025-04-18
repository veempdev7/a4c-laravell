// build number: @@buildNumber@@

(function($) {
	function bindEffect(name, params) {
		var menu = $("ul.FM2_" + name);
		
		var uls = menu.find("ul");
		var timeout;
		
		function getBrowser() {
			// jquery code//
			var ua = navigator.userAgent.toLowerCase();
			var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
				/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
				/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
				/(msie) ([\w.]+)/.exec( ua ) ||
				ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
				[];
			
			var ver = match[ 2 ] || "0";
			var fi = ver.indexOf('.');
			var fi2 = ver.indexOf('.', fi);
			if (fi2 != -1) {
				ver = parseFloat(ver.substring(0, fi2));
			}
			return {
				name: match[ 1 ] || "",
				version: ver
			};
		}


		function mouseLeft(el) {
			if (!window.PIE || !PIE.Element) return;
			var pie = PIE.Element.getInstance( el[0]);
			if (pie) {
				pie.mouseLeft(true);
			}
		}
		
		function mouseEntered(el) {
			if (!window.PIE || !PIE.Element) return;
			var pie = PIE.Element.getInstance( el[0]);
			if (pie) {
				pie.mouseEntered(true);
			}
		}

		function getEffectForLevel(level) { 
			switch(level) { 
				case 0:
					return params["effectSub"];
				break;

				case 1:
					return params["effectSubTwo"] ? params["effectSubTwo"] : params["effectRest"];
				break;

				default:
					return params["effectRest"]
				break;
			}
		}
		
		function showMenu(liItem, callback) {
			
			
			var self = liItem;

			if (!callback) callback = function(){};
			if($(self).find('ul').data('hideTimeout')) { 
				clearTimeout($(self).find('ul').data('hideTimeout'));
			}
			
			var level = getButtonLevel(self);
			
			var effectObj = getEffectForLevel(level);
			if(!effectObj) { 
				effectObj = {name : "none"};
			}
			var effectOpts = {
				'duration' : effectObj.duration,
				'easing' : effectObj.easing,
				'direction' : effectObj.direction
			};

			
			var checkIfVisible = true;;
			var submenu = $(self).find('>ul');
			if(submenu.length == 0) { 
				if($(self).children('.ui-effects-wrapper').length > 0) { 
					checkIfVisible = false;
					submenu = $(self).find('.ui-effects-wrapper >ul');
				}
			} 

			if(checkIfVisible && submenu.is(':visible')) { 
				return;
			}

			var browser = getBrowser();
			var isIE7 = (browser.name == "msie" && browser.version == 7);
			if(isIE7) { 
				effectObj.name = "none";
				submenu.children('li').css('float','left');
				if(params["menuType"] == "tabbed" && level == 0) { 
					submenu.width(menu.outerWidth());
				}
			}

			switch(effectObj.name) {
				case "none":
					submenu.show();
					break;

				case "bounce":
					if($(self).parent().is(":animated")) {
						return;
					}

				case "blind":
				case "explode":
				case "clip":
				case "drop":
				case "fold":
				case "slide":

					
					if($(self).find('ul').is(":animated")) {
						$(self).find('ul').removeAttr("style");
					}

					if(submenu.data('hideTimeout')) { 
						clearTimeout(submenu.data('hideTimeout'));
						submenu.removeData('hideTimeout');
					}

					$(self).siblings().find('ul').stop(false, true);

					window.setTimeout(function(){
						
						if(submenu.css('display') != 'none' && !submenu.is(":animated")) { 
							return;
						}
						
						submenu.stop(false,true);

						if(effectObj.useFade) { 
							submenu.fadeIn({duration : effectOpts.duration * 2, queue : false}).css('display', 'none');
						}
						submenu.show(effectObj.name, effectOpts, function(){
							if(effectObj.name == "fold") {
								$(this).css({"position":"", "left" :"", "top": "", "right":"", "bottom" :""});
							}
						});
					}, 5);
					break;

				case "fade":
					uls.stop(true, true);
					submenu.show(effectObj.name, effectOpts);
					break;
				
				default:
					uls.stop(true, false);
					window.setTimeout(function(){
						submenu.show(effectObj.name, effectOpts);
					}, 5);
			}
		}
		
		function hideMenu(liItem, callback) {

			var self = liItem;
			if (!callback) callback = function(){};
			
			var level = getButtonLevel(self);
			
			var effectObj = getEffectForLevel(level);
			if(!effectObj) { 
				effectObj = {name : "none"};
			}
			var effectOpts = {
				'duration' : effectObj.duration,
				'easing' : effectObj.easing,
				'direction' : effectObj.direction
			};

			var browser = getBrowser();
			var isIE7 = (browser.name == "msie" && browser.version == 7);
			if(isIE7) { 
				effectObj.name = "none";
			}
			

			var submenu = $(self).find('ul');
			
			if(submenu.length == 0) { 
				if($(self).children('.ui-effects-wrapper').length > 0) { 
					submenu = $(self).find('.ui-effects-wrapper >ul');
				}
			} 

			switch(effectObj.name) {
				case "none":
					submenu.hide();
					callback();
					break;

				case "bounce":
					if($(self).parent().is(":animated")) {
						return;
					}
				case "blind":
				case "explode":
				case "clip":
				case "drop":
				case "fold":
				case "slide":
					submenu.stop(false, true);
					if(submenu.data('hideTimeout')) { 
						clearTimeout(submenu.data('hideTimeout'));
					}



					var timeout = window.setTimeout(function(){
						submenu.stop(false,true);
						submenu.find('ul').hide();
						if(effectObj.useFade) { 
							submenu.fadeOut({duration : effectOpts.duration * 1.40, queue : false});
						}
						submenu.hide(effectObj.name, effectOpts, function(){
							$(this).removeAttr("style");
							$(this).find("ul").removeAttr("style").hide();
							callback();
						});
					}, 100);	

					submenu.data('hideTimeout', timeout);

					break;
				
				case "fade":
					uls.stop(true, true);
					$(self).find('ul').hide(effectObj.name, effectOpts, function() {
						callback();
					});
					break;

				default:
					uls.stop(true, false);
					if(submenu.data('hideTimeout')) { 
						clearTimeout($(self).find('ul').data('hideTimeout'));
					}
					var timeout = window.setTimeout(function(){
						submenu.hide(effectObj.name, effectOpts, function() {
							callback();
						});
					}, 100);	
					submenu.data('hideTimeout', timeout);
			}
		}
		
		$(menu).find("li").mouseenter(function(ev) {
			ev.preventDefault();
			ev.stopImmediatePropagation();

			var self = this;
		
			clearTimeout(timeout);
			try { 

				$(this).siblings().each(function() {
					hideMenu($(this));
				});
			} catch(e) {

			}
			
			showMenu($(self));
			
			
			
			$(self).find('li').each(function() {
				$(this).removeClass('hover');
				mouseLeft($(this).children('a'));
			});
			
			$(self).siblings('li').each(function() {
				var liItem = $(this);
				mouseLeft($(this).children('a'), function() {
					liItem.parent().find('.hover').each(function() {
						$(this).removeClass('hover');
						mouseLeft($(this).children('a'));
					});					
				});
				$(this).removeClass('hover');
			});

			
			mouseEntered($(self).children('a'));
			$(self).addClass('hover');
			
			$(self).parents('li').each(function() {
				mouseEntered($(this).children('a'));
				$(this).addClass('hover');
			});
			
		}).mouseleave(function(ev){
			var self = this;
			if ($(self).find('> ul').length) {
				clearTimeout(timeout);
				timeout = window.setTimeout(function(){
					hideMenu($(self), function() {
						$(self).find('li').andSelf().each(function() {
							$(this).removeClass('hover');
							mouseLeft($(this).children('a'));
						});					
					});	
				}, 200);
			} else {
				clearTimeout(timeout);
				timeout = window.setTimeout(function(){
					$(self).removeClass('hover');
					mouseLeft($(self).children('a'));
				},0);
			}
		});
	}

	function unbindEffect(name) { 
		var menu = $("ul.FM2_" + name);
		$(menu).find("li").unbind('mouseenter');
		$(menu).find("li").unbind('mouseleave');
	}

	function stickToTop(name, fullWidth, options) {
		var menu = $("div.FM2_" + name + "_container");
		if(!menu.hasClass('stick')) { 
			menu.data("top", menu.offset().top);
			menu.data("originalWidth", menu.width());
			menu.data('originalLeft',  menu.offset().left);
		} else {
			//menu.removeClass('stick');
			menu.removeClass('stick');
			menu.data("originalWidth", menu.width());
			menu.data('originalLeft',  menu.offset().left);
			menu.css({
				"left" : menu.offset().left
			});

			menu.addClass('stick');
		}
		
		$(window).unbind('scroll.stickToTop').bind('scroll.stickToTop', function(ev) {
			var window_top = $(window).scrollTop();
			var div_top = menu.data("top");
			if (window_top > div_top) {
				
				if(!fullWidth) { 
					menu.css({
						"width" : menu.data("originalWidth"),
						"left" : menu.offset().left
					});
				} else { 
					menu.css({
						"width" : "100%",
						'border-radius' : '0px',
						'-webkit-border-radius' : '0px',
						"left" : '0px'
					})
				}
			

				menu.addClass('stick');
				
			} else {
				menu.removeClass('stick').removeAttr('style');

				flexiCssMenus.alignMenu(name, options);

			}
		});
	}

	function getButtonLevel(selectedNode) {
		try {
			var upULSNo = 0;
			
			//log("##getSelectedLevel##" + selectedNode.parentNode);
			while (selectedNode && selectedNode[0].className != undefined &&selectedNode[0].className.toLowerCase().indexOf("fm") < 0) {
				//log("##selectedNode.parentNode.nodeName.toLowerCase()##" + selectedNode.parentNode.nodeName.toLowerCase());
				if (selectedNode[0].tagName && selectedNode[0].tagName.toLowerCase() == "ul") {
					upULSNo++;
				}
				selectedNode = $(selectedNode).parent();
			}
		} catch (e) {
			alert("Error in getSelectedLevel ##" + e);
		}
		return upULSNo;
	}


	function destroy() { 
		window.flexiCssMenus = {};
	}

	function addParentSelected(liElem) { 
		var parentUl = liElem.parent();
		if(parentUl[0].tagName && parentUl[0].tagName.toLowerCase() == "ul") { 
			var parentLi = parentUl.parent();
			if(parentLi[0].tagName && parentLi[0].tagName.toLowerCase() == "li") { 
				parentLi.add(parentLi.children('a')).addClass('sel');
				addParentSelected(parentLi);
			}
		}
	}

	function checkForButtonSelect(menu, location) { 
		var selected = false;
		menu.children('li').each(function() { 
			if(selected) { 
				return;
			}
			var $a = $(this).children('a');
			var href = $a.attr('href') ? $a.attr('href') : "";


			if(href != "#" && href != "") { 
				if(location.indexOf(href) > -1) { 
					
					selected = true;
					$(this).add($a).addClass('sel');
					addParentSelected($(this));
				}
			} 

			if(!selected) { 
				if($(this).children('ul').length > 0)
				checkForButtonSelect($(this).children('ul').first(), location);
			}
		});
	}


	function addSelectedClass(name) { 
		var currentPage = window.location.href;
		var menu = $("ul.FM2_" + name);

		checkForButtonSelect(menu, currentPage);
	}


	function alignMenu(name, options) { 
		
		if(!options || !options['align'] || options['align'] == "left") { 
			return;	
		}
		var align = options['align'];
		var menu = $('ul.FM2_' + name);
		var container = menu.parent();

		

		switch(align) { 
			case "center" : 
				var containerWidth = $(container).outerWidth(true,false);	
				$(container).css({ 
					"float" : "none",
					"width" : containerWidth + "px",
					"margin-left" : "auto",
					"margin-right" : "auto"
				})
			break;

			case "right" : 
				if($(container).css('float') == 'left') {
					$(container).css({
						"float" : "right"
					})
				}
		}

	}
	
	if (!window.flexiCssMenus) window.flexiCssMenus = {};
	window.flexiCssMenus.stickToTop = stickToTop;
	window.flexiCssMenus.bindEffect = bindEffect;
	window.flexiCssMenus.addSelectedClass = addSelectedClass;
	window.flexiCssMenus.unbindEffect = unbindEffect;
	window.flexiCssMenus.alignMenu = alignMenu;
	
})(menus_jQuery);

(function($) {

	//css menus touch devices//

	var CSSMenus;

	if (!CSSMenus)
	{
		CSSMenus = new Object;
	}

	// Set the user aggent into our own variable.
	CSSMenus.UserAgent = navigator.userAgent.toLowerCase();

	/*
	 *	IsMobile() - Returns true if this is a mobile device.
	 */
	CSSMenus.IsMobile = function (viewportWidth, maxWidth)
	{
		var deviceMatch = (/iphone|ipod|android|blackberry|mini|windows\sce|windows\sphone|iemobile|palm|webos|series60|symbianos|meego/i.test(CSSMenus.UserAgent));
		var sizeMatch;
		var isLTIE9 =  (window.flexiCssMenus.browser.name == "msie" && window.flexiCssMenus.browser.version < 9);
		if(window.matchMedia && !isLTIE9) { 
			sizeMatch = window.matchMedia("(max-width:" + (maxWidth) + "px)").matches;
		} else { 
			sizeMatch = viewportWidth < maxWidth;
		}
		//console.log('mobile match ' + deviceMatch + " .. " + sizeMatch)
		return deviceMatch || sizeMatch;
	}

	/*
	 *	IsTablet() - Return true if this is a tablet device.
	 */
	CSSMenus.IsTablet = function (viewportWidth, minWidth, maxWidth)
	{
		var UA = CSSMenus.UserAgent;
		var is_touch_device = 'ontouchstart' in document.documentElement;
		/*if (UA.indexOf("android") != -1 && UA.indexOf("mobile") == -1)
			return true;
		*/
		
		var deviceMatch = (/ipad|Win64|tablet/i.test(UA));
		var sizeMatch;
		var isLTIE9 =  (window.flexiCssMenus.browser.name == "msie" && window.flexiCssMenus.browser.version < 9);
		if(!isLTIE9 && window.matchMedia) { 
			sizeMatch = window.matchMedia("(max-width:" + (maxWidth) + "px) and (min-width:" + (minWidth+1) + "px)").matches;
			//console.log('tablet match ' + sizeMatch + " -- " + "(max-width:" + (maxWidth-1) + "px) and (min-width:" + minWidth + "px)");
		} else { 
			sizeMatch = viewportWidth < maxWidth && viewportWidth >= minWidth;
		}
		//alert('device match ' + deviceMatch + ".. " + sizeMatch+ " .. touch device " + is_touch_device);
		return is_touch_device && (deviceMatch || sizeMatch);
	}

	CSSMenus.IsAppleProduct = function ()
	{
		return (/iphone|ipod|ipad/i.test(CSSMenus.UserAgent));
	}

	
	function xtdCSSMenuInit(Name, options)
	{
		// If this is a mobile device we want to show one of our menus
		// either the one for small devices or for devices with higher resolution.

		var viewportWidth = window.flexiCssMenus.correctedViewportW();

		//console.log(viewportWidth + " .. " + options.mobileMaxWidth + " > " + CSSMenus.IsTablet(viewportWidth, options.mobileMaxWidth, options.tabletMaxWidth));
		var mobileCheck = CSSMenus.IsMobile(viewportWidth, options.mobileMaxWidth)
		var isMobileDevice = options.enableMobile && mobileCheck;
		var tabletCheck = CSSMenus.IsTablet(viewportWidth, options.mobileMaxWidth, options.tabletMaxWidth);
		var isTabletDevice = (options.enableTablet && tabletCheck) || (!options.enableMobile && mobileCheck);


		//alert('mobile device ' + isMobileDevice + " .. tablet device " + isTabletDevice);

		if (isMobileDevice || isTabletDevice)
		{
			try
			{
				if (isTabletDevice)
				{
					$("#"+Name+"_container").show();
					xtdSetTabletBehavior("#"+Name+"_container", options);
					flexiCssMenus.alignMenu(Name, options);
				}
				else
				{

					
					var BtnParent = $("body");

					var Menu = new XTDMobileMenu(Name);
					// Initialize the menu
					Menu.Init(options);
					Menu.Create(BtnParent);
				}
			}
			catch (e)
			{
				// Something went wrong.
				//console.error(e);
				return false;
			}

			// The banner was succesus fully been created.
			return true;
		} else { 
			$("#"+Name+"_container").show();
		}

		// Something wrong happened.
		return false;
	}

	/*
	 *	***	Tablet menu section. It binds the events for mouseenter and click for each button
	 *	***	which has a submenu.
	 *	
	 *	xtdSetTabletBehavior() - set tablet behaviour
	 *	
	 *	@param: elem - the jquery object representing the menu to modify.
	 *	@param: options - object with settings for the close button
	 */

	function xtdSetTabletBehavior(elem, options) {
		var children = $(elem).children();
		
		for (var i = 0; i < children.length; i++) {
			if (children[i].tagName && children[i].tagName.toLowerCase() == "li") {
				if(children[i].className.toLowerCase().indexOf("fm_close") == -1) {
					if(CSSMenus.IsAppleProduct()) {
						children.eq(i).bind("mouseenter", flexiCSSMenus_mouseEnterHandlerForIpad);
					}
					children.eq(i).bind("click", flexiCSSMenus_clickHandlerForTouchDevices);
				} else {
					children.eq(i).bind("click", flexiCSSMenus_clickHandlerForCloseButton);
				}
			}

			if (children[i].tagName && children[i].tagName.toLowerCase() == "ul" && flexiCSSMenus_getButtonLevel($(children[i])) > 0 && options.tabletCloseBtnEnable != false) {
				var closeLabel;
				if(options.tabletCloseBtnLabel) { 
					closeLabel = options.tabletCloseBtnLabel;
				} else { 
					closeLabel = "Close";
				}

				var liHtml = "<a href='#' target='_self'><font class='leaf'>"+ closeLabel +"</font></a>";
				var closeLI = $("<li/>").addClass("FM_CLOSE").html(liHtml);
				children.eq(i).append(closeLI);
			}

			xtdSetTabletBehavior(children.get(i), options);
		}
	}

	function xtdUnsetTabletBehavior(elem) { 
		var children = $(elem).children();

		for(var i=0; i<children.length; i++) {
			children.eq(i).unbind("click");
			xtdUnsetTabletBehavior(children.get(i));
		}
	}


	CSSMenus.flexiCSSMenus_currentButton = undefined;
	CSSMenus.flexiCSSMenus_currentLevel = -1;


	/*
	 *	If it's ipad, remove the mouseover event.
	 */
	function flexiCSSMenus_mouseEnterHandlerForIpad(event) {
		
	}

	/*
	 *	Method which is called when somebody clicks on a option.
	 */
	function flexiCSSMenus_clickHandlerForTouchDevices(event) {
		var submenu = $(this).find("ul:eq(0)");
		
		if(event.stopPropagation) event.stopPropagation();

		if(CSSMenus.flexiCSSMenus_currentButton && (CSSMenus.flexiCSSMenus_currentButton.get(0) == this) || !submenu.get(0)) { 
			var parentNode;
			var level;
			while(CSSMenus.flexiCSSMenus_currentButton) {
				parentNode = CSSMenus.flexiCSSMenus_currentButton.parent().parent();

				level = flexiCSSMenus_getButtonLevel(parentNode);
				flexiCSSMenus_deselectButton(CSSMenus.flexiCSSMenus_currentButton);

				if(level > 0) {
					CSSMenus.flexiCSSMenus_currentButton = parentNode.parent().parent();
				} else {
					if(!parentNode) {
						flexiCSSMenus_deselectButton(parentNode);
					}
					CSSMenus.flexiCSSMenus_currentButton = undefined;
				}
				CSSMenus.flexiCSSMenus_currentLevel = level - 1;
			}

			return;
		} else { 
			event.preventDefault();
		}
		
		try { 
			var node, level = flexiCSSMenus_getButtonLevel($(this));
		} catch(e) { 
			alert('error 2');
		}

		if(level > CSSMenus.flexiCSSMenus_currentLevel) { 
			CSSMenus.flexiCSSMenus_currentButton = $(this);

			if(level > 0) { 
				node = CSSMenus.flexiCSSMenus_currentButton.parent();	
				while(level > CSSMenus.flexiCSSMenus_currentLevel && node.get(0).className.toLowerCase().indexOf('fm') < 0) { 
					if(node.get(0).tagName && node.get(0).tagName.toLowerCase() == "li") {
						flexiCSSMenus_selectButton($(node));
						CSSMenus.flexiCSSMenus_currentLevel--; 
					}
					node = node.parent();		
				}
			}		
			flexiCSSMenus_selectButton($(CSSMenus.flexiCSSMenus_currentButton));				
			CSSMenus.flexiCSSMenus_currentLevel = level;
			return;
		} 

		if(level == CSSMenus.flexiCSSMenus_currentLevel) { 
			try { 
				flexiCSSMenus_deselectButton(CSSMenus.flexiCSSMenus_currentButton);
				CSSMenus.flexiCSSMenus_currentButton = $(this);
				CSSMenus.flexiCSSMenus_currentLevel = level;
				flexiCSSMenus_selectButton($(CSSMenus.flexiCSSMenus_currentButton));
			} catch(e) { 
				alert('error 3');
			}
			return;
		}
		
		if(level < CSSMenus.flexiCSSMenus_currentLevel) { 
			//flexiCSSMenus_deselectButton(CSSMenus.flexiCSSMenus_currentButton);
			while(level < CSSMenus.flexiCSSMenus_currentLevel) { 
				CSSMenus.flexiCSSMenus_currentButton = CSSMenus.flexiCSSMenus_currentButton.parent();
				if(CSSMenus.flexiCSSMenus_currentButton.get(0).tagName && CSSMenus.flexiCSSMenus_currentButton.get(0).tagName.toLowerCase() == "li") {
					flexiCSSMenus_deselectButton(CSSMenus.flexiCSSMenus_currentButton);
					CSSMenus.flexiCSSMenus_currentLevel--;
				}
			}
			CSSMenus.flexiCSSMenus_currentButton = $(this);
			CSSMenus.flexiCSSMenus_currentLevel = level;
			flexiCSSMenus_selectButton($(CSSMenus.flexiCSSMenus_currentButton));
			return;
		}
	}

	/*
	 *	Set behaviour for close button
	 */
	function flexiCSSMenus_clickHandlerForCloseButton(event) {
		var parentNode = $(this).parent().parent();
		if(event.stopPropagation) event.stopPropagation();
		event.preventDefault();
		flexiCSSMenus_deselectButton(parentNode);
		try{
			var level = flexiCSSMenus_getButtonLevel(parentNode);
		} catch (e) {
			//console.error(e);
		}
		if(level > 0) {
			CSSMenus.flexiCSSMenus_currentButton = parentNode.parent().parent();
		} else {
			CSSMenus.flexiCSSMenus_currentButton = undefined;
		}
		CSSMenus.flexiCSSMenus_currentLevel = level - 1;
	}

	/*
	 *	Removes the "hovered" class and sets the "current level" and "current selected button"
	 *	to the correct values	
	 */
	function flexiCSSMenus_deselectButton(button) {
		try { 
			if(button) {  
				button.find('a:eq(0)').removeAttr("class");
				var submenu = button.find('ul');
				if(submenu.length > 0) { 
					button.removeAttr("class");
					hideSubmenu(submenu.eq(0));
					var hovered = submenu.eq(0).find(".hover");
					if (hovered.length > 0) {
						flexiCSSMenus_deselectButton(hovered.eq(0));
					}
				}
				
				var lis = submenu.eq(0).find('li');
				for(var i = 0; i < lis.length; i++) { 

					lis.eq(i).css("position", "relative");
				}
			}
		} catch(e) { 
			//console.log(e);
		}
	}

	function flexiCSSMenus_selectButton(button) {
		//button.css("position","relative");
		
		try { 
			var submenu = button.find('ul');
			submenu.eq(0).css("z-index", "1");
			if(submenu.length > 0) {
				button.addClass("hover");
				showSubmenu(submenu.eq(0));
			
				var lis = submenu.eq(0).find('li');
				for(var i = 0; i < lis.length; i++) { 
					lis.eq(i).css("position", "relative");
				}
			}
		} catch(e) { 
			alert('error 1##'+e);
		}
	}


	function flexiCSSMenus_getButtonLevel(selectedNode) {
		try {
			var upULSNo = 0;
			
			//log("##getSelectedLevel##" + selectedNode.parentNode);
			while (selectedNode && selectedNode[0].className != undefined &&selectedNode[0].className.toLowerCase().indexOf("fm") < 0) {
				//log("##selectedNode.parentNode.nodeName.toLowerCase()##" + selectedNode.parentNode.nodeName.toLowerCase());
				if (selectedNode[0].tagName && selectedNode[0].tagName.toLowerCase() == "ul") {
					upULSNo++;
				}
				selectedNode = $(selectedNode).parent();
			}
		} catch (e) {
			alert("Error in getSelectedLevel ##" + e);
		}
		return upULSNo;
	}

	function flexiCSSMenus_getButtonMenu(selectedNode) {
		try {
			var upULSNo = 0;
			
			//log("##getSelectedLevel##" + selectedNode.parentNode);
			while (selectedNode && (selectedNode[0].className.toLowerCase().indexOf("FM2_") == -1 || selectedNode[0].className.toLowerCase().indexOf("_container") == -1) ) {
				//log("##selectedNode.parentNode.nodeName.toLowerCase()##" + selectedNode.parentNode.nodeName.toLowerCase());
				selectedNode = selectedNode.parent();
			}
		} catch (e) {
			alert("Error in getButtonMenu ##" + e);
		}
		return selectedNode;
	}

	function flexiCSSMenus_getMenuType(menuNode) {
		var menu, comment, start, end, type, props;
		menu = menuNode.get(0);
		
		start = menu.innerHTML.indexOf("<!--") + 4;
		end = menu.innerHTML.indexOf("-->");
		comment = menu.innerHTML.substring(start, end);
		props = comment.split(';');
		type = props[props.length - 2].replace('type=', '');
		
		return type;
	}

	function showSubmenu(el){
		var uls = $("#"+CSSMenus.name+"_container").find("ul");


		
		if(el.is(":animated") || (el.get(0) == $("#" + CSSMenus.name).get(0))) {
			return;
		}

		if (flexiCssMenus.settings.effect == "none") {
			el.show();
		} else {
			el.show(flexiCssMenus.settings.effect, flexiCssMenus.settings.options, 200);
		}
	}

	function hideSubmenu (el) {
		if (el.is(":animated") || (el.get(0) == $("#" + CSSMenus.name).get(0))) {
			return;
		}
		var uls = $("#"+CSSMenus.name+"_container").find("ul");
		if(flexiCssMenus.settings.effect == "none") {
			el.hide();
		} else {
			el.hide(flexiCssMenus.settings.effect, flexiCssMenus.settings.options, 200);
		}
	}

	/**
	 **	End of tablet menu operations
	 **/

	/*
	 *	Mobile menu generation
	 *
	 *	XTDMobileMenu() - Class which creates and handles a javascript menu for small mobile devices.
	 */
	function XTDMobileMenu(MenuName)
	{
		/* Private variables */
		var Self = this;
		var Parent = null;

		var MenuName = MenuName;
		var Options = null;

		var MenuButton = null;
		var MainContainer = null;
		var MainMenu = null;
		var mobileOverlay = null;
		var Container = null;
		var Header = null;
		var MainUL = null;
		var Visible = false;
		var mainMenuHeader = null;

		var presets = {
			"fixed" : {
				effect : 'fade',
				overlay : true
			},
			"relative" : {
				effect : 'slideUp',
				overlay : true
			},
			"push" : { 
				effect : 'slideLeft',
				overlay : false
			}
		};

		window.flexiCssMenus.presetSettings = null;

		/*
		 *	Init() - Initialize menu data.
		 */
		this.Init = function (initObj)
		{
			Options =
			{
				FontColor: "#fff",
				FontShadowColor: "#000",
				NormalColor: "#ff0000",//"#F7F7F7",
				HoverColor: "#DADADA"
			};
			
			if (initObj) {
				for (var i in initObj) {
					Options[i] = initObj[i];
				}
			}

			window.flexiCssMenus.presetSettings = presets[Options.preset];

		}

		/*
		 *	Create() - Create the menu with the given settings.
		 */
		this.Create = function (ButtonParent, onResize)
		{
			if ( document.readyState !== 'complete' ) { 
				$(document).ready(function() { 
					CreateMainButton(ButtonParent);
					var overlayHeight = Math.max($('body').outerHeight() + 13, $(window).height(), $(document).outerHeight());
					var overlayWidth = Math.max($('body').outerWidth(), $(window).width(), $(document).width());
					createStructure();
					$(mobileOverlay).height(overlayHeight);
					$(mobileOverlay).width(overlayWidth);
					
				});
			} else { 

				var overlayHeight = Math.max($('body').outerHeight() + 13, $(window).height(), $(document).outerHeight());
				var overlayWidth = Math.max($('body').outerWidth(), $(window).width(), $(document).width());
				CreateMainButton(ButtonParent);
				createStructure();
				$(mobileOverlay).height(overlayHeight);
				$(mobileOverlay).width(overlayWidth);
			}
			
		}

		function createStructure() { 
			mobileOverlay = document.createElement("div");
			$(mobileOverlay).addClass('FM2_' + MenuName + '_mobile-overlay FM2_' + MenuName + '_mobile-overlay-hide mobile-overlay');
			
			$(mobileOverlay).mousedown(function(ev) { 
				ev.preventDefault();
			}).click(function() { 
				// alert('clicked');
				if(Visible) { 
					Self.Show(Visible = !Visible);
				}
			});

			
			
			MainContainer = document.createElement("div");

			MainContainer.setAttribute("id", "FM2_" + MenuName+"_jq_menu_back");
			MainContainer.setAttribute("class", "FM2_mobile_jq_menu ui-main-container ui-corner-all ui-mobile-viewports");
			MainContainer.style.height = "0px"
			

			MainContainer.style.zIndex = "10005";

			Container = document.createElement("div");
			Container.setAttribute("class", "menu-container");
			MainMenu = document.createElement("div");
			MainMenu.className = "menu main-menu";

			mainMenuHeader = createMainMenuHeader("Menu");
			MainContainer.appendChild(mainMenuHeader);
			
			var ItemList = CreateItemList();

			MainMenu.appendChild(ItemList);

			Container.appendChild(MainMenu);
			MainContainer.appendChild(Container);
			// Append the main container.
			
			Parent = /*(Parent != null)? Parent :*/ document.getElementsByTagName('body')[0];

			if(Options.preset == "fixed") { 
				mobileOverlay.appendChild(MainContainer);
				Parent.appendChild(mobileOverlay);
			} else { 
				$(MenuButton).after($(MainContainer));
			}
			

			if(Options.preset != 'relative') { 
				if(Options.preset != 'push') { 
					$(Container).css('top', parseInt($(mainMenuHeader).outerHeight(true)) + "px");
				} else { 
					MainMenu.style.marginTop =  parseInt($(mainMenuHeader).outerHeight(true)) + "px";
				}
				var calcHeight = parseInt($(Container).height()) + parseInt($(mainMenuHeader).outerHeight()) ;
				if(Options.preset == "push") { 
					//alert('dadsdf ' + $('body').outerWidth() + " .. " +  $(window).width() + " .. " +  $(document).width() + "px");
					MainContainer.style.height = Math.max($('body').outerWidth(), $(window).width(), $(document).width()) + "px";
					Container.style.height = calcHeight + "px" ;
				} else { 
					MainContainer.style.height = calcHeight + "px" ;
				}
			}
			$(MainContainer).hide();
			
			//$("#creative_menu_structure").remove();

			// Set the links callback.
			UpdateLinks();


			GetCurrentItem();

			Self.Update();
		}

		/*
		 *	Show() - Show the menu
		 */
		this.Show = function (Visible) {

			if (Visible){
				$(mobileOverlay).removeClass('FM2_' + MenuName + '_mobile-overlay-hide');

				switch(window.flexiCssMenus.presetSettings.effect) { 
					case "fade" : 

						$(MainContainer).css('width', $('body').width());
						var overlayWidth = Math.max($('body').outerWidth(), $(window).width(), $(document).width());
						$(mobileOverlay).width(overlayWidth);
					
						$(MainContainer).fadeIn("fast").css({
							top : $(window).scrollTop(),
							left : $('body').css('margin-left')
						});
						var overlayHeight = Math.max($('body').outerHeight() + 13, $(window).height(), $(document).outerHeight());
						var containerHeight = $(Container).height() + $(window).scrollTop() + 300;

						$(mobileOverlay).height(Math.max(overlayHeight, containerHeight));
					break;

					case "slideUp" : 
						$(MainContainer).css('height','auto').slideDown();

					break;

					case "slideLeft":
						$('body').stop(true, true).css({
							'width' : '100%',
							'overflow' : 'hidden'
						}).animate({
							'margin-left' : '72%'
						}, '300');

						var pageHeight =  Math.max($('body').outerWidth(), $(window).width(), $(document).outerHeight());
						var containerHeight = $(Container).height() + $(window).scrollTop() + 20;


						$(MainContainer).stop(true, true).show().css('height',Math.max(pageHeight, containerHeight)).animate({
							left : '0px'
						}, '400');

						$(Container).css({
							"margin-top" : $(window).scrollTop()
						});

						$(mainMenuHeader).css({
							"margin-top" : $(window).scrollTop() +10
						});
						
					break;
				}
				
			//	$('body').bind('touchmove', function(e){ e.preventDefault(); });
				
				//$('body').css('margin-left', '40px');

			} else {
				$(mobileOverlay).addClass('FM2_' + MenuName + '_mobile-overlay-hide');
				switch(window.flexiCssMenus.presetSettings.effect) { 
					case "fade" : 
						$(MainContainer).fadeOut("fast", function (){
							$(MainContainer).find(".submenu").remove();
							$(MainContainer).find(".menu").css("width", "").show();
							//$(mobileOverlay).remove();
						});
					break;

					case "slideUp" : 
						$(MainContainer).slideUp();

					break;

					case "slideLeft":
						$('body').stop(true, true).animate({
							'margin-left' : '0'
						}, '400', function() { 
							$(this).css('width', 'auto')
						});

						$(MainContainer).stop(true, true).animate({
							left : '-100%'
						}, '300', function() { 
							$(this).hide();
						})
						
					break;
				}
				
			//	$('body').unbind('touchmove');
			}
		}
		
		/*
		 *	ShowHeader() - Show/Hide the header.
		 *
		 *	PARAMETERS:
		 *		Visible - Specifies if this should be visible or not.
		 */
		this.ShowHeader = function (Visible)
		{
			if (Visible)
				$(Header).show();
			else
				$(Header).hide();
		}

		/*
		 *	GoToSubmenu() - Go to the specified submenu.
		 */
		this.GoToSubmenu = function(ParentID, Current)
		{
			if ($(Current).parent().has("ul").length)
			{
				var Submenu = document.createElement("div");
				Submenu.setAttribute("class", "menu submenu");
				var UlElement = $(Current).parent().children("ul").clone(true, true);

				// Save these to know which submenu to set to header.
				UlElement.attr("elcaption", $(Current).text());
				UlElement.attr("ellink", $(Current).attr("href"));
				UlElement.attr("eltarget", $(Current).attr("target"));
				UlElement.show();
				var newHeader = CreateHeader($(Current).text(), $(Current).attr("href"));

				Submenu.appendChild(newHeader);
				UlElement.appendTo($(Submenu));

				$(Submenu).appendTo(Container);

				var containerWidth = parseInt($(MainContainer).width());
				Submenu.style.width = containerWidth + "px";
				$(Container).children(".menu").eq(-1).css("width", containerWidth);
				$(Container).children(".menu").eq(-2).css("width", containerWidth);
				Container.style.width = 2 * containerWidth + 2 + "px";
				MainContainer.style.height = Math.max(parseInt(MainContainer.style.height), parseInt(Container.style.height)) + "px";
				switch(window.flexiCssMenus.presetSettings.effect) { 
					case "fade":
						
						$(Container).animate({display:"none"}, 1, "swing", function(){
							$(Container).children(".menu").eq(-2).hide();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("opacity", 0).animate({opacity:1},150);
						});

					break;

					case "slideLeft" :
						$(Container).animate({left :"-" + containerWidth + "px"}, 250, "swing", function(){
							$(Container).children(".menu").eq(-2).hide();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("width", "").css({
								top : $(window).scrollTop()
							});
						});

					break;

					case "slideUp" :
					
						$(Container).animate({left :"-" + containerWidth + "px"}, 250, "swing", function(){
							$(Container).children(".menu").eq(-2).hide();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("width", "");
						});
					break;
				}
				

				

			}


		}

		/*
		 *	GoBack() - Go back to the previous menu submenu.
		 */
		this.GoBack = function (Current)
		{
			if ($(Container).children(".menu").length > 1) {
				var containerWidth = parseInt($(MainContainer).width());

				$(Container).children(".menu").eq(-1).css("width", containerWidth + "px");
				$(Container).children(".menu").eq(-2).show().css("width", containerWidth + "px");
				$(Container).css({"width" : 2 * containerWidth + "px", "left" : "-" + containerWidth + "px"});
				switch(window.flexiCssMenus.presetSettings.effect) { 
					case "fade" : 
						$(Container).animate({opacity : 1}, 1, "swing", function() {
							$(Container).children(".menu").last().remove();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("opacity", 0).animate({opacity:1},150);
						});

					break;

					case "slideLeft" :

						$(Container).animate({left : "0px"}, 250, "swing", function() {
							$(Container).children(".menu").last().remove();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("width", "");
						});
					break;

					case "slideUp" :
					
						$(Container).animate({left : "0px"}, 250, "swing", function() {
							$(Container).children(".menu").last().remove();
							$(Container).css({"width" : "", "left" : ""});
							$(Container).children(".menu").eq(-1).css("width", "");
						});
					break;
				}
			}
		}

		
		/*
		 *	SetOptions() - Set Menu options.
		 */
		this.SetOptions = function (Value)
		{
			Options = $.extend(true, Options, Value);

			// Update menu with the new options.
			Self.Update();
		}

		/*
		 *	Update() - Update the menu.
		 */
		this.Update = function ()
		{
			if ($(Container).children("ul").length == 1)
			{
				$(Header).children("a.back-btn").css("display", "none");
			}
		}


		/* Private functions */

		/*
		 *	CreateMainButton() - Create the Level 0 button.
		 */
		function CreateMainButton(Parent) {
			
			// search the page for already created button
			var btn = $("#FM2_" + MenuName + "_mobile_button");

			if(btn.length > 0) { 
				btn.attr('href', '#').removeAttr('style');
				MenuButton = btn[0];
			} else { 
				
				// create a new button
				MenuButton = document.createElement("a");

				MenuButton.innerHTML += "<span class='down-arrow'>&#x25BC;</span><span class='caption'>Menu</span>";
				MenuButton.setAttribute("href", "#");
				MenuButton.setAttribute("id", "FM2_" + MenuName + "_mobile_button");
				
				$(MenuButton).addClass("FM2_mobile_button").appendTo(Parent);
				
			}
			
			$(MenuButton).unbind('click').click(function (ev) {
				ev.preventDefault();
				ev.stopPropagation();
				
				// Toggle visible.
				Self.Show(Visible = !Visible);
			});
		}

		/*
		 *	CreateHeader() - Create the menu header.
		 */
		function CreateHeader(Caption, Link)
		{
			var Header = document.createElement("div");
			var BackBtn = document.createElement("a");
			var CloseBtn = document.createElement("a");
			var Title = document.createElement("p");

			Header.setAttribute("id", MenuName+"_jq_menu_header");
			Header.setAttribute("class", "menu-header");

			BackBtn.setAttribute("href", "javascript: void(0);");
			BackBtn.setAttribute("class", "back-btn");
			
			$(BackBtn).click(function (ev)
			{
				ev.stopPropagation();
				// Go back.
				Self.GoBack();
			});

			Title.innerHTML = "<a href='" + Link + "''>" + Caption + "</a>";

			Header.appendChild(BackBtn);
			Header.appendChild(Title);

			return Header;
		}

		function createMainMenuHeader(caption) { 
			var Header = document.createElement("div");
			Header.setAttribute("class", "main-menu-header");
			/*var HeaderContainer = document.createElement("p");
			var CloseBtn = document.createElement("span");
			var Title = document.createElement("span");

			

			CloseBtn.setAttribute("href", "javascript: void(0);");
			CloseBtn.setAttribute("class", "close-btn");
			
			
			$(CloseBtn).click(function ()
			{
				// Go back.
				Visible = false;
				Self.Show(Visible);
			});
			$(Title).addClass('caption');
			Title.innerHTML = caption;
			
			HeaderContainer.appendChild(Title);
			HeaderContainer.appendChild(CloseBtn);
			Header.appendChild(HeaderContainer);
*/
			$(Header).click(function (ev) {
				ev.preventDefault();
				ev.stopPropagation();
				// Toggle visible.
				Self.Show(Visible = !Visible);
			});

			return Header;
		}

		/*
		 *	SetHeader() - Set caption and link to header.
		 */
		/*function SetHeader(Caption, Link, Target)
		{
			if (typeof(Link) != "undefined")
				$(Header).children("p").html("<a href='"+Link+"' target='"+Target+"'>"+Caption+"</a>");
			else
				$(Header).children("p").html(Caption);
		}*/

		/*
		 *	GetCurrentItem() - Get the current item from link.
		 */
		function GetCurrentItem()
		{
			var MenuItem = "Menu";

			$(Container).children("ul").find("a").each(function ()
			{
				if ($(this).attr("href") == window.location)
				{
					MenuItem = $(this).children("p").html();
				}
			});

			$(MenuButton).children("span.caption").children("p.xtd_menu_ellipsis").html(MenuItem);
		}

		/*
		 *	CreateItemList() - Create a list with all menu/submenu items.
		 */
		function CreateItemList(Structure)
		{
			var Structure = (typeof(Structure) != "undefined") ? Structure : $("#" + MenuName + "_container > ul > li");
			var ULElement = document.createElement("ul");

			Structure.each(function (Index)
			{
				var LiElement = document.createElement("li");
				var AElement = null;

				LiElement.className = "ellipsis";
				// Clone the original a element
				AElement = $(this).children("a").clone().appendTo($(LiElement));
				
				// Add a paragraph for ellipsis to work.
				AElement.html('<p class="xtd_menu_ellipsis">' + AElement.html() + '</p>'); 

				if ($(this).children("ul").length)
				{
					// Recursive call for the child elements.
					var NewUL = CreateItemList($(this).children("ul").children("li"));
					NewUL.style.display = "none";
					LiElement.appendChild(NewUL);
				}

				ULElement.appendChild(LiElement);
			});

			return ULElement;
		}

		/*
		 *	UpdateLinks() - Update the jquery click event.
		 */
		function UpdateLinks(Cont)
		{
			var ObjContainer = (Cont != undefined) ? Cont : MainMenu;
			// Do some init here.

			$(ObjContainer).children("ul").find("li").click(function (event)
			{
				var elem = $(this).children('a');
				if($(MainContainer).find(".menu").filter(":visible").length > 1) {
					//console.log($(".menu").filter(":visible").length);
					return;
				}

				// Check if it has a child so we know if we execute the link or the child.
				event.preventDefault();
				event.stopPropagation();
				if (elem.parent().has("ul").length)
				{

					Self.GoToSubmenu("", elem);
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					if(elem.length > 0 && elem.attr('href')) { 
						window.location = elem.attr('href');
					}
					$(MenuButton).children("span.caption").children("p.xtd_menu_ellipsis").html(elem.children("p").html());
					if(Visible) { 
						Self.Show(Visible = !Visible);
					}
				}
			}).on('touchstart', function() { 
				$(this).addClass('clicked');
			}).on('touchend', function() { 
				$(this).removeClass('clicked');
			}).on('touchmove', function() { 
				$(this).removeClass('clicked');
			});
		}


		/*
		 * Destroy menu - destroy the mobile menu when required
		 */
		
	}
	function destroy() { 
		$(".mobile_menu_button").remove();
		$('.mobile-overlay').remove();
		$('.FM2_mobile_jq_menu').remove();
		$('body').unbind('touchmove');
		if(window.flexiCssMenus.presetSettings && window.flexiCssMenus.presetSettings.effect == "slideLeft") { 
			$('body').stop(true, true).css({
				'margin-left' : '0',
				'width': 'auto'
			});
		}
	}
	if (!window.flexiCssMenus) window.flexiCssMenus = {};
	window.flexiCssMenus.xtdCSSMenuInit = xtdCSSMenuInit;
	window.flexiCssMenus.xtdUnsetTabletBehavior = xtdUnsetTabletBehavior;
	window.flexiCssMenus.destroy = destroy;

})(menus_jQuery);


//ie css3 script//

(function($) {
	function getBrowser() {
		// jquery code//
		var ua = navigator.userAgent.toLowerCase();
		var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
			/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
			/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
			/(msie) ([\w.]+)/.exec( ua ) ||
			ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
			[];
		
		var ver = match[ 2 ] || "0";
		var fi = ver.indexOf('.');
		var fi2 = ver.indexOf('.', fi);
		if (fi2 != -1) {
			ver = parseFloat(ver.substring(0, fi2));
		}
		return {
			name: match[ 1 ] || "",
			version: ver
		};
	}
	
	function getScriptFolder() {
		var scripts = document.getElementsByTagName('SCRIPT');
		for (var i = 0; i < scripts.length; i++) {
			var src = scripts[i].getAttribute('src');
			if (src && src.indexOf('fleximenus2.js') != -1) {
				if (src.lastIndexOf('/') != -1) {
					return src.substring(0, src.lastIndexOf('/') + 1);
				} else {
					return '';
				}
			}
		}
	}
	
	var browser = getBrowser();
	
	if (!window.flexiCssMenus) window.flexiCssMenus = {};
	window.flexiCssMenus.browser = getBrowser();
	
	var scriptFolder = getScriptFolder();
	var ssFolder = scriptFolder;
	
	function addEventListener(element, type, listener) {
		if (element.addEventListener) {
			element.addEventListener(type, listener, false); 
		} else if (element.attachEvent)  {
			element.attachEvent('on' + type, listener);
		}
	}
	
	var addPropertyFails = {};
	
	function addBehavior() {
		function addPropertyInRules(ss, url) {
			if (!addPropertyFails[url]) addPropertyFails[url] = 0;
			if (!ss.rules.length) {
				addPropertyFails[url]++;
				if (ss.owningElement.readyState != "complete" && addPropertyFails[url] < 500) {
					setTimeout( (function(ss, url) {
						return function() {
							addPropertyInRules(ss, url);
						};
					})(ss, url) , 10);
				}
			} else {
				for (var j = ss.rules.length - 1; j >= 0; j--) {
					var rule = ss.rules[j];
					rule.style.behavior =  "url(" + url + ")";
				}
			}
		}
		
		var links = document.getElementsByTagName('LINK');
		for (var i = 0; i < links.length; i++) {
			var href = links[i].getAttribute('href');
			if (href) {
				if (href.indexOf('-ie.css') != -1 && href.toLowerCase().indexOf(ssFolder.toLowerCase()) != -1) {
					var url = href.substring(0, href.lastIndexOf('/')) + "/PIE.htc";
					addPropertyInRules(links[i].styleSheet, url);
				}
			}
		}
	}
	
	var parsedLinks = [];
	
	function linkWasParsed(link) {
		for (var i = 0; i < parsedLinks.length; i++) {
			if (parsedLinks[i] == link) {
				return true;
			}
		}
		return false;
	}
	
	function existsInHead(link) {
		var links = document.getElementsByTagName('LINK');
		for (var i = 0; i < links.length; i++) {
			var href = links[i].getAttribute('href');
			if (href == link) {
				return true;
			}
		}
		return false;
	}
	
	function addIE9Links(){
		if (browser.name == "msie" && browser.version <= 9) {
			var links = document.getElementsByTagName('LINK');
			var length = links.length;
			for (var i = 0; i < length; i++) {
				var href = links[i].getAttribute('href');
				if (!linkWasParsed(href)) {
					parsedLinks.push(href);
					if (href && href.indexOf('http://') == -1 && href.indexOf('reset.css') == -1 && href.indexOf('-ie.css') == -1 && href.toLowerCase().indexOf(ssFolder.toLowerCase()) != -1) {
						if (!existsInHead(href.replace('.css', '-ie.css'))){ 
							document.createStyleSheet(href.replace('.css', '-ie.css'));
							parsedLinks.push(href.replace('.css', '-ie.css'));
						}
					}
				}
			}
		}
	}
	
	addIE9Links();
	addEventListener(window, "load", function() {
		// this is for link tags added after our script//
		addIE9Links();

		if (browser.name == "msie" && browser.version == 7) {
			window.setTimeout(function() {
				addBehavior();
			}, 1000);
		}
		
		if (browser.name == "msie" && browser.version <= 9 && browser.version != 7) {
			addBehavior();
		}
	});
})(menus_jQuery);


function registerFlexiCSSMenu(name, settings) {
	flexiCssMenus.settings = settings;

	if(!window.registeredFlexiMenus) { 
		window.registeredFlexiMenus = [];
	}


	if (window.flexiCssMenus.browser.name == "msie" && window.flexiCssMenus.browser.version < 9) {
		//alert(name + " .. " + window.flexiCssMenus.browser.name + " .. " + window.flexiCssMenus.browser.version);
		menus_jQuery(document).ready(function() {
			menus_jQuery(".FM2_mobile_button").hide();
		});
		settings["effectRest"] = null;
		settings["effectSub"] = null;
		settings["effectSubTwo"] = null;
		
	} 

	registeredFlexiMenus.push({"name" : name, "settings" : settings});

	menus_jQuery("#"+name+"_container").removeAttr('style');
	//console.log(settings.options['enableMobile']);
	if(!settings.options['enableMobile']) { 
		menus_jQuery(document).ready(function() { 
			menus_jQuery(".FM2_mobile_button").hide();
		});
	}

	if(!flexiCssMenus.xtdCSSMenuInit(name, settings.options)) {
		flexiCssMenus.bindEffect(name, settings);
		flexiCssMenus.addSelectedClass(name);
		flexiCssMenus.alignMenu(name, settings.options);
		if(settings.stickToTop) { 
			flexiCssMenus.stickToTop(name, settings.takeBrowserWidth, settings.options);
		}
	}
	
}


(function($) {
	var id;
	if(window.addEventListener) { 
		window.addEventListener("orientationchange", function()  {
			clearTimeout(id);
			id = setTimeout(doneResizing, 100);
		});
	}
	menus_jQuery(window).unbind('resize.xtd').bind('resize.xtd', function() {
	//menus_jQuery(window).resize(function() { 
		var is_touch_device = 'ontouchstart' in document.documentElement;
		if(is_touch_device) { 
			menus_jQuery(window).unbind('resize');
			return;
		}
		clearTimeout(id);
		id = setTimeout(doneResizing, 100);
	});


	function doneResizing() {
		for(var i=0; i < registeredFlexiMenus.length; i++) {
			var menu = registeredFlexiMenus[i];

			if(flexiCssMenus.destroy) { 
				flexiCssMenus.destroy(menu.name);
				menus_jQuery('.FM_CLOSE').remove();
				flexiCssMenus.xtdUnsetTabletBehavior("#" + menu.name + "_container");
				flexiCssMenus.unbindEffect(menu.name);
			}
		}

		for(var i=0; i < registeredFlexiMenus.length; i++) { 
			var menu = registeredFlexiMenus[i];

		
			if(!flexiCssMenus.xtdCSSMenuInit(menu.name, menu.settings.options)) {
				flexiCssMenus.bindEffect(menu.name, menu.settings);
			//	flexiCssMenus.addSelectedClass(name);
				flexiCssMenus.alignMenu(name, menu.settings.options);
				if(menu.settings.stickToTop) { 
					flexiCssMenus.stickToTop(menu.name, menu.settings.takeBrowserWidth,menu.settings.options);
				}
			}	
		}
	}

	var correctedViewportW = (function (win, docElem) {

	    var mM = win['matchMedia'] || win['msMatchMedia']
	      , client = docElem['clientWidth']
	      , inner = win['innerWidth']

	    return mM && client < inner && true === mM('(min-width:' + inner + 'px)')['matches']
	        ? function () { return win['innerWidth'] }
	        : function () { return docElem['clientWidth'] }

	}(window, document.documentElement));
	
	if (!window.flexiCssMenus) window.flexiCssMenus = {};
	window.flexiCssMenus.correctedViewportW = correctedViewportW;
})(menus_jQuery)