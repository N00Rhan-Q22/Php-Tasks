<!doctype html>
<html lang="en">

<head>
    <title>Bank Loan</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="margin: auto;">
    <h1 class="alert alert-primary" style="text-align: center;">Get A Bank Loan</h1>

    <div style="display: flex; justify-content: space-around; margin: 10px 30px;">
        <aside class="col-6">
            <form method="post" class="col-6" style="margin-top: 50px; color: blue; font-weight: 900; font-size: 17px;">
                <label for="name">User Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" aria-describedby="helpId" value="<?php if (!empty($_POST['name'])) { echo $_POST['name']; } ?>">
                <br>
                <label for="loanAmount">Loan Amount</label>
                <input type="number" name="loanAmount" id="loanAmount" class="form-control" placeholder="Enter The wanted amount of loan" aria-describedby="helpId" value="<?php if (!empty($_POST['loanAmount'])) { echo $_POST['loanAmount']; } ?>">
               <br>
                <label for="loanYears">Loan Years</label>
                <input type="number" name="loanYears" id="loanYears" class="form-control" placeholder="Enter number of years" aria-describedby="helpId" value="<?php if (!empty($_POST['loanYears'])) { echo $_POST['loanYears']; } ?>">
                <button type="submit" name="clicked" value="printResult" class="btn btn-info" style=" border-radius: 15px; width: 150px; margin: 15px 0; ">Print Result</button>
            </form>
            <table class="col-12" style="font-size: 18px; margin-top: 25px;">
                <?php
                if ($_POST) { ?>
                    <thead class="table-dark">
                        <th>User Name</th>
                        <th>Interest Rate</th>
                        <th>Loan After Interest</th>
                        <th>Monthly Amount</th>
                    </thead>
                    <tbody class="table-warning">
                        <tr>
                           <td><?= $_POST['name']?></td>
                           <?php 
                           if($_POST['loanYears']<=3){
                               $interestRate=($_POST['loanAmount']*0.1)*$_POST['loanYears'];
                           }
                           else{
                            $interestRate=($_POST['loanAmount']*0.15)*$_POST['loanYears'];
                           }?>
                               <td><?= $interestRate?></td>
                               <td><?= $interestRate + $_POST['loanAmount']?></td>
                               <td><?= ($interestRate + $_POST['loanAmount'])/($_POST['loanYears']*12) ?></td>
                        </tr>            
                    </tbody>
                <?php }?>
            </table>
        </aside>

        <aside>
            <img src="bank_loan.gif" style="width: 500px; height: 600px;">
        </aside>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>