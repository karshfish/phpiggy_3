<?php
include $this->resolve("partials/_header.php");
?>
<!-- Start Main Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <!-- Page Title -->
    <h3>About Page</h3>

    <hr />
    <h3>This is my github </h3>
    <?php echo "<a href='$github'>Github</a>"; ?>
    </br> please take a look

    <!-- Escaping Data -->
    <p>Escaping Data: </p>
    <?php echo e($dangerousData); ?> <!--escaping the java script command-->
</section>
<!-- End Main Content Area -->
<?php
include $this->resolve("partials/_footer.php");
?>