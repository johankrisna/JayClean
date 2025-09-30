<?php
require_once('_functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jayclean | Status</title>
    <link rel="stylesheet" href="<?=url('_assets/css/status.css')?>">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderNumber = $_POST["orderNumber"];
    $prefix = strtoupper(substr($orderNumber, 0, 2));

    switch ($prefix) {
        case 'CK':
            $tableName = 'tb_order_ck';
            $orderColumn = 'or_ck_number';
            $columnMapping = [
                'or_ck_number' => 'Nomor Order',
                'nama_pel_ck' => 'Nama Pelanggan',
                'jenis_paket_ck' => 'Jenis Paket',
                'waktu_kerja_ck' => 'Waktu Kerja',
                'berat_qty_ck' => 'Jumlah PCS',
                'tarif_perkilo_ck' => 'Tarif',
                'tgl_keluar_ck' => 'Tanggal Keluar',
                'keterangan_ck' => 'Keterangan',
            ];
            break;
        case 'CS':
            $tableName = 'tb_order_cs';
            $orderColumn = 'or_cs_number';
            $columnMapping = [
                'or_cs_number' => 'Nomor Order',
                'nama_pel_cs' => 'Nama Pelanggan',
                'jenis_paket_cs' => 'Jenis Paket',
                'waktu_kerja_cs' => 'Waktu Kerja',
                'jml_pcs' => 'Jumlah PCS',
                'tarif_cs' => 'Tarif',
                'tgl_keluar_cs' => 'Tanggal Keluar',
                'keterangan_cs' => 'Keterangan',
            ];
            break;
        case 'DC':
            $tableName = 'tb_order_dc';
            $orderColumn = 'or_dc_number';
            $columnMapping = [
                'or_dc_number' => 'Nomor Order',
                'nama_pel_dc' => 'Nama Pelanggan',
                'jenis_paket_dc' => 'Jenis Paket',
                'waktu_kerja_dc' => 'Waktu Kerja',
                'berat_qty_dc' => 'Jumlah PCS',
                'tarif_dc' => 'Tarif',
                'tgl_keluar_dc' => 'Tanggal Keluar',
                'keterangan_dc' => 'Keterangan',
            ];
            break;
        default:
            die("Format nomor order tidak valid.");
            break;
    }

    $columnList = implode(', ', array_keys($columnMapping));
    $query = "SELECT $columnList FROM $tableName WHERE $orderColumn = '$orderNumber'";
    $data_order = query($query);
}

// Check if data is found
if (!empty($data_order)) {
    echo '<table border="1">
            <thead>
                <tr>';
    foreach ($columnMapping as $webColumnName) {
        echo "<th>$webColumnName</th>";
    }
    echo '</tr>
            </thead>
            <tbody>';
    foreach ($data_order as $order) {
        echo '<tr>';
        foreach ($columnMapping as $databaseColumnName => $webColumnName) {
            $keteranganClass = ($databaseColumnName === 'keterangan_ck' || $databaseColumnName === 'keterangan_cs' || $databaseColumnName === 'keterangan_dc') ? strtolower(str_replace(' ', '-', $order[$databaseColumnName])) : '';

            // Tambahkan class pada kolom keterangan
            echo "<td class='$keteranganClass'>" . $order[$databaseColumnName] . "</td>";
        }
        echo '</tr>';
    }
    echo '</tbody>
        </table>';
} else {
    echo "<p>Data tidak ditemukan.</p>";
}
?>
</body>
</html>
