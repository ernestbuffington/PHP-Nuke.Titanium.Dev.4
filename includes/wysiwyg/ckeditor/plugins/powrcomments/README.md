# 🎉 Welcome to POWr Comments for CKEditor 🎉

## How to install:

### Option 1: Add plugin from content delivery network (CDN):
HTML

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>

JavaScript:

    CKEDITOR.replace('editor1',{
      extraPlugins: 'powrcomments',
      height: '800px',
    });
    CKEDITOR.plugins.addExternal('powrcomments', "https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrcomments/", 'plugin.js');

### Option 2: Add plugin from local installation on your server:
1.  [Download POWr Comments CKEditor Plugin](https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrcomments/powrcomments.zip)
2. Unzip the downloaded plugin  `powrcomments.zip`  and put the resulting `powrcomments` folder into the  `plugins`  folder of your CKEditor installation. Example:

	    http://example.com/ckeditor/plugins/powrcomments

3.  Enable the plugin by using the  [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins)  configuration setting. Example:

	    config.extraPlugins =  'powrcomments';



## How to create and edit POWr Comments:

After the POWr Comments for CKEditor plugin is installed, it's easy to create and update Comments!

1. Easily add a Comments within the CKEditor by clicking the `Insert Comments` Icon. Insert more POWr Apps by clicking the `+ POWr` menu.

2. The Comments will then appear within the Editor. Click `Edit Comments` to open the POWr Editor and create and update your Comments.

## Need help?
[Visit our help center](https://www.powr.io/knowledge-base) and get answers!
