<html>
    <head>
        <title>Registration Form</title>
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
                        <li><a href="<?php echo site_url('article_controller/show_articles'); ?>">Articles</a></li>                        
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
        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>registration_controller/validate" method="post">

            <div class="form-group">
                <label class="col-sm-2 control-label">Userame:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>                  

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="email" placeholder="Enter email">
                </div>                
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div> 
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Confirm Password:</label>

                <div class="col-sm-8">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Register</button>
                </div>
            </div>
            <?php //$this->load->helper(array('form', 'url')); $this->load->library('form_validation');
            echo validation_errors();
            ?>
        </form>
    </body>    

</html>
