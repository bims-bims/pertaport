<?php
include_once("../views_manager/header_manager.php");
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Pelaporan Kerusakan</h1>
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
                <a type="button" href="pelaporan_menunggu.php" id="show-pending-reports" class="btn btn-danger">Menunggu Konfirmasi</a>
                    <a type="button" href="pelaporan_diterima.php"  class="btn btn-warning">Laporan Diterima</a>
                    <a type="button" href="pelaporan_dikerjakan.php"  class="btn btn-success">Laporan Dikerjakan</a>
                    <a type="button" href="pelaporan_selesai.php"  class="btn btn-primary">Selesai</a>   
                    <a type="button" href="pelaporan_selesai_terkonfirmasi.php" class="btn btn-secondary">Selesai Terkonfirmasi</a>             
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                    <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama User</th>
                                    <th>Bagian</th>
                                    <th>Laporan</th>
                                    <th>Diterima</th>
                                    <th>Diproses</th>
                                    <th>selesai</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>Nama User</th>
                                    <th>Bagian</th>
                                    <th>Laporan</th>
                                    <th>Diterima</th>
                                    <th>Diproses</th>
                                    <th>selesai</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Action</th> -->
                                    
                            </tfoot>
                            <tbody> 
                            <?php
                                    include '../koneksi.php';
                                    $no = 1;

                                    // ... (kode yang sudah ada)
                                    $data = mysqli_query($koneksi, "SELECT
                                    tbl_pelaporan.*,
                                    tbl_users.nama_user,
                                    tbl_devisi.nama_devisi
                                FROM
                                    tbl_pelaporan
                                INNER JOIN
                                    tbl_users
                                ON
                                    tbl_pelaporan.id_user = tbl_users.user_id
                                INNER JOIN
                                    tbl_devisi
                                ON
                                    tbl_pelaporan.id_devisi = tbl_devisi.devisi_id
                                WHERE
                                    tbl_pelaporan.status = 'Menunggu Konfirmasi'
                                ORDER BY tbl_pelaporan.pelaporan_id DESC");

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
                                            <?php echo $d['nama_devisi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $d['laporan'] ?>
                                        </td>
                                        <td>
                                            <?php echo $d['tanggal_diterima'] ?>
                                        </td>
                                        <td>
                                            <?php echo $d['tanggal_proses']; ?>
                                        </td>
                                        <td>
                                            <?php echo $d['tanggal_selesai']; ?>
                                        </td>
                                        <td>
                                        <?php
                                                    $status = $d['status'];
                                                    $badge_color = '';

                                                    switch ($status) {
                                                        case 'Menunggu Konfirmasi':
                                                            $badge_color = 'badge bg-danger text-white';
                                                            break;
                                                            case 'Diterima':
                                                                $badge_color = 'badge bg-warning text-white';
                                                                break;
                                                        case 'Dikerjakan':
                                                            $badge_color = 'badge bg-success text-white';
                                                            break;
                                                        case 'Selesai':
                                                            $badge_color = 'badge bg-primary text-white';
                                                            break;
                                                        default:
                                                            $badge_color = 'badge bg-secondary text-white';
                                                            break;
                                                    }

                                                    echo "<span class='$badge_color'>$status</span>";
                                                    ?>
                                        </td>
                                        <td>
                                           <?php echo $d['keterangan']; ?>  
                                        </td>
                                        <!-- <td>

                                    </tr> -->
<!-- Modal Edit -->
<div class="modal fade" id="edit<?= $d['pelaporan_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="edit_laporan.php" method="post">
    <div class="form-group mt-2 mb-2">
        <label for="nama_user">Nama User</label>
        <input type="text" class="form-control" class="nama_user" value="<?php echo isset($d['nama_user']) ? $d['nama_user'] : ''; ?>" name="nama_user" readonly>
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="devisi">Divisi</label>
        <input type="text" class="form-control" class="devisi" value="<?php echo isset($d['nama_devisi']) ? $d['nama_devisi'] : ''; ?>" name="nama_devisi" readonly>
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="laporan">Laporan</label>
        <textarea class="form-control" class="laporan" name="laporan"><?php echo isset($d['laporan']) ? $d['laporan'] : ''; ?></textarea>
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="tanggal_diterima">Tanggal Diterima</label>
        <input type="datetime-local" class="form-control" class="tanggal_diterima" name="tanggal_diterima" value="<?php echo isset($d['tanggal_diterima']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_diterima'])) : date('Y-m-d\TH:i', time()); ?>">
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="tanggal_proses">Tanggal Diproses</label>
        <input type="datetime-local" class="form-control" class="tanggal_proses" name="tanggal_proses" value="<?php echo isset($d['tanggal_proses']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_proses'])) : date('Y-m-d\TH:i', time()); ?>">
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input type="datetime-local" class="form-control" class="tanggal_selesai" name="tanggal_selesai" value="<?php echo isset($d['tanggal_selesai']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_selesai'])) : date('Y-m-d\TH:i', time()); ?>">
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="status">Status</label>
        <select class="form-control" class="status" name="status">
            <option value="Menunggu Konfirmasi" <?php echo (isset($d['status']) && $d['status'] == 'Menunggu Konfirmasi') ? 'selected' : ''; ?>>Menunggu</option>
            <option value="Diterima" <?php echo (isset($d['status']) && $d['status'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
            <option value="Dikerjakan" <?php echo (isset($d['status']) && $d['status'] == 'Dikerjakan') ? 'selected' : ''; ?>>Dikerjakan</option>
            <option value="Selesai" <?php echo (isset($d['status']) && $d['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
        </select>
    </div>
    <div class="form-group mt-2 mb-4">
        <label for="keterangan">Keterangan</label>
        <textarea class="form-control" class    ="keterangan" name="keterangan"><?php echo isset($d['keterangan']) ? $d['keterangan'] : ''; ?></textarea>
    </div>
    <input  name="id" value="<?php echo$d['pelaporan_id'] ? $d['pelaporan_id'] : ''; ?>">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Kirim Pelaporan</button>
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
                        <!-- <div class="form-group mt-2 mb-2">
                        <label for="timestamp">Timestamp</label> -->
                        <input type="datetime-local" class="form-control" id="timestamp" name="created_at" hidden>
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