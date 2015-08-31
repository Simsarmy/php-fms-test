$('.folder').click(function() {
    $.post( "index.php", { folder: $(this).text()}, function( data ) {
       $("html").html(data);
    });
});