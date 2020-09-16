 @foreach($files as $file)

  <div> 
     <img src="{{route('getfile', $file)}}"  class="img-responsive" />
  </div>
  <div class="time" id="time">Deadline: {{ date("d-m-Y", strtotime($time->ketthuc)) }}</div>

  @endforeach


