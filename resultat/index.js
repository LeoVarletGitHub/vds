"use strict";

window.onload = init;

function init() {
    $.ajax({
        url: 'ajax/Coursesnonparticipant.php',
        type: 'POST',
        dataType: "json",
        error: response => console.error(response.responseText),
        success: afficher
    });
}

function afficher(data) {
    lesLignes.innerHTML = '';
    for (const course of data) {
        let tr = lesLignes.insertRow();
        tr.insertCell().innerText = course.date;
        tr.insertCell().innerText = course.saison;
        tr.insertCell().innerText = course.distance;
    }
    $("#leTableau").trigger('update');

    pied.style.visibility = 'visible';
}