$(document).ready(function(){
	function submitAnswer(content){
		$.ajax({
			url: BASE_URL + 'api/answers/create.php',
			type: 'POST',
			dataType: 'json',
			data: {
				questionid: QUESTION_ID,
				content: content
			},
			success: function(data){
				console.log(data);
				var answerTemplate = $($('#answer-template').children()[0]).clone();
				answerTemplate.find('.answer-content').text(data['content']);
				answerTemplate.find('.answer-submitter').text(data['authorname']);
				answerTemplate.find('.answer-upvote').attr("data-id", data['answerid']);
				answerTemplate.find('.answer-downvote').attr("data-id", data['answerid']);
				console.log(answerTemplate);
				$("#answer-form").before(answerTemplate);
			}
		});
	};

	function rateAnswer(answer, upvote, button){
		var container = $(button.parent().parent());
		container.find('.answer-upvote').removeClass('disabled');
		container.find('.answer-downvote').removeClass('disabled');
		if(upvote){
			container.find('.answer-upvote').addClass('disabled');
		}else container.find('.answer-downvote').addClass('disabled');

		$.ajax({
			url: BASE_URL + 'api/answer_ratings/create.php',
			data: {
				answer: answer,
				upvote: upvote
			}, success: function(data){
				container.find('.answer-rating').removeClass('text-danger');
				container.find('.answer-rating').removeClass('text-success');
				var totalRating = JSON.parse(data)['rating'];

				container.find('.answer-rating strong').text(totalRating);

				if(totalRating > 0){
					container.find('.answer-rating').addClass('text-success');
				}else{
					container.find('.answer-rating').addClass('text-danger');
				}
			}
		});
	}

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

	$(document).on('click', '#answer-button', function(event){
		submitAnswer($('#answer-content').val());

	});

	$(document).on('click', '.answer-upvote', function(event){

		rateAnswer($(this).data('id'), true, $(this));
	});
	$(document).on('click', '.answer-downvote', function(event){
		rateAnswer($(this).data('id'), false, $(this));
	});
});