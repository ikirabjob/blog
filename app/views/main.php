<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    
    <?php if(!empty($posts)) {?>
        <?php foreach ($posts as $post) {?>
        <div class="post-preview">
            <a href="/post/show/<?php echo $post['id']; ?>">
                <h2 class="post-title">
                    <?php echo $post['name']; ?>
                </h2>
            </a>
            <p class="post-meta">Создано <?php echo $post['created_at']; ?></p>
        </div>
        <hr>
        <?php } ?>
    <?php } ?>
</div>