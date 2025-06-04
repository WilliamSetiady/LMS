<?php
$roleId = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $roleName = $_POST['role_name'];
    $roleId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO roles (role_name) VALUES ('$roleName')");
    header("location:?page=/maj/major&add=success");
}

if (isset($_POST['edit'])) {
    $roleName = $_POST['role_name'];
    $queryUpdate = mysqli_query($config, "UPDATE roles SET role_name='$roleName' WHERE role_id = $roleId");
    header("location:?page=/rol/role&update=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE role_id = $roleId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}



if (isset($_GET['delete'])) {
    $major_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE roles SET deleted_at = 1 WHERE role_id = '$roleId'");
    if ($queryDelete) {
        header("location:?page=/rol/role&delete=success");
    } else {
        header("location:?page=/rol/role&delete=failed");
    }
}

$queryRole = mysqli_query($config, "SELECT * FROM roles ORDER BY role_id DESC");
$rowRole = mysqli_fetch_all($queryRole, MYSQLI_ASSOC);


?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Role</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Role *</label>
                        <!-- <select name="role_id" id="" class="form-control">
                            <option value="">Choose one</option>
                            <?php foreach ($rowRole as $role): ?>
                                <option
                                    <?= (isset($rowEdit) && $role['role_id'] == $rowEdit['role_id']) ? 'selected' : '' ?>
                                    value="<?= $role['role_id'] ?>">
                                    <?= $role['role_name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select> -->

                        <input type="text" class="form-control" name="role_name" placeholder="Enter Roles"
                            value="<?= isset($_GET['edit']) ? $rowEdit['role_name'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($roleId) && $roleId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($roleId) && $roleId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>