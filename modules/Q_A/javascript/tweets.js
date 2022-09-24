$(document).ready(function() {
  setInterval(checkForNewTweets, 5000);
  initTweetReloader();
});

function checkForNewTweets() {
  $.getJSON(BASE_URL + "api/tweets/count_after.php", {id: last_tweet_id}, function(data) {
    if (data > 0) {
      $('#new_tweets').html('New tweets (' + data + '). <a href="#">Reload</a>?');
      $('#new_tweets').fadeIn();
    }
  });
}

function initTweetReloader() {
  $('#new_tweets').on('click', 'a', function() {
    $.getJSON(BASE_URL + "api/tweets/get_after.php", {id: last_tweet_id}, function(data) {
      $.each(data, function(i, tweet) {
        $('#tweets .tweet-data:first').before('<article class="tweet-data">' + 
          '<img src="' + BASE_URL + tweet.photo +'">' +
          '<span class="realname">' + 
          tweet.realname + 
          '</span>' + 
          ' <a href="' + BASE_URL + 'pages/tweets/list_user.php?username=' + 
          tweet.username  + 
          '" class="username">@' + 
          tweet.username + 
          '</a>' +
          '<span class="time">' + 
          tweet.time + 
          '</span>' + 
          '<div class="tweet-text">' + 
          tweet.text + '</div>' + 
          '</article>');
        last_tweet_id = tweet.id;
        $('#new_tweets').fadeOut();
      });
    });
  });
}
