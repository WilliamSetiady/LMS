<?php
$query = mysqli_query($config, "SELECT * FROM instructors WHERE deleted_at = 0 ORDER BY instructor_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Instructor Data</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/instruct/add_instructor" class="btn btn-success">Add Instructor</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $instructor) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $instructor['instructor_name'] ?></td>
                                    <td><?= $instructor['instructor_email'] ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/instruct/add_instructor&edit=<?= $instructor['instructor_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=instruct/add_instructor&delete=<?= $instructor['instructor_id'] ?>"
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
</div>