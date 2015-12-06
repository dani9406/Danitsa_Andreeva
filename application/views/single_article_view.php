<html>
    <head>
        <title>Single Article</title>
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
        <div class="main" style="margin-left: 10px;">            


            <?php echo $row->article_title . '<br/>'; ?>
            <img src="<?php echo $row->article_image; ?>" />
            <br/>
            <?php
            echo 'Count: ';
            echo $row->view_count . '<br>';
            echo 'Author: ';
            echo $row->article_author . '<br/>';
            echo 'Content: ';
            echo $row->article_content . '<br/>';
            echo 'Date: ';
            echo $row->article_date . '<br/>';
            ?>

            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-share-button" data-href="https://9gag.com/" data-layout="button_count"></div>
            <a href="https://twitter.com/share" class="twitter-share-button"{count}>Tweet</a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + '://platform.twitter.com/widgets.js';
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, 'script', 'twitter-wjs');</script>
            <br/>
            <?php if (is_array($comments)): ?>
                <?php foreach ($comments as $comment) : ?>
                    <?php echo '<b>' . $comment->username . ': </b>' . $comment->comment . '<br/>'; ?>
                <?php endforeach; ?>  
            <?php else: ?>
                <?php echo 'No comments.'; ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])) { ?>
                <div>
                    <form class="form-horizontal" method="post" action="<?php echo site_url('article_controller/add_comment/' . $row->article_id) ?>">
                        <h4>Add comment:</h4>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <textarea class="form-control" rows="3" name="comment" value=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <input class="btn btn-default" type="submit" name="submit" value="Изпрати" /></div>
                        </div>
                </div>                        
            </form>
        </div>
    <?php } ?>
</div>
</body>
</html>
