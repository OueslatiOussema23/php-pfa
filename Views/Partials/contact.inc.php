<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Contact</title>
    <link rel="icon" type="image/x-icon" href="https://www.vexels.com/png-svg/preview/337840/school-building-with-a-clock-on-it-color-stroke">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body data-bs-theme="dark">
    <?php require_once 'navbar.inc.php'; ?>
       <div class="container mt-4">
        <form action="contactHandler" method="post">
            <fieldset>
                <legend>Contactez-nous</legend>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Address email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="nom@example.com" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Votre commentaire</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="commentaire"></textarea>
                </div>
                <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </fieldset>
        </form> 
        </div>
  </body>
</html>