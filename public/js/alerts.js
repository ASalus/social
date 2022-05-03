window.addEventListener('swal:modal', event => {
    new Swal({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,
    })
})

window.addEventListener('swal:confirm', event => {
    new Swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        })
        .then((result) => {
            if (result.isConfirmed) {
                // console.log(`deletePost${event.detail.id}`);
                window.Livewire.emit(`deletePost`, event.detail.id)
            }
        })
})