<nav class="nav">
        <div class="nav-item <?php if($nav=="home"){ echo "active";} ?>" id="index.php">
            <i class="fa fa-house"></i>
            <span class="nav-text">Home</span>
        </div>
        <div class="nav-item <?php if($nav=="customer"){ echo "active";} ?>" id="customer.php">
        <i class="fa fa-car"></i>
            <span class="nav-text">Customer</span>
        </div>
        <div class="nav-item <?php if($nav=="hr"){ echo "active";} ?>" id="hr.php">
            <i class="fa fa-fingerprint"></i>
            <span class="nav-text">HR</span>
        </div>
        <div class="nav-item <?php if($nav=="report"){ echo "active";} ?>" id="report.php">
            <i class="ion-stats-bars menu-icon"></i>
            <span class="nav-text">Reports</span>
        </div>
        <div class="nav-item <?php if($nav=="product"){ echo "active";} ?>" id="product.php">
        <i class="fa-solid fa-box "></i>
            <span class="nav-text">Product</span>
        </div>

    </nav>