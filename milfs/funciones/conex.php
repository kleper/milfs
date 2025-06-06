<?php
function Conectarse()
{
    static $link;

    if (!isset($link)) {
        include 'includes/datos.php';
        if (!isset($db)) {
            include 'milfs/includes/datos.php';
        }

        $link = new mysqli($servidor, $usuario, $password, $db);
        if ($link->connect_error) {
            die('Error conectando a la base de datos: ' . $link->connect_error);
        }

        $link->set_charset('utf8');

        $_SESSION['path'] = $path_instalacion;
        $_SESSION['path_images_secure'] = $path_images_secure;
        $_SESSION['url'] = $url;
        $_SESSION['upload_size'] = $upload_size;
    }

    return $link;
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link = null)
    {
        if ($link === null) {
            $link = Conectarse();
        }
        return $link->query($query);
    }

    function mysql_fetch_array($result)
    {
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    function mysql_num_rows($result)
    {
        return $result->num_rows;
    }

    function mysql_data_seek($result, $offset)
    {
        return $result->data_seek($offset);
    }

    function mysql_insert_id($link = null)
    {
        if ($link === null) {
            $link = Conectarse();
        }
        return $link->insert_id;
    }

    function mysql_real_escape_string($string, $link = null)
    {
        if ($link === null) {
            $link = Conectarse();
        }
        return $link->real_escape_string($string);
    }

    function mysql_affected_rows($link = null)
    {
        if ($link === null) {
            $link = Conectarse();
        }
        return $link->affected_rows;
    }

    function mysql_result($result, $row, $field = 0)
    {
        if ($result->data_seek($row)) {
            $data = $result->fetch_array(MYSQLI_BOTH);
            return $data[$field] ?? null;
        }
        return null;
    }
}

?>