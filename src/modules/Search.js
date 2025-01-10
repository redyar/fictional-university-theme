
// Lesson 63

import $ from 'jquery';

class Search {

    // 1. describe and create/initiate our object
    constructor() {
       // добавляем HTML код с блоком поиска в footer   
       this.addSearchHTML();
       // получаем поля в которое будем выводить результаты поиска  
       this.resultsDiv    = $("#search-overlay__results");
       // получаем лупу, кнопка для открытия поля поиска  
       this.openButton    = $(".js-search-trigger");
       // получаем крестик, кнопка закрытия окна поиска
       this.closeButton   = $(".search-overlay__close");
       // получаем блок поиска
       this.searchOverlay = $(".search-overlay");
       // получаем поле для ввода запроса
       this.searchField   = $("#search-term");
       // регистрируем события
       this.events();
       this.isOvelayOpen  = false;
       this.isSpinnerVisible = false;
       this.previousValue;
       this.typingTimer;
    }

    // 2. events
    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        // method "keyup" add action for press any button on keybord
        // method "keydown" the same, but workin when you press, like a "keyup" working when your up a button
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }


    // 3. methods (function, action...)
    typingLogic() {
        if(this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.val()) {
                if(!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 200);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }
        
        this.previousValue = this.searchField.val();
    }

    //Synchroonous - действия совершаются одно за другим. пока происзодит первое, второе не начинается.

    //Asynchronous - все действия происходят в одно время

    getResults() {
        // в файле functions.php зарегистрировали php-функцию(universityData.root_url) c адресом сайта для нашего скрипта 
        //  используем тернарный оператор, что-бы определить приходящий ответ от JSON
        //  Если posts.length(определяет длинну) true, добавляем <ul> else добавляем <p>
        // $.when() - Для обеспечения одновременной обработки нескольких Ajax-запросов
        // .then() - После завершения всех запросов результата будут обработаны в обработчике
        
        $.when(
            $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
             $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
            ).then((posts, pages) => {
                // переменная combinedResults для комбинирования вывода запросов из posts and pages
                var combinedResults = posts[0].concat(pages[0]);

                this.resultsDiv.html(`
                    <h2 class="search-overlay__section-title">General Info</h2>
                    ${ combinedResults.length ? '<ul class="link-list link0list">' : '<p> No mathches. </p>'}
                        ${ combinedResults.map(item => `<li><a href="${ item.link }">${ item.title.rendered }</a></li>`).join(' ')}
                    ${ combinedResults.length ? "</ul>" : ' ' }
                `);
                // отключаем спинер, что-бы при повторном поиске он запустился заново
                this.isSpinnerVisible = false;
        });

      
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");

        // очишаем поле поиска после закрытия окна поиска
        this.searchField.val('');
        
        //наводим фокус на поле ввода, т.к. при открытии страницы поле ещё не загружено, то нужно добавить таймер и при нажатии на кнопку поиска запустится таймер и добавится фокус на поле
        setTimeout(() => {
            this.searchField.focus();
          }, 100);
        
        this.isOvelayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOvelayOpen = false;
    }

    // e.keyCode - make it possible to recognize a number of keybutton on your keybord
    // esc button have a 27 number. COOL
    keyPressDispatcher(e) {
        if(e.keyCode == 83 && !this.isOvelayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }

        if(e.keyCode == 27 && this.isOvelayOpen) {
            this.closeOverlay();
        }
    }

    addSearchHTML() {
        $("body").append(`
            <div class="search-overlay">
                <div class="seacrh-overlay__top">
                    <div class="container">
                    <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input id="search-term" type="text" autocomplete="off" class="search-term" placeholder="What are you looking for?">
                    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                    </div>
                </div> 
                
                <div class="container">
                    <div id="search-overlay__results"></div>
                </div>
            </div>    
        `);
    }
}

export default Search