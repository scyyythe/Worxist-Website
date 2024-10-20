function interact(icon) {
    const action = icon.getAttribute('data-action');
    const artworkId = icon.getAttribute('data-artwork-id');
    const userId = icon.getAttribute('data-user-id');

    // Prepare the data to send
    const data = { action, artwork_id: artworkId, user_id: userId };

    // Send a POST request to the PHP script
    fetch('interaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`${action} successful!`);
            // Optionally update the UI to reflect the interaction (e.g., change icon color)
        } else {
            console.log(`Failed to ${action}: ${data.message}`);
        }
    })
    .catch(error => console.error('Error:', error));
}
