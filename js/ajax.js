function loadDpt(obj) {
    // ein XMLHttpRequest-Objekt erstellen
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // einnen listener erstellen, wenn die Seite(der Text vom Server) existiert (200 OK)
        // und komplett ausgeliefert worden ist, dann steht die Antwort im Attribut responseText
        if (this.readyState == 4 && this.status == 200) {
            // document.querySelector('[data-id="2"]').value = obj.dataset.id;
        }
    };
    // die Anfrage vorbereiten
    xhttp.open("POST", "ajax.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // die Anfrage absenden
    xhttp.send("area=department&id=" + obj.dataset.id + "&dptName=" + obj.value);
}

function loadEmp(obj) {
    // ein XMLHttpRequest-Objekt erstellen
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // einnen listener erstellen, wenn die Seite(der Text vom Server) existiert (200 OK)
        // und komplett ausgeliefert worden ist, dann steht die Antwort im Attribut responseText
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    // die Anfrage vorbereiten
    xhttp.open("POST", "ajax.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // die Anfrage absenden
    xhttp.send("area=employee&id=" + obj.dataset.id + "&data-attr=" + obj.dataset.attr + "&value=" + obj.value);
}