
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

const inputDateToday = document.getElementById("dateDebut");
const inputDateTomorrow = document.getElementById("dateFin");

if(inputDateToday != null){
    inputDateToday.value = getDateToday();
    inputDateTomorrow.value = getDateTomorrow();
}


// VERIFICATION
function verifierValeursSupprimer(){
    var isOneCheck = false;

    var nbrLigne = document.getElementById('tableSupprimerVoiture').rows.length;

    for(var i = 0; i < nbrLigne - 1; i++){

        if(document.getElementById('chkNo' + i).checked){
            isOneCheck = true;
        }
    }

    if(isOneCheck){
        document.getElementById('erreur').textContent = "";
        verifierSuppression();
    }
    else{
        document.getElementById('erreur').textContent = 'Veuillez séléctionner une voiture.';
    }

}

function verifierSuppression(){
    var res = confirm("Êtes-vous certains de vouloir supprimer ce ou ces enregistrement(s) ?");

    if(res){
        document.formSupprimerVoiture.submit();
    }

}