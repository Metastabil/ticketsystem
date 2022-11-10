<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title><?= $title; ?></title>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?= ApplicationHelper::base_url(); ?>assets/images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="<?= ApplicationHelper::base_url(); ?>assets/css/application.css" />
        <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.1.6/css/dx.light.css">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://kit.fontawesome.com/6d74c362a8.js" crossorigin="anonymous"></script>
        <script src="https://cdn3.devexpress.com/jslib/22.1.6/js/dx.all.js"></script>
        <script src="<?= ApplicationHelper::base_url(); ?>assets/js/application.js"></script>
        <script src="<?= ApplicationHelper::base_url(); ?>assets/js/users.js"></script>
        <script>
            const baseURL = "<?= ApplicationHelper::base_url(); ?>";
            const elements = [];
            const lang = <?= json_encode(LANG); ?>;
        </script>
    </head>
    <body>
        <nav>
            <div class="navbar">
                <a href="<?= ApplicationHelper::create_redirect_link('users'); ?>"><?= LANG['NavigationElements']['Tickets']; ?></a>
                <a href="javascript:void(0)"><?= LANG['NavigationElements']['Projects']; ?></a>
                <div class="dropdown">
                    <button class="dropbtn">
                        <?= LANG['NavigationElements']['Administration'] ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="javascript:void(0)"><?= LANG['NavigationElements']['Groups']; ?></a>
                        <a href="<?= ApplicationHelper::create_redirect_link('users'); ?>"><?= LANG['NavigationElements']['Users'] ?></a>
                        <a href="<?= ApplicationHelper::create_redirect_link('status'); ?>"><?= LANG['NavigationElements']['Status'] ?></a>
                    </div>
                </div>
                <form action="" method="post" class="language-select-form">
                    <select name="language-select" onchange="this.form.submit()" class="language-select">
                        <option value="en" <?= ($_SESSION['language'] === 'en') ? 'selected' : ''; ?>><?= LANG['Languages']['EN']; ?></option>
                        <option value="de" <?= ($_SESSION['language'] === 'de') ? 'selected' : ''; ?>><?= LANG['Languages']['DE']; ?></option>
                    </select>
                </form>
            </div>
        </nav>
        <div id="notification">
            <?php if (isset($_SESSION['error'])) : ?>
                <p class="error"><?= $_SESSION['error']; ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php elseif(isset($_SESSION['success'])) : ?>
                <p class="success"><?= $_SESSION['success']; ?></p>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
        </div>
        <div id="content">
