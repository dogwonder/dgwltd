//Import ES6 dependencies - per ES6 imports, we can omit the `.js` at the end.
//import Cookies from '../vendor/js.cookie'; // Cookie functionality - optional

;(function () {

    'use strict';

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
    const cookieSet = ()=>{

        //ES6 for depenencies
        // window.Cookies = require('js-cookie');
        
        // Cookie vars
        var cookieNotice = document.getElementById('cookieNotice');
        var cookieButton = document.getElementById('cookieButton');

        //If JS enabled then show the notice - falls back to noscipt if not present
        cookieNotice.classList.add('open');

        // Set a cookie
        if (!cookieButton) return;

        cookieButton.addEventListener('click', function (event) {
            //requires js.cookie.js
            // Cookies.set('dgwltd_cookie_notice_accept', 'accepted', { expires: 365, path: '/', domain: 'actiononhearingloss.org.uk' });
            Cookies.set('dgwltd_cookie_notice_accept', 'accepted', { expires: 365, path: '/' });
            cookieNotice.classList.remove('open');

        }, false);

        //Remove notice if cookie is set
        if(cookieNotice && Cookies.get('dgwltd_cookie_notice_accept') === 'accepted') {
            cookieNotice.classList.remove('open');
        }

    }

    //Vanilla nav toggle button
    const toggleNav = (button, elem, masthead)=>{

        // HTML
        // <nav class="navigation">
        // <button aria-expanded="false" aria-controls="menu">Menu</button>
        // <ul id="menu" hidden>
        //     <li><a href="/">Home</a></li>
        //     <li><a href="/benefits">Benefits</a></li>
        //     <li><a href="/pricing">Pricing</a></li>
        //     <li><a href="/blog">Blog</a></li>
        // </ul>
        // </nav>    

        // CSS
        // [hidden] { display: none; }
        // [aria\-expanded=true] {}    
        // #menu:not([hidden]) {pointer-events: all;}

        // Init 
        // toggleNav('.navigation button', '.navigation ul');

        const toggleMenu = document.querySelector(button);
        const menu = document.querySelector(elem);
        const header = document.querySelector(masthead);
        
        // console.log(menuHeight);

        toggleMenu.addEventListener('click', function(event) {
            // The JSON.parse function helps us convert the attribute from a string to a real boolean (true/false).
            const open = JSON.parse(toggleMenu.getAttribute('aria-expanded'));
            // console.log(('#' + menu.id));
            // console.log(elem);
            toggleMenu.setAttribute('aria-expanded', !open);

            //Close all other open menus
            const openMenus = document.querySelectorAll('.nav-show');

            openMenus.forEach(function (nav) {
                // console.log('Open ' + nav.id);
                // console.log('-----');
                // console.log('Menu ' + menu.id);
                if(nav.id !== menu.id) {
                    //Remove other menu opened classes
                    nav.classList.toggle('nav-show');
                    // console.log('Open ' + nav.id);
                    var otherNav = document.querySelector('[aria-controls="' + nav.id + '"]');
                    // console.log(otherNav);
                    //Change the other navigation open state
                    otherNav.classList.remove('nav-open');

                    //Toggle the masthead state (if open close it)
                    header.classList.toggle('masthead-is-open');

                    //Remove the header class for the other navigation
                    header.classList.remove('open-' + nav.id);
                }

            });

            menu.classList.toggle('nav-show');
            toggleMenu.classList.toggle('nav-open');

            //Menu height for offset
            // console.log(menu.offsetHeight);
            let root = document.documentElement; //Remove padding
            root.style.setProperty('--submenu-offset', menu.offsetHeight + 'px');

            if (header) {
                header.classList.toggle('masthead-is-open');
                header.classList.toggle('open-' + menu.id);
            }
        });

        //Close menu if user clicks escape
        window.addEventListener('keydown', function(event) {
            if (!event.key.includes('Escape')) { return; }
            toggleMenu.setAttribute('aria-expanded', 'false');
            menu.classList.remove('nav-show');
            toggleMenu.classList.remove('nav-open');
            if (header) {
            header.classList.remove('masthead-is-open');
            }
        });

    };

    const a11yMenu = (elem)=>{    

        //https://www.w3.org/WAI/tutorials/menus/flyout/#flyoutnavmousefixed

        const menu = document.querySelector(elem);
        const submenus = menu.querySelectorAll('.menu-item-has-children');
        // console.log(submenus.length);

        //If no classes found bail
        // console.log(submenus);
        if (!submenus) return;

        Array.prototype.forEach.call(submenus, function(el, i){
            let timer;
            // const submenu = el.querySelector('.sub-menu');
            // console.log(el.querySelector('[aria-haspopup="true"]'));
            el.addEventListener("mouseover", function(event){
                this.classList.add('menu-open');
                clearTimeout(timer);
            });
            el.addEventListener("mouseout", function(event){
                timer = setTimeout(function(event){    
                    el.classList.remove('menu-open');
                }, 500);
            });
        });


        //Use button as toggle
        Array.prototype.forEach.call(submenus, function(el, i){
            var activatingA = el.querySelector('a');
            var btn = '<button class="button-show-subnav"><span class="visually-hidden">show submenu for "' + activatingA.text + '"</span></button>';
            activatingA.insertAdjacentHTML('afterend', btn);
        
            el.querySelector('button').addEventListener("click",  function(event){

                //Toggle menu open class
                this.parentNode.classList.toggle('menu-open');

                //Set aria attributes based on whether menu is open or closed
                if (this.parentNode.classList.contains('menu-open')) {
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "true");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "true");
                } else {
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "false");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "false");
                }
                event.preventDefault();
                return false;
            });
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
        // cookieSet(); // Optional
        // blockContrast('.has-background');
        a11yMenu('#nav-primary');
        toggleNav('#nav-toggle', '#nav-primary', '#masthead');
        cardClick('.dgwltd-card');
     });
    
})();