/**
 * uploadcare-ckeditor 3.0.0
 * File Uploader by Uploadcare. The plugin for CKEditor 4 to work with Uploadcare Widget.
 * https://github.com/uploadcare/uploadcare-ckeditor#readme
 * Date: 2018-05-01
 */

(function () {
  'use strict';

  CKEDITOR.plugins.add('uploadcare', {
    hidpi: true,
    icons: 'uploadcare',
    init: function(editor) {
      var config = editor.config.uploadcare || {};

      // Check if Uploadcare is already loaded and load it if not.
      if (typeof uploadcare === 'undefined') {
        var version = config.widgetVersion || '3.x';
        var widgetUrl = 'https://ucarecdn.com/libs/widget/' + version + '/uploadcare.full.min.js';

        CKEDITOR.scriptLoader.load(widgetUrl);
      }

      // Apply default properties.
      if (!('crop' in config)) {
        config.crop = '';
      }

      applyIntegrationSetting();

      function applyIntegrationSetting() {
        var editorVersion = CKEDITOR.version;
        var pluginVerion = '3.0.0';

        config.integration = 'CKEditor/{editorVersion}; Uploadcare-CKEditor/{pluginVerion}'
          .replace('{editorVersion}', editorVersion)
          .replace('{pluginVerion}', pluginVerion);
      }

      function searchSelectedElement(editor, needle) {
        var sel = editor.getSelection();
        var element = sel.getSelectedElement();

        if (element && element.is(needle)) {
          return element
        }

        var widget;

        if (editor.widgets && (widget = editor.widgets.selected[0])) {
          if (widget.element.is(needle)) {
            return widget.element
          }
        }

        var range = sel.getRanges()[0];

        if (range) {
          range.shrink(CKEDITOR.SHRINK_TEXT);

          return editor.elementPath(range.getCommonAncestor()).contains(needle, 1)
        }
      }

      editor.addCommand('showUploadcareDialog', {
        allowedContent: 'img[!src,alt]{width,height};a[!href]',
        requiredContent: 'img[src];a[href]',
        exec: function() {
          if (typeof uploadcare == 'undefined') {
            // not loaded yet
            return
          }

          uploadcare.plugin(function(uc) {
            var element;
            var file;
            var settings;

            if ((element = searchSelectedElement(editor, 'img'))) {
              file = element.getAttribute('src');
            }
            else if ((element = searchSelectedElement(editor, 'a'))) {
              file = element.getAttribute('href');
            }

            if (file && uc.utils.splitCdnUrl(file)) {
              settings = uc.settings.build(uc.jQuery.extend({}, config, {multiple: false}));
              file = uploadcare.fileFrom('uploaded', file, settings);
            }
            else {
              settings = uc.settings.build(config);
              file = null;
            }

            uploadcare.openDialog(file, settings).done(function(selected) {
              var files = settings.multiple ? selected.files() : [selected];

              uc.jQuery.when.apply(null, files).done(function() {
                uc.jQuery.each(arguments, function() {
                  var imageUrl = this.cdnUrl;

                  if (this.isImage && !this.cdnUrlModifiers) {
                    imageUrl += '-/preview/';
                  }
                  if (element) {
                    var widget;

                    if (editor.widgets && (widget = editor.widgets.selected[0]) && widget.element === element) {
                      widget.setData('src', imageUrl).setData('height', null);
                    }
                    else if (element.getName() == 'img') {
                      element.data('cke-saved-src', '');
                      element.setAttribute('src', imageUrl);
                    }
                    else {
                      element.data('cke-saved-href', '');
                      element.setAttribute('href', this.cdnUrl);
                    }
                  }
                  else if (this.isImage) {
                    editor.insertHtml('<img src="' + imageUrl + '" alt="" /><br>', 'unfiltered_html');
                  }
                  else {
                    editor.insertHtml('<a href="' + this.cdnUrl + '">' + this.name + '</a> ', 'unfiltered_html');
                  }
                });
              });
            });
          });
        },
      });

      editor.ui.addButton &&
        editor.ui.addButton('Uploadcare', {
          label: 'Uploadcare',
          toolbar: 'insert',
          command: 'showUploadcareDialog',
        });
    },
  });

}());
