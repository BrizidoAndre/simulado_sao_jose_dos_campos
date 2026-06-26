<?php
$files = array_diff(scandir('./uploads'), ['..', '.']);
$hasFiles = count($files) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>File Upload Manager</h1>
    <form
            action="upload.php"
            method="POST"
            enctype="multipart/form-data"
            class="upload-form"
    >
        <label class="upload-area">
            <span>Select a file to upload</span>
            <input
                    type="file"
                    name="file"
                    required
            >
        </label>
        <button type="submit">
            Upload File
        </button>
    </form>
    <div class="file-list">
        <h2>Uploaded Files</h2>
        <?php if ($hasFiles): ?>
            <ul>
                <li>
                    <?php foreach ($files as $file): ?>
                        <a href="uploads/<?= $file ?>" download="<?= $file ?>">
                            <span><?= $file ?></span>
                        </a>
                    <?php endforeach ?>
                </li>
            </ul>
        <?php else: ?>
            <p>No uploaded files yet.</p>
        <?php endif ?>
    </div>
</div>
</body>
</html>