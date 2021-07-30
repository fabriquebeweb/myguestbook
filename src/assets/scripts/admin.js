const ratings = document.querySelectorAll('.mgb_admin_rating')

ratings.forEach(rating => {
    const del = rating.querySelector('.mgb_admin_rating_delete')
    const toggle = rating.querySelector('.mgb_admin_rating_toggle')

    del.addEventListener('click', event => {
        event.preventDefault()

        const url = [
            '/wp-admin/admin-ajax.php?action=mgb_admin_rating_delete',
            `mgb_rating_id=${rating.id}`
        ]

        if (confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')) HTTP.post(url.join('&'), () => HTTP.refresh())
    })

    toggle.addEventListener('click', event => {
        event.preventDefault()

        const url = [
            '/wp-admin/admin-ajax.php?action=mgb_admin_rating_toggle',
            `mgb_rating_id=${rating.id}`,
            `mgb_rating_state=${toggle.name}`
        ]
        
        HTTP.post(url.join('&'), () => HTTP.refresh())
    })
})