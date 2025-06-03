<?php
$query = mysqli_query($config, "SELECT * FROM majors WHERE deleted_at = 0 ORDER BY major_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Major Data</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/maj/add_major" class="btn btn-success">Add Major</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Major</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $major) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $major['major_name'] ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/maj/add_major&edit=<?= $major['major_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=maj/add_major&delete=<?= $major['major_id'] ?>"
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