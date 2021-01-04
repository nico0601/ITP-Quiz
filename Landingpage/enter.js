let button = document.getElementById("auswertung")

button.addEventListener("keyup", click, false )

function click(event) {
    if (event.key === 13) {
        event.preventDefault()
        document.getElementById("auswertung").click()
    }
}