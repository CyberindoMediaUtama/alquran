<?php
function listFolderFiles($dir, $prefix = '', &$output = [], &$stats = [])
{
    $items = scandir($dir);
    $folders = [];
    $files = [];

    // Pisahkan folder & file
    foreach ($items as $item) {
        if (!in_array($item, ['.', '..'])) {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $folders[] = $item;
            } else {
                $files[] = $item;
            }
        }
    }

    // Urutkan abjad
    sort($folders);
    sort($files);

    // Tampilkan folder dulu
    foreach ($folders as $folder) {
        $output[] = $prefix . "├── " . $folder . "/";
        $stats['folders']++;
        listFolderFiles($dir . DIRECTORY_SEPARATOR . $folder, $prefix . "│   ", $output, $stats);
    }

    // Lalu tampilkan file
    foreach ($files as $file) {
        $output[] = $prefix . "├── " . $file;
        $stats['files']++;

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($ext) {
            $stats['types'][$ext] = ($stats['types'][$ext] ?? 0) + 1;
        }
    }
}

// Jalankan
$baseDir = './';
$structure = [];
$stats = ['files' => 0, 'folders' => 0, 'types' => []];

// Deteksi nama folder saat ini
$rootName = basename(__DIR__);
$structure[] = $rootName . "/";

listFolderFiles($baseDir, '', $structure, $stats);

// Tambahkan ringkasan
$structure[] = "";
$structure[] = "📦 Total Folder: " . $stats['folders'];
$structure[] = "📄 Total File  : " . $stats['files'];

if (!empty($stats['types'])) {
    $structure[] = "";
    $structure[] = "📑 Jumlah File Berdasarkan Ekstensi:";
    foreach ($stats['types'] as $ext => $count) {
        $structure[] = "   - ." . $ext . " = " . $count;
    }
}

// Gabungkan & tampilkan
$structureText = implode("\n", $structure);
echo "<pre>" . htmlspecialchars($structureText) . "</pre>";

// Simpan ke structure.md
file_put_contents('structure.md', $structureText);
echo "<p><strong>✅ Struktur disimpan ke structure.md</strong></p>";
?>
