<?php
include_once 'header.php'; 
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2> Welcome </h2>
            <?php
                if(isset($_SESSION['u_id']))
                {
                    echo "You are logged in!";
                    echo "<h1>Personal Details</h1>";
                    echo "<br> First name: ";
                    echo $_SESSION['u_first'];
                    echo "<br> Last name: ";
                    echo $_SESSION['u_last'];
                    echo "<br> Email: ";
                    echo $_SESSION['u_email'];
                }
            ?>
        </div>
    </section>

<?php
include_once 'footer.php'; 
?>


