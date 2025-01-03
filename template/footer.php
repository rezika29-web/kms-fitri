
<footer id="footer" class="bg-one">
  <div class="footer-bottom">
    <h5>&copy; Copyright 2020. All rights reserved.</h5>
    <h6>Design and Developed by <a href="https://themefisher.com/">Themefisher</a></h6>
  </div>
</footer> <!-- end footer -->

<!-- end Footer Area
========================================== -->
<!-- 
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- Parallax -->
<script src="plugins/parallax/jquery.parallax-1.1.3.js"></script>
<!-- lightbox -->
<script src="plugins/lightbox2/js/lightbox.min.js"></script>
<!-- Owl Carousel -->
<script src="plugins/slick/slick.min.js"></script>
<!-- filter -->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Smooth Scroll js -->
<script src="plugins/smooth-scroll/smooth-scroll.min.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Custom js -->
<script src="js/script.js"></script>

<script>
  $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/kategoris', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                // Bersihkan daftar pengguna sebelumnya
                $('#kategoriList').empty();
                $('#kategoriListSide').empty();

                // Looping data dan tambahkan ke elemen HTML
                $.each(resData, function(index, dt) {
                    $('#kategoriList').append('<li><a class="dropdown-item" href="listarticle.php?id='+ dt.documentId + '">'+ dt.Kategori + '</a>' +'</li>');
                    $('#kategoriListSide').append('<li><a href="listarticle.php?id='+ dt.documentId + '">'+ dt.Kategori + '</a>' +'</li>');
                });
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
});
</script>

</body>

</html>
