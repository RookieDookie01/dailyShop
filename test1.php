<?php
    include("includes/connect.php");

    // if(isset($_POST['add_user']))
    // {
    //     $test_name = $_POST['test_name'];
    //     $test_ic = $_POST['test_ic'];

    //     $insert_query = "INSERT INTO tests (test_name, test_ic)
    //     VALUES ('$test_name','$test_ic')";
    //     $run_insert_query = mysqli_query($con, $insert_query);
    // }
    if(isset($_POST['add_user']))
    {
        $credit_num = $_POST['credit_num'];
        $credit_cvc = $_POST['credit_cvc'];

        $insert_query = "INSERT INTO credits (credit_num, credit_cvc)
        VALUES ('$credit_num','$credit_cvc')";
        $run_insert_query = mysqli_query($con, $insert_query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Check</title>
</head>
<body>
    <form action="test1.php" method="POST">
        <input type="text" name="credit_num" placeholder="credit_num">
        <input type="text" name="credit_cvc" placeholder="credit_cvc">
        <input type="submit" name="add_user">
    </form>
    <table>
        <tr>
            <th>Name</th>
            <th>IC</th>
        </tr>
        <?php
            $query = "SELECT * FROM tests";
            $run_query = mysqli_query($con, $query);

            if(is_array($run_query) || is_object($run_query))
            {
                foreach($run_query as $item)
                {?>
                    <tr>
                        <td><?= $item['test_name']; ?></td>
                        <td><?= $item['test_ic']; ?></td>
                    </tr>
        <?php   }
            }?>
    </table>
</body>
</html>