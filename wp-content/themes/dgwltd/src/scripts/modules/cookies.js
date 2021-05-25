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

    //Set a default cookie to manage preferences, these can be changed later by the cookie banner or the cookie settings page
    const cookieConsentSet = ()=>{
        //Set the default settings
        let currentConsentCookieVars = { "essential": true, "functional": false, "performance": false, "advertising": false };

        //Get timestamp of one year into the future
        var date = new Date();
        date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);

        //Set the cookie if not defined
        if (getCookie('dgwltd_cookies_policy') === undefined) {
            document.cookie = 'dgwltd_cookies_policy=' + JSON.stringify(currentConsentCookieVars) + '; expires=' + date.toUTCString() + '; path=/';
        };
    };

    // cookieConsentSet();

    module.exports = cookies;

})();