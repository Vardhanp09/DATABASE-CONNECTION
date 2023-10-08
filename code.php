
<?php
session_start();
include('dbcon.php');

if(isset($_POST['delete_student']))
{
    $student_id = $_POST['delete_student'];

    try
    {
        $query = "DELETE from students WHERE id=? LIMIT 1";
        $statement = $conn->prepare($query);
        $statement->bindParam(1,$student_id, PDO::PARAM_INT);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header('Location: index.php');
            exit(0);
        }
    }

    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

if(isset($_POST['update_student']))
{
    $student_id = $_POST['student_id']; 
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    try
    {
        $query= "UPDATE students set fullname=:fullname , email=:emailid , phone=:phone , course=:course WHERE id=:stud_id LIMIT 1"; 
        $statement = $conn->prepare($query);
        $statement->bindParam(':fullname',$fullname);
        $statement->bindParam(':emailid',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':course',$course);
        $statement->bindParam(':stud_id',$student_id);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
            header('Location: index.php');
            exit(0);
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

if(isset($_POST['save_student']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    try {

        $query = "INSERT INTO students (fullname, email, phone, course) VALUES (?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bindParam(1, $fullname);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $phone);
        $statement->bindParam(4, $course);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Added Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Added";
            header('Location: index.php');
            exit(0);
        }

    } catch (PDOException $e) {

        echo "My Error Type:". $e->getMessage();
    }
}

?>
