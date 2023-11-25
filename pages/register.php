<!DOCTYPE html>
<head>
    <title>Registrierung</title>
</head>

<body>
    <section class="bg-grad-rb">
        <div class="container d-flex justify-content-center pt-5">
            
            <div class="card p-3 text-center border-white">
                <h1 class="fw-bold mt-2 mb-3">Registrierung</h1>

                <form method="post">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                                <input type="text" class="text-center form-control mb-3" style="width: 15rem;"placeholder="Benutzername" id="username" required>
                                <input type="email" class="text-center form-control mb-3" style="width: 15rem;"placeholder="Email" id="mail" required>                            
                                <select class="text-center form-control mb-3" style="width: 5rem;" placeholder="Anrede" id="anrede">
                                    <option id="male">Herr</option>
                                    <option id="female">Frau</option>
                                    <option id="divers">ohne Anrede</option>
                                </select>
                                <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Vorname" id="Vorname" required>
                                <input type="text" class="text-center form-control mb-3"style="width: 15rem;" placeholder="Nachname" id="Nachname" required>
                                <input type="telephone" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Telefonnummer" id="telephone" required>
                                <input type="password" class="text-center form-control mb-3" style="width: 15rem;"  placeholder="Passwort" id="password1" required>
                                <input type="password" class="text-center form-control mb-3" style="width: 15rem;"  placeholder="Passwort wiederholen" id="password2" required>
                                <button type="submit" class="btn btn-blue" style="width: 15rem;">Registrieren</button>
                                <p class="mt-3">Haben sie schon einen Account? <a href="index.php?include=login">Login hier</a></p>
                        </div>
                </form>
            </div>
        </div>
    </section>
    </body>
</html>
