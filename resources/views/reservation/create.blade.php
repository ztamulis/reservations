<form action="{{route('reservation.store')}}" method="POST">
    @csrf
    @method('POST')
    <input name="length" value="{{old('length')}}" type="text">
    <input name="start_from" value="{{old('start_from')}}" type="date">
    <input name="restaurant_id" value="{{old('chairs')}}" type="number">

    <input name="orderer_first_name" value="{{old('orderer_first_name')}}" type="text">
    <input name="orderer_last_name" value="{{old('orderer_last_name')}}"  type="text">
    <input name="orderer_email" value="{{old('orderer_email')}}" type="text">
    <input name="orderer_phone" value="{{old('orderer_phone')}}" type="text">
    <input name="costumer_first_name[]"  type="text">
    <input name="costumer_last_name[]" type="text">
    <input name="costumer_email[]"  type="text">
    <button>Submit</button>

</form>