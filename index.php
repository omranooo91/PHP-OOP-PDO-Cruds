<?php
require_once 'db.php';
require_once 'user.php';

$message = 'Welcom to PDO Course';

//Insert Information To Database
if (isset($_POST['submit'])) {

    $name    = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $age     = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $tax     = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    $salary  = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

    $user = new User();
    $user->name = $name;
    $user->age = $age;
    $user->address = $address;
    $user->tax = $tax;
    $user->salary = $salary;

    $sqlInsert = 'INSERT INTO users SET name = " ' .  $name . ' ",
                                        age =  ' .  $age . ' ,
                                        address =  "' .  $address . '" ,
                                        tax =  ' .  $tax . ' ,
                                        salary =  ' .  $salary . ' 
 ';


    if ($connection->exec($sqlInsert)) {
        $message = 'Great.. ' . $name . ' Is successfully Inserted';
    }
}


//Reading Information from database
$sqlRead = 'SELECT * FROM users';
$statment = $connection->query($sqlRead);
$result = $statment->fetchAll(PDO::FETCH_CLASS,'User');
$result = (is_array($result) && !empty($result)) ? $result : false;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
    <link rel="stylesheet" href="style.css">
</head>


    <body>

        <h3 class="message"><?= $message; ?></h3>

        <div>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="text" name="name" placeholder="Your name..">
                <input type="number" name="age" placeholder="Your age..">
                <input type="text" name="address" placeholder="Your address..">
                <input type="number" step="0.01" min="1" max="10" name="tax" placeholder="Your tax..">
                <input type="number" min="4000" max="10000" name="salary" placeholder="salary">


                <input type="submit" name="submit" value="Insert">
            </form>

            <table style="width:100%">
                <tr>
                    <th>name</th>
                    <th>age</th>
                    <th>address</th>
                    <th>tax</th>
                    <th>salary</th>
                </tr>
                <?php
                    if(false !== $result){
                        foreach ($result as $user){ ?>
                                <tr>
                                     <td><?= $user->name ?></td>
                                     <td><?= $user->age ?></td>
                                     <td><?= $user->address ?></td>
                                     <td><?= $user->tax ?></td>
                                     <td><?= $user->salaryCalc() ?></td>
                                </tr>
                     <?php   }
                    }else{ ?>
                        <td colspan="5"> <p>Your Table is Empty now</p> </td>
                  <?php  }
                ?>
            </table>

        </div>

    </body>
</html>


