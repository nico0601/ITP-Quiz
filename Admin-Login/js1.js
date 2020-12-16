let eingabe = document.getElementById("passwortEingabe")
let button = document.getElementById("button-weiter")

// button.addEventListener("click", button_disable, false)
// eingabe.addEventListener("keyup", click, false )


let $_GET = {};

// puts the header data in $_GET
if (document.location.toString().indexOf('?') !== -1) {
    let query = document.location
        .toString()
        .replace(/^.*?\?/, '')
        .replace(/#.*$/, '')
        .split('&');
    for (let i = 0, l = query.length; i < l; i++) {
        let aux = decodeURIComponent(query[i]).split('=');
        $_GET[aux[0]] = aux[1];
    }
}


// function error(variab) {
//     let zaehler = variab;
//     console.log(zaehler);
//     if (zaehler < 3) {
//         passwortError.style.display = "inherit"
//         passwortError.innerHTML = "Falsche Passworteingabe! Versuch " + zaehler + "/3:"
//     }
// }

// function click(event) {
//     if (event.key === 13) {
//         event.preventDefault()
//         button.click()
//     }
// }