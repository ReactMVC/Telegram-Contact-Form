<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Telegram Form</title>
</head>

<body>

    <div class="container">
        <h1 class="text-4xl mt-3 font-bold mb-6">Telegram Form</h1>
        <form class="mb-5 text-black" id="telegram-form">
            <div class="form-group">
                <label for="name" class="form-label text-white">Name</label>
                <input dir="auto" type="text" id="name" class="form-input" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="username" class="form-label text-white">Telegram Username</label>
                <input type="text" id="username" class="form-input" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="message" class="form-label text-white">Message</label>
                <textarea dir="auto" id="message" class="form-input" placeholder="Enter your message"></textarea>
            </div>
            <div id="loading" class="hidden mt-5 mb-4 text-white">Please wait...</div>
            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('telegram-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var name = document.getElementById('name').value;
            var username = document.getElementById('username').value;
            var message = document.getElementById('message').value;
            var ip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
            var userAgent = navigator.userAgent;

            if (!name || !username || !message) {
                alert('Please enter all the required fields!');
                return;
            }

            var formData = new FormData();
            formData.append('name', name);
            formData.append('username', username);
            formData.append('message', message);
            formData.append('ip', ip);
            formData.append('user_agent', userAgent);

            document.getElementById('loading').classList.remove('hidden');

            fetch('api.php', {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    document.getElementById('loading').classList.add('hidden');
                    if (response.ok) {
                        alert('Message sent successfully! 🎉');
                    } else {
                        alert('An error occurred. Please try again later. 😔');
                    }
                })
                .catch(function(error) {
                    document.getElementById('loading').classList.add('hidden');
                    alert('An error occurred. Please try again later. 😔');
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>