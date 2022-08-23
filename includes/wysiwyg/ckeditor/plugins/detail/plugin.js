/**
 * Detail Widget
 *
 * @author Ayhan Akilli
 */
'use strict';

(function (CKEDITOR) {
    /**
     * DTD
     */
    CKEDITOR.dtd['$editable']['summary'] = 1;

    /**
     * Plugin
     */
    CKEDITOR.plugins.add('detail', {
        requires: 'api,widget',
        icons: 'detail',
        hidpi: true,
        lang: 'de,en,uk,ru',
        init: function (editor) {
            /**
             * Widget
             */
            editor.widgets.add('detail', {
                button: editor.lang.detail.title,
                template: '<details><summary>' + editor.lang.detail.title +'</summary><div class="content"></div></details>',
                editables: {
                    summary: {
                        selector: 'summary',
                        allowedContent: {}
                    },
                    content: {
                        selector: 'div.content'
                    }
                },
                allowedContent: {details: true, summary: true},
                requiredContent: 'details',
                upcast: function (el) {
                    if (el.name !== 'details') {
                        return false;
                    }

                    var summary = el.getFirst('summary');
                    var content = new CKEDITOR.htmlParser.element('div', {'class': 'content'});

                    if (!!summary && summary.children.length > 0 && summary.children[0].type === CKEDITOR.NODE_ELEMENT) {
                        summary.setHtml(summary.children[0].getHtml());
                    } else if (!!summary && summary.children.length > 0 && summary.children[0].type === CKEDITOR.NODE_TEXT) {
                        summary.setHtml(summary.children[0].value);
                    } else if (!summary) {
                        el.add(new CKEDITOR.htmlParser.element('summary'), 0);
                    }

                    el.add(content, 1);

                    if (el.children.length > 2) {
                        content.children = el.children.slice(2);
                        el.children = el.children.slice(0, 2);
                    }

                    return true;
                },
                downcast: function (el) {
                    el.attributes = [];
                    el.children[0].attributes = [];

                    // Content
                    el.children[1].setHtml(this.editables.content.getData());
                    el.children[1].children.forEach(function (item) {
                        CKEDITOR.api.parser.add(item, el);
                    });
                    el.children[1].remove();

                    return el.children.length > 1 ? el : new CKEDITOR.htmlParser.text('');
                },
                init: function () {
                    var summary = this.element.getChild(0);

                    summary.on('blur', function () {
                        if (!summary.getText().trim()) {
                            summary.setText(editor.lang.detail.title);
                        }
                    });
                    summary.on('keyup', function (ev) {
                        if (ev.data['$'].key === ' ' || ev.data['$'].keyCode === 32) {
                            ev.data['$'].preventDefault();
                            editor.insertText(' ');
                        }
                    });
                }
            });
        },
        onLoad: function () {
            CKEDITOR.addCss(
                'details {line-height: 1.5rem;padding: 0.75rem;background: #eee;border: 0.0625rem solid #ddd;border-radius: 0.5rem;}' +
                'details > * {padding: 0.375rem;background: #fff;}' +
                'details[open] > :not(:last-child) {margin-bottom: 0.75rem;}' +
                'details .cke_widget_editable {outline: none !important;}'
            );
        }
    });
})(CKEDITOR);
