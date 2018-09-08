<?php
    require_once 'init.php';

    $bewerkingen = array(
        1 => '+',
        2 => '-',
        3 => 'x',
        4 => '/'
    );

    $errorFirst = false;
    $errorLast = false;
    $errorBewerking = false;
    $_SESSION['currentValue'] = isset($_SESSION['currentValue']) ? $_SESSION['currentValue'] : 0;
    $_SESSION['aantal'] = isset($_SESSION['aantal']) ? $_SESSION['aantal'] : 0;

    if ($_POST && !empty($_POST)) {

        if (isset($_POST['session_delete'])) {
            session_destroy();
            $_SESSION['currentValue'] = 0;
            $_SESSION['aantal'] = 0;
        }
        else {

            if (
                isset($_POST['firstNumber']) && $_POST['firstNumber'] == "" ||
                isset($_POST['lastNumber']) && $_POST['lastNumber'] == "" ||
                isset($_POST['bewerking']) && $_POST['bewerking'] == "") {
                if ($_POST['firstNumber'] == '') {
                    $errorFirst = 'Gelieve een waarde in te voeren voor het eerste veld!';
                }
                if ($_POST['lastNumber'] == '') {
                    $errorLast = 'Gelieve een waarde in te voeren voor het tweede veld!';
                }
                if ($_POST['bewerking'] == '') {
                    $errorBewerking = 'Gelieve een bewerking in te voeren voor het laatse veld!';
                }
            } else {

                $count = $_POST['aantal'];
                if ($_POST['aantal'] == $_SESSION['aantal']) {
                    $count++;
                    $_SESSION['aantal'] = $count;
                    $berekening = new RekenMachine();
                    $berekening->id = $_SESSION['aantal'];
                    $berekening->firstNumber = $_POST['firstNumber'];
                    $berekening->lastNumber = $_POST['lastNumber'];
                    $berekening->bewerking = $_POST['bewerking'];
                    $berekening->aantal = $_SESSION['aantal'];
                    $berekening->currentValue = $berekening->calculate($berekening->firstNumber, $berekening->bewerking, $berekening->lastNumber);
                    $_SESSION['currentValue'] = isset($_SESSION['currentValue']) ? $_SESSION['currentValue'] + $berekening->currentValue : $_SESSION['currentValue'];
                    $_SESSION['history'][$_SESSION['aantal']] = array(
                        'id' => $berekening->id,
                        'firstNumber' => $berekening->firstNumber,
                        'lastNumber' => $berekening->lastNumber,
                        'bewerking' => $berekening->bewerking,
                        'currentValue' => $berekening->currentValue
                    );
                }

            }
        }
    }
//print_r($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RekenMachine OOP 07-09-2018</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
    <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="submit" name="session_delete" value="Delete session">
        <input type="submit" name="step-back" value="Stap terug">
    </form>
        <h1>Rekenmachine</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="number" name="firstNumber" placeholder="" min="0" value="<?php echo isset($_POST['firstNumber']) ? $_POST['firstNumber'] : ''; ?>">
            <select name="bewerking" id="">
                    <?php foreach ($bewerkingen as $key => $bewerking): ?>
                        <option
                            value="<?php echo $key; ?>"
                            <?php
                                if(isset($berekening) && $berekening->bewerking == $key):
                                    echo 'selected';
                                else:
                                    if (isset($_POST['bewerking']) && $_POST['bewerking'] == $key):
                                        echo 'selected';
                                    endif;
                                endif;
                            ?>
                        >
                            <?php echo $bewerking; ?>
                        </option>
                    <?php endforeach; ?>
            </select>
            <input type="number" name="lastNumber" placeholder="" min="0" value="<?php echo isset($_POST['lastNumber']) ? $_POST['lastNumber'] : ''; ?>">
            <input type="hidden" name="aantal" value="<?php echo $_SESSION['aantal']; ?>">
            <input type="submit" value="Berekenen">
        </form>
        <br>

        <?php if ($errorBewerking):?>
            <p class="error">
                <?php echo $errorBewerking; ?>
            </p>
        <?php endif; ?>
        <?php if ($errorFirst):?>
            <p class="error">
                <?php echo $errorFirst; ?>
            </p>
        <?php endif; ?>
        <?php if ($errorLast):?>
            <p class="error">
                <?php echo $errorLast; ?>
            </p>
        <?php endif; ?>
        De totale totale waarde = <?php echo $_SESSION['currentValue']; ?> <br>
        <?php if($_SESSION['aantal'] != 0): ?>
            <br>
            Alle berekeningen beschikbaar in de sessie: <br>
            <?php
            foreach ($_SESSION['history'] as $key => $value) {
                switch ($value['bewerking']) {
                    case 1:
                        echo "{$value['id']}) {$value['firstNumber']} + {$value['lastNumber']} = {$value['currentValue']} <br>";
                        break;
                    case 2:
                        echo "{$value['id']}) {$value['firstNumber']} - {$value['lastNumber']} = {$value['currentValue']} <br>";
                        break;
                    case 3:
                        echo "{$value['id']}) {$value['firstNumber']} x {$value['lastNumber']} = {$value['currentValue']} <br>";
                        break;
                    case 4:
                        echo "{$value['id']}) {$value['firstNumber']} : {$value['lastNumber']} = {$value['currentValue']} <br>";
                        break;
                }
            }
            ?>
        <?php endif;?>
    </body>
</html>