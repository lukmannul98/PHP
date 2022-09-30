<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <section class="form bg-light">
        <div class="container-lg">
            <div class="text-center">
                <h2>Form Perhitungan Gaji Kariyawan</h2>   
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-12">
                    <form method="post">
                        <div>
                            <label for="pegawai" class="form-label">Nama pegawai :</label>
                            <div class="input-group mb-4">
                                <input class="form-control" name="pegawai" type="text">
                            </div>
                        </div>
                        <label for="agama" class="form-label">Agama :</label>
                        <div class="input-group mb-4">
                            <select class="form-select" name="agama" id="agama">
                                <option value="islam">Islam</option>
                                <option value="kristen">kristen</option>
                                <option value="krislam">krislam</option>
                                <option value="hindu">hindu</option>
                                <option value="buddha">buddha</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label d-block">Jabatan :</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input me-2" value="manager" type="radio" name="jabatan" id="manager">
                                <label class="form-check-label" for="manager">Manager</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input me-2" value="asisten" type="radio" name="jabatan" id="asisten">
                                <label class="form-check-label" for="asisten">Asisten Manager</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input me-2" value="kabag" type="radio" name="jabatan" id="kabag">
                                <label class="form-check-label" for="kabag">Kabag</label>
                            </div>
                            <div class="form-check form-check-inline mb-4">
                                <input class="form-check-input me-2" value="staff" type="radio" name="jabatan" id="staff">
                                <label class="form-check-label" for="staff">Staff</label>
                            </div>
                        </div>

                        <div>
                            <label class="form-label d-block" for="status">Status :</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input me-2" type="radio" name="status" value="menikah" id="menikah">
                                <label class="form-check-label" for="menikah">Menikah</label>
                            </div>
                            <div class="form-check form-check-inline mb-4">
                                <input class="form-check-input me-2" type="radio" name="status" value="belum" id="belum">
                                <label class="form-check-label" for="belum">belum</label>
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="jumlah">Jumlah anak :</label>
                            <div class="input-group mb-4">
                                <textarea class="form-control" name="jumlah" id="jumlah" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <button name="proses" type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                    
                    <?php
                    $nama = $_POST['pegawai'];
                    $agama = $_POST['agama'];
                    $jabatan = $_POST['jabatan'];
                    $status = $_POST['status'];
                    $anak = $_POST['jumlah'];
                    $submit = $_POST['proses'];

                    switch ($jabatan) {
                        case 'manager':
                            $gaji = 20000000;
                            break;
                        case 'asisten':
                            $gaji = 15000000;
                            break;
                        case 'kabag':
                            $gaji = 10000000;
                            break;
                        case 'staff':
                            $gaji = 4000000;
                            break;
                        default:
                            $gaji = '';
                            break;
                    }

                    $tunjangan_jabatan = 0.2 * $gaji;
 
                    $tunjangan_keluarga = '';
                    if ($status == 'menikah' && $anak == 1 && $anak <= 2) {
                        $tunjangan_keluarga = 0.05 * $gaji;
                    } elseif ($status == 'menikah' && $anak == 3 && $anak <= 5) {
                        $tunjangan_keluarga = 0.10 * $gaji;
                    } elseif ($status == 'menikah' && $anak >= 6) {
                        $tunjangan_keluarga = 0.15 * $gaji;
                    } elseif ($status == 'belum' && $anak == 0) {
                        $tunjangan_keluarga = 0;
                    }

                    $gaji_kotor = $gaji + $tunjangan_jabatan + $tunjangan_keluarga;

                    $zakat = ($agama == 'islam' && $gaji_kotor > 6000000) ? 0.025 * $gaji_kotor : 0;

                    $take_home_pay = $gaji_kotor - $zakat;

                    if (isset($submit)) { ?>
                        <div class="container-md">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Data Pegawai
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text px-5">
                                                <table class="table table-dark table-hover">
                                                    <thead>
                                                        <th>Nama Pegawai</th>
                                                        <th>Agama</th>
                                                        <th>Jabatan</th>
                                                        <th>Status</th>
                                                        <th>Jumlah Anak</th>
                                                        <th>Gaji Pokok</th>
                                                        <th>Tunjangan Jabatan</th>
                                                        <th>Tunjangan Keluarga</th>
                                                        <th>Gaji Kotor</th>
                                                        <th>Zakat Profesi</th>
                                                        <th>Take Home Pay</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $nama; ?></td>
                                                            <td><?= $agama; ?></td>
                                                            <td><?= $jabatan; ?></td>
                                                            <td><?= $status; ?></td>
                                                            <td><?= $anak; ?></td>
                                                            <td><?= 'Rp.' . number_format($gaji, 2, ',', '.'); ?></td>
                                                            <td><?= 'Rp.' . number_format($tunjangan_jabatan, 2, ',', '.'); ?></td>
                                                            <td><?= 'Rp.' . number_format($tunjangan_keluarga, 2, ',', '.'); ?></td>
                                                            <td><?= 'Rp.' . number_format($gaji_kotor, 2, ',', '.'); ?></td>
                                                            <td><?= 'Rp.' . number_format($zakat, 2, ',', '.'); ?></td>
                                                            <td><?= 'Rp.' . number_format($take_home_pay, 2, ',', '.'); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>