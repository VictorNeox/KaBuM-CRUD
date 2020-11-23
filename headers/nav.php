<?php
    echo '<nav>
            <div class="nav-wrapper">';
            echo '<img src="../assets/imgs/kabumLogo.png" class="brand-logo left logo-kabum" alt="Logo do KaBuM!" >';
            if(isset($_COOKIE['token']))
            {
                echo '<div id="logout-btn">
                        <p class="right">';
                            echo $userData['name'] . '<i class="fas fa-sign-out-alt right logout-icon"></i></p>
                    </div>';
            }
            echo '</div>
        </nav>';