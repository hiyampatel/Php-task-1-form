<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <script>
        function formdata(value, name)
        {
            //storing value in 3 variables
            if(name == 'firstname')
            {   firstname=value; }
            else if(name == 'lastname')
            {   lastname=value; }
            else
            {   email=value; }

            //if firstname, lastname and email are defined or not null & firstname and email are not empty
            //then send the data
            if((firstname!=undefined||firstname=='') && (lastname!=undefined) && (email!=undefined||email==''))
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
                //sending the data using GET method to save_data.php
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
