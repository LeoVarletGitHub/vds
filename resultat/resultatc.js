"use strict";

window.onload = init;

function init() {

    $.ajax({
        url: 'ajax/getlesresultats.php',
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: function (data) {
            for (const resultat of data) {
                let tr = lesLignes.insertRow();

                tr.insertCell().innerText = resultat.place;
                tr.insertCell().innerText = resultat.temps;
                tr.insertCell().innerText =;
                tr.insertCell().innerText =;
                tr.insertCell().innerText =;
                tr.insertCell().innerText = membre.telephone;
            }
            $("#leTableau").trigger('update');

            pied.style.visibility = 'visible';
        }

    });


}
