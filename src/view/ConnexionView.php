<?php

$this->t = 'Connexion'; ?>
<div class="containerConnexion">
    <div class="connexionHead">Connexion</div>
    <div class="containerPseudo">
        <label>
            <input type="text" name="pseudo" required minlength="4" maxlength="8" />
            Pseudo
        </label>
    </div>
    <div class="containerPassword">
        <label>
            <input type="password" name="password" required minlength="4" maxlength="8" />
            Password
        </label>
    </div>
</div>