                      <table class="table table-bordered">
                           <tbody><tr>
                            <th style="width: 10px">Tháng</th>
                            <th>Đoàn Phí</th>
                            <th>Đã Thu</th>
                            <th>Hoàn Thành </th>
                            <th style="width: 40px">Duyệt</th>
                                        </tr>
                   @for($i = 1 ; $i <=12 ; $i ++)

                       <tr>
                            <td>{{$i}}</td>
                             <td>
                                {{ $total = $count * $monthFees[strval($i)] }}
                             </td>
                           <td class="sum">
                           <?php  $sum= 0;
                            $checked =false;
                            $enough =false ;?>
                             @foreach($pays as $pay)
                             <?php

                             if(isset($pay->monthFee) && $pay->monthFee->month == strval($i))
                             {
                              $sum = $sum + $pay->monthFee->fee;
                              $checked = $pay->check;
                             }
                             ?>
                             @endforeach
                             @if($sum == $total)
                             <?php $enough = true ?>
                             @endif
                             {{$sum}}
                           </td>
                           <td>
                           <div class="progress xs">
                           <div class="progress-bar {{$enough ? 'progress-bar-green' : 'progress-bar-yellow'}}" style="width:{{($sum*100)/$total}}%" >

                           </div>
                             </div>
                           </td>
                           <td>
                                <input  {{$enough ? '' : 'disabled'}} type="checkbox" {{$checked ? "checked" : ""}} class="check-multiple " data-yid="{{$yid}}" data-month="{{$i}}"  data-uid="{{$uid}}" >
                           </td>
                        </tr>
                    @endfor
                </tbody>
                </table>
