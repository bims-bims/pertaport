<?php
include_once("../views/header.php");
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Devisi</h1>
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
                        Tambah Devisi
                    </button>
                    <button type="button" class="btn btn-warning">Print Data</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Devisi</th>
                                <th>actiom</th>
                            
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>action</th>
                                
                            
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            // $data = mysqli_query($koneksi, "select * from tbl_users");
                            $data = mysqli_query($koneksi, "SELECT * FROM tbl_devisi ORDER BY devisi_id DESC");
                            while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['nama_devisi']; ?>
                                    </td>   
                                    <td><button type="button" class="btn btn-warning mx-4 text-white">Edit</button>
                                        <a type="button" id="alet" href="delete_devisi.php?id=<?= $d['devisi_id'] ?>"
                                            class="btn btn-danger ">hapus</a>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Devisi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="create_devisi.php" method="post">
                        <div class="form-group mt-2 mb-2">
                            <label for="username">Tambah Devisi</label>
                            <input type="text" class="form-control" id="nama_devisi" name="nama_devisi" required>
                        </div>
                        <!-- <div class="form-group mt-2 mb-2">
                        <label for="timestamp">Timestamp</label> -->
                        <!-- <input type="datetime-local" class="form-control" id="timestamp" name="created_at" hidden> -->
                        <!-- </div>                          -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="btn" type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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