
// DATE RESERVATION
function getDateToday(){
    const y = new Date().getFullYear();
    const m = new Date().getMonth() + 1;
    const d = new Date().getDate();
    var zeroM = "";
    var zeroD = "";

    if(m < 10){
        zeroM = "0";
    }
    if(d < 10){
        zeroD = "0";
    }

    return y +"-" + zeroM + m + "-" + zeroD + d;
}

function getDateTomorrow(){
    var dateToday = getDateToday();
    var dateTodayWithoutDay = dateToday.substring(0,8);
    const dT = new Date().getDate() + 1;
    var zeroD = "";

    if(dT < 10){
        zeroD = "0";
    }

    return dateTodayWithoutDay + zeroD + dT;
}

const inputDateToday = document.getElementById("dateDebutReserv");
const inputDateTomorrow = document.getElementById("dateFinReserv");

if(inputDateToday != null){
    inputDateToday.value = getDateToday();
    inputDateTomorrow.value = getDateTomorrow();
}


// VERIFICATION
function verifierValeursAjouter(){
    var nom = document.formAjouterVoiture.nom.value;
    var marque = document.formAjouterVoiture.marque.value;
    var annee = document.formAjouterVoiture.annee.value;
    var km = document.formAjouterVoiture.km.value;
    var desFr = document.formAjouterVoiture.desFr.value;
    var desEn = document.formAjouterVoiture.desEn.value;

    if(nom == "" || annee == "" || km == "" || desFr == "" || desEn == ""){
        document.getElementById('erreur').textContent = 'Veuillez remplir tout les champs obligatoire.';
    }
    else{
        document.formAjouterVoiture.submit();
    }

}

function verifierSuppressionFacture(id){
    var res = confirm("Voulez-vous vraiment supprimer cette facture ?");

    if(res){
        document.formGestionFacture.submit();
        window.location.assign("gestionFacture.php?action=supprimer&no="+id)
    }

}

function verifierSuppression(){
    var res = confirm("Êtes-vous certains de vouloir supprimer ce ou ces enregistrement(s) ?");

    if(res){
        document.formSupprimerVoiture.submit();
    }
}


// FACTURE
function calculerFacture(id){
    var total = 0;

    var kmDebut = document.formModifierFacture.kmDebut.value;
    var kmFin = document.formModifierFacture.kmFin.value;
    var dateDebut = new Date(document.formModifierFacture.dateDebut.value);
    var dateFin = new Date(document.formModifierFacture.dateFin.value);
    var ass = document.formModifierFacture.assurance.value;

    if(kmFin == "" || dateFin == ""){
        document.getElementById('erreur').textContent =
            'Veuillez remplir tout les champs en ce qui concerne le kilometrage final et la date de fin.';
    }
    else{
        var jours = (dateFin - dateDebut)/ 3600000 / 24;
        var kms = (kmFin - kmDebut);

        var totBase = 35 * jours;
        total += totBase;

        var totAssu = 12.95 * jours;
        if(ass == "on"){
            total += totAssu;
        }

        var totKm = (kms - 100) * 0.11;
        total += totKm;

        total *= 1.09975;
        total *= 1.05;

        document.formModifierFacture.action = "gestionFacture.php?action=modifier&id=" + id + "&num=" + id + "&tot=" + total;
        document.formModifierFacture.submit();
    }
}