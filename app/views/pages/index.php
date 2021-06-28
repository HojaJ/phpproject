<?php
$sort = URLROOT . '/?';
if(!empty($data['pagination'])){
    $pagination = $data['pagination'];
    $page_id = intval($pagination[0]);
    $pages = intval($pagination[1]);
    $sort = URLROOT . '/' . $page_id . '/?sort=';
}
?>

<?php require APPROOT . '/views/inc/header.php' ;?>

<form class="form-inline mt-3 justify-content-between" method="post" action="<?php echo URLROOT . '/pages';?>/add">
    <label class="sr-only" for="name">Name</label>
    <input name="name" type="text" class="form-control mb-2 mr-sm-2" id="name"  placeholder="Имя" required>

    <label class="sr-only" for="email">Email</label>
    <input name="email" type="text" class="form-control mb-2 mr-sm-2" id="email" placeholder="Email" required>

    <label class="sr-only" for="task">Задача</label>
    <textarea name="task" id="task" class="form-control mb-2 mr-sm-2" cols="40"  rows="1"  placeholder="Задача" required></textarea>

    <button type="submit" class="btn btn-primary mb-2">Добавить задачу</button>
</form>

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
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    </tbody>
</table>
<?php  if (isset($pages) && ($pages > 1)): ?>
    <nav aria-label="..." class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($page_id > 1) ? '' : 'disabled'; ?>">
                <a class="page-link" href="<?php echo URLROOT . '/'; echo ($page_id > 1) ?  $page_id - 1 : ''; ?>" tabindex="-1">Предыдущий</a>
            </li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?php echo ($page_id == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo URLROOT . '/' . $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php echo ($page_id < $pages) ? '' : 'disabled'; ?>">
                <a class="page-link" href="<?php echo URLROOT . '/'; echo ($page_id < $pages) ?  $page_id + 1 : ''; ?>">Следующий</a>
            </li>
        </ul>
    </nav>
<?php endif;?>
<?php require APPROOT . '/views/inc/footer.php' ;?>

