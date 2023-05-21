<?php
if ($_POST['action'] != "") {
    error_reporting(E_ALL);
    $code = $_POST['code'];
    // Execute the user's code and capture the output
    ob_start();
    eval($code);
    $output = ob_get_clean();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Code Executor</title>
</head>

<body>
    <h1>PHP Code Executor</h1>
    <form method="post">
        <label for="code">Enter PHP code:</label>
        <input type="hidden" name="action" value="send">
        <textarea name="code" id="code"></textarea>
        <button type="submit">Execute</button>
    </form>

    <?php if (!empty($output)): ?>
        <h2>Output:</h2>
        <pre><?php echo $output; ?></pre>
    <?php endif; ?>
</body>

</html>