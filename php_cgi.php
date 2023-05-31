<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = fgets(STDIN);

        parse_str($input, $output);

        if (isset($output['fname']) && isset($output['lname'])) {
            $fname = $output['fname'];
            $lname = $output['lname'];

            $file = 'user_data.txt';
            $current = file_get_contents($file);

            // Append new data to the file
            $current .= "First Name: $fname, Last Name: $lname\n";

            // Write contents back to the file
            file_put_contents($file, $current);
			header("Location: php_cgi.php", true, 303);
			exit();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $file = 'user_data.txt';

        // If the file exists, display its contents
        if (file_exists($file)) {
			$contents = file_get_contents($file);
            echo "<html>\n<body>\n<h1>User Data:</h1>\n<p>";
            echo nl2br($contents);
            echo "</p>\n</body>\n</html>";
        }
    }
?>