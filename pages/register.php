<!DOCTYPE html>
<head>
    <title>Registrierung</title>
</head>
<div class="back_area back_img1 d-flex align-items-center justify-content-center">
        <h1 class="text-white bold">Registrierung</h1>
</div>
<body>
    <div class="container p-3">
        <h2>Registrieren sie sich!</h2>
        <form method="post">
            <div class="row g-3">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Benutzername" id="username" required>
                </div>
                <div class="col-6">
                </div>
                <div class="col-6">
                    <select class="form-control" placeholder="Anrede" id="anrede">
                        <option id="male">Herr</option>
                        <option id="female">Frau</option>
                        <option id="divers">ohne Anrede</option>
                </div>
                <div class="col-6">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Vorname" id="Vorname" required>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Nachname" id="Nachname" required>
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" placeholder="Passwort" id="password1" required>
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" placeholder="Passwort wiederholen" id="password2" required>
                </div>
                <div class="col-6">
                    <input type="email" class="form-control" placeholder="Email" id="mail" required>
                </div>
                <div class="col-6">
                </div>
                <div class="col-6">
                    <input type="telephone" class="form-control" placeholder="Telefonnummer" id="telephone" required>
                </div>
            </div>
            <button type="submit" class="btn btn-blue mt-3">Registrieren</button>
        </form>
    </body>
</html>
