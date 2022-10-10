# 🎉 Welcome to POWr Multi Slider for CKEditor 🎉

## How to install:

### Option 1: Add plugin from content delivery network (CDN):
HTML

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>

JavaScript:

    CKEDITOR.replace('editor1',{
      extraPlugins: 'powrmultislider',
      height: '800px',
    });
    CKEDITOR.plugins.addExternal('powrmultislider', "https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrmultislider/", 'plugin.js');

### Option 2: Add plugin from local installation on your server:
1.  [Download POWr Multi Slider CKEditor Plugin](https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrmultislider/powrmultislider.zip)
2. Unzip the downloaded plugin  `powrmultislider.zip`  and put the resulting `powrmultislider` folder into the  `plugins`  folder of your CKEditor installation. Example:

	    http://example.com/ckeditor/plugins/powrmultislider

3.  Enable the plugin by using the  [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins)  configuration setting. Example:

	    config.extraPlugins =  'powrmultislider';



## How to create and edit POWr Multi Slider:

After the POWr Multi Slider for CKEditor plugin is installed, it's easy to create and update Multi Slider!

1. Easily add a Multi Slider within the CKEditor by clicking the `Insert Multi Slider` Icon. Insert more POWr Apps by clicking the `+ POWr` menu.

2. The Multi Slider will then appear within the Editor. Click `Edit Multi Slider` to open the POWr Editor and create and update your Multi Slider.

## Need help?
[Visit our help center](https://www.powr.io/knowledge-base) and get answers!
