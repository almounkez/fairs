@extends('layouts.app')

@section('content')
@endsection

@section('script')
  <script>
                            function fbs_click() {
                                u = location.href;
                                t = document.title;
                                window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' +
                                    encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                                return false;
                            }

                        </script>
@endsection