<?php
$items = array("OFF", "AC", "%", "/", "7", "8", "9", "x", "4", "5", "6", "-", "1", "2", "3", "+", "0", ".", "=");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="shortcut icon" href="./calculator-svgrepo-com.png" type="image/x-icon">
  <title>Calculator</title>
</head>

<body>
  <article method="post" class="calculator__container">
    <div class="results"></div>
    <div action="" method="post">
      <div class="buttons__container">
        <?php foreach ($items as $i) { ?>
          <?php
          if ($i == "AC" || $i == "OFF" || $i == "%") {
            print '<button onclick="handleNumber(this)"; data-value="' . $i . '" type="button" class="buttons yellow"> ' . $i . '</button>';
          } elseif ($i == "/" || strtolower($i) == "x" || $i == "-" || $i == "+") {
            print '<button onclick="handleNumber(this)"; data-value="' . $i . '" type="button" id="symbol" class="buttons orange"> ' . $i . '</button>';
          } elseif ($i == "0") {
            print '<button onclick="handleNumber(this)"; data-value="' . $i . '" type="button" id="' . $i . '" class="buttons zero"> ' . $i . '</button>';
          } else {
            print '<button onclick="handleNumber(this)"; data-value="' . $i . '" type="button" id="' . $i . '" class="buttons"> ' . $i . '</button>';
          }
          ?>
        <?php } ?>
      </div>
    </div>
  </article>

  <script>
    let values = [];
    let v1 = 0;
    let v2 = 0;
    let symbol = "";

    const handleNumber = (button) => {
      let data = button.dataset.value;
      let value = "";

      const handleValue = (vl1, sym) => {
        v1 = parseFloat(vl1);
        values = [];
        value = "";
        symbol = sym;
        return v1;
      }

      const handleSymbol = (v1, v2, symbol) => {
        if (symbol == "+") {
          value = v1 + v2;
        } else if (symbol == "-") {
          value = v1 - v2;
        } else if (symbol == "/") {
          value = v1 / v2;
        } else if (symbol.toLowerCase() == "x") {
          value = v1 * v2;
        } else if (symbol == "%") {
          value = v1 % v2;
        }
      }

      if (data) {
        values.push(data);
        console.log(values);
        values.forEach(l => {
          value += l;
        });

        console.log(parseFloat(value))

        if (data === "AC" || data === "OFF" || data === "%" || data === "/" || data.toLowerCase() === "x" || data === "-" || data === "+" || data === "=") {
          switch (data.toLowerCase()) {
            case "ac":
              values = [];
              value = 0;
              break;
            case "off":
              values = [];
              value = "";
              break;
            case "%":
              v1 = handleValue(parseFloat(value), "%");
              break;
            case "/":
              v1 = handleValue(parseFloat(value), "/");
              break;
            case "x":
              v1 = handleValue(parseFloat(value), "x");
              break;
            case "-":
              v1 = handleValue(parseFloat(value), "-");
              break;
            case "+":
              v1 = handleValue(parseFloat(value), "+");
              break;
            case "=":
              v2 = parseFloat(value);
              values = [];
              value = "";
              handleSymbol(v1, v2, symbol);
              v1 = value;
          }
        }
      }
      document.getElementsByClassName("results")[0].innerHTML = value;
    };
  </script>
</body>

</html>