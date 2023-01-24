<?php
class Tools
{
    function
    get_operating_system()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $operating_system = 'Unknown Operating System';

        //Get the operating_system name
        if (preg_match('/linux/i', $u_agent)) {
            $operating_system = 'Linux';
        } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
            $operating_system = 'Mac';
        } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
            $operating_system = 'Windows';
        } elseif (preg_match('/ubuntu/i', $u_agent)) {
            $operating_system = 'Ubuntu';
        } elseif (preg_match('/iphone/i', $u_agent)) {
            $operating_system = 'IPhone';
        } elseif (preg_match('/ipod/i', $u_agent)) {
            $operating_system = 'IPod';
        } elseif (preg_match('/ipad/i', $u_agent)) {
            $operating_system = 'IPad';
        } elseif (preg_match('/android/i', $u_agent)) {
            $operating_system = 'Android';
        } elseif (preg_match('/blackberry/i', $u_agent)) {
            $operating_system = 'Blackberry';
        } elseif (preg_match('/webos/i', $u_agent)) {
            $operating_system = 'Mobile';
        }

        return $operating_system;
    }

    function code($text)
    {
        $key = 'T@hiaMi$r_Al@ddin23581321';
        $base = 'AES-128-ECB';
        $encrypts = openssl_encrypt($text, $base, $key);
        return $encrypts;
    }

    function decode($code)
    {
        $key = 'T@hiaMi$r_Al@ddin23581321';
        $base = 'AES-128-ECB';
        $decrypt = openssl_decrypt($code, $base, $key);
        return $decrypt;
    }

    function passhashit($text)
    {
        return password_hash($text, PASSWORD_DEFAULT);
    }

    function passveriit($text, $hash)
    {
        return password_verify($text, $hash);
    }

    function image_resize($file_name, $width, $height, $crop = FALSE)
    {
        list($wid, $ht) = getimagesize($file_name);
        $r = $wid / $ht;
        if ($crop) {
            if ($wid > $ht) {
                $wid = ceil($wid - ($width * abs($r - $width / $height)));
            } else {
                $ht = ceil($ht - ($ht * abs($r - $wid / $ht)));
            }
            $new_width = $width;
            $new_height = $height;
        } else {
            if ($width / $height > $r) {
                $new_width = $height * $r;
                $new_height = $height;
            } else {
                $new_height = $width / $r;
                $new_width = $width;
            }
        }
        $source = imagecreatefromjpeg($file_name);
        $dst = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
        return $dst;
    }
}
//$os = new tools();
//echo $os->get_operating_system();

class DB_Connect
{
    // properties
    protected $host;
    protected $username;
    protected $password;
    public $dbname;
    function __construct($host, $username, $password)
    {
        $this->host_name = $host;
        $this->uname = $username;
        $this->password = $password;
        // $this->dbconnect = $dbconnect;
    }

    function show_DBs()
    {
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . ";", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare("SHOW DATABASES");
            $this->dbconnect->execute();

            // return $this->dbconnect;
            $this->dbconnecting = $this->dbconnect->fetchAll(PDO::FETCH_ASSOC);
            if (empty($this->dbconnecting)) {
                echo '<h2 style="color:red;">No DataBases exists . . . لا توجد قواعد بيانات</h2>';
            } else {
                echo '<div style="display:flex; justify-content:center; align-items:center;height:95vh;"><table style="border:2px solid black; width:400px;"><th style="border:2px solid black; background-color:#dad8d8;">Data Bases</th>';
                foreach ($this->dbconnecting as $key => $value) {
                    echo '<tr><td style="border:1px solid black; color:blue; padding:3px;">' . $value["Database"] . '</td></tr>';
                }
                echo '</table></div>';
            }
            $this->dbconnect->closeCursor();
        } else {
            # code...
        }
    }

    function show_DBs2()
    {
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . ";", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare("SHOW DATABASES");
            $this->dbconnect->execute();
            return
                $this->dbconnect;
        } else {
            # code...
        }
    }

    function create_DB($dbname)
    {
        $this->dbname = $dbname;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . ";", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare("CREATE DATABASE  IF NOT EXISTS $this->dbname CHARACTER SET utf8 COLLATE utf8_general_ci;");
            $this->dbconnect->execute();
            $this->dbconnect->closeCursor();
        } else {
            # code...
        }
    }

    function create_customTable($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect =
            new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            # code...
            $this->dbconnect = $this->dbconnect->prepare($this->qur);
            $this->dbconnect->execute();
            $this->dbconnect->closeCursor();
        } else {
            # code...
        }
    }

    function create_table($tableName, $dbname, $structure)
    {
        $this->tableName = $tableName;
        $this->dbname = $dbname;
        $this->structure = $structure;

        $this->dbconnectH = new PDO("mysql:host=" . $this->host_name . ";", $this->uname, $this->password);
        if ($this->dbconnectH) {
            $this->dbconnectH = $this->dbconnectH->prepare("CREATE DATABASE  IF NOT EXISTS " . $this->dbname . " CHARACTER SET utf8 COLLATE utf8_general_ci;");
            $this->dbconnectH->execute();
        } else {
            # code...
        }

        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->tableStructure = "CREATE TABLE  IF NOT EXISTS " . $this->tableName . " (
                  id int NOT NULL AUTO_INCREMENT,
                  BookName varchar(255) NOT NULL,
                  BookAutor varchar(255),
                  BookClass varchar(255),
                  BookRow int,
                  BookSection varchar(255),
                  PRIMARY KEY (id)
              );";
            $this->tableStructureCustom = "CREATE TABLE  IF NOT EXISTS " . $this->tableName . " (" . $this->structure . ");";
            $this->dbconnect = $this->dbconnect->prepare($this->tableStructure);
            $this->dbconnect->execute();
        } else {
            # code...
        }
    }

    function read_Data($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare($this->qur);
            $this->dbconnect->execute();
            $this->dbconnect = $this->dbconnect->fetchAll(PDO::FETCH_ASSOC);
            if (empty($this->dbconnect)) {
                print_r(json_encode(""));
            } else {
                print_r(json_encode($this->dbconnect));
            }
        } else {
            //  print_r(json_encode("فشل الإتصال بقاعدة البيانات"));
        }
    }

    function read_Data_Inn($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare($this->qur);
            $this->dbconnect->execute();
            return $this->dbconnection = $this->dbconnect->fetchAll(PDO::FETCH_ASSOC);
            $this->dbconnect->closeCursor();
        } else {
            //
        }
    }

    function update_Tables($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare($this->qur);
            try {
                //code...
                $this->dbconnect->execute();
                $this->dbconnect->closeCursor();
                // echo "ok";
            } catch (PDOException $e) {
                //throw $th;
                $error = "Error in Excute update_Tables: ";
                $error .= $e->getMessage();
                // require_once('error.php');
                echo $error . "<br>";
            }
        } else {
            # code...
        }
    }

    function update_Tables2($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        try {
            $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
            if ($this->dbconnect) {
                $this->dbconnect = $this->dbconnect->prepare($this->qur);
                if ($this->dbconnect->execute()) {
                    $this->dbconnect->closeCursor();
                }
            }
        } catch (PDOException $e) {
            $error_message = 'Database Error: ';
            $error_message .= $e->getMessage();
            include('./error.php');
            //echo $error_message;
            exit();
        }
    }

    function add_Col_2All_Tables($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare($this->qur);
            $this->dbconnect->execute();
        } else {
            # code...
        }
    }

    function show_Tables($dbname)
    {
        $this->dbname = $dbname;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnect = $this->dbconnect->prepare("SHOW TABLES");
            $this->dbconnect->execute();
            return $this->dbconnect;
        } else {
            # code...
        }
    }

    function add_Data($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
        if ($this->dbconnect) {
            $this->dbconnection = $this->dbconnect->prepare($this->qur);
            return $this->dbconnection;
            // $this->dbconnect->execute();
        } else {
            //  print_r(json_encode("فشل الإتصال بقاعدة البيانات"));
        }
    }

    function login_Form($dbname, $qur)
    {
        $this->dbname = $dbname;
        $this->qur = $qur;
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
            if ($this->dbconnect) {
                $this->dbconnect = $this->dbconnect->prepare($this->qur);
                $this->dbconnect->execute();
                $this->dbconnect = $this->dbconnect->fetchAll(PDO::FETCH_ASSOC);
                if (empty($this->dbconnect)) {
                    print_r(json_encode('بيانات البريد أو كلمة المرور غير صالحة .. رجاء التأكد من صحتها أو .. عمل تسجبل جديد'));
                    //
                } else {
                    foreach ($this->dbconnect as $key => $value) {
                        session_start();
                        $_SESSION['firstName'] = $value['firstName'];
                        $_SESSION['lastName'] = $value['lastName'];
                        $_SESSION['User_ID'] = $value['User_ID'];
                        print_r(json_encode(true));
                    }
                }
            } else {
                # code...
            }
        } else {
            print_r(json_encode("فشل اتصال"));
        }
    }

    function regist_Form($dbname, $qurChk, $qurInsert)
    {
        $this->dbname = $dbname;
        $this->qurChk = $qurChk;
        $this->qurInsert = $qurInsert;

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $this->dbconnect = new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
            if ($this->dbconnect) {
                $this->dbconnect = $this->dbconnect->prepare($this->qurChk);
                $this->dbconnect->execute();
                $this->dbconnect = $this->dbconnect->fetchAll(PDO::FETCH_ASSOC);
                if (empty($this->dbconnect)) {
                    $this->dbconnectregist =
                        new PDO("mysql:host=" . $this->host_name . "; dbname=" . $this->dbname . "; charset=utf8;", $this->uname, $this->password);
                    if ($this->dbconnectregist) {
                        $this->dbconnectregist = $this->dbconnectregist->prepare($this->qurInsert);
                        $this->firstName = strip_tags(trim($_POST['firstName']));
                        $this->lastName = strip_tags(trim($_POST['lastName']));
                        $this->email = strip_tags(trim($_POST['email']));
                        $this->password = strip_tags(trim($_POST['password']));

                        $this->dbconnectregist->bindParam("firstName", $this->firstName);
                        $this->dbconnectregist->bindParam("lastName", $this->lastName);
                        $this->dbconnectregist->bindParam("email", $this->email);
                        $this->dbconnectregist->bindParam("password", $this->password);
                        $this->dbconnectregist->execute();
                        print_r(true);
                    } else {
                        print_r('حدث خطأ أثناءعملية التسجيل .. رجاء المحاولة مرة أخرى');
                    }
                } else {
                    print_r('هذا البريد موجود بالفعل .. رجاء تسجيل بريد آخر');
                }
            } else {
                print_r('فشل الإتصال  بقاعدة البيانات');
            }
        } else {
            print_r('فشل اتصال');
        }
    }
}


class SessionTest
{
    // properties
    public $f_Name;
    public $l_Name;
    public $u_ID;

    function __construct($f_Name, $l_Name, $u_ID)
    {
        $this->f_Name = $f_Name;
        $this->l_Name = $l_Name;
        $this->u_ID = $u_ID;
    }

    function testExit()
    {
        // $this->formExit = $formExit;
        // $this->testEnd = $testEnd;
        session_start();

        if (isset($_SESSION[$this->f_Name]) && isset($_SESSION[$this->l_Name]) && isset($_SESSION[$this->u_ID])) {


            // $this->top_Nav_Bar();
            $this->formExit();
        } else {
            $this->testEnd();
        }
    }

    function customConnect($formCustom, $typed)
    {
        // $this->endForm = $endForm;
        // $this->formCustom = $formCustom;
        session_start();

        if (isset($_SESSION[$this->f_Name]) && isset($_SESSION[$this->l_Name]) && isset($_SESSION[$this->u_ID])) {


            $this->formGridExit();
            // $this->formExit();
        } else {
            $this->customEnd($formCustom, $typed);
        }
    }

    function top_Nav_Bar()
    {
        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php" style="text-shadow:1px 1px 2px black;">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mine.php">الشخصية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">

                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            أدواتنا 
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li style="text-align:right;"><a class="dropdown-item" href="#">راديو انترنت</a></li>
                            <li style="text-align:right;"><a class="dropdown-item" href="#">حساب العمر ويوم الميلاد</a></li>
                            <li style="text-align:right;"><a class="dropdown-item" href="#">حساب التخفيضات</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <label style="color:blue; text-shadow:1px 1px 2px black;"> مرحبا بك يا  ' . $_SESSION[$this->f_Name] . ' ' . $_SESSION[$this->l_Name] . '</label>
            <form method="POST">
                <button style="margin:10px;" class="btn btn-outline-danger" type="submit" id="exit" name="exit">تسجيل الخروج</button>
            </form>
        </div>
    </nav>';
        if (isset($_POST['exit'])) {
            session_unset();
            echo '<script>location.reload();</script>';
        }
    }

    function top_Nav_temp()
    {
    }

    function formExit()
    {
        echo '<form method="POST">
                <button style="margin:10px;" class="btn btn-outline-danger" type="submit" id="exit" name="exit">تسجيل الخروج</button>
            </form>';
        if (isset($_POST['exit'])) {
            session_unset();
            echo '<script>location.reload();</script>';
        }
    }


    function formGridExit()
    {
        //$logout = 0;
        echo '
       
        <script src="MyOwnFramework/js/app.js"></script>
        <script>
        
        onload = new LoginSys("loginSystem").formGrid();
        
        
        </script>';
        if (isset($_POST["logoutA"])) {
            session_unset();
            echo '<script>location.reload();</script>';
        }
    }

    function testEnd()
    {
        echo '<script src="MyOwnFramework/js/app.js"></script><script>
    onload = new LoginSys("loginSystem").lginForm();
    
    </script>';
    }

    function customEnd($formCustom, $typed)
    {
        $this->formCustom = $formCustom;
        $this->typed = $typed;
        echo '<script src="MyOwnFramework/js/app.js"></script><script>
    onload = new LoginSys("loginSystem").' . $this->formCustom . ' +  new LoginSys("loginSystem").' . $this->typed . ';
    </script>';
    }
}