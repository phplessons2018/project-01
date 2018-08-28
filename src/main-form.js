

$('#submit').click(function() {
    $.post(

        "form.php", //url

        {
            email: $('[name="email"]').val(),
            name: $('[name="name"]').val(),
            phone: $('[name="phone"]').val()
        },


    );


});