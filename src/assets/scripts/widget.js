const form = document.querySelector('#mgb_rating_form')
const inputs = form.querySelectorAll('.mgb_rating_field')
const required = form.querySelector('#mgb_rating_field_required')
const submit = form.querySelector('#mgb_rating_form_submit')

submit.addEventListener('click', event => {
    event.preventDefault()

    if (required.value) {

        const url = ['/wp-admin/admin-ajax.php?action=mgb_new_rating']

        inputs.forEach(input => {

            url.push(`${input.name}=${input.value}`)
            if (!input.classList.contains('mgb_widget_hidden')) input.value = null
            
        })

        HTTP.post(url.join('&'), () => alert(`Merci de nous avoir laissé votre avis !`))

    } else {

        alert('ERREUR : Vous ne pouvez pas envoyer un message vide !')

    }
})