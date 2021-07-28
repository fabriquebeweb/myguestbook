const form = document.querySelector('#mgb_rating_form')
const inputs = form.querySelectorAll('.mgb_rating_field')
const submit = form.querySelector('#mgb_rating_form_submit')

class HTTP
{

    static #host = `${window.location.protocol}//${window.location.host}`

    static post(url, value, callback = false)
    {

        try {

            HTTP.#request('POST', url, value, callback)

        } catch (error) {

            if (callback) callback(error)

        }

    }

    static #request(method, url, value = false, callback = false)
    {

        const request = new XMLHttpRequest()
        request.open(method, url)
        request.setRequestHeader('Access-Control-Allow-Origin', '*')
        request.setRequestHeader('Content-Type', 'multipart/form-data')
        request.setRequestHeader('charset', 'utf8')
        request.addEventListener('load', () => { if (callback) callback(request) })
        request.addEventListener('error', () => { alert('ERREUR d\'envoi de la requête') })
        request.send((value) ? value : null)

    }

}

submit.addEventListener('click', event => {
    event.preventDefault()

    let formData = new FormData()
    inputs.forEach(input => formData.append(input.name, input.value))

    HTTP.post('/', formData, e => console.log(e))
})