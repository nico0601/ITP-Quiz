let auswertung = document.querySelector('#result')

let auswertung1 = document.querySelectorAll('.category')

auswertung.addEventListener('click', () => {
    auswertung1.forEach(x => x.style.opacity == 1 ? x.style.opacity = 0 : x.style.opacity = 1)
})

