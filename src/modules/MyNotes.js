import $ from 'jquery';

class MyNotes {
    constructor() {
        this.events();
    }

    events() {
        $(".delete-note").on("click", this.deleteNote);
        $(".edit-note").on("click", this.editNote.bind(this));
        $(".update-note").on("click", this.updateNote.bind(this));
        $(".submit-note").on("click", this.createNote.bind(this));
    }

    //Metods will go here
    editNote(e) {
        let thisNote = $(e.target).parents("li");
        if (thisNote.data("state") == "editable") {
            this.makeNoteReadOnly(thisNote);
        } else {
            this.makeNoteEditable(thisNote);
        }
    }

    makeNoteEditable(thisNote) {
        thisNote.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true"></i>Cancel');
        thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
        thisNote.find(".update-note").addClass("update-note--visible");
        thisNote.data("state", "editable");
    }

    makeNoteReadOnly(thisNote) {
        thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i>Edit');
        thisNote.find(".note-title-field, .note-body-field").attr("readonly", "readonly").removeClass("note-active-field");
        thisNote.find(".update-note").removeClass("update-note--visible");
        thisNote.data("state", "cancel");
    }

    deleteNote(e) {
        let thisNote = $(e.target).parents("li"); // получаем тэг с атрибутом data-id
        console.log(thisNote.data('id'));
        $.ajax({
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            success: (response) => {
                thisNote.slideUp(); // Скрыть удалённую заметку слайдом вверх
                console.log('Congrats!');
                console.log(response);
            },
            error: (response) => {
                console.log('Sorry!');
                console.log(response);
            }
        });
    }

    updateNote(e) {
        let thisNote = $(e.target).parents("li"); // получаем тэг с атрибутом data-id
        console.log(thisNote.data('id') + ' я тут');
        let ourUpdatedPost = {
            'title' : thisNote.find(".note-title-field").val(), //Gets the current value of the first element in the set of matched elements
            'content' : thisNote.find(".note-body-field").val(),
        }
        console.log(thisNote.find(".note-body-field").val());
        $.ajax({
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatedPost,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            success: (response) => {
                this.makeNoteReadOnly(thisNote);
                console.log('Congrats!');
                console.log(response);
            },
            error: (response) => {
                console.log('Sorry!');
                console.log(response);
            }
        });
    }

    createNote(e) {
        let ourNewPost = {
            'title' : $(".new-note-title").val(), //Gets the current value of the first element in the set of matched elements
            'content' : $(".new-note-body").val(),
            'status' : 'publish'
        }
        $.ajax({
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            success: (response) => {
                $(".new-note-title, .new-note-body").val('');
                $('<li>Imagine real</li>').prependTo("#my-notes").hide().slideDown();
                console.log('Congrats!');
                console.log(response);
            },
            error: (response) => {
                console.log('Sorry!');
                console.log(response);
            }
        });
    }
}

export default MyNotes;