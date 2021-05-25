//Import ES6 dependencies - per ES6 imports, we can omit the `.js` at the end.
// import { cookies } from './modules/cookies';

;(function () {

    'use strict';

    /**
     * Get the value of a cookie
     * Source: https://gist.github.com/wpsmith/6cf23551dd140fb72ae7
     * @param  {String} name  The name of the cookie
     * @return {String}       The cookie value
     */
    var getCookie = function (name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    };

    /*!
    * Get the contrasting color for any hex color
    * (c) 2019 Chris Ferdinandi, MIT License, https://gomakethings.com
    * Derived from work by Brian Suda, https://24ways.org/2010/calculating-color-contrast/
    * @param  {String} A hexcolor value
    * @return {String} The contrasting color (black or white)
    */
    let getContrast = function (hexcolor){

        // If a leading # is provided, remove it
        if (hexcolor.slice(0, 1) === '#') {
            hexcolor = hexcolor.slice(1);
        }

        // If a three-character hexcode, make six-character
        if (hexcolor.length === 3) {
            hexcolor = hexcolor.split('').map(function (hex) {
                return hex + hex;
            }).join('');
        }

        // Convert to RGB value
        var r = parseInt(hexcolor.substr(0,2),16);
        var g = parseInt(hexcolor.substr(2,2),16);
        var b = parseInt(hexcolor.substr(4,2),16);

        // Get YIQ ratio
        var yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;

        // Check contrast
        return (yiq >= 128) ? 'black' : 'white';

    };

    //Convert RGB to HEX
    let rgb2hex  = function (rgb) {

        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        }
        return  hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);

    }

    //Cookies
    const cookieBanner = ()=>{

        // Cookie vars
        let cookieBanner = document.getElementById('cookieBanner');
        let cookieNotice = document.getElementById('cookieNotice');
        let cookieButtons = document.querySelectorAll('#cookieNotice button');
        let hideButtons = document.querySelectorAll('#cookieBanner .hide-banner');
        let cookieAccept = document.getElementById('cookieAccept');
        let cookieReject = document.getElementById('cookieReject');

        if (!cookieNotice) return;

        //If JS enabled then show the notice - falls back to noscipt if not present
        // cookieNotice.classList.add('open');
        cookieBanner.hidden = false;

        //If no buttons bail
        if (!cookieButtons) return;

        //Get timestamp of one year into the future
        var date = new Date();
        date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);

        // Set the cookies
        cookieButtons.forEach(button => {
            button.addEventListener('click', event => {
                document.cookie = 'dgwltd_cookies_preferences_set=true; expires=' + date.toUTCString() + '; path=/';    
                cookieNotice.hidden = true;
            })
        })

        hideButtons.forEach(button => {
            button.addEventListener('click', event => {
                cookieBanner.hidden = true;
            })
        })

        //If user accepts additional cookies let's set that as true
        cookieAccept.addEventListener('click', event => {
            let currentConsentCookieVars = { "essential": true, "functional": true, "performance": true, "advertising": true };
            document.cookie = 'dgwltd_cookies_policy=' + JSON.stringify(currentConsentCookieVars) + '; expires=' + date.toUTCString() + '; path=/';    
            document.getElementById('messageAccept').hidden = false;
        })

        cookieReject.addEventListener('click', event => {
            let currentConsentCookieVars = { "essential": true, "functional": false, "performance": false, "advertising": false };
            document.cookie = 'dgwltd_cookies_policy=' + JSON.stringify(currentConsentCookieVars) + '; expires=' + date.toUTCString() + '; path=/';    
            document.getElementById('messageReject').hidden = false;
        })

        //Remove notice if cookie is set
        if(cookieNotice && getCookie('dgwltd_cookies_preferences_set')) {
            cookieBanner.hidden = true;
        }

    };

    const cookieSettingsPage = ()=>{

        //Get the default settings, this should already have been set in cookie.js
        let currentConsentCookie = getCookie('dgwltd_cookies_policy');

        if(!currentConsentCookie) return;

        //Get the cookie settings
        let currentConsentCookieJSON = JSON.parse(currentConsentCookie); 

        // We don't need the essential value as this cannot be changed by the user
        delete currentConsentCookieJSON.essential
        
        //Check for the form
        let cookieForm = document.getElementById('cookies_form');

        //If no form bail
        if (!cookieForm) return;
            
        for (var cookieType in currentConsentCookieJSON) {
            var radioButton

            // console.log(cookieType + ' is ' + currentConsentCookieJSON[cookieType]);
    
            if (currentConsentCookieJSON[cookieType]) {
            radioButton = document.querySelector('input[name=cookies-' + cookieType + '][value=yes]')
            } else {
            radioButton = document.querySelector('input[name=cookies-' + cookieType + '][value=no]')
            }
    
            radioButton.checked = true
        }

    };

    const cookieScriptsEnable = ()=>{
        
        // JavaScript Type Re-Writing
        // https://help.termly.io/support/solutions/articles/60000666992-blocking-javascript-third-party-cookies-manually
        // <script type="text/plain" data-categories="performance" src="xxxxxxxxx.js"></script>
	    // <script type="text/plain" data-categories="functional" src="xxxxxxxxx.js"></script>	
        // <iframe width="560" height="315" data-src="https://www.youtube.com/embed/xxxxxxxxx" data-categories="advertising" frameborder="0" allowfullscreen></iframe>

        //Get the cookie settings
        let currentConsentCookie = getCookie('dgwltd_cookies_policy');
        if(!currentConsentCookie) return;

        let currentConsentCookieJSON = JSON.parse(currentConsentCookie); 
        //remove essential 
        delete currentConsentCookieJSON.essential

        //Get all the scripts
        let scripts = document.querySelectorAll('script[data-categories]');
        let iframes = document.querySelectorAll('iframe[data-categories]');
        // console.log(scripts);

        //JavaScript Type Re-Writing
        for (var cookieType in currentConsentCookieJSON) {
            
            // console.log(cookieType);

            Array.prototype.forEach.call(scripts, function(script) {
                let category = script.dataset.categories;
                //If true
                if (currentConsentCookieJSON[cookieType]) {
                    if(category === cookieType) {
                        //Set the MIME type
                        script.setAttribute('type', 'text/javascript'); 
                    }
                }
            })

            Array.prototype.forEach.call(iframes, function(iframe) {
                let category = iframe.dataset.categories;
                //If true
                if (currentConsentCookieJSON[cookieType]) {
                    if(category === cookieType) {
                        //Set the src of the iframe
                        iframe.src = iframe.dataset.src;
                        //Remove the data-src for styling purposes
                        iframe.removeAttribute('data-src');
                    }
                }
            })
        }

    };

    const cookieSettingsUpdate = ()=>{

        //Get timestamp of one year into the future
        var date = new Date();
        date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);

        //If the form is submitted
        document.addEventListener('submit', function (event) {

            //Let's make sure we are on the right form
            if (!event.target.matches('#cookies_form')) return;

            event.preventDefault();

            let formInputs = event.target.getElementsByTagName('input')
            let options = {"essential": true}

            // console.log(formInputs);

            for (var i = 0; i < formInputs.length; i++) {
                var input = formInputs[i]
                if (input.checked) {

                    var name = input.name.replace('cookies-', '')
                    var value = input.value === 'yes'

                    options[name] = value
                }
            }

            // console.log(options);
            document.cookie = 'dgwltd_cookies_preferences_set=true; expires=' + date.toUTCString() + '; path=/';
            document.cookie = 'dgwltd_cookies_policy=' + JSON.stringify(options) + '; expires=' + date.toUTCString() + '; path=/';

            //Show confirmation message
            let confirmationMessage = document.querySelector('.govuk-notification-banner')
            // hide the message if already visible so assistive tech is triggered when it appears
            confirmationMessage.style.display = 'none'
            //Scroll to top of the page
            document.body.scrollTop = document.documentElement.scrollTop = 0
            //Show the message
            confirmationMessage.style.display = 'block'


        
        }, false);


    };


    //Vanilla nav toggle button
    const toggleNav = (button, elem, masthead)=>{

        //https://piccalil.li/tutorial/build-a-light-and-global-state-system

        //Set up the vars
        const toggleButton = document.querySelector(button);
        const menu = document.querySelector(elem);
        const header = document.querySelector(masthead);

        window.subscribers = [];
        
        const defaultState = {
            status: 'closed',
            enabled: false,
        };

        const state = new Proxy(defaultState, {
            set(state, key, value) {
                const oldState = {...state};

                state[key] = value;

                window.subscribers.forEach(callback => callback(state, oldState));

                return state;
            }
        });

        //If window resized lets watch for when we go bigger than a tablet and switch from the burger menu to a full menu
        const observer = new ResizeObserver((observedItems) => {
            const { contentRect } = observedItems[0];
            // console.log(contentRect);
            // console.log(observedItems[0]);
            if (contentRect.width <= '769') {
                state.enabled = true;
                observedItems[0].target.setAttribute('enabled', state.enabled);
              } else {
                state.enabled = false;
                observedItems[0].target.setAttribute('enabled', state.enabled);
            }
            
        });

        //Watch the header element 
        observer.observe(header);

        //Now an event listener for the burger menu button
        toggleButton.addEventListener('click', function(event) {

            // The JSON.parse function helps us convert the attribute from a string to a real boolean (true/false).
            const open = JSON.parse(toggleButton.getAttribute('aria-expanded'));

            //Switch the state via aria-expanded and set a data attribute status="open" which we can access with CSS
            state.status = open ? 'closed' : 'open';
            toggleButton.setAttribute('aria-expanded', !open);
            menu.setAttribute('status', state.status);

            //Add an additional class to the header just incase we want to do something with it in it's opened state
            if (header) {
                header.classList.toggle('masthead-is-open');
            }

        });

        //Close menu if user hits the escape key
        window.addEventListener('keydown', function(event) {

            if (!event.key.includes('Escape')) { return; }
            //Set aria state and our data attribute
            toggleButton.setAttribute('aria-expanded', 'false');
            state.status = 'closed';
            menu.setAttribute('status', state.status);

            //And remove the class if set
            if (header) {
                header.classList.remove('masthead-is-open');
            }
            
        });

    };

    const blockContrast = (elem)=>{    

        //Get all the blocks with background colors set
        var backgrounds = document.querySelectorAll(elem);

        //If no classes found bail
        // console.log(backgrounds);
        if (!backgrounds) return;

        //Loop through the nodelist of backgrounds and transform the color contrast
        Array.prototype.map.call(backgrounds, function (background) {

            //Get the background color and convert to HEX

            var bgColor = rgb2hex(background.style.backgroundColor);

            // console.log('background color: ' + bgColor);

            //Set the background color
            background.style.color = getContrast(bgColor);

        });
    };

    const cardClick = (elem)=>{  

        const cardLinks = document.querySelectorAll(elem);

        if (!cardLinks) return;

        Array.prototype.forEach.call(cardLinks, function(card, i){

            card.addEventListener("click", handleClick)

            // Click handler but only if text is not selected
            function handleClick(event) {
                const isTextSelected = window.getSelection().toString();
                if (!isTextSelected) {
                    window.location = card.dataset.url;
                }
            }

        });   
        
    };

    //Init
    document.addEventListener("DOMContentLoaded", function() {
        // blockContrast('.has-background');
        //cookieBanner(); // Optional
        //cookieSettingsPage(); // Optional
        //cookieSettingsUpdate(); // Optional
        //cookieScriptsEnable(); // Optional
        toggleNav('#nav-toggle', '#site-navigation', '#masthead');
        cardClick('.dgwltd-card');
     });
    
})();