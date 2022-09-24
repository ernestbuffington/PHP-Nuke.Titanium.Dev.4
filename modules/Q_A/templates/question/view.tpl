{include file='common/header.tpl'}
{include file='common/navbar.tpl'}
<script type="text/javascript">
  BASE_URL = "{$BASE_URL}";
  QUESTION_ID = {$question.questionid};
</script>
<div id="fb-root"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-1">
     <div class="pull-right">
      {if $loggedIn}
      <div><button id="upvote-button"class="btn btn-success btn-sm {if $titanium_userRating > 0} disabled {/if}"><i class="fa fa-chevron-up"></i></button></div>
      <span id="rating-value" class="{if $rating > 0}text-success{else}text-danger{/if}"><strong>{$rating}</strong></span>
      <div><button id="downvote-button"class="btn btn-danger btn-sm {if $titanium_userRating < 0} disabled {/if}"><i class="fa fa-chevron-down"></i></button></div>
      {else}
      <div><button class="btn btn-success btn-sm disabled"><i class="fa fa-chevron-up"></i></button></div>
      <span id="rating-value" class="{if $rating > 0}text-success{else}text-danger{/if}"><strong>{$rating}</strong></span>
      <div><button class="btn btn-danger btn-sm disabled"><i class="fa fa-chevron-down"></i></button></div>
      {/if}
      </div>
    </div>
    <div class="col-lg-6">
      <ul class="list-group">
        <li class="list-group-item">
          <h3 class="list-group-item-heading">{$question.title}</h3>
          <hr/>
          <p class="list-group-item-text">{$question.content}</p>
          <hr/>
          <div class="row">
            <div class="col-lg-8">
              <span class="text-muted">Tags: </span>
              {foreach $tags as $tag}
                <span class="label label-info">{$tag['name']}</span>
              {/foreach}
            </div>
            <div class="col-lg-4">
              <p class="list-group-item-text text-muted pull-right"><small>Submitted by: {$createdUser.username}</small></p>
            </div>
          </div>
          <hr/>
          <div id="socialRow" class="row" style="margin-left:10px">
            <div id="sharefacebook" class="fb-share-button" data-layout="button_count"></div>
            <a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="StackUnderflow" data-dnt="true"><img src='http://s1.postimg.org/ae4co9323/tweet.png' border='0' alt="tweet" height='27px'/></a>
            <div class="g-plus" data-action="share" data-annotation="bubble" style="margin-top: 5px"></div>
          </div>
        </li>
        <a href="{$BASE_URL}pages/question/edit_question.php?id={$question.questionid}" class="btn btn-primary btn-xs pull-right">Edit</a>
      </ul>
    </div>
  </div>
  {foreach $answers as $answer}
  <div class="row">
      <div class="col-lg-1">
        <div class="pull-right">
          {if $loggedIn}
          <div><button data-id="{$answer.answerid}" class="answer-upvote btn btn-success btn-sm {if $answer.userRating > 0} disabled {/if}"><i class="fa fa-chevron-up"></i></button></div>
          <span class="answer-rating {if $answer.userRating > 0}text-success{else}text-danger{/if}"><strong>{$answer.rating}</strong></span>
          <div><button data-id="{$answer.answerid}" class="answer-downvote btn btn-danger btn-sm {if $answer.userRating < 0} disabled {/if}"><i class="fa fa-chevron-down"></i></button></div>
          {else}
          <div><button class="btn btn-success btn-sm disabled"><i class="fa fa-chevron-up"></i></button></div>
          <span class="answer-rating {if $rating > 0}text-success{else}text-danger{/if}"><strong>{$answer.rating}</strong></span>
          <div><button class="btn btn-danger btn-sm disabled"><i class="fa fa-chevron-down"></i></button></div>
          {/if}
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="list-group">
          <li class="list-group-item">
            <p class="list-group-item-text">{$answer.content}</p>
            <hr/>
            <div class="row">
              <div class="col-lg-8">
              </div>
              <div class="col-lg-4">
                <p class="list-group-item-text text-muted pull-right"><small>Submitted by: {$answer.authorname}</small></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-lg-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" class="form-control" placeholder="add a comment" style="border: none"></input>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
  {/foreach}
  <div class="row" id="answer-form">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-6">
      <ul class="list-group">
        <li class="list-group-item">
          <textarea id="answer-content" class="form-control"></textarea>
          <button id="answer-button" class="btn btn-success">Submit answer</button>
        </li>
      </ul>
    </div>
  </div>

<div id="answer-template" style="display: none">
  <div class="row">
      <div class="col-lg-1">
        <div class="pull-right">
          {if $loggedIn}
          <div><button data-id="" class="answer-upvote btn btn-success btn-sm disabled"><i class="fa fa-chevron-up"></i></button></div>
          <span class="answer-rating text-success"><strong>1</strong></span>
          <div><button data-id="" class="answer-downvote btn btn-danger btn-sm"><i class="fa fa-chevron-down"></i></button></div>
          {else}
          <div><button class="btn btn-success btn-sm disabled"><i class="fa fa-chevron-up"></i></button></div>
          <span class="answer-rating text-success"><strong>1</strong></span>
          <div><button class="btn btn-danger btn-sm disabled"><i class="fa fa-chevron-down"></i></button></div>
          {/if}
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="list-group">
          <li class="list-group-item">
            <p class="list-group-item-text answer-content"></p>
            <hr/>
            <div class="row">
              <div class="col-lg-8">
              </div>
              <div class="col-lg-4">
                <p class="list-group-item-text text-muted pull-right"><small>Submitted by: <span class="answer-submitter"></span></small></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-lg-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" class="form-control" placeholder="add a comment" style="border: none"></input>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>

</div> <!-- end container-->
<script type="text/javascript" src="{$BASE_URL}javascript/view-question.js"></script>
{include file='common/footer.tpl'}
