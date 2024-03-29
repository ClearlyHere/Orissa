<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/Orissa/">
    <title><?php if (isset($pageTitle)) echo $pageTitle ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php  if (isset($cssArray)) {
        foreach ($cssArray as $cssFile){
            echo '<link rel="stylesheet" href="Orissa/../assets/css/' . $cssFile . '">';
        }
        if (isset($jsArray)) {
            foreach ($jsArray as $jsFile){
                echo '<script src="Orissa/../assets/js/'. $jsFile . '"></script>';
            }
        }
    } ?>
</head>
