<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body>
    <div>
        <form id="addProductForm">
            <table>
                <tr>
                    <td><input type="file" accept="image/*" id="mainImgIN"></td>
                </tr>
                <tr>
                    <td><label>Product Name:</label></td>
                    <td><input type="text" id="productNameIN"></td>
                </tr>
                <tr>
                    <td><label>Price:</label></td>
                    <td><input type="text" id="priceIN"></td>
                </tr>
                <tr>
                    <td><label>Amount:</label></td>
                    <td><input type="text" id="amountIN"></td>
                </tr>
                <tr>
                    <td><label>Discount:</label></td>
                    <td><input type="text" id="discountIN"></td>
                </tr>
                <tr>
                    <td><label>Description:</label></td>
                    <td><textarea placeholder="Enter product description..." rows="5" cols="30" maxlength="200"
                            id="descriptionIN"></textarea></td>
                </tr>
                <tr>
                    <td><input type="file" accept="image/*" id="imgIN1"></td>
                    <td><input type="file" accept="image/*" id="imgIN2"></td>
                    <td><input type="file" accept="image/*" id="imgIN3"></td>
                    <td><input type="file" accept="image/*" id="imgIN4"></td>
                </tr>
            </table>


            <button type="button" id="addProductBtn">Submit</button>
        </form>

        <div id="mainImageBase64">null</div>
        <div id="image1Base64">null</div>
        <div id="image2Base64">null</div>
        <div id="image3Base64">null</div>
        <div id="image4Base64">null</div>
        <div id="compleateResponce"></div>
        <div id="responce"></div>
    </div>

    <script src="/WebProject/JavaScript/addNewProduct.js"></script>
    <script src="/WebProject/JavaScript/index.js"></script>
</body>

</html>