let antwort3 = document.getElementById('antwort3feld')
let antwort4 = document.getElementById('antwort4feld')
let plus = document.getElementById('plus')
let minus = document.getElementById('minus')

plus.addEventListener('click', mehr, false)
minus.addEventListener('click', weniger, false)


function mehr() {
    if (antwort3.style.display == "none") {
        antwort3.style.display = "initial"
        minus.style.opacity = 1
        minus.disabled = false
    } else if (antwort4.style.display == "none") {
        antwort4.style.display = "initial"
        plus.style.opacity = 0.5
        plus.disabled = true
    } else {
    }
}

function weniger() {
    if (antwort4.style.display == "initial") {
        antwort4.style.display = "none"
        plus.style.opacity = 1
        plus.disabled = false
    } else if (antwort3.style.display == "initial") {
        antwort3.style.display = "none"
        minus.style.opacity = 0.5
        minus.disabled = true
    } else {
    }
}