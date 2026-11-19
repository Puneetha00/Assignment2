
$(document).ready(function() {

    $("#registrationForm").submit(function(event) {

        let name = $("#name").val().trim();
        let email = $("#email").val().trim();
        let phone = $("#phone").val().trim();
        let dob = $("#dob").val();

        // Validate name
        if (name.length < 3) {
            alert("Name must contain at least 3 characters");
            event.preventDefault();
            return;
        }

        // Validate email
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            alert("Please enter a valid email");
            event.preventDefault();
            return;
        }

        // Validate phone number
        let phonePattern = /^[0-9]{10}$/;

        if (!phonePattern.test(phone)) {
            alert("Phone number must contain 10 digits");
            event.preventDefault();
            return;
        }

        // Validate date of birth
        if (dob === "" || new Date(dob) > new Date()) {
            alert("Please enter a valid date of birth");
            event.preventDefault();
            return;
        }

        alert("Form validated successfully!");

    });

});
