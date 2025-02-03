<?php
    $db = new Database();
    $user = $db->read('users', ['token' => $_SESSION['token']])[0];
?>
    <header class="p-none">
        <nav class="navbar navbar-expand-sm bg-light navbar-seconary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="statics/img/logoAnjoman.png" alt="logo" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button"
                               data-bs-toggle="dropdown"><?php echo $user['fname'] . " " . $user['lname']?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="login.php">خروج از حساب کاربری</a></li>
<!--                                <li><a class="dropdown-item" href="#">Another link</a></li>-->
<!--                                <li><a class="dropdown-item" href="#">A third link</a></li>-->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="setting.php">تنظیمات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage.php">مدیریت دوره ها</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>