'use strict'

nextone(null, null)


function nextone(antwort_id, richtig) {
    let xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (document.getElementById('inhalt') != null) {
                document.getElementById('inhalt').innerHTML = this.responseText
            }
        }
    }


    if( richtig != null) {
        if (richtig) {
            let win = new Audio('../Audios/Correct.mp3')
            win.play()
        } else {
            let win1 = new Audio('../Audios/Fail.wav')
            win1.play()
        }
    }
    xmlhttp.open('GET', 'index3.php?antwort=' + antwort_id, true)
    xmlhttp.send()
}


//TIMER

// Set the current time and the timer
let countDownDate = new Date().getTime()
let timer_ms = 30000 * 60

// Time calculations for minutes and seconds
let minutes = Math.floor((timer_ms % (1000 * 60 * 60)) / (1000 * 60))
let seconds = Math.floor((timer_ms % (1000 * 60)) / 1000)
// document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s "

//Adds or takes time from or to the Timer

function add(truefalse){
    if(truefalse){
        timer_ms += 3000
    }else{
        timer_ms -= 3000
    }
}

// Update the count down every 1 second
let x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime()

    // Find the distance between now and the count down date
    let distance = countDownDate - (now-timer_ms);

    // Time calculations for minutes and seconds
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
    let seconds = Math.floor((distance % (1000 * 60)) / 1000)

    if (distance%10000 < 1000 && distance > 10000) {
        document.getElementById("timer").className = "gross";
    }else if (distance%10000 < 10000) {
        document.getElementById("timer").className = "klein";
    }

    // Display the result in the element with id="timer"
    if (distance >= 60000) {
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s "
    }else {
        document.getElementById("timer").innerHTML = seconds + "s "
    }

    // If the count down is finished, forward to evaluation-page
    if (distance < 1000) {
        clearInterval(x)
        window.location.assign("../Landingpage/index4.php")
        // document.getElementById("timer").innerHTML = "ran out of time"
    }
}, 200)

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}