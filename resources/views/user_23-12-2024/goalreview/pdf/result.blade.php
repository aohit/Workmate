<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Goal Review</title>
      <style>
         body {
         font-family: Arial, sans-serif;
         font-size: 14.4px;
         color: #6c757d;
         }
         .container {
         width: 100%;
         margin: auto;
         padding: 20px;
         }
         .header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         border-bottom: 1px solid #ccc;
         padding-bottom: 10px;
         margin-bottom: 20px;
         }
         .profile {
         display: flex;
         align-items: center;
         margin-bottom: 20px;
         gap: 20px !important;
         }
         .profile img {
         height: 110px !important;
         width: 140px !important;
         padding: .25rem !important;
         background-color: #ebeff2 !important;
         border: 1px solid #dee2e6 !important;
         border-radius: 50% !important;
         max-width: 100% !important;
         }
         .review-status,
         .company-values,
         .employee-goal,
         .ratings {
         margin-bottom: 20px;
         }
         .table {
         width: 100%;
         border-collapse: collapse;
         }
         .table th,
         .table td {
         padding: 8px;
         text-align: left;
         }
         .button {
         background-color: #007bff;
         color: white;
         padding: 8px 12px;
         border: none;
         border-radius: 4px;
         text-align: center;
         }
         .badge {
         display: inline-block;
         padding: .25em .4em;
         font-size: 10.8px;
         font-weight: 700;
         line-height: 1;
         color: white;
         text-align: center;
         white-space: nowrap;
         vertical-align: baseline;
         border-radius: .25rem;
         background-color: #6c757d;
         }
         .badge-warning {
         background: #f9c851 !important;
         }
      </style>
   </head>
   <body>
      <!-- Header Section -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #fffff;">
         <tr>
            <td>
               <table class="table" style="border: 0px;">
                  <tr style="width: 100%">
                     <td style="width: 100%">
                        <div class="">
                           <h2 style="
                              margin: 10px 0;
                              color: #343a40;
                              font-weight: 600;
                              ">Goal Review Result</h2>
                        </div>
                     </td>
                  </tr>
               </table>
               <table class="table" style="border: 0px;">
                  <tr style="border-bottom: 1px solid #333;">
                     <td style="border-right: 1px solid #333;width: 50%;">
                        <!-- Profile Section -->
                        <div class="profile">
						 <?php
                             if(isset($goalresults->User->Profile->file)){
                                 $image_url = url('/upload/employee/' . $goalresults->User->Profile->file);
                             }else{
                                 $image_url = url('upload/employee/demo.jpg');
                             }
                             ?>
                           <img src="{{ $image_url }}"
                              alt="Profile" style="border-radius: 100%;">
                          
                           <div>
                              <p style="margin-bottom: 5px; margin-top: 0px;">Name :<span>  {{ $questionnaires->User->name }}</span> </p>
                              <p style="margin-bottom: 5px; margin-top: 0px;">Manager Name:<span> {{ $questionnaires->Manager?->name }}</span> </p>
                              <p style="margin-bottom: 5px; margin-top: 0px;">Review Cycle: <span>{{ $questionnaires->reviewcycle?->title }} (
                                 {{ $questionnaires->reviewcycle?->start_date }}
                                 to{{ $questionnaires->reviewcycle?->end_date }} )</span>
                              </p>
                           </div>
                        </div>
                     </td>
                     <td style="padding-left: 40px;">
                        <!-- Review Status -->
                        <div class="review-status">
                           <p style="margin-bottom: 5px; margin-top: 0px;"><strong>Result {{ $questionnaires->results_shared == 0 ? 'Not' : '' }} has been
                              shared with
                              {{ $questionnaires->User->name }}</strong>
                           </p>
                           <p style="margin-bottom: 5px; margin-top: 0px;">Self-review submitted on date {{ $goalresults->self_review_submitted }}.</p>
                           <p style="margin-bottom: 5px; margin-top: 0px;">Manager review submitted on date {{ $goalresults->manager_review_submitted }}.</p>
                        </div>
                     </td>
                  </tr>
               </table>
               <!-- Goal and Rating Table -->
               <table class="table">
                  <tr>
                     <th></th>
                     <th>Self</th>
                     <th>Manager</th>
                     <th class="badge badge-warning" style="color: #000;">Gap</th>
                  </tr>
                  @foreach ($questionnaires->Goals as $goals)
                  <tr>
                     <th>{{ $goals->title }}</th>
                     @foreach ($questionnaires->GoalReviewStore as $goalRating)
                     @if ($goalRating->goal_id == $goals->id)
                     <td><span>{{ $goalRating->que_self_rating ?? 0 }}</span></td>
                     <td><span>{{ $goalRating->que_manager_rating ?? 0 }}</span></td>
                     <td><span>{{ $goalRating->total_gaps ?? 0 }}</span></td>
                     @endif
                     @endforeach
                  </tr>
                  @endforeach
                  <tr>
                     <th>Total</th>
                     <td><span>{{ $questionnaires->total_self_rating }}</span></td>
                     <td><span>{{ $questionnaires->total_manager_rating }}</span></td>
                     <td><span>{{ $questionnaires->total_gap }}</span></td>
                  </tr>
                  <tr>
                     <th>Manager Final Average Rating</th>
                     <th>{{ number_format($questionnaires->manager_average_rating, 2) }} Out of
                        {{ $questionnaires->total_rating_number ?? 0 }}
                     </th>
                  </tr>
               </table>
               <!-- Company Values -->
               <div class="company-values">
                  <h3>Company Values</h3>
                  <ul>
                     <li><strong>Accountability</strong> - Assume responsibility for actions, products, decisions,
                        and
                        policies.
                     </li>
                     <li><strong>Commitment</strong> - Commit to deliver great products and outstanding service.</li>
                     <li><strong>Innovation</strong> - Pursue new creative ideas that have the potential to change
                        the world.
                     </li>
                     <li><strong>Integrity</strong> - Act with honesty and honor without compromising the truth. Keep
                        your
                        word.
                     </li>
                     <li><strong>Ownership</strong> - Take care of the company and customers as they were your own.
                     </li>
                  </ul>
                  <p>See our company’s values, vision, and mission statement <a
                     href="http://example.com/values">here</a>.</p>
               </div>
               <!-- Employee Goal -->
               <div class="employee-goal">
                  @if ($questionnaires->InputTypesData->slug == 'goal')
                  <h3>Employee Goal</h3>
                  
                  @foreach ($questionnaires->Goals as $usergoals)
                  <p><strong>{{ ucfirst($usergoals->title) }}</strong></p>
                  <div class="">
                     <span
                        style="background-color: {{ $usergoals->goalStatus->background_color }}; color: {{ $usergoals->goalStatus->label_color }}; display: inline-block; padding: 3.2px 9.6px; border-radius: 50px; font-size: 12px;">
                     {{ $usergoals->goalStatus->title }}</span>
                     <span style="margin-top: 5px; display: inline-block;">{{ $usergoals->deadline }} </span>
                     <span> {{ $usergoals->goalCategory->title }}</span>
                     <span>{{ number_format($usergoals->totalprogressbar, 2, '. ', ',') }}</span>
                     <div
                        style="width: 150px; background-color: #dee2e6; border-radius: 4px; overflow: hidden; display: inline-block">
                        <div
                           style="width:  {{ $usergoals->totalprogressbar . '%' }}; background-color: #71b6f9; height: 12px; text-align: center; color: white; font-weight: bold; font-size: 10.8px;">
                           {{ $usergoals->totalprogressbar . '%' }}
                        </div>
                     </div>
                  </div>
                  <div class="ratings">
                     <h3>Ratings</h3>
                     <!-- Add ratings content here if necessary -->
                    
                     @foreach ($usergoals->GoalReviewStore as $review)
                     <table class="" width="100%" cellpadding="0" cellspacing="0"
                        style="border-collapse: collapse; margin-bottom: 20px;">
                        <tr>
                           <td style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                              <table width="100%" cellpadding="0" cellspacing="0">
                                 <tr>
                                    <td style="padding-top: 5px;">
                                       <span style="font-weight: 400; font-size: 14.4px; ">{{ $questionnaires->User->name }}</span>
                                       <span class="badge">
                                       Self
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class=""
                                          style="
                                          margin-left: 10px;
                                          border-left: 2px solid #383636bf;
                                          overflow: auto;
                                          height: 45px;
                                          padding-left: 10px;
                                          ">
                                          <span style="font-weight: 400; font-size: 14.4px">{{ $review->que_self_rating }} {{ $review->que_employ_value }}</span>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     @endforeach
                     @php $gap = 0; @endphp
                     @foreach ($usergoals->GoalReviewStore as $review)
                     <table class="" width="100%" cellpadding="0" cellspacing="0"
                        style="border-collapse: collapse; margin-bottom: 20px;">
                        <tr>
                           <td style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                              <table width="100%" cellpadding="0" cellspacing="0">
                                 <tr>
                                    <td style="padding-top: 5px;">
                                       <span style="font-weight: 400; font-size: 14.4px; ">{{ $questionnaires->User->Manager->name }}</span>
                                       <span class="badge">
                                       Manager
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class=""
                                          style="
                                          margin-left: 10px;
                                          border-left: 2px solid #383636bf;
                                          overflow: auto;
                                          height: 45px;
                                          padding-left: 10px;
                                          ">
                                          <span style="font-weight: 400; font-size: 14.4px">{{ $review->que_manager_rating }} {{ $review->que_manager_value }}</span>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     @php  $gap = $review->que_manager_rating - $review->que_self_rating ; @endphp
                     @endforeach
                  </div>
                  <div>
                     <span> <b> Gap </b> </span> <span class=" badge badge-warning text-dark p-1 totalGap">{{ $gap }}</span>
                  </div>
               </div>
               @if($questionnaires->goalcomment_id == 1)
               <div class="commentsbox">
                  <h3>Comments(Optional)</h3>
                  <!-- Add ratings content here if necessary -->
                   
                  @foreach ($usergoals->GoalReviewStore as $review)
                  <table class="" width="100%" cellpadding="0" cellspacing="0"
                     style="border-collapse: collapse; margin-bottom: 20px;">
                     <tr>
                        <td style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                           <table width="100%" cellpadding="0" cellspacing="0">
                              <tr>
                                 <td style="padding-top: 5px;">
                                    <span style="font-weight: 400; font-size: 14.4px; ">{{ $questionnaires->User->name }}</span>
                                    <span class="badge">
                                    Self
                                    </span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class=""
                                       style="
                                       margin-left: 10px;
                                       border-left: 2px solid #383636bf;
                                       overflow: auto;
                                       height: 45px;
                                       padding-left: 10px;
                                       ">
                                       <span style="font-weight: 400; font-size: 14.4px">{{ $review->goal_comments }}
                                       </span>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  @endforeach
                  @foreach ($usergoals->GoalReviewStore as $review)
                  <table class="" width="100%" cellpadding="0" cellspacing="0"
                     style="border-collapse: collapse; margin-bottom: 20px;">
                     <tr>
                        <td style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                           <table width="100%" cellpadding="0" cellspacing="0">
                              <tr>
                                 <td style="padding-top: 5px;">
                                    <span style="font-weight: 400; font-size: 14.4px; ">Carol Victor</span>
                                    <span class="badge">
                                    Manager
                                    </span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class=""
                                       style="
                                       margin-left: 10px;
                                       border-left: 2px solid #383636bf;
                                       overflow: auto;
                                       height: 45px;
                                       padding-left: 10px;
                                       ">
                                       <span style="font-weight: 400; font-size: 14.4px">{{ $review->manager_comment }}</span>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  @endforeach
               </div>
               @endif
               @endforeach
               @endif
            </td>
         </tr>
      </table>
   </body>
</html>