<?php
    if(isset($_GET['filter']))
    {
        $filter = mysqli_real_escape_string($conn, utf8_encode($_GET['filter']));
        $search = mysqli_real_escape_string($conn, utf8_encode($_GET['search']));

        $sql = "SELECT * FROM clients WHERE $filter LIKE '%$search%'";

        if($access == 1)
        {

            $sql = "SELECT * FROM clients WHERE $filter LIKE '%$search%' AND user_id = '$userId'";
        }
    }