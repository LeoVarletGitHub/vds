"use strict"

window.onload = () => {
    $.ajax({
        // url: "https://courses80.fr/calendrier/",
        url: "http://formation/api/calendrier/",
        method: "get",
        dataType: "json",
        timeout: 0,
        success: (data) => {
            for (const element of data) {
                let tr = lesLignes.insertRow();
                tr.style.verticalAlign = 'middle'
                if (element.challenge === 1) tr.style.backgroundColor = "springgreen"
                if (element.annulee > 0) {
                    tr.style.textDecoration = "line-through"
                    tr.style.backgroundColor = "red"
                }

                // colonne challenge
                let td = tr.insertCell();
                td.classList.add("masquer");
                if (element.challenge === 1) {
                    let i = document.createElement('i');
                    i.classList.add("bi", "bi-trophy", "text-danger", "m-1");
                    i.title = "Course inscrite au challenge"
                    td.appendChild(i);
                }

                if (element.label === 1) {
                    let i = document.createElement('i');
                    i.classList.add("bi", "bi-gem", "text-danger", "m-1");
                    i.title = "Label FFA, qualificative pour les championnats de France"
                    td.appendChild(i);
                }

                // colonne date
                tr.insertCell().innerText = element.dateFr;

                // colonne numero
                tr.insertCell().innerText = element.numero;

                //  colonne nom
                tr.insertCell().innerText = element.nom;

                //  colonne distance
                td = tr.insertCell();
                td.innerText = element.distance;
                td.classList.add("masquer");
            }
            nb.innerText = data.length;

            $('#leTableau').DataTable({
                language: {"url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json"},
                paging: false,
                bInfo: false,
                bProcessing: true,
                bSort: true,
                order: [[1, 'asc']],
                columnDefs: [{"targets": 1, "type": "date-eu"}],
                aoColumns: [{bSortable: false}, null, null, null, {bSortable: false}],
                dom: "<'row'<'col-md-6'f>>",
            });
        },
        error: (reponse) => {
            console.log(reponse.responseJSON.message);
            Std.afficherErreur(reponse.responseJSON.message)
        }
    });


}


