<?php
if (isset($_COOKIE['userFname'])) {
?>
<div class="row d-flex justify-content-end align-items-center">
    <div class="top-right pr-4">
        <a href="./profiles">Profile</a>
    </div>
</div>
<!-- <div class="row d-flex align-items-center">
    <h5>Welcome Back <?php echo "$_COOKIE[userFname] $_COOKIE[userLname]"; ?></h5>
</div> -->

<?php
} else {
    echo '
<div class="d-flex justify-content-center align-items-center">
<h3>Hello Insta</h3>
</div>
';
}