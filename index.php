<?php

session_start();
include('dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP PDO using bindParam() function CRUD</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 text-center">
                <h1>PHP PDO using bindParam() function CRUD</h1>
            </div>

            <?php

            if(isset($_SESSION['message']))
            {
                echo "<h4 class='alert alert-success'>".$_SESSION['message']."</h4>";
                unset($_SESSION['message']);
            }

            ?>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>PHP PDO using bindParam() CRUD
                            <a href="student-add.php" class="btn btn-primary float-end">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                                $query = "SELECT * from students";
                                $statement = $conn->prepare($query);
                                $statement->execute();

                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                if($result)
                                {
                                    foreach($result as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['id']?></td>
                                            <td><?= $row['fullname']?></td>
                                            <td><?= $row['email']?></td>
                                            <td><?= $row['phone']?></td>
                                            <td><?= $row['course']?></td>
                                            <td>
                                                <a href="student-edit.php?id=<?=$row['id']?>" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <button type="submit" name="delete_student" value="<?=$row['id']?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }

                                else
                                {
                                    ?>
                                    <tr>
                                        <td colspan="5">No record Found</td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            <tr>
                                <td></td>
                            </tr>   
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


