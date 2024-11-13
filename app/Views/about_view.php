<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- About Page Content -->
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="row w-100">

        <!-- Page Title -->
        <div class="col-12 text-center mb-4">
            <h1 class="display-3 text-primary">About Us</h1>
            <p class="lead text-muted">Learn more about our company, our mission, and our team.</p>
        </div>

        <!-- Company Information Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="p-4 shadow-lg rounded bg-white">
                <h3 class="text-primary">Our Mission</h3>
                <p class="text-muted">
                    We are dedicated to providing the best services to our customers, ensuring quality, efficiency, and satisfaction in everything we do. Our mission is to innovate and lead in our industry, creating lasting impact for our clients and the community.
                </p>
            </div>
        </div>

        <!-- Company Values Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="p-4 shadow-lg rounded bg-white">
                <h3 class="text-primary">Our Values</h3>
                <ul class="text-muted">
                    <li><strong>Integrity:</strong> We believe in doing the right thing, even when no one is watching.</li>
                    <li><strong>Innovation:</strong> Constantly seeking new ways to improve and grow.</li>
                    <li><strong>Customer Focus:</strong> Putting the needs of our customers first.</li>
                    <li><strong>Teamwork:</strong> Working together to achieve common goals.</li>
                </ul>
            </div>
        </div>

        <!-- Meet the Team Section -->
        <div class="col-12 text-center mt-5">
            <h2 class="display-4 text-primary">Meet Our Team</h2>
            <p class="lead text-muted">Our team consists of highly skilled professionals committed to excellence.</p>
        </div>

        <div class="col-12 col-md-4 text-center mb-3">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <img src="https://via.placeholder.com/150" alt="Team Member 1" class="img-fluid rounded-circle mb-3">
                <h4>John Doe</h4>
                <p>CEO & Founder</p>
            </div>
        </div>

        <div class="col-12 col-md-4 text-center mb-3">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <img src="https://via.placeholder.com/150" alt="Team Member 2" class="img-fluid rounded-circle mb-3">
                <h4>Jane Smith</h4>
                <p>Chief Technology Officer</p>
            </div>
        </div>

        <div class="col-12 col-md-4 text-center mb-3">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <img src="https://via.placeholder.com/150" alt="Team Member 3" class="img-fluid rounded-circle mb-3">
                <h4>Bob Johnson</h4>
                <p>Chief Marketing Officer</p>
            </div>
        </div>
        
    </div>
</div>

<?= $this->endSection() ?>
