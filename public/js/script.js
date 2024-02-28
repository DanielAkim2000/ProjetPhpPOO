var form = document.getElementById("formulaire");
//Permet a l'utilisateur de confirmer si vraiment il veut faire ce choix ou pas
if(form){
    form.addEventListener("submit",function(event){
        event.preventDefault();

        let choice = window.confirm("Voulez vous enregistrer?");
        if(choice){
            alert("Mis à jour en cours...");
            this.submit();
        }
    })
}

var collectionDelForl = document.getElementsByClassName("supp");
let arraydelform = Array.from(collectionDelForl);
//Permet a l utilisateur de faire un choix permettant de confirmer si il veut vraiment supprimer ou pas
if(arraydelform){
    arraydelform.forEach(function(delform){
        delform.addEventListener("submit",function(event){
            event.preventDefault();
    
            let choice = window.confirm("Voulez vous vraiment supprimer cette ligne?");
            if(choice){
                alert("Suppression en cours ...");
                this.submit();
            }
        })
    });
} else {
    console.error("Élément non trouvé avec l'ID 'Supprimer'");
}




//Filtre le contenu selon le filtre

var filtre = document.getElementById('filtre');
var table = document.getElementById('table');
var pagination = document.getElementById('pagination');

if(filtre){
    filtre.addEventListener('change',function(e){
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(table){
                    table.innerHTML = this.response;
                    pagination.classList.remove("d-none");
                    pagination.classList.toggle("d-none");
                }
                console.log(this.response);
            }
        }
        let urlActu = window.location.href;

        var match = urlActu.match(/\/ECF\/([^\/]+)\//);

        if (match && match[1]) {
            var path = match[1];
            console.log(path);
        } else {
            console.log("Aucune correspondance trouvée.");
        }

        let url = `/ECF/${path}/Filtre/${this.value}`;

        console.log(url);

        var match = url.match(/\/ECF\/([^\/]+)\//);

        if (match && match[1]) {
            var path = match[1];
            console.log(path);
        } else {
            console.log("Aucune correspondance trouvée.");
        }


        xhr.open("GET",url,true);
        xhr.send();

    })
}

// Recherche par nom 
let formSearch = document.getElementById('recherche');
if(formSearch){
    formSearch.addEventListener('submit', function(event){
        event.preventDefault();
        data = new FormData(this);

        console.log(this);

        var xhr =  new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            console.log(this.status);
            if(this.readyState == 4 && this.status == 200){
                table.innerHTML = this.response;
                pagination.classList.remove("d-none");
                pagination.classList.toggle("d-none");
            }else if(this.readyState == 4){
                console.log("rien a rechercher")
            }
        }
        let urlActu = window.location.href;

        var match = urlActu.match(/\/ECF\/([^\/]+)\//);

        if (match && match[1]) {
            var path = match[1];
            console.log(path);
        } else {
            console.log("Aucune correspondance trouvée.");
        }

        if(path){
            var url = `/ECF/${path}/Recherche`;  
        } else {
            var url = `/ECF/Recherche`;
        }

        console.log('path:'.path)

        console.log(url);

        xhr.open("POST",url,true)
        xhr.send(data);

        return false;
    })
}
//Trie