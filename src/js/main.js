jQuery(function($){

	$.fn.expandoGallery = function(){
		var itemsPerPane = 3;
		$(this).each(function(i,ele){
			var dis = $(ele);
			var items = dis.find('.gallery-item');

			dis.find('br').remove();
			dis.prepend("<div class='zoom-area'><div></div><a class='next' href='#'>Next</a><a class='prev' href='#'>Previous</a></div>");
			var zoom_area = dis.children('.zoom-area').children('div');
			var next_btn = dis.find('a.next');
			var prev_btn = dis.find('a.prev');

			var num_panes = Math.ceil(items.length / itemsPerPane);
			var pane_container_width = (num_panes * 100);
			var widthPerItem = 100 / (itemsPerPane * num_panes);
			items.wrapAll("<div class='zoom-gallery-nav'><div style='width:"+pane_container_width+"%;'></div></div>");
			
			var imageMap = [];
			var currentImage = 0;
			items.each(function(i,ele){
				$(ele).css('width',widthPerItem+"%");
				imageMap.push($(ele).find('a').attr('href'));
				$(ele).find('a').on('click', function(e){
					e.preventDefault();
					load_image(i);
				});
			});

			next_btn.on('click', function(e){
				e.preventDefault();
				if(currentImage < imageMap.length){
					currentImage++;
					load_image(currentImage);
				}
			});

			prev_btn.on('click', function(e){
				e.preventDefault();
				if(currentImage > 0){
					currentImage--;
					load_image(currentImage);
				}
			});

			function load_image(num){
				var outputHTML = "";
				outputHTML+=image_output(num,true);
				zoom_area.children().remove();
				zoom_area.html(outputHTML);

				var img = zoom_area.find('img');
				img.load(function(e){
					zoom_area.css('height', img.height()+"px");
				});

				if(num == 0){
					next_btn.addClass('active');
					prev_btn.removeClass('active');
				}else if(num == imageMap.length-1){
					next_btn.removeClass('active');
					prev_btn.addClass('active');
				}else{
					next_btn.addClass('active');
					prev_btn.addClass('active');
				}

				currentImage = num;
			}

			function image_output(num,active){
				var outputClass = active ? "active" : "";
				return "<a class='"+outputClass+"' href='"+imageMap[num]+"'><img src='"+imageMap[num]+"'/></a>";
			}

			load_image(0);
		});
	}


	$.fn.linkSubmitter = function(){
		if($(this).length > 0){
			$(this).each(function(i,ele){
				var dis = $(ele);
				dis.on('click', function(e){
					e.preventDefault();
					dis.closest('form').submit();
				});
			});
		}
	}


	var mobilemenuscroll;
	function mobileMenu(){
		mobilemenuscroll = new IScroll($('.mainnav .menuarea').get(0), {
			click:true
		});
		$('.mainnav h4').each(function(i,ele){
			$(ele).on('click', function(){
				var targ_ul = $(ele).siblings('ul');
				if(targ_ul.hasClass('active')){
					targ_ul.removeClass('active');
				}else{
					$('.mainnav ul').removeClass('active');
					$(ele).siblings('ul').addClass('active');
				}
				setTimeout(function(){
					mobilemenuscroll.refresh();
				},10);
			});
		});
	}

	var mobilefeaturescroll;
	function mobileFeatures(){
		mobilefeaturescroll = new IScroll($('.mainmenu').get(0), {
			click 			: true,
			scrollX 		: true,
			scrollY 		: false,
			bounce			: false,
			eventPassthrough: true
		});
	}

	function allMenu(){
		$('.menubutton').click(function(){
			mainnav.toggleClass('active');
		});
		mainnav.find('.touchcancel').on('click', function(){
			mainnav.removeClass('active');
			
		});
	}

	function desktopMenu(){
		mainnav.find('h4').hover(
			function(){
				$(this).closest('.inner').children('div').removeClass('active');
				$(this).parent().addClass('active');
			},
			function(){

			});
		mainnav.find('.inner').hover(
			function(){

			},
			function(){
				$(this).children('div').removeClass('active');
			});
	}

	function mobileHeaderLinks(){
		var selection = $('.post>a, section.related a');
		var hold_y_start;
		var hold_y_end;
		selection.on('click', function(e){
			if(isMobile()){
				e.preventDefault();	
			}
		});
		selection.on('touchstart', function(e){
			hold_y_start = hold_y_end = e.originalEvent.touches[0].clientY;
		});

		selection.on('touchmove', function(e){
			hold_y_end = e.originalEvent.touches[0].clientY;
		});

		selection.on('touchend', function(e){
			var diff = Math.abs(hold_y_end - hold_y_start);
			if(diff < $(window).height()*0.1){
				document.location = $(this).attr('href');
				//$('body').css('background','rgb('+Math.floor(Math.random()*255)+','+Math.floor(Math.random()*255)+','+Math.floor(Math.random()*255)+')')
			}
		});
	}

	var mobileflag;
	function isMobile(){
		if(mobileflag.is(':visible')){
			return true;
		}else{
			return false;
		}
	}


	function fancySearch(){
		var suggestedresults = $('#suggestedresults');
		var target_link = false;
		var max_links = 0;

		function update_target_link(){
			suggestedresults.find('a.current').removeClass('current');
			if(target_link !== false){
				suggestedresults.find('a').eq(target_link).addClass('current');
			}
		}

		$('.search.desktoponly input').on('keyup', function(e){
			if($(this).val().length == 0){
				suggestedresults.html("");
				return;
			}else if(e.keyCode == 27){
				clear_results();
			}else if(e.keyCode == 38){
				//up
				e.preventDefault();
				if(target_link !== false){
					if(target_link == 0){
						target_link = false;
					}else{
						target_link--;	
					}
				}
				update_target_link();
			}else if(e.keyCode == 40){
				//down
				e.preventDefault();
				if(target_link === false){
					target_link = 0;
				}else if(target_link < max_links){
					target_link++;
				}
				update_target_link();
			}else{
				var query = $(this).val().toLowerCase();

				var results = "";
				var j=0;
				for(var i=0; i<searchObject.length; i++){
					if(searchObject[i].name.toLowerCase().indexOf(query) > -1){
						j++;
						results += "<a class='"+searchObject[i].class+"' href='"+searchObject[i].url+"'>"+searchObject[i].name+"</a>";
						if(j > 10){
							break;
						}
					}
				}
				max_links = j;
				results += "<a href='"+$(this).closest('form').attr('action')+"?s="+$(this).val()+"'>Search for \""+$(this).val()+"\"</a>";

				suggestedresults.html(results);
			}			
		});

		$('.search.desktoponly').on('submit', function(e){
			if(target_link !== false){
				e.preventDefault();
				document.location = suggestedresults.find('a').eq(target_link).attr('href');
			}
		});

		$('body').on('click', function(e){
			if(suggestedresults.html() != ""){
				if($(e.target).closest('form.search.desktoponly').length == 0){
					clear_results();
				}
			}
		})

		function clear_results(){
			suggestedresults.html("");
			target_link = false;
		}

		suggestedresults.hover(
			function(){
				target_link = false;
				update_target_link();
			},
			function(){

			}
		);
	}

	$.fn.outboundtrack = function(){
		$(this).each(function(i,ele) {
			var dis = $(ele);
			dis.on('click', function(e) {
				if(typeof(ga) === "function"){
					e.preventDefault();
					ga('send', 'event', 'outbound', 'click', dis.attr('href'), { hitCallback : function () { document.location.href = dis.attr('href'); } });
				}
			});
		});
	}

	var mainnav;
	$(document).ready(function(){
		mobileflag = $("#mobileflag");
		mainnav = $('.mainnav');
		$('a.submit').linkSubmitter();
		$('a.outboundtrack').outboundtrack();
		if(isMobile()){
			mobileMenu();
			mobileHeaderLinks();
			mobileFeatures();
		}else{
			desktopMenu();
		}
		allMenu();
		fancySearch();
		$('.gallery.gallery-columns-9').expandoGallery();
	});



});