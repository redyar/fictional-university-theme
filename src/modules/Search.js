
// Lesson 63

import $ from 'jquery';

class Search {
    // 1. describe and create/initiate our object
    constructor() {
       this.openButton = $(".js-search-trigger");
       this.closeButton = $(".search-overlay__close");
       this.searchOverlay = $(".search-overlay");
       this.searchField = $("#serch-term");
       this.events();
       this.isOvelayOpen = false;
       this.typingTimer;
    }

    // 2. events

    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        // method "keyup" add action for press any button on keybord
        // method "keydown" the same, but workin when you press, like a "keyup" working when your up a button
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keydown", this.typingLogic.bind(this));
    }


    // 3. methods (function, action...)
    
    typingLogic() {
        clearTimeout(this.typingTimer);
        this.typingTimer = setTimeout();
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.isOvelayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOvelayOpen = false;
    }

    //e.keyCode - make it possible to recognize a number of keybutton on your keybord
    // esc button have a 27 number. COOL
    keyPressDispatcher(e) {
        if(e.keyCode == 83 && !this.isOvelayOpen) {
            this.openOverlay();
        }

        if(e.keyCode == 27 && this.isOvelayOpen) {
            this.closeOverlay();
        }
    }
}

export default Search