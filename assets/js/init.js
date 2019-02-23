import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver';

const plugins = [
  "advlist",
  "autolink",
  "lists",
  "link",
  "image",
  "charmap",
  "print",
  'preview',
  'anchor',
  'searchreplace',
  'visualblocks',
  'code',
  'fullscreen',
  'insertdatetime',
  'media',
  'table',
  'paste',
  'imagetools',
  'wordcount'
];

plugins.forEach(plugin => {
  require ('tinymce/plugins/' + plugin);
});

require.context(
    'file-loader?name=[path][name].[ext]&context=node_modules/tinymce!tinymce/skins',
    true,
    /.*/
);

tinymce.init({
selector: 'textarea',
plugins: [
  "advlist autolink lists link image charmap print preview anchor",
  "searchreplace visualblocks code fullscreen",
  "insertdatetime media table paste imagetools wordcount"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
image_title: true,
automatic_uploads: true,
images_upload_url: '/admin/imgUploadTinyMCE',
relative_urls : false,
remove_script_host : false,
document_base_url : "http://projet4.local/",

file_picker_types: 'image',
file_picker_callback: function(cb, value, meta) {
  var input = document.createElement('input');
  input.setAttribute('type', 'file');
  input.setAttribute('accept', 'image/*');

  input.onchange = function() {
    var file = this.files[0];

    var reader = new FileReader();
    reader.onload = function () {
      var id = 'blobid' + (new Date()).getTime();
      var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
      var base64 = reader.result.split(',')[1];
      var blobInfo = blobCache.create(id, file, base64);
      blobCache.add(blobInfo);

      cb(blobInfo.blobUri(), { title: file.name });
    };
    reader.readAsDataURL(file);
  };

  input.click();
}
});
