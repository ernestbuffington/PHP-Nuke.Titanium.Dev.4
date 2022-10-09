CKEditor Free PHP Image Uploader Addon, `From: <http://coursesweb.net/php-mysql/ckeditor-image-audio-upload_s2>`
=============================

**imgupload** is a `CKEditor <http://ckeditor.com/>`_ addon that can be used to upload images on server with CKEditor.

This addon integrates with the **image** plugin (part of CKEditor),
by making it provide a **Upload** tab-button in the Image dialog window.
For support, write on the forum: `<http://coursesweb.net/forum/>`

To use the upload addon
------------------------

Open the ``iaupload.php`` file and change the values of the $upload_dir array (lines: 6, 7), to set the path to the folders where to upload images and audio files on your server (it can be the same folder), RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER.

By default, if the name of the uploaded file exists in the directory for upload, it will be renamed with "filename_NR.ext" (NR is a number). If you want to Overwrite the existing file, set value of 0 to RENAME_F (line 28).

Copy the ``iaupload.php`` file into ``plugins/`` directory in your CKEditor install.

Sets CHMOD writable permision (0777) to the folders for images and audio files on your server (if on Linux system), to allow PHP to upload the files

Enable the plugin by adding the `filebrowserImageUploadUrl` parameter::

	CKEDITOR.replace('textareaId', {
		"filebrowserImageUploadUrl": "/path_to/ckeditor/plugins/imgupload.php"
	});
  CKEDITOR.config.extraAllowedContent = 'audio[*]{*}';  //to allow audio tag

