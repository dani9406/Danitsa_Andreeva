<?php
if ($_SESSION['username'] != '') {
    echo 'You are logged in as: ' . $_SESSION['username'] . '<br/>';
    echo 'You are : ' . $_SESSION['is_admin'] . '<br/>';
    ?><a href="<?php echo site_url('login_controller/logout/') ?>">Logout</a><br/><?php
} else {
    echo 'Please login to see more.';
    ?><a href="<?php echo site_url('login_controller/') ?>">Login</a><br/><?php
}
?>
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