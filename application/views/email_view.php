<html>
    <head>
        <title>Email Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php echo 'You are logged in as: ' . $_SESSION['username']; ?>
        <a href="<?php echo site_url('login_controller/logout/') ?>">Logout</a><br/>
        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>email_controller/validate" method="post">

            <div class="form-group">
                <label class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>                  

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="email" placeholder="Enter email">
                </div>                
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="phone" placeholder="Enter phone">    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Content:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="6" name="content"  placeholder="Enter sandman"></textarea>
                </div>
            </div>            

            <div class="form-group">
                <label class="col-sm-2 control-label">Enter captcha:</label>
                <div class="col-sm-2">
                    <?php echo $image; ?> <input style="margin-top: 6px;" type="text" class="form-control" value="" name="captcha">
                </div>                
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </div>
            </div>
            <?php
            //$this->load->helper(array('form', 'url')); $this->load->library('form_validation');
            echo validation_errors();
            ?>
        </form>
    </body>    

</html>
