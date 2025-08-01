<!-- Floating WhatsApp Button -->
<a href="https://wa.me/2348066068596" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://d3js.org/d3.v6.min.js"></script>
<script src="https://d3js.org/topojson.v2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the "About Us" and "Home" links
        const otherLink = document.querySelector('a[href="<?php echo $pageLink;?>"]');

        // Add 'active' class to Home
        if (otherLink && !otherLink.classList.contains('active')) {
            otherLink.classList.add('active');
        }
    });
</script>