<?php
    if(isset($_GET['filter']))
    {
        $filter = utf8_encode($_GET['filter']);
        $search = utf8_encode($_GET['search']);

        $sql = "SELECT * FROM clients WHERE $filter LIKE '%$search%'";
    }