<form action="{{route('restaurant-tables.store')}}" method="POST">
    @csrf
    @method('POST')
    <input name="table_number" value="{{old('table_number')}}" type="text">
    <input name="chairs" value="{{old('chairs')}}" type="number">
    <input name="restaurant_id" value="{{old('chairs')}}" type="number">
    <button>Submit</button>
</form>