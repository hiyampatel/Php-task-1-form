<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
    <script>
        function calculate(value = 0, name = '')
        {
            //storing value in 3 variables
            if(name == 'a')
            {   a=value; }
            else if(name == 'b')
            {   b=value; }
            else
            {
                //making the signs to corresponding string name
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

            //if a, b and op are defined or not null
            //then send the data
            if(a!=undefined && b!=undefined && op!=undefined)
            {
                //creating object of XMLHttpResponce
                //this could help fetch the data using different method from another url
                var xmlhttp = new XMLHttpRequest();

                //action is perform when the document is ready
                xmlhttp.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        //set the output variable as the response of the page
                        document.getElementById("output").innerHTML = this.responseText;
                    }
                };

                //sending the data using GET method to calculator.php
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
