<?php
$majorId = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $majorName = $_POST['major_name'];
    $majorId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO majors (major_name) VALUES ('$majorName')");
    header("location:?page=/maj/major&add=success");
}

if (isset($_POST['edit'])) {
    $majorName = $_POST['major_name'];
    $queryUpdate = mysqli_query($config, "UPDATE majors SET major_name='$majorName' WHERE major_id = $majorId");
    header("location:?page=/maj/major&update=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM majors WHERE major_id = $majorId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}



if (isset($_GET['delete'])) {
    $major_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE majors SET deleted_at = 1 WHERE major_id = '$major_id'");
    if ($queryDelete) {
        header("location:?page=/maj/major&delete=success");
    } else {
        header("location:?page=/maj/major&delete=failed");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Major</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Major Name *</label>
                        <input type="text" class="form-control" name="major_name" placeholder="Enter Major's Name"
                            value="<?= isset($_GET['edit']) ? $rowEdit['major_name'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($majorId) && $majorId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($majorId) && $majorId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>