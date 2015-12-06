<html>
    <head>
        <title>Article list</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>


        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Blog</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo site_url('article_controller/show_articles'); ?>">Articles</a></li>                        
                        <li><a href="<?php echo site_url('article_controller/insert_article'); ?>">Insert article</a></li>
                        <li><a href="<?php echo site_url('email_controller/'); ?>">Send email</a></li>
                        <li><a href="<?php echo site_url('user_managment_controller/'); ?>">User management</a></li>
                    </ul>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href=""><span class="glyphicon glyphicon-user"></span><?php echo '&nbsp' . $_SESSION['username']; ?></a></li>
                            <li><a href="<?php echo site_url('login_controller/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    <?php } else { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo site_url('login_controller/login'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>    

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row as $rows) : ?>
                    <tr class="success">
                        <td><?php echo $rows->article_title; ?></td>
                        <td><?php echo $rows->article_author; ?></td>
                        <td><?php echo $rows->article_date; ?></td>       
                        <td> <a href="<?php echo site_url('article_controller/show_single_article/' . $rows->article_id) ?>">[Show more]</a></td>
                        <td> <a href="<?php echo site_url('article_controller/delete_article/' . $rows->article_id) ?>">Delete</a></td>
                        <td> <a href="<?php echo site_url('article_controller/show_update/' . $rows->article_id) ?>">Update</a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <?php echo $this->pagination->create_links(); ?>
    </body>
</html>