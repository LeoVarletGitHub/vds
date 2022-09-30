"use strict";

window.onload = init;

function init() {
    $('[data-toggle="tooltip"]').tooltip();
    $("#leTableau").tablesorter({
        headers: {
            7: {sorter: false}
        }
    });

    $.ajax({
        url: 'ajax/getlesresultats.php',
        dataType: 'json',

        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },

        success: function (data) {
            for (const resultat of data) {
                let tr = lesLignes.insertRow();


                tr.insertCell().innerText = resultat.;
                tr.insertCell().innerText = resultat.temps;
                tr.insertCell().innerText = resultat.distance;
                tr.insertCell().innerText = null;
                tr.insertCell().innerText = resultat.nomPrenom;
                tr.insertCell().innerText = resultat.categorie;
                tr.insertCell().innerText = resultat.placeCategorie;
                tr.insertCell().innerText = resultat.club;
            }
            $("#leTableau").trigger('update');

            pied.style.visibility = 'visible';
        }

    });


}
