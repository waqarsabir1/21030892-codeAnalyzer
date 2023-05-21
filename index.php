<!DOCTYPE html>
<html>
 
<?php
error_reporting(E_ALL);

if(isset($_POST['action'])){
    define("DB", "waqarsabir_codeAnalyzer");
    define("SR", "localhost");
    define("UN", "waqarsabir_codeAnalyzer");
    define("PW", "codeAnalyzer");
    
    $con = mysqli_connect(SR, UN, PW);
    $dB =  mysqli_select_db($con, DB);
     
    if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
       }
     
        #Basic Functions of SQL
        function Run($strRs){ 
            global $con ;
            return mysqli_query($con, $strRs);
        }
        
        function getRow($strRs){ 
            return mysqli_fetch_assoc($strRs);
        }
        
        function getRecord($strRs){
            $records = mysqli_num_rows($strRs);
            return $records;
        }
        if(isset($_POST['action'])){
             
            $action = $_POST['action'];
            if($action=='getExplanation'){
                $code = $_POST['code'];
                $code = str_replace('"',"",$code);
                $code = str_replace("'","",$code);
                $code = str_replace(array('\r','\n'), '', $code);

                $code         = preg_replace('/[^a-zA-Z0-9\s]/', '', $code);
                $explanation  = preg_replace('/[^a-zA-Z0-9\s]/', '', $explanation);

                $str = "select * from tblcode where code =  '$code'";
                $strRs = Run($str);
                $strRow = getRow($strRs);
                 
                  $explanation = $strRow['explanation'];
                  if($explanation == ""){
                    $explanation = "It is currenctly out of scope. Sorry i am still learning!!";
                  }
            }
        }
     
}
 
?>
<head>
    <title>Code Analyzer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: stretch;
            height: 100vh;
            width: 100%;
            background-color: #f5f5f5;
        }

        .code-input {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width:50%;
        }

        .explanation {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width:50%;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
        }

        .code-editor {
			position: relative;
			width: 70%;
			height: 300px;
			font-family: 'Courier New', Courier, monospace;
			font-size: 14px;
			line-height: 20px;
			padding: 10px 10px 10px 40px;
			background-color: #f8f8f8;
			border: 1px solid #ccc;
			border-radius: 5px;
			overflow-y: auto;
		}

       .line-numbers {
			position: absolute;
			top: 10px;
			left: 10px;
			width: 15px;
			height: 100%;
			font-size: 14px;
			line-height: 20px;
			color: #999;
			pointer-events: none; 
            z-index: 1;
		}

    </style>

</head>

<body>
<form action="" method="post">
    <div class="container">
       
            <div class="code-input">
                <h1>Enter your code:</h1>
                <div class="toolbar">
                    <button id="validateBtn" type="button">Validate</button>
                    <button type="submit" name="getExplanationBtn">Get Explanation</button>
                </div>
                <div style="position:relative">
                    <div class="line-numbers"></div>
                    <textarea  placeholder="<?php ?>" id="code" class="code-editor" name="code" rows="10" cols="80">
                        <?php if(isset($_POST['code']) != ""){ echo $_POST['code']; } ?>
                    </textarea>
                </div>
                <div id="result"></div>
            </div>
            <div class="explanation">
                <h1>Explanation:</h1>
                <p id="explanation">
                    <?php if( $explanation != ""){echo "$explanation"; } ?>
                </p>
                <input type="hidden" name="action" value="getExplanation">

            </div>
        
    </div>
    </form>
    <script>
        const codeInput = document.querySelector("#code");
        const explanation = document.querySelector("#explanation");

        codeInput.addEventListener("input", () => {
            const code = codeInput.value;
            // replace the following line with your own code analyzer function
            const analyzedCode = analyzeCode(code);
            explanation.innerText = analyzedCode;
        });

        async function analyzeCode(code) {
            // Send an HTTP POST request to the server-side PHP script to check the syntax of the code
            try {
                const response = await fetch('https://waqarsabir.com/Projects/Staffs/check_syntax.php', {
                    method: 'POST',
                    body: code,
                    headers: {
                        'Content-Type': 'text/plain'
                    }
                });

                // Read the response and check if there were any syntax errors
                const result = await response.text();
                if (result === 'OK') {
                    return "The code has no syntax errors.";
                } else {
                    // If there was an error, return the error message
                    return "There was a syntax error: " + result;
                }
            } catch (error) {
                // Handle any errors that might occur
                console.error(error);
                return "There was an error: " + error.message;
            }
        }

        function analyzeCode() {
            const code = document.getElementById('code').value;
            const url = 'https://waqarsabir.com/Projects/Staffs/check_syntax.php';

            fetch(url, {
                method: 'POST',
                body: code
            })
                .then(response => response.text())
                .then(result => {
                    document.getElementById('output').innerHTML = result;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function analyzeCodeButton() {
            const code = document.getElementById("code-input").value;
            const result = analyzeCode(code);
            document.getElementById("result").innerHTML = result;
        }
    </script>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</html>

<script>

       $(document).ready(function() {
			$("#validateBtn").click(function() {
				var code = $('#code').val(); // get the code from the input field
				var url = "https://phpcodechecker.com/api/?code=" + code; // construct the URL for the API request
				$.ajax({
					url: url,
					type: "GET",
					success: function(response) {
						var result = JSON.parse(response); // save the response in a variable
						var errors = result.errors;

                        if(errors == 'TRUE'){
                            $("#result").html(response);
                        }else{
                            $("#result").html('No errors found in the code');
                        }

                        console.log(errors);
                        //$("#result").html(errors); // display the response on the page
					}
				});
			});
		});

    
		var codeEditor = document.querySelector('.code-editor');
		var lineNumbers = document.querySelector('.line-numbers');

		codeEditor.addEventListener('input', function() {
			var lines = codeEditor.value.split('\n');
			var lineNumbersContent = '';

			for (var i = 0; i < lines.length; i++) {
				lineNumbersContent += (i + 1) + '\n';
			}

			lineNumbers.textContent = lineNumbersContent;
		});
</script>
</body>

</html>