jQuery(function($){

	$.fn.linkSubmitter = function(){
		if($(this).length > 0){
			$(this).each(function(i,ele){
				var dis = $(ele);
				dis.on('click', function(){
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

		
	});

});