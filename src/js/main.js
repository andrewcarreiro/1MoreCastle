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
			click:true,
			scrollX : true,
			scrollY : false,
			bounce: false
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



	var mainnav;
	$(document).ready(function(){
		mainnav = $('.mainnav');
		$('a.submit').linkSubmitter();
		if($("#mobileflag").is(':visible')){
			mobileMenu();
			mobileFeatures();
		}else{
			desktopMenu();
		}
		allMenu();
	});

});