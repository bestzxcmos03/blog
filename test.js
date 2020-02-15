$( document ).ready(function() {
    $('.section').each(function() {
        var translationDiv = $(this).children('.english');
        translationDiv.hide(); // Sets initial translation to hide. You can alternatively do this via css such that all .english { display: none; }.
        var originalDiv = $(this).children('.text'); // Remove if you do not want to hide original text upon toggling
        $(this).click(function(e) {
            translationDiv.toggle();
            originalDiv.toggle(); // Remove if you do not want to hide original text upon toggling
        });
    });
});