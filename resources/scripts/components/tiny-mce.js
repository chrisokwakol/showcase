/* eslint-disable */
(function () {
  // Check if TinyMCE is defined and available
  if (typeof tinymce !== 'undefined' && tinymce.activeEditor !== null) {
    // Create the plugin for TinyMCE
    tinymce.create('tinymce.plugins.CustomButtons', {
      init: function (ed, url) {
        // Filled button
        ed.addButton('filledbtn', {
          title: 'Button Filled',
          cmd: 'filledBtnCmd',
          image: url + '/tiny-mce-btns/filled_btn.png',
          onPostRender: function () {
            const btnElement = this.getEl();
            btnElement.classList.add('lgfb-custom-rich-text-btn');
          },
        });

        // Hollow button
        ed.addButton('hollowbtn', {
          title: 'Button Hollow',
          cmd: 'hollowBtnCmd',
          image: url + '/tiny-mce-btns/hollow_btn.png',
          onPostRender: function () {
            const btnElement = this.getEl();
            btnElement.classList.add('lgfb-custom-rich-text-btn.hollow-btn');
          },
        });

        // Command filled button
        ed.addCommand('filledBtnCmd', function () {
          // Open the dialog box to enter the URL and button text
          ed.windowManager.open({
            title: 'Enter Button URL and Text',
            width: 400,
            height: 200,
            body: {
              type: 'panel',
              classes: 'lgfb-btn-custom-dialog',
              items: [
                {
                  type: 'label',
                  text: 'Enter the URL for the button:',
                },
                {
                  type: 'textbox',
                  name: 'buttonUrl',
                  label: 'URL',
                  autofocus: true,
                },
                {
                  type: 'label',
                  text: 'Enter the text for the button:',
                },
                {
                  type: 'textbox',
                  name: 'buttonText',
                  label: 'Button Text',
                  value: 'Click Here', // Default button text
                },
              ],
            },
            initialData: {
              buttonUrl: '', // Default empty value for URL
              buttonText: 'Click Here', // Default button text
            },
            onsubmit: function (ev) {
              const buttonUrl = ev.data.buttonUrl.trim();
              const buttonText = ev.data.buttonText.trim();

              // Validate the URL using the URL constructor
              try {
                new URL(buttonUrl);

                // Only insert the anchor tag if both URL and button text are provided
                if (buttonUrl && buttonText) {
                  const anchorTag = `<a href="${buttonUrl}" class="btn-lgfb btn-lgfb--default btn-lgfb--medium btn-lgfb--rich-text" target="_blank">${buttonText}</a>`;
                  ed.insertContent(anchorTag);
                } else {
                  alert('Please enter both a valid URL and link text');
                }
              } catch (e) {
                alert('Please enter a valid URL');
              }
            },
          });
        });

        // Command for the hollow button (if needed)
        ed.addCommand('hollowBtnCmd', function () {
          // Open the dialog box to enter the URL and button text for hollow button
          ed.windowManager.open({
            title: 'Enter Button URL and Text',
            width: 400,
            height: 200,
            body: {
              type: 'panel',
              classes: 'lgfb-btn-custom-dialog',
              items: [
                {
                  type: 'label',
                  text: 'Enter the URL for the button:',
                },
                {
                  type: 'textbox',
                  name: 'buttonUrl',
                  label: 'URL',
                  autofocus: true,
                },
                {
                  type: 'label',
                  text: 'Enter the text for the button:',
                },
                {
                  type: 'textbox',
                  name: 'buttonText',
                  label: 'Button Text',
                  value: 'Click Here', // Default button text
                },
              ],
            },
            initialData: {
              buttonUrl: '', // Default empty value for URL
              buttonText: 'Click Here', // Default button text
            },
            onsubmit: function (ev) {
              const buttonUrl = ev.data.buttonUrl.trim();
              const buttonText = ev.data.buttonText.trim();

              // Validate the URL using the URL constructor
              try {
                new URL(buttonUrl);

                // Only insert the anchor tag if both URL and button text are provided
                if (buttonUrl && buttonText) {
                  const anchorTag = `<a href="${buttonUrl}" class="btn-lgfb btn-lgfb--outline btn-lgfb--medium btn-lgfb--rich-text" target="_blank">${buttonText}</a>`;
                  ed.insertContent(anchorTag);
                } else {
                  alert('Please enter both a valid URL and link text');
                }
              } catch (e) {
                alert('Please enter a valid URL');
              }
            },
          });
        });
      },
      getInfo: function () {
        return {
          longname: 'Custom LGFB Buttons',
          author: 'Reason One',
          authorurl: 'https://reasonone.com/',
          version: '1.0',
        };
      },
    });

    // Add the plugin to the TinyMCE Plugin Manager
    tinymce.PluginManager.add('mytinymceplugin', tinymce.plugins.CustomButtons);
  } else {
    console.log('TinyMCE is not loaded or available.');
  }
})();
