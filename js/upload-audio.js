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
                .then(function (response) {
                    let successHTML = `
                        <div class="success">
                            <p>${response.data.message}</p>
                            <p>${response.data.filename}</p>
                        </div>
                    `
                    document.getElementById("upload-response").innerHTML = successHTML
                })
                .catch(function (error) {
                    let errorHTML = ""
                    const errorMessages = error.response.data.errors
                    for(let i = 0; i < errorMessages.length; i++) {
                        errorHTML += `<p class="form-error">${errorMessages[i]}</p>`
                    }
                    document.getElementById("upload-response").innerHTML = errorHTML
                }).finally(function () {
                    enableInputs(inputs)
                })
        })


        function disableInputs(inputs) {
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].disabled = true
            }
        }
        
        function enableInputs(inputs) {
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false
            }
        }
        