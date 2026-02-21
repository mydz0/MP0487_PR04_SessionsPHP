<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    //a) Se debe mantener el nombre del trabajador que está utilizando la aplicación. 
    session_start();
    // Guardar nombre y producto en sesión (siempre que se envíe el formulario)

    // Inicializar contadores
    if (!isset($_SESSION['Milk'])) {
        $_SESSION['Milk'] = 0;
    }

    if (!isset($_SESSION['Soft drink'])) {
        $_SESSION['Soft drink'] = 0;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['name'])) {
            $_SESSION['name'] = ($_POST['name']);
            $name = $_SESSION['name']; //reads the session

        }

        if (isset($_POST['product'])) {
            $_SESSION['product'] = $_POST['product'];
            $product = $_SESSION['product'];
        }

        if (isset($_POST['quantity'])) {
            $quantity = (int)$_POST['quantity'];
        }


        // b) Todos los trabajadores usan el mismo inventario de la tienda.
        // c) Se debe poder añadir y quitar leche o refresco seleccionando de una lista

        //añadir
        if (isset($_POST['add']) && isset($_SESSION['product'])) {
            $product = $_SESSION['product'];

            if ($product === 'Milk') {
                $_SESSION['Milk']  += $quantity;
            } else {
                $_SESSION['Soft drink'] += $quantity;
            }
        }

        //remove
        if (isset($_POST['remove']) && isset($_SESSION['product'])) {
            $product = $_SESSION['product'];
            if ($product === 'Milk') {
                // Controlar que no se quiten más unidades de las que haya
                if ($quantity > $_SESSION['Milk']) {
                    echo "<p style='color:red'>No more milk.</p>";
                } else {
                    $_SESSION['Milk'] -= $quantity;
                }
            } else {
                // Controlar que no se quiten más unidades de las que haya
                if ($quantity > $_SESSION['Soft drink']) {
                    echo "<p style='color:red'>No more soft drinks.</p>";
                } else {
                    $_SESSION['Soft drink'] -= $quantity;
                }
            }
        }


        if (isset($_POST['reset'])) {
            session_unset();
            $_SESSION['Milk'] = 0;
            $_SESSION['Soft drink'] = 0;
        }
    }

    ?>

    <!-- Crea un formulario que permita gestionar la cantidad de refresco o leche que hay en un supermercado. -->

    <h2>Supermarket management</h2>
    <form method="post">
        Worker name: <input type="text" name="name">
        <br><br>

        <h3>Choose product</h3>
        <select name="product">
            <option value="Milk">milk</option>
            <option value="Soft drink">soft drink</option>
        </select>
        <br><br>

        <h3>Product quantity</h3>
        <input type="text" name="quantity">
        <br><br>

        <input type="submit" value="Add" name="add">
        <input type="submit" value="Remove" name="remove">
        <input type="submit" value="Reset" name="reset">
        <br><br>

        <h3>Inventory:</h3>
        <p>Worker: <?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?></p>
        <p>Units of milk: <?php echo isset($_SESSION['Milk']) ? $_SESSION['Milk'] : 0; ?></p>
        <p>Units of soft drink: <?php echo isset($_SESSION['Soft drink']) ? $_SESSION['Soft drink'] : 0; ?></p>

    </form>
</body>

</html>