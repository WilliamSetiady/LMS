<?php
// $queryUser = mysqli_query($config, "SELECT roles.role_name, users.* FROM users LEFT JOIN roles ON roles.role_id = users.id_role WHERE deleted_at = 0 ORDER BY users.user_id DESC");
// $rowUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
$query = mysqli_query($config, "SELECT majors.major_name, instructors.instructor_name, moduls.*
                                                FROM moduls 
                                                LEFT JOIN majors ON majors.major_id = moduls.id_major
                                                LEFT JOIN instructors ON instructors.instructor_id = moduls.id_instructor
                                                ORDER BY moduls.modul_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data Moduls</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/mod/add_modul" class="btn btn-success">Add Modul</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Instructor Name</th>
                                <th>Major</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $mod) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $mod['instructor_name'] ?></td>
                                    <td><?= $mod['major_name'] ?></td>
                                    <!-- <td><?= $mod['role_name'] ?></td> -->
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/mod/add_modul&edit=<?= $mod['modul_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=/usr/add_modul&delete=<?= $mod['modul_id'] ?>"
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