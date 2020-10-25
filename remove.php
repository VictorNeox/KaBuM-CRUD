<? php
    include('./database/connection.php');
    if(isset($_POST['id'])) {
        $clientId = $_POST['id'];
        $sql = 'SELECT isActive FROM clients WHERE id = ' . $clientId;
        $result = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($result['isActive']) {
            $sql = 'UPDATE clients SET isActive = 0 WHERE id = ' . $clientId;
        } else {
            $sql = 'UPDATE clients SET isActive = 1 WHERE id = ' . $clientId;
        }

        mysqli_query($conn, $sql);
    }
?>