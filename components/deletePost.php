<!-- <h2>Modal Login Form</h2> -->

<!-- <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button> -->

<div id="id01" class="modal">

    <form class="modal-content animate" action="../agents/deleteOnePostHandle.php?img=<?php echo $_GET['img']; ?>"
        method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                title="Close Modal">&times;</span>
            <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar"> -->
        </div>

        <div style="padding: 16px;">
            <!-- <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required> -->
            <h6 class="mb-4 mt-4 text-danger">Are you sure you want to delete this post ?</h6>

            <button class="btn btn-danger form-control" type="submit">Accept</button>
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
        </div>

        <div style="background-color:#f1f1f1;padding: 16px;">
            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                class="btn btn-success form-control">Cancel</button>
            <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
        </div>
    </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>