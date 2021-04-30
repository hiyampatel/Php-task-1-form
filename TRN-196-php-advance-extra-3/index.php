<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
    <script>
        function calculate(value = 0, name = '')
        {
            if(name == 'a')
            {   a=value; }
            else if(name == 'b')
            {   b=value; }
            else
            {
                switch(value)
                {
                    case '+': op='add'; break;
                    case '-': op='sub'; break;
                    case '/': op='div'; break;
                    case '*': op='mul'; break;
                    case '' : op='';break;
                    default: op='no';
                }
            }

            if(a!=undefined && b!=undefined && op!=undefined)
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("output").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "calculator.php?a=" + a+"&op="+op+"&b="+b, true);
                xmlhttp.send();
            }


        }
    </script>
</head>
<body>
    <h1>Calculator</h1>
    <form>
        Input 1: <input type="number" name="a" onkeyup="calculate(Number(this.value), this.name)"><br><br>
        Operator(+,-,*,/): <input type="text" name="operator" onkeyup="calculate(this.value, this.name)"><br><br>
        Input 2: <input type="number" name="b" onkeyup="calculate(Number(this.value), this.name)"><br><br>
    </form>
    <h3>Output: <p id="output"></p></h3>
</body>
</html>
