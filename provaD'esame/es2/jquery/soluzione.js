document.addEventListener('DOMContentLoaded', function() {
    console.log("Il DOM è caricato correttamente.");

    let form = this.querySelector("form");
    let span = this.querySelectorAll('span');
    let button = this.querySelectorAll('button');

    form.style.display = "none";
    span.forEach( elem => {
        elem.style.display = "none";
    })
    button[1].style.display = "none";

    button[0].addEventListener('click', () => {
        $.ajax({
            url: '../php/index.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                
            },
            error: function(error) {
                console.error('Errore durante la richiesta AJAX:', error);
            }
        });
        form.style.display = "block";
    })
})