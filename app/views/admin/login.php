<?php require APPROOT . '/views/inc/header.php' ;?>

<div class="col-6 mx-auto">
    <div class="card">
        <div class="card-body bg-light mt-5">
            <h2 class="card-title">Админ</h2>
            <p>Пожалуйста заполните все поля</p>
            <form action="<?php echo URLROOT ?>/admin/login" method="POST">
                <div class="form-group">
                    <label for="email">Логин <sup>*</sup></label>
                    <input type="text" class="form-control form-control-lg <?php echo (!empty($data['login_err'])) ? 'is-invalid' : ''; ?>" name="login" id="login" required value="<?php echo $data['login'];?>">
                    <span class="invalid-feedback"><?php echo $data['login_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="password">Парол <sup>*</sup></label>
                    <input type="text" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="password" id="password" required value="<?php echo $data['password'];?>" >
                    <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
                </div>
                <div class="row">
                    <div class="col"><input type="submit" class="btn btn-success btn-block" value="Войти"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php' ;?>

