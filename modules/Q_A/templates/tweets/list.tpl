{include file='common/header.tpl'}

<section id="tweets">
  <h2>Tweets</h2>

  <div id="new_tweets"></div>

  {foreach $tweets as $tweet}

  <article class="tweet-data">
    <img src="{$BASE_URL}{$tweet.photo}">
    <span class="realname">{$tweet.realname}</span>
    <a href="{$BASE_URL}pages/tweets/list_user.php?username={$tweet.username}" class="username">@{$tweet.username}</a>

    <span class="time">{$tweet.time}</span>
    <div class="tweet-text">{$tweet.text}</div>
  </article>

  {/foreach}

</section>

<script>last_tweet_id = {$last_tweet_id}</script>

<script src="{$BASE_URL}javascript/tweets.js"></script>

{include file='common/footer.tpl'}
