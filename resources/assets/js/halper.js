export function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

export function showModal(elementId) {
    var myModal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById(elementId)
    );
    myModal.show(); 
}

export function hideModal(elementId) {
    var myModal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById(elementId)
    );
    myModal.hide(); 
}