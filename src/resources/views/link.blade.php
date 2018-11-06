@php($id = uniqid('easyupload'))
<input type="hidden"
       {{ $attribute ?? 'name' }}="{{ $name }}"
       value="{{ $value ?? null }}"
       onchange="{{ $id }}_updatelink(nextElementSibling)">
<a href="{{ $value ?? '#' }}"
   {!! $link_attributes ?? null !!}>
    {{ $value ?? null }}
</a>
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
  var link = input.previousElementSibling,
      hidden = link.previousElementSibling;

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
      {{ $id }}_updatelink(link);
    }
    catch (e) {
      console.error('Error uploading file:', e);
    }
  };

  xhr.setRequestHeader('X-CSRF-TOKEN', @json(csrf_token()));
  xhr.send(formData);
}
function {{ $id }}_updatelink(link) {
  link.href = link.innerText = link.previousElementSibling.value;
}
</script>
