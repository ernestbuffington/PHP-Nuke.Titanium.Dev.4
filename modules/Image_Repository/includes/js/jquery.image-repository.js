/************************************************************************
    Nuke-Evolution: Image Repository
    ======================================================
    Copyright (c) 2015 by lonestar-modules.com
    Author        : Lonestar
    Version       : 1.1.0
    Developer     : Lonestar - www.lonestar-modules.com
    Notes         : N/A
************************************************************************/

jquery_prefix(function($)
{
//-------------------------------------------------------------------------
//	VERSION CHECKER - START
//-------------------------------------------------------------------------	
	if(module_page === 'settings')
	{
		$.ajax({
			type: 'GET',
			url: 'https://versions.lonestar-modules.com/image_repository.xml',
			cache: false,
			dataType: 'xml',
			success: function (xml)
			{
				$(xml).find('version_check').each(function()
				{
					var download 	= $(this).find('latest_version_download').text();
					var lversion 	= $(this).find('latest_version').text();
					var upto_date 	= '<span style="color: green;">' + version_installed + '</span>';
					var out_of_date = '<a style="text-decoration:none;" href="' + download + '" target="_blank"><span style="color: red;">New Version Released</span></a>';
					var nversion 	= 'Installed: ' + ((version_installed !== lversion) ? out_of_date : upto_date) + ' | Latest: <span>' + lversion + '</span>';
					$('#version_alert').html(nversion);
				});
				
			},
			error: function (xml)
			{
				$('#version_alert').html('The XML File could not be processed correctly.');
			}
		});
	}
//-------------------------------------------------------------------------
//	VERSION CHECKER - START
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	INSERT THE DEFAULT VALUES FOR THE PROGRESS BAR FOR EACH USER - START
//-------------------------------------------------------------------------
	$('.progress-bar').css('background',(background_color_default == 'nocolor') ? '' : background_color_default);
	$('.progress-bar').css('border','1px solid ' + border_color_default);
	$('.progress-bar span').css('background-color',(percent_color_default == 'custom') ? custom_color_default : percent_color_default);
//-------------------------------------------------------------------------
//	INSERT THE DEFAULT VALUES FOR THE PROGRESS BAR FOR EACH USER - END
//-------------------------------------------------------------------------
	$('#background_color, #border_color, #percent_color, #custom_color').on('change keyup', function()
	{
//-------------------------------------------------------------------------
//	PROGRESS BAR PERCENTAGE COLOR
//-------------------------------------------------------------------------
		var percent_color = $('#percent_color').val();
		if(percent_color == 'custom')
		{
			var custom_color = $('#custom_color').val().replace('#', '');
			$('.progress-bar span').css('background', '#'+custom_color);
			$('#percent_color').css('width', '40%');
			$('#custom_color').show();
		} else {
			$('.progress-bar span').css('background-color', percent_color);
			$('#percent_color').css('width', '80%');
			$("#custom_color").hide();
		}
//-------------------------------------------------------------------------
//	PROGRESS BAR PERCENTAGE COLOR
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	PROGRESS BAR BACKGROUND COLOR
//-------------------------------------------------------------------------		
		var background_color = $('#background_color').val();
		if(background_color == 'nocolor')
		{
			$('.progress-bar').css('background','');
		} else {
			$('.progress-bar').css('background',background_color);
		}
//-------------------------------------------------------------------------
//	PROGRESS BAR BACKGROUND COLOR
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	PROGRESS BAR BORDER COLOR
//-------------------------------------------------------------------------	
		var border_color = $('#border_color').val();
		$('.progress-bar').css('border','1px solid ' + border_color);
//-------------------------------------------------------------------------
//	PROGRESS BAR BORDER COLOR
//-------------------------------------------------------------------------	
	});	
//-------------------------------------------------------------------------
//	PROGRESS PERCENT CUSTOM COLOR
//-------------------------------------------------------------------------		
	$('#custom_color').on('keyup', function() 
	{
		var custom_color = $('#custom_color').val().replace('#', '');
		$('#fileupload-progress-color').css('background-color', '#'+custom_color);
	});
//-------------------------------------------------------------------------
//	PROGRESS PERCENT CUSTOM COLOR
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	PROGRESS PERCENTAGE VIEWER
//-------------------------------------------------------------------------	
	$('.percentage').on('click', function()
	{
		var percent = $(this).data('id');
		$('.progress-bar span').css('width',percent + '%');
		//console.log(percent + ' - hello');
	});
//-------------------------------------------------------------------------
//	PROGRESS PERCENTAGE VIEWER
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	ONCLICK, GENERATE A THUMBNAIL FOR SELECTED IMAGE
//-------------------------------------------------------------------------	
	$('a.generate-thumbnail').on('click', function(event)
	{
		event.preventDefault();
		var pid = $(this).data('id');		
		$.ajax({
			method: 'POST',
			url: 'modules.php?name=' + module_name + '&op=generate_thumb',
			data: { pid: pid },
			dataType: 'json'
		})
		.done(function(response) 
		{
			if(response.error)
			{
				console.log(response.error);
				alert(response.error);
			} else {
				$('#thumbnail_holder'+pid).html('<div class="thumbnail_border"><img class="thumbnail_border" src="' + upload_dir + '/thumbs/thumb_' + response.filename + '" border="0" /></div>');
			}
		});
	});
//-------------------------------------------------------------------------
//	ONCLICK, GENERATE A THUMBNAIL FOR SELECTED IMAGE
//-------------------------------------------------------------------------		
	$(document).on('click','.code-popup',function(event)
	{
		event.preventDefault();
		var id = $(this).data('id');
		$.fancybox.open(
		{			
			href : 'modules.php?name=' + module_name + '&op=image_modal&pid=' + id,
			type : 'ajax',
			padding : 5
		});
	});
//-------------------------------------------------------------------------
//	ONCLICK, DELETE THE IMAGE FROM DATABASE AND FOLDER
//-------------------------------------------------------------------------
	$(document).on('click','.delete-image',function(event)
	{
		event.preventDefault();
		var id 		= $(this).data('id');
		var parts 	= id.split(':::');
		$.confirm({
			title: "Confirmation Required",
			content: "Are you sure you wish to delete?<br />This can not be undone.",
			confirmButton: "Yes, Go ahead",
			cancelButton: "No, Changed my Mind",
			confirmButtonClass: "btn-info",
			cancelButtonClass: "btn-danger",
			post: "false",
			animation: "RotateY",
			confirm: function()
			{
				$.post('modules.php?name=' + module_name + '&op=image_delete', 
				{
					'pid' : parts[0]
				}, 
				function(r)
				{
//-------------------------------------------------------------------------
//	IF THE USER HAS REACHED HIS QUOTA, REMOVE THE UPLOAD TABLE.
//-------------------------------------------------------------------------
					if((quota_user-parts[1]) < quota_limit)
					{
						$('#image_repository_upload').css('display','');
						$('#image_repository_quota').css('display','none');
					}
//-------------------------------------------------------------------------
//	IF THE USER HAS REACHED HIS QUOTA, REMOVE THE UPLOAD TABLE.
//-------------------------------------------------------------------------
					imagecount--;
					if(imagecount == 0)
					{
						$('#imagelist').hide();
						$('#noimages').show();
					}
					$('#image-'+parts[0]).remove();
					$('.pagination_total').text(imagecount);
				});
			},
			backgroundDismiss: false,
		});
	});
//-------------------------------------------------------------------------
//	ONCLICK, DELETE THE IMAGE FROM DATABASE AND FOLDER
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	LETS REMOVE THE USERS FOLDER AND ALL THE INFORMATION FROM DATABASE.
//-------------------------------------------------------------------------
	$(document).on('click', '.delete-user-image', function(event)
	{
		event.preventDefault();
		var id = $(this).data('id');
		$.confirm({
			title: "Confirmation Required",
			content: "Are you sure you wish to delete?<br />This can not be undone.",
			confirmButton: "Yes, Go ahead",
			cancelButton: "No, Changed my Mind",
			confirmButtonClass: "btn-info",
			cancelButtonClass: "btn-danger",
			post: "false",
			animation: "RotateY",
			confirm: function()
			{
				var parts 	= id.split(':::');
				$.post('modules.php?name=' + module_name + '&op=image_delete_admin',
				{
					'pid' : parts[0], 'user' : parts[1]
				}, 
				function(data)
				{
					if(data.error)
					{
						alert(data.error);
					} else {
						$('#user-image-'+data.pid).remove();
					}
					console.log(data.error);
				}, 'json');
			},
			backgroundDismiss: false,
		});
	});
//-------------------------------------------------------------------------
//	LETS REMOVE THE USERS FOLDER AND ALL THE INFORMATION FROM DATABASE.
//-------------------------------------------------------------------------
	$('a.delete-user').on('click', function(event)
	{
		event.preventDefault();
		var user = $(this).data('id');
		$.confirm({
			title: "Confirmation Required",
			content: "Are you sure you wish to delete?<br />This can not be undone.",
			confirmButton: "Yes, Go ahead",
			cancelButton: "No, Changed my Mind",
			confirmButtonClass: "btn-info",
			cancelButtonClass: "btn-danger",
			post: "false",
			animation: "RotateY",
			confirm: function()
			{
				$.ajax({
					method: 'POST',
					url: 'modules.php?name=' + module_name + '&op=user_delete_admin',
					data: { user: user },
					dataType: 'json'
				})
				.done(function(response) 
				{
					if(response.error)
					{
						console.log(response.error);
						alert(response.error);
					} else {
						$('#user-'+response.user).remove();
					}
				});
			},
			backgroundDismiss: false,
		});
	});
//-------------------------------------------------------------------------
//	OK, lET'S DO THE CODING FOR THE UPLOAD SCRIPT.
//-------------------------------------------------------------------------	
	$('#submit').click(function()
	{		
		$('#myimage').upload('modules.php?name=' + module_name + '&op=image_data', function(response)
		{
			if(response.error)
			{
				$('.progress-bar span').css('width','0%');
				$('#myimage').replaceWith($('#myimage').clone());
				$('#myimage').val('');
				$('#errortable_header').html(lang_attention);
				var error  = '  <tr id="errortable">'
				    error += '    <td class="row1" colspan="2" style="height:30px;text-align:center;letter-spacing:1px;">' + response.error + '</td>'
					error += '  </tr>'
				$('#errortable_tr').after(error);
				//console.log(imagecount);
				setTimeout(function() 
				{
					$('#errortable').hide();
					if(imagecount > 0)
					{
						$('#imagelist').show();
						$('.imagethumbs').show();
					} 
					else 
					{
						$('#noimages').show();
						$('#imagelist').hide();
					}
					$('#errortable_header').html(lang_imagelist);
				}, 8000);				
				$('#noimages').hide();
				$('#imagelist').hide();
				$('.imagethumbs').hide();
				//console.log(response.error);
			}
			else
			{
//-------------------------------------------------------------------------
//	OK, THE IMAGE HAS BEEN UPLOADED, LET'S RESET THE PERCENTAGE.
//-------------------------------------------------------------------------
				$('.progress-bar span').css('width','0%');
				$('#myimage').replaceWith($('#myimage').clone());
				$('#myimage').val('');
//-------------------------------------------------------------------------
//	OK, THE IMAGE HAS BEEN UPLOADED, LET'S RESET THE PERCENTAGE.
//-------------------------------------------------------------------------
				$('#noimages').hide();
				var content  = '<tr class="imagethumbs" id="image-' + response.nextid + '">'
					content += '  <td class="row1" style="text-align:center;"><div class="thumbnail_border"><img src="' + upload_dir + '/thumbs/thumb_' + response.image + '" border="0" /></div></td>'					
					content += '  <td class="row1">'
					content += '    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" id="imagetable">'
					content += '      <tr>'
					content += '        <td class="row1" style="width:20%;height:30px;text-align:right;letter-spacing:1px;">' + lang_directlink + '</td>'
					content += '        <td class="row1" style="width:80%;height:30px;text-align:center;letter-spacing:1px;"><input class="glowing-border select-style" name="bbcode" onclick="this.select();" onmouseover="this.select();" style="cursor:copy;padding-left:4px;padding-right:4px;letter-spacing:1px;width:98%;" type="text" value="' + nukeurl + '/' + upload_dir + '/' + response.image + '" readonly /></td>'
					content += '      </tr>'
					content += '      <tr>'
					content += '        <td class="row1" style="width:20%;height:30px;text-align:right;letter-spacing:1px;">' + lang_bbcode + '</td>'
					content += '        <td class="row1" style="width:80%;height:30px;text-align:center;letter-spacing:1px;"><input class="glowing-border select-style" name="bbcode" onclick="this.select();" onmouseover="this.select();" style="cursor:copy;padding-left:4px;padding-right:4px;letter-spacing:1px;width:98%;" type="text" value="[img]' + nukeurl + '/' + upload_dir + '/' + response.image + '[/img]" readonly /></td>'
					content += '      </tr>'
					content += '      <tr>'
					content += '        <td class="row1" style="width:20%;height:30px;text-align:right;letter-spacing:1px;">' + lang_options + '</td>'
					content += '        <td class="row1" style="width:20%;height:30px;text-align:left;letter-spacing:1px;"><a'+image_viewer+' href="' + nukeurl + '/' + upload_dir + '/' + response.image + '">' + lang_full + '</a> | <a data-id="' + response.nextid + ':::' + response.size + '" class="delete-image" href="javascript:void(0);">' + lang_delete + '</a></td>'
					content += '      </tr>'
					content += '	</table>'
					content += '	</td>'
					content += '</tr>'
				$('#imagelist').after(content);
				imagecount++;
				if(imagecount > imagecount_per_page)
				{
					$('.imagethumbs').last().remove();
					$('.pagination_total').text(imagecount);
				}

//-------------------------------------------------------------------------
				var total = +response.size + +quota_user;
				quota_user = total;
				if(quota_user > quota_limit)
				{
					$('#image_repository_upload').css('display','none');
					$('#image_repository_quota').css('display','');
				}

				//var total = parseInt(response.size) + parseInt(quota_user);
				//console.log(response.size + ' - ' + total + ' - ' + quota_user);
				// NOW ALL I HAVE TO DO IS, SHOW THE QUOTA LIMIT IN THE FORUMS.
//-------------------------------------------------------------------------

			}
		},
		function(prog, value)
		{
			$('.progress-bar span').css('width',value + '%');
			//console.log(prog + ' - ' + value);
		});
		//console.log('I have clicked submit button biatch.');
	});
//-------------------------------------------------------------------------
//	OK, lET'S DO THE CODING FOR THE UPLOAD SCRIPT.
//-------------------------------------------------------------------------	
	$.getScript('modules/' + module_name + '/includes/js/jquery.xhr.js');
});