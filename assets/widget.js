const form = document.querySelector('#mgb_rating_form')
const inputs = form.querySelectorAll('.mgb_rating_field')
const submit = form.querySelector('#mgb_rating_form_submit')

submit.addEventListener('click', event => {
    event.preventDefault()

    let url = ['/wp-admin/admin-ajax.php?action=mgb_new_rating']
    inputs.forEach(input => url.push(`${input.name}=${input.value}`))

    HTTP.post(url.join('&'), () => alert('Merci pour votre avis ! <3'))
})