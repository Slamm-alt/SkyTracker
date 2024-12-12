let selectedDestination = '';
let selectedDate = '';

function showPopup(destination, date) {
    selectedDestination = destination;
    selectedDate = date;
    document.getElementById('popup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function showConfirmationPopup() {
    document.getElementById('confirmation-popup').style.display = 'flex';
}

function closeConfirmationPopup() {
    document.getElementById('confirmation-popup').style.display = 'none';
}

function showFinalPopup() {
    document.getElementById('final-popup').style.display = 'flex';
}

function closeFinalPopup() {
    document.getElementById('final-popup').style.display = 'none';
}

document.getElementById('ticket-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const tickets = document.getElementById('tickets').value;

    document.getElementById('confirm-name').textContent = name;
    document.getElementById('confirm-phone').textContent = phone;
    document.getElementById('confirm-tickets').textContent = tickets;
    document.getElementById('confirm-destination').textContent = `${selectedDestination} on ${selectedDate}`;

    closePopup();
    showConfirmationPopup();
});

function finalizePurchase() {
    document.getElementById('final-destination').textContent = `${selectedDestination} on ${selectedDate}`;
    

    closeConfirmationPopup();
    showFinalPopup();
}
