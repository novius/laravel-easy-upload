<input type="hidden"
       {{ $attribute ?? 'name' }}="{{ $name }}"
       value="{{ $value ?? null }}">
<input type="file"
       onchange="{{ $id = uniqid('easyupload') }}(this)"
       class="{{ $class ?? null }}"
       accept="{{ $accept ?? null }}">

<script>
function {{ $id }}(input) {
  var files = input.files;
  if (!files.length) return;
  var formData = new FormData(),
      xhr = new XMLHttpRequest();

  formData.append('file', files[0]);

  xhr.open('POST', @json(route('easyupload.upload-file')));
  xhr.onreadystatechange = function () {
    if (xhr.readyState != 4 || xhr.status != 200) return;
    try {
      var data = JSON.parse(xhr.responseText);
      if (data.error) {
        console.error('Error uploading file:', data);
        return;
      }
      input.previousElementSibling.value = data.url;
    }
    catch (e) {
      console.error('Error uploading file:', e);
    }
  };

  xhr.setRequestHeader('X-CSRF-TOKEN', @json(csrf_token()));
  xhr.send(formData);
}
</script>
