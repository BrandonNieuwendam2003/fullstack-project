
        alert("Hello user");
        
        
        document.addEventListener('DOMContentLoaded', function () {
            // Get the date input element
            var datePicker = document.getElementById('datePicker');

            // Add an 'input' event listener to the date input
            datePicker.addEventListener('input', function () {
                // Check if the selected date is not a Friday (day index 5 in JavaScript Date object)
                var selectedDate = new Date(datePicker.value);
                if (selectedDate.getDay() !== 5) {
                    alert('Please select a Friday.');
                    datePicker.value = '';  // Clear the input value
                }
            });
        });
    