{include file='common/header.tpl'}

  <title>StackUnderflow</title>
  <div id="frontbody" class="container">
    {include file='common/navbar.tpl'}
  <div class="container">
  </div>


  <div class="jumbotron kp-info">
      <h1 class="text-center">StackUnderflow</h1>
      <p class="text-center">Ask anything you need to know!</p>
    </div>

  <div class="kp-body">

    {include file='common/login_modal.tpl'}
    {include file='common/signup_modal.tpl'}
        <div class="row">
          <div class="col-md-4 text-center">
            <img width="100" height="100" src="{$BASE_URL}images/assets/questionmark.png">
            <p class="pictureDescription">Ask if you need help</p>
          </div>
          <div class="col-md-4 text-center">
            <img width="100" height="100" src="{$BASE_URL}images/assets/magnifyingglass.png">
            <p class="pictureDescription">Find questions that interest you, and help other users</p>
          </div>
          <div class="col-md-4 text-center">
            <img width="100" height="100" src="{$BASE_URL}images/assets/chat.png">
            <p class="pictureDescription">Comment on questions and answers</p>
          </div>
        </div>

    </div>


    <div id="icons" class="kp-header">
      <div class="text-center">
        <img width="50" height="50" src="{$BASE_URL}images/assets/facebook.png">
        <img width="50" height="50" src="{$BASE_URL}images/assets/google_plus.png">
        <img width="50" height="50" src="{$BASE_URL}images/assets/feed.png">
      </div>
    </div>
    <center id="link">
      <a href="#link" class="btn btn-circle page-scroll">
        <h3>StackUnderflow - 101</h3>
      </a>
    </center>
  </div>


    <section id="stack101">
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>New on this website?</h3>
          <p>Our product is a web application to post and answer collaborative questions. Everything you wanna ask, just post it and let our community help you!</p>
        </div>
      </div>
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>Login / Register</h3>
          <p>But first you need to join our amazing community of users. For that you'll need to register in order to have your account, just click in "Sign up" at the right-top corner. After that just fill the input fields and submit</p>
          <p>Then every time you wanna use our website you just need to press "Login" and enter your credentials to log on.</p>
        </div>
      </div>
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>Ask a question.</h3>
          <p>If you're already logged in you could try ask a question. Just go to the top of the page and press "Ask a question" that sends you to the new question form. Fill it with a title, description and some tags (tags improve the chance of other user finds your question).</p>
          <p>While waiting for some answers, why not share-it on your favourite social network with just one click?</p>
        </div>
      </div>
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>Browse questions.</h3>
          <p>"Could I be truly the first to have this problem?", "Am I capable to help other champions of the doubt?" Simply try it!!! </p>
          <p>We have two super cool ways browse the content of our application. The amazing "browse bar" if you know what you want to search or simply have nice trip read some of the other user's questions, for that start your adventure clicking on "Browse questions".</p>
        </div>
      </div>
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>Answer and rate other user's questions.</h3>
          <p>"Hey I know the answer!", "This question is really interesting, how can I help if I don't know the answer?"</p>
          <p>On the question view window you could had your answer just filling the input space and click "submit answer". If you don't know the answer you could help giving an upvote, this way the question will have a better karma, better Karma increase the visibility of the question, in other words more chance to get an answer</p>
          <p>If think the question it's not appropriate you could give a "down vote", (please please don't be mean!).</p>
        </div>
      </div>
      <div class="101-row">
        <div class="col-md-12 text-center">
          <h3>Comments.</h3>
          <p>"I'm not understanding what you really need", "Why do you wanna slice some bananas with a sledge hammer instead of a rocket chainsaw?"</p>
          <p>Good questions  generally have more than one answer, debating them is our XXI's century epithet of free speech solution! Feel free to comment other users questions and answers</p>
          <p>BUT BE ADVISED! Mr. Bad Boy Salazar Admin could empty your precious comments if you're an escalator of the internet rage.</p>
        </div>
      </div>

  </section>
  {include file='common/footer.tpl'}
