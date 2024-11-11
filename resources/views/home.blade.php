<!-- resources/views/hacked_message.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacked</title>
    <style>
        body {
            background-color: black;
            color: #00ff00;
            font-family: monospace;
            text-align: center;
            padding: 30px;
        }

        .message {
            font-size: 24px;
            white-space: pre-wrap;
            line-height: 1.5;
        }

        .error {
            color: red;
        }

        .highlight {
            color: yellow;
        }
    </style>
</head>

<body>
    <div class="message">
        <p><span class="highlight">[ERROR]</span> Access denied: <span class="highlight">admin.betamovies.net</span></p>
        <p><strong>Fix:</strong> Enter the backdoor password to reset the system.</p>
        <input type="text" placeholder="Enter backdoor password" id="backdoorPassword">
        <button onclick="checkPassword()">Enter</button>
        
    </div>

    

    <script>
        function checkPassword() {
            var pass = document.getElementById('backdoorPassword').value;
            if (pass === "12345") {
                alert("Backdoor access granted. System reset in progress...");
                alert("You should've just stayed on your lane");
            } else {
                alert("Access denied. Incorrect password.");
            }
        }
    </script>

</body>

</html>
