<form action="{{url('/meeting/update')}}" method="POST" >
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Meeting Id</label>
      <input type="string" name="meeting_id"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Id">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
