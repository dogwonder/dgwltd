(function () {
    'use strict';

    //Import ES6 dependencies - per ES6 imports, we can omit the `.js` at the end.

    (function () {


      const toggleNav = (button, elem, masthead) => {
        //https://piccalil.li/tutorial/build-a-light-and-global-state-system
        //Set up the vars
        const toggleButton = document.querySelector(button);
        const menu = document.querySelector(elem);
        const header = document.querySelector(masthead);
        window.subscribers = [];
        const defaultState = {
          status: 'closed',
          enabled: false
        };
        const state = new Proxy(defaultState, {
          set(state, key, value) {
            const oldState = { ...state
            };
            state[key] = value;
            window.subscribers.forEach(callback => callback(state, oldState));
            return state;
          }

        }); //If window resized lets watch for when we go bigger than a tablet and switch from the burger menu to a full menu

        const observer = new ResizeObserver(observedItems => {
          const {
            contentRect
          } = observedItems[0]; // console.log(contentRect);
          // console.log(observedItems[0]);

          if (contentRect.width <= '769') {
            state.enabled = true;
            observedItems[0].target.setAttribute('enabled', state.enabled);
          } else {
            state.enabled = false;
            observedItems[0].target.setAttribute('enabled', state.enabled);
          }
        }); //Watch the header element 

        observer.observe(header); //Now an event listener for the burger menu button

        toggleButton.addEventListener('click', function (event) {
          // The JSON.parse function helps us convert the attribute from a string to a real boolean (true/false).
          const open = JSON.parse(toggleButton.getAttribute('aria-expanded')); //Switch the state via aria-expanded and set a data attribute status="open" which we can access with CSS

          state.status = open ? 'closed' : 'open';
          toggleButton.setAttribute('aria-expanded', !open);
          menu.setAttribute('status', state.status); //Add an additional class to the header just incase we want to do something with it in it's opened state

          if (header) {
            header.classList.toggle('masthead-is-open');
          }
        }); //Close menu if user hits the escape key

        window.addEventListener('keydown', function (event) {
          if (!event.key.includes('Escape')) {
            return;
          } //Set aria state and our data attribute


          toggleButton.setAttribute('aria-expanded', 'false');
          state.status = 'closed';
          menu.setAttribute('status', state.status); //And remove the class if set

          if (header) {
            header.classList.remove('masthead-is-open');
          }
        });
      };

      const cardClick = elem => {
        const cardLinks = document.querySelectorAll(elem);
        if (!cardLinks) return;
        Array.prototype.forEach.call(cardLinks, function (card, i) {
          card.addEventListener("click", handleClick); // Click handler but only if text is not selected

          function handleClick(event) {
            const isTextSelected = window.getSelection().toString();

            if (!isTextSelected) {
              window.location = card.dataset.url;
            }
          }
        });
      }; //Init


      document.addEventListener("DOMContentLoaded", function () {
        // blockContrast('.has-background');
        //cookieBanner(); // Optional
        //cookieSettingsPage(); // Optional
        //cookieSettingsUpdate(); // Optional
        //cookieScriptsEnable(); // Optional
        toggleNav('#nav-toggle', '#site-navigation', '#masthead');
        cardClick('.dgwltd-card');
      });
    })();

}());

//# sourceMappingURL=app.js.map
