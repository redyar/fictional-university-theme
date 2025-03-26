
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
    $.getJSON(universityData.root_url + "/wp-json/university/v1/search?term=" + this.searchField.val(), results => {
            this.resultsDiv.html(`
                <div class="row">
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">General Info</h2>
                        ${ results.generalInfo.length ? '<ul class="link-list link0list">' : '<p> No mathches. </p>'}
                            ${ results.generalInfo.map(item => `<li><a href="${ item.permalink }">${ item.title }</a> ${ item.post_type == 'post' ? `by ${ item.authorName }` : '' } </li> <img class='img_search' src="${ item.perfectImage ? item.perfectImage : '' }">`).join(' ')}
                        ${ results.generalInfo.length ? "</ul>" : ' ' }
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Programs</h2>
                        ${ results.programs.length ? '<ul class="link-list link0list">' : `<p> No Programs mathches. <a href="${universityData.root_url}/programs">View all Programs</a> </p>`}
                            ${ results.programs.map(item => `<li><a href="${ item.permalink }">${ item.title }</a></li> <img class='img_search' src="${ item.perfectImage ? item.perfectImage : '' }">`).join(' ')}
                        ${ results.programs.length ? "</ul>" : ' ' }
                        <h2 class="search-overlay__section-title">Professors</h2>
                        ${ results.professors.length ? '<ul class="professor-cards">' : `<p> No Professors mathches.</p>`}
                            ${ results.professors.map(item => `
                                <li class="professor-card__list-item">
                                    <a class="professor-card" href="${ item.permalink }">
                                        <img class="professor-card__image" src="${ item.thumbnail }" alt="">
                                        <span class="professor-card__name">${ item.title }</span>
                                    </a>
                                </li>
                            `).join(' ')}
                        ${ results.professors.length ? "</ul>" : ' ' }
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Campuses</h2>
                        ${ results.campuses.length ? '<ul class="link-list link0list">' : `<p> No Campus mathches. <a href="${universityData.root_url}/campuses">View all Programs</a> </p>`}
                            ${ results.campuses.map(item => `<li><a href="${ item.permalink }">${ item.title }</a></li> <img class='img_search' src="${ item.perfectImage ? item.perfectImage : '' }">`).join(' ')}
                        ${ results.campuses.length ? "</ul>" : ' ' }
                        <h2 class="search-overlay__section-title">Events</h2>
                        ${ results.events.length ? '' : `<p> No events mathches. <a href="${universityData.root_url}/events">View all Events</a> </p>`}
                            ${ results.events.map(item => `
                                <?php
                                    
                                ?>
                                <div class="event-summary">
                                    <a class="event-summary__date t-center" href="${ item.permalink }">
                                        <span class="event-summary__month">${ item.month }</span>
                                        <span class="event-summary__day">${ item.day }</span>
                                    </a>
                                    <div class="event-summary__content">
                                        <h5 class="event-summary__title headline headline--tiny"><a href="${ item.permalink }">${ item.title }</a></h5>
                                        <p>${ item.content }<a href="${ item.permalink }" class="nu gray">Learn more</a></p>
                                    </div>
                                </div>
                            `).join(' ')}
                    </div>
                </div>
            `);
            this.isSpinnerVisible = false
        }) ;


        // в файле functions.php зарегистрировали php-функцию(universityData.root_url) c адресом сайта для нашего скрипта
        //  используем тернарный оператор, что-бы определить приходящий ответ от JSON
        //  Если posts.length(определяет длинну) true, добавляем <ul> else добавляем <p>
        // $.when() - Для обеспечения одновременной обработки нескольких Ajax-запросов
        // .then() - После завершения всех запросов результата будут обработаны в обработчике

        // $.when(
        //     $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
        //      $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
        //     ).then((posts, pages) => {
        //         // переменная combinedResults для комбинирования вывода запросов из posts and pages
        //         var combinedResults = posts[0].concat(pages[0]);

        //         this.resultsDiv.html(`
        //             <h2 class="search-overlay__section-title">General asascdascInfo</h2>
        //             ${ combinedResults.length ? '<ul class="link-list link0list">' : '<p> No mathches. </p>'}
        //                 ${ combinedResults.map(item => `<li><a href="${ item.link }">${ item.title.rendered }</a> ${ item.type == 'post' ? `by ${ item.authorName }` : '' } </li> <img class='img_search' src="${ item.perfectImage ? item.perfectImage : '' }">`).join(' ')}
        //             ${ combinedResults.length ? "</ul>" : ' ' }
        //         `);
        //         // отключаем спинер, что-бы при повторном поиске он запустился заново
        //         this.isSpinnerVisible = false;
        // }, () => {
        //     this.resultsDiv.html('<p>Unexpected Error</p>');
        // });

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
