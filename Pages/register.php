<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <h1>Hello Body</h1>

    <div>
        <form id="registerForm">
            <table>
                <tr>
                    <td><label>Name:</label></td>
                    <td><input type="text" id="nameIN"></td>
                </tr>
                <tr>
                    <td><label>Email:</label></td>
                    <td><input type="email" id="emailIN"></td>
                </tr>
                <tr>
                    <td><label>Password:</label></td>
                    <td><input type="text" id="passIN"></td>
                </tr>
                <tr>
                    <td><label>Contact:</label></td>
                    <td><input type="tel" id="telIN"></td>
                </tr>
                <tr>
                    <td><label>Address:</label></td>
                    <td><input type="text" id="addressIN"></td>
                </tr>
                <tr>
                    <td><label>Role:</label></td>
                    <td>
                        <select id="roleSelect">
                            <option value="customer">Customer</option>
                            <option value="seller">Seller</option>
                        </select>
                    </td>
                </tr>
            </table>


            <button type="button" id="registerBtn">Submit</button>
        </form>

        <div id="compleateResponce"></div>
        <div id="responce"></div>
    </div>

    <script src="/WebProject/JavaScript/index.js"></script>
</body>

</html>