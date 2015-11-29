<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php echo 'You are logged in as: ' . $_SESSION['username']; ?>
        <a href="<?php echo site_url('login_controller/logout/') ?>">Logout</a><br/>
        <?php echo validation_errors(); ?>
        <h3 style="margin-left: 10px;">Edit user</h3>
        <form class="form-horizontal"  role="form" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label">Username:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo $row->username; ?>" name="username">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" value="<?php echo $row->password; ?>" name="password">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo $row->email; ?>" name="email">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Activity:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo $row->is_active; ?>" name="is_active">
                </div>
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </body>
</html>