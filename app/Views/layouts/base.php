<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BalancePlus</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .hero-section {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
            /* Full viewport height */
            padding: 0;
            /* Remove padding */
        }

        .features-section {
            background-color: #f1f1f1;
            padding: 60px 0;
        }

        .feature-box {
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">BalancePlus</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . 'home/about' ?>">About</a>
                    </li>
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() . 'admindashboard' ?>">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() . 'home/logout' ?>">Logout</a>
                            </li>
                        <?php elseif (session()->get('role') === 'member'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() . 'memberdashboard' ?>">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() . 'home/logout' ?>">Logout</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() . 'register' ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() . 'loginboth' ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>

    <?= $this->renderSection("content") ?>

    <!-- Footer -->
    <footer class="text-center">
        <p>&copy; 2024 Balance sheet. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>