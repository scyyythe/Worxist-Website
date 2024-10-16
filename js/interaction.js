document.querySelectorAll('.social-interact-icons i').forEach(icon => {
    icon.addEventListener('click', function() {
        const action = this.getAttribute('data-action');
        const artworkId = this.getAttribute('data-artwork-id');

        const userId = '<?php echo $_SESSION["u_id"]; ?>'; // Get the logged-in user's ID from PHP session

        // Send interaction data to server
        fetch('include/interaction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                u_id: userId,    // Include user ID
                a_id: artworkId, // Include artwork ID
                action: action   // Include action (like, save, favorite)
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the response for debugging
            if (data.success) {
                console.log(`${action} interaction saved successfully`);
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Request failed', error));
    });
});
