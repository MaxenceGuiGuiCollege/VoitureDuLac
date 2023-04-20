
// DATE RESERVATION
function getDateToday(){
    const y = new Date().getFullYear();
    const m = new Date().getMonth();
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