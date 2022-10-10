# 🎉 Welcome to POWr Form Builder for CKEditor 🎉

## How to install:

### Option 1: Add plugin from content delivery network (CDN):
HTML

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>

JavaScript:

    CKEDITOR.replace('editor1',{
      extraPlugins: 'powrformbuilder',
      height: '800px',
    });
    CKEDITOR.plugins.addExternal('powrformbuilder', "https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrformbuilder/", 'plugin.js');

### Option 2: Add plugin from local installation on your server:
1.  [Download POWr Form Builder CKEditor Plugin](https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrformbuilder/powrformbuilder.zip)
2. Unzip the downloaded plugin  `powrformbuilder.zip`  and put the resulting `powrformbuilder` folder into the  `plugins`  folder of your CKEditor installation. Example:

	    http://example.com/ckeditor/plugins/powrformbuilder

3.  Enable the plugin by using the  [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins)  configuration setting. Example:

	    config.extraPlugins =  'powrformbuilder';



## How to create and edit POWr Form Builder:

After the POWr Form Builder for CKEditor plugin is installed, it's easy to create and update Form Builder!

1. Easily add a Form Builder within the CKEditor by clicking the `Insert Form Builder` Icon. Insert more POWr Apps by clicking the `+ POWr` menu.

2. The Form Builder will then appear within the Editor. Click `Edit Form Builder` to open the POWr Editor and create and update your Form Builder.

## Need help?
[Visit our help center](https://www.powr.io/knowledge-base) and get answers!
