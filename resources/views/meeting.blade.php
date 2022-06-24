<form action="{{url('/students/add')}}" method="POST" >
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Meeting Id</label>
      <input type="string" name="meeting_id"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Id">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Student id</label>
      <input type="number" name="reg_number" class="form-control" id="exampleInputPassword1" placeholder="id">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
