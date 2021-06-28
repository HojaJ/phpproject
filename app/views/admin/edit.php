<?php require APPROOT . '/views/inc/header.php' ;?>

    <a href="<?php echo URLROOT ?>/admin/" class="btn btn-dark mt-2">Back</a>

    <div class="jumbotron mt-3">
        <div class="card mb-3">
            <div class="card-body">
                <h2>Редактировать</h2>
                <p>Edit the post with this form</p>
                <form action="<?php echo URLROOT ?>/admin/edit/<?php echo $data['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Имя <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Имя" value="<?php echo $data['username'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg" name="useremail" id="email" placeholder="Email" value="<?php echo $data['useremail'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="task">Задача <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg" name="task" id="task" placeholder="Задача" value="<?php echo $data['task'];?>" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input name="check" type="checkbox" class="custom-control-input" id="customControlInline" <?php echo ($data['fulfilled'] === 'Да') ? 'checked value="on" ' : '';?>>
                            <label class="custom-control-label" for="customControlInline">Выполнил</label>
                        </div>

                    </div>
                    <input type="submit" class="btn btn-success" value="Изменит">
                </form>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php' ;?>