$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
    });

    $(".delete-post").click(function(){
        var article = $(this);
        if (confirm('Are you sure you want to delete this article?')) {
            $.post("/delete-article", {
                article: article.attr("post-id"),
            }, function (data) {
                if (data.success) {
                    alert("Article deleted");
                    article.parents(".card").remove();
                } else {
                    alert(data.message);
                }
            });
        }
    })

});

