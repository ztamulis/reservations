<form action="{{route('restaurant.store')}}" method="POST">
    @csrf
    @method('POST')
    <input name="title" value="{{old('title')}}" type="text">
        <button>Submit</button>
</form>