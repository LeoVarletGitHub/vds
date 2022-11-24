"use strict";
window.onload = init;

function init() {
    remplirListeNonParticipants();
    date.onchange = remplirLesSaisons;

    btnAjouter.onclick = ajouter;
}

function remplirListeNonParticipants() {
    $.ajax({
        url: 'ajax/Coursesnonparticipant.php',
        type: 'POST',
        dataType: "json",
        error: response => console.error(response.responseText),
        success: afficher
    });
}

function remplirLesSaisons() {
    document.getElementById('saison').options.length = 0;
    var dateMois = new Date(document.getElementById("date").value);
    var mois = dateMois.getMonth() + 1;

    if (1 <= mois && mois < 4) {
        saison.appendChild(new Option("Hiver", "HIVER"));
        saison.appendChild(new Option("Printemps", "PRINTEMPS"));
    } else if (4 <= mois && mois < 7) {
        saison.appendChild(new Option("Printemps", "PRINTEMPS"));
        saison.appendChild(new Option("été", "ETE"));
    } else if (7 <= mois && mois < 10) {
        saison.appendChild(new Option("été", "ETE"));
        saison.appendChild(new Option("Automne", "AUTOMNE"));
    } else if (10 <= mois) {
        saison.appendChild(new Option("Automne", "AUTOMNE"));
        saison.appendChild(new Option("Hiver", "HIVER"));
    }
}


function afficher(data) {
    lesLignes.innerHTML = '';
    for (const course of data) {
        let tr = lesLignes.insertRow();
        tr.insertCell().innerText = course.date;
        tr.insertCell().innerText = course.saison;
        tr.insertCell().innerText = course.distance;
        let i = document.createElement('i');
        i.classList.add("bi", "bi-x", "fs-2", "text-danger", "float-end");
        i.title = 'Supprimer la course'
        new bootstrap.Tooltip(i, {placement: 'left'});
        i.onclick = () => Std.confirmer(() => supprimer(course.id));
        tr.appendChild(i);
    }
    $("#leTableau").trigger('update');

    pied.style.visibility = 'visible';
}

function ajouter() {
    if (Std.donneesValides()) {
        var saison = document.getElementById("saison").value;
        var date = document.getElementById("date").value;
        var distance = document.getElementById("distance").value;
        if (date == '' || saison == '') {
            msg.innerHTML = Std.genererMessage('Les champs ne sont pas remplis.');
        } else {
            // lancement de la demande d'ajout dans la base
            $.ajax({
                url: 'ajax/ajouter.php',
                type: 'POST',
                data: {
                    date: date,
                    saison: saison,
                    distance: distance,
                },
                dataType: 'json',
                error: reponse => {
                    msg.innerHTML = Std.genererMessage(reponse.responseText)
                },
                success: function (data) {
                    let parametre = {
                        type: 'success',
                        message: 'Ajout réalisé avec succès',
                        fermeture: 1,
                    }
                    Std.afficherMessage(parametre);
                    Std.viderLesChamps();
                    let tr = lesLignes.insertRow();
                    tr.insertCell().innerText = date;
                    tr.insertCell().innerText = saison;
                    tr.insertCell().innerText = distance;
                    $("#leTableau").trigger('update');
                }

            })
        }
    }
}

function supprimer(id) {
    $.ajax({
        url: 'ajax/supprimer.php',
        type: 'POST',
        data: {id: id},
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: () => {
            $("#leTableau tbody").empty();
            remplirListeNonParticipants();
        }
    });
}