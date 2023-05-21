<?php
// Read the code from the request body
$code = file_get_contents('php://input');

// Use the "-l" option of the PHP command-line interface to check the syntax of the code
$command = 'php -l';
$descriptors = array(
  0 => array('pipe', 'r'),
  1 => array('pipe', 'w'),
  2 => array('pipe', 'w')
);
$process = proc_open($command, $descriptors, $pipes);
fwrite($pipes[0], $code);
fclose($pipes[0]);
$output = stream_get_contents($pipes[1]);
$errors = stream_get_contents($pipes[2]);
fclose($pipes[1]);
fclose($pipes[2]);
$status = proc_close($process);

// If there were no syntax errors, output "OK"
if ($status === 0) {
  echo "OK";
} else {
  // If there were syntax errors, output the error message
  echo $errors;
}
?> 



