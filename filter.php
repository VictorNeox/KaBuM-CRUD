<?php
    if(isset($_GET['filter']))
    {
        $filter = mysqli_real_escape_string(utf8_encode($_GET['filter']));
        $search = mysqli_real_escape_string(utf8_encode($_GET['search']));

        $sql = "SELECT * FROM clients WHERE $filter LIKE '%$search%'";
    }