# 🎉 Welcome to POWr Media Gallery for CKEditor 🎉

## How to install:

### Option 1: Add plugin from content delivery network (CDN):
HTML

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>

JavaScript:

    CKEDITOR.replace('editor1',{
      extraPlugins: 'powrmediagallery',
      height: '800px',
    });
    CKEDITOR.plugins.addExternal('powrmediagallery', "https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrmediagallery/", 'plugin.js');

### Option 2: Add plugin from local installation on your server:
1.  [Download POWr Media Gallery CKEditor Plugin](https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrmediagallery/powrmediagallery.zip)
2. Unzip the downloaded plugin  `powrmediagallery.zip`  and put the resulting `powrmediagallery` folder into the  `plugins`  folder of your CKEditor installation. Example:

	    http://example.com/ckeditor/plugins/powrmediagallery

3.  Enable the plugin by using the  [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins)  configuration setting. Example:

	    config.extraPlugins =  'powrmediagallery';



## How to create and edit POWr Media Gallery:

After the POWr Media Gallery for CKEditor plugin is installed, it's easy to create and update Media Gallery!

1. Easily add a Media Gallery within the CKEditor by clicking the `Insert Media Gallery` Icon. Insert more POWr Apps by clicking the `+ POWr` menu.

2. The Media Gallery will then appear within the Editor. Click `Edit Media Gallery` to open the POWr Editor and create and update your Media Gallery.

## Need help?
[Visit our help center](https://www.powr.io/knowledge-base) and get answers!
