"use strict"

window.onload = () => {
    $(':checkbox').checkboxpicker();
    btnAjouter.onclick = ajouter;
}

function ajouter() {
    Std.effacerLesErreurs();
    // if (!Std.donneesValides()) return

    // données transmises
    let data = {
        nom: nom.value.toUpperCase(),
        numero: numero.value.toUpperCase(),
        date: date.value,
        challenge: challenge.checked ? 1 : 0,
        label: label.checked ? 1 : 0
    }
    if (distance.value.length > 0) data.distance = distance.value.toLowerCase();
    $.ajax({
            url: 'http://formation/api/calendrier/',
            method: 'POST',
            headers: {
                "Authorization": "Bearer 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",
                "Content-type": "application/json"
            },
            data: JSON.stringify(data),
            contentType: false,
            processData: false,
            dataType: "json",
            success: (data) => {
                if (data.message) {
                    Std.afficherErreur(data.message)
                } else if (data.error) {
                    for (const erreur of data.error) {
                        if (erreur.champ === 'msg') {
                            msg.innerHTML = Std.genererMessage(erreur.message);
                        } else {
                            let champ = document.getElementById('msg' + erreur.champ)
                            champ.innerText = erreur.message;
                        }
                    }
                } else if (data.success) {
                    Std.retournerVers(data.success, 'index.php');
                } else {
                    Std.afficherErreur("Le serveur n'a pas renvoyé de réponse, contacter la maintenance");
                }
            },
            error: (reponse) => {
                msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
                console.error(reponse.responseText)
            }
        }
    );
}