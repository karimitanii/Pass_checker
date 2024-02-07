<?php require("password.class.php")?>
<?php require("reader.class.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F_society_password_checker</title>
    <style>
        body {
            background-color: black;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 20px;
        }

        section {
            text-align: center;
            padding: 50px;
        }

        .password-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .password-input {
            padding: 10px;
            font-family: 'Courier New', monospace;
            background-color: #00ff00;
            color: black;
            border: none;
            border-radius: 5px;
            width: 60%;
            box-sizing: border-box;
        }

        .result-container {
            margin-top: 20px;
        }

        .pixelated-text {
            display: inline-block;
            transform: scale(1.5);
            transform-origin: 0 0;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="pixelated-text">F-society_password_checker</h1>
    </header>

    <section>
        <p>Welcome to F-society_password_checker website. We check the strength of your passwords using AI.</p>


        <img src="fsociety_image.png" alt="fsociety image" style="max-width: 100%; height: auto; margin-top: 20px;">

        <div style="border-color: green;" class="password-container">
            <form action="" method="post">
                <label style="padding-bottom: 15px;" for="password" name="password" class="pixelated-text">Enter your password:</label>
                <br>
                <input style="width: 200%;" type="password" id="password" name="password" class="password-input" placeholder="Type your password here" required>
                <br>
                <button type="submit" name="submit" style="background-color: green; color: black;">Check Password</button>
            </form>
        </div>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $password = $_POST["password"];

                $python_output = shell_exec("C:/Users/K/AppData/Local/Programs/Python/Python310/python.exe pass_checker_ai.py " . escapeshellarg($password));

                    $output_words = explode(' ', trim($python_output));
                    $last_word = end($output_words);

                    echo "<div class='result-container' style='margin-left: 28px;'><span class='pixelated-text'>Password check result:</span><div style='padding-left: 25px;'> <p>$last_word</p> </div> </div>";
                }
        ?>
    </section>

    <footer>
        <p class="pixelated-text">&copy; 2023 F-society_password_checker by Karim Itani. All rights reserved.</p>
    </footer>

</body>
</html>
