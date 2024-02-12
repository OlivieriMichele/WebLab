document.addEventListener("DOMContentLoaded", function () {
    
    // nascondi tutte le immagini tranne le prime due
    var images = document.querySelectorAll(".slider-image img");
    for(let i=2; i<images.length; i++){
        images[i].style.display = "none";
    }

    // aggiungi la classe current alla prima immagine
    images[0].classList.add("current");

    // funzinone che gestisce i click sulle immagini
    for(let i=0; i<images.length; i++){
        images[i].addEventListener('click', function(){

            if(!this.classList.contains("current")){
                // rimuovi la classe current dalle altre immmagini
                for(let j=0; j<images.length; j++){
                    images[j].classList.remove("current");
                }

                // aggiungo current all'immagine cliccata
                this.classList.add("current");

                // nascondi tutte le immagini
                for(let j=0; j<images.length; j++){
                    images[j].style.display = "none";
                }

                // mostra l'immagine corrente
                this.style.display = "inline-block";

                // determina l'indice corrente
                let currentIndex = Array.from(images).indexOf(this);

                // mostra la prima
                if(currentIndex>0){
                    images[currentIndex-1].style.display = "inline-block";
                }

                // mostra la successiva
                if(currentIndex<images.length-1){
                    images[currentIndex+1].style.display = "inline-block";
                }
            }
        });
    }

});