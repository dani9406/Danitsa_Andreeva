<?php
echo $row->article_title.'<br/>'; ?>
<img src="<?php echo $row->article_image; ?>" />
<br/>
<?php
echo 'Count: ';
echo $row->view_count.'<br>';
echo 'Author: ';
echo $row->article_author.'<br/>';
echo 'Content: ';
echo $row->article_content.'<br/>';
echo 'Date: ';
echo $row->article_date.'<br/>';