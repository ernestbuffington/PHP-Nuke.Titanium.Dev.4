# 🎉 Welcome to POWr PayPal Button for CKEditor 🎉

## How to install:

### Option 1: Add plugin from content delivery network (CDN):
HTML

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>

JavaScript:

    CKEDITOR.replace('editor1',{
      extraPlugins: 'powrpaypalbutton',
      height: '800px',
    });
    CKEDITOR.plugins.addExternal('powrpaypalbutton', "https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrpaypalbutton/", 'plugin.js');

### Option 2: Add plugin from local installation on your server:
1.  [Download POWr PayPal Button CKEditor Plugin](https://cdn.jsdelivr.net/gh/superpowr/powr_for_ckeditor4/powrpaypalbutton/powrpaypalbutton.zip)
2. Unzip the downloaded plugin  `powrpaypalbutton.zip`  and put the resulting `powrpaypalbutton` folder into the  `plugins`  folder of your CKEditor installation. Example:

	    http://example.com/ckeditor/plugins/powrpaypalbutton

3.  Enable the plugin by using the  [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins)  configuration setting. Example:

	    config.extraPlugins =  'powrpaypalbutton';



## How to create and edit POWr PayPal Button:

After the POWr PayPal Button for CKEditor plugin is installed, it's easy to create and update PayPal Button!

1. Easily add a PayPal Button within the CKEditor by clicking the `Insert PayPal Button` Icon. Insert more POWr Apps by clicking the `+ POWr` menu.

2. The PayPal Button will then appear within the Editor. Click `Edit PayPal Button` to open the POWr Editor and create and update your PayPal Button.

## Need help?
[Visit our help center](https://www.powr.io/knowledge-base) and get answers!
