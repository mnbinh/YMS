<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
{{--        {{HTML::style('css/net/booststrap-min.3.3.1.css')}}--}}
         {{HTML::style("css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
{{--       {{HTML::style('css/net/font-awesome.4.2.0.css')}}--}}

        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
{{--       {{HTML::style('css/net/ion-icon.1.5.2.css')}}--}}

        {{--<!-- Morris chart -->--}}
        {{--<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />--}}
        {{--<!-- jvectormap -->--}}
        {{--<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />--}}
        {{--<!-- Date Picker -->--}}
        {{--<link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />--}}
        {{--<!-- Daterange picker -->--}}
        {{--<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />--}}
        {{--<!-- bootstrap wysihtml5 - text editor -->--}}
        {{--<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />--}}
        {{----}}
        <!-- Theme style -->
        {{--<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />--}}
        {{ HTML::style('css/AdminLTE.css') }}
        {{HTML::style('css/mystyle.css')}}

        {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
        {{HTML::script('js/net/jquerymin-2.1.3.js')}}


        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
                   {{HTML::script("js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}

        {{--{{HTML::script('js/net/bootstrap-min.3.3.1.js')}}--}}
        @yield('styles')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
          <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>-->
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
          @include('layout.header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           @include('layout.navigation')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
           @yield('content')
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


<div class="loading"><i class="fa  fa-3x fa-spinner fa-spin"></i></div>
<div class="modal" id="alert-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content-alert">
<div class="box box-solid box-primary" style="margin-bottom: 0px">
                                <div class="box-header flat">
                                    <h3 class="box-title"></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-flat btn-sm"  data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">

                                    <p class="text-blue text-bold">

                                    </p>
                             <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Close</button>
                                     <div class="clearfix"></div>
                                </div><!-- /.box-body -->


                            </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        @yield('modal')
        {{ HTML::script('js/AdminLTE/app.js') }}
       {{ HTML::script('js/AdminLTE/demo.js') }}
        @yield('scripts')

    </body>
</html>
