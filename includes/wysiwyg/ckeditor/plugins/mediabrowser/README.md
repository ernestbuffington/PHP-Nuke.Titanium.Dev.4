# Media Browser

This plugin provides a simple and minimal browser API for other plugins to consume (almost identical to the [browser](https://ckeditor.com/cke4/addon/browser) plugin) as an alternative to the [filebrowser](https://ckeditor.com/cke4/addon/filebrowser) plugin.

It does absolutely not care about advanced features like file uploads or the likes. If you need those features, stick with the filebrowser. It rather focuses on the easy integration of your application (CMS or whatever), which usually provides a means to upload files anyway.

Unlike the filebrowser plugin it does not use URL parameters to pass values between the editor and the browser windows, but uses the browser-native [window.postMessage()](https://developer.mozilla.org/en-US/docs/Web/API/Window/postMessage) functionality to communicate between both. This way you can easily pass more than just the URL of the selected element from the browser to the editor or even multiple elements at once.

## Difference between browser and mediabrowser plugin

There is only one difference between the browser and the mediabrowser plugin:

Whilst the mediabrowser plugin offers a config option to set a global browser URL for all plugins that use it, the browser plugin does not have any config option at all, but your plugin surely could have. With the browser plugin you could configure the browser URL for each button individually, if you want.

## Plugin Integration

To use the provided API in your plugin, you just have to define a callback function `mediabrowser` in the *browse server* button configuration of your plugin's dialog, p.e.

    {
        id: 'browse',
        type: 'button',
        label: common.browseServer,
        hidden: true,
        mediabrowser: function (data) {
            if (data.src) {
                var dialog = this.getDialog();

                ['src', 'type', 'alt'].forEach(function (item) {
                    if (!!data[item]) {
                        dialog.getContentElement('info', item).setValue(data[item]);
                    }
                });
            }
        }
    }

## Browser Integration

You can implement your browser as you wish, the only two requirements are that you configure the URL to your browser as `mediabrowserUrl` p.e.

    config.mediabrowserUrl: '/url/to/browser';

and that your browser notifies the editor by posting a message p.e. like

    window.opener.postMessage({
        alt: 'Optional alternative text',
        src: '/url/to/media'
    }, origin);

The type and structure of your message is complety up to you, p.e. you can use a simple string if you are only interested in one value, an object or an array.

## Demo

https://akilli.github.io/rte/ck4

## Minimalistic browser example

https://github.com/akilli/rte/tree/master/browser
