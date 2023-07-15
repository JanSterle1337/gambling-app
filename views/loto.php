<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<h1 class="mt-3 text-center fw-bold">Welcome to Loto</h1>
<div class="container">
    <form action="/games/1" method="POST">
        <div class="mb-4">
            <label class="form-label fw-semibold">enter your Loto combination</label>

            <?Php if ($playedCombination !== null) { ?>
                <input type="text" name="loto-combination" class="form-control" value="<?Php echo $_POST['loto-combination'] ?>"  placeholder="12, 15, 2, 5, 6, 2, 39">
            <?php } else { ?>

            <input type="text" name="loto-combination" class="form-control" value=""  placeholder="12, 15, 2, 5, 6, 2, 39">

            <?php } ?>

            <?php if ($this->e($errors))  { ?>
                <p class="mt-2 alert alert-danger"><?=$this->e($errors)?></p>
            <?php } ?>
        </div>
        <div class="mb-3">
            <button type="submit" name="submit" class="btn btn-primary">Submit combination</button>
            <?php if ($this->e($success))  { ?>
                <p class="mt-2 alert alert-success">Good combination!</p>
            <?php } ?>
        </div>
    </form>

    <?php if ($playedCombination !== null) { ?>


        <div class="container mt-5 d-flex justify-content-center">
            <p>
                <?php foreach ($generatedCombination->getCombinationElements() as $key => $value) {

                    if (in_array($value, $matchedCombination->getCombinationElements())) {
                        echo "<span class='alert alert-success'>$value</span>";
                    } else {
                        echo "<span class='alert alert-danger'>$value</span>";
                    }

                } ?>
            </p>
        </div>
    <?php } ?>
</div>
</body>
</html>
