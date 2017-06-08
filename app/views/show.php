<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div style="display: none;" class="alert alert-info">Пост успешно удален</div>
            <div class="panel-heading">
                <?php echo $post['name']; ?>
                <a href="/post/edit/<?php echo $post['id']; ?>" class="btn btn-link">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <a href="javascript:;" onclick="deletePost(<?php echo $post['id']; ?>);" class="btn btn-link">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <img src="<?php echo $post['image']; ?>" class="image img-responsive">
                </div>
                <div class="col-md-12">
                    <blockquote>
                        <p><?php echo $post['text']; ?></p>
                        <footer>Последнее обновление <cite title="Source Title"><?php echo $post['updated_at']; ?></cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>