<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Добовление поста</div>
            <div class="panel-body">
                <div style="display: none;" class="alert alert-info">Пост успешно добавлен</div>
                <form id="create" enctype="multipart/form-data" method="post" action="/post/store">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" name="name" class="form-control"  placeholder="Заголовок">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст</label>
                        <textarea rows="6" name="text" class="form-control"  placeholder="Текст"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Изображение</label>
                        <input type="file" name="upload" id="exampleInputFile">
                    </div>
                    <button type="button" onclick="create(this); return false;" class="btn btn-primary pull-right">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>