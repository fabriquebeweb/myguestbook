const ratings = document.querySelectorAll('.mgb_admin_rating')

ratings.forEach(rating => {
    const del = rating.querySelector('.mgb_admin_rating_delete')
    const toggle = rating.querySelector('.mgb_admin_rating_toggle')

    del.addEventListener('click', event => {
        event.preventDefault()
        if (confirm('Êtes-vous sûr de vouloir supprimer cet avis utilisateur ?')) HTTP.post(`/wp-admin/admin-ajax.php?action=mgb_admin_rating_delete&mgb_rating_id=${rating.id}`, () => HTTP.refresh())
    })

    toggle.addEventListener('click', event => {
        event.preventDefault()
        HTTP.post(`/wp-admin/admin-ajax.php?action=mgb_admin_rating_toggle&mgb_rating_id=${rating.id}&mgb_rating_state=${toggle.name}`, () => HTTP.refresh())
    })
})