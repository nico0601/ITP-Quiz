let antwort3 = document.getElementById('antwort3')
let antwort4 = document.getElementById('antwort4')
let radio3 = document.getElementById('radio3')
let radio4 = document.getElementById('radio4')
let plus = document.getElementById('plus')
let minus = document.getElementById('minus')

plus.addEventListener('click', mehr, false)
minus.addEventListener('click', weniger, false)


function mehr() {
    if (antwort3.disabled) {
        antwort3.disabled = false
        antwort3.style.opacity = 1
        radio3.disabled = false
        radio3.style.opacity = 1
        minus.style.opacity = 1
        minus.disabled = false
    } else if (antwort4.disabled) {
        antwort4.disabled = false
        antwort4.style.opacity = 1
        radio4.disabled = false
        radio4.style.opacity = 1
        plus.style.opacity = 0.5
        plus.disabled = true
    } else {
    }
}

function weniger() {
    if (!antwort4.disabled) {
        antwort4.disabled = true
        antwort4.style.opacity = 0.5
        radio4.disabled = true
        radio4.style.opacity = 0
        plus.style.opacity = 1
        plus.disabled = false
    } else if (!antwort3.disabled) {
        antwort3.disabled = true
        antwort3.style.opacity = 0.5
        radio3.disabled = true
        radio3.style.opacity = 0
        minus.style.opacity = 0.5
        minus.disabled = true
    } else {
    }
}