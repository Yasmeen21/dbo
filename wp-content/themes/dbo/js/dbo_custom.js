var $j = jQuery.noConflict();

$j(document).ready(function(){
	$j('#slider').nivoSlider({
		pauseTime: 4000, // How long each slide will show
	});

	//('#slider').data('nivoslider').stop();

	/*
	if ( !$j.cookie("cta") ) {
		$j('#closeIcon').fadeIn(1000);

		$j('#cta').fadeIn(300, function(){
			$j('#closeIconImg, #page').click(function(){
				$j('#closeIcon').fadeOut(1000);
				$j('#cta').fadeOut(300, function(){
					$j('#closeIconImg, #page').unbind();
				});
			});
		});

		$j.cookie("cta", "1", { expires: 14, path: '/' });
	}


	$j('a[href=#]', '.menu').each(function(){
		$j(this).parents('li:first').addClass('cta_link');

		$j(this).click(function(){
			$j('#closeIcon').fadeIn(1000);

			$j('#cta').fadeIn(300, function(){
				$j('#closeIconImg, #page').click(function(){
					$j('#closeIcon').fadeOut(1000);
					$j('#cta').fadeOut(300, function(){
						$j('#closeIconImg, #page').unbind();
					});
				});
			});
		});
		
	});
	*/
});