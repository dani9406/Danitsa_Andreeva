<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Email verification code</th>
                    <th>Is_active</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($rows)): ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr class="success">
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->password; ?></td>
                            <td><?php echo $row->email; ?></td>
                            <td><?php echo $row->email_verification_code; ?></td>
                            <td><?php echo $row->is_active; ?></td>
                            <td> <a href="<?php echo site_url('user_managment_controller/update_user/'. $row->user_id) ?>">Edit</a></td>
                            <td> <a href="<?php echo site_url('user_managment_controller/delete_user/'. $row->user_id) ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>  
                <?php else: ?>
                    <tr colspan="3"><td>No info to show.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
</html>