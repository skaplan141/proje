
const checkInDate = document.getElementById('check-in-date');
const checkOutDate = document.getElementById('check-out-date');

checkInDate.addEventListener('change', () => {
    const checkInValue = new Date(checkInDate.value);
    checkInValue.setDate(checkInValue.getDate() + 1); 
    checkOutDate.min = checkInValue.toISOString().split('T')[0]; z
});


const reservationForm = document.getElementById('reservationForm');
reservationForm.addEventListener('submit', function (event) {
    event.preventDefault();
    alert('Rezervasyonunuz başarıyla alındı!');
});
