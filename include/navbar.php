<!--nav fixed-->
<div class="navbar-fixed">
    <nav class="container-full">
        <div class="nav-wrapper">
            <ul class="left">
                <li>
                    <div data-target="slide-out" class="sidenav-trigger pointer" style="margin-right: 24px; margin-left: 5px;">
                        <i class="material-icons write-text">menu</i>
                    </div>
                </li>
                <li>
                    <a href="#!" class="brand-logo">
                        <span class="light-text">Money</span>
                        <span class="bold-text">Exchage</span>
                    </a>
                </li>
            </ul>
            <ul class="right">
                <li class="profile">
                    <img src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" class="dropdown-trigger btn-floating z-depth-0"
                         data-target='dropdown1' alt="">
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1' class='dropdown-content' style="padding: 16px 0;">

                        <li><a><i class="material-icons">person</i><?php echo $_SESSION['user']->name; ?></a></li>
                        <li><a href="sale.php"><i class="material-icons">laptop</i>Exchange Money</a></li>
                        <li><a href="login.php"><i class="material-icons">exit_to_app</i>Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
