<div class='col1'>
 <?php if ($user): ?>

    <div class="avatar">
        <img src='/uploads/avatars/<?= $avatar ?>' alt="user_avatar">
    </div>


    <div id="profile_links">
    <a href='/users/bio/'>View Bio Info Here</a> | <a href='/posts/add'> Add a new post here</a>
    <br>
    <p>Previous posts:</p>
    <br>
    </div> <!--End of profilelinks div-->

<div class="profile"> <!--start of div profile-->
<?php foreach ($posts as $post_profile): ?>
        <div class='post_index'>
        <h1><?= $post_profile['first_name'] ?> <?= $post_profile['last_name'] ?>&nbsp;</h1>
        <h2>posted on:</h2>
        <time datetime="<?= Time::display($post_profile['created'], 'Y-m-d G:i') ?>">
            <?= Time::display($post_profile['created']) ?>
        </time>
        <br>
        <p> <?= $post_profile['content'] ?></p>
        <a href='/posts/Update/<?= $post_profile['post_id'] ?>'>Update</a>
        <a href='/posts/delete/<?= $post_profile['post_id'] ?>'>Delete</a>
       </div><!--end of post_index div-->

<?php endforeach; ?>

<!-- Menu options for users who are not logged in -->

<?php endif; ?>

</div><!--end of profile-->

</div><!--end of profile view-->

