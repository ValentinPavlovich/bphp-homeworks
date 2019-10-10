<!-- ?php
session_start();
?> -->

<div class="stabiliser"></div>
<div class="menu__wrapper">
    <div class="menu__container">

        <div class="menu__item">
            <a class="nav-link link" href="task_list.php">All</a>
        </div>
        <div class="menu__item">
            <a class="nav-link link" href="task_list.php?filterParam=new">New</a>
        </div>
        <div class="menu__item">
            <a class="nav-link link" href="task_list.php?filterParam=resolved">Resolved</a>
        </div>
        <div class="menu__item">
            <a class="nav-link link" href="task_list.php?filterParam=rejected">Rejected</a>
        </div>
        <div class="menu__item menu__btn">
            <a class="nav-link link" href="task_list.php?filterParam=done">Done</a>
        </div>     

        <?php if ($_SESSION['role'] == 'admin') { ?>
        <div class="menu__item">
            <a class="nav-link link" href="form_manager.php">Create new</a>
        </div>
        <?php } else { ?>
            <a class="nav-link link" style="visibility: hidden;"></a>
        <?php } ?>           

        <div class="menu__item"><a class="nav-link link" href="login.php?logout">Exit</a></div>
    </div>
</div>