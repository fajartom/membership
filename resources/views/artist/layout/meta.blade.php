
   @if(isset($_meta))
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{$_meta->meta_description}}">
    <meta name="title" content="{{$_meta->seo_title}}">
    <meta name="keyword" content="{{$_meta->meta_keyword}}">
    <meta name="author" content="{{$_meta->domain}}">
    <title>    
      {{$_meta->seo_title}}
     </title>

    <link rel="canonical" href="index.html">
    @endif