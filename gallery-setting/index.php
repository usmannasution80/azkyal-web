<?php
  $gallery_db_path = './../assets/img/gallery/gallery.json';
  $gallery_path = './../assets/img/gallery/';
  if(!is_file($gallery_db_path)){
    $f = fopen($gallery_db_path, 'w');
    fwrite($f, '{}');
    fclose($f);
  }
  $gallery_db = json_decode(file_get_contents($gallery_db_path), true);
  $gallery = json_decode(file_get_contents($gallery_db_path), true);
  $pictures = [];
  foreach($gallery as $album => $items){
    $pictures[$album] = [];
    foreach(scandir($gallery_path . $album) as $file){
      if($file !== '.' && $file !== '..')
        $pictures[$album][] = $file;
    }
  }

  if(isset($_GET['action']) && isset($_POST['__token'])){

    $token = 'jsksgksksgskjmshdhsjsbnsjsn';

    if($_POST['__token'] !== $token)
      exit;
    switch($_GET['action']){


      case 'add-album':
        $album_name = strtolower(urldecode($_POST['en-us']));
        if(isset($gallery_db[$album_name]) && is_dir($gallery_path . $album_name)){
          http_response_code(403);
          echo 'Album name exists';
          break;
        }
        $f = fopen($gallery_db_path, 'w');
        $gallery_db[$album_name] = [
          'labels' => [
            'id' => $_POST['id'],
            'en-us' => $_POST['en-us']
          ],
          'pictures' => []
        ];
        fwrite($f, json_encode($gallery_db));
        fclose($f);
        mkdir($gallery_path . $album_name);
        http_response_code(200);
        break;


      case 'upload-picture':
        if(!isset($gallery_db[$_POST['album']])){
          echo 'Album not found';
          http_response_code(403);
        }
        $filename = time() . '.jpg';
        if(!isset($gallery_db[$_POST['album']]['pictures']))
          $gallery_db[$_POST['album']]['pictures'] = [];
        $gallery_db[$_POST['album']]['pictures'][$filename] = [
          'title' => [
            'id' => $_POST['title-id'],
            'en-us' => $_POST['title-en-us']
          ],
          'description' => [
            'id' => $_POST['description-id'],
            'en-us' => $_POST['description-en-us']
          ]
        ];
        $f = fopen($gallery_db_path, 'w');
        fwrite($f, json_encode($gallery_db));
        fclose($f);
        move_uploaded_file($_FILES['picture']['tmp_name'], $gallery_path . $_POST['album'] . '/' . $filename);
        header('Location: ?');
        break;

      case 'edit-picture':
        $data;
        if(!isset($gallery_db[$_POST['album']]['pictures']))
          $gallery_db[$_POST['album']]['pictures'] = [];
        if(isset($gallery_db[$_POST['album']]['pictures'][$_POST['filename']]))
          $data = $gallery_db[$_POST['album']]['pictures'][$_POST['filename']];
        else
          $data = [];
        if($_POST['title-id'])
          $data['title']['id'] = $_POST['title-id'];
        if($_POST['title-en-us'])
          $data['title']['en-us'] = $_POST['title-en-us'];
        if($_POST['description-id'])
          $data['description']['id'] = $_POST['description-id'];
        if($_POST['description-en-us'])
          $data['description']['en-us'] = $_POST['description-en-us'];
        $gallery_db[$_POST['album']]['pictures'][$_POST['filename']] = $data;
        $f = fopen($gallery_db_path, 'w');
        fwrite($f, json_encode($gallery_db));
        fclose($f);
        header('Location: ?');
        break;


      case 'delete-picture':
        unset($gallery_db[$_POST['album']]['pictures'][$_POST['filename']]);
        $f = fopen($gallery_db_path, 'w');
        fwrite($f, json_encode($gallery_db));
        fclose($f);
        unlink($_POST['src']);
        break;
      case  'edit-album':
        $gallery_db[$_POST['en-us']] = $gallery_db[$_POST['old-en-us']];
        $gallery_db[$_POST['en-us']]['labels']['en-us'] = $_POST['en-us'];
        $gallery_db[$_POST['en-us']]['labels']['id'] = $_POST['id'];
        if($_POST['en-us'] !== $_POST['old-en-us']){
          unset($gallery_db[$_POST['old-en-us']]);
          rename($gallery_path . $_POST['old-en-us'], $gallery_path . $_POST['en-us']);
        }
        $f = fopen($gallery_db_path, 'w');
        fwrite($f, json_encode($gallery_db));
        fclose($f);
        header('Location: ?');

    }
    exit;


  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title config="brand"></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href="/assets/img/logo.png" rel="shortcut icon">
    <link href="/assets/img/logo.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/main2.css" rel="stylesheet"/>
    <script>
      const VALUES = {};
    </script>
    <script src="/assets/values/id.js"></script>
    <script src="/assets/values/en-us.js"></script>
    <script src="/config.js"></script>
    <script src="/assets/js/set_values.js"></script>
    <script src="/assets/js/config_helper.js"></script>
    <script>
      var imageToEdit;
    </script>
  </head>
  <body>

  <div class="card m-2">
    <div class="card-header">

      <ul class="nav nav-pills card-header-pills" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active" 
            data-bs-toggle="tab"
            data-bs-target="#albums-tab"
            type="button"
            role="tab"
            aria-controls="albums"
            aria-selected="true">
            Albums
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#pictures-tab"
            type="button"
            role="tab"
            aria-controls="pictures"
            aria-selected="true">
            Pictures
          </button>
        </li>
      </ul>
  
    </div>
    <div class="card-body">
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="albums-tab"
          role="tabpanel"
          aria-labelledby="home-tab">
          <ul class="list-group">
          <?php foreach($gallery as $album => $contents): ?>
            <li class="list-group-item">
              <table border="0" width="100%">
                <tr>
                  <td>
                    <?=$album?>
                  </td>
                  <td>
                    <button
                      class="btn btn-primary"
                      lang-id="<?=$contents['labels']['id']?>"
                      lang-en-us="<?=$contents['labels']['en-us']?>"
                      data-bs-toggle="modal"
                      data-bs-target="#modal-edit-album">
                      <i class="bi bi-gear-fill"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </li>
          <?php endforeach; ?>
          </ul>
          <div class="text-center">
            <button
              class="btn btn-primary mt-1"
              data-bs-toggle="modal"
              data-bs-target="#modal-add-album">
              <i class="bi bi-plus"></i>
            </button>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="pictures-tab"
          role="tabpanel"
          aria-labelledby="profile-tab">
          <ul class="list-group">
            <?php
              foreach($pictures as $album => $pictures):
                foreach ($pictures as $picture):
            ?>
            <li class="list-group-item">
              <table border="0" width="100%">
                <tr>
                  <td>
                    <img style="height: 50px" src="<?=$gallery_path.$album.'/'.$picture?>"/>
                  </td>
                  <td>
                    <?=$album.'/'.$picture?>
                  </td>
                  <td>
                    <button
                      class="btn btn-primary btn-edit-picture"
                      src="<?=$gallery_path.$album.'/'.$picture?>"
                      album="<?=$album?>"
                      filename="<?=$picture?>">
                      <i class="bi bi-gear-fill"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </li>
            <?php endforeach; endforeach; ?>
          </ul>
          <div class="text-center">
            <button
              class="btn btn-primary mt-1"
              data-bs-toggle="modal"
              data-bs-target="#modal-add-picture">
              <i class="bi bi-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modal-add-album" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title tab-content">
            Add Album
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table border="0" style="width=100%">
            <tr>
              <td style="max-width:5em">
                <input class="form-control" value="id" disabled=""/>
              </td>
              <td>
                <input class="form-control" value-of="id"/>
              </td>
            </tr>
            <tr>
              <td style="max-width:5em">
                <input class="form-control" value="en-us" disabled=""/>
              </td>
              <td>
                <input class="form-control" value-of="en-us"/>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save">Save</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal-edit-album" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title tab-content">
            Edit Album
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="?action=edit-album">
            <input name="__token" class="d-none"/>
            <input name="old-en-us" class="d-none"/>
            <table border="0" style="width=100%">
              <tr>
                <td style="max-width:5em">
                  <input class="form-control" value="id" disabled=""/>
                </td>
                <td>
                  <input class="form-control" value-of="id" name="id"/>
                </td>
              </tr>
              <tr>
                <td style="max-width:5em">
                  <input class="form-control" value="en-us" disabled=""/>
                </td>
                <td>
                  <input class="form-control" value-of="en-us" name="en-us"/>
                </td>
              </tr>
            </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save">Save</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal-add-picture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title tab-content">
            Add Picture
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="?action=upload-picture" enctype="multipart/form-data">
            <input name="__token" class="d-none"/>
            <select name="album" class="form-select">
              <?php foreach($gallery as $album => $keys): ?>
              <option value="<?=$album?>"><?=$album?></option>
              <?php endforeach; ?>
            </select>
            <div class="mt-2">
              <label for="input-file" class="form-label">Picture</label>
              <input name="picture" class="form-control" type="file" id="input-file"/>
            </div>
            <div class="mt-2">
              <label for="input-title-id">Title ID</label>
              <input class="form-control" type="text" name="title-id"/>
            </div>
            <div class="mt-2">
              <label for="input-title-en-us">Title EN-US</label>
              <input class="form-control" type="text" name="title-en-us"/>
            </div>
            <div class="form-floating">
              <textarea name="description-id" class="form-control" id="textarea-description-id"></textarea>
              <label for="textarea-description-id">Description ID</label>
            </div>
            <div class="form-floating">
              <textarea name="description-en-us" class="form-control" id="textarea-description-en-us"></textarea>
              <label for="textarea-description-en-us">Description EN-US</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save">Save</button>
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="modal-edit-picture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title tab-content">
            Edit Picture
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img style="max-height: 100px;" />
          <form method="POST" action="?action=edit-picture">
            <input name="__token" class="d-none"/>
            <input type="text" name="filename" style="display: none" />
            <input type="text" name="album" style="display: none"/>
            <div class="mt-2">
              <label for="input-title-id">Title ID</label>
              <input class="form-control" type="text" name="title-id"/>
            </div>
            <div class="mt-2">
              <label for="input-title-en-us">Title EN-US</label>
              <input class="form-control" type="text" name="title-en-us"/>
            </div>
            <div class="form-floating">
              <textarea name="description-id" class="form-control" id="textarea-description-id"></textarea>
              <label for="textarea-description-id">Description ID</label>
            </div>
            <div class="form-floating">
              <textarea name="description-en-us" class="form-control" id="textarea-description-en-us"></textarea>
              <label for="textarea-description-en-us">Description EN-US</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger delete">Delete</button>
          <button class="btn btn-primary save">Save</button>
        </div>
      </div>
    </div>
  </div>






    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
      setValues();
      setConfigs();
      (() => {
        document.querySelector('#modal-add-album .save').onclick = e => {
          let inputs = document.querySelectorAll('#modal-add-album input[value-of]');
          let form = '';
          for(let input of inputs){
            if(input.value == '')
              return alert('There\'s empty input');
            form += input.getAttribute('value-of') + '=' + encodeURIComponent(input.value) + '&';
          }
          form += '__token=' + document.body.getAttribute('__token');
          axios.post('?action=add-album', form)
          .then(r => window.location.reload())
          .catch(err => console.log(err))
        };
        document.querySelector('#modal-add-picture .save').onclick = e => {
          document.querySelector('[name="__token"]').value = document.body.getAttribute('__token');
          let input = document.querySelector('#modal-add-picture input[type="file"]');
          if(!input.value)
            return alert('You didnt upload file');
          document.querySelector('#modal-add-picture form').submit();
        };
        let modalDeletePicture = new bootstrap.Modal(document.querySelector('#modal-edit-picture'));
        let deletePictureBtns = document.querySelectorAll('.btn-edit-picture');
        let deletePictureImg = document.querySelector('#modal-edit-picture img');
        for(let button of deletePictureBtns){
          button.onclick = e => {
            deletePictureImg.setAttribute('src', e.currentTarget.getAttribute('src'));
            deletePictureImg.setAttribute('album', e.currentTarget.getAttribute('album'));
            deletePictureImg.setAttribute('filename', e.currentTarget.getAttribute('filename'));
            document.querySelector('#modal-edit-picture input[name="filename"]').value = e.currentTarget.getAttribute('filename');
            document.querySelector('#modal-edit-picture input[name="album"]').value = e.currentTarget.getAttribute('album');
            modalDeletePicture.show();
          };
        }
        document.querySelector('#modal-edit-picture .delete').onclick = e => {
          axios.post(
            '?action=delete-picture',
            'src=' + encodeURIComponent(deletePictureImg.getAttribute('src'))
            + '&album=' + encodeURIComponent(deletePictureImg.getAttribute('album'))
            + '&filename=' + encodeURIComponent(deletePictureImg.getAttribute('filename'))
            + '&__token=' + document.body.getAttribute('__token')
          ).then(r => window.location.reload())
          .catch(err => console.log(r));
        };
        document.querySelector('#modal-edit-picture .save').onclick = e => {
          document.querySelector('[name="__token"]').value = document.body.getAttribute('__token');
          document.querySelector('#modal-edit-picture form').submit();
        };
        let editAlbumBtns = document.querySelectorAll('[data-bs-target="#modal-edit-album"]');
        for(let button of editAlbumBtns){
          button.onclick = e => {
            document.querySelector('#modal-edit-album [name="id"]').value = e.currentTarget.getAttribute('lang-id');
            document.querySelector('#modal-edit-album [name="en-us"]').value = e.currentTarget.getAttribute('lang-en-us');
            document.querySelector('#modal-edit-album [name="old-en-us"]').value = e.currentTarget.getAttribute('lang-en-us');
          };
        }
        document.querySelector('#modal-edit-album .save').onclick = e => {
          document.querySelector('[name="__token"]').value = document.body.getAttribute('__token');
          document.querySelector('#modal-edit-album form').submit();
        };
      })();
    </script>
  </body>
</html>