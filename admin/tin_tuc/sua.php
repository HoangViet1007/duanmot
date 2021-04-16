<?php 
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

  // lấy id xuống và fill dữ liệu cũ      

  // lấy id cần sửa trên đường dẫn xuống 
   if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "select * from tin_tuc where id = '$id'" ; 
      // kiểm tra xem trong date base có sp này ko 
      $cout = connect()->prepare($sql);
      $cout->execute();
      if ($cout->rowCount() > 0) {
          $tt = select_one($sql) ; 
      } else {
          try {
              header('location: ' . BASE_URL . "admin/tin_tuc/list.php?msg=Bài viết này không tồn tại !");      
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
      }
  }else{
      header('location: ' . BASE_URL . "admin/website/list.php?msg=Bài viết này không tồn tại !");      
  }


  require_once APP_PATH."/admin/layout/layout.php" ; 

?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Chỉnh sửa thông tin bài viết</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/tin_tuc/post-sua.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tiêu đề :</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">                  
                        <input type="text" placeholder="Tiêu đề" name="tieu_de" class="form-control"
                            value="<?php echo $tt['tieu_de'] ?>">
                        <?php if(isset($_GET['tieu_deerr'])):?>
                        <span class="text-danger"><?php echo $_GET['tieu_deerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if($tt['trang_thai'] == 0){ ?>
                            <label for="">Trạng thái :</label>
                            <div class="form-control">
                                <input name="trang_thai" value="0" type="radio" checked> Chưa kích hoạt &ensp;
                                <input name="trang_thai" value="1" type="radio"> Kích hoạt
                            </div>
                    <?php } elseif ($tt['trang_thai'] == 1) {?>
                            <label for="">Trạng thái :</label>
                            <div class="form-control">
                                <input name="trang_thai" value="0" type="radio"> Chưa kích hoạt &ensp;
                                <input name="trang_thai" value="1" type="radio" checked> Kích hoạt
                            </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="hinh" id="hinh" class="form-control">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nội dung :</label>
                        <textarea name="noi_dung" id="full-featured-non-premium"  cols="30" rows="5" placeholder="Nội dung"
                            class="form-control"><?php echo $tt['noi_dung'] ?></textarea>
                        <?php if(isset($_GET['noi_dungerr'])):?>
                        <span class="text-danger"><?php echo $_GET['noi_dungerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/tin_tuc/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            selector: 'textarea#full-featured-non-premium',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
</script>