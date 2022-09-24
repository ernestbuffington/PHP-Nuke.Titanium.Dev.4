{include file='common/login_modal.tpl'}
{include file='common/signup_modal.tpl'}
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{$BASE_URL}">StackUnderflow</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

          {if $USERNAME}
            {literal}
              <li><a href="http://gnomo.fe.up.pt/~lbaw1414/final/pages/question/create.php">Ask a question</a></li>
            {/literal}
          {/if}
          <!-- <li><a href="{$BASE_URL}pages/question/create.php">Ask a question</a></li> -->

          <li><a href="{$BASE_URL}pages/question/list.php?page=1">Browse questions</a></li>

        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </form>
        <ul class="nav navbar-nav navbar-right">

			{if $USERNAME}
				{include file='common/menu_logged_in.tpl'}
			{else}
				{include file='common/menu_logged_out.tpl'}
			{/if}
        </ul>
      </div>
    </div>
  </nav>
