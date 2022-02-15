<!doctype html>
<html lang="en">

<head>
    <title>Supermarket</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header style=" display: flex; background-color: palegoldenrod; ">
        <img src="logo.jpg" alt="logo" style="width: 200px; height: 55px;">
        <p style="width: 30%;"></p>
        <h1 style=" font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-style: italic; color: red;">Online Shopping</h1>
    </header>

    <div style="display: flex; justify-content: space-around; margin-top: 30px; ">
        <aside>
            <!-- section 1 => to get input -->
            <form method="post" class="col-12" style="margin-top: 50px; color:#C16471 ; width: 600px; font-weight: 900; font-size: 20px;">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" value="<?php if (!empty($_POST['name'])) {
                                                                                                                            echo $_POST['name'];
                                                                                                                        } ?>">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <select name="city" id="city" class="form-control">
                        <option value="Cairo" <?php if (!empty($_POST['city'])) {
                                                    if ($_POST['city'] == 'Cairo') {
                                                        echo "selected";
                                                    }
                                                } ?>>Cairo</option>
                        <option value="Giza" <?php if (!empty($_POST['city'])) {
                                                    if ($_POST['city'] == 'Giza') {
                                                        echo "selected";
                                                    }
                                                } ?>>Giza</option>
                        <option value="Alex" <?php if (!empty($_POST['city'])) {
                                                    if ($_POST['city'] == 'Alex') {
                                                        echo "selected";
                                                    }
                                                } ?>>Alex</option>
                        <option value="Other" <?php if (!empty($_POST['city'])) {
                                                    if ($_POST['city'] == 'Other') {
                                                        echo "selected";
                                                    }
                                                } ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="noProduct">Number Of Products</label>
                    <input type="number" name="noProduct" id="noProduct" class="form-control" value="<?php if (!empty($_POST['noProduct'])) {
                                                                                                            echo $_POST['noProduct'];
                                                                                                        } ?>">
                </div>
                <button type="submit" name="entrProducts" class="btn btn-info" style=" border-radius: 15px; width: 150px; margin: 15px 0; ">Enter Products</button>

                <?php
                if (isset($_POST['entrProducts'])) { ?>
                    <!-- section 2 => make a table to enter wanted products -->

                    <table class="table table-bordered table-success">
                        <thead>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantities</th>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < $_POST['noProduct']; $i++) { ?>
                                <tr>
                                    <td> <input type="text" name="productName<?= $i ?>" id="productName" placeholder="Product <?= $i + 1 ?>" class="form-control"></td>
                                    <td> <input type="number" name="productPrice<?= $i ?>" id="productPrice" class="form-control"></td>
                                    <td> <input type="number" name="productQuantity<?= $i ?>" id="productQuantity" class="form-control"></td>
                                </tr>

                            <?php  } ?>
                        </tbody>

                    </table>

                    <button type="submit" name="printReceipt" class="btn btn-info" style=" border-radius: 15px; width: 150px; margin: 15px 0; ">Print Receipt</button>
                <?php } ?>


                <?php
                //  section 3 => print receipt
                if (isset($_POST['printReceipt'])) { ?>

                    <table class="table table-bordered table-primary">
                        <thead>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantities</th>
                            <th>Sub Total</th>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            for ($i = 0; $i < $_POST['noProduct']; $i++) {
                                $totalProductCost = 0;
                                $totalProductCost = $_POST['productQuantity' . $i] * $_POST['productPrice' . $i];
                                $total += $totalProductCost;
                            ?>

                                <tr>
                                    <td> <?= $_POST['productName' . $i] ?></td>
                                    <td> <?= $_POST['productPrice' . $i] ?></td>
                                    <td> <?= $_POST['productQuantity' . $i] ?></td>
                                    <td><?= $totalProductCost ?></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <table class="table table-bordered table-info">
                        <tbody>
                            <tr>
                                <td>Client Name:</td>
                                <td> <?= $_POST['name'] ?> </td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td><?= $_POST['city'] ?></td>
                            </tr>

                            <tr>
                                <td>Total:</td>
                                <td> <?= $total ?> </td>
                            </tr>
                            <?php
                            //discount
                            if ($total <= 1000) {
                                $discount = 0;
                            } else  if ($total > 1000 && $total <= 3000) {
                                $discount = 0.1 * $total;
                            } else  if ($total > 3000 && $total <= 4500) {
                                $discount = 0.15 * $total;
                            } else  if ($total > 4500) {
                                $discount = 0.2 * $total;
                            }
                            ?>
                            <tr>
                                <td>Discount:</td>
                                <td><?= $discount ?></td>
                            </tr>

                            <?php $total -= $discount; ?>

                            <tr>
                                <td>Total After Discount:</td>
                                <td><?= $total ?></td>
                            </tr>


                            <?php
                            //delivery cost
                            if ($_POST['city'] == 'Cairo') {
                                $deliveryCost = 0;
                            } else if ($_POST['city'] == 'Giza') {
                                $deliveryCost = 30;
                            } else if ($_POST['city'] == 'Alex') {
                                $deliveryCost = 50;
                            } else {
                                $deliveryCost = 100;
                            }
                            ?>


                            <tr>
                                <td>Delivery:</td>
                                <td><?= $deliveryCost ?></td>
                            </tr>
                            <?php $total += $deliveryCost; ?>

                            <tr class='table table-bordered table-danger'>
                                <td>Net Total:</td>
                                <td><?= $total ?> </td>
                            </tr>

                        </tbody>
                    </table>
                <?php  } ?>
            </form>
        </aside>
        <aside>
            <img src="onine_shopping.gif" alt="" style="height: 600px; width: 500px;">
        </aside>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>