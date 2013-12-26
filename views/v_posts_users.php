

    <? foreach ($users as $user): ?>
        <br>

    <div class='post_users'>
        <!-- Print this user's name -->
       <div class='name'> <?= $user['first_name'] ?>  <?= $user['last_name'] ?>  </div>
        <div class='session_status'>
            <div class='user_status  <?php echo $user['status'] ?>'> </div>
        </div>


        <!-- If there exists a connection with this user, show a unfollow link -->
        <? if (isset($connections[$user['user_id']])): ?>
            <a href='/posts/unfollow/<?= $user['user_id'] ?>'>Unfollow</a>



            <!-- Otherwise, show the follow link -->
        <? else: ?>
            <a href='/posts/follow/<?= $user['user_id'] ?>'>Follow</a>


        <? endif; ?>

        <br><br>
    </div>
    <? endforeach; ?>


