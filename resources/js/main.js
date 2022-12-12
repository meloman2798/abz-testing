function hideModal() {
    window.addEventListener('hideModal', event => {
        console.log(event.detail.modalId);
        $('#' + event.detail.modalId).modal('hide');
    });
}

function showModal() {
    window.addEventListener('showModal', event => {
        $('#' + event.detail.modalId).modal('show');
        if(event.detail.modalId === 'formIndex'){
            copyLink()
        }
    });
}


$(document).ready(function () {
    hideModal();
    showModal();
});
