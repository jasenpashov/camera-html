<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = basename($_FILES['file']['name']);
        $targetPath = $uploadDir . time() . '_' . $filename;

        // Създаване на папката ако не съществува
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Запазване на файла
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            echo '<h2>Снимката е качена успешно:</h2>';
            echo '<img src="' . $targetPath . '" alt="Качена снимка" style="max-width: 100%;">';
        } else {
            echo 'Грешка при запис на файла.';
        }
    } else {
        echo 'Не е подаден файл или има грешка при качването.';
    }
} else {
    echo 'Невалиден метод на заявка.';
}
?>
