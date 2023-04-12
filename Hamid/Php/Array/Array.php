<?php

$data = '[	{		"nama" : "Pelita",		"kelas" : "Laravel",		"alamat" : "Bandung",		"tanggal_lahir" : "1997-12-27",		"nilai" : 90	},	{		"nama" : "Najmina",		"kelas" : "Vue JS",		"alamat" : "Jakarta",		"tanggal_lahir" : "1998-10-07",		"nilai" : 55	},	{		"nama" : "Anita",		"kelas" : "Design",		"alamat" : "Semarang",		"tanggal_lahir" : "1999-08-20",		"nilai" : 80	},	{		"nama" : "Bayu",		"kelas" : "Digital Marketing",		"alamat" : "Bandung",		"tanggal_lahir" : "1990-01-01",		"nilai" : 65	},	{		"nama" : "Nasa",		"kelas" : "UI/UX Designer",		"alamat" : "Bandung",		"tanggal_lahir" : "1995-04-10",		"nilai" : 70	},	{		"nama" : "Rahma",		"kelas" : "Node JS",		"alamat" : "Yogyakarta",		"tanggal_lahir" : "1993-09-15",		"nilai" : 85	}]';

$students = json_decode($data, true);

$categories = array(
    'A' => array(),
    'B' => array(),
    'C' => array(),
    'D' => array()
);

foreach ($students as $student) {
    if ($student['nilai'] >= 85 && $student['nilai'] <= 100) {
        $category = 'A';
    } elseif ($student['nilai'] >= 75 && $student['nilai'] <= 84) {
        $category = 'B';
    } elseif ($student['nilai'] >= 60 && $student['nilai'] <= 74) {
        $category = 'C';
    } else {
        $category = 'D';
    }

    $categories[$category][] = $student;
}

echo '<table>';
echo '<thead><tr><th>Nama</th><th>Kelas</th><th>Alamat</th><th>Tanggal Lahir</th><th>Nilai</th><th>Kategori</th></tr></thead>';
echo '<tbody>';

foreach ($categories as $category => $students) {
    foreach ($students as $student) {
        echo '<tr>';
        echo '<td>' . $student['nama'] . '</td>';
        echo '<td>' . $student['kelas'] . '</td>';
        echo '<td>' . $student['alamat'] . '</td>';
        echo '<td>' . $student['tanggal_lahir'] . '</td>';
        echo '<td>' . $student['nilai'] . '</td>';
        echo '<td>' . $category . '</td>';
        echo '</tr>';
    }
}

echo'</tbody></table>';

?>