//---------------------------------------------------------------------
//	GET THE JQUERY PREFIX, AS EVOLUTION USES JQUERY NO-CONFLICT,
//	SO WE HAVE TO USE THE NO-CONFLICT PREFIX.
//---------------------------------------------------------------------
var jquery_prefix 	= (which_cms === 'ravennuke') ? $ : nuke_jq;
//---------------------------------------------------------------------

/* 
If the person adding a download, tries to leave the page before submitting to the database, 
This jQuery function will run and delete the pre-made download from the database. 
*/
if (module_page == 'newfile')
{
	jquery_prefix(window).on("beforeunload", function() 
	{
		return confirm_leave_page;
	});

	jquery_prefix(window).unload(function () 
	{
		var did = jquery_prefix('#did').val();
		if (did)
			jquery_prefix.post(admin_file + '.php?op=' + modname + '&action=deleteitem', { "did": did } );
	});
}

jquery_prefix(function($)
{
	$('.jcarousel').jcarousel();
	$('a[data-modal]').click(function(event) 
	{
		event.preventDefault();		
		jquery_prefix.getJSON('modules.php?name='+module_name+'&action=copyright', function( data ) 
		{
			var copyright_information  = '<table style="width: 800px" border="0" cellpadding="6" cellspacing="1">'
				copyright_information += '  <tr>'
				copyright_information += '    <td class="acenter" colspan="2">'+data.CopyrightHeader+'</td>'
				copyright_information += '  </tr>'

				$.each(data, function(index, value) 
				{
					if (value && index != 'CopyrightHeader')
					{
						var regex = /(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/ig
        				// Replace plain text links by hyperlinks
        				var replaced_text = value.replace(regex, "<a href='$1' target='_blank'>$1</a>");
						copyright_information += '  <tr>'
						copyright_information += '    <td>'+index+'</td>'
						copyright_information += '    <td>'+replaced_text+'</td>'
						copyright_information += '  </tr>'
					}
				});
				copyright_information += '</table>'

			$.MessageBox({
				top: "10%",
				message: copyright_information
			});			
		});
	});

	switch(module_page)
	{
		case 'categories':
		case 'comments':
		case 'editcat':
		case 'editfile':
		case 'files':
		case 'newcat':
		case 'newfile':

			$("#adding_new_download").submit(function(event)
			{
				$(window).off("beforeunload");
				$(window).off("unload");
			});				

//---------------------------------------------------------------------
//	ATTACH LOCALLY HOSTED FILE TO A DOWNLOAD
//---------------------------------------------------------------------
			$('.atitle').bind('input click', function() 
			{
				var id 		= $(this).data('titleid');
				var atitle 	= $('input[name="atitle'+id+'"]').val();
				$('.attachment').attr('data-atitle'+id, atitle);
				// console.log(id+' - '+atitle);
			});

			$(document).on('click','#isuploaded',function() 
			{
				var isuploaded = $(this).text();
				$('.attachment_options').toggle('slow');
				if(isuploaded == lang_show_local)
				{
					$('#isuploaded > span').text(lang_hide_local);
				} else {
					$('#isuploaded > span').text(lang_show_local);
				}
			});

			$('.attachment').click(function(event)
			{
				event.preventDefault();
				var id = $(this).data('id');
				if($('input[name="atitle'+id+'"]').val() === '')
				{
					$('input[name="atitle'+id+'"]').css('border', '1px solid red');
				}
				else 
				{
					var did = $(this).data('did');
					var atitle = $(this).data('atitle'+id);
					var filename = $(this).data('filename');
					var filesize = $(this).data('filesize');
					$.post(admin_file + '.php?op=' + modname + '&action=attachfile', 
					{
						'did' : did,
						'title' : atitle,
						'name' : filename,
						'size' : filesize
					}, 
					function(response) 
					{
						$('#attachment-'+id).remove(); 
						var content  = '  <tr id="file-' + response.fid + '">'
							content += '    <td style="width:25%; overflow:hidden; text-overflow:ellipsis;">' + response.title + '</td>'
							content += '    <td style="width:45%; overflow:hidden; text-overflow:ellipsis;">' + response.file + '</td>'
							content += '    <td style="width:20%; text-align:center;">' + response.size + '</td>'
							content += '    <td style="width:10%; text-align:center;">'
							content += '		<span data-id="' + response.fid + '" class="dm-sprite delete-button delete-download"></span>'
							content += '    </td>'
							content += '</tr>'
						$('#fileupload_submit').before(content);
					}, 'json');
				}
			});
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	JQUERY COLOR PICKER FOR CATEGORY AND DOWNLOAD TITLES
//---------------------------------------------------------------------
			$('#colorize').ColorPicker(
			{
				color: $('#colorize').val(),
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).ColorPickerHide();
				}, onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				}, onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				}, onChange: function (hsb, hex, rgb) {
					$('#colorize').val('#' + hex);
					$('.color_title').css('color', '#' + hex); }
			});

			$('#colorize, #title').bind('keyup blur change input', function() {
				var color = ($('#colorize').val() == '') ? '' : $('#colorize').val(),
					title = $('#title').val();
				$('.color_title').css('color', color);
				$('.color_title').html(title);
			});
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	UPDATE THE TEXTAREAS TO USE SCEDITOR
//---------------------------------------------------------------------
			$('#description, #fixes').sceditor({
				plugins: "bbcode",
				style: css_folder + 'sceditor/jquery.sceditor.default.min.css',
				toolbar: "bold,italic,underline,strike|left,center,right,justify|emoticon|font,size,color,removeformat|bulletlist,orderedlist|code,quote|image,email,link,unlink|youtube|maximize,source",
				fonts: "Arial,Arial Black,Comic Sans MS,Courier New,Georgia,Impact,Sans-serif,Serif,Times New Roman,Trebuchet MS,Verdana"
			});
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	UPLOAD FILES
//---------------------------------------------------------------------
			$('.fileupload').click(function(event)
			{
				event.preventDefault();
				var did 	= $('#did').val();
				var ftitle 	= $('#ftitle').val();

				if($('#fupload')[0].files[0].size > post_max_size)
				{
					alert("Sorry, The file you have selected is too large to be uploaded, You will need to upload the file manually, As shown in the instructions.");
				}
				else if(ftitle === '')
				{
					$('#ftitle').css('border', '1px solid red');
				}
				else
				{
					$('#fupload').upload(admin_file + '.php?op=' + modname + '&action=uploadfile',
					{
						uploaddir: 	uploaddir, 
						did: 		did, 
						title: 		ftitle
					},
					function(response)
					{
						if(response.error)
						{
							console.log(response.error);
						} 
						else
						{
							$('#fupload').replaceWith($('#fupload').clone());
							$('#fupload, #ftitle').val('').css('border', '1px solid');
							$('#fileupload-percentage').html('-');

							var content  = '  <tr id="file-' + response.fid + '">'
								content += '    <td style="width:25%; overflow:hidden; text-overflow:ellipsis;">' + response.title + '</td>'
								content += '    <td style="width:45%; overflow:hidden; text-overflow:ellipsis;"><a style="text-decoration:none;" href="' + admin_file + '.php?op=file_repository&amp;action=downloadfile&amp;filename=' + response.file + '&amp;filesize=' + response.size + '">' + response.file + '</a></td>'
								content += '    <td style="width:20%; text-align:center;">' + response.size + '</td>'
								content += '    <td style="width:10%; text-align:center;">'
								content += '      <i data-id="' + response.fid + '" class="fa fa-times-circle delete-download"></i>'
								content += '    </td>'
								content += '</tr>'
							$('#fileupload_submit').before(content);
							// $('.fileupload').attr('disabled','disabled');
						}
					},			
					function(prog, value)
					{
						$('#fileupload-percentage').html(value+'%');
					});
				}
			});

			$(document).on('click','.delete-download',function(event)
			{
				event.preventDefault();
				var id = $(this).data('id');
				$.post(admin_file + '.php?op=' + modname + '&action=deletefile&fid=' + id, 
				{ 
					'fid' : id 
				}, 
				function(data,status) 
				{ 
					$('#file-'+id).fadeOut('slow'); 
				});
			});
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	UPLOAD SCREENSHOTS
//---------------------------------------------------------------------
			$('.imageupload').click(function(event)
			{
				event.preventDefault();
				var did 	= $('#did').val();
				var stitle 	= $('#stitle').val();

				if (stitle == '')
				{
					$('#stitle').css('border', '1px solid red');
				} 
				else 
				{
					$('#supload').upload(admin_file + '.php?op=' + modname + '&action=uploadscreen',
					{
						screendir: img_folder, did: did, title: stitle
					},
					function(response)
					{
						$('#supload').replaceWith($('#supload').clone());
						$('#supload, #stitle').val('').css('border', '1px solid');
						$('#screenupload-percentage').html('-');

						var content  = '  <tr id="screen-' + response.pid + '">'
							content += '    <td style="width:25%; overflow:hidden; text-overflow:ellipsis;">' + response.title + '</td>'
							content += '    <td style="width:45%; overflow:hidden; text-overflow:ellipsis; padding-left: 5px; padding-right: 5px;"><a href="' + img_folder + response.image + '"' + image_viewer + '>' + response.image + '</a></td>'
							content += '    <td style="width:20%; text-align:center;">' + response.size + '</td>'
							content += '    <td style="width:10%; text-align:center;">'
							content += '      <i data-id="' + response.pid + '" class="fa fa-times-circle delete-screenshot"></i>'
							content += '    </td>'
							content += '  </tr>'
						$('#imageupload_submit').before(content);
					},
					function(prog, value)
					{
						$('#screenupload-percentage').html(value+'%');
					});
				}
			});
//---------------------------------------------------------------------
			$(document).on('click','.delete-screenshot',function(event)
			{
				event.preventDefault();
				// console.log('I have clicked. '+id);
				var id = $(this).data('id');
				$.post(admin_file + '.php?op=' + modname + '&action=deletescreen&pid=' + id, 
				{ 
					'pid' : id 
				}, function(data,status) 
				{ 
					$('#screen-'+id).remove(); 
				});
			});
			break;

		case 'settings':

            $('#allowed_image_extensions').tagit({
                removeConfirmation: true
            });

            var eventTags = $('#allowed_file_extensions');
            var addEvent = function( text ) {
                $( '#events_container' ).append(text + '<br>');
            };

            eventTags.tagit({
            	removeConfirmation: true,
            });

//---------------------------------------------------------------------
//	CHANGE THE HEADER OR CELL TEXT TO UPPERCASE OR CASE SENSITIVE
//---------------------------------------------------------------------
			$(document).on('change','#uhead,#utext,#spacing',function() {
				var upperhead = ($('#uhead').val() == '1') ? 'uppercase' : 'none';
				$('.upperhead-style').css('text-transform',upperhead);
				var uppertext = ($('#utext').val() == '1') ? 'uppercase' : 'none';
				$('.uppertext-style').css('text-transform',uppertext);
				var spacing   = $('#spacing').val();
				$('.upperhead-style,.uppertext-style').css('letter-spacing',spacing+'px');		
			});
//---------------------------------------------------------------------
			break;

		case 'view':
			$(document).on('click','.toggle-description',function(event)
			{				
				$('.item-fixes').hide();
				$('.toggle-fixes').css({'text-decoration':''});
				$('.item-description').show();
				$(this).css({'text-decoration':'underline'});
			});

			$(document).on('click','.toggle-fixes',function(event)
			{
				$('.item-fixes').show();
				$(this).css({'text-decoration':'underline'});				
				$('.item-description').hide();
				$('.toggle-description').css({'text-decoration':''});				
			});
			break;

		case 'submitdownload':

			// check the file type of the selected type, if is not valid, empty the field.
			$('.userfile_upload').change(function () 
			{
				var ext = this.value.match(/\.(.+)$/)[1];
				if( this.value )
				{
					var ext = this.value.match(/\.(.+)$/)[1];
					if ($.inArray( ext, allowed_file_extensions.split(',') ) == -1) 
					{
						alert('The file you have selected is not an allowed file type');
						this.value = '';		    			
					}
				}			    
			});

			$('.userimage_upload').change(function () 
			{
				var img_ext = this.value.match(/\.(.+)$/)[1];
				if( this.value )
				{
					var img_ext = this.value.match(/\.(.+)$/)[1];
					if ($.inArray( img_ext, allowed_image_extensions.split(',') ) == -1) 
					{
						alert('The image you have selected is not an allowed image type');
						this.value = '';		    			
					}
				}			    
			});

			$('#submit_description').sceditor({
				plugins: "bbcode",
				style: css_folder + 'sceditor/jquery.sceditor.default.min.css',
				toolbar: "bold,italic,underline,strike|left,center,right,justify|emoticon|font,size,color,removeformat|bulletlist,orderedlist|code,quote|image,email,link,unlink|youtube|maximize,source",
				fonts: "Arial,Arial Black,Comic Sans MS,Courier New,Georgia,Impact,Sans-serif,Serif,Times New Roman,Trebuchet MS,Verdana"
			});	

			break;
	}
//---------------------------------------------------------------------
//	JQUERY VERSION CHECKER
//---------------------------------------------------------------------
	$(document).on('click', 'a#manual-check', function(e)
	{
	    e.preventDefault();
	    $.removeCookie('latest_version_check');
	    location.reload();
	});

	if ( !$.cookie('latest_version_check') )
	{
		$.ajax(
		{
			type: 'GET',
			url: 'https://lonestar-modules.com/versioning/file_repository.xml',
			cache: true,
			dataType: 'xml',
			success: function (xml)
			{
				$(xml).find('version_check').each(function()
				{
					var download 	= $(this).find('latest_version_download').text();
					var message		= $(this).find('latest_version_message').html();
					var lversion 	= $(this).find('latest_version').text();

					var nversion  = '';
					if ( version_installed < lversion )
						nversion += '<a style="text-decoration:none;" href="' + download + '" target="_blank"><span style="color: red;">' + lang_version_new + '</span></a>'					

					else if ( version_installed ==  lversion )
						nversion += '<span style="color: green;">' + lang_version_upto_date + '</span>'

					else if ( version_installed > lversion )
						nversion += '<span style="color: #1c1cd6;">You must be using a beta copy for a new release.</span>'

					$('#versionchecker').html(nversion);

					// insert a cookie, this way it will only check the version once a day.
					$.cookie('latest_version_check', nversion, { expires: 1 });
				});			
			},
			error: function (xml)
			{
				$('#versionchecker').html(lang_xml_process);
			}
		});
	}
	else
	{
		$('#versionchecker').html(' ' + $.cookie('latest_version_check') +'<br /><a href="javascript:void(0);" id="manual-check">Click here to check version</a>');
	}
		
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	INCLUDE THE XHR JQUERY CODING
//---------------------------------------------------------------------
	$.getScript(js_folder + 'jquery.xhr.js');
//---------------------------------------------------------------------
});