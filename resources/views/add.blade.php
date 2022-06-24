<form action="{{url('/users/add')}}" method="POST" >
    @csrf
    <div class="form-group">
    <label for="exampleInputEmail1">Meeting Id</label>
    <input type="string" name="meeting_id"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Id">
    <select class="form-control" name="meeting_id">
    @foreach ($meetings as $meeting)
    <option value="{{$meeting -> meeting_id }}">{{$meeting->meeting_id}}</option>
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Student id</label>
      <input type="text" name="reg_number" class="form-control" id="exampleInputPassword1" placeholder="id">
      <select class="form-control" name="meeting_id">
        @foreach ($students as $student)
        <option value="{{$student -> reg_number }}">{{$student->reg_number}}</option>
          @endforeach
          </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
