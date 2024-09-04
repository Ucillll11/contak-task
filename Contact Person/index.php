<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Person</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Kontak Person</h1>
        </header>
        <main>
            <div class="grid">
                <section class="card form-section">
                    <h2>Tambah Kontak</h2>
                    <form action="add_contact.php" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <input type="text" id="nim" name="nim" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <input type="text" id="kelas" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon:</label>
                            <input type="text" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" required>
                                <option value="">Pilih Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Non-Biner">Non-Biner</option>
                            </select>
                        </div>
                        <button type="submit">Tambah Kontak</button>
                    </form>
                </section>
                <section class="card data-section">
                    <h2>Daftar Kontak</h2>
                    <?php
                    include 'db.php';

                    // Menampilkan daftar kontak
                    $sql = "SELECT * FROM kontak";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Kelas</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Gender</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['nama']}</td>
                                <td>{$row['nim']}</td>
                                <td>{$row['kelas']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['telepon']}</td>
                                <td>{$row['gender']}</td>
                                <td><a class='delete-btn' href='delete_contact.php?id={$row['id']}'>Hapus</a></td>
                            </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>Belum ada kontak.</p>";
                    }

                    // Menghitung jumlah kontak berdasarkan gender
                    $sql_gender_count = "SELECT gender, COUNT(*) AS jumlah FROM kontak GROUP BY gender";
                    $result_gender_count = $conn->query($sql_gender_count);

                    echo "<h2>Jumlah Kontak Berdasarkan Gender</h2>";
                    if ($result_gender_count->num_rows > 0) {
                        echo "<table>
                            <thead>
                                <tr>
                                    <th>Gender</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>";
                        while ($row = $result_gender_count->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['gender']}</td>
                                <td>{$row['jumlah']}</td>
                            </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>Belum ada kontak.</p>";
                    }

                    $conn->close();
                    ?>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
