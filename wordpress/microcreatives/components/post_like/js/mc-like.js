jQuery(document).ready(function($){
	
	//-----------------------------------------------------------------
	// MCLike
	//-----------------------------------------------------------------
	
	$('body').on('click','.mc-like', function() {
			

			var $likeLink = $(this);
			var $id = $(this).attr('id');
			var $that = $(this);
			
			if($likeLink.hasClass('liked')) return false;
			if($(this).hasClass('inactive')) return false;
			
			var $dataToPass = {
				action: 'mc-like',
				likes_id: $id
			}
			
			$.post(mcLike.ajaxurl, $dataToPass, function(data){
				$likeLink.find('span').html(data);
				$likeLink.addClass('loved').attr('title','You already like this!');
				$likeLink.find('span').css({'opacity': 1,'width':'auto'});
			});
			
			$(this).addClass('inactive');
			
			return false;
	});
	
	
});