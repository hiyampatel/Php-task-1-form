<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <script>
        function formdata(value, name)
        {
            if(name == 'firstname')
            {   firstname=value; }
            else if(name == 'lastname')
            {   lastname=value; }
            else
            {   email=value; }
            if((firstname!=undefined||firstname=='') && (lastname!=undefined) && (email!=undefined||email==''))
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("output").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "save_data.php?firstname="+firstname+"&lastname="+lastname+"&email="+email, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    <h1>Forms</h1>
    <form>
        Firstname: <input type="text" name="firstname" onkeyup="formdata(this.value, this.name)"> *<br><br>
        Lastname: <input type="text" name="lastname" onkeyup="formdata(this.value, this.name)"><br><br>
        Email: <input type="email" name="email" onkeyup="formdata(this.value, this.name)"> *<br><br>
    </form>

        <h3>Output: <p id="output"></p></h3>

</body>
</html>
