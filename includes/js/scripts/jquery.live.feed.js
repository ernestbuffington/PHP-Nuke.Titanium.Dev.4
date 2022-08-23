/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2017 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	jQuery News Feed
|----------------------------------------------------------------------
*/

nuke_jq(function($)
{
	$.ajax(
	{
		type: 'GET',
		url: 'https://evolution-xtreme.co.uk/Evo-Live-Feed.php',
		cache: false,
		dataType: 'json',
		success: function (data)
		{		
			if(!data)
			{
				$('.exnewsfeed').parent().css({'color' : 'red', 'font-weight' : 'bold', 'height' : '', 'text-align' : 'center', 'resize' : 'none'});
				$('.exnewsfeed').replaceWith('The XML File could not be processed correctly. <br /> Please contact a member of the Nuke Evolution Xtreme staff.');
			}
			else
			{
				$.each(data, function(i,news)
				{
					var feed  = '<tr>'
						feed += '  <td>'
						feed += '    <dt style="border-bottom: 1px dashed #cccccc; padding-bottom: 1px;"><span'+((news['color']) ? ' style="color:'+news['color']+'"' : '')+'>'+news['title']+'</span>&nbsp;'+news['timestamp']+'</dt>'
						// feed += '    <dd style="padding: 0; margin: 0 0 1em 1.5em;">'+news['message']+'</dd>'
						feed += '    <dd style="padding: 0;">'+news['message']+'</dd>'
						feed += '  </td>'
						feed += '</tr>'
					$('.exnewsfeed').prepend(feed);
				});
			}
		},
		error: function (html)
		{
			$('.exnewsfeed').parent().css({'color' : 'red', 'font-weight' : 'bold', 'height' : '', 'text-align' : 'center', 'resize' : 'none'});
			$('.exnewsfeed').replaceWith('The XML File could not be processed correctly. <br /> Please contact a member of the Nuke Evolution Xtreme staff.');
		}

	});
});