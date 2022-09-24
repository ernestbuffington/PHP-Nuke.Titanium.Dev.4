<!-- <script src="{$BASE_URL}javascript/jquery.validate.min.js"></script> -->
<!-- <script src="/lbaw/final/javascript/jquery.validate.min.js"></script> -->
<script src="{$BASE_URL}javascript/bootstrapValidator.min.js"></script>

<!-- Validator Antigo


		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

-->


<script>

	$(document).ready(function() {
	$('#signupForm').bootstrapValidator({
	    container: '#messages',
	    feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	    },

	    fields: {
	        name: {
	            validators: {
					stringLength: {
	                	min: 2,
	                    max: 100,
	                    message: 'The first name must be 2 to 100 characters long'
	                },
	                notEmpty: {
	                    message: 'The first name is required and cannot be empty'
	                }
	            }
	        },
	        surname: {
	            validators: {
					stringLength: {
	                	min: 2,
	                    max: 100,
	                    message: 'The username must be 2 to 100 characters long'
	                },
	                notEmpty: {
	                    message: 'The last name is required and cannot be empty'
	                }
	            }
	        },
	        username: {
	            validators: {
	            	stringLength: {
	                	min: 3,
	                    max: 25,
	                    message: 'The username must be 3 to 25 characters long'
	                },
	                notEmpty: {
	                    message: 'The last name is required and cannot be empty'
	                }
	            }
	        },
	        email: {
	            validators: {
	                notEmpty: {
	                    message: 'The email address is required and cannot be empty'
	                },
	                emailAddress: {
	                    message: 'The email address is not valid'
	                }
	            }
	        },
	        password: {
	            validators: {
	                notEmpty: {
	                    message: 'The password is required and cannot be empty'
	                },
	                stringLength: {
	                	min: 5,
	                    max: 20,
	                    message: 'The password must be 5 to 20 characters long'
	                }
	            }
	        },
	        confirm_password: {
	            validators: {
	                notEmpty: {
	                    message: 'The content is required and cannot be empty'
	                },
	                identical: {
	                    field: 'password',
	                    message: 'The password and its confirmation do not match'
	                },
	                stringLength: {
	                    max: 500,
	                    message: 'The content must be less than 500 characters long'
	                }
	            }
	        }

	    }
	});
	});

</script>
	

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Sign up</h4>
			</div>

			<form class="form-horizontal" action="{$BASE_URL}actions/registered_user/create.php" method="POST" id="signupForm">
				<div class="modal-body">
					<fieldset>
						<div class="form-group">
							<label class="col-lg-3 control-label">First name:</label>
							<div class="col-lg-8">
								<input class="form-control" name="name" type="text" id="firstname">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Last name:</label>
							<div class="col-lg-8">
								<input class="form-control" name="surname" type="text" id="lastname">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Username:</label>
							<div class="col-md-8">
								<input class="form-control" name="username" type="text" id="username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Company:</label>
							<div class="col-lg-8">
								<input class="form-control" name="company" type="text" id="company">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email:</label>
							<div class="col-lg-8">
								<input class="form-control" name="email" type="text" id="email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Password:</label>
							<div class="col-md-8">
								<input class="form-control" name="password" type="password" id="password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Confirm password:</label>
							<div class="col-md-8">
								<input class="form-control" name="confirm_password" type="password" id="confirm_password">
							</div>
						</div>
					    <div class="form-group">
				        	<div class="col-md-9 col-md-offset-3">
				            <div id="messages"></div>
				        </div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Register</button>
				</div>
			</form>

		</div>

	</div>
</div>