document
        .getElementById("music-upload")
        .addEventListener("submit", function(e) {
            e.preventDefault()
            
            let form = e.target
            let formData = new FormData(form)

            let inputs = document.querySelectorAll("form input, form button, form textarea")
            disableInputs(inputs)

            document.getElementById("upload-response").innerHTML = ""

            axios.post(form.action, formData)
                .then(function (response) {})
                .catch(function (error) {}).finally(function () {
                    enableInputs(inputs)
                })
        })
