/*
'docfont' CKEditor plugin
Carson Wilson
Initial version: Tue Dec 27 12:54:06 CST 2016

Version 2.0:
 - Added tooltips (the 'title' sections below)
 - Added resetStyle() as this wasn't getting inherited from docProps
 - Added ability to set line-height
 - Revised some labels
 - Fixed some typos

TODO:
 - Foreign language translation for titles and labels.

CKEditor extension to 'docprops' plugin to add 'font-family',
 ..'font-size', and 'line-height' elements to BODY's inline CSS style.
NOTES:
1. 'docprops' uses inline <body> styles for its 'Design' properties. An
   internal style sheet in <head> would provide more specific
   control over elements such as headings or captions.  For simplicity's
   sake, though, this plugin conforms to the standard set by 'docprops';

2. Setting a global font avoids needing to use CKEditor's 'font' dropdown
   to manage fonts.  This has the advantages of:
   - Setting fonts in elements such as image captions which the 'font'
     dropdown does not affect
   - Not requiring users to reset the font for each new paragraph,
     where it may revert to the browser's default font.
   - Avoiding inserting <span style="font-family:..."> for every <p>
     and <h> element, even when only one font is in use.

3. If font-family is currently set, we retrieve and show it in our textarea,
   but otherwise no input checking is done.  The user can enter any string in
   our 'Font' field.  Testing indicates that body.setStyle() filters out
   illegal characters like : ; ".

4. Similarly, if font-size is currently set, we retrieve and show it in our
   textarea, but otherwise no input checking is done.  The user can enter any
   string in this field.  Testing indicates that body.setStyle() ignores out
   illegal entries.

5. Same for line-height.
*/

CKEDITOR.plugins.add( 'docfont', {
    requires: 'docprops'
})

// When opening a dialog, its "definition" is created for it, for
// each editor instance.  The "dialogDefinition" event is then
// fired.  We should use this event to make customizations to the
// definition of existing dialogs.
CKEDITOR.on( 'dialogDefinition', function( ev ) {
    // Take the dialog name and its definition from the event data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;

    // Check if the definition is from the dialog we're
    // interested in (the "docProps" dialog):
    if ( dialogName == 'docProps' ) {
        // (resetStyle() copied from docprops/dialog/docprops.js):
        // We cannot just remove the style from the element, as it might be
        // affected from non-inline stylesheets.  To get the proper result,
        // we should manually set the inline style to its default value.
        function resetStyle( element, prop, resetVal ) {
                element.removeStyle( prop );
                if ( element.getComputedStyle( prop ) != resetVal )
                        element.setStyle( prop, resetVal );
        }

        // Get a reference to its "design" tab:
        var designTab = dialogDefinition.getContents( 'design' );

        // Add a new text field to the "design" tab page:
        designTab.add( {
            type:  'text',
            label: 'Comma-separated list of fonts',
            title: 'The browser will use the first font available, left-to-right.  Enter your top choice first, and include a fallback of either \'sans serif\' or \'serif\' as your final entry.',
            id:    'font',

            // Retrieve current value, if any.
            // (Not sure this is consistent, since below we only
            // ..setStyle().  Should we also setAttribute() to
            // ..null below?)
            setup: function( doc, html, head, body ) {
                this.setValue(
                    body.getStyle(     'font-family' ) ||
                    body.getAttribute( 'font-family' ) || '' );
            },

            // Set new value if one was entered, else remove font-family:
            commit: function( doc, html, head, body ) {
                body.removeAttribute( 'font-family' );
                var val = this.getValue();
                if ( val )
                    body.setStyle( 'font-family', val );
                else
                    resetStyle( body, 'font-family', 'none' );
            }
        });

        // Add a new text field to the "design" tab page:
        designTab.add( {
            type:  'text',
            // Generally, 1em = 12pt = 16px = 100%:
            label: 'Font size (e.g., 92%, .92em, 11pt, 14px)',
            title: 'Generally % gives best results; em is a good second choice.  Typically 100% = 1em = 12pt = 16px.',
            id:    'fontSize',

            // Retrieve current value, if any.
            // (Not sure this is consistent, since below we only
            // ..setStyle().  Should we also setAttribute() to
            // ..null below?)
            setup: function( doc, html, head, body ) {
                this.setValue(
                    body.getStyle(     'font-size' ) ||
                    body.getAttribute( 'font-size' ) || '' );
            },

            // Set new value if one was entered, else remove font-size:
            commit: function( doc, html, head, body ) {
                body.removeAttribute( 'font-size' );
                var val = this.getValue();
                if ( val )
                    body.setStyle( 'font-size', val );
                else
                    resetStyle( body, 'font-size', 'none' );
            }
        });

        // Add a new text field to the "design" tab page:
        designTab.add( {
            type:  'text',
            // Generally, 1em = 12pt = 16px = 100%:
            label: 'Line height (space between lines, e.g., 150%, 1.5em, 1.5)',
            title: 'Typically 100% = 1em = 1.',
            id:    'lineHeight',

            // Retrieve current value, if any.
            // (Not sure this is consistent, since below we only
            // ..setStyle().  Should we also setAttribute() to
            // ..null below?)
            setup: function( doc, html, head, body ) {
                this.setValue(
                    body.getStyle(     'line-height' ) ||
                    body.getAttribute( 'line-height' ) || '' );
            },

            // Set new value if one was entered, else remove line-height:
            commit: function( doc, html, head, body ) {
                body.removeAttribute( 'font-size' );
                var val = this.getValue();
                if ( val )
                    body.setStyle( 'line-height', val );
                else
                    resetStyle( body, 'line-height', 'none' );
            }
        });
    }
});
