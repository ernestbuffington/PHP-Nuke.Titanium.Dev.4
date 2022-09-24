{include file='common/header.tpl'}
{include file='common/navbar.tpl'}

<div class="jumbotron kp-info">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-justify">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">User Profile</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-4 text-justify">
              <img width="180" height="130" src="images/avatar.png" class="img-responsive img-center">
              <br/>
              <div class="row">

                <input class="form-control" type="file">

              </div>
              <h4>Bibliography</h4>
              <textarea class="form-control" rows="5"> {$titanium_user.bibliography}</textarea>

              </div>
              <div class="col-md-6 text-justify">
                <br/>
                <h3>Personal Info</h3>

                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="name" value="{$titanium_user.name}" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                      <input class="form-control" value="{$titanium_user.surname}" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Company:</label>
                    <div class="col-lg-8">
                      <input class="form-control" value="{$titanium_user.company}" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                      <input class="form-control" value="{$titanium_user.email}" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Save Changes" type="button">
                      <span></span>
                      <input class="btn btn-default" value="Cancel" type="reset">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {include file='common/footer.tpl'}
