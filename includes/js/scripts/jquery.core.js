nuke_jq(function($)
{
	/* This is used for auto resizing of textareas */
	$.each($("textarea[data-autoresize]"), function() 
	{
		var offset = this.offsetHeight - this.clientHeight; 
		var resizeTextarea = function(el)
		{
			$(el).css("height", "auto").css("height", el.scrollHeight + offset);
		};
		resizeTextarea(this);
		$(this).on("focus keyup input", function()
		{
			resizeTextarea(this);
		}).removeAttr("data-autoresize");
	});
	
	/* This is used for flag selection during registration and profile editing. */
	$(".user_from_flag_select").change(function()
	{
		var selectedCountry = $(this).children("option:selected").val();
		country_class = selectedCountry.replace(/(.*)\.(.*?)$/, "$1");
		$(".countries").removeClass().addClass("countries "+country_class);
	});
});