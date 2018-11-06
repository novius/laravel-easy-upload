@php($id = uniqid('easyupload'))
<input type="hidden"
       {{ $attribute ?? 'name' }}="{{ $name }}"
       value="{{ $value ?? null }}"
       onchange="{{ $id }}_updateimg(nextElementSibling)">
<img src="{{ $value ?? '#' }}"
   {!! $img_attributes ?? null !!}
   style="display:none;max-width:100%">
<input type="file"
       onchange="{{ $id }}(this)"
       class="{{ $class ?? null }}"
       accept="{{ $accept ?? null }}">

<script>
function {{ $id }}(input) {
  var files = input.files;
  if (!files.length) return;
  var formData = new FormData(),
      xhr = new XMLHttpRequest();
  var img = input.previousElementSibling,
      hidden = img.previousElementSibling;

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
      hidden.value = data.url;
      {{ $id }}_updateimg(img);
    }
    catch (e) {
      console.error('Error uploading file:', e);
    }
  };

  xhr.setRequestHeader('X-CSRF-TOKEN', @json(csrf_token()));
  xhr.send(formData);
}
function {{ $id }}_updateimg(img) {
  img.src = img.previousElementSibling.value;
  img.style.display = 'block'
}
</script>
