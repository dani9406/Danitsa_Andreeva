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
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
       <?php foreach ($row as $rows) : ?>
        <form action="<?php echo base_url(); ?>get_article_info_controller/article" method="post">
        <tr class="success">
        <td><?php echo $rows->article_title; ?></td>
        <td><?php echo $rows->article_author; ?></td>
        <td><?php echo $rows->article_date; ?></td>       
        <td> <a href="<?php echo site_url('article_info_controller/article/'.$rows->article_id)?>">[Show more]</a></td>
        <td> <a href="<?php echo site_url('article_info_controller/delete_article/'.$rows->article_id)?>">Delete</a></td>
        <td> <a href="<?php echo site_url('article_info_controller/update_article/'.$rows->article_id)?>">Update</a></td>
        </tr>
        </form>
       <?php endforeach; ?>
        
    </tbody>
  </table>
           <?php  echo $this->pagination->create_links(); ?>
    </body>
</html>