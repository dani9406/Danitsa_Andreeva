<html>
    <head>
        <title>Update Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php echo 'You are logged in as: ' . $_SESSION['username']; ?>
        <a href="<?php echo site_url('login_controller/logout/') ?>">Logout</a><br/>
        <form class="form-horizontal" enctype="multipart/form-data" role="form" action="<?php echo site_url('article_controller/update'); ?>" method="post">

            <div class="form-group">
                <label class="col-sm-2 control-label">Update title:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" value="<?php echo $row->article_title ?>"/>
                </div>                  

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Update content:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="6" name="content" value=""><?php echo $row->article_content ?></textarea>                   
                </div>                
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Update author:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="author" value="<?php echo $row->article_author ?>" />
                </div>
            </div>   

            <div class="form-group">
                <label class="col-sm-2 control-label">Update image:</label>                
                <div class="col-sm-3">
                    <img src="<?php echo $row->article_image; ?>"/>
                    <input type="checkbox" name="delete_photo" value="checked"/> Delete<br/>
                    <input type="file" class="form-control" name="image">                     
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