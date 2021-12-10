<?php

use App\Models\SIP\ModelPaketPekerjaan;

function users($ci, $key)
{
  return $ci->session->get('user')->$key;
}
function skor($skor = null)
{
  switch ($skor) {
    case $skor >= 80:
      $nil = 'A';
      break;
    case $skor >= 70:
      $nil = 'B';
      break;
    case $skor >= 60:
      $nil = 'C';
      break;
    case $skor >= 50:
      $nil = 'D';
      break;
    case $skor < 50:
      $nil = 'E';
      break;
    default:
      $nil = '';
      break;
  }
  return $nil;
}
function cekLogin($ci, $response)
{
  if ($ci->session->get('logged_in') !== 'yes') {
    $response->redirect(base_url('dashboard'));
  }
  return;
}
function uploadS3($temp_file_location, $file_name)
{
  require ROOTPATH . 'vendor/autoload.php';

  /* $your_access_key = 'Q8F9WUSDX11LZ4SL9ZO0';
  $your_secret_key = 'IWHj1Qnxy1DzfUaelGWN7aTeQ0aCEOR3QOBWbcDB';
  $your_bucket_region = 'ap-south-1';
  $your_bucket_name = 'exovillage';
  $auth_url = 'https://ap-south-1.linodeobjects.com'; */

  $your_access_key = 'P774ZNPJCKNW4O24LHJ3';
  $your_secret_key = 'mj6tYlkV7DkMbvSVB2wmlM7QInaIuuIC9goKVLkcBK8';
  $your_bucket_region = 'sgp1';
  $your_bucket_name = 'dutamediadigital';
  $auth_url = 'https://sgp1.digitaloceanspaces.com';

  $config = [
    'credentials' => new \Aws\Credentials\Credentials(
      $your_access_key,
      $your_secret_key
    ),
    'version' => 'latest',
    'region' => $your_bucket_region
  ];

  if (!empty($auth_url) && parse_url($auth_url) !== false) {
    $config['endpoint'] = $auth_url;
  }

  $s3Client = new \Aws\S3\S3Client($config);

  $result = $s3Client->putObject([
    'Bucket' => $your_bucket_name,
    'Key' => 'kampusmerdeka/' . $temp_file_location . $file_name,
    'SourceFile' => $temp_file_location . $file_name,
    'ACL' => 'public-read'
  ]);
}
function uploadS3Profil($temp_file_location, $file_name)
{
  require ROOTPATH . 'vendor/autoload.php';
  $your_access_key = 'KFIIMNIQRUZJ6CAWKBPY';
  $your_secret_key = 'gp/u+M66pI3HEmRGTEELZFXg3QNV6vGyrXKcJChaTMQ';
  $your_bucket_region = 'sgp1';
  $your_bucket_name = 'exov';
  $auth_url = 'https://sgp1.digitaloceanspaces.com';

  $config = [
    'credentials' => new \Aws\Credentials\Credentials(
      $your_access_key,
      $your_secret_key
    ),
    'version' => 'latest',
    'region' => $your_bucket_region
  ];

  if (!empty($auth_url) && parse_url($auth_url) !== false) {
    $config['endpoint'] = $auth_url;
  }

  $s3Client = new \Aws\S3\S3Client($config);

  $result = $s3Client->putObject([
    'Bucket' => $your_bucket_name,
    'Key' => $temp_file_location . $file_name,
    'SourceFile' => $temp_file_location . $file_name,
    'ACL' => 'public-read'
  ]);
}
function hapusS3($file_name)
{
  require ROOTPATH . 'vendor/autoload.php';

  $your_access_key = 'KFIIMNIQRUZJ6CAWKBPY';
  $your_secret_key = 'gp/u+M66pI3HEmRGTEELZFXg3QNV6vGyrXKcJChaTMQ';
  $your_bucket_region = 'sgp1';
  $your_bucket_name = 'exov';
  $auth_url = 'https://sgp1.digitaloceanspaces.com';

  $config = [
    'credentials' => new \Aws\Credentials\Credentials(
      $your_access_key,
      $your_secret_key
    ),
    'version' => 'latest',
    'region' => $your_bucket_region
  ];

  if (!empty($auth_url) && parse_url($auth_url) !== false) {
    $config['endpoint'] = $auth_url;
  }

  $s3Client = new \Aws\S3\S3Client($config);

  $result = $s3Client->deleteObject([
    'Bucket' => $your_bucket_name,
    'Key' => 'kampusmerdeka/' . $file_name
  ]);
}
function hapusS3Profil($file_name)
{
  require ROOTPATH . 'vendor/autoload.php';

  $your_access_key = 'KFIIMNIQRUZJ6CAWKBPY';
  $your_secret_key = 'gp/u+M66pI3HEmRGTEELZFXg3QNV6vGyrXKcJChaTMQ';
  $your_bucket_region = 'sgp1';
  $your_bucket_name = 'exov';
  $auth_url = 'https://sgp1.digitaloceanspaces.com';

  $config = [
    'credentials' => new \Aws\Credentials\Credentials(
      $your_access_key,
      $your_secret_key
    ),
    'version' => 'latest',
    'region' => $your_bucket_region
  ];

  if (!empty($auth_url) && parse_url($auth_url) !== false) {
    $config['endpoint'] = $auth_url;
  }

  $s3Client = new \Aws\S3\S3Client($config);

  $result = $s3Client->deleteObject([
    'Bucket' => $your_bucket_name,
    'Key' => $file_name
  ]);
}
function conv_webp($source, $destination, $quality = 75)
{
  $extension = strtolower(pathinfo($source, PATHINFO_EXTENSION));
  switch ($extension) {
    case 'bmp':
      $img = imagecreatefromwbmp($source);
      break;
    case 'gif':
      $img = imagecreatefromgif($source);
      break;
    case 'jpg':
      $img = imagecreatefromjpeg($source);
      break;
    case 'jpeg':
      $img = imagecreatefromjpeg($source);
      break;
    case 'png':
      $img = imagecreatefrompng($source);
      break;
    case 'webp':
      $img = imagecreatefromwebp($source);
      break;
    default:
      return "Unsupported picture type!";
  }
  imagepalettetotruecolor($img);
  imagealphablending($img, true);
  imagesavealpha($img, true);
  imagewebp($img, $destination, $quality);
  imagedestroy($img);
}
function ekstensi($file)
{
  $eksten = explode(".", $file);
  $eksten = end($eksten);
  if (strtolower($eksten) == 'pdf' || strtolower($eksten) == 'doc' || strtolower($eksten) == 'docx' || strtolower($eksten) == 'xls' || strtolower($eksten) == 'xlsx') {
    $pic = '<span class="mx-5 icon-circle bg-danger text-white">
    <i class="fe fe-file-text"></i>
    </span>';
  } else {
    $pic = false;
  }
  return $pic;
}

function upDokumen($fileupload, $folder, $oldfile)
{
  $namafilenya = $fileupload;
  (base_url() == external_url()) ? '' : uploadS3($folder . '/', $namafilenya);

  if (!empty($oldfile) && $oldfile != 'nophoto.jpg') {
    if (file_exists($folder . '/' . $oldfile)) {
      $filelama = pathinfo($oldfile, PATHINFO_FILENAME) . '.*';
      (base_url() != external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filelama));
    }
  }
  $filenew = pathinfo($namafilenya, PATHINFO_FILENAME) . '.*';
  (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filenew));
  (base_url() == external_url() || $oldfile == 'nophoto.jpg') ? '' : hapusS3($folder . '/' . $oldfile);
  return $namafilenya;
}
function upFotoUpdate($fileupload, $folder, $size, $thumb, $oldfile)
{
  $nmFile = $fileupload;
  $namafilenya = pathinfo($nmFile, PATHINFO_FILENAME) . '.webp';
  $extension = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));
  reSize($nmFile, $folder, $size);
  if ($extension != "webp") {
    conv_webp($folder . '/' . $nmFile, $folder . '/' . $namafilenya, $quality = 75);
    (base_url() == external_url()) ? '' : uploadS3($folder . '/', $namafilenya);
  } else {
    $namafilenya = $nmFile;
    (base_url() == external_url()) ? '' : uploadS3($folder . '/', $namafilenya);
  }

  if ($thumb >= 70) {
    copy($folder . '/' . $namafilenya, $folder . '/thumb_' . $namafilenya);
    reSize('thumb_' . $namafilenya, $folder, $thumb);
    (base_url() == external_url()) ? '' : uploadS3($folder . '/', 'thumb_' . $namafilenya);
    if ($folder == 'assets/img/pilihan') {
      copy($folder . '/' . $namafilenya, $folder . '/thumb2_' . $namafilenya);
      reSize('thumb2_' . $namafilenya, $folder, $thumb * 5);
      (base_url() == external_url()) ? '' : uploadS3($folder . '/', 'thumb2_' . $namafilenya);
    }
  }
  if (!empty($oldfile) && $oldfile != 'nophoto.jpg') {
    if (file_exists($folder . '/' . $oldfile)) {
      $filelama = pathinfo($oldfile, PATHINFO_FILENAME) . '.*';
      (base_url() != external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filelama));
      if ($thumb >= 70) {
        if (file_exists($folder . '/thumb_' . $oldfile)) {
          (base_url() != external_url()) ? '' : unlink($folder . '/thumb_' . $oldfile);
        }
        if ($folder == 'assets/img/pilihan') {
          if (file_exists($folder . '/thumb2_' . $oldfile)) {
            (base_url() != external_url()) ? '' : unlink($folder . '/thumb2_' . $oldfile);
          }
        }
      }
    }
  }
  $filenew = pathinfo($nmFile, PATHINFO_FILENAME) . '.*';
  (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filenew));
  (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/thumb_' . $filenew));
  (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/thumb_2' . $filenew));
  (base_url() == external_url() || $oldfile == 'nophoto.jpg') ? '' : hapusS3($folder . '/' . $oldfile);
  (base_url() == external_url() || $oldfile == 'nophoto.jpg') ? '' : hapusS3($folder . '/thumb_' . $oldfile);
  (base_url() == external_url() || $oldfile == 'nophoto.jpg') ? '' : hapusS3($folder . '/thumb2_' . $oldfile);
  return $namafilenya;
}
function upFotoProfil($fileupload, $folder, $size, $thumb, $oldfile)
{
  $nmFile = $fileupload;
  $namafilenya = pathinfo($nmFile, PATHINFO_FILENAME) . '.webp';
  $extension = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));
  reSize($nmFile, $folder, $size);
  if ($extension != "webp") {
    conv_webp($folder . '/' . $nmFile, $folder . '/' . $namafilenya, $quality = 75);
    (base_url() == external_url2()) ? '' : uploadS3Profil($folder . '/', $namafilenya);
  } else {
    $namafilenya = $nmFile;
    (base_url() == external_url2()) ? '' : uploadS3Profil($folder . '/', $namafilenya);
  }

  if ($thumb >= 70) {
    copy($folder . '/' . $namafilenya, $folder . '/thumb_' . $namafilenya);
    reSize('thumb_' . $namafilenya, $folder, $thumb);
    (base_url() == external_url2()) ? '' : uploadS3Profil($folder . '/', 'thumb_' . $namafilenya);
  }
  if (!empty($oldfile) && $oldfile != 'nophoto.jpg') {
    if (file_exists($folder . '/' . $oldfile)) {
      $filelama = pathinfo($oldfile, PATHINFO_FILENAME) . '.*';
      (base_url() != external_url2()) ? '' : array_map("unlink", glob($folder . '/' . $filelama));
      if ($thumb >= 70) {
        if (file_exists($folder . '/thumb_' . $oldfile)) {
          (base_url() != external_url2()) ? '' : unlink($folder . '/thumb_' . $oldfile);
        }
        if ($folder == 'assets/img/pilihan') {
          if (file_exists($folder . '/thumb2_' . $oldfile)) {
            (base_url() != external_url2()) ? '' : unlink($folder . '/thumb2_' . $oldfile);
          }
        }
      }
    }
  }
  $filenew = pathinfo($nmFile, PATHINFO_FILENAME) . '.*';
  (base_url() == external_url2()) ? '' : array_map("unlink", glob($folder . '/' . $filenew));
  (base_url() == external_url2()) ? '' : array_map("unlink", glob($folder . '/thumb_' . $filenew));
  (base_url() == external_url2()) ? '' : array_map("unlink", glob($folder . '/thumb_2' . $filenew));
  (base_url() == external_url2() || $oldfile == 'nophoto.jpg') ? '' : hapusS3Profil($folder . '/' . $oldfile);
  (base_url() == external_url2() || $oldfile == 'nophoto.jpg') ? '' : hapusS3Profil($folder . '/thumb_' . $oldfile);
  (base_url() == external_url2() || $oldfile == 'nophoto.jpg') ? '' : hapusS3Profil($folder . '/thumb2_' . $oldfile);
  return $namafilenya;
}
function upFotoUpdateX($fileupload, $folder, $size, $thumb, $oldfile)
{
  $nmFile = $fileupload; //str_replace(" ", "_", $fileupload);
  //copy($folder . '/' . $fileupload, $folder . '/' . $nmFile);
  //$namafilenya = pathinfo($nmFile, PATHINFO_FILENAME) . '.webp';
  $namafilenya = $nmFile;
  $extension = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));
  reSize($nmFile, $folder, $size);
  if ($extension != "webp") {
    copy($folder . '/' . $fileupload, $folder . '/' . $nmFile);
    //conv_webp($folder . '/' . $nmFile, $folder . '/' . $namafilenya, $quality = 75);
    //reSize($fileupload, $folder, 1);
  } else {
    $namafilenya = $nmFile;
  }

  if ($thumb >= 70) {
    copy($folder . '/' . $namafilenya, $folder . '/thumb_' . $namafilenya);
    reSize('thumb_' . $namafilenya, $folder, $thumb);
    if ($folder == 'assets/img/pilihan') {
      copy($folder . '/' . $namafilenya, $folder . '/thumb2_' . $namafilenya);
      reSize('thumb2_' . $namafilenya, $folder, $thumb * 5);
    }
  }
  if (!empty($oldfile) && $oldfile != 'nophoto.jpg') {
    if (file_exists($folder . '/' . $oldfile)) {
      $filelama = pathinfo($oldfile, PATHINFO_FILENAME) . '.*';
      (base_url() != external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filelama));
      if ($thumb >= 70) {
        if (file_exists($folder . '/thumb_' . $oldfile)) {
          (base_url() != external_url()) ? '' : unlink($folder . '/thumb_' . $oldfile);
        }
        if ($folder == 'assets/img/pilihan') {
          if (file_exists($folder . '/thumb2_' . $oldfile)) {
            (base_url() != external_url()) ? '' : unlink($folder . '/thumb2_' . $oldfile);
          }
        }
      }
    }
  }
  $filenew = pathinfo($nmFile, PATHINFO_FILENAME) . '.*';
  // (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/' . $filenew));
  // (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/thumb_' . $filenew));
  // (base_url() == external_url()) ? '' : array_map("unlink", glob($folder . '/thumb_2' . $filenew));
  return $namafilenya;
}

function cekFoto($fileupload)
{
  if ($fileupload->getError() <> 4 && $fileupload->getExtension() != "bmp" && $fileupload->getExtension() != "jpg" && $fileupload->getExtension() != "png" && $fileupload->getExtension() != "jpeg" && $fileupload->getExtension() != "gif" && $fileupload->getExtension() != "webp") {
    $pesan = session()->setflashdata('pesan', 'Maaf...hanya bisa upload file FOTO saja!');
  } else {
    $pesan = "1";
  }
  return $pesan;
}
function cekDok($fileupload)
{
  if ($fileupload->getError() <> 4 && $fileupload->getClientExtension() != "bmp" && $fileupload->getClientExtension() != "jpg" && $fileupload->getClientExtension() != "png" && $fileupload->getClientExtension() != "jpeg" && $fileupload->getClientExtension() != "gif" && $fileupload->getClientExtension() != "webp" && $fileupload->getClientExtension() != "doc" && $fileupload->getClientExtension() != "docx" && $fileupload->getClientExtension() != "xls" && $fileupload->getClientExtension() != "xlsx" && $fileupload->getClientExtension() != "pdf") {
    $pesan = session()->setflashdata('pesan', 'Maaf...hanya bisa upload file FOTO, PDF, DOC, DOCX, XLS, XSLX saja!');
  } else {
    $pesan = "1";
  }
  return $pesan;
}
function cekSize($fileupload, $size)
{
  if (!$fileupload->isValid() || $fileupload->getSizeByUnit('mb') > $size) {
    $pesan = session()->setflashdata('pesan', 'Maaf...ukuran File tidak boleh lebih dari ' . $size . ' MB !');
  } else {
    $pesan = "1";
  }
  return $pesan;
}
function formatHarga($harga)
{
  if ($harga >= 1000000) {
    $hrg = $harga / 1000000 . "jt";
  } else if ($harga >= 1000) {
    $hrg = $harga / 1000 . "rb";
  } else {
    $hrg = number_format($harga);
  }
  return $hrg;
}

function warnaStatus($var)
{
  switch ($var) {
    case 'Belum Tender':
      $bgc = 'danger';
      break;
    case 'Proses Tender':
      $bgc = 'warning';
      break;
    case 'Terkontrak':
      $bgc = 'success';
      break;
    case 'draft':
      $bgc = 'yellow';
      break;
    case 'pending review':
      $bgc = 'blue';
      break;
    case 'rejected':
      $bgc = 'red';
      break;
    case 'published':
      $bgc = 'green';
      break;
    case 'settlement':
      $bgc = 'green';
      break;
    case 'pending':
      $bgc = 'red';
      break;
    case 'proses':
      $bgc = 'yellow';
      break;
    case 'dikirim':
      $bgc = 'blue';
      break;
    case 'selesai':
      $bgc = 'green';
      break;
    case 'disetujui':
      $bgc = 'green';
      break;
    case 'ditolak':
      $bgc = 'black';
      break;
    default:
      $bgc = 'gray';
      break;
  }
  return $bgc;
}
function jenisArtikel($var)
{
  switch ($var) {
    case 'post':
      $jenis = 'artikel';
      break;
    case 'page':
      $jenis = 'halaman';
      break;
    case 'produk':
      $jenis = 'produk';
      break;
    case 'event':
      $jenis = 'event';
      break;
    case 'aktivitas':
      $jenis = 'aktivitas';
      break;
    default:
      $jenis = '';
      break;
  }
  return $jenis;
}
function slugArtikel($var)
{
  switch ($var) {
    case 'artikel':
      $jenis = 'post';
      break;
    case 'halaman':
      $jenis = 'page';
      break;
    case 'produk':
      $jenis = 'produk';
      break;
    case 'tour':
      $jenis = 'tour';
      break;
    case 'event':
      $jenis = 'event';
      break;
    case 'aktivitas':
      $jenis = 'aktivitas';
      break;
    default:
      $jenis = '';
      break;
  }
  return $jenis;
}
function enumselect($ci, $table = '', $field = '')
{
  $enums = array();
  if ($table == '' || $field == '') return $enums;
  preg_match_all("/'(.*?)'/", $ci->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->getRow()->Type, $matches);
  foreach ($matches[1] as $key => $value) {
    $enums[$value] = $value;
  }
  return $enums;
}

function namaHari($data)
{
  switch ($data) {
    case 0:
      $hari = "Minggu";
      break;
    case 1:
      $hari = "Senin";
      break;
    case 2:
      $hari = "Selasa";
      break;
    case 3:
      $hari = "Rabu";
      break;
    case 4:
      $hari = "Kamis";
      break;
    case 5:
      $hari = "Jum'at";
      break;
    case 6:
      $hari = "Sabtu";
      break;
  }
  return $hari;
}

function namaSlug($ci, $id, $table)
{
  $ci->db = \Config\Database::connect();
  $idcat = $ci->db->table($table)->select("slug")->where('id', $id)->get()->getRow();
  return $idcat->slug;
}

function dataJam()
{
  for ($x = 0; $x <= 23; $x++) {
    $dJam = $lJam = "0";
    if (strlen($x) == 2) {
      $dJam = $lJam = "";
    }
    if ($x < 12) :
      $dJam .= $x . "AM";
      $lJam .= $x . ":00 AM";
    elseif ($x == 12) :
      $dJam .= $x . "PM";
      $lJam .= $x . ":00 PM";
    else :
      $dJam = $lJam = "0";
      if ($x > 21) {
        $dJam = $lJam = "";
      }
      $x1 = $x - 12;
      $dJam .= $x1 . "PM";
      $lJam .= $x1 . ":00 PM";
    endif;
    echo "<option value='{$dJam}'>" . $lJam;
  }
  return true;
}
function menuNav($ci, $ctg, $tipe, $title, $kontroler)
{
  $request = \Config\Services::request();
  $uri = $request->uri;

  $ci->db = \Config\Database::connect();
  $filter = "parent=0 AND tipe = '{$tipe}' AND kategori_key!='_region'";
  if (!empty($ctg)) {
    $filter .= " AND kategori_key='{$ctg}'";
  }
  if ($tipe == 'fitur') {
    $filter .= " AND belongs_to!=''";
  }
  $menuCat = $ci->db->table('exo_categories')
    ->select("kategori,slug")
    ->where($filter)->orderBy("kategori", "ASC")
    ->get()->getResult();
  foreach ($menuCat  as $mn) {
    if ($title == $mn->slug) {
      $aktif = 'active';
    } else {
      $aktif = '';
    }
    if ($mn->slug != 'penginapan') {
      echo '<a class="nav-link ' . $aktif . '" href="/' . $kontroler . '/' . $mn->slug . '">' . $mn->kategori . '</a>';
    }
  }
  return;
}
function menuSubKat($ci, $parent)
{
  $ci->db = \Config\Database::connect();
  $filter = " parent='{$parent}'";
  $menuCat = $ci->db->table('exo_categories')
    ->select("*")
    ->where($filter)
    ->get()->getResult();
  if ($menuCat > 0) {
    foreach ($menuCat  as $s) {
      $v2 = $ci->db->table("exo_categories")->select("kategori")->where("id='{$parent}'")->get()->getRow();
      $foto = $s->foto;
      if ($foto == '') {
        $foto = 'nophoto.jpg';
      }
      echo '<tr>
        <th width="50"></th>
        <td width="70">
          <a href="/admincategory/edit/' . $s->slug . '" title="' . $s->kategori . '" data-toggle="tooltip" data-placement="top">
            <img class="avatar" src="/assets/img/thumbs/' . $foto . '" alt="" >
          </a>
        </td>
        <td class="blockquote-footer">' . $s->kategori . '</td>
        <td><i>' . $s->slug . '</i></td>
        <td>' . $v2->kategori . '</td>
        <td class="text-center" width="150" nowrap>
          <a href="/admincategory/edit/' . $s->slug . '" class="btn btn-icon btn-xs btn-primary" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fas fa-pen"></i></a>
          <a href="/admincategory/' . $s->slug . '" class="btn btn-icon btn-xs btn-success" title="Detail" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>
          <form action="/admincategory/' . $s->id . '" method="post" class="d-inline">
            ' . csrf_field() . '
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-icon btn-xs btn-danger" onclick="return confirm(\'Yakin data akan dihapus?\');" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash-alt"></i></button>
          </form>
        </td>
      </tr>';
    }
  }
  return;
}

function reSize($namaGbr, $folder, $size)
{
  $info = \Config\Services::image()
    ->withFile($folder . '/' . $namaGbr)
    ->getFile()
    ->getProperties(true);
  $width = $info['width'];
  $height = $info['height'];

  $rTot = $width + $height;
  $rW = round($width / $rTot * 100, 2);
  $rH = round($height / $rTot * 100, 2);
  $stdH = $size;
  if ($height > $stdH) {
    $aftW = round($stdH * $rW / $rH, 0);
  } else {
    $stdH = $height;
    $aftW = $width;
  }

  \Config\Services::image()
    ->withFile($folder . '/' . $namaGbr)
    ->resize($aftW, $stdH, true, 'auto')
    ->save();
}
function reSizeX($namaGbr, $folder, $size)
{
  $info = \Config\Services::image()
    ->withFile($folder . '/' . $namaGbr)
    ->getFile()
    ->getProperties(true);
  $width = $info['width'];
  $height = $info['height'];

  $rTot = $width + $height;
  $rW = round($width / $rTot * 100, 2);
  $rH = round($height / $rTot * 100, 2);
  $stdW = $size;
  if ($width > $stdW) {
    $aftH = round($stdW * $rH / $rW, 0);
  } else {
    $stdW = $width;
    $aftH = $height;
  }

  \Config\Services::image()
    ->withFile($folder . '/' . $namaGbr)
    ->resize($stdW, $aftH, true, 'auto')
    ->save();
}

function subtitle($subtitle, $icon)
{
  $subtitle = ucwords(str_replace("-", " ", $subtitle));
  echo '<div class="page-header-icon"><i class="fas fa-' . $icon . '"></i></div>' . $subtitle;
  return;
}
function kalender($tanggalDiDb)
{
  $bln   = array('');
  switch (date('m', strtotime($tanggalDiDb))) {
    case 1:
      $bln = array("Januari");
      break;
    case 2:
      $bln = array("Februari");
      break;
    case 3:
      $bln = array("Maret");
      break;
    case 4:
      $bln = array("April");
      break;
    case 5:
      $bln = array("Mei");
      break;
    case 6:
      $bln = array("Juni");
      break;
    case 7:
      $bln = array("Juli");
      break;
    case 8:
      $bln = array("Agustus");
      break;
    case 9:
      $bln = array("September");
      break;
    case 10:
      $bln = array("Oktober");
      break;
    case 11:
      $bln = array("November");
      break;
    case 12:
      $bln = array("Desember");
      break;
    default:
      break;
  }
  $tanggal = date('d', strtotime($tanggalDiDb)) . " " . $bln[0] . " " . date('Y', strtotime($tanggalDiDb));
  if ($tanggalDiDb == "" || $tanggalDiDb == "0000-00-00" || $tanggalDiDb == "0000-00-00 00:00:00") {
    $tanggal = '';
  }
  return $tanggal;
}
function kal($tanggalDiDb)
{
  $bln   = array('');
  switch (date('m', strtotime($tanggalDiDb))) {
    case 1:
      $bln = array("Jan");
      break;
    case 2:
      $bln = array("Feb");
      break;
    case 3:
      $bln = array("Mar");
      break;
    case 4:
      $bln = array("Apr");
      break;
    case 5:
      $bln = array("Mei");
      break;
    case 6:
      $bln = array("Jun");
      break;
    case 7:
      $bln = array("Jul");
      break;
    case 8:
      $bln = array("Agt");
      break;
    case 9:
      $bln = array("Sep");
      break;
    case 10:
      $bln = array("Okt");
      break;
    case 11:
      $bln = array("Nov");
      break;
    case 12:
      $bln = array("Des");
      break;
    default:
      break;
  }
  $tanggal = date('d', strtotime($tanggalDiDb)) . " " . $bln[0] . " " . date('Y', strtotime($tanggalDiDb));
  if ($tanggalDiDb == "" || $tanggalDiDb == "0000-00-00" || $tanggalDiDb == "0000-00-00 00:00:00") {
    $tanggal = '';
  }
  return $tanggal;
}
function tgldmY($tanggalDiDb)
{
  $tanggal = date('d-m-Y', strtotime($tanggalDiDb));
  if ($tanggalDiDb == "" || $tanggalDiDb == "0000-00-00" || $tanggalDiDb == "0000-00-00 00:00:00") {
    $tanggal = '';
  }
  return $tanggal;
}
function tgljam($tanggalDiDb)
{
  $tanggal = date('d-m-Y H:i:s', strtotime($tanggalDiDb));
  if ($tanggalDiDb == "0000-00-00" || $tanggalDiDb == "0000-00-00 00:00:00") {
    $tanggal = '';
  }
  return $tanggal;
}
function jam($tanggalDiDb)
{
  $tanggal = date('H:i:s', strtotime($tanggalDiDb));
  if ($tanggalDiDb == "0000-00-00" || $tanggalDiDb == "0000-00-00 00:00:00") {
    $tanggal = '';
  }
  return $tanggal;
}
function romawi($tanggalDiDb)
{
  $bln   = '';
  $date = explode("-", $tanggalDiDb);
  if ($date[2] == 00) {
    $tanggal = "";
  } else {
    switch ($date[1]) {
      case 1:
        $bln = "I";
        break;
      case 2:
        $bln = "II";
        break;
      case 3:
        $bln = "III";
        break;
      case 4:
        $bln = "IV";
        break;
      case 5:
        $bln = "V";
        break;
      case 6:
        $bln = "VI";
        break;
      case 7:
        $bln = "VII";
        break;
      case 8:
        $bln = "VIII";
        break;
      case 9:
        $bln = "IX";
        break;
      case 10:
        $bln = "X";
        break;
      case 11:
        $bln = "XI";
        break;
      case 12:
        $bln = "XII";
        break;
      default:
        break;
    }
    $tanggal = $bln;
  }
  return $tanggal;
}
function angkaromawi($angka)
{
  switch ($angka) {
    case 1:
      $angka = "I";
      break;
    case 2:
      $angka = "II";
      break;
    case 3:
      $angka = "III";
      break;
    case 4:
      $angka = "IV";
      break;
    case 5:
      $angka = "V";
      break;
    case 6:
      $angka = "VI";
      break;
    case 7:
      $angka = "VII";
      break;
    case 8:
      $angka = "VIII";
      break;
    case 9:
      $angka = "IX";
      break;
    case 10:
      $angka = "X";
      break;
    case 11:
      $angka = "XI";
      break;
    case 12:
      $angka = "XII";
      break;
    default:
      break;
  }
  return $angka;
}

function tglYmd($tanggalDiDb)
{
  if ($tanggalDiDb <> '') :
    $date = explode("-", $tanggalDiDb);
    $tanggal = $date[2] . "-" . $date[1] . "-" . $date[0];
  else : $tanggal = '0000-00-00';
  endif;
  return $tanggal;
}

function hari($tanggalDiDb)
{
  $hr   = array('');
  $date = date("N", strtotime($tanggalDiDb));
  switch ($date) {
    case 1:
      $hr = array("Senin");
      break;
    case 2:
      $hr = array("Selasa");
      break;
    case 3:
      $hr = array("Rabu");
      break;
    case 4:
      $hr = array("Kamis");
      break;
    case 5:
      $hr = array("Jum'at");
      break;
    case 6:
      $hr = array("Sabtu");
      break;
    case 7:
      $hr = array("Minggu");
      break;
    default:
      break;
  }
  $tanggal = $hr[0];
  return $tanggal;
}
function bulan($tanggalDiDb)
{
  $bln   = '';
  $date = explode("-", $tanggalDiDb);
  if ($date[2] == 00) {
    $tanggal = "";
  } else {
    switch ($date[1]) {
      case 1:
        $bln = "Januari";
        break;
      case 2:
        $bln = "Februari";
        break;
      case 3:
        $bln = "Maret";
        break;
      case 4:
        $bln = "April";
        break;
      case 5:
        $bln = "Mei";
        break;
      case 6:
        $bln = "Juni";
        break;
      case 7:
        $bln = "Juli";
        break;
      case 8:
        $bln = "Agustus";
        break;
      case 9:
        $bln = "September";
        break;
      case 10:
        $bln = "Oktober";
        break;
      case 11:
        $bln = "November";
        break;
      case 12:
        $bln = "Desember";
        break;
      default:
        break;
    }
    $tanggal = $bln;
  }
  return $tanggal;
}
function klien($ci, $data)
{
  $ci->db = \Config\Database::connect();
  $siklien = $ci->db->table('exo_office')
    ->select($data)
    ->get()->getRow()->$data;
  return $siklien;
}
function imgURL()
{
  $imgurl = external_url();
  return $imgurl;
}
function ddd($data, $exit = true)
{
  echo '<pre>',
  print_r($data, true),
  '</pre>';
  if ($exit === true) exit;
}

function reformatPhoneToE164($phone)
{
  $results = '+6282111111111';
  $first_four_number = substr($phone, 0, 4);

  if (strpos($first_four_number, '08') !== false) {
    $results = str_replace('0', '+62', $first_four_number) . substr($phone, 4);
  }

  return $results;
}

function connectToDb($table)
{
  $connection = \Config\Database::connect();
  return $connection->table($table);
}

function sort_array_of_array(&$array, $subfield)
{
  $sortarray = [];
  foreach ($array as $key => $row) {
    $sortarray[$key] = $row[$subfield];
  }

  array_multisort($sortarray, SORT_DESC, $array);
}
