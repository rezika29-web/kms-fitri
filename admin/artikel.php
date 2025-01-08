<?php
include 'template/header.php';
include 'content/artikel.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/korans?populate=*', // URL API Anda
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Ambil data kategori
                let resData = response.data;

                console.log(resData); // Debug data untuk memastikan respons

                // Bersihkan daftar sebelumnya
                $('#artikelList').empty();

                // Looping data dan tambahkan ke elemen HTML
                $.each(resData, function(index, item) {
                    // Tambahkan data ke tabel
                    $('#artikelList').append(
                    `<tr>
                        <td style="width: 50px; text-align: center;">${index + 1}</td>
                        <td style="text-align: center;">${item.judul}</td>
                    </tr>`
                    );
                });
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
</script>