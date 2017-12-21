<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pimp My Fractale</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <script>
        window.onload = function () {
            var mandelbrot = document.getElementsByName("fractal-type")[0];
            var julia = document.getElementsByName("fractal-type")[1];

            mandelbrot.onclick = hide_julia;
            julia.onclick = show_julia;
        }
    </script>
    <?php
    error_reporting(E_ALL & ~E_NOTICE);
    include 'fractale.php';
    include 'error.php';
    ?>
</head>
<body id="html-body">
<section id="header"><img id="pmf" src="title.png"></section>
<section id="form-container">
    <form id="calcul-form" action="#" method="get">
        <section id="form-title">Génération de fractale</section>
        <section class="input-form">
            <section class="input-title">Nombre d'itération</section>
            <input class="input-number" type="text" title="Nombre d'itération" name="iterations" placeholder="50">
        </section>
        <section class="input-form">
            <section class="input-title">Degré</section>
            <input class="input-number" type="text" title="Degré" name="degre" placeholder="2">
        </section>
        <section class="input-form">
            <label for="mandelbrot">Mandelbrot</label>
            <input id="mandelbrot" class="input-radio" type="radio" title="Type de fractale" name="fractal-type"
                   value="Mandelbrot" checked>
            <label for="julia">Julia</label>
            <input id="julia" class="input-radio" type="radio" title="Type de fractale" name="fractal-type"
                   value="Julia">
        </section>
        <section id="float" class="input-form">
            <section class="input-title">Partie réelle</section>
            <input class="input-number" type="text" title="Partie réelle" name="x" placeholder="-0.75">
        </section>
        <section id="imaginary" class="input-form">
            <section class="input-title">Partie imaginaire</section>
            <input class="input-number" type="text" title="Partie imaginaire" name="y" placeholder="0.25">
        </section>
        <section id="submit-container"><input id="submit-form" type="submit" title="Envoi" name="submit"
                                              value="Générer">
        </section>
        <?php
        $mandelbrot = error_mandelbrot();
        $julia = error_julia();
        $message = "";

        if (!is_numeric($mandelbrot[0]))
            $message .= $mandelbrot[0];
        if (!is_numeric($mandelbrot[1]))
            $message .= $mandelbrot[1];
        if ($_GET['fractal-type'] == "Julia") {
            if (!is_numeric($julia[0]))
                $message .= $julia[0];
            if (!is_numeric($julia[1]))
                $message .= $julia[1];
        }
        if (!empty($message))
            echo "<section id='help'>" . $message . "</section></form></section>";
        else {
            echo "</form></section><section id='img-fractale'><img id='fractale' src='fractale.jpg'></section>";
            if ($_GET['fractal-type'] == "Mandelbrot")
                draw_mandelbrot($mandelbrot[0], $mandelbrot[1]);
            else if ($_GET['fractal-type'] == "Julia")
                draw_julia($julia[0], $julia[1], $mandelbrot[0], $mandelbrot[1]);
        }
        ?>
</body>
</html>
