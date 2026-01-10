<?php 
      
      $result = "";
      $error = "";


      $num1 = $num2 = $operation ="";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
        $num1 =$_POST["num1"] ?? "";
        $num2 =$_POST["num2"] ?? "";

        $operation = $_POST["operation"] ?? "";


        if($num1 === "" || $num2 === "" )
        {
            $error = "Both number fields are required.";

        }
        elseif (!is_numeric ($num1) || !is_numeric($num2)  )
        {
            $error = "please enter valid numeric values.";
        }
        else 
        {
            switch ($operation)
            {
                case "+":
                    $result = $num1 + $num2;
                    break;
                    
                case "-":
                    $result = $num1 - $num2;
                    break;
                    
                case "*":
                    $result = $num1 * $num2;
                    break;
                    
                case "/":
                    if($num2 == 0)
                        {
                            $error = "Division by zero is not allowed.";
                        }
                        else 
                        {
                            $result = $num1 / $num2;
                        }

                    break;
                    default:
                    $error = "Please select an operation.";
            }
        }

      }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Calculator</title>
    <link rel="stylesheet" href="calculator.css">
</head>
<body>

<div class="calculator">
    <h2>Calculator</h2>

    <form method="POST" action="">
        <input type="text" name="num1" placeholder="First Number" value="<?= htmlspecialchars($num1) ?>">

        <select name="operation">
            <option value="">Select Operation</option>
            <option value="+" <?= ($operation == "+") ? "selected" : "" ?>>+</option>
            <option value="-" <?= ($operation == "-") ? "selected" : "" ?>>−</option>
            <option value="*" <?= ($operation == "*") ? "selected" : "" ?>>×</option>
            <option value="/" <?= ($operation == "/") ? "selected" : "" ?>>÷</option>
        </select>

        <input type="text" name="num2" placeholder="Second Number" value="<?= htmlspecialchars($num2) ?>">

        <button type="submit">Calculate</button>
    </form>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($result !== "" && !$error): ?>
        <div class="result">
            Result: <strong><?= $result ?></strong>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
