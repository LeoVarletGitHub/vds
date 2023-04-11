"use strict";
let lesCourses;
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
        url: "ajax/getlesCourses.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "nomCourse",
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
                let laCourse = $nomR.getSelectedItemData();
                nomR.value = laCourse.nomCourse;
                // lancer la récupération des résultats de cette course
                getLesResultats(laCourse.id);
            },
        },
        theme: "round"
    }
    // lance l'autocomplétion
    $nomR.easyAutocomplete(option);
    nomR.focus();

    idCategorie.onchange = afficher;
    sexe.onchange = afficher;

    $.ajax({
        url: 'ajax/getlesdonnees.php',
        type: 'POST',
        dataType: "json",
        error: response => console.error(response.responseText),
        success: remplirLesDonnees
    });

    pied.style.visibility = 'visible';
}

function remplirLesDonnees(data) {
    for (const categorie of data)
        idCategorie.appendChild(new Option(categorie.categorie, categorie.categorie))
}

function getLesResultats(id) {

    lesLignes.innerHTML = '';
    $.ajax({
        url: "ajax/getlesresultats.php",
        type: 'post',
        data: {idCourse: id},
        dataType: "json",
        success: (data) => {
            lesCourses = data;
            afficher();
        },
        error: reponse => msg.innerHTML = Std.afficherErreur(reponse.responseText)
    });

}

function afficher() {
    lesLignes.innerHTML = '';
    for (const resultat of lesCourses) {
        if (resultat.sexe !== sexe.value && sexe.value !== '*') continue;
        if (resultat.categorie !== idCategorie.value && idCategorie.value !== '*') continue;

        let tr = lesLignes.insertRow();

        tr.insertCell().innerText = resultat.place;
        tr.insertCell().innerText = resultat.temps;

        let d = resultat.distance === '10 Km' ? 10 : 5;
        let heure = Number(resultat.temps.substring(0, 2));
        let seconde = Number(resultat.temps.substring(6, 9));
        let minute = Number(resultat.temps.substring(3, 6));
        let tempsEnSeconde = heure * 3600 + minute * 60 + seconde;
        let vitesse = 3600 * (d) / tempsEnSeconde;
        tr.insertCell().innerText = vitesse.toFixed(2);

        let allure = Math.floor(tempsEnSeconde / d);

        let mn = Math.floor(allure / 60);
        let se = allure - mn * 60;
        let seT = '0' + se;

        tr.insertCell().innerText = mn.toString() + ':' + seT.slice(-2);
        tr.insertCell().innerText = resultat.nomPrenom;
        tr.insertCell().innerText = resultat.categorie;
        tr.insertCell().innerText = resultat.placeCategorie;
        tr.insertCell().innerText = resultat.club;
    }
    $("#leTableau").trigger('update');


}

function clearTable() {
    $("#leTableau tbody").empty();
}

