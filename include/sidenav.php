<!-- sidebar -->
<?php require_once 'app/models/Page.php'; ?>
<div id="slide-out" class="sidenav sidenav-hover sidenav-fixed sidenav-grey">
    <nav class="z-depth-0">
        <div class="nav-wrapper sidenav-grey">
            <div class="container-full">
                <div data-target="slide-out" class="sidenav-close left pointer">
                    <i class="material-icons grey-text">menu</i>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </nav>
    <div class="sidenav-scrolling">
        <ul class="">
            <?php foreach (Page::all() as $page): ?>
                <li><a class="<?php echo $page->class_name ?>" href="<?php echo $page->url ?>"><i class="material-icons"><?php echo $page->icon ?></i><?php echo $page->name ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>