<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    //Crea un php con un array inicial con 3 valores numéricos.

    //a) Crea un formulario que permita modificar el valor en una posición en concreto.
    session_start();

    //inicializar array si no existe en la sesión
    if (!isset($_SESSION['array'])) {
        $_SESSION['array'] = [10, 20, 30];
    }

    if (isset($_POST['modify'])) {
        //recoge la posición
        $position = $_POST['position'];

        //recoge el valor input
        $nValue = (int)$_POST['value'];

        //actualiza el array
        $_SESSION['array'][$position] = $nValue;
    }

    //c) Añade un botón para calcular el valor medio.

    if (isset($_POST['average'])) {
        $average = array_sum($_SESSION['array']) / count($_SESSION['array']);

        echo "Current array: " . implode(", ", $_SESSION['array']) . "<br>";
        echo "Average: " . $average;
    }


    //d) Botón reset limpia el formulario
    if (isset($_POST['reset'])) {

        // remove all session variables (log out)
        session_unset();
        $_SESSION['array'] = [10, 20, 30];
    }

    //b) Consigue que se mantenga las modificaciones en el array.
    //muestra el nuevo valor en la posicion
    echo "Current array: " . implode(", ", $_SESSION['array']);

    ?>

    <h2>Modify array saved in session</h2>
    <form method="post">
        <label>Position to modify</label>
        <select name="position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <br><br>

        New value: <input type="text" name="value">
        <br><br>
        <input type="submit" value="Modify" name="modify">
        <input type="submit" value="Average" name="average">
        <input type="submit" value="Reset" name="reset">


    </form>
</body>

</html>