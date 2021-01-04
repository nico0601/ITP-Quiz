let auswertung = document.querySelector('.endresult')

let auswertung1 = document.querySelectorAll('.question')

console.log(auswertung1)

auswertung.addEventListener('click', () => {
    auswertung1.forEach(x => x.style.display ='block')
})