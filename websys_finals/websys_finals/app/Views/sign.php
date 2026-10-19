<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Sign In </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/CSS/Style_Sign.css">
        <link rel="icon" href="assets/Favicons/sign-in.png">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>

body {
                background: url('assets/banner.jpg') no-repeat center center fixed;
                background-size: cover;
                margin: 0;
                padding: 0;
            }
            .socialCard {
                width: fit-content;
                height: fit-content;
                background-color: #2a2a2a;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 25px 25px;
                gap: 20px;
                box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.055);
            }

            .socialContainer {
                width: 52px;
                height: 52px;
                background-color: rgb(44, 44, 44);
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                transition-duration: .3s;
            }
            
            .containerOne:hover {
                background-color: #d62976;
                transition-duration: .3s;
            }
            
            .containerTwo:hover {
                background-color: #00acee;
                transition-duration: .3s;
            }
            
            .containerThree:hover {
                background-color: #0072b1;
                transition-duration: .3s;
            }
            
            .containerFour:hover {
                background-color: #128C7E;
                transition-duration: .3s;
            }

            .socialContainer:active {
                transform: scale(0.9);
                transition-duration: .3s;
            }

            .socialSvg {
                width: 17px;
            }

            .socialSvg path {
                fill: rgb(255, 255, 255);
            }

            .socialContainer:hover .socialSvg {
                animation: slide-in-top 0.3s both;
            }

            @keyframes slide-in-top {
                0% {
                    transform: translateY(-50px);
                    opacity: 0;
                }

                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
    </head>

    <body>

        <div class="logo" style="float: right; margin-right: 35px;">
            <img src="assets/logo1.jpg" style="width: 275px; height: 275px; border-radius: 50%">
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center mb-4"> Sign In </h2>

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger">
                                <?= esc($validation) ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('login') ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label"> Email </label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"> Password </label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3"> Sign In </button>
                        </form>

                        <div class="text-center mt-3">
                            <p> Don't have an account?<a href="<?= base_url('register') ?>" class="btn btn-link">Click Here</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>