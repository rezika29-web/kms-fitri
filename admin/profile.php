<?php
include 'template/header.php';
include 'content/profile.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/users/me', // URL API Anda
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
            dataType: 'json',
            success: function(response) {
                // Ambil data kategori
                let resData = response;

                console.log("data", response); // Debug data untuk memastikan respons

                // Bersihkan daftar sebelumnya
                $('#profileList').empty();

                // Looping data dan tambahkan ke elemen HTML
                $('#profileList').append(
                    `<tr>
                    <td style="width: 50px; text-align: center;">${response.username}</td>
                    <td style="text-align: center;">${response.email}</td>
                    <td style="text-align: center;">
                        <button class="btn btn-warning btn-sm btn-edit" data-id="${response.documentId}">Edit</button>
                        <button class="btn btn-danger btn-sm btn-change" data-id="${response.documentId}">Change Password</button>
                    </td>
                </tr>`
                );
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
</script>