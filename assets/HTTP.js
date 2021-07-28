class HTTP
{

    static #host = `${window.location.protocol}//${window.location.host}`

    static post(url, callback)
    {

        try {

            HTTP.#request('POST', url, callback)

        } catch (error) {

            callback(error)

        }

    }

    static #request(method, url, callback)
    {

        const request = new XMLHttpRequest()
        request.open(method, url)
        request.setRequestHeader('Access-Control-Allow-Origin', '*')
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.setRequestHeader('charset', 'utf8')
        request.addEventListener('load', () => { callback(request.responseText) })
        request.addEventListener('error', () => { alert('ERREUR d\'envoi de la requête') })
        request.send()

    }

    static refresh(num = 0)
    {

        setTimeout(() => { window.location.reload() }, num)

    }

}