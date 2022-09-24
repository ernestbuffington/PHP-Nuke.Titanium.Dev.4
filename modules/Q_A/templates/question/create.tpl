{include file='common/header.tpl'}
{include file='common/navbar.tpl'}

<link rel="stylesheet" href="{$BASE_URL}css/bootstrap-tagsinput.css">
<script src="{$BASE_URL}javascript/bootstrapValidator.min.js"></script>


  <script>

  $(document).ready(function() {
  $('#questionForm').bootstrapValidator({
      container: '#messages-create',
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },

      fields: {
          title: {
              validators: {
              stringLength: {
                    min: 5,
                      max: 255,
                      message: 'The title must be 5 to 255 characters long'
                  },
                  notEmpty: {
                      message: 'The title is required and cannot be empty'
                  }
              }
          },
          content: {
              validators: {
              stringLength: {
                    min: 5,
                      max: 1000,
                      message: 'The details field must be 5 to 1000 characters long'
                  },
                  notEmpty: {
                      message: 'The details field is required and cannot be empty'
                  }
              }
          }
      }
  });
  });

</script>

<div class="container-container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="well bs-component">
        <form class="form-horizontal" method="POST" action="{$BASE_URL}actions/question/create.php" id="questionForm">
          <fieldset>
            <legend>
              Submit a question
            </legend>
            <div class="form-group">
              <label for="inputTitle" class="col-lg-2 control-label">Title</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" placeholder="Ask away!" name="title">
              </div>
            </div>
            <div class="form-group">
              <label for="inputDetails" class="col-lg-2 control-label">Details</label>
              <div class="col-lg-10">
                <textarea class="form-control" id="inputDetails" name="content"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTags" class="col-lg-2 control-label">Tags</label>
              <div class="col-lg-10">
                <input type="text" data-role="tagsinput" class="form-control" id="inputTags" name="tags">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
              <div id="messages-create"></div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="{$BASE_URL}javascript/bootstrap-tagsinput.js"></script>
<script>
$('#inputTags').tagsinput({
  confirmKeys: [13, 32, 44]
});
</script>


{include file='common/footer.tpl'}
