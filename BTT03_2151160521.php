<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Bài 1</title>
<body>
<?php


$host = 'DESKTOP-KK1S99S\HUNGNGUYEN';
$dbname = 'QuanlyBaiHat.sql';
$username = 'hungnguyen';
$password = 'hung';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage();
    exit();
}



function getBaiHatList()
{
    global $pdo;
    $query = "SELECT * FROM BaiHat";
    $statement = $pdo->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function addBaiHat($tenBaiHat, $caSi, $idTheLoai)
{
    global $pdo;
    $query = "INSERT INTO BaiHat (tenBaiHat, caSi, idTheLoai) VALUES (?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$tenBaiHat, $caSi, $idTheLoai]);
}

function updateBaiHat($id, $tenBaiHat, $caSi, $idTheLoai)
{
    global $pdo;
    $query = "UPDATE BaiHat SET tenBaiHat = ?, caSi = ?, idTheLoai = ? WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$tenBaiHat, $caSi, $idTheLoai, $id]);
}


function deleteBaiHat($id)
{
    global $pdo;
    $query = "DELETE FROM BaiHat WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
}


function getTheLoaiList()
{
    global $pdo;
    $query = "SELECT * FROM TheLoai";
    $statement = $pdo->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function addTheLoai($tenTheLoai)
{
    global $pdo;
    $query = "INSERT INTO TheLoai (tenTheLoai) VALUES (?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$tenTheLoai]);
}


function updateTheLoai($id, $tenTheLoai)
{
    global $pdo;
    $query = "UPDATE TheLoai SET tenTheLoai = ? WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$tenTheLoai, $id]);
}


function deleteTheLoai($id)
{
    global $pdo;
    $query = "DELETE FROM TheLoai WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
}


$action = $_GET['action'];

switch ($action) {
    case 'view_baihat':
        $baiHatList = getBaiHatList();
        // Hiển thị danh sách bài hát
        break;

    case 'add_baihat':

        $tenBaiHat = $_POST['tenBaiHat'];
        $caSi = $_POST['caSi'];
        $idTheLoai = $_POST['idTheLoai'];
        addBaiHat($tenBHat, $caSi, $idTheLoai);

        break;

    case 'edit_baihat':

        $id = $_POST['id'];
        $tenBaiHat = $_POST['tenBaiHat'];
        $caSi = $_POST['caSi'];
        $idTheLoai = $_POST['idTheLoai'];
        updateBaiHat($id, $tenBaiHat, $caSi, $idTheLoai);

        break;

    case 'delete_baihat':

        $id = $_GET['id'];
        deleteBaiHat($id);

        break;

    case 'view_theloai':
        $theLoaiList = getTheLoaiList();

        break;

    case 'add_theloai':

        $tenTheLoai = $_POST['tenTheLoai'];
        addTheLoai($tenTheLoai);

        break;

    case 'edit_theloai':

        $id = $_POST['id'];
        $tenTheLoai = $_POST['tenTheLoai'];
        updateTheLoai($id, $tenTheLoai);

        break;

    case 'delete_theloai':

        $id = $_GET['id'];
        deleteTheLoai($id);
    break;

    default:

        break;
}



?>

</body>
</html>
