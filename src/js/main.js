jQuery(function($){

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
		var hold_y_start;
		var hold_y_end;
		$('.post>a').on('click', function(e){
			if(isMobile()){
				e.preventDefault();	
			}
		});
		$('.post>a').on('touchstart', function(e){
			hold_y_start = hold_y_end = e.originalEvent.touches[0].clientY;
		});

		$('.post>a').on('touchmove', function(e){
			hold_y_end = e.originalEvent.touches[0].clientY;
		});

		$('.post>a').on('touchend', function(e){
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

		suggestedresults.hover(
			function(){
				target_link = false;
				update_target_link();
			},
			function(){

			}
		);
	}

	var mainnav;
	$(document).ready(function(){
		mobileflag = $("#mobileflag");
		mainnav = $('.mainnav');
		$('a.submit').linkSubmitter();
		if(isMobile()){
			mobileMenu();
			mobileHeaderLinks();
			mobileFeatures();
		}else{
			desktopMenu();
		}
		allMenu();
		fancySearch();
		
	});



});