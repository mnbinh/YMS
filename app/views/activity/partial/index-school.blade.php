                       <li class="time-label">
                                                     <span class="bg-green">
                                                       {{date('d-m-Y')}}
                                                     </span>
                                                 </li >
                    @foreach($activities as $activity)
                                <li >

                                    <i class="fa fa-bell  bg-blue "></i>
                                    <div class="timeline-item">

                                        <span class="time"><i class="fa fa-clock-o"></i> {{  $activity->date->diffForHumans()}}</span>
                                        <h3 class="timeline-header">{{link_to_route('school.activity.show',$activity->name,array('activity'=>$activity->id))}}({{$activity->place}}) </h3>
                                        <div class="timeline-body">
                                           <pre> {{$activity->description}} </pre>
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs btn-flat">Read more</a>
                                            <a class="btn btn-danger btn-xs btn-flat">Delete</a>
                                        </div>
                                    </div>
                                </li>
                    @endforeach
                      <li>
                        <i class="fa fa-clock-o"></i>
                    </li>