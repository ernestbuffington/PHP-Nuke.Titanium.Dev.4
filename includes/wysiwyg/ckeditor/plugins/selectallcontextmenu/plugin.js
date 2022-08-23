/**
 *  Developer: Ahmad Faiyaz ( faiyaz26 [at] gmail [dot] com )
 */

/**
 * @fileOverview The "selectallcontextmenu" plugin provides an editor command that
 *               allows selecting the entire content of editable area.
 *               This plugin also enables a context menu button for the feature.
 */

(function() {
    CKEDITOR.plugins.add('selectallcontextmenu', {
        // jscs:disable maximumLineLength
        lang: 'af,ar,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
        // jscs:enable maximumLineLength
        icons: 'selectall', // %REMOVE_LINE_CORE%
        hidpi: true,
        init: function(editor) {
            editor.addCommand('selectallcontextmenu', {
                modes: { wysiwyg: 1, source: 1 },
                exec: function(editor) {
                    var editable = editor.editable();

                    if (editable.is('textarea')) {
                        var textarea = editable.$;

                        if (CKEDITOR.env.ie)
                            textarea.createTextRange().execCommand('SelectAll');
                        else {
                            textarea.selectionStart = 0;
                            textarea.selectionEnd = textarea.value.length;
                        }

                        textarea.focus();
                    } else {
                        if (editable.is('body'))
                            editor.document.$.execCommand('SelectAll', false, null);
                        else {
                            var range = editor.createRange();
                            range.selectNodeContents(editable);
                            range.select();
                        }

                        // Force triggering selectionChange (#7008)
                        editor.forceNextSelectionCheck();
                        editor.selectionChange();
                    }

                },
                canUndo: false
            });


            if (editor.addMenuItems) {
                editor.addMenuGroup('selectallcontextmenu', 3);

                editor.addMenuItems({
                    selectall: {
                        label: editor.lang.selectall.toolbar,
                        group: 'selectallcontextmenu',
                        order: 21,
                        command: 'selectallcontextmenu'
                    }
                });
            }

            if (editor.contextMenu) {
                editor.contextMenu.addListener(function(element, selection) {
                    return {
                        selectall: CKEDITOR.TRISTATE_OFF
                    };
                });
            }
        }
    });
})();
