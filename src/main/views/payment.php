<?php
include_once '../models/Client.php';
session_start();
if( !isset($_SESSION['client']) )   exit();
$client=$_SESSION['client'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "import_files.php"; ?>
    <title>Paiment</title>
</head>

<body>
    <main class="container">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4">Formulaire du Paiment</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <!-- Credit card form content -->
                            <div class="tab-content">
                                <div id="credit-card" class="tab-pane fade show active pt-3">
                                    <form method="post" action="../controllers/paymentController.php">
                                    <div class="d-flex justify-content-center">
                                        <h3 id="client" class="bg-primary" style="border-radius: 5px; padding: 5px;">
                                            <?php echo $client->get_first_name().' '.$client->get_last_name(); ?>
                                        </h3>
                                    </div>
                                    <div class="form-group"> <label for="address">
                                                <h6>Adresse de livraison</h6>
                                            </label> <input type="text"  value="<?php echo $client->get_address();?>" name="address" placeholder="Adresse de livraison" required class="form-control "> </div>
                                        <div class="form-group"> <label for="username">
                                                <h6>Propriétaire de la carte</h6>
                                            </label> <input type="text" name="username" placeholder="Nom du Propriétaire de la carte" required class="form-control "> </div>
                                        <div class="form-group"> <label for="cardNumber">
                                                <h6>Numéro de la Carte</h6>
                                            </label>
                                            <div class="input-group"> <input type="text" name="cardNumber" placeholder="Numéro de la Carte validé" class="form-control " required>
                                                <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group"> <label><span class="hidden-xs">
                                                            <h6>Date d'expiration</h6>
                                                        </span></label>
                                                    <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4"> <label data-toggle="tooltip" title="un code de 3 chifres sur le dos votre carte">
                                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                    </label> <input type="text" required class="form-control"> </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="submited" class="subscribe btn btn-primary btn-block shadow-sm"> Confirmer le Paiment </button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                                <p class="text-muted">NB: après avoir cliqué sur le bouton, vous serez dirigé vers une passerelle sécurisée pour le paiement. Une fois le processus de paiement terminé, vous serez redirigé vers le site Web pour afficher les détails de votre commande.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>