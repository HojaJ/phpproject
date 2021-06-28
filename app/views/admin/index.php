<?php
$sort = URLROOT . '/admin/?sort=';
if(!empty($data['pagination'])){
    $pagination = $data['pagination'];
    $page_id = intval($pagination[0]);
    $pages = intval($pagination[1]);
    $sort = URLROOT . '/admin/' . $page_id . '/?sort=';
}
?>

<?php require APPROOT . '/views/inc/header.php' ;?>
<?php flash('login_success'); flash('task_message');?>

<table class="table table-striped mt-5">
    <thead>
    <tr>
        <th>Имя <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" class="btn btn-danger <?php sortButtonActive('name'); ?>" href="<?php echo $sort;?>name">&uarr;</a>
                <a type="button" class="btn btn-danger <?php sortButtonActive('dname'); ?>" href="<?php echo $sort;?>dname">&darr;</a>
            </div>
        </th>
        <th>Email <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" class="btn btn-danger <?php sortButtonActive('email'); ?>" href="<?php echo $sort;?>email">&uarr;</a>
                <a type="button" class="btn btn-danger <?php sortButtonActive('demail'); ?>" href="<?php echo $sort;?>demail">&darr;</a>
            </div>
        </th>
        <th class="align-top">Задача</th>
        <th>Выполнил <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" class="btn btn-danger <?php sortButtonActive('fulfilled'); ?>" href="<?php echo $sort;?>fulfilled">&uarr;</a>
                <a type="button" class="btn btn-danger <?php sortButtonActive('dfulfilled'); ?>" href="<?php echo $sort;?>dfulfilled">&darr;</a>
            </div>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data['tasks'])): ?>
        <?php foreach ($data['tasks'] as $task): ?>
            <tr>
                <td><?php echo $task->user_name; ?></td>
                <td><?php echo $task->user_email; ?></td>
                <td><?php echo $task->task; ?></td>
                <td> <img src="<?php echo URLROOT; ?>/img/<?php echo ($task->fulfilled === 'Да') ? 'checked.svg' : 'not.svg'; ?>" width="20" height="20" alt="image description"></td>
                <td><a class="btn btn-info" href="<?php echo URLROOT . '/admin/edit/' . $task->id; ?>">Изменить</a></td>
                <td>
                    <form action="<?php echo URLROOT ?>/admin/delete/<?php echo $task->id; ?>" method="post">
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    </tbody>
</table>
<?php if (isset($pages) && ($pages > 1) ): ?>
    <nav aria-label="..." class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($page_id > 1) ? '' : 'disabled'; ?>">
                <a class="page-link" href="<?php echo URLROOT . '/admin/'; echo ($page_id > 1) ?  $page_id - 1 : ''; ?>" tabindex="-1">Предыдущий</a>
            </li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?php echo ($page_id == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo URLROOT . '/admin/' . $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php echo ($page_id < $pages) ? '' : 'disabled'; ?>">
                <a class="page-link" href="<?php echo URLROOT . '/admin/'; echo ($page_id < $pages) ?  $page_id + 1 : ''; ?>">Следующий</a>
            </li>
        </ul>
    </nav>
<?php endif;?>
<?php require APPROOT . '/views/inc/footer.php' ;?>


