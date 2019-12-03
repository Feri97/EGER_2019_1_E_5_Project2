window.onload = function() {
    document
        .getElementById("cover-upload")
        .addEventListener("submit", function(e) {
            e.preventDefault()
            
            let form = e.target
            let formData = new FormData(form)

            let inputs = document.querySelectorAll("form input, form button, form textarea")
            disableInputs(inputs)


               })
}