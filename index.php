<?php
$matkul = [
    ["nama" => "Algoritma Pemrograman", "sks" => 3, "nilai" => 85],
    ["nama" => "Matematika Diskrit", "sks" => 3, "nilai" => 75],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 90],
    ["nama" => "Jaringan Komputer", "sks" => 2, "nilai" => 65],
    ["nama" => "Statistika", "sks" => 3, "nilai" => 45]
];

function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSKS = 0;
$totalBobot = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perhitungan IPS Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1, h2 {
            text-align: center;
            color: #1e293b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #cbd5e1;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #2563eb;
            color: white;
        }

        .mengulang {
            background: #fecaca;
            color: #b91c1c;
        }

        .ringkasan {
            background: #dbeafe;
            padding: 20px;
            margin-top: 25px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Daftar Nilai Mata Kuliah</h1>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php foreach ($matkul as $index => $m): ?>
            <?php
            $hasil = hitungBobot($m["nilai"]);

            $status = ($hasil["bobot"] >= 2.0)
                ? "LULUS"
                : "MENGULANG";

            $totalSKS += $m["sks"];
            $totalBobot += $m["sks"] * $hasil["bobot"];
            ?>

            <tr class="<?= $status == 'MENGULANG' ? 'mengulang' : '' ?>">
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($m["nama"]) ?></td>
                <td><?= $m["sks"] ?></td>
                <td><?= $m["nilai"] ?></td>
                <td><?= $hasil["huruf"] ?></td>
                <td><?= number_format($hasil["bobot"], 1) ?></td>
                <td><?= $status ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    $ips = $totalSKS > 0 ? $totalBobot / $totalSKS : 0;
    $maksSKS = $ips >= 3.00 ? 24 : 20;
    ?>

    <div class="ringkasan">
        <h2>Ringkasan IPS</h2>

        <p>Total SKS: <?= $totalSKS ?> SKS</p>

        <p>Total Nilai Bobot:
            <?= number_format($totalBobot, 2) ?>
        </p>

        <p>IPS:
            <strong><?= number_format($ips, 2) ?></strong>
        </p>

        <p>Maksimal SKS Semester Depan:
            <strong><?= $maksSKS ?> SKS</strong>
        </p>
    </div>

</div>
</body>
</html>