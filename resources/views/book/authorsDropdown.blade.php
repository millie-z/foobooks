<select name='author' id='author'>
    @foreach($authorsForDropdown as $id => $name)
        <option value='{{ $id }}' {{ ((isset($book)) and ($id == $book->author->id)) ? 'SELECTED' : ''}}>{{ $name }}</option>
    @endforeach
</select>
