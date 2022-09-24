$(document).ready(function(){

	function rate(upvote){
		$('#upvote-button').removeClass('disabled');
		$('#downvote-button').removeClass('disabled');

		if(upvote){
			$('#upvote-button').addClass('disabled');
		}else $('#downvote-button').addClass('disabled');
		$.ajax({
			url: BASE_URL + 'api/question_ratings/create.php',
			data: {
				question: QUESTION_ID,
				upvote: upvote
			},
			success: function(data){
				
				$('#rating-value').removeClass('text-danger');
				$('#rating-value').removeClass('text-success');

				var totalRating = JSON.parse(data)['rating'];

				$('#rating-value strong').text(totalRating);

				if(totalRating > 0){
					$('#rating-value').addClass('text-success');
				}else{
					$('#rating-value').addClass('text-danger');
				}
			}
		})
	};

	$(document).on('click', '#upvote-button', function(event){
		rate(true);
	});

	$(document).on('click', '#downvote-button', function(event){
		rate(false);
	});

});