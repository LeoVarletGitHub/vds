"use strict";

window.onload = init;

function init() {
    $('[data-toggle="tooltip"]').tooltip();
    $("#leTableau").tablesorter({
        headers: {
            7: {sorter: false}
        }
    });

    nomR.onkeypress = (e) => {
        if (!/[a-z A-z]/.test(e.key)) return false;
    }
    let $nomR = $("#nomR");
    // paramétrage du composant
    let option = {
        // source de la zone d'autocomplétion
        url: "ajax/getlescoureurs.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "nomPrenom",
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
                clearTable();
                getLesCoureurs($nomR.getSelectedItemData().id);
            },
        },
        theme: "round"
    }
    // lance l'autocomplétion
    $nomR.easyAutocomplete(option);
    nomR.focus();


}

function getLesCoureurs(id) {
    $.ajax({
        url: 'ajax/getlescoureursresultat.php',
        type: 'post',
        data: {idCoureur: id},
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: afficher
    });
}

    function afficher(data) {
        for (const coureur of data) {
            let tr = lesLignes.insertRow();


            tr.insertCell().innerText = coureur.date;
            tr.insertCell().innerText = coureur.distance;
            tr.insertCell().innerText = coureur.temps;

            let d = coureur.distance === '10 Km' ? 10 : 5;
            let heure = Number(coureur.temps.substr(0, 2));
            let seconde = Number(coureur.temps.substr(6, 2));
            let minute = Number(coureur.temps.substr(3, 2));
            let tempsEnSeconde = heure * 3600 + minute * 60 + seconde;
            let vitesse = 3600 * (d) / tempsEnSeconde;
            tr.insertCell().innerText = vitesse.toFixed(2);

            let allure = Math.floor(tempsEnSeconde / d);

            let mn = Math.floor(allure / 60);
            let se = allure - mn * 60;
            let seT = '0' + se;

            tr.insertCell().innerText = mn.toString() + ':' + seT.slice(-2);
            tr.insertCell().innerText = coureur.place;
            tr.insertCell().innerText = coureur.club;
            tr.insertCell().innerText = coureur.categorie;
        }
        $("#leTableau").trigger('update');

        pied.style.visibility = 'visible';
    }

function clearTable() {
    $("#leTableau tbody").empty();
}



