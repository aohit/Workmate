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
            border-bottom: 1px solid #dddddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .profile {
            margin-bottom: 20px;
        }

        .profile img {
            height: 55px;
            width: 70px;
            padding: .25rem !important;
            background-color: #ebeff2 !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 100% !important;
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
            color: white;
            text-align: center;
            white-space: nowrap;
            vertical-align: bottom;
            border-radius: .25rem;
            background-color: #6c757d;
        }

        .badge-warning {
            background-color: #f9c851 !important;
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
                                <h2
                                    style="
                                margin: 10px 0;
                                color: #343a40;
                                font-weight: 600;
                            ">
                                    Goal Review Result</h2>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table" style="border: 0px;">
                    <tr style="border-bottom: 1px solid #dddddd;">
                        <td style="border-right: 1px solid #dddddd;width: 55.5%;">
                            <!-- Profile Section -->
                            <table class="table">
                                <tr>
                                    <td style="width: 19.7%;">
                                        <div class="profile">
                                            <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/' . Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-8.jpg') }}"
                                                alt="Profile">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="profile">
                                            <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;">Name
                                                :<span>
                                                    {{ $questionnaires->User->name }}</span> </p>

                                            <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;">Manager
                                                Name:<span>
                                                    {{ $questionnaires->Manager?->name }}</span> </p>
                                            <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;">Review
                                                Cycle:
                                                <span>{{ $questionnaires->reviewcycle?->title }}
                                                    ({{ $questionnaires->reviewcycle?->start_date }}
                                                    to{{ $questionnaires->reviewcycle?->end_date }})</span>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="padding-left: 20px;">
                            <!-- Review Status -->
                            <div class="review-status">
                                <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;"><strong>Result
                                        {{ $questionnaires->results_shared == 0 ? 'Not' : '' }} has been
                                        shared with
                                        {{ $questionnaires->User->name }}</strong></p>
                                <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;">Self-review submitted
                                    on date
                                    {{ $goalresults->self_review_submitted }}.</p>
                                <p style="margin-bottom: 5px; margin-top: 0px; font-size: 9.7px;">Manager review
                                    submitted on date
                                    {{ $goalresults->manager_review_submitted }}.</p>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Goal and Rating Table -->
                <table class="table" style="margin: 30px auto 30px; width: 80%;">
                    <tr>
                        <th style="width: 25%"></th>
                        <th style="width: 11%">Self</th>
                        <th style="width: 3%">Manager</th>
                        <th style="color: #000; width: 3%">
                            <span class="badge " style="background-color: #f9c851; color: #000;">Gap</span>
                        </th>
                    </tr>
                    @foreach ($questionnaires->Goals as $goals)
                        <tr>
                            <th style="font-size: 12px">{{ $goals->title }}</th>

                            @foreach ($questionnaires->GoalReviewStore as $goalRating)
                                @if ($goalRating->goal_id == $goals->id)
                                    <td style="font-size: 12px"><span>{{ $goalRating->que_self_rating ?? 0 }}</span>
                                    </td>
                                    <td style="font-size: 12px"><span>{{ $goalRating->que_manager_rating ?? 0 }}</span>
                                    </td>

                                    <td style="font-size: 12px"><span>{{ $goalRating->total_gaps ?? 0 }}</span></td>
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
                            {{ $questionnaires->total_rating_number ?? 0 }}</th>
                    </tr>
                </table>
                <!-- Company Values -->
                <table class="table" style="border: 0px;">
                    <tr>
                        <td>
                            <div class="company-values"
                                style="border-bottom: 1px solid #dddddd; border-top: 1px solid #dddddd; padding-bottom: 30px;">
                                <h3 style="font-size: 24px; color: #343A40; margin-bottom: 0px;">Company Values</h3>
                                <ul>
                                    <li><strong>Accountability</strong> - Assume responsibility for actions, products,
                                        decisions,
                                        and
                                        policies.</li>
                                    <li><strong>Commitment</strong> - Commit to deliver great products and outstanding
                                        service.</li>
                                    <li><strong>Innovation</strong> - Pursue new creative ideas that have the potential
                                        to change
                                        the world.
                                    </li>
                                    <li><strong>Integrity</strong> - Act with honesty and honor without compromising the
                                        truth. Keep
                                        your
                                        word.</li>
                                    <li><strong>Ownership</strong> - Take care of the company and customers as they were
                                        your own.
                                    </li>
                                </ul>
                                <p>See our company's values, vision and mission statement here <a
                                        href="http://example.com/values"
                                        style="color: #71b6f9; text-decoration: none;">http://example.com/values</a>.
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Employee Goal -->
                <table class="table" style="border: 0px;">
                    <tr>
                        <td>
                            <div class="employee-goal" style="margin-bottom: 10px">
                                @if ($questionnaires->InputTypesData->slug == 'goal')
                                    <h5 style="margin: 10px 0; color: #343a40; font-weight: 600; font-size: 15px;">
                                        Employee Goal</h5>
                                    @foreach ($questionnaires->Goals as $usergoals)
                                        <div style="padding-left: 15px; padding-bottom: 10px;">
                                            <p><strong>{{ ucfirst($usergoals->title) }}</strong></p>
                                            <div style="padding-top: 10px;">
                                                <span
                                                    style="background-color: #5367ca; color: white; display: inline-block; padding: 3.2px 9.6px; border-radius: 50px; font-size: 12px;">
                                                    In Progress</span>
                                                <span
                                                    style="margin-top: 5px; display: inline-block; padding: 0px 10px;">Due
                                                    on 2024-10-05
                                                </span>
                                                <span style="padding: 0px 10px;"> Operational Excellence</span>
                                                <span style="padding: 0px 10px;"> 100.00</span>
                                                <div
                                                    style="width: 150px; background-color: #dee2e6; border-radius: 4px; overflow: hidden; display: inline-block">
                                                    <div
                                                        style="width: 100%; background-color: #71b6f9; height: 12px; text-align: center; color: white; font-weight: bold; font-size: 10.8px;">
                                                        100%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table" style="border: 0px;">
                    <tr>
                        <td style="padding-top: 0px">
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Ratings -->
                                        <div class="ratings">
                                            <h3
                                                style="margin: 0px 0px 10px; color: #343a40; font-weight: 600; font-size: 15px;">
                                                Ratings
                                            </h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">2
                                                                            Good</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">1
                                                                            Excellent</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Comments -->
                                        <div>
                                            <b> Gap </b> <span class=" badge  text-dark p-1 totalGap"
                                                style="background-color: #f9c851">-1</span>
                                        </div>
                                        <div class="commentsbox">
                                            <h3>Comments(Optional)</h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">work
                                                                            done
                                                                            as expected

                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;>

                                                            <span style="font-weight:
                                                                        400; font-size: 14.4px">very good
                                                                        work

                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                {{-- section 2 starts --}}
                <table class="table" style="border: 0px;">
                    <tr>
                        <td>
                            <div class="employee-goal" style="margin-bottom: 10px">
                                <div style="padding-left: 15px; padding-bottom: 10px;">
                                    <p><strong>Overseeing supply chain and inventory control</strong></p>
                                    <div style="padding-top: 10px;">
                                        <span
                                            style="background-color: #000; color: white; display: inline-block; padding: 3.2px 9.6px; border-radius: 50px; font-size: 12px;">
                                            New</span>
                                        <span style="margin-top: 5px; display: inline-block; padding: 0px 20px;">Due on
                                            2024-10-31</span>
                                        <span style="padding: 0px 20px;"> Personal development</span>
                                        <span style="padding: 0px 20px;"> 00.00</span>
                                        <div
                                            style="width: 150px; background-color: #dee2e6; border-radius: 4px; overflow: hidden; display: inline-block">
                                            <div
                                                style="width: 0%; background-color: #71b6f9; height: 12px; text-align: center; color: white; font-weight: bold; font-size: 10.8px;">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table" style="border: 0px;">
                    <tr>
                        <td style="padding-top: 0px">
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Ratings -->
                                        <div class="ratings">
                                            <h3
                                                style="margin: 0px 0px 10px; color: #343a40; font-weight: 600; font-size: 15px;">
                                                Ratings
                                            </h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">5
                                                                            Poor</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">5
                                                                            Poor</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Comments -->
                                        <div>
                                            <b> Gap </b> <span class=" badge  text-dark p-1 totalGap"
                                                style="background-color: #f9c851">0</span>
                                        </div>
                                        <div class="commentsbox">
                                            <h3>Comments(Optional)</h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">didnt
                                                                            get resources
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;>

                                                            <span style="font-weight:
                                                                        400; font-size: 14.4px">not done
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>



                {{-- section 3 starts --}}
                <table class="table" style="border: 0px;">
                    <tr>
                        <td>
                            <div class="employee-goal" style="margin-bottom: 10px">
                                <div style="padding-left: 15px; padding-bottom: 10px;">
                                    <p><strong>Complete all operational reports</strong></p>
                                    <div style="padding-top: 10px;">
                                        <span
                                            style="background-color: #5367ca; color: white; display: inline-block; padding: 3.2px 9.6px; border-radius: 50px; font-size: 12px;">
                                            In Progress</span>
                                        <span style="margin-top: 5px; display: inline-block; padding: 0px 20px;">Due on
                                            2024-11-21</span>
                                        <span style="padding: 0px 20px;"> Operational excellence</span>
                                        <span style="padding: 0px 20px;"> 70.00</span>
                                        <div
                                            style="width: 150px; background-color: #dee2e6; border-radius: 4px; overflow: hidden; display: inline-block">
                                            <div
                                                style="width: 70%; background-color: #71b6f9; height: 12px; text-align: center; color: white; font-weight: bold; font-size: 10.8px;">
                                                70%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table" style="border: 0px;">
                    <tr>
                        <td style="padding-top: 0px">
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Ratings -->
                                        <div class="ratings">
                                            <h3
                                                style="margin: 0px 0px 10px; color: #343a40; font-weight: 600; font-size: 15px;">
                                                Ratings
                                            </h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 10px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">2
                                                                            Good</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style=" margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">2
                                                                            Good</span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table" border="0">
                                <tr>
                                    <td style="padding: 0px 0px 8px">
                                        <!-- Comments -->
                                        <div>
                                            <b> Gap </b><span class=" badge  text-dark p-1 totalGap"
                                                style="background-color: #f9c851">0</span>
                                        </div>
                                        <div class="commentsbox">
                                            <h3>Comments(Optional)</h3>
                                            <!-- Add ratings content here if necessary -->
                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Steve
                                                                        Marie</span>
                                                                    <span class="badge">
                                                                        Self
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight: 400; font-size: 14.4px">finished
                                                                            all task
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="" width="100%" cellpadding="0" cellspacing="0"
                                                style="border-collapse: collapse; margin-bottom: 20px;">
                                                <tr>
                                                    <td
                                                        style="padding: 15px 0px 20px 20px; background-color: #f5f5f5; border: 1px solid #cbc5c5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding-top: 5px;">
                                                                    <span
                                                                        style="font-weight: 400; font-size: 14.4px; ">Carol
                                                                        Victor</span>
                                                                    <span class="badge">
                                                                        Manager
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 0px;">
                                                                    <div class=""
                                                                        style="margin-left: 10px; border-left: 2px solid #383636bf; overflow: auto; height: 45px; padding-left: 10px;">

                                                                        <span
                                                                            style="font-weight:
                                                                        400; font-size: 14.4px;">its
                                                                            ok
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table" border="0">
                                <tr>
                                    <td>
                                        <div>
                                            <a href="https://demov1.workmate.sc/goalreview"
                                                style="background-color: #f8f9fa; border-color: #f8f9fa;border: 1px solid transparent; padding: 9.2px 16.4px; font-size: .9rem; text-decoration: none; color: #323a46; border-radius: .15rem;">Close</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
