$(function() {

    $("#contact-form").submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            cache: false,
            //statusCode: true,
            //error: true,
            datatype: 'json',
            success: function(result) {
                var jsdata = JSON.parse(result);
                //le result equivaut au $array renvoyer par script php
                if (jsdata.isSuccess) {

                    $("#contact-form").append("<p class='merci'>Votre message a bien été envoyé. Merci de m'avoir contacté</p>");
                    $("#contact-form")[0].reset();
                } else {
                    //ce code ajoute apres chaque input le msge d'erreur correspondant
                    $("#nom       + .comments").html(jsdata.nomError);
                    $("#prenom    + .comments").html(jsdata.prenomError);
                    $("#email     + .comments").html(jsdata.emailError);
                    $("#telephone + .comments").html(jsdata.telephoneError);
                    $("#message   + .comments").html(jsdata.messageError);
                }
            }

        });
    });
});

// partie navabar gestion du scolling
$(function() {
    $('.navbar a, footer a').on("click", function(evt) {
        var hash = this.hash;
        evt.preventDefault();
        $('html,body').animate({ scrollTop: $(hash).offset().top }, 900, function() { window.location.hash = hash });

    });
})