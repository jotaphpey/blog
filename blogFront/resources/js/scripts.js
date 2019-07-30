$(document).ready( function() {
    $("#body").Editor();

    $("#add-post").on("submit", function(e){
        e.preventDefault();

        $.post( "/create",  {
            body: $(".Editor-editor").html(),
            title: $(".title").val(),
            _token:$("input[name=_token]").val()
        }, function( data ) {

            if(data.success){
                window.location = "/";
            }else{
                $(".errors-create").text(res.error);
            }
        });
    })

});

