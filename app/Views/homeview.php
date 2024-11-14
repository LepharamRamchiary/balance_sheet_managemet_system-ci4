<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>


<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="display-4">Welcome to Our Website</h1>
        <p class="lead">We offer the best services to help you succeed. Explore our website to know more.</p>
        <a href="<?= base_url().'loginboth'?>" class="btn btn-primary btn-lg">Login</a>
        <a href="<?= base_url(). 'register'?>" class="btn btn-primary btn-lg">Register</a>
    </div>
</div>

<!-- Features Section -->
<div id="services" class="features-section">
    <div class="container">
        <h2 class="text-center mb-4">Our Features</h2>
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-box">
                    <h3>Feature 1</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non euismod odio.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-box">
                    <h3>Feature 2</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non euismod odio.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-box">
                    <h3>Feature 3</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non euismod odio.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>