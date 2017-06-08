<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Добовление поста</div>
            <div class="panel-body">
                <div style="display: none;" class="alert alert-info">Пост успешно обновлен</div>
                <form id="update" enctype="multipart/form-data" method="post" action="/post/update">
                    <input type="hidden" value="<?php echo $post['id']; ?>" name="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input value="<?php echo $post['name']; ?>" type="text" name="name" class="form-control"  placeholder="Заголовок">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст</label>
                        <textarea rows="6" name="text" class="form-control"  placeholder="Текст"><?php echo $post['text']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <div class="image">
                            <img class="img-responsive img-rounded" width="100" height="100" src="<?php echo $post['image']; ?>">
                        </div>
                        <label for="exampleInputFile">Изображение</label>
                        <input type="file" name="upload" id="exampleInputFile">
                    </div>
                    <button type="button" onclick="update(this); return false;" class="btn btn-primary pull-right">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>