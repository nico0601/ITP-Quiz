let auswertung = document.querySelector('.endresult')

let auswertung1 = document.querySelectorAll('.question')
let button = document.querySelectorAll('#zurueck-button')

console.log(auswertung1)

auswertung.addEventListener('click', () => {
    auswertung1.forEach(x => x.style.display == 'block' ? x.style.display ='none' : x.style.display ='block')
    button.forEach(x => x.style.display == 'inline-block' ? x.style.display ='none' : x.style.display ='inline-block')
})