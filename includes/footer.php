<?php if ($url_segments[0] != 'admin' && $url_segments[0] != 'admin.php' && $url_segments[0] != 'adminPortal'): ?>
    <script>
        function toggleDropdown(element) {
            const dropdown = element.querySelector('.dropdown-menu');
            dropdown.classList.toggle('show');
        }</script>
    <a href="https://wa.me/917906466763" class="whatsapp-btn">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1200px-WhatsApp.svg.png"
            alt="WhatsApp" class="whatsapp-icon">
    </a>

    <a href="tel:+91XXXXXXXXXX" class="call-btn">
        <i class="fa fa-phone"></i> Call Us
    </a>
<?php endif; ?>
</body>

</html>