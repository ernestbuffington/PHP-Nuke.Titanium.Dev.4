{include file='common/header.tpl'}

<section id="register">
  <h2>Register</h2>

  <form action="{$BASE_URL}actions/users/register.php" method="post" enctype="multipart/form-data">
    <label>Name:<br> 
      <input type="text" name="realname" value="{$FORM_VALUES.realname}"> 
      <span class="field_error">{$FIELD_ERRORS.username}</span>
    </label>
    <br>
    <label>Username:<br> 
      <input type="text" name="username" value="{$FORM_VALUES.username}">
    </label>
    <br>
    <label>Password:<br> 
      <input type="password" name="password" value="">
    </label>
    <br>
    <label>Photo:<br>
      <input type="file" name="photo">
    </label>
    <input type="submit" value="Register">
  </form>

</section>

{include file='common/footer.tpl'}
