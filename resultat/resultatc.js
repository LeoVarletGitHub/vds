"use strict";

window.onload = init;

function init() {
    $('[data-toggle="tooltip"]').tooltip();
    $("#leTableau").tablesorter({
        headers: {
            7: {sorter: false}
        }
    });

    let $nomR = $("#nomR");
    // paramétrage du composant
    let option = {
        // source de la zone d'autocomplétion
        url: "ajax/getlesresultats.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "date",
        list: {
            match: {
                // activate du filtre sur la zone
                enabled: true,
                // comparaison à partir du premier caractères
                method: (element, phrase) => element.indexOf(phrase) === 0
            },
            // sur la sélection d'un nom dans la liste
            onChooseEvent: function () {
                // récupération du numéro de licence pour le nom sélectionné

                $.ajax({
                    url: "ajax/getlesresultats.php",
                    type: 'post',
                    data: {valeur: nomR.value},
                    dataType: "json",
                    success: afficher,
                    error: (reponse) => Std.afficherErreur(reponse.responseText)
                });
            },
            // à chaque fois que l'utilisateur saisit un caractère
            onLoadEvent: () => {
                let lesValeurs = $nomR.getItems();
                let nb = lesValeurs.length;
                if (nb === 1) {
                    afficher(lesValeurs[0]);
                    nomR.blur();
                } else if (nb === 0) {
                    nomR.blur();
                    Std.afficherErreur("aucune course correspondante");
                }

            }
        },
        theme: "round"
    }
    // lance l'autocomplétion
    $nomR.easyAutocomplete(option);
    nomR.focus();

}

function getLesCourses() {
    lesLignes.innerHTML = '';
    $.ajax({
        url: "ajax/getlesresultats.php",
        type: 'post',
        data: {valeur: nomR.value},
        dataType: "json",
        success: afficher,
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    });

}

function afficher(data) {
    let tr = lesLignes.insertRow();


    tr.insertCell().innerText = data.place;
    tr.insertCell().innerText = data.temps;
    tr.insertCell().innerText = data.distance;
    tr.insertCell().innerText = null;
    tr.insertCell().innerText = data.nomPrenom;
    tr.insertCell().innerText = data.categorie;
    tr.insertCell().innerText = data.placeCategorie;
    tr.insertCell().innerText = data.club;

    $("#leTableau").trigger('update');

    pied.style.visibility = 'visible';
}

