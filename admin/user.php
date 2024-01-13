<?php
include_once("../views/header.php");
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data user</h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="#">Pengaturan User</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol> -->

            <?php
            if (isset($_GET['edit'])) {
                if ($_GET['edit'] == "sukses") {
                    echo '<div class="alert alert-success" role="alert">Data Berhasil Di Update
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                }
            }
            ?>

            <?php
            if (isset($_GET['tambah'])) {
                if ($_GET['tambah'] == "sukses") {
                    echo '<div id="pemberitahuan" class="alert alert-primary alert-dismissible" role="alert">
                                        Data Berhasil Di Tambah
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                }
            }
            ?>
                                
                        <div class=" card mb-4">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Tambah User
                    </button>
                    <button type="button" class="btn btn-warning">Print Data</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Timestamps</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Timestamps</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            // $data = mysqli_query($koneksi, "select * from tbl_users");
                            $data = mysqli_query($koneksi, "SELECT * FROM tbl_users ORDER BY user_id DESC");
                            while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['nama_user']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo substr($d['password'], 0, 10); ?>
                                    </td>
                                    <td>
                                        <?php echo $d['role']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['created_at']; ?>
                                    </td>
                                    <td>
                                        <a type="button" id="alet" data-bs-toggle="modal" href="#edit<?php echo $d['user_id']; ?>"
                                            class="btn btn-primary " >Edit</a>


                                        <a type="button" id="alet" href="delete_user.php?id=<?= $d['user_id'] ?>"
                                            class="btn btn-danger ">hapus</a>
                                    </td>

                                </tr>


 <!-- Modal Edit -->
    <div class="modal fade" id="edit<?= $d['user_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="update_user.php" method="post">
                        <div class="form-group mt-2 mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $d['nama_user']; ?>" required>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $d['email']; ?>" required>
                        </div>
                        <!-- <div class="form-group mt-2 mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $d['password']; ?>" hidden required>
                        </div> -->
                        <div class="form-group mt-2 mb-4">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $d['user_id']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="btn" type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->

 <!-- Modal Tambah -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="create_user.php" method="post">
                        <div class="form-group mt-2 mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mt-2 mb-4">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                        <div class="form-group mt-2 mb-2">
                        <!-- <label for="timestamp">Timestamp</label> -->
                        <input type="datetime-local" class="form-control" id="timestamp" name="created_at" hidden>
                        </div>                         
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="btn" type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

   


    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>


<script>
    // $('#sukses').show('click', function(){
    //     swal.fire({
    //         icon:'succses'
    //         type: 'sukses',
    //         title: 'selamat',
    //         text: 'data berhasil di tambah'

    //     })
    // })
    document.addEventListener('DOMContentLoaded', function () {
        var timestampInput = document.getElementById('timestamp');

        if (timestampInput) {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if needed
            var day = currentDate.getDate().toString().padStart(2, '0'); // Add leading zero if needed
            var hours = currentDate.getHours().toString().padStart(2, '0');
            var minutes = currentDate.getMinutes().toString().padStart(2, '0');

            var currentDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

            timestampInput.value = currentDateTime;
        }
    });




</script>

<?php
include_once("../views/footer.php");
?>