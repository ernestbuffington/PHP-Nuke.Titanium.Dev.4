jquery_prefix(function($)
{
	$.fn.upload = function(remote,data,successFn,progressFn) 
	{
		if(typeof data != "object") 
		{
			progressFn = successFn;
			successFn = data;
		}
		return this.each(function() 
		{
			if($(this)[0].files[0]) 
			{
				var formData = new FormData();
				formData.append($(this).attr("name"), $(this)[0].files[0]);
				if(typeof data == "object") 
				{
					for(var i in data) 
					{
						formData.append(i,data[i]);
					}
				}
				
				$.ajax(
				{
					url: remote,
					type: 'POST',
					xhr: function() 
					{
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload && progressFn)
						{
							myXhr.upload.addEventListener('progress',function(prog) 
							{
								var value = ~~((prog.loaded / prog.total) * 100);
								if(progressFn && typeof progressFn == "function") 
								{
									progressFn(prog,value);
								} 
								else if (progressFn) 
								{
									$(progressFn).val(value);
								}
							}, false);
						}
						return myXhr;
					},
					data: formData,
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					complete : function(res) 
					{
						var json;
						try 
						{
							json = JSON.parse(res.responseText);
						} 
						catch(e) 
						{
							json = res.responseText;
						}
						if(successFn) 
						{
							successFn(json);
						}
					}
				});
			}
		});
	};	
});