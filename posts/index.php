<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sources/style/fontAwesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../sources/style/bootstrap.min.css">
    <style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        right: 0;
        top: 0;
        margin-left: auto;
        margin-right: auto;
        width: 75%;
        /* width: 100%; */
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }
    </style>
    <script src="../sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="../ajax/forms.js" defer></script>
    <script src="../ajax/fetch.js" defer></script>

    <title>Insta Clone</title>
</head>

<body>
    <div class="d-flex flex-column">

        <main class="w-100 d-flex justify-content-center 
            align-items-center p-5" style="flex-grow: 1; overflow-y:auto; height:100vh;">
            <?php
            if (!isset($_COOKIE['userFname'])) {
                require_once('../components/404.php');
            } else {
            ?>

            <?php
                if (isset($_GET['img'])) {
                    require_once('../agents/selectFromProfiles.php');
                    require_once('../agents/selectOnePost.php');
                ?>

            <div class="container">
                <div style="box-shadow: 0 0 5px 3px gray; max-width:850px;margin:auto; border-radius:7px;">
                    <?php
                            /* to make only post ownner can make changes or delete and avoid no post */
                            if (isset($checkOnePost[0]['post_user_id']) && $checkOnePost[0]['post_user_id'] == $_COOKIE['userId']) {
                            ?>
                    <div class="mr-3 ml-3 pt-2 d-flex justify-content-between align-items-center">
                        <!-- <i class="fa-solid fa-pen-to-square"></i> -->
                        <div style="color: #7c5902; text-shadow:1px 1px 2px black;"><i>Tableau</i></div>
                        <div>
                            <a href="edit.php?img=<?php echo $checkOnePost[0]['id']; ?>"><span role="button"
                                    title="Edit" style="color:blue; cursor:pointer; margin-right:10px;"
                                    class="fa-solid fa-pen-to-square"></span></a>
                            <span style="margin-right: 10px;">|</span>
                            <span role="button" onclick="document.getElementById('id01').style.display='block'"
                                title="Delete" style="color:red; cursor:pointer; margin-bottom:-4px;"
                                class="fa fa-trash-alt"></span>
                        </div>
                        <!-- <span class="fa-solid fa-trash-alt"></span> -->
                    </div>
                    <?php
                            }
                            /* with no post no profile given here */
                            if (isset($checkProfile)) {
                            ?>
                    <div class="p-1 d-flex align-items-center justify-content-between flex-wrap"
                        style="max-width:850px;margin:0;">

                        <div class="pl-1">
                            <a href="../profiles/<?php if ($_COOKIE['userName'] != $checkProfile[0]['Uname']) {
                                                                    echo "?uname=" . $checkProfile[0]['Uname'];
                                                                }  ?>" style="text-decoration: none; color:inherit;">
                                <img src="<?php echo $checkProfile[0]['img']; ?>"
                                    style="width: 40px; border-radius:50%;" alt="userPhoto"
                                    oncontextmenu="contextMenu(event);">
                                <b><?php echo $checkProfile[0]['Uname']; ?></b>
                            </a>
                            <span style="color: grey; margin-left:10px;">|</span>
                            <span style="font-size: 16px;">
                                <a href="../profiles/?uname=<?php echo $checkProfile[0]['Uname']; ?>"
                                    style="text-decoration: none; margin-left:10px;"><?php require_once('../agents/followsHandle.php'); ?></a>
                            </span>
                        </div>

                    </div>
                    <div class="d-flex flex-wrap" style="max-width:850px;margin:auto;border-top:1px solid black;">
                        <div style="width:500px;">
                            <img src="<?php echo $checkOnePost[0]['image']; ?>" style="width:100%;" alt="postImg"
                                oncontextmenu="event.preventDefault();">
                        </div>
                        <div id="unknown" class="p-1 d-flex flex-column justify-content-between overflow-auto"
                            style="flex-grow: 1;">
                            <div>
                                <a href="../profiles/<?php if ($_COOKIE['userName'] != $checkProfile[0]['Uname']) {
                                                                        echo "?uname=" . $checkProfile[0]['Uname'];
                                                                    }  ?>"
                                    style="text-decoration: none; color:inherit;">
                                    <b><?php echo $checkProfile[0]['Uname']; ?></b>
                                </a>
                                <span style="color: grey;">&nbsp; |</span>
                                <span style="font-size: 16px;">
                                    <a href="../profiles/?uname=<?php echo $checkProfile[0]['Uname']; ?>"
                                        style="text-decoration: none;">&nbsp;
                                        <?php require('../agents/followsHandle.php'); ?></a>
                                </span>
                                <p class="p-1" style="margin-bottom: -1px;">
                                    <b>Caption: </b><?php echo $checkOnePost[0]['caption']; ?>
                                </p>

                                <p class="p-1" style="margin-bottom: -1px;">
                                    <b>Category: </b><?php echo $checkOnePost[0]['category']; ?>
                                </p>

                                <p class="p-1" style="margin-bottom: -1px;">
                                    <b>Price: </b><?php echo $checkOnePost[0]['price']; ?>
                                </p>
                            </div>

                            <div class="d-flex justify-content-center flex-grow-1" style="flex-grow:1;">
                                <div id="commentOutput" class="p-1 mt-1"
                                    style="width: 100%; max-height:300px;overflow-y:auto; border: 1px solid grey; border-radius:7px;">

                                </div>
                                <script>
                                var fetchComments = setInterval(() => {
                                    fetchText('commentOutput',
                                        '../agents/selectCommentsHandle.php?img=<?php echo $checkOnePost[0]['id'];  ?>'
                                    );
                                }, 200);
                                document.getElementById('commentOutput').onmouseover = () => {
                                    clearInterval(fetchComments);
                                }
                                document.getElementById('commentOutput').onmouseleave = () => {
                                    fetchComments = setInterval(() => {
                                        fetchText('commentOutput',
                                            '../agents/selectCommentsHandle.php?img=<?php echo $checkOnePost[0]['id'];  ?>'
                                        );
                                    }, 200);
                                }
                                </script>
                            </div>

                            <div>
                                <!-- <div style="width:100%; height:200px; border:1px solid black;">

                                </div> -->
                                <div class="mt-2 mb-1">
                                    <form id="commentOnPost" method="post">
                                        <div class="d-flex justify-content-center align-items-end">
                                            <div style="width:85%;">
                                                <textarea class="form-control" rows="1" name="commentName"
                                                    style="box-shadow: none; max-height:120px; border: 1px solid #7d8c9a; font-family: 'Helvetica', FontAwesome, sans-serif;"
                                                    placeholder="&#xf0e0 Post Comments here . . ." required></textarea>
                                            </div>
                                            <div class="pl-2">
                                                <button class="btn btn-primary" type="submit">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            ?>
                </div>
            </div>
            <?php
                    require_once('../components/deletePost.php');
                }
            }
            ?>
            <!-- a liberary to autosize text area -->
            <script src="../sources/js/autosize.min.js"></script>
            <script>
            /* this function in the previous liberary */
            autosize(document.querySelector('textarea'));

            //document.getElementById('commentOutput').scrollTo(0, document.getElementById('commentOutput').scrollHeight);
            document.getElementById('commentOutput').scrollTop = document.getElementById('commentOutput').scrollHeight;
            /* function for prevent right click on images */
            const contextMenu = (e) => {
                e.preventDefault();
            };
            const enterKey = (e) => {
                if (e.key === 'Enter' && document.querySelector('textarea').style.height != '90px') {
                    // console.log('Enter');
                    document.querySelector('textarea').style.height = parseInt(document.querySelector('textarea')
                        .style.height.slice(0, 2)) + 10 + "px";
                }
            };
            let formCommentOnPost = document.getElementById('commentOnPost');
            formCommentOnPost.onsubmit = (e) => {
                e.preventDefault();
                let formData = new FormData(formCommentOnPost);
                formData.append('comment_user', <?php echo $_COOKIE['userId']; ?>);
                formData.append('post_user', <?php echo $checkProfile[0]['profile_user_id']; ?>);
                formData.append('post_id', <?php echo $checkOnePost[0]['id']; ?>);
                formData.append('time', '<?php echo date('Y-m-d H:i:s'); ?>');
                fetch('../agents/commentOnPostHandle.php', {
                    method: "POST",
                    body: formData
                }).then(document.querySelector('textarea').value = "").then(document.querySelector('textarea')
                    .focus())
            }
            </script>
        </main>
    </div>
</body>

</html>