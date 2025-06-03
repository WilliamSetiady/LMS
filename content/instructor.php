<?php
$query = mysqli_query($config, "SELECT * FROM instructors ORDER BY instructor_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Instructor Data</h5>
                <div class="mb-3" align="right">
                    <a href="?page=add_user" class="btn btn-success">Add Instructor</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $role) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $user['role_name'] ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=add_user&edit=<?= $user['user_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=add_user&delete=<?= $user['user_id'] ?>"
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