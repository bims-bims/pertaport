<?php
include_once("../views_user/header_user.php");
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Pelaporan Kerusakan  <?php echo $_SESSION['username']; ?></h1>

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
                                        Data Pelaporan Berhasil Di Tambah
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                }
            }
            ?>

            <div class="card mb-4">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Buat Pelaporan
                    </button>
                    <button type="button" class="btn btn-warning">Print Data</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Bagian</th>
                                <th>Laporan</th>
                                <th>Tanggal Laporan</th>
                                <th>Diterima</th>
                                <th>Diproses</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Bagian</th>
                                <th>Laporan</th>
                                <th>Tanggal Laporan</th>
                                <th>Diterima</th>
                                <th>Diproses</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                               
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $nama_user = $_SESSION["username"];
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT
                                tbl_pelaporan.*,
                                tbl_users.nama_user,
                                tbl_devisi.nama_devisi
                                FROM `tbl_pelaporan`
                                INNER JOIN `tbl_users`
                                ON tbl_pelaporan.id_user = tbl_users.user_id
                                INNER JOIN `tbl_devisi`
                                ON tbl_pelaporan.id_devisi = tbl_devisi.devisi_id
                                WHERE
                                tbl_users.nama_user = '$nama_user'
                                ORDER BY tbl_pelaporan.pelaporan_id DESC");

                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['nama_user']; ?></td>
                                    <td><?php echo $d['nama_devisi']; ?></td>
                                    <td><?php echo $d['laporan'] ?></td>
                                    <td><?php echo $d['tanggal_pelaporan'] ?></td>
                                    <td><?php echo $d['tanggal_diterima'] ?></td>
                                    <td><?php echo $d['tanggal_proses']; ?></td>
                                    <td><?php echo $d['tanggal_selesai']; ?></td>
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
                                    <td><?php echo $d['keterangan']; ?></td>
                                <!-- Tombol Aksi -->
                                <td style="margin-right: 5px;"> 
    <?php
    if ($status == 'Diterima' || $status == 'Dikerjakan' || $status == 'Selesai' || $status == 'Selesai Terkonfirmasi') {
        if ($status == 'Selesai Terkonfirmasi') {
            echo '<button type="button" class="btn btn-secondary" disabled>Laporan Selesai</button>';
        } else {
            echo '<button type="button" class="btn btn-warning" disabled>Laporan Diterima</button>';
        }
    } else {
        echo '<a type="button" id="alet" data-bs-toggle="modal" href="#edit' . $d['pelaporan_id'] . '" class="btn btn-primary">Edit Laporan</a>';
    }

    // Tambahkan kondisi untuk tombol konfirmasi
    if ($status == 'Selesai') {
        echo '<button type="button" class="btn btn-success konfirmasi-button" data-bs-toggle="modal" data-bs-target="#konfirmasiModal' . $d['pelaporan_id'] . '">Konfirmasi</button>';
    }
    ?>
</td>


                                        </tr> 

                                <!-- Modal untuk Edit -->
                                <div class="modal fade" id="edit<?= $d['pelaporan_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Laporan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="update_laporan.php" method="post">
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="nama_user">Nama User</label> -->
                                                        <input hidden type="text" class="form-control" id="nama_user" value="<?php echo isset($d['nama_user']) ? $d['nama_user'] : ''; ?>" name="nama_user" readonly>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="devisi">Divisi</label> -->
                                                        <input hidden type="text" class="form-control" id="devisi" value="<?php echo isset($d['nama_devisi']) ? $d['nama_devisi'] : ''; ?>" name="nama_devisi" readonly>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <label for="laporan">Laporan</label>
                                                        <textarea class="form-control" id="laporan" name="laporan"><?php echo isset($d['laporan']) ? $d['laporan'] : ''; ?></textarea>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_diterima">Tanggal Diterima</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?php echo isset($d['tanggal_diterima']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_diterima'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_proses">Tanggal Diproses</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_proses" name="tanggal_proses" value="<?php echo isset($d['tanggal_proses']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_proses'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_selesai">Tanggal Selesai</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo isset($d['tanggal_selesai']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_selesai'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="status">Status</label> -->
                                                        <select hidden class="form-control" id="status" name="status">
                                                            <option value="Menunggu Konfirmasi" <?php echo (isset($d['status']) && $d['status'] == 'Menunggu Konfirmasi') ? 'selected' : ''; ?>>Menunggu</option>
                                                            <option value="Diterima" <?php echo (isset($d['status']) && $d['status'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                                            <option value="Dikerjakan" <?php echo (isset($d['status']) && $d['status'] == 'Dikerjakan') ? 'selected' : ''; ?>>Dikerjakan</option>
                                                            <option value="Selesai" <?php echo (isset($d['status']) && $d['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                                            <option value="Selesai" <?php echo (isset($d['status']) && $d['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2 mb-4">
                                                        <!-- <label for="keterangan">Keterangan</label> -->
                                                        <textarea hidden class="form-control" id="keterangan" name="keterangan"><?php echo isset($d['keterangan']) ? $d['keterangan'] : ''; ?></textarea>
                                                    </div>
                                                    <input hidden name="id" value="<?php echo$d['pelaporan_id'] ? $d['pelaporan_id'] : ''; ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Kirim Pelaporan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal Untuk Edit -->
                                

                                <!-- Modal untuk Edit 2 -->
                                <div class="modal fade" id="konfirmasiModal<?= $d['pelaporan_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Laporan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="update_laporan.php" method="post">
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="nama_user">Nama User</label> -->
                                                        <input hidden type="text" class="form-control" id="nama_user" value="<?php echo isset($d['nama_user']) ? $d['nama_user'] : ''; ?>" name="nama_user" readonly>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="devisi">Divisi</label> -->
                                                        <input hidden type="text" class="form-control" id="devisi" value="<?php echo isset($d['nama_devisi']) ? $d['nama_devisi'] : ''; ?>" name="nama_devisi" readonly>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="laporan">Laporan</label> -->
                                                        <textarea hidden class="form-control" id="laporan" name="laporan"><?php echo isset($d['laporan']) ? $d['laporan'] : ''; ?></textarea>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_diterima">Tanggal Diterima</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?php echo isset($d['tanggal_diterima']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_diterima'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_proses">Tanggal Diproses</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_proses" name="tanggal_proses" value="<?php echo isset($d['tanggal_proses']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_proses'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="tanggal_selesai">Tanggal Selesai</label> -->
                                                        <input hidden type="datetime-local" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo isset($d['tanggal_selesai']) ? date('Y-m-d\TH:i', strtotime($d['tanggal_selesai'])) : date('Y-m-d\TH:i', time()); ?>">
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <!-- <label for="status"> Pilih Status</label> -->
                                                        <select  class="form-control" id="status" name="status">
                                                           
                                                            <option  value="Selesai Terkonfirmasi" <?php echo (isset($d['status']) && $d['status'] == 'Selesai Terkonfirmasi') ? 'selected' : ''; ?>>Selesai Terkonfirmasi</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2 mb-4">
                                                        <!-- <label for="keterangan">Keterangan</label> -->
                                                        <textarea hidden class="form-control" id="keterangan" name="keterangan"><?php echo isset($d['keterangan']) ? $d['keterangan'] : ''; ?></textarea>
                                                    </div>
                                                    <input hidden name="id" value="<?php echo$d['pelaporan_id'] ? $d['pelaporan_id'] : ''; ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Konfirmasi Pelaporan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal Untuk Edit 2 -->

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
           <!-- Modal Tambah -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Pelaporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                            // Mengambil satu baris data dari hasil kueri
                            $data_modal = mysqli_query($koneksi, "SELECT
                                tbl_pelaporan.*,
                                tbl_users.nama_user,
                                tbl_devisi.nama_devisi
                                FROM `tbl_pelaporan`
                                INNER JOIN `tbl_users`
                                ON tbl_pelaporan.id_user = tbl_users.user_id
                                INNER JOIN `tbl_devisi`
                                ON tbl_pelaporan.id_devisi = tbl_devisi.devisi_id
                                WHERE
                                tbl_users.nama_user = '$nama_user' LIMIT 1");

                            // Mengisi nilai input dari hasil kueri
                            if ($d_modal = mysqli_fetch_array($data_modal)) {
                            ?>
<form action="create_laporan.php" method="post">
    <div class="form-group mt-2 mb-2">
        <!-- <label for="nama_user">Nama User</label> -->
        <input type="text" class="form-control" id="nama_user" value="<?php echo $d_modal['id_user']; ?>" name="nama_user" hidden>
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="devisi">Divisi</label> -->
        <input type="text" class="form-control" id="devisi" value="<?php echo $d_modal['id_devisi']; ?>" name="nama_devisi" hidden>
    </div>
    <div class="form-group mt-2 mb-2">
        <label for="laporan">Laporan</label>
        <textarea class="form-control" id="laporan" name="laporan"></textarea>
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="tanggal_laporan">Tanggal Diterima</label> -->
        <input type="datetime-local" class="form-control"  id="timestamp"  name="tanggal_pelaporan" hidden  >
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="tanggal_diterima">Tanggal Diterima</label> -->
        <input type="datetime-local" class="form-control"  id="tanggal_diterima"  name="tanggal_diterima" hidden >
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="tanggal_proses">Tanggal Diproses</label> -->
        <input type="datetime-local" class="form-control"   id="tanggal_proses" name="tanggal_proses" hidden>
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="tanggal_selesai">Tanggal Selesai</label> -->
        <input type="datetime-local" class="form-control"   id="tanggal_selesai" name="tanggal_selesai" hidden>
    </div>
    <div class="form-group mt-2 mb-2">
        <!-- <label for="status">Status</label> -->
        <select class="form-control" id="status" name="status" hidden>
            <option value="Menunggu Konfirmasi">Menunggu</option>
            <option value="Diterima">Diterima</option>
            <option value="Dikerjakan">Dikerjakan</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
    <div class="form-group mt-2 mb-4">
        <!-- <label for="keterangan">Keterangan</label> -->
        <textarea class="form-control" id="keterangan" name="keterangan" hidden></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Kirim Pelaporan</button>
    </div>
</form>
                                
                    <?php
                            }
                            ?>
                </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        var timestampInput = document.getElementById('timestamp');

        if (timestampInput) {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
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
```

