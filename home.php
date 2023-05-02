<style>
    @import url('https://fonts.googleapis.com/css2?family=Alkatra&family=Indie+Flower&family=Josefin+Sans:wght@200;400&family=Roboto+Slab&family=Work+Sans&display=swap');

    *{
        font-family: 'Alkatra', cursive;
        font-size: 15px;
        margin-top : 20px;
        margin-left : 20px;
    }
</style>

<p style="text-align: center; font-size: 25px;">DATA</p>

<?php
    require_once './config/dbcon.php';

    $query = "SELECT id, title, subtitle, content, created_at, updated_at FROM notes";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "ID: " . $row['id'] . " - Title: " . $row['title'] . " - Subtitle: " . $row['subtitle'] . " - Content: " . $row['content'] . " - Created_at: " . $row['created_at'] . " - Updated_at: " . $row['updated_at'] . "<br>";
        }
    } else {
        $message = "Data tidak ditemukan!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }


    // Menambahkan data ke dalam database
    if(isset($_POST['submit_create'])){
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];
        $created_at = $_POST['created_at'];
        $updated_at = $_POST['updated_at'];

        $query = "INSERT INTO notes (title, subtitle, content, created_at, updated_at) VALUES ('$title', '$subtitle', '$content', '$created_at', '$updated_at')";

        if(mysqli_query($conn, $query)){
            $message = "Data berhasil ditambahkan!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Mengubah data yang sudah ada di dalam database
    if(isset($_POST['submit_update'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];
        $created_at = $_POST['created_at'];
        $updated_at = $_POST['updated_at'];


        $query = "UPDATE notes SET title='$title', subtitle='$subtitle', content='$content', created_at='$created_at', updated_at='$updated_at' WHERE id=$id";

        if(mysqli_query($conn, $query)){
            $message = "Data berhasil diubah!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Menghapus data dari database
    if(isset($_POST['submit_delete'])){
        $id = $_POST['id'];

        $query = "DELETE FROM notes WHERE id=$id";

        if(mysqli_query($conn, $query)){
            $message = "Data berhasil dihapus!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Form untuk menambah dan mengubah data
    echo "<form method='POST'>";
    echo "<input type='text' name='title' placeholder='title'>";
    echo "<input type='text' name='subtitle' placeholder='subtitle'>";
    echo "<input type='text' name='content' placeholder='content'>";
    echo "<input type='text' name='created_at' placeholder='created_at'>";
    echo "<input type='text' name='updated_at' placeholder='updated_at'>";

    echo "<button type='submit' name='submit_create'>Tambah</button>";
    echo "<button type='submit' name='submit_update'>Ubah</button>";

    // Form untuk menghapus data
    echo "<input type='text' name='id' placeholder='ID'>";
    echo "<button type='submit' name='submit_delete'>Hapus</button>";

    echo "</form>";

    mysqli_close($conn);
?>