<?php
// dynamic table
// dynamic rows
// dynamic columns
// check if gender of user == m ==> male
// check if gender of user == f ==> female


// collection => laravel => array of objects
$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        // 'phone' => [0155412711111],
        // 'E-mail' =>["blaablaa@aa.com",],

    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        // 'phone' => [0155412711111],
        // 'E-mail' =>[],
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        // 'phone' => [],
        // 'E-mail' =>["nm@aa.com",],
    ],

    // (object)[
    //     'id' => 4,
    //     'name' => 'Nourhan',
    //     "gender" => (object)[
    //         'gender' => 'f'
    //     ],
    //     'hobbies' => [
    //         'Reading', 'Problem Solving',
    //     ],
    //     'activities' => [
    //         "school" => 'coding',
    //         'home' => 'drawing'
    //     ],
    //   'phone' => [01111111 , 25546632156],
    // 'E-mail' =>["nnnnn@aa.com",],
    // ],

];

?>

<!doctype html>
<html lang="en">

<head>
    <title>Data Sheet</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <table class="col-12" style="text-align: center;">
        <thead class="bg-primary">

            <!-- loop on property for getting the table's head -->
            <?php foreach ($users[0] as $property  => $title) { ?>
                <th><?= $property ?> </th>
            <?php }  ?>

        </thead>

        <tbody class="table-primary">
            <!-- all Table Data  [tr=> for everyone (loop), td => person's data (loop) -->
            <?php

            foreach ($users as $property  => $person) { ?>
                <tr>
                    <?php foreach ($users[$property] as $key  => $value) {
                        $printedVal = "";

                        if (is_array($value) || is_object($value)) {
                            foreach ($value as $index => $result) {
                                if ($index == 'gender') {
                                    if ($result == 'm') {
                                        $printedVal .= "Male ";
                                    } else {
                                        $printedVal .= "Female ";
                                    }
                                } else {
                                    $printedVal .= "$result - " ?>
                            <?php }
                            } ?>
                        <?php } else {
                            $printedVal .= "$value " ?>
                        <?php } ?>
                        <!-- Print each cell value -->
                        <td><?= $printedVal ?></td>
                    <?php } ?>
                <?php } ?>

        </tbody>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>