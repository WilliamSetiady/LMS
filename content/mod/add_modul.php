<?php
// $instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
// if (isset($_POST['save'])) {
//     //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
//     $instName = $_POST['instructor_name'];
//     $instGender = $_POST['instructor_gender'];
//     $instEd = $_POST['instructor_education'];
//     $instPhone = $_POST['instructor_phone'];
//     $instEmail = $_POST['instructor_email'];
//     $instPassword = sha1($_POST['instructor_password']);
//     $instAddr = $_POST['instructor_address'];
//     $instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
//     $queryInsert = mysqli_query($config, "INSERT INTO instructors (instructor_name, instructor_gender, instructor_education, instructor_phone, instructor_email, instructor_password instructor_address) VALUES ('$instName','$instGender', '$instEd', '$instPhone', '$instEmail', '$instPassword' '$instAddr')");
//     header("location:?page=/instruct/instructor&add=success");
// }
// if (isset($_GET['edit'])) {
//     $queryEdit = mysqli_query($config, "SELECT * FROM instructors WHERE instructor_id = $instructorId");
//     $rowEdit = mysqli_fetch_assoc($queryEdit);
// }

// if (isset($_POST['edit'])) {
//     $instName = $_POST['instructor_name'];
//     $instGender = $_POST['instructor_gender'];
//     $instEd = $_POST['instructor_education'];
//     $instPhone = $_POST['instructor_phone'];
//     $instEmail = $_POST['instructor_email'];
//     $instPassword = isset($_POST['instructor_password']) ? sha1($_POST['instructor_password']) : $rowEdit['instructor_password'];
//     $instAddr = $_POST['instructor_address'];
//     $queryUpdate = mysqli_query($config, "UPDATE instructors SET instructor_name='$instName', instructor_gender='$instGender', instructor_education='$instEd', instructor_phone='$instPhone', instructor_email='$instEmail', instructor_password='$instPassword', instructor_address='$instAddr' WHERE instructor_id = $instructorId");
//     header("location:?page=/instruct/instructor&update=success");
// }



// if (isset($_GET['delete'])) {
//     $instructor_id = isset($_GET['delete']) ? $_GET['delete'] : '';
//     $queryDelete = mysqli_query($config, "UPDATE instructors SET deleted_at = 1 WHERE instructor_id = '$instructor_id'");
//     if ($queryDelete) {
//         header("location:?page=/instruct/instructor&delete=success");
//     } else {
//         header("location:?page=/instruct/instructor&delete=failed");
//     }
// }
$id_instructor = isset($_id) ? $_id : '';
$queryInstructMajor = mysqli_query($config, "SELECT majors.major_name, instructor_major.* 
                                                            FROM instructor_major LEFT JOIN majors ON majors.major_id = instructor_major.id_major
                                                            WHERE instructor_major.id_instructor=$id_instructor");
$rowInstructMajor = mysqli_fetch_all($queryInstructMajor, MYSQLI_ASSOC);

if (isset($_POST['save'])) {
    $idInstructor = $_POST['id_instructor'];
    $idMajor = $_POST['id_major'];
    $modulName = $_POST['modul_name'];
    $queryInsert = mysqli_query($config, "INSERT INTO moduls (id_instructor, id_major, modul_name) VALUES ('$id_instructor', '$id_major', '$modul_name')");
    if($queryInsert){
        $idModul = mysqli_insert_id($config);
        // $_FILES = 
        foreach($_FILES['file']['modul_name'] as $index => $file){
            if($_FILES['file']['error'][$index]==0){
                $modulName = basename($_FILES['file']['modul_name'][$index]);
                $fileName = uniqid() . "-" . $modulName;
                $path = "Modul Files/";
                $targetPath = $path . $fileName;

                if(move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)){
                    $insert
                }
            }
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructor</h5>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Instructor Name </label>
                                <input readonly type="text" class="form-control" value="<?= $_name ?>">
                                <input type="hidden" name="id_instructor" class="form-control" value="<?= $_id ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Modul Name</label>
                                <select name="id_major" id="" class="form-control" required>
                                    <option value="">Select one--</option>
                                    <?php foreach ($rowInstructMajor as $rIM): ?>
                                    <option value="<?= $rIM['id_major'] ?>"><?= $rIM['major_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Major Name *</label>
                                <input type="text" name="modul_name" class="form-control" placeholder="Enter new Modul"
                                    required>
                            </div>
                        </div>

                    </div>

                    <div align="right" class="mb-3">
                        <button type="button" class="btn btn-primary addRow" id="addRow">Add Row</button>
                    </div>
                    <table class="table" id="tableModul">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($instructorId) && $instructorId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($instructorId) && $instructorId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
//var, let, const
//var: tidak ada nilai, maka akan error, let harus mempunyai nilai
//const: nilai tidak boleh berubah/statis
//const nama = "bambang";
//nama = "udin";
// const button = document.getElementById('addRow');
// const button = document.getElementsByClassName('addRow');
const button = document.querySelector('.addRow');
const tbody = document.querySelector('#tableModul tbody');
//mengganti content suatu variable
// button.textContent = "duar";
//jika text == add Row maka akan menjadi duar
button.addEventListener("click", function() {
    // alert('duar');
    const tr = document.createElement("tr"); //membuat <tr></tr>
    tr.innerHTML = `<td><input type='file' name='file[]'></td>
        <td><button class='btn btn-danger'>Delete</button></td>`; //menambahkan <td></td> kedalam tr

    tbody.appendChild(tr);
})
</script>