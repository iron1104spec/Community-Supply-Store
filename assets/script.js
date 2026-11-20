
document.querySelectorAll('.order-modal form').forEach(function(form) {

    form.addEventListener('submit', async function(event) {

        event.preventDefault();

        const submitButton = form.querySelector('.place-order-btn');

        submitButton.disabled = true;
        submitButton.textContent = 'Processing...';

        try {

            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            });

            const responseText = await response.text();

            console.log("PHP Response:", responseText);

            const result = JSON.parse(responseText);

            if (result.success) {

                // Close the order form
                form.reset();
                form.closest('dialog').close();

                // Show success confirmation
                const successModal = document.getElementById('successModal');

                if (successModal) {
                    successModal.showModal();
                } else {
                    alert('Order placed successfully!');
                }

            } else {

                alert(result.message);

            }

        } catch (error) {

            console.error("Order Error:", error);
            alert("Something went wrong. Please try again.");

        } finally {

            submitButton.disabled = false;
            submitButton.textContent = 'Place Order';

        }

    });

});
