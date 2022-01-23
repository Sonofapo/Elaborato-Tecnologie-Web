<!DOCTYPE html>
<html lang="it">
<head>
    <!-- variabili varie per capire dove ci troviamo aka login ecc. -->
    <title>UniBonsai - Registrazione</title>
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./style/style.css" type="text/css" />
</head>
<body>
    <header>
        <img src="./img/logo.png"/>
        <h1>UniBonsai</h1>
    </header>
    <main>
        <form action="index.php" method="POST">
            <h2>Registrati</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" />

            <input type="submit" name="submit" value="Registrati" />
            se sei gi4 registrato effettua il <a href="login.php">Login</a>
        </form>
    </main>
    <footer>
        <a href="index.php">Torna alla Home</a>
    </footer>
</body>
</html>