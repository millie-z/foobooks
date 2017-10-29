@if($errors->get($fieldName))
    <ul class='error'>
        @foreach($errors->get($fieldName) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
