<?php

$idInstructor = isset($_GET['id']) ? $_GET['id'] : '';
$queryInstructor = mysqli_query($config, "SELECT * FROM instructors WHERE instructor_id = '$idInstructor'");
$rowInstructor = mysqli_fetch_assoc($queryInstructor);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $id_istructor = $_GET['id_instructor'];
    $queryDelete = mysqli_query($config, "DELETE FROM instructor_major WHERE iM_id = '$id'");
    if ($queryDelete) {
        header("location:?page=/instruct/add_instructor_major&id=" . $id_istructor . "&hapus=success");
    } else {
        header("location:?page=/instruct/add_instructor_major&id=" . $id_istructor . "&hapus=failed");
    }
}
$queryMajor = mysqli_query($config, "SELECT * FROM majors ORDER BY major_id DESC");
$rowMajor = mysqli_fetch_all($queryMajor, MYSQLI_ASSOC);

// if (isset($_POST['save'])) {
if (isset($_POST['id_major'])) {
    $idMajor = $_POST['id_major'];
    $queryInsert = mysqli_query($config, "INSERT INTO instructor_major (id_major, id_instructor) VALUES ('$idMajor','$idInstructor')");
    header("location:?page=/instruct/add_instructor_major&id=" . $idInstructor . "&add=success");
}

$queryInstructMajor = mysqli_query($config, "SELECT majors.major_name, instructor_major.iM_id, id_instructor FROM instructor_major LEFT JOIN majors ON majors.major_id = instructor_major.id_major WHERE instructor_major.id_instructor = '$idInstructor' ORDER BY instructor_major.iM_id DESC");
$rowInstructMajor = mysqli_fetch_all($queryInstructMajor, MYSQLI_ASSOC);
// }

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Major Handler: <?= $rowInstructor['instructor_name'] ?></h5>
                <div align="right">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Adding Major
                    </button>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Major Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($rowInstructMajor as $key => $instMajor): ?>
                            <tr>
                                <td><?= $key += 1 ?></td>
                                <td><?= $instMajor['major_name'] ?></td>
                                <td>
                                    <a onclick="return confirm('Are you Sure want to delete this data??')"
                                        href="?page=instruct/add_instructor_major&delete=<?= $instMajor['iM_id'] ?>&id_instructor=<?php echo $instMajor['id_instructor'] ?>"
                                        class="btn btn-danger me-2 ms-2">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Instructor's Major</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Major Name</label>
                        <select name="id_major" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowMajor as $major): ?>
                                <option value="<?= $major['major_id'] ?>"><?= $major['major_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modaldivoter m-3" align="right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>