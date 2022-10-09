/**
 * Media Browser Plugin
 *
 * @author Ayhan Akilli
 */
'use strict';

/**
 * Media Browser
 */
(function (CKEDITOR) {
    /**
     * Plugin
     */
    CKEDITOR.plugins.add('mediabrowser', {requires: 'api'});

    /**
     * Initializes all media browser buttons on dialog definition
     *
     * A media browser button is a button element with a `mediabrowser` property that is a callback function. This
     * callback function is later executed when the mediabrowser window sends a message.
     */
    CKEDITOR.on('dialogDefinition', function (ev) {
        if (!!ev.editor.plugins.mediabrowser && typeof ev.editor.config.mediabrowserUrl === 'string' && !!ev.editor.config.mediabrowserUrl) {
            CKEDITOR.api.dialog(ev.data.definition, function (item) {
                if (item.type === 'button' && item.hasOwnProperty('mediabrowser') && typeof item.mediabrowser === 'function') {
                    item.hidden = false;
                    item.onClick = function (e) {
                        CKEDITOR.api.browser(ev.editor.config.mediabrowserUrl, function (data) {
                            e.sender.mediabrowser.call(e.sender, data);
                        });
                    };
                }
            });
        }
    });
})(CKEDITOR);
