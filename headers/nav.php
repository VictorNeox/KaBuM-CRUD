<?php
    echo '<nav>
        <div class="nav-wrapper">';
    if(isset($_COOKIE['token']))
    {
        echo '<a class="waves-effect waves-light btn-small orange" id="logout-btn">Logout</a>';
    }
    echo '<img src="../assets/imgs/kabumLogo.png" class="brand-logo right logo-kabum" alt="Logo do KaBuM!" >
        </div>
    </nav>';